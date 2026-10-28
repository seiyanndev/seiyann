"use client";

import { useEffect } from "react";
import { gsap, prefersReducedMotion } from "@/lib/gsap";

/**
 * Homepage cover sheet (app/page.tsx), alongside HeroHeadline and HeroVisual.
 *
 *  - "Open to work" stamp: thuds down once the headline has faded in.
 *  - Contents index: the rows rule in one by one the first time they scroll into view.
 * Reduced motion: the stamp just appears; rows are shown as-is.
 */
export default function HomeCover() {
  useEffect(() => {
    // Two copies of the stamp: top right (tablet/desktop) and beside the CTA (phones). CSS shows one.
    const stamps = Array.from(document.querySelectorAll<HTMLElement>(".cover-stamp"));

    if (prefersReducedMotion()) {
      stamps.forEach((s) => s.classList.add("is-in"));
      return () => stamps.forEach((s) => s.classList.remove("is-in"));
    }

    const ctx = gsap.context(() => {
      /* ---------- Stamp ---------- */
      if (stamps.length) {
        gsap.set(stamps, { autoAlpha: 0, scale: 2.4, rotation: -2 });
        stamps.forEach((s) => s.classList.add("is-in"));
        gsap.timeline({ delay: 1.1 })
          .to(stamps, { autoAlpha: 0.9, scale: 1, rotation: -8, duration: 0.22, ease: "power4.in" })
          .to(stamps, { x: 2, duration: 0.05, repeat: 3, yoyo: true, ease: "power1.inOut" })
          .set(stamps, { x: 0 });
      }

      /* ---------- Contents rows ---------- */
      const rows = document.querySelectorAll(".contents-list li");
      if (rows.length) {
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
    });

    return () => {
      ctx.revert();
      stamps.forEach((s) => s.classList.remove("is-in"));
    };
  }, []);

  return null;
}
