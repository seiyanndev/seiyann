<?php
/**
 * Template Name: Front Page
 * The template for displaying the homepage hero section
 *
 * @package Seiyann
 */

get_header(); 
?>

<!-- Embedded CSS for Staggered Fade-Up Entry Animations -->
<style>
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-up {
        animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
</style>

<!-- Hero Section Container -->
<main class="flex-1 flex flex-col justify-between px-12 md:px-24 lg:px-36 py-16 ml-24">
    <!-- Top Header Info with Fade Animation -->
    <div class="flex justify-between items-center w-full relative top-[16px] opacity-0 animate-fade-up">
        <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium">
            <span class="w-6 h-[1px] bg-gray-300"></span>
            <span>Graphic Designer &amp; Full-Stack Developer</span>
        </div>
        <!-- Top Right Menu Icon -->
        <button aria-label="Menu" class="text-gray-900 hover:opacity-75 transition-opacity cursor-pointer">
            <svg class="w-6 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Main Hero Content with Staggered Fade Animations -->
    <div id="home" class="my-auto max-w-4xl py-8">
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold tracking-tight leading-[1.1] mb-8 opacity-0 animate-fade-up delay-100">
            <span class="text-gray-900 block">I design visual identities,</span>
            <span class="text-gray-400 block">build digital products,</span>
            <span class="text-gray-400 block">and turn ideas into real solutions.</span>
        </h1>

        <p class="text-gray-500 text-sm md:text-base max-w-lg mb-10 leading-relaxed font-normal opacity-0 animate-fade-up delay-200">
            I'm a graphic designer and full-stack developer who loves creating meaningful brands and building functional, beautiful web experiences.
        </p>

        <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="inline-flex items-center space-x-4 group cursor-pointer opacity-0 animate-fade-up delay-300">
            <div class="w-12 h-12 rounded-full bg-black text-white flex items-center justify-center transition-transform duration-300 group-hover:scale-105 group-hover:bg-gray-800 shadow-md">
                <svg class="w-4 h-4 transform transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </div>
            <span class="text-xs font-bold tracking-widest uppercase text-gray-900 group-hover:text-gray-600 transition-colors">View My Work</span>
        </a>
    </div>

    <!-- Bottom Footer Info with Fade Animation -->
    <div class="flex justify-between items-end w-full pt-2 pb-2 relative -top-6 opacity-0 animate-fade-up delay-300">
        <!-- Scroll Indicator -->
        <div class="flex items-center space-x-4 text-xs tracking-widest text-gray-400 uppercase">
            <div class="w-[1px] h-8 bg-gray-300 animate-pulse"></div>
            <span>Scroll</span>
        </div>

        <!-- Capabilities Categories Indicator -->
        <div class="hidden md:flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium">
            <span>Brands</span>
            <span>/</span>
            <span>UI</span>
            <span>/</span>
            <span>Code</span>
            <span>/</span>
            <span>Products</span>
            <span class="w-12 h-[1px] bg-gray-300"></span>
        </div>
    </div>
</main>

<?>
get_footer();