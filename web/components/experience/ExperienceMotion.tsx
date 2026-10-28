"use client";

import { useEffect } from "react";
import { gsap, prefersReducedMotion } from "@/lib/gsap";

/**
 * Experience page motion (app/experience/page.tsx).
 *
 *  - Header: title lines rise from their masks, lede and summary strip fade up.
 *  - Each record, the first time it scrolls into view: the card slides up out of the file,
 *    the tape slaps on, the stamp thuds down (drops in large, lands with a small shake),
 *    and the duties type out line by line.
 *  - The year index highlights the record nearest the middle of the screen.
 * Reduced motion: everything is shown immediately; the index still tracks.
 */
export default function ExperienceMotion() {
  useEffect(() => {
    const hero = document.getElementById("exp-hero");
    const recordsWrap = document.querySelector(".exp-records");
    const records = Array.from(document.querySelectorAll<HTMLElement>(".rec"));
    const indexLinks = Array.from(document.querySelectorAll<HTMLElement>(".exp-index-link"));
    const cleanups: Array<() => void> = [];

    /* ---------- Year index: highlight the record in view ---------- */
    function setActive(i: number) {
      indexLinks.forEach((link, n) => {
        link.classList.toggle("is-active", n === i);
        if (n === i) link.setAttribute("aria-current", "true");
        else link.removeAttribute("aria-current");
      });
      // On phones the index is a horizontal strip: keep the active year visible in it.
      const active = indexLinks[i];
      const strip = active && active.closest(".exp-index");
      if (strip && strip.scrollWidth > strip.clientWidth) {
        strip.scrollTo({ left: active.offsetLeft - 24, behavior: "smooth" });
      }
    }

    if ("IntersectionObserver" in window && records.length) {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) setActive(parseInt((entry.target as HTMLElement).dataset.index || "0", 10));
        });
      }, { rootMargin: "-45% 0px -45% 0px" }); // a thin band across the middle of the screen
      records.forEach((rec) => observer.observe(rec));
      cleanups.push(() => observer.disconnect());
    }

    const markReady = () => {
      if (hero) hero.classList.add("is-ready");
      if (recordsWrap) recordsWrap.classList.add("is-ready");
    };
    cleanups.push(() => {
      if (hero) hero.classList.remove("is-ready");
      if (recordsWrap) recordsWrap.classList.remove("is-ready");
    });

    if (prefersReducedMotion()) {
      markReady();
      return () => cleanups.forEach((fn) => fn());
    }

    const ctx = gsap.context(() => {
      /* ---------- Header intro ---------- */
      if (hero) {
        const lines = hero.querySelectorAll(".exp-line > span");
        const rest = hero.querySelectorAll(".exp-eyebrow, .exp-lede, .exp-summary");
        gsap.set(lines, { yPercent: 110 });
        gsap.set(rest, { autoAlpha: 0, y: 16 });
        hero.classList.add("is-ready");

        gsap.timeline({ delay: 0.15 })
          .to(lines, { yPercent: 0, duration: 1, stagger: 0.1, ease: "expo.out" }, 0)
          .to(rest, { autoAlpha: 1, y: 0, duration: 0.7, stagger: 0.1, ease: "power3.out" }, 0.25);
      }

      /* ---------- Record entrances ---------- */
      records.forEach((rec) => {
        const tape = rec.querySelector(".rec-tape");
        const stamp = rec.querySelector(".rec-stamp");
        const duties = rec.querySelectorAll(".rec-duty-text");
        const tilt = rec.matches(":nth-child(even)") ? 0.6 : -0.6;

        gsap.set(rec, { autoAlpha: 0, y: 70, rotation: tilt * 4 });
        gsap.set(tape, { autoAlpha: 0, y: -18, scale: 1.3 });
        gsap.set(stamp, { autoAlpha: 0, scale: 2.4, rotation: -4 });
        gsap.set(duties, { clipPath: "inset(0 100% 0 0)" });

        gsap.timeline({
          scrollTrigger: { trigger: rec, start: "top 82%", once: true },
        })
          // Slides up out of the file and settles into its tilt
          .to(rec, { autoAlpha: 1, y: 0, rotation: tilt, duration: 0.9, ease: "power3.out" }, 0)
          // Tape slaps on
          .to(tape, { autoAlpha: 1, y: 0, scale: 1, duration: 0.25, ease: "power4.in" }, 0.45)
          // Stamp thuds down, then the card shakes from the impact
          .to(stamp, { autoAlpha: 0.85, scale: 1, rotation: -12, duration: 0.22, ease: "power4.in" }, 0.7)
          .to(rec, { x: 3, duration: 0.05, repeat: 3, yoyo: true, ease: "power1.inOut" }, 0.92)
          .set(rec, { x: 0 }, 1.12)
          // Duties type out
          .to(duties, { clipPath: "inset(0 0% 0 0)", duration: 0.55, stagger: 0.15, ease: "steps(24)" }, 0.6);
      });

      if (recordsWrap) recordsWrap.classList.add("is-ready");
    });

    return () => {
      ctx.revert();
      cleanups.forEach((fn) => fn());
    };
  }, []);

  return null;
}
