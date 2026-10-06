<?php
/**
 * Template Name: Experience Page
 *
 * "The Dossier", File No. 002: Service Record. Each role is a record card pulled from the file
 * (taped, stamped CURRENT / COMPLETED, ID-card style fields), with a sticky year index on the left.
 *
 * Data: seiyann_experience() (functions.php). Styles: assets/css/experience.css.
 * Motion: assets/js/experience.js.
 *
 * @package Seiyann
 */

get_header();

$records  = seiyann_experience();
$projects = seiyann_projects();

$work_page = get_page_by_path( 'work' );
$work_url  = $work_page ? get_permalink( $work_page->ID ) : home_url( '/work/' );

// Lookups for a record's tools (with logos) and related projects (linked into the Work deck).
$tools_by_name = array();
foreach ( seiyann_tools() as $tool ) {
    $tools_by_name[ $tool['name'] ] = $tool;
}
$project_links = array();
foreach ( $projects as $i => $project ) {
    $project_links[ $project['title'] ] = $work_url . '#project-' . sprintf( '%02d', $i + 1 );
}

$period = function ( $record ) {
    return $record['start'] . ' — ' . ( '' === $record['end'] ? 'Present' : $record['end'] );
};
?>

<main class="exp flex-1 px-6 sm:px-12 md:px-24 lg:px-36 pt-12 pb-24 md:ml-24">

    <!-- ============ Header ============ -->
    <header class="exp-hero" id="exp-hero">
        <div class="exp-eyebrow">
            <span class="exp-eyebrow-line"></span>
            <span>Experience</span><span class="exp-eyebrow-sep">/</span><span>File No. 002</span>
        </div>

        <h1 class="exp-title">
            <span class="exp-line"><span>Service record.</span></span>
            <span class="exp-line is-muted"><span>Where the work happened.</span></span>
        </h1>

        <p class="exp-lede">Building experience through design, development, and real-world projects.</p>

        <!-- Record summary: same facts as the About page ID card -->
        <dl class="exp-summary">
            <div><dt>Experience</dt><dd>3+ years</dd></div>
            <div><dt>Roles on file</dt><dd><?php echo esc_html( sprintf( '%02d', count( $records ) ) ); ?></dd></div>
            <div><dt>Status</dt><dd><b class="exp-status-dot" aria-hidden="true"></b>Open to work</dd></div>
            <div><dt>Based in</dt><dd>Lucena City, PH</dd></div>
        </dl>
    </header>

    <!-- ============ Records ============ -->
    <div class="exp-body" id="exp-records">

        <!-- Year index: sticky beside the records on desktop, a scrollable strip on phones -->
        <nav class="exp-index" aria-label="Records by year">
            <ol>
                <?php foreach ( $records as $i => $record ) : ?>
                    <li>
                        <a href="#record-<?php echo esc_attr( sprintf( '%02d', $i + 1 ) ); ?>" class="exp-index-link<?php echo 0 === $i ? ' is-active' : ''; ?>" data-index="<?php echo esc_attr( $i ); ?>">
                            <span class="exp-index-num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
                            <span class="exp-index-year"><?php echo esc_html( $record['start'] ); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ol>
        </nav>

        <div class="exp-records">
            <?php foreach ( $records as $i => $record ) :
                $num        = sprintf( '%02d', $i + 1 );
                $is_current = '' === $record['end'];
                $meta       = array_filter( array( $record['type'], $record['location'] ) );
            ?>
                <article class="rec" id="record-<?php echo esc_attr( $num ); ?>" data-index="<?php echo esc_attr( $i ); ?>" aria-labelledby="rec-role-<?php echo esc_attr( $num ); ?>">
                    <span class="rec-tape" aria-hidden="true">Record <?php echo esc_html( $num ); ?> &mdash; <?php echo esc_html( $record['start'] ); ?></span>

                    <header class="rec-head">
                        <span class="rec-num">Record <?php echo esc_html( $num ); ?></span>
                        <h2 class="rec-role" id="rec-role-<?php echo esc_attr( $num ); ?>"><?php echo esc_html( $record['role'] ); ?></h2>
                        <p class="rec-org">
                            <?php echo esc_html( $record['org'] ); ?>
                            <?php if ( $meta ) : ?><span>&middot; <?php echo esc_html( implode( ' · ', $meta ) ); ?></span><?php endif; ?>
                        </p>
                        <span class="rec-stamp<?php echo $is_current ? ' is-current' : ''; ?>"><?php echo $is_current ? 'Current' : 'Completed'; ?></span>
                    </header>

                    <dl class="rec-fields">
                        <div>
                            <dt>Period</dt>
                            <dd><?php echo esc_html( $period( $record ) ); ?></dd>
                        </div>
                        <div>
                            <dt>Duties</dt>
                            <dd>
                                <ol class="rec-duties">
                                    <?php foreach ( $record['duties'] as $d => $duty ) : ?>
                                        <li><span class="rec-duty-num"><?php echo esc_html( sprintf( '%02d', $d + 1 ) ); ?></span><span class="rec-duty-text"><?php echo esc_html( $duty ); ?></span></li>
                                    <?php endforeach; ?>
                                </ol>
                            </dd>
                        </div>
                        <?php if ( $record['tools'] ) : ?>
                            <div>
                                <dt>Tools</dt>
                                <dd class="rec-tools">
                                    <?php foreach ( $record['tools'] as $tool_name ) :
                                        $tool = isset( $tools_by_name[ $tool_name ] ) ? $tools_by_name[ $tool_name ] : null;
                                    ?>
                                        <span class="rec-tool">
                                            <?php if ( $tool ) { echo seiyann_tool_icon( $tool['icon'] ); } // phpcs:ignore WordPress.Security.EscapeOutput -- trusted theme SVGs ?>
                                            <?php echo esc_html( $tool_name ); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </dd>
                            </div>
                        <?php endif; ?>
                        <?php if ( $record['projects'] ) : ?>
                            <div>
                                <dt>Proof</dt>
                                <dd class="rec-proof">
                                    <?php foreach ( $record['projects'] as $title ) : ?>
                                        <?php if ( isset( $project_links[ $title ] ) ) : ?>
                                            <a href="<?php echo esc_url( $project_links[ $title ] ); ?>"><?php echo esc_html( $title ); ?> &rarr;</a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </dd>
                            </div>
                        <?php endif; ?>
                    </dl>

                    <footer class="rec-foot" aria-hidden="true">
                        <span class="rec-barcode"></span>
                        <span class="rec-code">REC-<?php echo esc_html( $num ); ?> &middot; <?php echo esc_html( $record['start'] ); ?></span>
                    </footer>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php
get_footer();
