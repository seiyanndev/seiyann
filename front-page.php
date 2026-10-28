<?php
/**
 * Template Name: Front Page
 * The template for displaying the homepage hero section
 *
 * @package Seiyann
 */

get_header(); 
?>

<!-- Homepage: "The Dossier", File No. 000: Cover Sheet. Styles: assets/css/home.css.
     Motion: hero-headline.js (glitch), hero-visual.js (slideshow), home-cover.js (stamp + contents). -->

<!-- Hero Section Container (a full screen: the contents index follows below) -->
<main class="home-cover relative flex-1 min-h-[100svh] flex flex-col justify-between px-6 sm:px-12 md:px-24 lg:px-36 xl:pl-28 py-12 md:py-16 md:ml-24">
    <!-- Printer's crop marks framing the cover sheet -->
    <span class="cover-crop cover-crop--tl" aria-hidden="true"></span>
    <span class="cover-crop cover-crop--tr" aria-hidden="true"></span>
    <span class="cover-crop cover-crop--bl" aria-hidden="true"></span>
    <span class="cover-crop cover-crop--br" aria-hidden="true"></span>

    <!-- Top row: file label + "Open to work" stamp -->
    <div class="cover-top relative md:top-[16px]">
        <div class="cover-eyebrow opacity-0 animate-fade-up">
            <span class="cover-eyebrow-line"></span>
            <span>Cover sheet</span><span class="cover-eyebrow-sep">/</span><span>File No. 000</span>
        </div>
        <span class="cover-stamp" id="cover-stamp">Open to work</span>
    </div>

    <!-- Hero row: text, then the visual. Stacked below xl; from xl a flex row where the visual
         takes the space the headline leaves (up to a max), so the two never overlap and stay
         vertically centred on each other. -->
    <div class="relative my-auto py-8 xl:flex xl:items-center xl:gap-[1.5vw] xl:-mr-28">

    <!-- Main Hero Content with Staggered Fade Animations -->
    <div id="home" class="relative z-10 max-w-4xl xl:flex-none xl:w-[55%]">
        <!-- Hover (or tap) a word to glitch it through other typefaces: assets/js/hero-headline.js -->
        <h1 id="hero-headline" class="text-4xl md:text-6xl lg:text-7xl xl:text-[clamp(2.75rem,3.6vw,4.5rem)] font-bold tracking-tight leading-[1.1] mb-8 opacity-0 animate-fade-up delay-100">
            <?php foreach ( seiyann_hero_lines() as $line ) : ?>
                <span class="<?php echo esc_attr( $line['class'] ); ?> block"><?php echo esc_html( $line['text'] ); ?></span>
            <?php endforeach; ?>
        </h1>

        <p class="text-gray-500 text-sm md:text-base max-w-lg mb-6 leading-relaxed font-normal opacity-0 animate-fade-up delay-200">
            I'm a graphic designer and full-stack developer who loves creating meaningful brands and building functional, beautiful web experiences.
        </p>

        <!-- Status line: the same facts as the About page ID card -->
        <p class="cover-status opacity-0 animate-fade-up delay-200">
            <span class="cover-status-item"><b class="cover-status-dot" aria-hidden="true"></b>Open to work</span> <span class="cover-status-sep">&middot;</span> <span class="cover-status-item">Lucena City, PH</span> <span class="cover-status-sep">&middot;</span> <span class="cover-status-item">3+ yrs</span>
        </p>

        <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="cover-cta opacity-0 animate-fade-up delay-300">
            <span>Open the file</span>
            <span class="cover-cta-icon" aria-hidden="true">&rarr;</span>
        </a>
    </div>

    <!-- Hero visual: construction lines + auto-playing brutalist slideshow (assets/js/hero-visual.js).
         Square box; card positions in assets/css/home.css, slot transforms in hero-visual.js. -->
    <?php $slides = seiyann_hero_slides(); ?>
    <section id="hero-visual" class="hero-visual mx-auto mt-10 mb-20 w-[min(78vw,340px)] xl:m-0 xl:ml-auto xl:w-auto xl:flex-1 xl:min-w-0 xl:max-w-[720px]" aria-roledescription="carousel" aria-label="Brutalist architecture">
        <!-- Construction grid (500x500 = the visual's box). The big circle frames both cards; the
             dots sit on the right vertical (x 455) where it meets that circle; the black marker caps the
             tick above the small circle, clear of the front card's top edge. -->
        <svg class="hero-lines" viewBox="0 0 500 500" aria-hidden="true">
            <circle class="draw" pathLength="1" cx="230" cy="250" r="245"></circle>
            <circle class="draw" pathLength="1" cx="140" cy="150" r="125"></circle>
            <line   class="draw" pathLength="1" x1="455" y1="40"  x2="455" y2="520"></line>
            <line   class="draw" pathLength="1" x1="-50" y1="425" x2="455" y2="425"></line>
            <line   class="draw" pathLength="1" x1="140" y1="-45" x2="140" y2="25"></line>
            <rect class="marker"      x="135.5" y="-49.5" width="9" height="9"></rect>
            <rect class="marker-soft" x="450.5" y="420.5" width="9" height="9"></rect>
            <rect class="marker-soft" x="450.5" y="35.5"  width="9" height="9"></rect>
        </svg>

        <div class="hero-stage">
            <?php foreach ( $slides as $i => $slide ) : ?>
                <figure class="hero-card" role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr( sprintf( '%d of %d', $i + 1, count( $slides ) ) ); ?>"
                        data-place="<?php echo esc_attr( $slide['place'] ); ?>" data-photographer="<?php echo esc_attr( $slide['photographer'] ); ?>">
                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/hero/' . $slide['image'] ); ?>"
                         alt="<?php echo esc_attr( $slide['alt'] ); ?>" width="900" height="1200" decoding="async"
                         <?php echo 0 === $i ? 'fetchpriority="high"' : ''; ?> draggable="false">
                    <span class="hero-card-tape" aria-hidden="true">Fig. <?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></span>
                    <span class="hero-card-veil" aria-hidden="true"></span>
                </figure>
            <?php endforeach; ?>

            <!-- Tilted to run along the front card's bottom edge (inside the stage so it moves with the cards) -->
            <p class="hero-caption">
                <span class="hero-caption-index">01 / <?php echo esc_html( sprintf( '%02d', count( $slides ) ) ); ?></span> &mdash;
                <span class="hero-caption-place"><?php echo esc_html( $slides[0]['place'] ); ?></span><br>
                Photo: <span class="hero-caption-credit"><?php echo esc_html( $slides[0]['photographer'] ); ?></span> / Unsplash
            </p>
        </div>

        <div class="hero-dots">
            <?php foreach ( $slides as $i => $slide ) : ?>
                <button type="button" class="hero-dot" aria-label="<?php echo esc_attr( sprintf( 'Show slide %d: %s', $i + 1, $slide['place'] ) ); ?>">
                    <span class="hero-dot-fill"></span>
                </button>
            <?php endforeach; ?>
        </div>
    </section>

    </div><!-- /hero row -->
</main>

<!-- ============ Contents: the folder's index, one row per file. (Class is "cover-index", not
     "contents": that is a Tailwind utility for display: contents, which would erase the section's box.) ============ -->
<?php
$experience_count = count( seiyann_experience() );
$contents = array(
    array( 'num' => '001', 'slug' => 'work',         'page' => 'Work',         'title' => 'Case files',     'detail' => sprintf( '%02d cases', count( seiyann_projects() ) ) ),
    array( 'num' => '002', 'slug' => 'capabilities', 'page' => 'Capabilities', 'title' => 'Exhibit A',      'detail' => sprintf( '%d disciplines', count( seiyann_capabilities() ) ) ),
    array( 'num' => '003', 'slug' => 'about',        'page' => 'About',        'title' => 'Personnel file', 'detail' => 'Kurt Atoat' ),
    array( 'num' => '004', 'slug' => 'experience',   'page' => 'Experience',   'title' => 'Service record', 'detail' => sprintf( '%02d roles', $experience_count ) ),
    array( 'num' => '005', 'slug' => 'contact',      'page' => 'Contact',      'title' => 'Request form',   'detail' => 'Open to work' ),
);
?>
<section class="cover-index md:ml-24 px-6 sm:px-12 md:px-24 lg:px-36 xl:pl-28 pt-8 pb-24" id="contents" aria-labelledby="contents-title">
    <div class="contents-head">
        <div class="cover-eyebrow">
            <span class="cover-eyebrow-line"></span>
            <h2 id="contents-title">Contents</h2>
        </div>
        <span class="contents-count"><?php echo esc_html( count( $contents ) ); ?> files</span>
    </div>

    <ol class="contents-list">
        <?php foreach ( $contents as $item ) :
            $page = get_page_by_path( $item['slug'] );
            $url  = $page ? get_permalink( $page->ID ) : home_url( '/' . $item['slug'] . '/' );
        ?>
            <li>
                <a class="contents-row" href="<?php echo esc_url( $url ); ?>">
                    <span class="contents-num"><?php echo esc_html( $item['num'] ); ?></span>
                    <span class="contents-page"><?php echo esc_html( $item['page'] ); ?></span>
                    <span class="contents-title"><?php echo esc_html( $item['title'] ); ?></span>
                    <span class="contents-detail"><?php echo esc_html( $item['detail'] ); ?></span>
                    <span class="contents-tape" aria-hidden="true">Open file &rarr;</span>
                    <span class="contents-arrow" aria-hidden="true">&nearr;</span>
                </a>
            </li>
        <?php endforeach; ?>
    </ol>

    <div class="contents-foot" aria-hidden="true">
        <span class="contents-bars"></span>
        <span class="contents-code">KA &middot; 000 &middot; LUC-PH</span>
    </div>
</section>

<?php 
get_footer();