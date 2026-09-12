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
    
    <!-- Tailwind v3 Play CDN with Class-based Dark Mode Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
      }
    </script>

    <script>
        // Immediately apply saved theme preference to local storage variable, keeping HTML clean
        if (!localStorage.getItem("nav_theme")) {
            localStorage.setItem("nav_theme", "light"); // Default nav to light
        }
    </script>
    <?php wp_head(); ?>
</head>

<!-- Body is locked to the light background and text configuration permanently -->
<body <?php body_class('bg-[#faf9f5] text-gray-900 antialiased selection:bg-black selection:text-white min-h-screen flex flex-col relative overflow-x-hidden'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col relative overflow-x-hidden">

    <!-- Floating Left Navigation Bar Wrapper -->
    <div id="nav-wrapper">
        <nav id="floating-nav-bar" class="fixed left-8 top-1/2 -translate-y-1/2 z-50 bg-white/90 backdrop-blur-md rounded-full shadow-[0_10px_30px_rgba(0,0,0,0.08)] py-5 px-3 flex flex-col items-center justify-between h-[620px] w-18 border border-gray-100/80 transition-colors duration-300">
            <!-- Top Mini Logo -->
            <div class="mb-2">
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
            ?>

            <!-- Navigation Items -->
            <ul id="floating-nav" class="flex flex-col items-center space-y-3 w-full">
                <!-- Home -->
                <li>
                    <a href="<?php echo esc_url( home_url( '/#home' ) ); ?>" data-page="home" class="nav-item flex flex-col items-center group transition-all <?php echo ( $current_slug === 'home' ) ? 'text-gray-900 dark:text-white active-page' : 'text-gray-400 hover:text-black'; ?>">
                        <div class="nav-icon-box <?php echo ( $current_slug === 'home' ) ? 'bg-black text-white shadow-md w-10 h-10' : 'w-9 h-9 text-gray-400'; ?> rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <span class="text-[9px] font-medium mt-1 tracking-tight">Home</span>
                    </a>
                </li>
                <!-- Work -->
                <li>
                    <a href="<?php echo esc_url( home_url( '/#work' ) ); ?>" data-page="work" class="nav-item flex flex-col items-center group transition-all <?php echo ( $current_slug === 'work' ) ? 'text-gray-900 active-page' : 'text-gray-400 hover:text-black'; ?>">
                        <div class="nav-icon-box <?php echo ( $current_slug === 'work' ) ? 'bg-black text-white shadow-md w-10 h-10' : 'w-9 h-9 text-gray-400'; ?> rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                        </div>
                        <span class="text-[9px] font-medium mt-0.5 tracking-tight">Work</span>
                    </a>
                </li>

                <!-- Capabilities -->
                <li>
                    <a href="<?php echo esc_url( home_url( '/#capabilities' ) ); ?>" data-page="capabilities" class="nav-item flex flex-col items-center group transition-all <?php echo ( $current_slug === 'capabilities' ) ? 'text-gray-900 active-page' : 'text-gray-400 hover:text-black'; ?>">
                        <div class="nav-icon-box <?php echo ( $current_slug === 'capabilities' ) ? 'bg-black text-white shadow-md w-10 h-10' : 'w-9 h-9 text-gray-400'; ?> rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        </div>
                        <span class="text-[9px] font-medium mt-0.5 tracking-tight">Capabilities</span>
                    </a>
                </li>

                <!-- About -->
                <li>
                    <a href="<?php echo esc_url( home_url( '/#about' ) ); ?>" data-page="about" class="nav-item flex flex-col items-center group transition-all <?php echo ( $current_slug === 'about' ) ? 'text-gray-900 active-page' : 'text-gray-400 hover:text-black'; ?>">
                        <div class="nav-icon-box <?php echo ( $current_slug === 'about' ) ? 'bg-black text-white shadow-md w-10 h-10' : 'w-9 h-9 text-gray-400'; ?> rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <span class="text-[9px] font-medium mt-0.5 tracking-tight">About</span>
                    </a>
                </li>

                <!-- Experience -->
                <li>
                    <a href="<?php echo esc_url( home_url( '/#experience' ) ); ?>" data-page="experience" class="nav-item flex flex-col items-center group transition-all <?php echo ( $current_slug === 'experience' ) ? 'text-gray-900 active-page' : 'text-gray-400 hover:text-black'; ?>">
                        <div class="nav-icon-box <?php echo ( $current_slug === 'experience' ) ? 'bg-black text-white shadow-md w-10 h-10' : 'w-9 h-9 text-gray-400'; ?> rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        </div>
                        <span class="text-[9px] font-medium mt-0.5 tracking-tight">Experience</span>
                    </a>
                </li>

                <!-- Contact -->
                <li>
                    <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" data-page="contact" class="nav-item flex flex-col items-center group transition-all <?php echo ( $current_slug === 'contact' ) ? 'text-gray-900 active-page' : 'text-gray-400 hover:text-black'; ?>">
                        <div class="nav-icon-box <?php echo ( $current_slug === 'contact' ) ? 'bg-black text-white shadow-md w-10 h-10' : 'w-9 h-9 text-gray-400'; ?> rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-[9px] font-medium mt-0.5 tracking-tight">Contact</span>
                    </a>
                </li>
            </ul>

            <!-- Bottom Theme Toggle -->
            <div id="nav-footer-divider" class="pt-2 border-t border-gray-100 w-full flex justify-center transition-colors duration-300">
                <button id="theme-toggle" aria-label="Toggle Theme" class="w-9 h-9 rounded-full flex items-center justify-center transition-all active:scale-95 cursor-pointer">
                    <!-- Sun Icon (Shown in Dark Mode) -->
                    <svg id="theme-icon-sun" class="w-4 h-4 pointer-events-none" style="display: none;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <!-- Moon Icon (Shown in Light Mode) -->
                    <svg id="theme-icon-moon" class="w-4 h-4 pointer-events-none" style="display: block;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path></svg>
                </button>
            </div>
        </nav>
    </div>

    <!-- Dynamic Hover Style Injector for Light/Dark Inversion -->
    <style id="nav-hover-style">
        /* Default Light Mode Hover Styles */
        .nav-item:hover .nav-icon-box:not(.bg-black) { background-color: #f3f4f6 !important; }
        .nav-item:hover { color: #000000 !important; }
        #theme-toggle:hover { background-color: #f3f4f6 !important; color: #000000 !important; }
    </style>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const navItems = document.querySelectorAll(".nav-item");
        const themeToggleBtn = document.getElementById("theme-toggle");
        const navBar = document.getElementById("floating-nav-bar");
        const navLogo = document.getElementById("nav-logo");
        const navLogoSpan = document.getElementById("nav-logo-span");
        const navFooterDivider = document.getElementById("nav-footer-divider");
        const sunIcon = document.getElementById("theme-icon-sun");
        const moonIcon = document.getElementById("theme-icon-moon");
        const hoverStyleTag = document.getElementById("nav-hover-style");

        function applyTheme(theme) {
            if (theme === "dark") {
                // Apply Dark Styles to Navbar
                navBar.style.backgroundColor = "rgba(24, 24, 27, 0.95)"; // zinc-900/95
                navBar.style.borderColor = "#27272a"; // zinc-800
                navBar.style.boxShadow = "0 10px 30px rgba(0,0,0,0.4)";
                
                navLogo.style.color = "#ffffff";
                navLogoSpan.style.color = "#71717a"; // zinc-500
                navFooterDivider.style.borderColor = "#27272a"; // zinc-800
                
                sunIcon.style.display = "block";
                moonIcon.style.display = "none";

                // Invert Hovers for Dark Mode (Lighter zinc backgrounds on hover)
                hoverStyleTag.innerHTML = `
                    .nav-item:hover .nav-icon-box:not(.bg-white) { background-color: #27272a !important; }
                    .nav-item:hover { color: #ffffff !important; }
                    #theme-toggle:hover { background-color: #27272a !important; color: #ffffff !important; }
                `;

                // Update text/icon colors for unselected items in dark mode
                navItems.forEach(nav => {
                    if(!nav.classList.contains("active-page")) {
                        nav.style.color = "#71717a"; // zinc-500
                        const iconBox = nav.querySelector("div");
                        if(iconBox && !iconBox.classList.contains("bg-white")) {
                            iconBox.style.color = "#71717a";
                        }
                    } else {
                        const iconBox = nav.querySelector("div");
                        if(iconBox) {
                            iconBox.className = "nav-icon-box bg-white text-black shadow-md w-10 h-10 rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95";
                        }
                    }
                });

                themeToggleBtn.style.color = "#71717a";
                localStorage.setItem("nav_theme", "dark");
            } else {
                // Apply Light Styles to Navbar
                navBar.style.backgroundColor = "rgba(255, 255, 255, 0.9)"; // white/90
                navBar.style.borderColor = "#f3f4f6"; // gray-100
                navBar.style.boxShadow = "0 10px 30px rgba(0,0,0,0.08)";
                
                navLogo.style.color = "#111827";
                navLogoSpan.style.color = "#9ca3af"; // gray-400
                navFooterDivider.style.borderColor = "#f3f4f6"; // gray-100
                
                sunIcon.style.display = "none";
                moonIcon.style.display = "block";

                // Standard Light Mode Hovers
                hoverStyleTag.innerHTML = `
                    .nav-item:hover .nav-icon-box:not(.bg-black) { background-color: #f3f4f6 !important; }
                    .nav-item:hover { color: #000000 !important; }
                    #theme-toggle:hover { background-color: #f3f4f6 !important; color: #000000 !important; }
                `;

                navItems.forEach(nav => {
                    if(!nav.classList.contains("active-page")) {
                        nav.style.color = "#9ca3af";
                        const iconBox = nav.querySelector("div");
                        if(iconBox && !iconBox.classList.contains("bg-black")) {
                            iconBox.style.color = "#9ca3af";
                        }
                    } else {
                        const iconBox = nav.querySelector("div");
                        if(iconBox) {
                            iconBox.className = "nav-icon-box bg-black text-white shadow-md w-10 h-10 rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95";
                        }
                    }
                });

                themeToggleBtn.style.color = "#9ca3af";
                localStorage.setItem("nav_theme", "light");
            }
        }

        // Initialize on load based on localStorage (defaulting to light)
        const savedTheme = localStorage.getItem("nav_theme") || "light";
        applyTheme(savedTheme);

        // Toggle on click
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener("click", function(e) {
                e.preventDefault();
                const currentTheme = localStorage.getItem("nav_theme") || "light";
                if (currentTheme === "dark") {
                    applyTheme("light");
                } else {
                    applyTheme("dark");
                }
            });
        }

        // Helper function to set a specific item as active
        function setActiveNav(targetDataPage) {
            const currentTheme = localStorage.getItem("nav_theme") || "light";
            navItems.forEach(nav => {
                const iconBox = nav.querySelector("div");
                if (!iconBox) return;
                
                if (nav.getAttribute("data-page") === targetDataPage) {
                    nav.classList.add("active-page");
                    if (currentTheme === "dark") {
                        iconBox.className = "nav-icon-box bg-white text-black shadow-md w-10 h-10 rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95";
                        nav.style.color = "#ffffff";
                    } else {
                        iconBox.className = "nav-icon-box bg-black text-white shadow-md w-10 h-10 rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95";
                        nav.style.color = "#111827";
                    }
                } else {
                    nav.classList.remove("active-page");
                    if (currentTheme === "dark") {
                        iconBox.className = "nav-icon-box w-9 h-9 text-zinc-500 rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95";
                        nav.style.color = "#71717a";
                    } else {
                        iconBox.className = "nav-icon-box w-9 h-9 text-gray-400 rounded-full flex items-center justify-center transition-all group-hover:scale-105 active:scale-95";
                        nav.style.color = "#9ca3af";
                    }
                }
            });
        }

        if (window.location.hash) {
            const hashPage = window.location.hash.substring(1);
            setActiveNav(hashPage);
        }

        navItems.forEach(item => {
            item.addEventListener("click", function() {
                const clickedPage = this.getAttribute("data-page");
                setActiveNav(clickedPage);
            });
        });
    });
    </script>

    <!-- Top Right Menu Blob Placeholder Header -->
    <header class="w-full py-8 px-12 md:px-24 flex justify-between items-center z-40">
        <div class="hidden md:block"></div>
        <div class="ml-auto flex items-center">
            <div class="w-8 h-8 rounded-full bg-gray-200/60 flex items-center justify-center"></div>
        </div>
    </header>