/**
 * Homepage headline: per-word font glitch.
 *
 * Hovering a word (mouse/pen) or tapping it (touch) makes its letters flicker through
 * contrasting typefaces with a little jitter, then settle back to Montserrat left to right.
 * The glitch fonts are subset to the headline's characters in functions.php and preloaded
 * here, so the first hover already shows the real fonts.
 */
(function () {
    const headline = document.getElementById("hero-headline");
    if (!headline || !window.gsap || !window.SplitText) return;
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

    // `scale` evens out how big each face looks next to Montserrat Bold.
    const FONTS = [
        { family: '"Playfair Display", serif',         style: "italic", weight: 700, scale: 1 },
        { family: '"Space Mono", monospace',           style: "normal", weight: 700, scale: 0.9 },
        { family: '"UnifrakturMaguntia", serif',       style: "normal", weight: 400, scale: 1 },
        { family: '"Bebas Neue", sans-serif',          style: "normal", weight: 400, scale: 1.1 },
        { family: '"Bungee", sans-serif',              style: "normal", weight: 400, scale: 0.8 },
        { family: '"Pacifico", cursive',               style: "normal", weight: 400, scale: 0.85 },
        { family: '"Major Mono Display", monospace',   style: "normal", weight: 400, scale: 0.85 },
    ];

    const SWAP_DURATION = 0.06; // seconds per font swap (~16 swaps/sec)
    const BASE_SWAPS = 5;       // swaps for a word's first letter...
    const MAX_EXTRA_SWAPS = 8;  // ...each later letter swaps once more, so the word settles left to right

    // Start downloading the glitch fonts now rather than on first hover.
    const glyphs = headline.textContent.replace(/\s+/g, "");
    FONTS.forEach(f => document.fonts.load(`${f.style} ${f.weight} 1em ${f.family}`, glyphs).catch(() => {}));

    // Split only after Montserrat has loaded, so the letter widths we lock are the real ones.
    document.fonts.ready.then(function () {
        const split = SplitText.create(headline, {
            type: "words,chars",
            wordsClass: "hero-word",
            charsClass: "hero-char",
        });

        // Centre swapped glyphs in their box so wide fonts spill evenly on both sides.
        split.chars.forEach(char => { char.style.display = "inline-flex"; });

        function isGlitching() {
            return split.words.some(w => w.classList.contains("is-glitching"));
        }

        // Fix each letter's box to its Montserrat width so swaps never reflow the line.
        function lockWidths() {
            if (isGlitching()) {
                setTimeout(lockWidths, 200);
                return;
            }
            split.chars.forEach(c => { c.style.width = ""; });
            const widths = split.chars.map(c => c.getBoundingClientRect().width);
            split.chars.forEach((c, i) => { c.style.width = widths[i] + "px"; });
        }
        lockWidths();

        let resizeTimer;
        window.addEventListener("resize", function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(lockWidths, 150);
        });

        function applyRandomFont(char, previousIndex) {
            let index;
            do {
                index = Math.floor(Math.random() * FONTS.length);
            } while (index === previousIndex);

            const font = FONTS[index];
            char.style.fontFamily = font.family;
            char.style.fontStyle = font.style;
            char.style.fontWeight = font.weight;
            gsap.set(char, { scale: font.scale });
            return index;
        }

        function resetFont(char) {
            char.style.fontFamily = "";
            char.style.fontStyle = "";
            char.style.fontWeight = "";
        }

        function glitch(word) {
            if (word.classList.contains("is-glitching")) return;
            word.classList.add("is-glitching");

            const chars = Array.from(word.querySelectorAll(".hero-char"));
            let unsettled = chars.length;

            chars.forEach((char, i) => {
                let fontIndex = -1;
                const swap = () => { fontIndex = applyRandomFont(char, fontIndex); };

                gsap.to(char, {
                    duration: SWAP_DURATION,
                    repeat: BASE_SWAPS + Math.min(i, MAX_EXTRA_SWAPS),
                    repeatRefresh: true,
                    ease: "none",
                    x: () => gsap.utils.random(-3, 3),
                    y: () => gsap.utils.random(-4, 4),
                    skewX: () => gsap.utils.random(-14, 14),
                    onStart: swap,
                    onRepeat: swap,
                    onComplete: () => {
                        resetFont(char);
                        gsap.to(char, { x: 0, y: 0, skewX: 0, scale: 1, duration: 0.35, ease: "back.out(3)" });
                        if (--unsettled === 0) word.classList.remove("is-glitching");
                    },
                });
            });
        }

        split.words.forEach(word => {
            // Mouse/pen: trigger on hover. Touch: trigger on tap (touch also fires pointerenter, so filter it out).
            word.addEventListener("pointerenter", e => { if (e.pointerType !== "touch") glitch(word); });
            word.addEventListener("pointerdown", e => { if (e.pointerType === "touch") glitch(word); });
        });
    });
})();
