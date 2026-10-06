/**
 * Contact page (page-contact.php).
 *
 *  - Live local time in Lucena (Asia/Manila), updated every minute.
 *  - Copy-email button: copies the address and flashes "Copied".
 *  - Stamp submit: once the browser's required-field checks pass, the stamp presses down,
 *    then the form submits normally to the existing mail handler.
 *  - Intro: title lines rise, the card and form sheet drop in, the form's tape slaps on.
 * Reduced motion (or no GSAP): no intro; everything else still works.
 */
(function () {
    const main = document.querySelector(".contact");
    if (!main) return;

    /* ---------- Local time ---------- */
    const clock = main.querySelector(".ct-clock");
    if (clock && window.Intl) {
        const format = new Intl.DateTimeFormat("en-US", { timeZone: clock.dataset.tz, hour: "numeric", minute: "2-digit" });
        const tick = () => { clock.textContent = format.format(new Date()); };
        tick();
        setInterval(tick, 30000);
    }

    /* ---------- Copy email ---------- */
    const copyBtn = main.querySelector(".ct-copy");
    if (copyBtn) {
        const label = copyBtn.querySelector(".ct-copy-label");
        copyBtn.addEventListener("click", async () => {
            const text = copyBtn.dataset.copy;
            try {
                await navigator.clipboard.writeText(text);
            } catch (e) {
                // Fallback for browsers/contexts without the async clipboard API.
                const field = document.createElement("textarea");
                field.value = text;
                field.style.position = "fixed";
                field.style.opacity = "0";
                document.body.appendChild(field);
                field.select();
                document.execCommand("copy");
                field.remove();
            }
            copyBtn.classList.add("is-copied");
            label.textContent = "Copied";
            setTimeout(() => { copyBtn.classList.remove("is-copied"); label.textContent = "Copy"; }, 1800);
        });
    }

    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const hasGsap = !!window.gsap;

    /* ---------- Stamp submit ---------- */
    const form = main.querySelector("#req-form");
    const stamp = main.querySelector("#req-submit");
    if (form && stamp && hasGsap && !reduceMotion) {
        form.addEventListener("submit", e => {
            if (form.dataset.stamped) return; // second pass: let it submit
            e.preventDefault();
            stamp.disabled = true;
            gsap.timeline({
                onComplete: () => {
                    form.dataset.stamped = "1";
                    // requestSubmit keeps the native submit path; fall back to submit() in older browsers.
                    if (form.requestSubmit) form.requestSubmit(); else form.submit();
                },
            })
                .to(stamp, { scale: 0.86, rotation: -6, duration: 0.12, ease: "power4.in" })
                .to(stamp, { scale: 1, rotation: -4, duration: 0.25, ease: "back.out(3)" });
        });
    }

    /* ---------- Intro ---------- */
    if (reduceMotion || !hasGsap) {
        main.classList.add("is-ready");
        return;
    }

    const lines = main.querySelectorAll(".ct-line > span");
    const rest = main.querySelectorAll(".ct-eyebrow, .ct-lede");
    const card = main.querySelector(".ct-card");
    const sheet = main.querySelector(".req");
    const tape = main.querySelector(".req-tape");
    const resultStamp = main.querySelector(".req-result-stamp");

    gsap.set(lines, { yPercent: 110 });
    gsap.set(rest, { autoAlpha: 0, y: 16 });
    gsap.set(card, { autoAlpha: 0, y: 50, rotation: -5 });
    gsap.set(sheet, { autoAlpha: 0, y: 70, rotation: 3 });
    gsap.set(tape, { autoAlpha: 0, y: -18, scale: 1.3 });
    if (resultStamp) gsap.set(resultStamp, { autoAlpha: 0, scale: 2.2 });
    main.classList.add("is-ready");

    const tl = gsap.timeline({ delay: 0.15 })
        .to(lines, { yPercent: 0, duration: 1, stagger: 0.1, ease: "expo.out" }, 0)
        .to(rest, { autoAlpha: 1, y: 0, duration: 0.7, stagger: 0.1, ease: "power3.out" }, 0.2)
        .to(card, { autoAlpha: 1, y: 0, rotation: -1.2, duration: 0.9, ease: "back.out(1.3)" }, 0.35)
        .to(sheet, { autoAlpha: 1, y: 0, rotation: 0.5, duration: 0.9, ease: "back.out(1.2)" }, 0.5)
        .to(tape, { autoAlpha: 1, y: 0, scale: 1, duration: 0.25, ease: "power4.in" }, 1.1);

    // After a submission, the RECEIVED / RETURNED stamp thuds onto the form. (GSAP reads the stamp's
    // CSS tilt/centring when it first touches it and keeps them; only the scale is animated.)
    if (resultStamp) {
        tl.to(resultStamp, { autoAlpha: 1, scale: 1, duration: 0.22, ease: "power4.in" }, 1.35)
          .to(sheet, { x: 3, duration: 0.05, repeat: 3, yoyo: true }, 1.57)
          .set(sheet, { x: 0 }, 1.77);
    }
})();
