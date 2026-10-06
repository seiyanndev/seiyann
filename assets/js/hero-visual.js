/**
 * Homepage hero visual: construction lines + auto-playing brutalist slideshow.
 *
 * - Intro: the lines draw themselves in, then the cards rise and rotate into place.
 * - Slideshow: every SLIDE_DURATION seconds the front card swings out and the next one
 *   comes forward. The active dot fills up as the countdown. Click a card or a dot to
 *   change slides. Autoplay pauses while hovered/focused or scrolled off-screen.
 * - Desktop with a mouse: the cards and lines drift/tilt with the cursor for depth.
 * - Reduced motion: no intro or autoplay; dots and cards still switch slides instantly.
 */
(function () {
    const visual = document.getElementById("hero-visual");
    if (!visual) return;
    if (!window.gsap) {
        visual.classList.add("is-ready");
        return;
    }

    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const SLIDE_DURATION = 5; // seconds each slide stays in front

    const stage = visual.querySelector(".hero-stage");
    const lines = visual.querySelector(".hero-lines");
    const cards = gsap.utils.toArray(visual.querySelectorAll(".hero-card"));
    const dots = gsap.utils.toArray(visual.querySelectorAll(".hero-dot"));
    const caption = {
        el: visual.querySelector(".hero-caption"),
        index: visual.querySelector(".hero-caption-index"),
        place: visual.querySelector(".hero-caption-place"),
        credit: visual.querySelector(".hero-caption-credit"),
    };
    const veil = card => card.querySelector(".hero-card-veil");
    const total = cards.length;
    if (!total) return;

    // Where a card sits depending on its distance from the current slide.
    const SLOTS = {
        front:  { xPercent: 0,  yPercent: 0, rotation: 12, scale: 1,    autoAlpha: 1, zIndex: 3, veil: 0 },
        back:   { xPercent: 44, yPercent: 4, rotation: 5,  scale: 0.84, autoAlpha: 1, zIndex: 2, veil: 0.25 },
        hidden: { xPercent: 58, yPercent: 7, rotation: 2,  scale: 0.76, autoAlpha: 0, zIndex: 1, veil: 0.25 },
    };
    const EXIT = { xPercent: -55, yPercent: 16, rotation: -8, scale: 0.92, autoAlpha: 0 };

    let current = 0;
    let transition = null;   // running slide-change timeline
    let countdown = null;    // active dot fill; its onComplete advances the slideshow
    let hovered = false;
    let onScreen = true;

    function slotName(i) {
        const distance = (i - current + total) % total;
        return distance === 0 ? "front" : distance === 1 ? "back" : "hidden";
    }

    function cardProps(slot) {
        const { veil: _veil, zIndex: _z, ...props } = SLOTS[slot];
        return props;
    }

    function placeAll() {
        cards.forEach((card, i) => {
            const slot = slotName(i);
            gsap.set(card, { ...cardProps(slot), zIndex: SLOTS[slot].zIndex });
            gsap.set(veil(card), { opacity: SLOTS[slot].veil });
        });
    }

    function updateCaption() {
        const card = cards[current];
        caption.index.textContent = String(current + 1).padStart(2, "0") + " / " + String(total).padStart(2, "0");
        caption.place.textContent = card.dataset.place;
        caption.credit.textContent = card.dataset.photographer;
    }

    function updateDots() {
        dots.forEach((dot, i) => {
            dot.setAttribute("aria-current", i === current ? "true" : "false");
            gsap.set(dot.querySelector(".hero-dot-fill"), { scaleY: 0 });
        });
        cards.forEach((card, i) => card.setAttribute("aria-hidden", i === current ? "false" : "true"));
    }

    /* ---------- Autoplay countdown ---------- */
    function startCountdown() {
        if (countdown) countdown.kill();
        if (reduceMotion || total < 2) return;
        countdown = gsap.fromTo(dots[current].querySelector(".hero-dot-fill"),
            { scaleY: 0 },
            { scaleY: 1, duration: SLIDE_DURATION, ease: "none", onComplete: () => goTo(current + 1) });
        syncPause();
    }

    function syncPause() {
        if (!countdown) return;
        countdown.paused(hovered || !onScreen);
    }

    /* ---------- Slide change ---------- */
    function goTo(index) {
        index = (index + total) % total;
        if (index === current) return;

        if (transition) transition.progress(1); // finish any change in progress instantly
        if (countdown) countdown.kill();

        const outgoing = cards[current];
        current = index;
        updateDots();

        if (reduceMotion) {
            placeAll();
            updateCaption();
            return;
        }

        transition = gsap.timeline({
            defaults: { ease: "power3.inOut" },
            onComplete: () => { transition = null; startCountdown(); },
        });

        // Outgoing card swings out on top of the others...
        transition.set(outgoing, { zIndex: 4 }, 0)
            .to(outgoing, { ...EXIT, duration: 0.75, ease: "power3.in" }, 0);

        // ...while every other card moves up one slot.
        cards.forEach((card, i) => {
            if (card === outgoing) return;
            const slot = slotName(i);
            transition.set(card, { zIndex: SLOTS[slot].zIndex }, 0.2)
                .to(card, { ...cardProps(slot), duration: 1.05 }, 0.2)
                .to(veil(card), { opacity: SLOTS[slot].veil, duration: 1.05 }, 0.2);
        });

        // Caption swaps while the cards cross (opacity only: its tilt comes from CSS).
        transition.to(caption.el, { autoAlpha: 0, duration: 0.25, ease: "power2.in" }, 0.15)
            .add(updateCaption)
            .to(caption.el, { autoAlpha: 1, duration: 0.4, ease: "power2.out" });

        // The outgoing card rejoins the back of the stack, out of sight.
        const outgoingIndex = cards.indexOf(outgoing);
        transition.add(() => {
            const slot = slotName(outgoingIndex);
            gsap.set(outgoing, { ...cardProps(slot), zIndex: SLOTS[slot].zIndex });
            gsap.set(veil(outgoing), { opacity: SLOTS[slot].veil });
        }, 1.25);
    }

    cards.forEach(card => card.addEventListener("click", () => goTo(current + 1)));
    dots.forEach((dot, i) => dot.addEventListener("click", () => goTo(i)));

    // Pause while the visitor is looking at/interacting with it.
    visual.addEventListener("pointerenter", e => { if (e.pointerType === "mouse") { hovered = true; syncPause(); } });
    visual.addEventListener("pointerleave", e => { if (e.pointerType === "mouse") { hovered = false; syncPause(); } });
    visual.addEventListener("focusin", () => { hovered = true; syncPause(); });
    visual.addEventListener("focusout", () => { hovered = false; syncPause(); });

    // Pause when scrolled out of view (e.g. below the text on phones).
    if (window.ScrollTrigger) {
        ScrollTrigger.create({
            trigger: visual,
            start: "top bottom",
            end: "bottom top",
            onToggle: self => { onScreen = self.isActive; syncPause(); },
        });
    }

    /* ---------- Mouse depth (desktop with a mouse only) ---------- */
    gsap.matchMedia().add("(min-width: 1280px) and (pointer: fine) and (prefers-reduced-motion: no-preference)", () => {
        const stageX = gsap.quickTo(stage, "x", { duration: 0.8, ease: "power3.out" });
        const stageY = gsap.quickTo(stage, "y", { duration: 0.8, ease: "power3.out" });
        const stageRotY = gsap.quickTo(stage, "rotationY", { duration: 0.8, ease: "power3.out" });
        const stageRotX = gsap.quickTo(stage, "rotationX", { duration: 0.8, ease: "power3.out" });
        const linesX = gsap.quickTo(lines, "x", { duration: 1.2, ease: "power3.out" });
        const linesY = gsap.quickTo(lines, "y", { duration: 1.2, ease: "power3.out" });

        function onMove(e) {
            const nx = e.clientX / window.innerWidth * 2 - 1;  // -1 (left) .. 1 (right)
            const ny = e.clientY / window.innerHeight * 2 - 1; // -1 (top) .. 1 (bottom)
            stageX(nx * 22);
            stageY(ny * 16);
            stageRotY(nx * 7);
            stageRotX(-ny * 5);
            linesX(nx * -10);
            linesY(ny * -8);
        }
        window.addEventListener("pointermove", onMove);
        return () => {
            window.removeEventListener("pointermove", onMove);
            gsap.set([stage, lines], { x: 0, y: 0, rotationX: 0, rotationY: 0 });
        };
    });

    /* ---------- Intro ---------- */
    placeAll();
    updateCaption();
    updateDots();

    const drawn = visual.querySelectorAll(".hero-lines .draw");
    const markers = visual.querySelectorAll(".hero-lines rect");

    if (reduceMotion) {
        gsap.set(drawn, { strokeDashoffset: 0 });
        visual.classList.add("is-ready");
        return;
    }

    const front = cards[0];
    const back = cards[1 % total];
    gsap.set(drawn, { strokeDashoffset: 1 });
    gsap.set(markers, { scale: 0, transformOrigin: "50% 50%" });
    gsap.set([caption.el, ...dots], { autoAlpha: 0 });
    visual.classList.add("is-ready");

    gsap.timeline({ delay: 0.35, onComplete: startCountdown })
        .to(drawn, { strokeDashoffset: 0, duration: 1.4, stagger: 0.12, ease: "power2.inOut" }, 0)
        .from(back !== front ? [back, front] : [front], {
            yPercent: "+=30",
            rotation: 0,
            autoAlpha: 0,
            duration: 1.2,
            stagger: 0.15,
            ease: "expo.out",
        }, 0.3)
        .to(markers, { scale: 1, duration: 0.5, stagger: 0.08, ease: "back.out(3)" }, 0.9)
        .to([caption.el, ...dots], { autoAlpha: 1, duration: 0.5, stagger: 0.06 }, 1.1);
})();
