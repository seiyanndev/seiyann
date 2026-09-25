<?php
/**
 * Template Name: Work Page
 * The template for displaying the Work page
 *
 * @package Seiyann
 */

get_header(); 
?>

<!-- Work Page Container (Dedicated Page Flow) -->
<main class="flex-1 flex flex-col justify-between px-12 md:px-24 lg:px-36 pt-12 pb-12 ml-24">
    <!-- Top Header & Filter Tabs -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end w-full gap-6 animate-page-load">
        <!-- Left Column: Title and Subtext -->
        <div>
            <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-2" style="font-family: 'Montserrat', sans-serif;">
                <span class="w-6 h-[1px] bg-gray-300"></span>
                <span>My Work</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight text-gray-950 whitespace-nowrap">Selected Projects</h1>
        </div>

        <!-- Right Column: Back to Home and Filter Tabs -->
        <div class="flex flex-col items-start md:items-end justify-between h-full space-y-4">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hidden md:inline-flex items-center space-x-1 text-xs tracking-widest text-gray-400 uppercase font-medium hover:text-black transition-colors" style="font-family: 'Montserrat', sans-serif;">
                <span>&larr; Back to Home</span>
            </a>

            <div class="hidden md:flex items-center space-x-6 text-xs font-semibold tracking-wider uppercase" style="font-family: 'Montserrat', sans-serif;">
                <button class="filter-btn text-gray-900 border-b-2 border-black pb-1 cursor-pointer transition-all" data-filter="all">All</button>
                <button class="filter-btn text-gray-400 hover:text-black transition-colors pb-1 cursor-pointer transition-all" data-filter="branding">Branding</button>
                <button class="filter-btn text-gray-400 hover:text-black transition-colors pb-1 cursor-pointer transition-all" data-filter="ui-ux">UI/UX</button>
                <button class="filter-btn text-gray-400 hover:text-black transition-colors pb-1 cursor-pointer transition-all" data-filter="web development">Web Development</button>
            </div>
        </div>
    </div>

    <!-- Second Row: Subtext -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end w-full mt-6 gap-4">
        <p class="text-gray-500 text-sm max-w-md leading-relaxed font-normal">
            A collection of brands, interfaces, and web applications I've designed and developed. Each project represents a unique problem, process, and solution.
        </p>
    </div>

    <!-- Projects Grid (Library of Cards) -->
    <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-12 my-12">
       
        <!-- Project 1: Agrilink -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-1 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/80 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux web development" 
             data-title="Agrilink" 
             data-category-text="UI-UX / Web Development" 
             data-desc="A demand-driven agricultural e-commerce and GIS-based monitoring system designed for Lucena City. It connects local farmers and consumers directly, allowing buyers to request products and farmers to respond, creating a flexible farm-to-table marketplace." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/agrilink.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">Agrilink</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">A demand-driven agricultural e-commerce and GIS-based monitoring system designed for Lucena City.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project 2: BRRCS -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-2 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/80 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux web development" 
             data-title="BRRCS" 
             data-category-text="UI-UX / Web Development" 
             data-desc="Barangay Residential Record and Certification System (BRRCS) is a streamlined digital tool built to automate resident record tracking, clearances, and barangay certificate issuance securely." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/brrcs.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">BRRCS</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">Barangay Residential Record and Certification System designed to automate resident profiles and speed up official document generation.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project 3: LoanTrackr -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-3 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/80 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux web development" 
             data-title="LoanTrackr" 
             data-category-text="UI-UX / Web Development" 
             data-desc="LoanTrackr is a simple and efficient personal loan tracking Progressive Web App (PWA) that helps you stay in control of your finances. It allows you to record loans, monitor payments, and track remaining balances—all in one place."
             data-image="<?php echo get_template_directory_uri(); ?>/assets/loantrackr.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">LoanTrackr</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">LoanTrackr is a simple and efficient personal loan tracking Progressive Web App (PWA) that helps you stay in control of your finances.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project 4: Seiyann -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-4 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/80 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="branding ui-ux web development" 
             data-title="Seiyann" 
             data-category-text="Branding / UI-UX / Web Development" 
             data-desc="Seiyann is a custom, full-stack dynamic portfolio and content management system built from scratch. It features modular custom page templates, an interactive multi-category project filtering engine, dynamic modals, and a robust owner-only dashboard designed to seamlessly manage projects, credentials, and achievements in real time."
             data-image="<?php echo get_template_directory_uri(); ?>/assets/seiyann.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">Branding / UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">Seiyann</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">A custom, full-stack dynamic portfolio and content management system featuring modular architecture and interactive design flows.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project 5: Sidequest -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-5 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/80 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux branding" 
             data-title="Sidequest" 
             data-category-text="Branding / UI-UX" 
             data-desc="Sidequest is a gamified self-improvement platform designed to turn personal growth into an engaging adventure. By combining daily micro-quests, habit streaks, mood reflection tools, and XP progression systems, it helps users stay accountable, break productivity slumps, and build lasting lifestyle habits." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/sidequest.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">Branding / UI-UX</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">Sidequest</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">A gamified self-improvement app that turns daily routines, habit tracking, and personal growth milestones into an interactive adventure.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project 6: BrewFlow -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-6 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/80 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux web development" 
             data-title="BrewFlow" 
             data-category-text="UI-UX / Web Development" 
             data-desc="BrewFlow is a smart POS & inventory management system engineered specifically for modern coffee shops. It streamlines daily operations by automating stock tracking for perishable ingredients, providing rapid-fire order processing interfaces, and delivering real-time analytics to help cafe owners optimize margins and reduce waste." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/brewflow.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">BrewFlow</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">Smart POS & inventory management system for modern coffee shops focused on speed, automated stock tracking, and sales analytics.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project 7: Parallel HQ -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-7 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/80 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="branding ui-ux web development" 
             data-title="Parallel HQ" 
             data-category-text="Branding / UI-UX / Web Development" 
             data-desc="Parallel HQ is a digital storefront and curated brand identity platform built for modern thrifted and vintage apparel. The project blends sustainable fashion aesthetics with an intuitive e-commerce experience, featuring seamless product discovery, editorial-style lookbooks, and a streamlined checkout flow designed to elevate secondhand shopping for the next generation." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/parallel.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">Branding / UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">Parallel HQ</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">A specialized website and brand identity for thrifted and curated apparel, combining sustainable fashion aesthetics with a modern digital storefront.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project 8: Vestia -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-8 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/80 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux web development" 
             data-title="Vestia" 
             data-category-text="UI-UX / Web Development" 
             data-desc="Vestia exists to simplify the search for exceptional living spaces through a modern, trustworthy, and beautifully designed digital experience. It provides intuitive property discovery flows, detailed accommodation insights, and a seamless interface tailored for modern renters." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/vestia.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">Vestia</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">Vestia exists to simplify the search for exceptional living spaces through a modern, trustworthy, and beautifully designed digital experience.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project 9: Veya -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-9 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/85 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux web development" 
             data-title="Veya" 
             data-category-text="UI-UX / Web Development" 
             data-desc="Veya is an all-in-one travel management and itinerary planning platform designed to streamline trip coordination. It features interactive route mapping, collaborative travel schedules, real-time booking updates, and an immersive user interface built to simplify destination discovery for modern travelers." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/veya.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">Veya</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">A travel management and itinerary planning platform that streamlines trip coordination and destination discovery.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project: Auslands Care -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-10 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/85 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux" 
             data-title="Auslands Care" 
             data-category-text="UI-UX Design" 
             data-desc="Auslands Care is a comprehensive UI/UX design revamp for an NDIS accommodation website. The redesign focuses on accessibility, user trust, and a seamless discovery process to help participants and families easily find specialized disability housing and support services." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/auslands.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">UI-UX Design</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">Auslands Care</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">A complete UI/UX design revamp for an NDIS accommodation website focused on accessibility, empathetic user experience, and clarity.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project: BEST DSS -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-11 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/85 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux web development" 
             data-title="BEST DSS" 
             data-category-text="UI-UX / Web Development" 
             data-desc="BEST DSS is an advanced decision support system where I spearheaded both the UI/UX design and frontend development. The project focuses on translating complex data structures into clean, intuitive interfaces and responsive, high-performance web components for optimized decision-making." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/bestdss.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">BEST DSS</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">A specialized decision support system featuring comprehensive UI/UX design and custom frontend web development.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project: Alan Associates -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-12 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/85 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux web development" 
             data-title="Alan Associates" 
             data-category-text="UI-UX / Web Development" 
             data-desc="Alan Associates is a trusted Australian business debt collection and credit management specialist website. I handled the complete UI/UX design revamp and frontend development, creating a clean, professional, and empathetic digital experience designed to build trust and streamline client outreach." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/alanassociates.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">Alan Associates</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">A professional UI/UX design revamp and frontend web development project for an Australian credit and debt recovery specialist.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

        <!-- Project: Reliable Touch Cleaning Services -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-13 flex flex-col justify-between p-8 rounded-3xl bg-[#fcfcfa] border border-gray-200/60 hover:border-black/85 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden" 
             data-category="ui-ux web development" 
             data-title="Reliable Touch Cleaning Services" 
             data-category-text="UI-UX / Web Development" 
             data-desc="Reliable Touch Cleaning Services is a modern website redesign and frontend development project. I spearheaded the UI/UX revamp and custom frontend implementation to deliver a clean, trustworthy, and conversion-focused platform optimized for service bookings." 
             data-image="<?php echo get_template_directory_uri(); ?>/assets/reliabletouch.png">
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-3" style="font-family: 'Montserrat', sans-serif;">UI-UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-3 group-hover:text-black transition-colors">Reliable Touch Cleaning Services</h3>
                <p class="text-xs text-gray-500 mb-8 leading-relaxed">A complete UI/UX design revamp and frontend web development project focused on elevating brand credibility and simplifying service bookings.</p>
            </div>
            <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1.5 transition-transform duration-300 inline-flex items-center">View Project &rarr;</span>
                <span class="w-2 h-2 rounded-full bg-gray-300 group-hover:bg-black transition-colors"></span>
            </div>
        </div>

    </div>

    <!-- Bottom Indicator -->
    <div class="flex justify-between items-center w-full pt-4 text-xs tracking-widest text-gray-400 uppercase font-medium animate-page-load load-delay-6" style="font-family: 'Montserrat', sans-serif;">
        <span id="project-counter">Showing 4 of 4 projects</span>
        <span></span>
    </div>
</main>

<!-- Project Modal Overlay -->
<div id="project-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300">
    <div id="modal-content-box" class="bg-white rounded-2xl w-11/12 max-w-3xl p-8 md:p-12 shadow-2xl transform scale-95 transition-all duration-300 relative max-h-[90vh] overflow-y-auto">
        <!-- Close Button -->
        <button id="modal-close" class="absolute top-6 right-6 w-10 h-10 rounded-full bg-gray-100 hover:bg-black hover:text-white flex items-center justify-center transition-colors text-gray-700 cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Modal Header Info -->
        <div class="mb-6">
            <span id="modal-category" class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-1 block" style="font-family: 'Montserrat', sans-serif;"></span>
            <h2 id="modal-title" class="text-2xl md:text-4xl font-bold tracking-tight text-gray-950"></h2>
        </div>

        <!-- Modal Image Showcase Box -->
        <div id="modal-preview-box" class="bg-[#f3f3f1] rounded-xl overflow-hidden mb-6 aspect-[16/9] flex items-center justify-center border border-gray-200/60 shadow-inner p-4">
            <img id="modal-image" src="" alt="Project Preview" class="w-full h-full object-cover rounded-lg">
        </div>

        <!-- Modal Detailed Description -->
        <div class="space-y-4">
            <h3 class="text-sm font-bold uppercase tracking-wider text-gray-900">Overview</h3>
            <p id="modal-desc" class="text-sm text-gray-600 leading-relaxed"></p>
        </div>

        <!-- Modal Footer Actions -->
        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
            <button id="modal-close-btn" class="px-6 py-2.5 rounded-full bg-black text-white text-xs font-bold tracking-widest uppercase hover:bg-gray-800 transition-colors cursor-pointer">Close Project</button>
        </div>
    </div>
</div>

<style>
    @keyframes pageLoadEntry {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-page-load {
        opacity: 0;
        animation: pageLoadEntry 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .load-delay-1 { animation-delay: 0.1s; }
    .load-delay-2 { animation-delay: 0.15s; }
    .load-delay-3 { animation-delay: 0.2s; }
    .load-delay-4 { animation-delay: 0.25s; }
    .load-delay-6 { animation-delay: 0.35s; }

    .project-card {
        transition: opacity 0.3s ease, transform 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .project-card.hidden-card {
        opacity: 0;
        transform: scale(0.95);
        display: none !important;
    }

    #project-modal.active {
        opacity: 1;
        pointer-events: auto;
    }
    #project-modal.active #modal-content-box {
        transform: scale(1);
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const filterButtons = document.querySelectorAll(".filter-btn");
    const projectCards = document.querySelectorAll(".project-card");
    const counterSpan = document.getElementById("project-counter");

    const modal = document.getElementById("project-modal");
    const modalTitle = document.getElementById("modal-title");
    const modalCategory = document.getElementById("modal-category");
    const modalDesc = document.getElementById("modal-desc");
    const modalImage = document.getElementById("modal-image");
    const modalClose = document.getElementById("modal-close");
    const modalCloseBtn = document.getElementById("modal-close-btn");

    function updateCounter(visibleCount) {
        if (counterSpan) {
            counterSpan.textContent = `Showing ${visibleCount} of ${projectCards.length} projects`;
        }
    }

    updateCounter(projectCards.length);

    projectCards.forEach(card => {
        card.addEventListener("click", function(e) {
            e.preventDefault();
            
            modalTitle.textContent = this.getAttribute("data-title");
            modalCategory.textContent = this.getAttribute("data-category-text");
            modalDesc.textContent = this.getAttribute("data-desc");
            modalImage.src = this.getAttribute("data-image");

            modal.classList.add("active");
            document.body.style.overflow = "hidden";
        });
    });

    function closeModal() {
        modal.classList.remove("active");
        document.body.style.overflow = "";
    }

    if (modalClose) modalClose.addEventListener("click", closeModal);
    if (modalCloseBtn) modalCloseBtn.addEventListener("click", closeModal);

    modal.addEventListener("click", function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    filterButtons.forEach(button => {
        button.addEventListener("click", function() {
            filterButtons.forEach(btn => {
                btn.classList.remove("text-gray-900", "border-b-2", "border-black");
                btn.classList.add("text-gray-400");
            });
            this.classList.remove("text-gray-400");
            this.classList.add("text-gray-900", "border-b-2", "border-black");

            const filterValue = this.getAttribute("data-filter");
            let visibleCount = 0;

            projectCards.forEach(card => {
                const categories = card.getAttribute("data-category");
                if (filterValue === "all" || categories.includes(filterValue)) {
                    card.classList.remove("hidden-card");
                    visibleCount++;
                } else {
                    card.classList.add("hidden-card");
                }
            });

            updateCounter(visibleCount);
        });
    });
});
</script>

<?php 
get_footer();