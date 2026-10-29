"use client";

import { useEffect } from "react";
import { gsap, prefersReducedMotion } from "@/lib/gsap";

/**
 * Contact page (app/contact/page.tsx).
 *
 *  - Live local time in Lucena (Asia/Manila), updated every 30 seconds.
 *  - Copy-email button: copies the address and flashes "Copied".
 *  - Stamp submit: once the browser's required-field checks pass, the stamp presses down, the form
 *    is sent to Web3Forms in the background, and a RECEIVED / RETURNED stamp lands on the form.
 *    The access key comes from NEXT_PUBLIC_WEB3FORMS_KEY (set it in Vercel; see .env.example).
 *  - Intro: title lines rise, the card and form sheet drop in, the form's tape slaps on.
 * Reduced motion: no intro; everything else still works.
 */
export default function ContactMotion() {
  useEffect(() => {
    const main = document.querySelector<HTMLElement>(".contact");
    if (!main) return;

    const reduceMotion = prefersReducedMotion();
    const cleanups: Array<() => void> = [];
    const timers: Array<ReturnType<typeof setTimeout>> = [];
    const listen = (el: EventTarget, type: string, fn: EventListener) => {
      el.addEventListener(type, fn);
      cleanups.push(() => el.removeEventListener(type, fn));
    };
    const ctx = gsap.context(() => {});

    /* ---------- Local time ---------- */
    const clock = main.querySelector<HTMLElement>(".ct-clock");
    if (clock && window.Intl) {
      const format = new Intl.DateTimeFormat("en-US", { timeZone: clock.dataset.tz, hour: "numeric", minute: "2-digit" });
      const tick = () => { clock.textContent = format.format(new Date()); };
      tick();
      const interval = setInterval(tick, 30000);
      cleanups.push(() => clearInterval(interval));
    }

    /* ---------- Copy email ---------- */
    const copyBtn = main.querySelector<HTMLElement>(".ct-copy");
    if (copyBtn) {
      const label = copyBtn.querySelector(".ct-copy-label")!;
      listen(copyBtn, "click", async () => {
        const text = copyBtn.dataset.copy || "";
        try {
          await navigator.clipboard.writeText(text);
        } catch {
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
        timers.push(setTimeout(() => { copyBtn.classList.remove("is-copied"); label.textContent = "Copy"; }, 1800));
      });
    }

    /* ---------- Stamp submit ---------- */
    const form = main.querySelector<HTMLFormElement>("#req-form");
    const stamp = main.querySelector<HTMLButtonElement>("#req-submit");
    const live = main.querySelector<HTMLElement>("#req-live");
    const ownerEmail = form ? form.dataset.email || "" : "";

    // Press the stamp (skipped with reduced motion), then run `next`.
    function pressStamp(next: () => void) {
      if (reduceMotion || !stamp) { next(); return; }
      ctx.add(() => {
        gsap.timeline({ onComplete: next })
          .to(stamp, { scale: 0.86, rotation: -6, duration: 0.12, ease: "power4.in" })
          .to(stamp, { scale: 1, rotation: -4, duration: 0.25, ease: "back.out(3)" });
      });
    }

    // RECEIVED / RETURNED panel (same markup and styles as the WordPress theme's).
    function showResult(ok: boolean, detail?: string) {
      if (!form || !live) return;
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
          form.querySelector<HTMLElement>("input:not([type=hidden]):not([name=botcheck])")?.focus();
        });
        panel.append(again);
        form.hidden = true;
      }

      live.innerHTML = "";
      live.append(panel);
      if (!reduceMotion) {
        ctx.add(() => {
          gsap.fromTo(stampEl, { autoAlpha: 0, scale: 2.2 }, { autoAlpha: 1, scale: 1, duration: 0.22, ease: "power4.in" });
        });
      }
      panel.scrollIntoView({ behavior: reduceMotion ? "auto" : "smooth", block: "nearest" });
    }

    async function sendWithWeb3Forms() {
      if (!form || !stamp) return;
      const data = new FormData(form);
      const regarding = (data.get("contact_subject") as string) || "General Inquiry";

      try {
        // Honeypot ticked: a bot. Pretend it worked and send nothing.
        if (data.get("botcheck")) { showResult(true); return; }

        // Read at submit time; inlined into the bundle at build time by Next.js.
        const accessKey = process.env.NEXT_PUBLIC_WEB3FORMS_KEY;
        if (!accessKey) {
          console.error("Contact form: NEXT_PUBLIC_WEB3FORMS_KEY is not set, so the request was not sent.");
          showResult(false);
          return;
        }

        const response = await fetch("https://api.web3forms.com/submit", {
          method: "POST",
          headers: { "Content-Type": "application/json", Accept: "application/json" },
          body: JSON.stringify({
            access_key: accessKey,
            subject: "New Portfolio Message: " + regarding,
            from_name: "Portfolio contact form",
            name: data.get("contact_name"),
            email: data.get("contact_email"), // Web3Forms uses this as the reply-to
            regarding: regarding,
            message: data.get("contact_message"),
            botcheck: false,
          }),
        });
        const result = await response.json().catch(() => ({}));
        showResult(response.ok && result.success === true);
      } catch {
        showResult(false, "The connection failed.");
      } finally {
        stamp.disabled = false;
      }
    }

    if (form && stamp) {
      listen(form, "submit", (e) => {
        // The browser has already checked the required fields.
        e.preventDefault();
        stamp.disabled = true;
        pressStamp(sendWithWeb3Forms);
      });
    }

    /* ---------- Intro ---------- */
    if (reduceMotion) {
      main.classList.add("is-ready");
    } else {
      ctx.add(() => {
        const lines = main.querySelectorAll(".ct-line > span");
        const rest = main.querySelectorAll(".ct-eyebrow, .ct-lede");
        const card = main.querySelector(".ct-card");
        const sheet = main.querySelector(".req");
        const tape = main.querySelector(".req-tape");

        gsap.set(lines, { yPercent: 110 });
        gsap.set(rest, { autoAlpha: 0, y: 16 });
        gsap.set(card, { autoAlpha: 0, y: 50, rotation: -5 });
        gsap.set(sheet, { autoAlpha: 0, y: 70, rotation: 3 });
        gsap.set(tape, { autoAlpha: 0, y: -18, scale: 1.3 });
        main.classList.add("is-ready");

        gsap.timeline({ delay: 0.15 })
          .to(lines, { yPercent: 0, duration: 1, stagger: 0.1, ease: "expo.out" }, 0)
          .to(rest, { autoAlpha: 1, y: 0, duration: 0.7, stagger: 0.1, ease: "power3.out" }, 0.2)
          .to(card, { autoAlpha: 1, y: 0, rotation: -1.2, duration: 0.9, ease: "back.out(1.3)" }, 0.35)
          .to(sheet, { autoAlpha: 1, y: 0, rotation: 0.5, duration: 0.9, ease: "back.out(1.2)" }, 0.5)
          .to(tape, { autoAlpha: 1, y: 0, scale: 1, duration: 0.25, ease: "power4.in" }, 1.1);
      });
    }

    return () => {
      cleanups.forEach((fn) => fn());
      timers.forEach(clearTimeout);
      ctx.revert();
      main.classList.remove("is-ready");
      if (live) live.innerHTML = "";
      if (form) form.hidden = false;
      if (stamp) stamp.disabled = false;
    };
  }, []);

  return null;
}
