"use client";

import { useEffect } from "react";
import { gsap, prefersReducedMotion } from "@/lib/gsap";

/**
 * About page intro (app/about/page.tsx).
 *
 *  - Headline lines rise out of their masks; bio, quote and CTA fade up after them.
 *  - The ID card drops in and settles into its 3° tilt, then the tape strip slaps on
 *    (the card gives a small press), and the card's fields type out one by one.
 *  - Stats count up from zero the first time they scroll into view.
 * Reduced motion: everything is shown in its final state.
 */
export default function AboutIntro() {
  useEffect(() => {
    const hero = document.getElementById("about-hero");
    if (!hero) return;

    if (prefersReducedMotion()) {
      hero.classList.add("is-ready");
      return () => hero.classList.remove("is-ready");
    }

    const nums = Array.from(document.querySelectorAll<HTMLElement>(".about-stat-num"));

    const ctx = gsap.context(() => {
      /* ---------- Hero intro ---------- */
      const lines = hero.querySelectorAll(".about-line > span");
      const eyebrow = hero.querySelector(".about-eyebrow");
      const reveals = hero.querySelectorAll(".about-reveal");
      const card = hero.querySelector(".id-card");
      const tape = hero.querySelector(".id-tape");
      const fields = hero.querySelectorAll(".id-name, .id-fields dd, .id-barcode");

      gsap.set(lines, { yPercent: 110 });
      gsap.set([eyebrow, ...reveals], { autoAlpha: 0, y: 18 });
      gsap.set(card, { autoAlpha: 0, y: -70, rotation: -7 });
      gsap.set(tape, { autoAlpha: 0, y: -24, scale: 1.35 });
      gsap.set(fields, { clipPath: "inset(0 100% 0 0)" });
      hero.classList.add("is-ready");

      gsap.timeline({ delay: 0.15 })
        .to(eyebrow, { autoAlpha: 1, y: 0, duration: 0.6, ease: "power3.out" }, 0)
        .to(lines, { yPercent: 0, duration: 1, stagger: 0.1, ease: "expo.out" }, 0.05)
        .to(reveals, { autoAlpha: 1, y: 0, duration: 0.7, stagger: 0.08, ease: "power3.out" }, 0.45)

        // Card drops and settles into its tilt
        .to(card, { autoAlpha: 1, y: 0, rotation: 3, duration: 1.1, ease: "back.out(1.3)" }, 0.3)

        // Tape slaps on; the card gives under it
        .to(tape, { autoAlpha: 1, y: 0, scale: 1, duration: 0.28, ease: "power4.in" }, 1.15)
        .to(card, { scale: 0.975, duration: 0.07, ease: "power1.out" }, 1.43)
        .to(card, { scale: 1, duration: 0.45, ease: "elastic.out(1, 0.4)" }, 1.5)

        // Fields type out, typewriter-style
        .to(fields, { clipPath: "inset(0 0% 0 0)", duration: 0.45, stagger: 0.12, ease: "steps(14)" }, 1.4);

      /* ---------- Stats count-up ---------- */
      nums.forEach((el) => {
        const target = parseInt(el.dataset.count || "", 10) || 0;
        const counter = { value: 0 };
        el.textContent = "0";
        gsap.to(counter, {
          value: target,
          duration: 1.4,
          ease: "power3.out",
          scrollTrigger: { trigger: "#about-stats", start: "top 85%", once: true },
          onUpdate: () => { el.textContent = String(Math.round(counter.value)); },
        });
      });
    });

    return () => {
      ctx.revert();
      hero.classList.remove("is-ready");
      nums.forEach((el) => { el.textContent = el.dataset.count || ""; });
    };
  }, []);

  return null;
}
