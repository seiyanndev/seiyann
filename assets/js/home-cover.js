/**
 * Homepage cover sheet (front-page.php), alongside hero-headline.js and hero-visual.js.
 *
 *  - "Open to work" stamp: thuds down once the headline has faded in.
 *  - Contents index: the rows rule in one by one the first time they scroll into view.
 * Reduced motion (or no GSAP): the stamp just appears; rows are shown as-is.
 */
(function () {
    const stamp = document.getElementById("cover-stamp");
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    if (!window.gsap || reduceMotion) {
        if (stamp) stamp.classList.add("is-in");
        return;
    }

    /* ---------- Stamp ---------- */
    if (stamp) {
        gsap.set(stamp, { autoAlpha: 0, scale: 2.4, rotation: -2 });
        stamp.classList.add("is-in");
        gsap.timeline({ delay: 1.1 })
            .to(stamp, { autoAlpha: 0.9, scale: 1, rotation: -8, duration: 0.22, ease: "power4.in" })
            .to(stamp, { x: 2, duration: 0.05, repeat: 3, yoyo: true, ease: "power1.inOut" })
            .set(stamp, { x: 0 });
    }

    /* ---------- Contents rows ---------- */
    const rows = document.querySelectorAll(".contents-list li");
    if (rows.length && window.ScrollTrigger) {
        gsap.set(rows, { autoAlpha: 0, y: 24 });
        gsap.to(rows, {
            autoAlpha: 1,
            y: 0,
            duration: 0.7,
            stagger: 0.09,
            ease: "power3.out",
            scrollTrigger: { trigger: ".contents-list", start: "top 85%", once: true },
        });
    }
})();
