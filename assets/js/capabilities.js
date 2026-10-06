/**
 * Capabilities page.
 *
 * 1. Lens: the section is pinned and one timeline is scrubbed by scroll. The timeline runs from
 *    0 to 4, one unit per capability:
 *      0–1  Brand        construction lines draw, the "KA" monogram sets in
 *      1–2  UI/UX        the mark hands off to a browser frame; wireframe blocks resolve into the real page
 *      2–3  Development  the frame steps aside and its code types out next to it
 *      3–4  End-to-end   the code closes, a cursor clicks the button, the page goes live
 *    The step list on the left follows the timeline; clicking a step scrolls to that stage.
 * 2. Proof matrix: hovering/focusing a capability lights up the projects that use it; rows link to
 *    the project on the Work page.
 *
 * With reduced motion the lens is not pinned and shows its finished state.
 */
(function () {
    /* ================= 1. Lens ================= */
    const section = document.getElementById("lens");
    const canvas = document.getElementById("lens-canvas");
    const steps = Array.from(document.querySelectorAll(".lens-step"));
    const progressFill = document.getElementById("lens-progress-fill");
    const STAGES = 4;

    if (section && canvas && window.gsap) {
        const q = sel => canvas.querySelectorAll(sel);
        const brand = canvas.querySelector(".lens-brand");
        const construct = q(".lens-construct circle, .lens-construct line");
        const mono = canvas.querySelector(".lens-mono");
        const labels = canvas.querySelector(".lens-brand-labels");
        const frame = canvas.querySelector(".lens-frame");
        const skels = q(".lens-skel");
        const reals = q(".lens-real");
        const button = canvas.querySelector(".lens-ui-btn");
        const cursor = canvas.querySelector(".lens-cursor");
        const live = canvas.querySelector(".lens-live");
        const toast = canvas.querySelector(".lens-toast");
        const code = canvas.querySelector(".lens-code");
        const codeLines = q(".lens-line");

        // Cursor positions inside the frame (offsetLeft/Top ignore transforms, so these stay valid
        // while the frame is scaled). Function values are re-read when ScrollTrigger refreshes.
        const cursorStart = { left: () => frame.offsetWidth * 0.86, top: () => frame.offsetHeight * 0.92 };
        const cursorOnButton = {
            left: () => button.offsetLeft + button.offsetWidth * 0.62,
            top: () => button.offsetTop + button.offsetHeight * 0.55,
        };

        // Starting state of every layer.
        gsap.set(construct, { strokeDashoffset: 1 });
        gsap.set([mono, labels], { autoAlpha: 0 });
        gsap.set(mono, { y: 18 });
        gsap.set(frame, { autoAlpha: 0, scale: 0.92 });
        gsap.set(skels, { scaleX: 0 });
        gsap.set(reals, { opacity: 0 });
        gsap.set([live, toast], { autoAlpha: 0 });
        gsap.set(toast, { y: 10 });
        gsap.set(cursor, { autoAlpha: 0, ...cursorStart });
        gsap.set(code, { autoAlpha: 0, xPercent: 12 });
        gsap.set(codeLines, { clipPath: "inset(0 100% 0 0)" });

        const tl = gsap.timeline({ defaults: { ease: "power2.inOut" } })
            // 01 Brand
            .to(construct, { strokeDashoffset: 0, duration: 0.45, stagger: 0.05, ease: "power1.inOut" }, 0.02)
            .to(labels, { autoAlpha: 1, duration: 0.15 }, 0.3)
            .to(mono, { autoAlpha: 1, y: 0, duration: 0.3, ease: "power2.out" }, 0.42)

            // Hand-off: the mark shrinks toward the frame's logo spot as the frame arrives
            .to(brand, { scale: 0.16, xPercent: -42, yPercent: -30, autoAlpha: 0, duration: 0.4 }, 0.85)
            .to(frame, { autoAlpha: 1, scale: 1, duration: 0.35, ease: "power2.out" }, 1.0)

            // 02 UI/UX: wireframe blocks appear, then resolve into the designed page (done by ~1.9)
            .to(skels, { scaleX: 1, duration: 0.2, stagger: 0.015, ease: "power2.out" }, 1.1)
            .to(skels, { autoAlpha: 0, duration: 0.16, stagger: 0.02 }, 1.5)
            .to(reals, { opacity: 1, duration: 0.16, stagger: 0.02 }, 1.52)

            // 03 Development: frame steps aside, code types out line by line
            // Frame (4%-74% of the canvas) + code panel (44%-96%) form one centred pair.
            .to(frame, { xPercent: -12, scale: 0.74, duration: 0.35 }, 2.0)
            .to(code, { autoAlpha: 1, xPercent: 0, duration: 0.3, ease: "power2.out" }, 2.1)
            .to(codeLines, { clipPath: "inset(0 0% 0 0)", duration: 0.12, stagger: 0.045, ease: "none" }, 2.28)

            // 04 End-to-end: code closes, the page comes back, a click ships it
            .to(code, { autoAlpha: 0, xPercent: 12, duration: 0.25, ease: "power2.in" }, 3.0)
            .to(frame, { xPercent: 0, scale: 1, duration: 0.3 }, 3.05)
            .to(cursor, { autoAlpha: 1, duration: 0.1 }, 3.3)
            .to(cursor, { ...cursorOnButton, duration: 0.3, ease: "power2.out" }, 3.3)
            .to(button, { scale: 0.93, duration: 0.05, ease: "power1.in" }, 3.62)
            .to(button, { scale: 1, duration: 0.08, ease: "back.out(3)" }, 3.67)
            .to(live, { autoAlpha: 1, duration: 0.1 }, 3.7)
            .to(toast, { autoAlpha: 1, y: 0, duration: 0.15, ease: "power2.out" }, 3.75)
            .to({}, { duration: 0.1 }, 3.9); // hold the finished state for a moment before unpinning

        // Exhibit caption ("Exhibit A-02 · UI/UX Design") follows the current stage.
        const exhibitNum = document.getElementById("lens-exhibit-num");
        const exhibitLabel = document.getElementById("lens-exhibit-label");
        const stepTitles = steps.map(step => step.querySelector(".lens-step-title").textContent);

        let activeStep = 0;
        function setStep(index) {
            if (index === activeStep) return;
            activeStep = index;
            steps.forEach((step, i) => step.classList.toggle("is-active", i === index));
            if (exhibitNum) exhibitNum.textContent = String(index + 1).padStart(2, "0");
            if (exhibitLabel) exhibitLabel.textContent = stepTitles[index];
        }

        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

        if (reduceMotion || !window.ScrollTrigger) {
            tl.progress(1);
            section.classList.add("lens--static", "is-ready");
        } else {
            const trigger = ScrollTrigger.create({
                trigger: section,
                start: "top top",
                end: () => "+=" + window.innerHeight * 3.2,
                pin: true,
                scrub: 0.6,
                animation: tl,
                anticipatePin: 1,
                invalidateOnRefresh: true,
                onUpdate: self => {
                    progressFill.style.width = (self.progress * 100).toFixed(2) + "%";
                    setStep(Math.min(STAGES - 1, Math.floor(tl.time() + 0.05)));
                },
            });

            // Clicking a step scrolls to the middle of its stage.
            steps.forEach((step, i) => {
                step.querySelector(".lens-step-head").addEventListener("click", () => {
                    const at = (i + 0.6) / tl.duration();
                    window.scrollTo({ top: trigger.start + (trigger.end - trigger.start) * at, behavior: "smooth" });
                });
            });

            section.classList.add("is-ready");
        }
    } else if (section) {
        section.classList.add("lens--static", "is-ready");
    }

    /* ================= 2. Proof matrix ================= */
    const table = document.getElementById("proof-table");
    if (!table) return;

    const rows = Array.from(table.querySelectorAll(".proof-row"));
    const capHeads = Array.from(table.querySelectorAll("thead .proof-cap"));

    function focusCapability(cap) {
        table.classList.toggle("has-focus", !!cap);
        capHeads.forEach(head => head.classList.toggle("is-lit", head.dataset.cap === cap));
        table.querySelectorAll(".proof-cell, .proof-count").forEach(cell => cell.classList.toggle("is-lit", cell.dataset.cap === cap));
        rows.forEach(row => row.classList.toggle("is-lit", !!cap && row.dataset.caps.split(" ").includes(cap)));
    }

    capHeads.forEach(head => {
        head.addEventListener("mouseenter", () => focusCapability(head.dataset.cap));
        head.addEventListener("focus", () => focusCapability(head.dataset.cap));
        head.addEventListener("mouseleave", () => focusCapability(null));
        head.addEventListener("blur", () => focusCapability(null));
        // Touch: tap a capability to toggle its focus.
        head.addEventListener("click", () => focusCapability(head.classList.contains("is-lit") ? null : head.dataset.cap));
    });

    // Hovering a project lights up the capabilities it demonstrates.
    rows.forEach(row => {
        const caps = row.dataset.caps.split(" ");
        row.addEventListener("mouseenter", () => {
            if (table.classList.contains("has-focus")) return;
            capHeads.forEach(head => head.classList.toggle("is-lit", caps.includes(head.dataset.cap)));
        });
        row.addEventListener("mouseleave", () => {
            if (!table.classList.contains("has-focus")) capHeads.forEach(head => head.classList.remove("is-lit"));
        });
        // The whole row opens the project (the name itself is a real link for keyboard/screen readers).
        row.addEventListener("click", e => {
            if (e.target.closest("a")) return;
            window.location.href = row.dataset.href;
        });
    });
})();
