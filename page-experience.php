<?php
/**
 * Template Name: Experience Page
 * The template for displaying the Experience page
 *
 * @package Seiyann
 */

get_header(); 
?>

<!-- Experience Page Container (Dedicated Page Flow) -->
<main class="flex-1 flex flex-col justify-between px-12 md:px-24 lg:px-36 pt-12 pb-12 ml-24 overflow-hidden">
    <!-- Top Header & Subtext -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end w-full gap-6 animate-page-load">
        <div>
            <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-2" style="font-family: 'Montserrat', sans-serif;">
                <span class="w-6 h-[1px] bg-gray-300"></span>
                <span>Experience</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight text-gray-900 leading-[1.1]">
                <span class="block">My professional</span>
                <span class="text-gray-400 block">journey.</span>
            </h1>
            <p class="text-gray-500 text-sm max-w-md mt-3 leading-relaxed font-normal">
                Building experience through design, development, and real-world projects.
            </p>
        </div>

        <!-- Top Right Meta -->
        <div class="hidden md:block text-right">
            <p class="text-xs tracking-widest text-gray-400 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">Designer. Developer. Creative</p>
        </div>
    </div>

    <!-- Draggable / Swipable Career Cards Carousel Container with Smooth Momentum -->
    <div class="my-12 animate-page-load load-delay-1 relative">
        <div id="experience-carousel-wrapper" class="overflow-x-auto cursor-grab active:cursor-grabbing pb-4 select-none scrollbar-none scroll-smooth">
            <div id="experience-carousel-track" class="flex gap-8 w-max">
                
                <!-- Role 1: Social Media Manager / Graphic Designer -->
                <div class="w-[340px] md:w-[380px] flex-shrink-0 flex flex-col justify-between bg-white/50 backdrop-blur-sm p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <!-- Synchronized Card Number & Timeline Anchor -->
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-2.5 h-2.5 rounded-full bg-black flex-shrink-0"></div>
                            <span class="text-xs font-bold text-gray-900 tracking-wider" style="font-family: 'Montserrat', sans-serif;">01</span>
                            <div class="flex-1 h-[1px] bg-gray-200"></div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold" style="font-family: 'Montserrat', sans-serif;">2025 – Present</span>
                        </div>

                        <h3 class="text-base font-bold text-gray-900 mb-1" style="font-family: 'Montserrat', sans-serif;">Social Media Manager / Graphic Designer</h3>
                        <p class="text-xs text-gray-400 font-medium mb-4" style="font-family: 'Montserrat', sans-serif;">XYZ Digital Agency</p>

                        <ul class="space-y-2 text-xs text-gray-600 leading-relaxed list-disc list-inside mb-6">
                            <li>Managed social media content and campaigns across multiple platforms.</li>
                            <li>Created graphics and digital materials for brand promotion.</li>
                            <li>Planned and organized content calendar and influencer collaborations.</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <a href="#" class="inline-flex items-center space-x-2 text-[10px] font-bold tracking-widest uppercase text-gray-900 hover:text-black transition-colors group" style="font-family: 'Montserrat', sans-serif;">
                            <span>View Details</span>
                            <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">&nearr;</span>
                        </a>
                    </div>
                </div>

                <!-- Role 2: Web Developer / IT Specialist -->
                <div class="w-[340px] md:w-[380px] flex-shrink-0 flex flex-col justify-between bg-white/50 backdrop-blur-sm p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-2.5 h-2.5 rounded-full bg-white border-2 border-gray-400 flex-shrink-0"></div>
                            <span class="text-xs font-bold text-gray-400 tracking-wider" style="font-family: 'Montserrat', sans-serif;">02</span>
                            <div class="flex-1 h-[1px] bg-gray-200"></div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold" style="font-family: 'Montserrat', sans-serif;">2024 – 2025</span>
                        </div>

                        <h3 class="text-base font-bold text-gray-900 mb-1" style="font-family: 'Montserrat', sans-serif;">Web Developer / IT Specialist</h3>
                        <p class="text-xs text-gray-400 font-medium mb-4" style="font-family: 'Montserrat', sans-serif;">ABC Solutions</p>

                        <ul class="space-y-2 text-xs text-gray-600 leading-relaxed list-disc list-inside mb-6">
                            <li>Developed and maintained web applications and internal systems.</li>
                            <li>Worked with UI/UX and frontend technologies (HTML, CSS, JavaScript).</li>
                            <li>Collaborated with cross-functional teams on technical projects.</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <a href="#" class="inline-flex items-center space-x-2 text-[10px] font-bold tracking-widest uppercase text-gray-900 hover:text-black transition-colors group" style="font-family: 'Montserrat', sans-serif;">
                            <span>View Details</span>
                            <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">&nearr;</span>
                        </a>
                    </div>
                </div>

                <!-- Role 3: Project / Organization Experience -->
                <div class="w-[340px] md:w-[380px] flex-shrink-0 flex flex-col justify-between bg-white/50 backdrop-blur-sm p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-2.5 h-2.5 rounded-full bg-white border-2 border-gray-400 flex-shrink-0"></div>
                            <span class="text-xs font-bold text-gray-400 tracking-wider" style="font-family: 'Montserrat', sans-serif;">03</span>
                            <div class="flex-1 h-[1px] bg-gray-200"></div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold" style="font-family: 'Montserrat', sans-serif;">2022 – 2024</span>
                        </div>

                        <h3 class="text-base font-bold text-gray-900 mb-1" style="font-family: 'Montserrat', sans-serif;">Project / Organization Experience</h3>
                        <p class="text-xs text-gray-400 font-medium mb-4" style="font-family: 'Montserrat', sans-serif;">University / Student Organization</p>

                        <ul class="space-y-2 text-xs text-gray-600 leading-relaxed list-disc list-inside mb-6">
                            <li>Led and participated in various projects and initiatives.</li>
                            <li>Organized events, workshops, and community activities.</li>
                            <li>Collaborated with teams and stakeholders to achieve goals.</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <a href="#" class="inline-flex items-center space-x-2 text-[10px] font-bold tracking-widest uppercase text-gray-900 hover:text-black transition-colors group" style="font-family: 'Montserrat', sans-serif;">
                            <span>View Details</span>
                            <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">&nearr;</span>
                        </a>
                    </div>
                </div>

                <!-- Role 4: UI/UX Designer Intern -->
                <div class="w-[340px] md:w-[380px] flex-shrink-0 flex flex-col justify-between bg-white/50 backdrop-blur-sm p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-2.5 h-2.5 rounded-full bg-white border-2 border-gray-400 flex-shrink-0"></div>
                            <span class="text-xs font-bold text-gray-400 tracking-wider" style="font-family: 'Montserrat', sans-serif;">04</span>
                            <div class="flex-1 h-[1px] bg-gray-200"></div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold" style="font-family: 'Montserrat', sans-serif;">2021 – 2022</span>
                        </div>

                        <h3 class="text-base font-bold text-gray-900 mb-1" style="font-family: 'Montserrat', sans-serif;">UI/UX Designer Intern</h3>
                        <p class="text-xs text-gray-400 font-medium mb-4" style="font-family: 'Montserrat', sans-serif;">Design Studio Hub</p>

                        <ul class="space-y-2 text-xs text-gray-600 leading-relaxed list-disc list-inside mb-6">
                            <li>Assisted in conducting user research and persona mapping.</li>
                            <li>Created wireframes, user flows, and interactive prototypes in Figma.</li>
                            <li>Participated in client design reviews and design system maintenance.</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <a href="#" class="inline-flex items-center space-x-2 text-[10px] font-bold tracking-widest uppercase text-gray-900 hover:text-black transition-colors group" style="font-family: 'Montserrat', sans-serif;">
                            <span>View Details</span>
                            <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">&nearr;</span>
                        </a>
                    </div>
                </div>

                <!-- Role 5: Freelance Web Developer -->
                <div class="w-[340px] md:w-[380px] flex-shrink-0 flex flex-col justify-between bg-white/50 backdrop-blur-sm p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-2.5 h-2.5 rounded-full bg-white border-2 border-gray-400 flex-shrink-0"></div>
                            <span class="text-xs font-bold text-gray-400 tracking-wider" style="font-family: 'Montserrat', sans-serif;">05</span>
                            <div class="flex-1 h-[1px] bg-gray-200"></div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold" style="font-family: 'Montserrat', sans-serif;">2020 – 2021</span>
                        </div>

                        <h3 class="text-base font-bold text-gray-900 mb-1" style="font-family: 'Montserrat', sans-serif;">Freelance Web Developer</h3>
                        <p class="text-xs text-gray-400 font-medium mb-4" style="font-family: 'Montserrat', sans-serif;">Self-Employed</p>

                        <ul class="space-y-2 text-xs text-gray-600 leading-relaxed list-disc list-inside mb-6">
                            <li>Built custom WordPress websites and landing pages for small businesses.</li>
                            <li>Optimized site performance, responsiveness, and basic on-page SEO.</li>
                            <li>Managed direct client communications and project requirements.</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <a href="#" class="inline-flex items-center space-x-2 text-[10px] font-bold tracking-widest uppercase text-gray-900 hover:text-black transition-colors group" style="font-family: 'Montserrat', sans-serif;">
                            <span>View Details</span>
                            <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">&nearr;</span>
                        </a>
                    </div>
                </div>

                <!-- Role 6: Open Source Contributor -->
                <div class="w-[340px] md:w-[380px] flex-shrink-0 flex flex-col justify-between bg-white/50 backdrop-blur-sm p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-md transition-shadow">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-2.5 h-2.5 rounded-full bg-white border-2 border-gray-400 flex-shrink-0"></div>
                            <span class="text-xs font-bold text-gray-400 tracking-wider" style="font-family: 'Montserrat', sans-serif;">06</span>
                            <div class="flex-1 h-[1px] bg-gray-200"></div>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold" style="font-family: 'Montserrat', sans-serif;">2019 – 2020</span>
                        </div>

                        <h3 class="text-base font-bold text-gray-900 mb-1" style="font-family: 'Montserrat', sans-serif;">Open Source Contributor</h3>
                        <p class="text-xs text-gray-400 font-medium mb-4" style="font-family: 'Montserrat', sans-serif;">Community Projects</p>

                        <ul class="space-y-2 text-xs text-gray-600 leading-relaxed list-disc list-inside mb-6">
                            <li>Contributed bug fixes and documentation to frontend repositories.</li>
                            <li>Collaborated globally via GitHub issues and pull requests.</li>
                            <li>Engaged with developer communities to improve software accessibility.</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <a href="#" class="inline-flex items-center space-x-2 text-[10px] font-bold tracking-widest uppercase text-gray-900 hover:text-black transition-colors group" style="font-family: 'Montserrat', sans-serif;">
                            <span>View Details</span>
                            <span class="group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform">&nearr;</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- Draggable Indicator Hint placed under the carousel on the right side -->
        <div class="flex justify-end w-full mt-3 pr-2">
            <div class="flex items-center space-x-2 text-[10px] tracking-widest uppercase text-gray-400 font-semibold bg-white/80 border border-gray-200/60 py-1.5 px-3 rounded-full shadow-sm animate-pulse" style="font-family: 'Montserrat', sans-serif;">
                <span>Drag to explore</span>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </div>
        </div>
    </div>

    <!-- Bottom Metrics Grid (4 Columns matching wireframe sizing) -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 pt-12 mt-12 border-t border-gray-200/60 animate-page-load load-delay-2" style="font-family: 'Montserrat', sans-serif;">
        <!-- Metric 1 -->
        <div>
            <h4 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1">6+</h4>
            <p class="text-[9px] tracking-widest uppercase text-gray-400 font-semibold mb-1">Roles</p>
            <p class="text-[11px] text-gray-500 font-normal leading-relaxed capitalize-none" style="text-transform: none;">Across different fields and areas of expertise.</p>
        </div>

        <!-- Metric 2 -->
        <div>
            <h4 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1">10+</h4>
            <p class="text-[9px] tracking-widest uppercase text-gray-400 font-semibold mb-1">Projects</p>
            <p class="text-[11px] text-gray-500 font-normal leading-relaxed capitalize-none" style="text-transform: none;">From digital campaigns to web applications.</p>
        </div>

        <!-- Metric 3 -->
        <div>
            <h4 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1">15+</h4>
            <p class="text-[9px] tracking-widest uppercase text-gray-400 font-semibold mb-1">Skills</p>
            <p class="text-[11px] text-gray-500 font-normal leading-relaxed capitalize-none" style="text-transform: none;">In design, development, and communication.</p>
        </div>

        <!-- Metric 4 -->
        <div>
            <h4 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1">5+</h4>
            <p class="text-[9px] tracking-widest uppercase text-gray-400 font-semibold mb-1">Years of Experience</p>
            <p class="text-[11px] text-gray-500 font-normal leading-relaxed capitalize-none" style="text-transform: none;">Growing, learning, and creating impact.</p>
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
    .load-delay-2 { animation-delay: 0.2s; }

    /* Hide scrollbars for a clean custom look */
    .scrollbar-none::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-none {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const slider = document.getElementById("experience-carousel-wrapper");
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener("mousedown", (e) => {
        isDown = true;
        slider.classList.add("active");
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener("mouseleave", () => {
        isDown = false;
        slider.classList.remove("active");
    });

    slider.addEventListener("mouseup", () => {
        isDown = false;
        slider.classList.remove("active");
    });

    slider.addEventListener("mousemove", (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; // Smooth multiplication speed
        slider.scrollLeft = scrollLeft - walk;
    });

    // Enable smooth touch swiping support for mobile/trackpads
    let touchStartX = 0;
    let touchScrollLeft = 0;

    slider.addEventListener("touchstart", (e) => {
        touchStartX = e.touches[0].pageX - slider.offsetLeft;
        touchScrollLeft = slider.scrollLeft;
    }, {passive: true});

    slider.addEventListener("touchmove", (e) => {
        if (!touchStartX) return;
        const x = e.touches[0].pageX - slider.offsetLeft;
        const walk = (x - touchStartX) * 1.5;
        slider.scrollLeft = touchScrollLeft - walk;
    }, {passive: true});
});
</script>

<?php 
get_footer();