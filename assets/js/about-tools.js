/**
 * About page "toolbox" tapes.
 *
 * Each tape's track holds one set of tools; it's cloned until it can cover the screen twice, then
 * moved sideways every frame and wrapped by one set's width, so the loop is seamless.
 *  - The ink and paper tapes run in opposite directions (data-dir).
 *  - Scrolling the page gives both a burst of speed, and scrolling up flips their direction.
 *  - Hovering a tape eases it to a stop so a chip can be read (and fill with its brand colour).
 * Reduced motion: the tapes stay still.
 */
(function () {
    const tapes = Array.from(document.querySelectorAll(".tape"));
    if (!tapes.length || !window.gsap) return;
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

    const BASE_SPEED = 45;  // px per second at rest
    const MAX_BOOST = 6;    // scroll can speed the tapes up to 1 + 6 = 7x

    const states = tapes.map(tape => {
        const track = tape.querySelector(".tape-track");
        const set = track.querySelector(".tape-set");

        // Clone the set until the track is at least one screen plus one set wide.
        while (track.scrollWidth < window.innerWidth * 1.3 + set.offsetWidth) {
            const copy = set.cloneNode(true);
            copy.setAttribute("aria-hidden", "true");
            track.appendChild(copy);
        }

        const state = {
            tape,
            track,
            set,
            dir: parseFloat(tape.dataset.dir) || -1,
            x: 0,
            setWidth: set.offsetWidth,
            factor: 1,   // eased toward 0 while hovered
            hovered: false,
        };

        tape.addEventListener("pointerenter", e => { if (e.pointerType === "mouse") state.hovered = true; });
        tape.addEventListener("pointerleave", () => { state.hovered = false; });
        return state;
    });

    // Scroll gives a decaying speed boost; its direction sets which way the tapes run.
    let boost = 0;
    let scrollDir = 1;
    let lastY = window.scrollY;
    window.addEventListener("scroll", () => {
        const delta = window.scrollY - lastY;
        lastY = window.scrollY;
        if (delta !== 0) scrollDir = delta > 0 ? 1 : -1;
        boost = Math.min(MAX_BOOST, boost + Math.abs(delta) * 0.04);
    }, { passive: true });

    window.addEventListener("resize", () => {
        states.forEach(s => { s.setWidth = s.set.offsetWidth; });
    });

    gsap.ticker.add((time, deltaTime) => {
        const dt = Math.min(deltaTime, 64) / 1000;
        boost *= Math.pow(0.04, dt); // decays to ~4% per second

        states.forEach(s => {
            s.factor += ((s.hovered ? 0 : 1) - s.factor) * Math.min(1, dt * 8);
            s.x += BASE_SPEED * (1 + boost) * s.dir * scrollDir * s.factor * dt;

            // Wrap by one set's width so the loop never shows a gap.
            if (s.x <= -s.setWidth) s.x += s.setWidth;
            if (s.x > 0) s.x -= s.setWidth;
            s.track.style.transform = `translate3d(${s.x.toFixed(2)}px, 0, 0)`;
        });
    });
})();
