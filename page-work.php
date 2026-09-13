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
            <p class="text-gray-500 text-sm max-w-md mt-3 leading-relaxed font-normal">
                A collection of brands, interfaces, and web applications I've designed and developed. Each project represents a unique problem, process, and solution.
            </p>
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

    <!-- Projects Grid (3 Columns Layout matching reference style) -->
    <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-16 my-12">
       
        <!-- Portfolio CMS -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-1 flex flex-col" data-category="ui-ux branding web development" data-title="CMS Portfolio" data-category-text="Branding / UI UX / Web Development" data-desc="A full-stack personal portfolio featuring an owner-only dashboard for managing projects and achievements." data-image="<?php echo get_template_directory_uri(); ?>/assets/portfoliocms.png">
            <div class="bg-[#f3f3f1] rounded-2xl overflow-hidden mb-6 aspect-[4/3] flex items-center justify-center border border-gray-200/60 shadow-sm group-hover:shadow-md transition-all p-6">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/portfoliocms.png" alt="CMS Portfolio" class="w-full h-full object-cover rounded-lg">
            </div>
            <div class="flex flex-col flex-grow">
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-2" style="font-family: 'Montserrat', sans-serif;">Branding / UI UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-2">CMS Portfolio</h3>
                <p class="text-xs text-gray-500 mb-6 leading-relaxed flex-grow">A full-stack personal portfolio featuring an owner-only dashboard for managing projects and achievements.</p>
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1 transition-transform inline-flex items-center">View Project &rarr;</span>
            </div>
        </div>

        <!-- Sidequest -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-2 flex flex-col" data-category="ui-ux branding web development" data-title="sidequest-" data-category-text="Branding / UI UX / Web Development" data-desc="A modern website redesign for an IT company focused on reliability and innovation." data-image="<?php echo get_template_directory_uri(); ?>/assets/sidequest.png">
            <div class="bg-[#f3f3f1] rounded-2xl overflow-hidden mb-6 aspect-[4/3] flex items-center justify-center border border-gray-200/60 shadow-sm group-hover:shadow-md transition-all p-6">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/sidequest.png" alt="sidequest-" class="w-full h-full object-cover rounded-lg">
            </div>
            <div class="flex flex-col flex-grow">
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-2" style="font-family: 'Montserrat', sans-serif;">Branding / UI UX / Web Development</p>
                <h3 class="text-xl font-bold text-gray-950 mb-2">sidequest-</h3>
                <p class="text-xs text-gray-500 mb-6 leading-relaxed flex-grow">A sidequest app for self improvement.</p>
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1 transition-transform inline-flex items-center">View Project &rarr;</span>
            </div>
        </div>

        <!-- Project Item 3 -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-3 flex flex-col" data-category="branding" data-title="Parallel" data-category-text="Branding" data-desc="A modern brand identity for a local online thrift store built for the new generation." data-image="<?php echo get_template_directory_uri(); ?>/assets/your-project-image.jpg">
            <div class="bg-[#f3f3f1] rounded-2xl overflow-hidden mb-6 aspect-[4/3] flex items-center justify-center border border-gray-200/60 shadow-sm group-hover:shadow-md transition-all p-6">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/your-project-image.jpg" alt="Parallel" class="w-full h-full object-cover rounded-lg">
            </div>
            <div class="flex flex-col flex-grow">
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-2" style="font-family: 'Montserrat', sans-serif;">Branding</p>
                <h3 class="text-xl font-bold text-gray-950 mb-2">Parallel</h3>
                <p class="text-xs text-gray-500 mb-6 leading-relaxed flex-grow">A modern brand identity for a local online thrift store built for the new generation.</p>
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-950 group-hover:translate-x-1 transition-transform inline-flex items-center">View Project &rarr;</span>
            </div>
        </div>

    </div>

    <!-- Bottom Indicator -->
    <div class="flex justify-between items-center w-full pt-4 text-xs tracking-widest text-gray-400 uppercase font-medium animate-page-load load-delay-6" style="font-family: 'Montserrat', sans-serif;">
        <span id="project-counter">Showing 3 of 3 projects</span>
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
    .load-delay-5 { animation-delay: 0.3s; }
    .load-delay-6 { animation-delay: 0.35s; }

    .project-card {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .project-card.hidden-card {
        opacity: 0;
        transform: scale(0.95);
        display: none !important;
    }

    /* Active modal display rules */
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

    // Modal elements
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

    // Open modal and inject dynamic content including the image source
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

    // Filtering logic
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