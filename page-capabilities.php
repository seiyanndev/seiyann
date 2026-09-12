<?php
/**
 * Template Name: Capabilities Page
 * The template for displaying the Capabilities page
 *
 * @package Seiyann
 */

get_header(); 
?>

<!-- Capabilities Page Container (Dedicated Page Flow) -->
<main class="flex-1 flex flex-col justify-between px-12 md:px-24 lg:px-36 pt-12 pb-12 ml-24 overflow-hidden">
    <!-- Top Header & Side Description (Aligned Baselines) -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end w-full gap-6 animate-page-load">
        <div>
            <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-2" style="font-family: 'Montserrat', sans-serif;">
                <span class="w-6 h-[1px] bg-gray-300"></span>
                <span>What I Do</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight text-gray-900 leading-[1.1] whitespace-nowrap">
                <span>My Capabilities</span> <span class="text-gray-400">&amp; Expertise.</span>
            </h1>
            <p class="text-gray-500 text-sm max-w-md mt-3 leading-relaxed font-normal">
                I combine design and development to create meaningful digital experiences. Here are the key areas where I bring value.
            </p>
        </div>

        <!-- Top Right Meta & Back Link -->
        <div class="flex flex-col items-start md:items-end justify-between h-full space-y-4">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hidden md:inline-flex items-center space-x-1 text-xs tracking-widest text-gray-400 uppercase font-medium hover:text-black transition-colors" style="font-family: 'Montserrat', sans-serif;">
                <span>&larr; Back to Home</span>
            </a>
            <div class="text-right hidden md:block">
                <p class="text-xs tracking-widest text-gray-400 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">Design. Code. Build.</p>
                <p class="text-xs text-gray-500 max-w-xs mt-1 leading-relaxed">From visual identity to fully functional web applications, I bring ideas to life across the entire product journey.</p>
            </div>
        </div>
    </div>

    <!-- Capabilities Carousel Viewport Container (Stacked Relative Pages for Fade Effect) -->
    <div id="carousel-viewport" class="my-12 relative w-full min-h-[460px]">
        
        <!-- PAGE 1 (Items 1-4) -->
        <div class="carousel-page absolute inset-0 grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-16 opacity-0 pointer-events-none transition-opacity duration-500 ease-in-out">
            <!-- 1. Brand Identity -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-1">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;">
                            <span>01</span>
                            <span class="w-6 h-[1px] bg-gray-300"></span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-gray-100/80 flex items-center justify-center text-gray-800 mb-4 border border-gray-200/60 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Brand Identity</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Creating memorable visual systems that help businesses stand out.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold" style="font-family: 'Montserrat', sans-serif;">
                        <li>• Logo Design</li>
                        <li>• Brand Guidelines</li>
                        <li>• Print &amp; Digital Collateral</li>
                        <li>• Visual Systems</li>
                    </ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-100 rounded-xl overflow-hidden h-[200px] flex items-center justify-center border border-gray-200/60 shadow-sm">
                        <span class="text-xs tracking-widest text-gray-400 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">Locana Preview</span>
                    </div>
                    <div class="pt-2">
                        <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="w-full py-2.5 px-4 rounded-xl bg-black hover:bg-gray-800 text-white text-xs font-bold tracking-widest uppercase transition-all duration-300 flex items-center justify-between shadow-sm group cursor-pointer" style="font-family: 'Montserrat', sans-serif;">
                            <span>Explore Projects</span>
                            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 2. UI / UX Design -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-2">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;">
                            <span>02</span>
                            <span class="w-6 h-[1px] bg-gray-300"></span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-gray-100/80 flex items-center justify-center text-gray-800 mb-4 border border-gray-200/60 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">UI / UX Design</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Designing interfaces that are beautiful, intuitive, and user-centered.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold" style="font-family: 'Montserrat', sans-serif;">
                        <li>• Wireframes &amp; Prototypes</li>
                        <li>• User Research</li>
                        <li>• Interactive Design</li>
                        <li>• Responsive Design</li>
                    </ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-900 rounded-xl overflow-hidden h-[200px] flex items-center justify-center shadow-sm">
                        <span class="text-xs tracking-widest text-zinc-500 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">UI / UX App</span>
                    </div>
                    <div class="pt-2">
                        <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="w-full py-2.5 px-4 rounded-xl bg-black hover:bg-gray-800 text-white text-xs font-bold tracking-widest uppercase transition-all duration-300 flex items-center justify-between shadow-sm group cursor-pointer" style="font-family: 'Montserrat', sans-serif;">
                            <span>Explore Projects</span>
                            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 3. Full-Stack Development -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-3">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;">
                            <span>03</span>
                            <span class="w-6 h-[1px] bg-gray-300"></span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-gray-100/80 flex items-center justify-center text-gray-800 mb-4 border border-gray-200/60 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Full-Stack Development</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Building responsive web applications from database to deployment.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold" style="font-family: 'Montserrat', sans-serif;">
                        <li>• Frontend Development</li>
                        <li>• Backend Development</li>
                        <li>• Database Management</li>
                        <li>• Cloud Deployment</li>
                    </ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-zinc-900 rounded-xl overflow-hidden h-[200px] flex items-center justify-center shadow-sm">
                        <span class="text-xs tracking-widest text-zinc-500 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">Code Stack</span>
                    </div>
                    <div class="pt-2">
                        <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="w-full py-2.5 px-4 rounded-xl bg-black hover:bg-gray-800 text-white text-xs font-bold tracking-widest uppercase transition-all duration-300 flex items-center justify-between shadow-sm group cursor-pointer" style="font-family: 'Montserrat', sans-serif;">
                            <span>Explore Projects</span>
                            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 4. Creative Direction -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-4">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;">
                            <span>04</span>
                            <span class="w-6 h-[1px] bg-gray-300"></span>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-gray-100/80 flex items-center justify-center text-gray-800 mb-4 border border-gray-200/60 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Creative Direction</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Turning ideas into complete digital products and brand experiences.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold" style="font-family: 'Montserrat', sans-serif;">
                        <li>• Concept Development</li>
                        <li>• Art Direction</li>
                        <li>• Visual Storytelling</li>
                        <li>• End-to-End Production</li>
                    </ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-100 rounded-xl overflow-hidden h-[200px] flex items-center justify-center border border-gray-200/60 shadow-sm">
                        <span class="text-xs tracking-widest text-gray-400 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">Creative Preview</span>
                    </div>
                    <div class="pt-2">
                        <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="w-full py-2.5 px-4 rounded-xl bg-black hover:bg-gray-800 text-white text-xs font-bold tracking-widest uppercase transition-all duration-300 flex items-center justify-between shadow-sm group cursor-pointer" style="font-family: 'Montserrat', sans-serif;">
                            <span>Explore Projects</span>
                            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- PAGE 2 (Items 5-8) -->
        <div class="carousel-page absolute inset-0 grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-16 opacity-0 pointer-events-none transition-opacity duration-500 ease-in-out">
            <!-- 5. Design Systems -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-1">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>05</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Design Systems</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Building scalable UI component libraries and design tokens.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• Tokenization</li><li>• Component Libs</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-100 rounded-xl overflow-hidden h-[200px] flex items-center justify-center border border-gray-200/60"><span class="text-xs uppercase text-gray-400">Design Sys</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
            <!-- 6. Mobile Apps -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-2">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>06</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Mobile Apps</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Cross-platform native applications engineered for performance.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• iOS &amp; Android</li><li>• React Native</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-900 rounded-xl overflow-hidden h-[200px] flex items-center justify-center"><span class="text-xs uppercase text-zinc-500">Mobile App</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
            <!-- 7. API Architecture -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-3">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>07</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">API Architecture</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Designing robust and secure RESTful and GraphQL endpoints.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• GraphQL</li><li>• REST APIs</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-zinc-900 rounded-xl overflow-hidden h-[200px] flex items-center justify-center"><span class="text-xs uppercase text-zinc-500">API Arch</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
            <!-- 8. Motion Design -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-4">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>08</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Motion Design</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Bringing interactions to life with fluid micro-animations.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• Micro-interactions</li><li>• Lottie/SVG</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-100 rounded-xl overflow-hidden h-[200px] flex items-center justify-center border border-gray-200/60"><span class="text-xs uppercase text-gray-400">Motion</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
        </div>

        <!-- PAGE 3 (Items 9-12) -->
        <div class="carousel-page absolute inset-0 grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-16 opacity-0 pointer-events-none transition-opacity duration-500 ease-in-out">
            <!-- 9. E-Commerce Solutions -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-1">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>09</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">E-Commerce</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">High-converting online storefronts and payment gateway setups.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• WooCommerce</li><li>• Shopify Dev</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-100 rounded-xl overflow-hidden h-[200px] flex items-center justify-center border border-gray-200/60"><span class="text-xs uppercase text-gray-400">E-Commerce</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
            <!-- 10. Cloud Infrastructure -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-2">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>10</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Cloud Infrastructure</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Scalable cloud hosting, CI/CD pipelines, and server management.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• AWS / GCP</li><li>• Docker &amp; CI/CD</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-900 rounded-xl overflow-hidden h-[200px] flex items-center justify-center"><span class="text-xs uppercase text-zinc-500">Cloud Infra</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
            <!-- 11. SEO Optimization -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-3">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>11</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">SEO &amp; Performance</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Technical audits and speed optimizations for peak search ranking.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• Core Web Vitals</li><li>• Technical SEO</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-zinc-900 rounded-xl overflow-hidden h-[200px] flex items-center justify-center"><span class="text-xs uppercase text-zinc-500">SEO &amp; Perf</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
            <!-- 12. Accessibility (a11y) -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-4">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>12</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Accessibility (a11y)</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Ensuring web apps comply with WCAG standards for all users.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• WCAG Compliance</li><li>• Screen Readers</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-100 rounded-xl overflow-hidden h-[200px] flex items-center justify-center border border-gray-200/60"><span class="text-xs uppercase text-gray-400">Accessibility</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
        </div>

        <!-- PAGE 4 (Items 13-16) -->
        <div class="carousel-page absolute inset-0 grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-16 opacity-0 pointer-events-none transition-opacity duration-500 ease-in-out">
            <!-- 13. Data Analytics -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-1">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>13</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Data Analytics</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Custom tracking pipelines and user behavior reporting dashboards.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• GA4 Tracking</li><li>• Custom Dashboards</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-100 rounded-xl overflow-hidden h-[200px] flex items-center justify-center border border-gray-200/60"><span class="text-xs uppercase text-gray-400">Analytics</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
            <!-- 14. Cybersecurity Audits -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-2">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>14</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Security Audits</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Vulnerability assessments and penetration testing for web applications.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• Penetration Testing</li><li>• OWASP Compliance</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-900 rounded-xl overflow-hidden h-[200px] flex items-center justify-center"><span class="text-xs uppercase text-zinc-500">Security</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
            <!-- 15. Content Strategy -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-3">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>15</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Content Strategy</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Structuring brand messaging and content architecture for maximum impact.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• Copywriting</li><li>• Information Architecture</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-zinc-900 rounded-xl overflow-hidden h-[200px] flex items-center justify-center"><span class="text-xs uppercase text-zinc-500">Content</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
            <!-- 16. Prototyping Lab -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-4">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>16</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Prototyping Lab</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Experimental concept testing and hardware-software integration.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• Rapid Prototyping</li><li>• IoT Concepts</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-100 rounded-xl overflow-hidden h-[200px] flex items-center justify-center border border-gray-200/60"><span class="text-xs uppercase text-gray-400">Prototype</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
        </div>

        <!-- PAGE 5 (Items 17-18 - Last Page with 2 items) -->
        <div class="carousel-page absolute inset-0 grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-16 opacity-0 pointer-events-none transition-opacity duration-500 ease-in-out">
            <!-- 17. Brand Consulting -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-1">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>17</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Brand Consulting</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Strategic roadmapping and positioning for scaling enterprises.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• Strategic Roadmaps</li><li>• Brand Audits</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-100 rounded-xl overflow-hidden h-[200px] flex items-center justify-center border border-gray-200/60"><span class="text-xs uppercase text-gray-400">Consulting</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
            <!-- 18. Maintenance & Support -->
            <div class="capability-card grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch animate-page-load load-delay-2">
                <div class="flex flex-col justify-between">
                    <div>
                        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;"><span>18</span><span class="w-6 h-[1px] bg-gray-300"></span></div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Maintenance &amp; Support</h3>
                        <p class="text-xs text-gray-500 mb-4 leading-relaxed">Ongoing technical support, security patches, and iterative improvements.</p>
                    </div>
                    <ul class="space-y-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold"><li>• SLA Support</li><li>• Iterative Updates</li></ul>
                </div>
                <div class="flex flex-col justify-between h-full">
                    <div class="bg-gray-900 rounded-xl overflow-hidden h-[200px] flex items-center justify-center"><span class="text-xs uppercase text-zinc-500">Support</span></div>
                    <div class="pt-2"><a href="#" class="w-full py-2.5 px-4 rounded-xl bg-black text-white text-xs font-bold tracking-widest uppercase flex items-center justify-between"><span>Explore</span><span>&rarr;</span></a></div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bottom Carousel Navigation Bar matching requested format -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center w-full pt-4 text-xs tracking-widest text-gray-400 uppercase font-medium animate-page-load load-delay-4 gap-4" style="font-family: 'Montserrat', sans-serif;">
        <!-- Left Subtitle -->
        <span>Skills meet creativity, ideas meet execution.</span>

        <!-- Right Side: Counter, Progress Bar, and Navigation Arrows -->
        <div class="flex items-center space-x-6">
            <span id="carousel-counter">01 / 05</span>
            <!-- Progress Bar Line -->
            <div class="w-32 h-[1px] bg-gray-200 relative overflow-hidden hidden sm:block">
                <div id="carousel-progress-bar" class="absolute top-0 left-0 h-full bg-gray-900 transition-all duration-500" style="width: 20%;"></div>
            </div>
            <!-- Navigation Arrow Buttons -->
            <div class="flex items-center space-x-4">
                <button id="prev-btn" class="p-2 text-gray-400 hover:text-black transition-colors cursor-pointer focus:outline-none" aria-label="Previous Page">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </button>
                <button id="next-btn" class="p-2 text-gray-400 hover:text-black transition-colors cursor-pointer focus:outline-none" aria-label="Next Page">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </div>
</main>

<style>
    @keyframes pageLoadEntry {
        from {
            opacity: 0;
            transform: translateY(16px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-page-load {
        opacity: 0;
        animation: pageLoadEntry 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .load-delay-1 { animation-delay: 0.1s; }
    .load-delay-2 { animation-delay: 0.15s; }
    .load-delay-3 { animation-delay: 0.2s; }
    .load-delay-4 { animation-delay: 0.25s; }

    /* Custom Fade Classes for Carousel */
    .carousel-page.active-page {
        opacity: 1;
        pointer-events: auto;
        position: relative;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const pages = document.querySelectorAll(".carousel-page");
    const counter = document.getElementById("carousel-counter");
    const progressBar = document.getElementById("carousel-progress-bar");
    const prevBtn = document.getElementById("prev-btn");
    const nextBtn = document.getElementById("next-btn");

    let currentPage = 0;
    const totalPages = pages.length;

    function updateCarousel() {
        pages.forEach((page, index) => {
            if (index === currentPage) {
                page.classList.add("active-page");
                
                // Re-trigger load entry animation for items inside the active page on change
                const animatedElements = page.querySelectorAll(".animate-page-load");
                animatedElements.forEach(el => {
                    el.style.animation = 'none';
                    el.offsetHeight; // Trigger reflow
                    el.style.animation = '';
                });
            } else {
                page.classList.remove("active-page");
            }
        });

        // Format counter with leading zeros
        const currentStr = String(currentPage + 1).padStart(2, '0');
        const totalStr = String(totalPages).padStart(2, '0');
        counter.textContent = `${currentStr} / ${totalStr}`;

        // Update progress bar width percentage
        if (progressBar) {
            const progressPercent = ((currentPage + 1) / totalPages) * 100;
            progressBar.style.width = `${progressPercent}%`;
        }
    }

    nextBtn.addEventListener("click", function() {
        currentPage = (currentPage + 1) % totalPages;
        updateCarousel();
    });

    prevBtn.addEventListener("click", function() {
        currentPage = (currentPage - 1 + totalPages) % totalPages;
        updateCarousel();
    });

    // Initialize state
    updateCarousel();
});
</script>

<?php 
get_footer();