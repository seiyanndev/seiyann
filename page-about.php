<?php
/**
 * Template Name: About Page
 * The template for displaying the About page
 *
 * @package Seiyann
 */

get_header(); 
?>

<!-- About Page Container (Dedicated Page Flow) -->
<main class="flex-1 flex flex-col justify-between px-12 md:px-24 lg:px-36 pt-12 pb-12 ml-24 overflow-hidden">
    <!-- Top Hero Section: Left Text & Right Profile Image -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center w-full animate-page-load">
        <!-- Left Column: Intro & Bio -->
        <div class="lg:col-span-7 flex flex-col justify-center">
            <!-- Section Tag -->
            <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;">
                <span class="w-6 h-[1px] bg-gray-300"></span>
                <span>About Me</span>
            </div>

            <!-- Main Title -->
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight text-gray-900 leading-[1.1] mb-6">
                <span class="block">Designing experiences.</span>
                <span class="text-gray-400 block">Building products.</span>
            </h1>

            <!-- Bio Description -->
            <p class="text-gray-500 text-sm max-w-lg leading-relaxed font-normal mb-8">
                I'm a graphic designer and full-stack developer passionate about building digital experiences from concept to deployment. I enjoy blending strategy, branding, interface design, and engineering into products that are both functional and visually refined.
            </p>

            <!-- My Approach Sub-section -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 text-[10px] tracking-widest text-gray-400 uppercase font-semibold mb-2" style="font-family: 'Montserrat', sans-serif;">
                    <span>My Approach</span>
                    <span class="w-6 h-[1px] bg-gray-300"></span>
                </div>
                <p class="text-xs text-gray-600 font-medium leading-relaxed italic">
                    I believe great products start with a clear problem, thoughtful design, and solid code.
                </p>
            </div>

            <!-- CTA Button -->
            <div>
                <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="inline-flex items-center space-x-3 py-3 px-6 rounded-full bg-black hover:bg-gray-800 text-white text-xs font-bold tracking-widest uppercase transition-all duration-300 shadow-sm group cursor-pointer" style="font-family: 'Montserrat', sans-serif;">
                    <span>View My Work</span>
                    <span class="w-7 h-7 rounded-full bg-white/10 flex items-center justify-center group-hover:translate-x-1 transition-transform">&rarr;</span>
                </a>
            </div>
        </div>

        <!-- Right Column: Profile Image & Floating Metadata -->
        <div class="lg:col-span-5 flex justify-center relative">
            <div class="relative w-full max-w-md bg-gray-100 rounded-2xl overflow-hidden aspect-[4/5] flex items-center justify-center border border-gray-200/60 shadow-lg">
                <!-- Grayscale Profile Image -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/aboutimg.jpg" alt="Profile Photo" class="absolute inset-w-full h-full object-cover grayscale w-full h-full">
                
                <!-- Floating Vertical Badge -->
                <div class="absolute right-4 top-4 text-[9px] tracking-widest uppercase text-white drop-shadow-md font-semibold space-y-1 text-right pointer-events-none hidden sm:block z-10" style="font-family: 'Montserrat', sans-serif;">
                    <span class="block">Designer</span>
                    <span class="block">Developer</span>
                    <span class="block text-gray-200">Creative</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Metrics Grid (4 Columns) with compact wireframe sizing -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 pt-12 mt-12 border-t border-gray-200/60 animate-page-load load-delay-2" style="font-family: 'Montserrat', sans-serif;">
        <!-- Metric 1 -->
        <div>
            <h4 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1">5+</h4>
            <p class="text-[9px] tracking-widest uppercase text-gray-400 font-semibold mb-1">Projects Completed</p>
            <p class="text-[11px] text-gray-500 font-normal leading-relaxed capitalize-none" style="text-transform: none;">From brand identities to full-stack web applications.</p>
        </div>

        <!-- Metric 2 -->
        <div>
            <h4 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1">2+</h4>
            <p class="text-[9px] tracking-widest uppercase text-gray-400 font-semibold mb-1">Years of Experience</p>
            <p class="text-[11px] text-gray-500 font-normal leading-relaxed capitalize-none" style="text-transform: none;">In design, development, and digital product creation.</p>
        </div>

        <!-- Metric 3 -->
        <div>
            <h4 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1">15+</h4>
            <p class="text-[9px] tracking-widest uppercase text-gray-400 font-semibold mb-1">Tech Stacks</p>
            <p class="text-[11px] text-gray-500 font-normal leading-relaxed capitalize-none" style="text-transform: none;">Modern tools for design, development, and deployment.</p>
        </div>

        <!-- Metric 4 -->
        <div>
            <h4 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1">1</h4>
            <p class="text-[9px] tracking-widest uppercase text-gray-400 font-semibold mb-1">Goal</p>
            <p class="text-[11px] text-gray-500 font-normal leading-relaxed capitalize-none" style="text-transform: none;">To keep building, creating, and making an impact.</p>
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
</style>

<?php 
get_footer();