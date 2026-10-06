<?php
/**
 * Template Name: Work Page
 * The template for displaying the Work page: a pinned, scroll-driven "Freefall" deck of projects.
 * Projects come from seiyann_projects() (functions.php); styles in assets/css/work.css,
 * motion in assets/js/work-freefall.js.
 *
 * @package Seiyann
 */

get_header();

$projects = seiyann_projects();
$total    = count( $projects );
?>

<main class="relative flex-1 md:ml-24">
    <section id="freefall" class="ff-section" aria-label="Selected work">
        <div class="ff-layout">

            <!-- Left: intro -->
            <div class="ff-intro">
                <div class="ff-eyebrow">
                    <span class="ff-eyebrow-line"></span>
                    <span>Selected Work &middot; Vol. 01</span>
                </div>
                <h1 class="ff-title">
                    <span class="ff-title-solid">Selected</span>
                    <span class="ff-title-gradient">Work.</span>
                </h1>
                <p class="ff-lede">
                    <?php echo esc_html( sprintf( '%d projects, one at a time. Scroll, and each one folds over the crest and drops into the pit.', $total ) ); ?>
                </p>
                <button type="button" class="ff-cta" id="ff-open">
                    <span>View <span class="ff-cta-title"><?php echo esc_html( $projects[0]['title'] ); ?></span></span>
                    <span class="ff-cta-icon" aria-hidden="true">&rarr;</span>
                </button>
            </div>

            <!-- Right: the deck. Cards are absolutely stacked; work-freefall.js places them from scroll progress. -->
            <div class="ff-stage-wrap">
                <div class="ff-stage" id="ff-stage">
                    <?php foreach ( $projects as $i => $project ) :
                        $image = seiyann_project_image_url( $project );
                        list( $variant, $c1, $c2, $c3, $c4 ) = $project['art'];
                        $art_style = sprintf( '--c1:%s;--c2:%s;--c3:%s;--c4:%s', $c1, $c2, $c3, $c4 );
                        $number = sprintf( '%02d', $i + 1 );
                    ?>
                        <button type="button" class="ff-card" data-index="<?php echo esc_attr( $i ); ?>"
                                data-title="<?php echo esc_attr( $project['title'] ); ?>"
                                data-category="<?php echo esc_attr( $project['category'] ); ?>"
                                data-desc="<?php echo esc_attr( $project['description'] ); ?>"
                                data-image="<?php echo esc_url( $image ); ?>"
                                aria-label="<?php echo esc_attr( sprintf( 'Project %d of %d: %s. Open details', $i + 1, $total, $project['title'] ) ); ?>">
                            <span class="ff-card-media">
                                <?php if ( $image ) : ?>
                                    <img src="<?php echo esc_url( $image ); ?>" alt="" loading="<?php echo $i < 3 ? 'eager' : 'lazy'; ?>" decoding="async" draggable="false">
                                <?php else : ?>
                                    <span class="ff-art art-<?php echo esc_attr( $variant ); ?>" style="<?php echo esc_attr( $art_style ); ?>"></span>
                                <?php endif; ?>
                            </span>
                            <span class="ff-card-scrim" aria-hidden="true"></span>
                            <span class="ff-card-pill"><?php echo esc_html( $number . ' / ' . sprintf( '%02d', $total ) ); ?></span>
                            <span class="ff-card-tag"><?php echo esc_html( $project['tag'] ); ?></span>
                            <span class="ff-card-body">
                                <span class="ff-card-eyebrow">Project <?php echo esc_html( $number ); ?></span>
                                <span class="ff-card-title"><?php echo esc_html( $project['title'] ); ?></span>
                                <span class="ff-card-caption"><?php echo esc_html( $project['summary'] ); ?></span>
                            </span>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Right edge: progress rail -->
        <aside class="ff-rail" aria-hidden="true">
            <div class="ff-counter">
                <span class="ff-counter-num" id="ff-counter">01</span><sup class="ff-counter-total">/<?php echo esc_html( $total ); ?></sup>
            </div>
            <div class="ff-track" id="ff-track">
                <?php for ( $i = 0; $i < $total; $i++ ) : ?>
                    <span class="ff-tick" style="top: <?php echo esc_attr( $total > 1 ? round( $i / ( $total - 1 ) * 100, 3 ) : 0 ); ?>%"></span>
                <?php endfor; ?>
                <span class="ff-track-fill" id="ff-fill"></span>
                <span class="ff-track-dot" id="ff-dot"></span>
            </div>
            <span class="ff-rail-label">Scroll</span>
        </aside>
    </section>
</main>

<!-- Project Modal Overlay -->
<div id="project-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div id="modal-content-box" class="bg-white rounded-2xl w-11/12 max-w-3xl p-8 md:p-12 shadow-2xl transform scale-95 transition-all duration-300 relative max-h-[90vh] overflow-y-auto">
        <!-- Close Button -->
        <button id="modal-close" aria-label="Close" class="absolute top-6 right-6 w-10 h-10 rounded-full bg-gray-100 hover:bg-black hover:text-white flex items-center justify-center transition-colors text-gray-700 cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <!-- Modal Header Info -->
        <div class="mb-6">
            <span id="modal-category" class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-1 block"></span>
            <h2 id="modal-title" class="text-2xl md:text-4xl font-bold tracking-tight text-gray-950"></h2>
        </div>

        <!-- Modal Image Showcase Box: the project screenshot, or the card's generated art if there is none -->
        <div id="modal-preview-box" class="bg-[#f3f3f1] rounded-xl overflow-hidden mb-6 aspect-[16/9] flex items-center justify-center border border-gray-200/60 shadow-inner p-4 relative">
            <img id="modal-image" src="" alt="" class="w-full h-full object-cover rounded-lg">
            <div id="modal-art" class="absolute inset-4 rounded-lg overflow-hidden" hidden></div>
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

<?php
get_footer();
