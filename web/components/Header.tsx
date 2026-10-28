"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";
import { useEffect, useRef } from "react";

const NAV_ITEMS = [
  { slug: "home", href: "/", label: "Home", icon: "M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" },
  { slug: "work", href: "/work/", label: "Work", icon: "M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" },
  { slug: "capabilities", href: "/capabilities/", label: "Capabilities", icon: "M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" },
  { slug: "about", href: "/about/", label: "About", icon: "M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" },
  { slug: "experience", href: "/experience/", label: "Experience", icon: "M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" },
  { slug: "contact", href: "/contact/", label: "Contact", icon: "M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" },
];

/** Nav slug for a URL path ("/" → home, "/work/" → work); null when no item matches. */
function slugFor(pathname: string): string | null {
  const first = pathname.split("/").filter(Boolean)[0];
  if (!first) return "home";
  return NAV_ITEMS.some((item) => item.slug === first) ? first : null;
}

type Point = { x: number; y: number };

export default function Header() {
  const pathname = usePathname();
  const currentSlug = slugFor(pathname);
  // Set up once on mount; lets later route changes slide the circle to the new page's item.
  const syncRef = useRef<((slug: string | null) => void) | null>(null);

  useEffect(() => {
    const root = document.documentElement;
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const cleanups: Array<() => void> = [];

    /* ---------------- Theme toggle ---------------- */
    const themeToggleBtn = document.getElementById("theme-toggle");

    // Colours for both themes live in styles/dark-mode.css; JS only flips the `dark` class on <html>.
    function setTheme(theme: "light" | "dark") {
      const isDark = theme === "dark";
      root.classList.toggle("dark", isDark);
      if (themeToggleBtn) themeToggleBtn.setAttribute("aria-pressed", String(isDark));
      try { localStorage.setItem("nav_theme", theme); } catch {}
    }

    // Reveal the new theme as a circle growing out of the toggle button (View Transitions API).
    // Browsers without it, or users who prefer reduced motion, get a short colour cross-fade instead.
    function animateThemeChange(nextTheme: "light" | "dark") {
      if (!document.startViewTransition || reduceMotion || !themeToggleBtn) {
        root.classList.add("theme-fading");
        setTheme(nextTheme);
        setTimeout(() => root.classList.remove("theme-fading"), 450);
        return;
      }

      const rect = themeToggleBtn.getBoundingClientRect();
      const x = rect.left + rect.width / 2;
      const y = rect.top + rect.height / 2;
      const radius = Math.hypot(Math.max(x, window.innerWidth - x), Math.max(y, window.innerHeight - y));

      const transition = document.startViewTransition(() => setTheme(nextTheme));
      transition.ready.then(() => {
        root.animate(
          { clipPath: [`circle(0px at ${x}px ${y}px)`, `circle(${radius}px at ${x}px ${y}px)`] },
          { duration: 750, easing: "cubic-bezier(0.65, 0, 0.35, 1)", pseudoElement: "::view-transition-new(root)" }
        );
      });
    }

    if (themeToggleBtn) {
      themeToggleBtn.setAttribute("aria-pressed", String(root.classList.contains("dark")));
      const onToggle = (e: MouseEvent) => {
        e.preventDefault();
        animateThemeChange(root.classList.contains("dark") ? "light" : "dark");
      };
      themeToggleBtn.addEventListener("click", onToggle);
      cleanups.push(() => themeToggleBtn.removeEventListener("click", onToggle));
    }

    /* ---------------- Sliding nav highlight ----------------
     * One circle (#nav-indicator) slides behind the icons: vertically in the desktop pill,
     * horizontally in the phone bottom bar. Clicking an item starts the slide immediately; the
     * header stays mounted across client-side navigations, so the circle simply carries on.
     */
    const track = document.getElementById("nav-track");
    const indicator = document.getElementById("nav-indicator");
    if (!track || !indicator) return () => cleanups.forEach((fn) => fn());

    const navItems = Array.from(track.querySelectorAll<HTMLAnchorElement>(".nav-item"));
    const hashItem = window.location.hash && navItems.find((n) => n.dataset.page === window.location.hash.substring(1));
    let activeItem: HTMLAnchorElement | null = hashItem || navItems.find((n) => n.classList.contains("active-page")) || null;

    function markActive(item: HTMLAnchorElement) {
      navItems.forEach((n) => {
        n.classList.toggle("active-page", n === item);
        if (n === item) n.setAttribute("aria-current", "page");
        else n.removeAttribute("aria-current");
      });
    }

    // Offset (within #nav-track) that centres the circle on an item's icon.
    function targetPos(item: HTMLAnchorElement): Point {
      const box = item.querySelector(".nav-icon-box")!.getBoundingClientRect();
      const t = track!.getBoundingClientRect();
      return {
        x: box.left + box.width / 2 - t.left - indicator!.offsetWidth / 2,
        y: box.top + box.height / 2 - t.top - indicator!.offsetHeight / 2,
      };
    }

    // Current position of the circle, including mid-animation.
    function currentPos(): Point {
      const m = new DOMMatrixReadOnly(getComputedStyle(indicator!).transform);
      return { x: m.m41, y: m.m42 };
    }

    const translate = (p: Point) => `translate(${p.x}px, ${p.y}px)`;

    function placeIndicator(pos: Point) {
      indicator!.getAnimations().forEach((a) => a.cancel());
      indicator!.style.transform = translate(pos);
      indicator!.classList.add("is-ready");
    }

    // Slide with a slight squash-and-stretch along the direction of travel.
    function slideIndicator(from: Point, to: Point) {
      const dx = to.x - from.x;
      const dy = to.y - from.y;
      const distance = Math.hypot(dx, dy);
      placeIndicator(to);
      if (reduceMotion || distance < 1) return;

      const stretch = Math.min(1 + distance / 350, 1.35);
      const squeeze = 1 - (stretch - 1) * 0.5;
      const scaleMid = Math.abs(dy) >= Math.abs(dx) ? `scale(${squeeze}, ${stretch})` : `scale(${stretch}, ${squeeze})`;
      const mid = { x: (from.x + to.x) / 2, y: (from.y + to.y) / 2 };
      indicator!.animate([
        { transform: `${translate(from)} scale(1, 1)` },
        { transform: `${translate(mid)} ${scaleMid}`, offset: 0.5 },
        { transform: `${translate(to)} scale(1, 1)` },
      ], { duration: Math.min(380 + distance * 0.6, 620), easing: "cubic-bezier(0.65, 0, 0.35, 1)" });
    }

    function moveTo(item: HTMLAnchorElement) {
      const from = indicator!.classList.contains("is-ready") ? currentPos() : null;
      activeItem = item;
      markActive(item);
      if (from === null) placeIndicator(targetPos(item));
      else slideIndicator(from, targetPos(item));
    }

    // Measure once layout has settled.
    const initFrame = requestAnimationFrame(() => {
      if (activeItem) placeIndicator(targetPos(activeItem)); // no active item (e.g. a 404): no circle
    });
    cleanups.push(() => cancelAnimationFrame(initFrame));

    navItems.forEach((item) => {
      const onClick = (e: MouseEvent) => {
        // Leave modified clicks (new tab/window) alone.
        if (e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
        if (item !== activeItem) moveTo(item);
      };
      item.addEventListener("click", onClick);
      cleanups.push(() => item.removeEventListener("click", onClick));
    });

    // Back/forward (or any other route change): slide to the new page's item.
    syncRef.current = (slug) => {
      const item = slug ? navItems.find((n) => n.dataset.page === slug) : null;
      if (item && item !== activeItem) moveTo(item);
    };
    cleanups.push(() => { syncRef.current = null; });

    // Keep the circle aligned if the nav's layout changes (late styles, resizes, phone <-> desktop layout).
    if ("ResizeObserver" in window) {
      const observer = new ResizeObserver(() => {
        if (activeItem && indicator.classList.contains("is-ready") && !indicator.getAnimations().length) {
          indicator.style.transform = translate(targetPos(activeItem));
        }
      });
      observer.observe(track);
      cleanups.push(() => observer.disconnect());
    }

    return () => cleanups.forEach((fn) => fn());
  }, []);

  useEffect(() => {
    syncRef.current?.(currentSlug);
  }, [currentSlug]);

  return (
    <>
      {/* Floating Navigation: bottom bar on phones, vertical pill on the left from md up */}
      <div id="nav-wrapper">
        <nav id="floating-nav-bar" className="fixed z-50 bottom-3 inset-x-3 md:inset-x-auto md:bottom-auto md:left-8 md:top-1/2 md:-translate-y-1/2 bg-white/90 backdrop-blur-md rounded-full shadow-[0_10px_30px_rgba(0,0,0,0.08)] py-2 px-2 md:py-5 md:px-3 flex flex-row md:flex-col items-center justify-between md:h-[620px] md:w-18 border border-gray-100/80 transition-colors duration-300">
          {/* Top Mini Logo */}
          <div className="hidden md:block mb-2">
            <Link id="nav-logo" href="/" className="font-bold text-sm tracking-tight text-gray-900 transition-colors duration-300">
              <span id="nav-logo-span" className="text-gray-400 transition-colors duration-300">K</span>A
            </Link>
          </div>

          {/* Navigation Items: #nav-indicator is the single highlight circle that slides between items */}
          <div id="nav-track" className="relative flex-1 md:flex-none md:w-full">
            <span id="nav-indicator" aria-hidden="true"></span>
            <ul id="floating-nav" className="flex flex-row md:flex-col items-center justify-around md:justify-start md:space-y-3 w-full">
              {NAV_ITEMS.map((item) => {
                const isActive = item.slug === currentSlug;
                return (
                  <li key={item.slug}>
                    <Link
                      href={item.href}
                      data-page={item.slug}
                      className={`nav-item flex flex-col items-center group${isActive ? " active-page" : ""}`}
                      aria-current={isActive ? "page" : undefined}
                    >
                      <div className="nav-icon-box w-10 h-10 rounded-full flex items-center justify-center group-hover:scale-105 active:scale-95">
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" d={item.icon}></path></svg>
                      </div>
                      <span className="text-[9px] font-medium mt-0.5 tracking-tight">{item.label}</span>
                    </Link>
                  </li>
                );
              })}
            </ul>
          </div>

          {/* Bottom Theme Toggle */}
          <div id="nav-footer-divider" className="pl-1.5 border-l md:pl-0 md:border-l-0 md:pt-2 md:border-t border-gray-100 md:w-full flex justify-center transition-colors duration-300">
            <button id="theme-toggle" aria-label="Toggle dark mode" aria-pressed="false" className="relative w-9 h-9 rounded-full flex items-center justify-center transition-all active:scale-95 cursor-pointer">
              {/* Sun Icon (Shown in Dark Mode; swap animation in styles/dark-mode.css) */}
              <svg id="theme-icon-sun" className="theme-icon absolute w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
              {/* Moon Icon (Shown in Light Mode) */}
              <svg id="theme-icon-moon" className="theme-icon absolute w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path></svg>
            </button>
          </div>
        </nav>
      </div>
    </>
  );
}
