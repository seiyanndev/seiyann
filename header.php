<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <main>
 *
 * @package Seiyann
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800&display=swap" rel="stylesheet">
    
    <!-- Tailwind v3 Play CDN with Class-based Dark Mode Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
        theme: {
          extend: {
            // Montserrat everywhere (it's loaded above); system fonts only as a fallback
            fontFamily: {
              sans: ['Montserrat', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
          },
        },
      }
    </script>

    <script>
        // Apply the saved theme before first paint so dark mode doesn't flash light (defaults to light)
        (function () {
            // Lets CSS hide JS-animated elements until their script has set them up
            document.documentElement.classList.add("js");

            var theme = "light";
            try { theme = localStorage.getItem("nav_theme") || "light"; } catch (e) {}
            if (theme === "dark") document.documentElement.classList.add("dark");
        })();
    </script>
    <?php wp_head(); ?>
</head>

<!-- Light-mode classes; assets/dark-mode.css remaps them when <html> has the `dark` class -->
<body <?php body_class('bg-[#faf9f5] text-gray-900 antialiased selection:bg-black selection:text-white min-h-screen flex flex-col relative overflow-x-hidden'); ?>>
<?php wp_body_open(); ?>

<!-- Bottom padding on phones keeps content clear of the bottom nav bar -->
<div id="page" class="site min-h-screen flex flex-col relative overflow-x-hidden pb-24 md:pb-0">

    <!-- Floating Navigation: bottom bar on phones, vertical pill on the left from md up -->
    <div id="nav-wrapper">
        <nav id="floating-nav-bar" class="fixed z-50 bottom-3 inset-x-3 md:inset-x-auto md:bottom-auto md:left-8 md:top-1/2 md:-translate-y-1/2 bg-white/90 backdrop-blur-md rounded-full shadow-[0_10px_30px_rgba(0,0,0,0.08)] py-2 px-2 md:py-5 md:px-3 flex flex-row md:flex-col items-center justify-between md:h-[620px] md:w-18 border border-gray-100/80 transition-colors duration-300">
            <!-- Top Mini Logo -->
            <div class="hidden md:block mb-2">
                <a id="nav-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" class="font-bold text-sm tracking-tight text-gray-900 transition-colors duration-300">
                    <span id="nav-logo-span" class="text-gray-400 transition-colors duration-300">K</span>A
                </a>
            </div>

            <?php
            // Safely determine the current page slug to apply the active state on page load
            $current_slug = 'home'; // Default
            if ( is_page() || is_single() ) {
                $current_slug = get_post_field( 'post_name', get_post() );
            }
            if ( is_front_page() || is_home() ) {
                $current_slug = 'home';
            }

            $nav_items = array(
                'home'         => array( 'label' => 'Home',         'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6' ),
                'work'         => array( 'label' => 'Work',         'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z' ),
                'capabilities' => array( 'label' => 'Capabilities', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z' ),
                'about'        => array( 'label' => 'About',        'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' ),
                'experience'   => array( 'label' => 'Experience',   'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z' ),
                'contact'      => array( 'label' => 'Contact',      'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z' ),
            );
            ?>

            <!-- Navigation Items: #nav-indicator is the single highlight circle that slides between items -->
            <div id="nav-track" class="relative flex-1 md:flex-none md:w-full">
                <span id="nav-indicator" aria-hidden="true"></span>
                <ul id="floating-nav" class="flex flex-row md:flex-col items-center justify-around md:justify-start md:space-y-3 w-full">
                    <?php foreach ( $nav_items as $slug => $item ) :
                        if ( 'home' === $slug ) {
                            $url = home_url( '/' );
                        } else {
                            $page = get_page_by_path( $slug );
                            $url  = $page ? get_permalink( $page->ID ) : home_url( "/{$slug}/" );
                        }
                        $is_active = ( $current_slug === $slug );
                    ?>
                    <li>
                        <a href="<?php echo esc_url( $url ); ?>" data-page="<?php echo esc_attr( $slug ); ?>" class="nav-item flex flex-col items-center group<?php echo $is_active ? ' active-page' : ''; ?>"<?php echo $is_active ? ' aria-current="page"' : ''; ?>>
                            <div class="nav-icon-box w-10 h-10 rounded-full flex items-center justify-center group-hover:scale-105 active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="<?php echo esc_attr( $item['icon'] ); ?>"></path></svg>
                            </div>
                            <span class="text-[9px] font-medium mt-0.5 tracking-tight"><?php echo esc_html( $item['label'] ); ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Bottom Theme Toggle -->
            <div id="nav-footer-divider" class="pl-1.5 border-l md:pl-0 md:border-l-0 md:pt-2 md:border-t border-gray-100 md:w-full flex justify-center transition-colors duration-300">
                <button id="theme-toggle" aria-label="Toggle dark mode" aria-pressed="false" class="relative w-9 h-9 rounded-full flex items-center justify-center transition-all active:scale-95 cursor-pointer">
                    <!-- Sun Icon (Shown in Dark Mode; swap animation in assets/dark-mode.css) -->
                    <svg id="theme-icon-sun" class="theme-icon absolute w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <!-- Moon Icon (Shown in Light Mode) -->
                    <svg id="theme-icon-moon" class="theme-icon absolute w-4 h-4 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path></svg>
                </button>
            </div>
        </nav>
    </div>

    <script>
    // Runs inline (not on DOMContentLoaded) so the nav state is set before first paint; the nav markup is above.
    (function() {
        const root = document.documentElement;
        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

        /* ---------------- Theme toggle ---------------- */
        const themeToggleBtn = document.getElementById("theme-toggle");

        // Colours for both themes live in assets/dark-mode.css; JS only flips the `dark` class on <html>.
        function setTheme(theme) {
            const isDark = theme === "dark";
            root.classList.toggle("dark", isDark);
            if (themeToggleBtn) themeToggleBtn.setAttribute("aria-pressed", String(isDark));
            try { localStorage.setItem("nav_theme", theme); } catch (e) {}
        }

        // Reveal the new theme as a circle growing out of the toggle button (View Transitions API).
        // Browsers without it, or users who prefer reduced motion, get a short colour cross-fade instead.
        function animateThemeChange(nextTheme) {
            if (!document.startViewTransition || reduceMotion) {
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
            themeToggleBtn.addEventListener("click", function(e) {
                e.preventDefault();
                animateThemeChange(root.classList.contains("dark") ? "light" : "dark");
            });
        }

        /* ---------------- Sliding nav highlight ----------------
         * One circle (#nav-indicator) slides behind the icons: vertically in the desktop pill,
         * horizontally in the phone bottom bar. Clicking an item starts the slide immediately; as
         * the page unloads, the circle's current position is saved, and the next page starts the
         * circle there and finishes the slide to its own active item.
         */
        const track = document.getElementById("nav-track");
        const indicator = document.getElementById("nav-indicator");
        if (!track || !indicator) return;

        const navItems = Array.from(track.querySelectorAll(".nav-item"));
        const STORAGE_KEY = "nav_indicator_pos";
        const hashItem = window.location.hash && navItems.find(n => n.dataset.page === window.location.hash.substring(1));
        const pageActive = hashItem || navItems.find(n => n.classList.contains("active-page")) || null;
        let activeItem = pageActive;

        // Where the circle was on the previous page (if we arrived from one), as {x, y, w}.
        // `w` is the viewport width, so a position saved in the other layout is ignored.
        let arrivingFrom = null;
        try {
            const saved = JSON.parse(sessionStorage.getItem(STORAGE_KEY));
            sessionStorage.removeItem(STORAGE_KEY);
            if (saved && isFinite(saved.x) && isFinite(saved.y) && saved.w === window.innerWidth) arrivingFrom = saved;
        } catch (e) {}

        // Hold back the active colours until the circle arrives, so the icon fades in with it.
        if (arrivingFrom && activeItem && !reduceMotion) {
            activeItem.classList.remove("active-page");
        }

        function markActive(item) {
            navItems.forEach(n => {
                n.classList.toggle("active-page", n === item);
                if (n === item) n.setAttribute("aria-current", "page");
                else n.removeAttribute("aria-current");
            });
        }

        // Offset (within #nav-track) that centres the circle on an item's icon.
        function targetPos(item) {
            const box = item.querySelector(".nav-icon-box").getBoundingClientRect();
            const t = track.getBoundingClientRect();
            return {
                x: box.left + box.width / 2 - t.left - indicator.offsetWidth / 2,
                y: box.top + box.height / 2 - t.top - indicator.offsetHeight / 2,
            };
        }

        // Current position of the circle, including mid-animation.
        function currentPos() {
            const m = new DOMMatrixReadOnly(getComputedStyle(indicator).transform);
            return { x: m.m41, y: m.m42 };
        }

        const translate = p => `translate(${p.x}px, ${p.y}px)`;

        function placeIndicator(pos) {
            indicator.getAnimations().forEach(a => a.cancel());
            indicator.style.transform = translate(pos);
            indicator.classList.add("is-ready");
        }

        // Slide with a slight squash-and-stretch along the direction of travel.
        function slideIndicator(from, to) {
            const dx = to.x - from.x;
            const dy = to.y - from.y;
            const distance = Math.hypot(dx, dy);
            placeIndicator(to);
            if (reduceMotion || distance < 1) return;

            const stretch = Math.min(1 + distance / 350, 1.35);
            const squeeze = 1 - (stretch - 1) * 0.5;
            const scaleMid = Math.abs(dy) >= Math.abs(dx) ? `scale(${squeeze}, ${stretch})` : `scale(${stretch}, ${squeeze})`;
            const mid = { x: (from.x + to.x) / 2, y: (from.y + to.y) / 2 };
            indicator.animate([
                { transform: `${translate(from)} scale(1, 1)` },
                { transform: `${translate(mid)} ${scaleMid}`, offset: 0.5 },
                { transform: `${translate(to)} scale(1, 1)` }
            ], { duration: Math.min(380 + distance * 0.6, 620), easing: "cubic-bezier(0.65, 0, 0.35, 1)" });
        }

        function moveTo(item) {
            const from = indicator.classList.contains("is-ready") ? currentPos() : null;
            activeItem = item;
            markActive(item);
            if (from === null) placeIndicator(targetPos(item));
            else slideIndicator(from, targetPos(item));
        }

        // Measure once layout (Tailwind CDN styles) has settled.
        function initIndicator() {
            requestAnimationFrame(() => {
                if (!activeItem) return; // e.g. blog posts: no nav item is active, so no circle
                if (arrivingFrom && !reduceMotion) {
                    placeIndicator(arrivingFrom);
                    markActive(activeItem);
                    slideIndicator(arrivingFrom, targetPos(activeItem));
                } else {
                    placeIndicator(targetPos(activeItem));
                }
            });
        }
        if (document.readyState === "loading") document.addEventListener("DOMContentLoaded", initIndicator);
        else initIndicator();

        navItems.forEach(item => {
            item.addEventListener("click", function(e) {
                // Leave modified clicks (new tab/window) alone.
                if (e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
                if (item !== activeItem) moveTo(item);
            });
        });

        // Hand the circle's position to the next page.
        window.addEventListener("pagehide", function() {
            if (!indicator.classList.contains("is-ready")) return;
            const pos = currentPos();
            try { sessionStorage.setItem(STORAGE_KEY, JSON.stringify({ x: pos.x, y: pos.y, w: window.innerWidth })); } catch (e) {}
        });

        // Back/forward cache restores this page as it was left (circle on the clicked item): slide it back.
        window.addEventListener("pageshow", function(e) {
            if (!e.persisted) return;
            try { sessionStorage.removeItem(STORAGE_KEY); } catch (err) {}
            if (pageActive && activeItem !== pageActive) moveTo(pageActive);
        });

        // Keep the circle aligned if the nav's layout changes (late styles, resizes, phone <-> desktop layout).
        if ("ResizeObserver" in window) {
            new ResizeObserver(() => {
                if (activeItem && indicator.classList.contains("is-ready") && !indicator.getAnimations().length) {
                    indicator.style.transform = translate(targetPos(activeItem));
                }
            }).observe(track);
        }
    })();
    </script>
