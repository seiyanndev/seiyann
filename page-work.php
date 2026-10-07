<?php
/**
 * Template Name: Work Page
 *
 * "The Dossier", File No. 001: Case Files, shown as a filing cabinet. Each project is a manila
 * folder standing in a drawer; tabs are staggered so they all show. Clicking a folder opens it in
 * place into its case sheet (exhibit + fields); filter stamps dim folders outside a discipline.
 *
 * Data: seiyann_projects() (functions.php). Styles: assets/css/work.css. Motion: assets/js/work-cabinet.js.
 * Deep links: /work/#project-05 opens case 05 (used by the Capabilities matrix).
 *
 * @package Seiyann
 */

get_header();

$projects = seiyann_projects();
$total    = count( $projects );

// Discipline filters, matched against each project's category text.
$filters = array(
    'all'      => array( 'label' => 'All',      'match' => '' ),
    'branding' => array( 'label' => 'Branding', 'match' => 'Branding' ),
    'ui'       => array( 'label' => 'UI/UX',    'match' => 'UI-UX' ),
    'web'      => array( 'label' => 'Web',      'match' => 'Web Development' ),
);
$filter_counts = array();
foreach ( $filters as $key => $filter ) {
    $filter_counts[ $key ] = '' === $filter['match'] ? $total : count( array_filter( $projects, function ( $p ) use ( $filter ) {
        return false !== stripos( $p['category'], $filter['match'] );
    } ) );
}

// Tabs step across the folder width so neighbouring tabs never sit on top of each other.
// Unitless on purpose: work.css scales them (0 = left edge, 72 = right edge).
$tab_positions = array( 0, 24, 48, 72 );
?>

<main class="cab flex-1 px-6 sm:px-12 md:px-24 lg:px-36 pt-12 pb-24 md:ml-24">

    <!-- ============ Header ============ -->
    <header class="cab-hero" id="cab-hero">
        <div class="cab-eyebrow">
            <span class="cab-eyebrow-line"></span>
            <span>Work</span><span class="cab-eyebrow-sep">/</span><span>File No. 001</span>
        </div>
        <h1 class="cab-title">
            <span class="cab-line"><span>Case files.</span></span>
            <span class="cab-line is-muted"><span>Selected work.</span></span>
        </h1>
        <p class="cab-lede"><?php echo esc_html( sprintf( '%d cases on file. Pull a folder from the drawer to open it.', $total ) ); ?></p>

        <!-- Filter stamps: dim the folders outside a discipline -->
        <div class="cab-filters" role="group" aria-label="Filter cases by discipline">
            <?php foreach ( $filters as $key => $filter ) : ?>
                <button type="button" class="cab-filter<?php echo 'all' === $key ? ' is-active' : ''; ?>" data-filter="<?php echo esc_attr( $key ); ?>" aria-pressed="<?php echo 'all' === $key ? 'true' : 'false'; ?>">
                    <?php echo esc_html( $filter['label'] ); ?> <span><?php echo esc_html( sprintf( '%02d', $filter_counts[ $key ] ) ); ?></span>
                </button>
            <?php endforeach; ?>
        </div>
    </header>

    <!-- ============ The drawer ============ -->
    <div class="cab-drawer" id="cab-drawer">
        <div class="cab-drawer-label" aria-hidden="true">
            <span>Drawer 01 &mdash; Selected work</span>
            <span><?php echo esc_html( sprintf( '%02d', $total ) ); ?> folders</span>
        </div>

        <ol class="cab-folders">
            <?php foreach ( $projects as $i => $project ) :
                $number = sprintf( '%02d', $i + 1 );
                $image  = seiyann_project_image_url( $project );
                list( $variant, $c1, $c2, $c3, $c4 ) = $project['art'];
                $art_style = sprintf( '--c1:%s;--c2:%s;--c3:%s;--c4:%s', $c1, $c2, $c3, $c4 );

                $keys = array();
                foreach ( $filters as $key => $filter ) {
                    if ( '' !== $filter['match'] && false !== stripos( $project['category'], $filter['match'] ) ) {
                        $keys[] = $key;
                    }
                }
            ?>
                <li class="folder" id="project-<?php echo esc_attr( $number ); ?>" data-filters="<?php echo esc_attr( implode( ' ', $keys ) ); ?>"
                    style="--tab-x: <?php echo esc_attr( $tab_positions[ $i % count( $tab_positions ) ] ); ?>; --z: <?php echo esc_attr( $i + 1 ); ?>;">

                    <!-- Tab + front strip: the whole thing is the toggle -->
                    <button type="button" class="folder-toggle" aria-expanded="false" aria-controls="case-<?php echo esc_attr( $number ); ?>">
                        <span class="folder-tab"><b><?php echo esc_html( $number ); ?></b> &middot; <?php echo esc_html( $project['title'] ); ?></span>
                        <span class="folder-front">
                            <span class="folder-num"><?php echo esc_html( $number ); ?></span>
                            <span class="folder-title"><?php echo esc_html( $project['title'] ); ?></span>
                            <span class="folder-meta">
                                <span class="folder-tag"><?php echo esc_html( $project['tag'] ); ?></span>
                                <span class="folder-summary"><?php echo esc_html( $project['summary'] ); ?></span>
                            </span>
                            <span class="folder-action" aria-hidden="true"><span class="folder-action-open">Open</span><span class="folder-action-close">Close</span></span>
                        </span>
                    </button>

                    <!-- Case sheet, revealed when the folder opens -->
                    <div class="folder-body" id="case-<?php echo esc_attr( $number ); ?>" role="region" aria-label="<?php echo esc_attr( $project['title'] . ' case file' ); ?>">
                        <div class="folder-inner">
                            <div class="case-sheet">
                                <figure class="case-exhibit">
                                    <?php if ( $image ) : ?>
                                        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $project['title'] . ' preview' ); ?>" loading="lazy" decoding="async">
                                    <?php else : ?>
                                        <span class="ff-art art-<?php echo esc_attr( $variant ); ?>" style="<?php echo esc_attr( $art_style ); ?>"></span>
                                    <?php endif; ?>
                                    <span class="case-tape" aria-hidden="true">Case <?php echo esc_html( $number . ' / ' . sprintf( '%02d', $total ) ); ?></span>
                                    <figcaption class="case-fig">Fig. <?php echo esc_html( $number ); ?></figcaption>
                                </figure>

                                <div class="case-info">
                                    <dl class="case-fields">
                                        <div><dt>Case</dt><dd><?php echo esc_html( $number . ' / ' . sprintf( '%02d', $total ) ); ?></dd></div>
                                        <div><dt>Discipline</dt><dd><?php echo esc_html( $project['category'] ); ?></dd></div>
                                        <div><dt>Type</dt><dd><?php echo esc_html( $project['tag'] ); ?></dd></div>
                                        <div><dt>Overview</dt><dd class="case-desc"><?php echo esc_html( $project['description'] ); ?></dd></div>
                                    </dl>
                                    <div class="case-foot">
                                        <span class="case-barcode" aria-hidden="true"></span>
                                        <button type="button" class="case-close">Close file</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>

        <div class="cab-drawer-base" aria-hidden="true"></div>
    </div>
</main>

<?php
get_footer();
