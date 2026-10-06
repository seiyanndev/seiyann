/**
 * Work page "Freefall" deck.
 *
 * The section is pinned while you scroll through the projects. Scroll progress maps to a
 * continuous position `p` (0 = first card active, N-1 = last). Every frame each card is placed
 * from its distance to p (d = index - p):
 *   d > 0  upcoming: stacked above the active card at the "crest", each step smaller, higher
 *          and tilted further back, so only their top edges peek out.
 *   d = 0  active: flat, full size, front and centre.
 *   d < 0  falling: rotates forward on its bottom edge, drops and fades into the "pit".
 * p eases toward the scroll position, so the motion has weight rather than snapping.
 *
 * Clicking the active card (or the CTA) opens the project modal; clicking a card in the pile
 * scrolls to it. With reduced motion the deck becomes a plain grid (see work.css).
 */
(function () {
    const section = document.getElementById("freefall");
    const stage = document.getElementById("ff-stage");
    if (!section || !stage) return;

    const cards = Array.from(stage.querySelectorAll(".ff-card"));
    const total = cards.length;
    const counter = document.getElementById("ff-counter");
    const fill = document.getElementById("ff-fill");
    const dot = document.getElementById("ff-dot");
    const cta = document.getElementById("ff-open");
    const ctaTitle = cta && cta.querySelector(".ff-cta-title");

    /* ---------- Project modal ---------- */
    const modal = document.getElementById("project-modal");
    const modalTitle = document.getElementById("modal-title");
    const modalCategory = document.getElementById("modal-category");
    const modalDesc = document.getElementById("modal-desc");
    const modalImage = document.getElementById("modal-image");
    const modalArt = document.getElementById("modal-art");
    let lastFocus = null;

    function openModal(card) {
        if (!modal) return;
        modalTitle.textContent = card.dataset.title;
        modalCategory.textContent = card.dataset.category;
        modalDesc.textContent = card.dataset.desc;

        // Screenshot if there is one, otherwise a copy of the card's generated art.
        const image = card.dataset.image;
        modalImage.hidden = !image;
        modalArt.hidden = !!image;
        if (image) {
            modalImage.src = image;
            modalImage.alt = card.dataset.title + " preview";
        } else {
            const art = card.querySelector(".ff-art");
            modalArt.innerHTML = "";
            if (art) modalArt.appendChild(art.cloneNode(true));
        }

        lastFocus = document.activeElement;
        modal.classList.add("active");
        document.body.style.overflow = "hidden";
        document.getElementById("modal-close").focus();
    }

    function closeModal() {
        modal.classList.remove("active");
        document.body.style.overflow = "";
        if (lastFocus) lastFocus.focus();
    }

    if (modal) {
        document.getElementById("modal-close").addEventListener("click", closeModal);
        document.getElementById("modal-close-btn").addEventListener("click", closeModal);
        modal.addEventListener("click", e => { if (e.target === modal) closeModal(); });
        document.addEventListener("keydown", e => {
            if (e.key === "Escape" && modal.classList.contains("active")) closeModal();
        });
    }

    /* ---------- Reduced motion / no GSAP: plain grid ---------- */
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    if (reduceMotion || !window.gsap || !window.ScrollTrigger || total < 2) {
        section.classList.add("ff--static", "is-ready");
        cards.forEach(card => card.addEventListener("click", () => openModal(card)));
        if (cta) cta.addEventListener("click", () => openModal(cards[0]));
        return;
    }

    /* ---------- Card placement ---------- */
    const PILE_VISIBLE = 4.5;  // upcoming cards beyond this distance fade out
    const SCALE_STEP = 0.06;   // each step up the pile is 6% smaller
    const FIRST_TILT = 22;     // degrees the next card leans back
    const TILT_STEP = 7;       // ...and each one after leans back this much more
    const MAX_TILT = 60;
    const FALL_TILT = 75;      // degrees the outgoing card rotates forward as it falls

    let size = stage.offsetWidth; // card size in px; re-measured on resize

    const clamp = (v, lo, hi) => Math.min(hi, Math.max(lo, v));
    const easeIn = t => t * t;
    const easeOut = t => 1 - (1 - t) * (1 - t);

    function placeCard(card, d) {
        let y, rotateX, scale, opacity, z;

        if (d >= 0) {
            // Upcoming / active: climbs the pile as d grows.
            const t = Math.min(d, 1);
            rotateX = -Math.min(easeOut(t) * FIRST_TILT + Math.max(0, d - 1) * TILT_STEP, MAX_TILT);
            scale = 1 - SCALE_STEP * d;
            y = -size * 1.15 * (1 - Math.pow(0.7, d));
            opacity = d > PILE_VISIBLE ? clamp(1 - (d - PILE_VISIBLE), 0, 1) : 1;
            z = 100 - Math.round(d * 10);
        } else {
            // Falling: tips forward on its bottom edge and drops below the viewport. The drop starts
            // fast (linear term) so the outgoing card clears the incoming one mid-transition, then
            // accelerates (squared term) like a real fall.
            const u = Math.min(-d, 1);
            const e = easeIn(u);
            rotateX = FALL_TILT * e;
            scale = 1 + 0.04 * e;
            y = size * (1.1 * u + 0.9 * e);
            opacity = 1 - Math.pow(u, 3);
            z = 200;
        }

        card.style.transform = `translate3d(0, ${y.toFixed(2)}px, 0) rotateX(${rotateX.toFixed(2)}deg) scale(${scale.toFixed(4)})`;
        card.style.opacity = opacity.toFixed(3);
        card.style.zIndex = z;
        card.style.visibility = opacity <= 0.01 ? "hidden" : "visible";
    }

    let active = -1;

    function render(p) {
        cards.forEach((card, i) => placeCard(card, i - p));

        const progress = p / (total - 1);
        fill.style.height = (progress * 100).toFixed(3) + "%";
        dot.style.top = (progress * 100).toFixed(3) + "%";

        const index = clamp(Math.round(p), 0, total - 1);
        if (index !== active) {
            active = index;
            counter.textContent = String(index + 1).padStart(2, "0");
            if (ctaTitle) ctaTitle.textContent = cards[index].dataset.title;
            // Only the front card is in the tab order; the rest are reachable by scrolling.
            cards.forEach((card, i) => {
                card.tabIndex = i === index ? 0 : -1;
                card.setAttribute("aria-hidden", i === index ? "false" : "true");
            });
        }
    }

    /* ---------- Scroll → position, eased ---------- */
    let target = 0;
    let current = 0;

    const trigger = ScrollTrigger.create({
        trigger: section,
        start: "top top",
        end: () => "+=" + window.innerHeight * 0.75 * (total - 1),
        pin: true,
        anticipatePin: 1,
        invalidateOnRefresh: true,
        onUpdate: self => { target = self.progress * (total - 1); },
        onRefresh: () => { size = stage.offsetWidth; },
    });

    gsap.ticker.add((time, deltaTime) => {
        if (Math.abs(target - current) < 0.0005) {
            if (current !== target) { current = target; render(current); }
            return;
        }
        // Frame-rate independent ease toward the scroll position.
        current += (target - current) * (1 - Math.exp(-deltaTime / 110));
        render(current);
    });

    target = current = trigger.progress * (total - 1);
    render(current);
    section.classList.add("is-ready");

    // Scroll position at which card i is the active one.
    function scrollFor(i) {
        return trigger.start + (trigger.end - trigger.start) * (i / (total - 1));
    }

    cards.forEach((card, i) => {
        card.addEventListener("click", () => {
            if (i === active) openModal(card);
            else window.scrollTo({ top: scrollFor(i), behavior: "smooth" });
        });
    });

    if (cta) cta.addEventListener("click", () => openModal(cards[active]));
})();
