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
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight text-gray-955 whitespace-nowrap">Selected Projects</h1>
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

    <!-- Projects Grid (6 Projects: 3 Columns) -->
    <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-12 my-12">
        <!-- Project 1: Locana -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-1" data-category="branding ui-ux web development" data-title="Locana" data-category-text="Branding / UI-UX / Web Development" data-desc="A local tourism booking platform that connects travelers with authentic destinations and experiences." data-preview="Locana Preview">
            <div class="bg-gray-100 rounded-xl overflow-hidden mb-3 aspect-[16/10] flex items-center justify-center border border-gray-200/60 shadow-sm group-hover:shadow-md transition-all">
                <span class="text-xs tracking-widest text-gray-400 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">Locana Preview</span>
            </div>
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-1" style="font-family: 'Montserrat', sans-serif;">Branding / UI-UX / Web Development</p>
                <h3 class="text-base font-bold text-gray-900 mb-1">Locana</h3>
                <p class="text-xs text-gray-500 mb-3 leading-relaxed">A local tourism booking platform that connects travelers with authentic destinations and experiences.</p>
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-900 group-hover:translate-x-1 transition-transform inline-flex items-center">View Project &rarr;</span>
            </div>
        </div>

        <!-- Project 2: Reliable Touch -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-2" data-category="ui-ux web development" data-title="Reliable Touch" data-category-text="UI-UX / Web Development" data-desc="A modern website redesign for an IT company focused on reliability and innovation." data-preview="Reliable Touch">
            <div class="bg-gray-900 rounded-xl overflow-hidden mb-3 aspect-[16/10] flex items-center justify-center shadow-sm group-hover:shadow-md transition-all">
                <span class="text-xs tracking-widest text-zinc-500 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">Reliable Touch</span>
            </div>
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-1" style="font-family: 'Montserrat', sans-serif;">UI-UX / Web Development</p>
                <h3 class="text-base font-bold text-gray-900 mb-1">Reliable Touch</h3>
                <p class="text-xs text-gray-500 mb-3 leading-relaxed">A modern website redesign for an IT company focused on reliability and innovation.</p>
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-900 group-hover:translate-x-1 transition-transform inline-flex items-center">View Project &rarr;</span>
            </div>
        </div>

        <!-- Project 3: Parallel -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-3" data-category="branding" data-title="Parallel" data-category-text="Branding / Graphic Design" data-desc="A modern brand identity for a local online thrift store built for the new generation." data-preview="Parallel">
            <div class="bg-zinc-900 rounded-xl overflow-hidden mb-3 aspect-[16/10] flex items-center justify-center shadow-sm group-hover:shadow-md transition-all">
                <span class="text-xs tracking-widest text-zinc-500 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">Parallel</span>
            </div>
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-1" style="font-family: 'Montserrat', sans-serif;">Branding / Graphic Design</p>
                <h3 class="text-base font-bold text-gray-900 mb-1">Parallel</h3>
                <p class="text-xs text-gray-500 mb-3 leading-relaxed">A modern brand identity for a local online thrift store built for the new generation.</p>
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-900 group-hover:translate-x-1 transition-transform inline-flex items-center">View Project &rarr;</span>
            </div>
        </div>

        <!-- Project 4: Barangay Management System -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-4" data-category="web development" data-title="Barangay Management System" data-category-text="Web Development" data-desc="A digital solution for local government units to manage residents, certificates, and incident reports." data-preview="BMS Preview">
            <div class="bg-gray-100 rounded-xl overflow-hidden mb-3 aspect-[16/10] flex items-center justify-center border border-gray-200/60 shadow-sm group-hover:shadow-md transition-all">
                <span class="text-xs tracking-widest text-gray-400 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">BMS Preview</span>
            </div>
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-1" style="font-family: 'Montserrat', sans-serif;">Web Development</p>
                <h3 class="text-base font-bold text-gray-900 mb-1">Barangay Management System</h3>
                <p class="text-xs text-gray-500 mb-3 leading-relaxed">A digital solution for local government units to manage residents, certificates, and incident reports.</p>
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-900 group-hover:translate-x-1 transition-transform inline-flex items-center">View Project &rarr;</span>
            </div>
        </div>

        <!-- Project 5: DIP -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-5" data-category="ui-ux branding" data-title="DIP" data-category-text="UI-UX / Branding" data-desc="A travel booking app concept with a focus on simplicity and discovery." data-preview="DIP Preview">
            <div class="bg-zinc-900 rounded-xl overflow-hidden mb-3 aspect-[16/10] flex items-center justify-center shadow-sm group-hover:shadow-md transition-all">
                <span class="text-xs tracking-widest text-zinc-500 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">DIP Preview</span>
            </div>
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-1" style="font-family: 'Montserrat', sans-serif;">UI-UX / Branding</p>
                <h3 class="text-base font-bold text-gray-900 mb-1">DIP</h3>
                <p class="text-xs text-gray-500 mb-3 leading-relaxed">A travel booking app concept with a focus on simplicity and discovery.</p>
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-900 group-hover:translate-x-1 transition-transform inline-flex items-center">View Project &rarr;</span>
            </div>
        </div>

        <!-- Project 6: ATS Resume Master Guide -->
        <div class="project-card group cursor-pointer animate-page-load load-delay-6" data-category="graphic design" data-title="ATS Resume Master Guide" data-category-text="Graphic Design" data-desc="A beginner-friendly guide to help job seekers create ATS-optimized resumes." data-preview="ATS Guide Preview">
            <div class="bg-gray-100 rounded-xl overflow-hidden mb-3 aspect-[16/10] flex items-center justify-center border border-gray-200/60 shadow-sm group-hover:shadow-md transition-all">
                <span class="text-xs tracking-widest text-gray-400 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;">ATS Guide Preview</span>
            </div>
            <div>
                <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-1" style="font-family: 'Montserrat', sans-serif;">Graphic Design</p>
                <h3 class="text-base font-bold text-gray-900 mb-1">ATS Resume Master Guide</h3>
                <p class="text-xs text-gray-500 mb-3 leading-relaxed">A beginner-friendly guide to help job seekers create ATS-optimized resumes.</p>
                <span class="view-project-btn text-xs font-semibold tracking-wider text-gray-900 group-hover:translate-x-1 transition-transform inline-flex items-center">View Project &rarr;</span>
            </div>
        </div>
    </div>

    <!-- Bottom Indicator -->
    <div class="flex justify-between items-center w-full pt-4 text-xs tracking-widest text-gray-400 uppercase font-medium animate-page-load load-delay-6" style="font-family: 'Montserrat', sans-serif;">
        <span id="project-counter">Showing 6 of 6 projects</span>
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
            <h2 id="modal-title" class="text-2xl md:text-4xl font-bold tracking-tight text-gray-955"></h2>
        </div>

        <!-- Modal Image Showcase Box -->
        <div id="modal-preview-box" class="bg-gray-100 rounded-xl overflow-hidden mb-6 aspect-[16/9] flex items-center justify-center border border-gray-200/60 shadow-inner">
            <span id="modal-preview-text" class="text-xs tracking-widest text-gray-400 uppercase font-medium" style="font-family: 'Montserrat', sans-serif;"></span>
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
    const modalPreviewText = document.getElementById("modal-preview-text");
    const modalClose = document.getElementById("modal-close");
    const modalCloseBtn = document.getElementById("modal-close-btn");

    // Open modal when clicking a project card or view project link
    projectCards.forEach(card => {
        card.addEventListener("click", function(e) {
            e.preventDefault();
            
            // Extract attributes from clicked card data
            modalTitle.textContent = this.getAttribute("data-title");
            modalCategory.textContent = this.getAttribute("data-category-text");
            modalDesc.textContent = this.getAttribute("data-desc");
            modalPreviewText.textContent = this.getAttribute("data-preview");

            // Show modal
            modal.classList.add("active");
            document.body.style.overflow = "hidden"; // Prevent background scrolling
        });
    });

    // Close modal functions
    function closeModal() {
        modal.classList.remove("active");
        document.body.style.overflow = ""; // Restore background scrolling
    }

    if (modalClose) modalClose.addEventListener("click", closeModal);
    if (modalCloseBtn) modalCloseBtn.addEventListener("click", closeModal);

    // Close on clicking outside the modal box
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

            if(counterSpan) {
                counterSpan.textContent = `Showing ${visibleCount} of ${projectCards.length} projects`;
            }
        });
    });
});
</script>

<?php 
get_footer();