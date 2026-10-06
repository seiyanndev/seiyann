<?php
/**
 * Template Name: Capabilities Page
 *
 * 1. "Lens" (pinned, scroll-driven): one real piece of work, this site's homepage, goes through four
 *    stages: brand mark → UI design → code → shipped. Each stage is one capability.
 * 2. Proof matrix: every project against every capability, so each claim links to real work.
 *
 * Data: seiyann_capabilities(), seiyann_projects(), seiyann_project_caps() in functions.php.
 * Styles: assets/css/capabilities.css. Motion: assets/js/capabilities.js.
 *
 * @package Seiyann
 */

get_header();

$capabilities = seiyann_capabilities();
$projects     = seiyann_projects();

$work_page = get_page_by_path( 'work' );
$work_url  = $work_page ? get_permalink( $work_page->ID ) : home_url( '/work/' );

// How many projects back each capability (matrix footer).
$cap_counts = array_fill_keys( array_keys( $capabilities ), 0 );
foreach ( $projects as $project ) {
    foreach ( seiyann_project_caps( $project ) as $cap ) {
        $cap_counts[ $cap ]++;
    }
}
?>

<main class="relative flex-1 md:ml-24">

    <!-- ============ 1. Lens: brand → design → code → shipped ============ -->
    <section id="lens" class="lens-section" aria-label="Capabilities">
        <div class="lens-layout">

            <!-- Left: intro + the four capabilities (the current stage is highlighted) -->
            <div class="lens-intro">
                <div class="lens-eyebrow">
                    <span class="lens-eyebrow-line"></span>
                    <span>Capabilities</span><span class="lens-eyebrow-sep">/</span><span>File No. 004</span>
                </div>
                <h1 class="lens-title">Design. Code. <span>Build.</span></h1>
                <p class="lens-lede">One project, four lenses. Scroll to watch this site go from a sketch to a shipped product.</p>

                <ol class="lens-steps" id="lens-steps">
                    <?php $i = 0; foreach ( $capabilities as $key => $cap ) : ?>
                        <li class="lens-step<?php echo 0 === $i ? ' is-active' : ''; ?>" data-step="<?php echo esc_attr( $i ); ?>">
                            <button type="button" class="lens-step-head">
                                <span class="lens-step-box" aria-hidden="true"></span>
                                <span class="lens-step-num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
                                <span class="lens-step-title"><?php echo esc_html( $cap['title'] ); ?></span>
                            </button>
                            <div class="lens-step-body">
                                <div class="lens-step-inner">
                                    <p><?php echo esc_html( $cap['summary'] ); ?></p>
                                    <ul>
                                        <?php foreach ( $cap['deliverables'] as $item ) : ?>
                                            <li><?php echo esc_html( $item ); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    <?php $i++; endforeach; ?>
                </ol>
            </div>

            <!-- Right: the artifact, filed as "Exhibit A" on a taped evidence sheet. Every layer is
                 animated by the scrubbed timeline in capabilities.js; the caption follows the stage. -->
            <div class="lens-canvas-wrap">
              <figure class="lens-exhibit">
                <span class="lens-exhibit-tape" aria-hidden="true">Exhibit A &mdash; Seiyann</span>
                <span class="lens-crop lens-crop--tl" aria-hidden="true"></span>
                <span class="lens-crop lens-crop--tr" aria-hidden="true"></span>
                <span class="lens-crop lens-crop--bl" aria-hidden="true"></span>
                <span class="lens-crop lens-crop--br" aria-hidden="true"></span>
                <div class="lens-canvas" id="lens-canvas" aria-hidden="true">

                    <!-- 01 Brand: the monogram drawn from its construction grid -->
                    <svg class="lens-brand" viewBox="0 0 400 300">
                        <g class="lens-construct">
                            <circle pathLength="1" cx="200" cy="150" r="110"></circle>
                            <circle pathLength="1" cx="150" cy="150" r="70"></circle>
                            <circle pathLength="1" cx="250" cy="150" r="70"></circle>
                            <line pathLength="1" x1="40" y1="150" x2="360" y2="150"></line>
                            <line pathLength="1" x1="200" y1="20" x2="200" y2="280"></line>
                            <line pathLength="1" x1="90" y1="205" x2="310" y2="205"></line>
                            <line pathLength="1" x1="90" y1="95" x2="310" y2="95"></line>
                        </g>
                        <g class="lens-mono">
                            <text x="200" y="205" text-anchor="middle"><tspan class="lens-mono-k">K</tspan><tspan>A</tspan></text>
                        </g>
                        <g class="lens-brand-labels">
                            <text x="40" y="140">x-height</text>
                            <text x="40" y="198">baseline</text>
                        </g>
                    </svg>

                    <!-- 02 Design: a browser frame with this site's homepage, wireframe first -->
                    <div class="lens-frame">
                        <div class="lens-frame-bar">
                            <i></i><i></i><i></i>
                            <span class="lens-live"><b></b>Live</span>
                        </div>
                        <div class="lens-frame-body">
                            <div class="lens-ui-nav">
                                <span class="lens-el lens-ui-logo"><span class="lens-skel"></span><span class="lens-real"><span class="k">K</span>A</span></span>
                                <span class="lens-el lens-ui-dot is-active"><span class="lens-skel"></span><span class="lens-real"></span></span>
                                <span class="lens-el lens-ui-dot"><span class="lens-skel"></span><span class="lens-real"></span></span>
                                <span class="lens-el lens-ui-dot"><span class="lens-skel"></span><span class="lens-real"></span></span>
                                <span class="lens-el lens-ui-dot"><span class="lens-skel"></span><span class="lens-real"></span></span>
                            </div>
                            <div class="lens-ui-main">
                                <span class="lens-el lens-ui-eyebrow"><span class="lens-skel"></span><span class="lens-real">Graphic Designer &amp; Full-Stack Developer</span></span>
                                <span class="lens-el lens-ui-h"><span class="lens-skel"></span><span class="lens-real">I design visual identities,</span></span>
                                <span class="lens-el lens-ui-h is-muted"><span class="lens-skel"></span><span class="lens-real">build digital products,</span></span>
                                <span class="lens-el lens-ui-h is-muted"><span class="lens-skel"></span><span class="lens-real">and turn ideas into real solutions.</span></span>
                                <span class="lens-el lens-ui-p"><span class="lens-skel"></span><span class="lens-real">I'm a graphic designer and full-stack developer who loves creating meaningful brands.</span></span>
                                <a class="lens-el lens-ui-btn" href="<?php echo esc_url( $work_url ); ?>" tabindex="-1">
                                    <span class="lens-skel"></span>
                                    <span class="lens-real"><i>&rarr;</i>View my work</span>
                                </a>
                            </div>
                        </div>
                        <svg class="lens-cursor" viewBox="0 0 24 24"><path d="M4 2l16 9-7 2-3 7z"></path></svg>
                        <span class="lens-toast"><b></b>Deployed</span>
                    </div>

                    <!-- 03 Code: the markup behind the frame, typed out line by line -->
                    <pre class="lens-code"><code><?php
                        $lines = array(
                            '<span class="t">&lt;h1</span> <span class="a">id</span>=<span class="s">"hero-headline"</span><span class="t">&gt;</span>',
                            '  <span class="t">&lt;span&gt;</span>I design visual identities,<span class="t">&lt;/span&gt;</span>',
                            '  <span class="t">&lt;span</span> <span class="a">class</span>=<span class="s">"muted"</span><span class="t">&gt;</span>build digital products,<span class="t">&lt;/span&gt;</span>',
                            '<span class="t">&lt;/h1&gt;</span>',
                            '',
                            '<span class="t">&lt;a</span> <span class="a">href</span>=<span class="s">"/work/"</span> <span class="a">class</span>=<span class="s">"cta"</span><span class="t">&gt;</span>',
                            '  View my work <span class="t">&lt;i&gt;</span>&amp;rarr;<span class="t">&lt;/i&gt;</span>',
                            '<span class="t">&lt;/a&gt;</span>',
                            '',
                            '<span class="c">// glitch each word on hover</span>',
                            '<span class="k">SplitText</span>.create(<span class="s">"#hero-headline"</span>, {',
                            '  type: <span class="s">"words,chars"</span>',
                            '});',
                        );
                        foreach ( $lines as $n => $line ) {
                            printf( '<span class="lens-line"><span class="ln">%d</span>%s</span>', $n + 1, $line ? $line : ' ' );
                        }
                    ?></code></pre>
                </div>
                <figcaption class="lens-exhibit-foot">
                    <span class="lens-exhibit-id">Exhibit A-<span id="lens-exhibit-num">01</span></span>
                    <span class="lens-exhibit-label" id="lens-exhibit-label"><?php echo esc_html( reset( $capabilities )['title'] ); ?></span>
                    <span class="lens-exhibit-bars" aria-hidden="true"></span>
                </figcaption>
              </figure>
            </div>
        </div>

        <!-- Stage progress (bottom of the pinned section) -->
        <div class="lens-progress" aria-hidden="true"><span id="lens-progress-fill"></span></div>
    </section>

    <!-- ============ 2. Proof matrix ============ -->
    <section id="proof" class="proof-section" aria-labelledby="proof-title">
        <div class="proof-head">
            <div class="lens-eyebrow">
                <span class="lens-eyebrow-line"></span>
                <span>Proof</span><span class="lens-eyebrow-sep">/</span><span>Index B</span>
            </div>
            <h2 id="proof-title" class="proof-title">Every capability,<br><span>backed by a project.</span></h2>
            <p class="proof-lede">Hover a capability to see where it was used. Select a project to open it.</p>
        </div>

        <!-- Cross-reference index, printed on a taped sheet -->
        <div class="proof-sheet">
        <span class="proof-tape" aria-hidden="true">Index B &mdash; Cross-reference</span>
        <div class="proof-scroll">
            <table class="proof-table" id="proof-table">
                <thead>
                    <tr>
                        <th scope="col" class="proof-col-num">#</th>
                        <th scope="col" class="proof-col-name">Project</th>
                        <?php foreach ( $capabilities as $key => $cap ) : ?>
                            <th scope="col" class="proof-cap" data-cap="<?php echo esc_attr( $key ); ?>" tabindex="0">
                                <?php echo esc_html( $cap['title'] ); ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ( $projects as $i => $project ) :
                        $caps = seiyann_project_caps( $project );
                        $href = $work_url . '#project-' . sprintf( '%02d', $i + 1 );
                    ?>
                        <tr class="proof-row" data-caps="<?php echo esc_attr( implode( ' ', $caps ) ); ?>" data-href="<?php echo esc_url( $href ); ?>">
                            <td class="proof-col-num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></td>
                            <th scope="row" class="proof-col-name">
                                <a href="<?php echo esc_url( $href ); ?>"><?php echo esc_html( $project['title'] ); ?></a>
                                <span class="proof-tag"><?php echo esc_html( $project['tag'] ); ?></span>
                            </th>
                            <?php foreach ( $capabilities as $key => $cap ) :
                                $has = in_array( $key, $caps, true );
                            ?>
                                <td class="proof-cell" data-cap="<?php echo esc_attr( $key ); ?>">
                                    <span class="proof-mark<?php echo $has ? ' is-on' : ''; ?>" aria-hidden="true"></span>
                                    <span class="sr-only"><?php echo $has ? 'Yes' : 'No'; ?></span>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="proof-col-num"></td>
                        <th scope="row" class="proof-col-name">Projects</th>
                        <?php foreach ( $capabilities as $key => $cap ) : ?>
                            <td class="proof-count" data-cap="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( sprintf( '%02d', $cap_counts[ $key ] ) ); ?></td>
                        <?php endforeach; ?>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="proof-foot" aria-hidden="true">
            <span class="proof-foot-bars"></span>
            <span class="proof-foot-text">Source: project categories &middot; KA &middot; 004/B</span>
        </div>
        </div>
    </section>
</main>

<?php
get_footer();
