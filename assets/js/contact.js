/**
 * Contact page (page-contact.php).
 *
 *  - Live local time in Lucena (Asia/Manila), updated every minute.
 *  - Copy-email button: copies the address and flashes "Copied".
 *  - Stamp submit: once the browser's required-field checks pass, the stamp presses down, then:
 *      · with a Web3Forms key (data-web3forms-key, set in seiyann_contact()): the form is sent in the
 *        background and a RECEIVED / RETURNED stamp lands on the form, no page reload. This is what
 *        the static seiyann.dev site uses, since it has no PHP.
 *      · without a key (local WordPress): the form submits normally to the WordPress mail handler.
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
    const live = main.querySelector("#req-live");
    const web3formsKey = () => (form ? form.dataset.web3formsKey : ""); // read at submit time
    const ownerEmail = form ? form.dataset.email : "";

    // Press the stamp (skipped with reduced motion / no GSAP), then run `next`.
    function pressStamp(next) {
        if (!hasGsap || reduceMotion) { next(); return; }
        gsap.timeline({ onComplete: next })
            .to(stamp, { scale: 0.86, rotation: -6, duration: 0.12, ease: "power4.in" })
            .to(stamp, { scale: 1, rotation: -4, duration: 0.25, ease: "back.out(3)" });
    }

    // RECEIVED / RETURNED panel, same markup and styles as the server-rendered one.
    function showResult(ok, detail) {
        const panel = document.createElement("div");
        panel.className = "req-result " + (ok ? "is-received" : "is-returned");
        panel.setAttribute("role", ok ? "status" : "alert");

        const stampEl = document.createElement("span");
        stampEl.className = "req-result-stamp";
        stampEl.textContent = ok ? "Received" : "Returned";

        const title = document.createElement("p");
        title.className = "req-result-title";
        title.textContent = ok ? "Your request is on file." : "Your request couldn't be sent.";

        const text = document.createElement("p");
        text.className = "req-result-text";
        if (ok) {
            text.textContent = "Thanks for reaching out — I'll get back to you by email soon.";
        } else {
            text.append(document.createTextNode((detail ? detail + " " : "") + "Please try again, or email me directly at "));
            const mail = document.createElement("a");
            mail.href = "mailto:" + ownerEmail;
            mail.textContent = ownerEmail;
            text.append(mail, document.createTextNode("."));
        }
        panel.append(stampEl, title, text);

        if (ok) {
            const again = document.createElement("button");
            again.type = "button";
            again.className = "req-result-link";
            again.textContent = "File another request →";
            again.addEventListener("click", () => {
                live.innerHTML = "";
                form.reset();
                form.hidden = false;
                form.querySelector("input:not([type=hidden]):not([name=botcheck])").focus();
            });
            panel.append(again);
            form.hidden = true;
        }

        live.innerHTML = "";
        live.append(panel);
        if (hasGsap && !reduceMotion) {
            gsap.fromTo(stampEl, { autoAlpha: 0, scale: 2.2 }, { autoAlpha: 1, scale: 1, duration: 0.22, ease: "power4.in" });
        }
        panel.scrollIntoView({ behavior: reduceMotion ? "auto" : "smooth", block: "nearest" });
    }

    async function sendWithWeb3Forms() {
        const data = new FormData(form);
        const regarding = data.get("contact_subject") || "General Inquiry";

        // Honeypot ticked: a bot. Pretend it worked and send nothing.
        if (data.get("botcheck")) { showResult(true); return; }

        try {
            const response = await fetch("https://api.web3forms.com/submit", {
                method: "POST",
                headers: { "Content-Type": "application/json", Accept: "application/json" },
                body: JSON.stringify({
                    access_key: web3formsKey(),
                    subject: "New Portfolio Message: " + regarding, // same subject line as the WordPress handler
                    from_name: "seiyann.dev contact form",
                    name: data.get("contact_name"),
                    email: data.get("contact_email"),                // Web3Forms uses this as the reply-to
                    regarding: regarding,
                    message: data.get("contact_message"),
                    botcheck: false,
                }),
            });
            const result = await response.json().catch(() => ({}));
            showResult(response.ok && result.success === true);
        } catch (err) {
            showResult(false, "The connection failed.");
        } finally {
            stamp.disabled = false;
        }
    }

    if (form && stamp) {
        form.addEventListener("submit", e => {
            if (web3formsKey()) {
                // Background send (static site). The browser has already checked required fields.
                e.preventDefault();
                stamp.disabled = true;
                pressStamp(sendWithWeb3Forms);
                return;
            }
            // No key: normal POST to WordPress, after the stamp press.
            if (form.dataset.stamped || !hasGsap || reduceMotion) return;
            e.preventDefault();
            stamp.disabled = true;
            pressStamp(() => {
                form.dataset.stamped = "1";
                // requestSubmit keeps the native submit path; fall back to submit() in older browsers.
                if (form.requestSubmit) form.requestSubmit(); else form.submit();
            });
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
