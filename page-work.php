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
                    <span>Work</span><span class="ff-eyebrow-sep">/</span><span>File No. 005</span>
                </div>
                <h1 class="ff-title">
                    <span class="ff-line"><span>Case files.</span></span>
                    <span class="ff-line is-muted"><span>Selected work.</span></span>
                </h1>
                <p class="ff-lede">
                    <?php echo esc_html( sprintf( '%d cases, one at a time. Scroll, and each file folds over the crest and drops into the pit.', $total ) ); ?>
                </p>

                <!-- Case summary: "In front" follows the deck (work-freefall.js) -->
                <dl class="ff-summary">
                    <div><dt>On file</dt><dd><?php echo esc_html( sprintf( '%02d', $total ) ); ?> cases</dd></div>
                    <div><dt>In front</dt><dd><span id="ff-front-num">01</span> &middot; <span id="ff-front-tag"><?php echo esc_html( $projects[0]['tag'] ); ?></span></dd></div>
                </dl>

                <button type="button" class="ff-cta" id="ff-open">
                    <span>Open case: <span class="ff-cta-title"><?php echo esc_html( $projects[0]['title'] ); ?></span></span>
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
                                data-number="<?php echo esc_attr( $number ); ?>"
                                data-tag="<?php echo esc_attr( $project['tag'] ); ?>"
                                aria-label="<?php echo esc_attr( sprintf( 'Case %d of %d: %s. Open case file', $i + 1, $total, $project['title'] ) ); ?>">
                            <!-- Evidence-photo style: paper frame around the media, tape across the top -->
                            <span class="ff-card-tape" aria-hidden="true">Case <?php echo esc_html( $number . ' / ' . sprintf( '%02d', $total ) ); ?></span>
                            <span class="ff-card-media">
                                <?php if ( $image ) : ?>
                                    <img src="<?php echo esc_url( $image ); ?>" alt="" loading="<?php echo $i < 3 ? 'eager' : 'lazy'; ?>" decoding="async" draggable="false">
                                <?php else : ?>
                                    <span class="ff-art art-<?php echo esc_attr( $variant ); ?>" style="<?php echo esc_attr( $art_style ); ?>"></span>
                                <?php endif; ?>
                            </span>
                            <span class="ff-card-scrim" aria-hidden="true"></span>
                            <span class="ff-card-tag"><?php echo esc_html( $project['tag'] ); ?></span>
                            <span class="ff-card-body">
                                <span class="ff-card-eyebrow">Case <?php echo esc_html( $number ); ?></span>
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
            <span class="ff-counter-label">Case</span>
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

<!-- Case file (project modal): filled in by work-freefall.js from the card's data attributes -->
<div id="project-modal" class="case-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
    <div id="modal-content-box" class="case-sheet">
        <span class="case-tape" aria-hidden="true">Case <span id="modal-number">01</span> &mdash; File 005</span>

        <button id="modal-close" class="case-close" aria-label="Close case file">&times;</button>

        <header class="case-head">
            <span class="case-eyebrow">Case <span id="modal-number-2">01</span> / <?php echo esc_html( sprintf( '%02d', $total ) ); ?></span>
            <h2 id="modal-title" class="case-title"></h2>
        </header>

        <!-- Exhibit: the project screenshot, or the card's generated art if there is none -->
        <figure id="modal-preview-box" class="case-exhibit">
            <img id="modal-image" src="" alt="">
            <div id="modal-art" class="case-art" hidden></div>
            <figcaption class="case-exhibit-label">Fig. <span id="modal-number-3">01</span></figcaption>
        </figure>

        <dl class="case-fields">
            <div><dt>Discipline</dt><dd id="modal-category"></dd></div>
            <div><dt>Type</dt><dd id="modal-tag"></dd></div>
            <div><dt>Overview</dt><dd id="modal-desc"></dd></div>
        </dl>

        <footer class="case-foot">
            <span class="case-barcode" aria-hidden="true"></span>
            <button id="modal-close-btn" class="case-stamp">Close file</button>
        </footer>
    </div>
</div>

<?php
get_footer();
