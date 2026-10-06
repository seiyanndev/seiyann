<?php
/**
 * Template Name: Front Page
 * The template for displaying the homepage hero section
 *
 * @package Seiyann
 */

get_header(); 
?>

<!-- Homepage styles: assets/css/home.css -->

<!-- Hero Section Container -->
<main class="relative flex-1 flex flex-col justify-between px-6 sm:px-12 md:px-24 lg:px-36 xl:pl-28 py-12 md:py-16 md:ml-24">
    <!-- Top Header Info with Fade Animation -->
    <div class="flex items-center w-full relative md:top-[16px] opacity-0 animate-fade-up">
        <div class="flex items-start sm:items-center gap-3 text-xs tracking-widest text-gray-400 uppercase font-medium">
            <span class="w-6 h-[1px] bg-gray-300 mt-2 sm:mt-0 flex-shrink-0"></span>
            <p class="leading-relaxed">Graphic Designer &amp; Full-Stack Developer</p>
        </div>
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

        <p class="text-gray-500 text-sm md:text-base max-w-lg mb-10 leading-relaxed font-normal opacity-0 animate-fade-up delay-200">
            I'm a graphic designer and full-stack developer who loves creating meaningful brands and building functional, beautiful web experiences.
        </p>

        <a href="<?php echo esc_url( home_url( '/work/' ) ); ?>" class="inline-flex items-center space-x-4 group cursor-pointer opacity-0 animate-fade-up delay-300">
            <div class="w-12 h-12 rounded-full bg-black text-white flex items-center justify-center transition-transform duration-300 group-hover:scale-105 group-hover:bg-gray-800 shadow-md">
                <svg class="w-4 h-4 transform transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </div>
            <span class="text-xs font-bold tracking-widest uppercase text-gray-900 group-hover:text-gray-600 transition-colors">View My Work</span>
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

<?php 
get_footer();