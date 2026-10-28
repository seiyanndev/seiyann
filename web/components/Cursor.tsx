"use client";

import { useEffect } from "react";
import { gsap } from "@/lib/gsap";

/**
 * Site-wide "registration mark" cursor (Dossier style). Styles: styles/cursor.css.
 *
 *  - At rest: a dot that tracks the mouse exactly, plus a crosshair ring that trails slightly.
 *  - Over something clickable: the ring unfolds into four crop marks that hug the element,
 *    and a tape label says what a click does ("Open file", "Copy", "Open 003"...).
 *  - Press: the marks squeeze in, like a stamp.
 *  - Text fields get the normal text cursor; the custom one hides there.
 * Only for a mouse/trackpad (hover + fine pointer). The system cursor is hidden only after the
 * first mouse move, so if this never runs, the normal cursor is untouched.
 * Labels: the LABELS list below, or any element with data-cursor="Label".
 */

const INTERACTIVE = 'a, button, [role="button"], label, summary, .hero-card, .proof-row, .tool, #hero-headline .hero-word, [data-cursor]';
const TEXT_FIELDS = 'input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="hidden"]), textarea, select, [contenteditable="true"]';

type Label = string | ((el: HTMLElement) => string);

// First match wins, so specific selectors come before general ones.
const LABELS: Array<[string, Label]> = [
  ["[data-cursor]", (el) => el.dataset.cursor || ""],
  [".folder-toggle", (el) => (el.closest(".folder")!.classList.contains("is-open") ? "Close file" : "Open file")],
  [".case-close", "Close file"],
  [".req-stamp", "File request"],
  [".ct-copy", (el) => (el.classList.contains("is-copied") ? "Copied" : "Copy")],
  [".contents-row", (el) => "Open " + el.querySelector(".contents-num")?.textContent],
  [".hero-card", "Next fig."],
  [".hero-dot", "Show fig."],
  [".proof-row", "View case"],
  [".proof-cap", "Highlight"],
  [".lens-step-head", "Jump to"],
  [".cab-filter", "Filter"],
  [".req-option", "Select"],
  ["#hero-headline .hero-word", "Glitch"],
  ["#theme-toggle", () => (document.documentElement.classList.contains("dark") ? "Light mode" : "Dark mode")],
  [".nav-item", (el) => { const t = el.querySelector("span:last-child"); return t ? (t.textContent || "").trim() : ""; }],
  ['a[href^="mailto:"]', "Email"],
  ['a[href^="tel:"]', "Call"],
  ['a[target="_blank"]', "Open ↗"],
];
// Targets that get a label but no crop-mark frame (too small or too large to frame nicely).
const NO_FRAME = "#hero-headline .hero-word";

function labelFor(el: HTMLElement): string {
  for (const [selector, value] of LABELS) {
    if (el.matches(selector)) return typeof value === "function" ? value(el) : value;
  }
  return "";
}

export default function Cursor() {
  useEffect(() => {
    if (!window.matchMedia("(hover: hover) and (pointer: fine)").matches) return;

    const root = document.documentElement;
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    /* ---------- Elements ---------- */
    const cursor = document.createElement("div");
    cursor.className = "cur";
    cursor.setAttribute("aria-hidden", "true");
    cursor.innerHTML =
      '<div class="cur-ring-pos"><div class="cur-ring"></div></div>' +
      '<div class="cur-frame"><div class="cur-frame-inner"><i class="tl"></i><i class="tr"></i><i class="bl"></i><i class="br"></i></div></div>' +
      '<div class="cur-dot"></div>';
    const label = document.createElement("div");
    label.className = "cur-label";
    label.setAttribute("aria-hidden", "true");
    document.body.append(cursor, label);

    const ringPos = cursor.querySelector<HTMLElement>(".cur-ring-pos")!;
    const frame = cursor.querySelector<HTMLElement>(".cur-frame")!;
    const dot = cursor.querySelector<HTMLElement>(".cur-dot")!;

    /* ---------- State ---------- */
    const mouse = { x: -100, y: -100 };
    const ring = { x: -100, y: -100 };
    const box = { x: -100, y: -100, w: 28, h: 28 };
    let target: HTMLElement | null = null;
    let framed = false;
    let active = false;

    function setTarget(el: HTMLElement | null) {
      target = el;
      const text = el ? labelFor(el) : "";
      label.textContent = text;
      label.classList.toggle("is-on", !!text);

      framed = false;
      if (el && !el.matches(NO_FRAME)) {
        const r = el.getBoundingClientRect();
        // Frame anything that fits comfortably on screen.
        framed = r.width < window.innerWidth * 0.96 && r.height < window.innerHeight * 0.8;
      }
      cursor.classList.toggle("is-snap", framed);
    }

    /* ---------- Events ---------- */
    const onMouseMove = (e: MouseEvent) => {
      mouse.x = e.clientX;
      mouse.y = e.clientY;

      if (!active) {
        // First move: switch from the system cursor to this one, starting in place.
        active = true;
        ring.x = mouse.x; ring.y = mouse.y;
        box.x = mouse.x - 14; box.y = mouse.y - 14;
        root.classList.add("has-cursor");
        cursor.classList.add("is-visible");
      }

      const el = e.target instanceof Element ? e.target : null;
      const inText = !!(el && el.closest(TEXT_FIELDS));
      cursor.classList.toggle("is-text", inText);
      label.classList.toggle("is-hidden", inText);

      const next = el && !inText ? el.closest<HTMLElement>(INTERACTIVE) : null;
      if (next !== target) setTarget(next);
    };
    const onLeave = () => {
      cursor.classList.remove("is-visible");
      label.classList.add("is-hidden");
    };
    const onEnter = () => {
      if (active) cursor.classList.add("is-visible");
      label.classList.remove("is-hidden");
    };
    const onDown = () => cursor.classList.add("is-press");
    let refreshTimer: ReturnType<typeof setTimeout> | undefined;
    const onUp = () => {
      cursor.classList.remove("is-press");
      // A click can change what the target does (open → close, copy → copied): refresh the label.
      if (target) refreshTimer = setTimeout(() => setTarget(target && target.isConnected ? target : null), 30);
    };

    window.addEventListener("mousemove", onMouseMove, { passive: true });
    document.addEventListener("mouseleave", onLeave);
    document.addEventListener("mouseenter", onEnter);
    window.addEventListener("mousedown", onDown);
    window.addEventListener("mouseup", onUp);

    /* ---------- Frame loop ---------- */
    function step(deltaMs: number) {
      // Frame-rate independent easing; instant with reduced motion.
      const ringEase = reduceMotion ? 1 : 1 - Math.exp(-deltaMs / 55);
      const boxEase = reduceMotion ? 1 : 1 - Math.exp(-deltaMs / 70);

      if (target && !target.isConnected) setTarget(null);

      ring.x += (mouse.x - ring.x) * ringEase;
      ring.y += (mouse.y - ring.y) * ringEase;

      // The frame hugs the target (re-measured every frame, so it follows lifts and scrolling),
      // or shrinks back to the ring's size when there is nothing to frame.
      let goal;
      if (framed && target) {
        const r = target.getBoundingClientRect();
        goal = { x: r.left - 6, y: r.top - 6, w: r.width + 12, h: r.height + 12 };
      } else {
        goal = { x: ring.x - 14, y: ring.y - 14, w: 28, h: 28 };
      }
      box.x += (goal.x - box.x) * boxEase;
      box.y += (goal.y - box.y) * boxEase;
      box.w += (goal.w - box.w) * boxEase;
      box.h += (goal.h - box.h) * boxEase;

      dot.style.transform = `translate3d(${mouse.x}px, ${mouse.y}px, 0)`;
      ringPos.style.transform = `translate3d(${ring.x}px, ${ring.y}px, 0)`;
      frame.style.transform = `translate3d(${box.x}px, ${box.y}px, 0)`;
      frame.style.width = box.w + "px";
      frame.style.height = box.h + "px";
      label.style.transform = `translate3d(${mouse.x + 18}px, ${mouse.y + 20}px, 0) rotate(-3deg)`;
    }

    const tick = (_time: number, deltaTime: number) => step(Math.min(deltaTime, 64));
    gsap.ticker.add(tick);

    return () => {
      gsap.ticker.remove(tick);
      clearTimeout(refreshTimer);
      window.removeEventListener("mousemove", onMouseMove);
      document.removeEventListener("mouseleave", onLeave);
      document.removeEventListener("mouseenter", onEnter);
      window.removeEventListener("mousedown", onDown);
      window.removeEventListener("mouseup", onUp);
      root.classList.remove("has-cursor");
      cursor.remove();
      label.remove();
    };
  }, []);

  return null;
}
