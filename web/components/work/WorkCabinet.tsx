"use client";

import { useEffect } from "react";
import { gsap, prefersReducedMotion } from "@/lib/gsap";

/**
 * Work page filing cabinet (app/work/page.tsx).
 *
 *  - Clicking a folder's tab/front opens it in place into its case sheet; one folder is open at
 *    a time. "Close file", clicking the front again, or Escape puts it back.
 *  - Filter stamps dim the folders outside a discipline (they stay clickable).
 *  - Deep links: /work/#project-05 opens case 05 and scrolls to it.
 *  - Intro (GSAP): the headline rises, then the folders slide up out of the drawer one by one;
 *    opening a folder drops the case sheet in and slaps its tape on.
 * Reduced motion: no intro or sheet animation; everything else works the same.
 */
export default function WorkCabinet() {
  useEffect(() => {
    const main = document.querySelector<HTMLElement>(".cab");
    if (!main) return;

    const folders = Array.from(main.querySelectorAll<HTMLElement>(".folder"));
    const filterButtons = Array.from(main.querySelectorAll<HTMLElement>(".cab-filter"));
    const reduceMotion = prefersReducedMotion();
    const animate = !reduceMotion;

    const ctx = gsap.context(() => {});
    const cleanups: Array<() => void> = [];
    const timers: Array<ReturnType<typeof setTimeout>> = [];
    const listen = (el: EventTarget, type: string, fn: EventListener) => {
      el.addEventListener(type, fn);
      cleanups.push(() => el.removeEventListener(type, fn));
    };

    /* ---------- Open / close ---------- */
    let openFolder: HTMLElement | null = null;

    function close(folder: HTMLElement | null, { focus = false } = {}) {
      if (!folder) return;
      folder.classList.remove("is-open");
      const toggle = folder.querySelector<HTMLElement>(".folder-toggle")!;
      toggle.setAttribute("aria-expanded", "false");
      if (focus) toggle.focus();
      if (openFolder === folder) openFolder = null;
    }

    function open(folder: HTMLElement, { scroll = true } = {}) {
      if (openFolder && openFolder !== folder) close(openFolder);
      folder.classList.add("is-open");
      folder.querySelector(".folder-toggle")!.setAttribute("aria-expanded", "true");
      openFolder = folder;

      if (animate) {
        const sheet = folder.querySelector(".case-sheet");
        const tape = folder.querySelector(".case-tape");
        ctx.add(() => {
          gsap.fromTo(sheet, { y: -24, rotation: -2.5, autoAlpha: 0 }, { y: 0, rotation: -0.4, autoAlpha: 1, duration: 0.6, delay: 0.1, ease: "back.out(1.4)" });
          gsap.fromTo(tape, { autoAlpha: 0, scale: 1.35, yPercent: -40 }, { autoAlpha: 1, scale: 1, yPercent: 0, duration: 0.25, delay: 0.5, ease: "power4.in" });
        });
      }

      // Bring the opened folder's top into view once it has expanded.
      if (scroll) {
        timers.push(setTimeout(() => {
          const top = folder.getBoundingClientRect().top;
          if (top < 0 || top > window.innerHeight * 0.4) {
            folder.scrollIntoView({ behavior: reduceMotion ? "auto" : "smooth", block: "start" });
          }
        }, reduceMotion ? 0 : 260));
      }
    }

    folders.forEach((folder) => {
      listen(folder.querySelector(".folder-toggle")!, "click", () => {
        if (folder.classList.contains("is-open")) close(folder);
        else open(folder);
      });
      listen(folder.querySelector(".case-close")!, "click", () => close(folder, { focus: true }));
    });

    listen(document, "keydown", (e) => {
      if ((e as KeyboardEvent).key === "Escape" && openFolder) close(openFolder, { focus: true });
    });

    /* ---------- Filters ---------- */
    filterButtons.forEach((button) => {
      listen(button, "click", () => {
        const key = button.dataset.filter || "all";
        filterButtons.forEach((b) => {
          const active = b === button;
          b.classList.toggle("is-active", active);
          b.setAttribute("aria-pressed", String(active));
        });
        folders.forEach((folder) => {
          const match = key === "all" || (folder.dataset.filters || "").split(" ").includes(key);
          folder.classList.toggle("is-dimmed", !match);
        });
      });
    });

    /* ---------- Intro ---------- */
    if (animate) {
      ctx.add(() => {
        const lines = main.querySelectorAll(".cab-line > span");
        const rest = main.querySelectorAll(".cab-eyebrow, .cab-lede, .cab-filters, .cab-drawer-label");
        gsap.set(lines, { yPercent: 110 });
        gsap.set(rest, { autoAlpha: 0, y: 16 });
        gsap.set(folders, { autoAlpha: 0, y: 50 });
        main.classList.add("is-ready");

        gsap.timeline({ delay: 0.15 })
          .to(lines, { yPercent: 0, duration: 1, stagger: 0.1, ease: "expo.out" }, 0)
          .to(rest, { autoAlpha: 1, y: 0, duration: 0.7, stagger: 0.08, ease: "power3.out" }, 0.2)
          // The folders slide up out of the drawer, front to back
          .to(folders, { autoAlpha: 1, y: 0, duration: 0.7, stagger: 0.05, ease: "power3.out", clearProps: "transform" }, 0.45);
      });
    } else {
      main.classList.add("is-ready");
    }

    /* ---------- Deep link ---------- */
    const target = window.location.hash ? document.getElementById(window.location.hash.slice(1)) : null;
    if (target && target.classList.contains("folder")) {
      open(target, { scroll: false });
      timers.push(setTimeout(() => target.scrollIntoView({ block: "start" }), animate ? 300 : 0));
    }

    return () => {
      cleanups.forEach((fn) => fn());
      timers.forEach(clearTimeout);
      ctx.revert();
      main.classList.remove("is-ready");
      folders.forEach((folder) => close(folder));
    };
  }, []);

  return null;
}
