<?php
/**
 * Template Name: About Page
 *
 * A "personnel file": headline + bio + pull quote on the left, a taped-on ID card on the right,
 * then the crossing toolbox tapes and a spec-sheet row of stats.
 * Styles: assets/css/about.css. Motion: assets/js/about-intro.js (hero + stats), assets/js/about-tools.js (tapes).
 *
 * @package Seiyann
 */

get_header();

$tools    = seiyann_tools();
$projects = seiyann_projects();

$work_page = get_page_by_path( 'work' );
$work_url  = $work_page ? get_permalink( $work_page->ID ) : home_url( '/work/' );

// Stats: projects and tools are counted from the real data so they never drift.
$stats = array(
    array( 'value' => count( $projects ), 'suffix' => '',  'label' => 'Projects completed',  'desc' => 'From brand identities to full-stack web applications.' ),
    array( 'value' => 3,                  'suffix' => '+', 'label' => 'Years of experience', 'desc' => 'In design, development, and digital product creation.' ),
    array( 'value' => count( $tools ),    'suffix' => '',  'label' => 'Tools in the box',    'desc' => 'Languages, frameworks and apps I build with every day.' ),
    array( 'value' => 1,                  'suffix' => '',  'label' => 'Goal',                'desc' => 'To keep building, creating, and making an impact.' ),
);
?>

<main class="about flex-1 px-6 sm:px-12 md:px-24 lg:px-36 pt-12 pb-20 md:ml-24">

    <!-- ============ Personnel file ============ -->
    <section class="about-hero" id="about-hero">

        <!-- Left: headline, bio, approach, CTA -->
        <div class="about-text">
            <div class="about-eyebrow">
                <span class="about-eyebrow-line"></span>
                <span>About</span><span class="about-eyebrow-sep">/</span><span>File No. 001</span>
            </div>

            <h1 class="about-title">
                <span class="about-line"><span>Designing</span></span>
                <span class="about-line"><span>experiences.</span></span>
                <span class="about-line is-muted"><span>Building products.</span></span>
            </h1>

            <p class="about-bio about-reveal">
                I'm a graphic designer and full-stack developer passionate about building digital experiences from concept to deployment. I enjoy blending strategy, branding, interface design, and engineering into products that are both functional and visually refined.
            </p>

            <figure class="about-quote about-reveal">
                <span class="about-quote-mark" aria-hidden="true">&ldquo;</span>
                <blockquote>I believe great products start with a clear problem, thoughtful design, and solid code.</blockquote>
                <figcaption>My approach</figcaption>
            </figure>

            <a href="<?php echo esc_url( $work_url ); ?>" class="about-cta about-reveal">
                <span>View my work</span>
                <span class="about-cta-icon" aria-hidden="true">&rarr;</span>
            </a>
        </div>

        <!-- Right: ID card, taped to the page -->
        <div class="about-card-wrap">
            <article class="id-card" aria-label="Profile card">
                <span class="id-tape" aria-hidden="true">File 001 &mdash; Do not bend</span>

                <div class="id-photo">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/aboutimg.jpg' ); ?>" alt="Kurt Atoat" width="800" height="1000">
                    <span class="id-photo-tag" aria-hidden="true">Fig. 01</span>
                </div>

                <div class="id-name">
                    Kurt Atoat
                    <span>Designer &amp; Developer</span>
                </div>

                <dl class="id-fields">
                    <div><dt>Role</dt><dd>Graphic Designer / Full-Stack Developer</dd></div>
                    <div><dt>Based in</dt><dd>Lucena City, Philippines</dd></div>
                    <div><dt>Focus</dt><dd>Brand &middot; UI/UX &middot; Code</dd></div>
                    <div><dt>Status</dt><dd><b class="id-status-dot" aria-hidden="true"></b>Open to work &mdash; full-time or freelance</dd></div>
                </dl>

                <div class="id-barcode" aria-hidden="true">
                    <span class="id-barcode-bars"></span>
                    <span class="id-barcode-text">KA &middot; 001 &middot; LUC-PH</span>
                </div>
            </article>
        </div>
    </section>

    <!-- ============ Toolbox ============
         Two tapes crossing in an X, running in opposite directions (assets/js/about-tools.js).
         Full-bleed: negative margins cancel <main>'s side padding and, from md, its 6rem nav margin too, so
         the tapes run to the screen's left edge under the floating nav. Tools come from seiyann_tools(). -->
    <?php
    $tapes = array(
        'ink'   => array( 'label' => 'Languages & frameworks', 'dir' => -1 ),
        'paper' => array( 'label' => 'Tools & apps',           'dir' => 1 ),
    );
    ?>
    <section class="tools -mx-6 sm:-mx-12 md:-mr-24 md:-ml-48 lg:-mr-36 lg:-ml-60" aria-label="Toolbox">
        <div class="tools-stage" aria-hidden="true">
            <?php foreach ( $tapes as $tape_key => $tape ) : ?>
                <?php
                // Printed edge text: repeat the label to ~600 characters so it spans the tape (120% of the
                // screen) even on very wide displays, whatever the label's length.
                $edge_text = str_repeat( $tape['label'] . ' — ', (int) ceil( 600 / ( mb_strlen( $tape['label'] ) + 3 ) ) );
                ?>
                <div class="tape tape--<?php echo esc_attr( $tape_key ); ?>" data-dir="<?php echo esc_attr( $tape['dir'] ); ?>">
                    <span class="tape-edge tape-edge--top"><?php echo esc_html( $edge_text ); ?></span>
                    <div class="tape-track">
                        <div class="tape-set">
                            <?php foreach ( $tools as $tool ) :
                                if ( $tool['tape'] !== $tape_key ) { continue; }
                            ?>
                                <span class="tool" style="--brand: <?php echo esc_attr( $tool['hex'] ); ?>; --on-brand: <?php echo esc_attr( seiyann_on_color( $tool['hex'] ) ); ?>;">
                                    <?php echo seiyann_tool_icon( $tool['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- trusted SVG files shipped with the theme ?>
                                    <span class="tool-name"><?php echo esc_html( $tool['name'] ); ?></span>
                                </span>
                                <span class="tool-sep">&#10033;</span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <span class="tape-edge tape-edge--bottom"><?php echo esc_html( $edge_text ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- The tapes are decorative duplicates; this is the readable list -->
        <ul class="sr-only">
            <?php foreach ( $tools as $tool ) : ?>
                <li><?php echo esc_html( $tool['name'] ); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- ============ Stats: spec-sheet row (numbers count up in about-intro.js) ============ -->
    <dl class="about-stats" id="about-stats">
        <?php foreach ( $stats as $stat ) : ?>
            <div class="about-stat">
                <dt class="about-stat-label"><?php echo esc_html( $stat['label'] ); ?></dt>
                <dd class="about-stat-value"><span class="about-stat-num" data-count="<?php echo esc_attr( $stat['value'] ); ?>"><?php echo esc_html( $stat['value'] ); ?></span><?php echo esc_html( $stat['suffix'] ); ?></dd>
                <dd class="about-stat-desc"><?php echo esc_html( $stat['desc'] ); ?></dd>
            </div>
        <?php endforeach; ?>
    </dl>
</main>

<?php
get_footer();
