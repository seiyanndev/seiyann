<?php
function seiyann_enqueue_styles() {
    // Tailwind is loaded (and configured) directly in header.php; loading it again here would reset that config.

    // Site-wide dark mode overrides (active when <html> has the `dark` class)
    $dark_css = get_template_directory() . '/assets/dark-mode.css';
    wp_enqueue_style( 'seiyann-dark-mode', get_template_directory_uri() . '/assets/dark-mode.css', array(), filemtime( $dark_css ) );

    // GSAP core + ScrollTrigger (loaded in the footer; page scripts can use `gsap` and `ScrollTrigger` globally)
    wp_enqueue_script( 'gsap', 'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/gsap.min.js', array(), '3.15.0', true );
    wp_enqueue_script( 'gsap-scrolltrigger', 'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/ScrollTrigger.min.js', array( 'gsap' ), '3.15.0', true );
    wp_add_inline_script( 'gsap-scrolltrigger', 'gsap.registerPlugin(ScrollTrigger);' );

    // Homepage: styles, headline font-glitch (assets/js/hero-headline.js) and hero slideshow (assets/js/hero-visual.js)
    if ( is_front_page() ) {
        $home_css = get_template_directory() . '/assets/css/home.css';
        wp_enqueue_style( 'seiyann-home', get_template_directory_uri() . '/assets/css/home.css', array(), filemtime( $home_css ) );

        $visual_js = get_template_directory() . '/assets/js/hero-visual.js';
        wp_enqueue_script( 'seiyann-hero-visual', get_template_directory_uri() . '/assets/js/hero-visual.js', array( 'gsap', 'gsap-scrolltrigger' ), filemtime( $visual_js ), true );

        wp_enqueue_script( 'gsap-splittext', 'https://cdn.jsdelivr.net/npm/gsap@3.15.0/dist/SplitText.min.js', array( 'gsap' ), '3.15.0', true );

        $hero_js = get_template_directory() . '/assets/js/hero-headline.js';
        wp_enqueue_script( 'seiyann-hero-headline', get_template_directory_uri() . '/assets/js/hero-headline.js', array( 'gsap', 'gsap-splittext' ), filemtime( $hero_js ), true );

        // Glitch typefaces, subset to only the headline's characters so each file is a few KB
        $hero_text   = implode( '', wp_list_pluck( seiyann_hero_lines(), 'text' ) );
        $hero_glyphs = str_replace( ' ', '', count_chars( $hero_text, 3 ) );
        $glitch_fonts = 'family=Playfair+Display:ital,wght@1,700'
            . '&family=Space+Mono:wght@700'
            . '&family=UnifrakturMaguntia'
            . '&family=Bebas+Neue'
            . '&family=Bungee'
            . '&family=Pacifico'
            . '&family=Major+Mono+Display';
        wp_enqueue_style( 'seiyann-glitch-fonts', 'https://fonts.googleapis.com/css2?' . $glitch_fonts . '&text=' . rawurlencode( $hero_glyphs ) . '&display=block', array(), null );
    }

    // Work page: "Freefall" scroll-driven project deck
    if ( is_page( 'work' ) ) {
        $work_css = get_template_directory() . '/assets/css/work.css';
        wp_enqueue_style( 'seiyann-work', get_template_directory_uri() . '/assets/css/work.css', array(), filemtime( $work_css ) );

        $work_js = get_template_directory() . '/assets/js/work-freefall.js';
        wp_enqueue_script( 'seiyann-work-freefall', get_template_directory_uri() . '/assets/js/work-freefall.js', array( 'gsap', 'gsap-scrolltrigger' ), filemtime( $work_js ), true );
    }

    // Alpine.js Core CDN (loaded in footer with defer)
    wp_enqueue_script( 'alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array(), '3.x.x', true );
}
add_action('wp_enqueue_scripts', 'seiyann_enqueue_styles', 999);

// Homepage headline lines. Used by front-page.php for the markup and above for the glitch-font subset,
// so editing the text here keeps both in sync.
function seiyann_hero_lines() {
    return array(
        array( 'text' => 'I design visual identities,',         'class' => 'text-gray-900' ),
        array( 'text' => 'build digital products,',             'class' => 'hero-line-muted' ),
        array( 'text' => 'and turn ideas into real solutions.', 'class' => 'hero-line-muted' ),
    );
}

// Work page projects ("Freefall" deck in page-work.php). `image` is a file in assets/ (left empty, or
// pointing at a missing file, the card shows generated abstract `art` instead: a variant from
// assets/css/work.css plus four colours).
function seiyann_projects() {
    return array(
        array( 'title' => 'Agrilink', 'tag' => 'Web App', 'category' => 'UI-UX / Web Development',
               'summary' => 'Farm-to-table marketplace with GIS monitoring.',
               'description' => 'A demand-driven agricultural e-commerce and GIS-based monitoring system designed for Lucena City. It connects local farmers and consumers directly, allowing buyers to request products and farmers to respond, creating a flexible farm-to-table marketplace.',
               'image' => '', 'art' => array( 'marble', '#0f5132', '#7ed957', '#f4e04d', '#1b998b' ) ),
        array( 'title' => 'BRRCS', 'tag' => 'Records System', 'category' => 'UI-UX / Web Development',
               'summary' => 'Resident records and barangay certificates, automated.',
               'description' => 'Barangay Residential Record and Certification System (BRRCS) is a streamlined digital tool built to automate resident record tracking, clearances, and barangay certificate issuance securely.',
               'image' => '', 'art' => array( 'folds', '#0b1f4d', '#2f6bff', '#9cc3ff', '#f2f5ff' ) ),
        array( 'title' => 'LoanTrackr', 'tag' => 'PWA', 'category' => 'UI-UX / Web Development',
               'summary' => 'Loans, payments and balances, tracked in one place.',
               'description' => 'LoanTrackr is a simple and efficient personal loan tracking Progressive Web App (PWA) that helps you stay in control of your finances. It allows you to record loans, monitor payments, and track remaining balances—all in one place.',
               'image' => '', 'art' => array( 'streaks', '#06281f', '#00c2a8', '#c6ff3d', '#ffffff' ) ),
        array( 'title' => 'Seiyann', 'tag' => 'Brand + CMS', 'category' => 'Branding / UI-UX / Web Development',
               'summary' => 'A portfolio and content system built from scratch.',
               'description' => 'Seiyann is a custom, full-stack dynamic portfolio and content management system built from scratch. It features modular custom page templates, an interactive multi-category project filtering engine, dynamic modals, and a robust owner-only dashboard designed to seamlessly manage projects, credentials, and achievements in real time.',
               'image' => 'portfoliocms.png', 'art' => array( 'silk', '#111111', '#4f2bff', '#ff4d3d', '#f5f5f5' ) ),
        array( 'title' => 'Sidequest', 'tag' => 'Branding', 'category' => 'Branding / UI-UX',
               'summary' => 'Self-improvement, played as an adventure.',
               'description' => 'Sidequest is a gamified self-improvement platform designed to turn personal growth into an engaging adventure. By combining daily micro-quests, habit streaks, mood reflection tools, and XP progression systems, it helps users stay accountable, break productivity slumps, and build lasting lifestyle habits.',
               'image' => 'sidequest.png', 'art' => array( 'streaks', '#1a0b3d', '#ff9f1c', '#2ec4b6', '#ffffff' ) ),
        array( 'title' => 'BrewFlow', 'tag' => 'POS System', 'category' => 'UI-UX / Web Development',
               'summary' => 'Point of sale and stock control for coffee shops.',
               'description' => 'BrewFlow is a smart POS & inventory management system engineered specifically for modern coffee shops. It streamlines daily operations by automating stock tracking for perishable ingredients, providing rapid-fire order processing interfaces, and delivering real-time analytics to help cafe owners optimize margins and reduce waste.',
               'image' => '', 'art' => array( 'pour', '#2b1408', '#c87533', '#f3d9b1', '#1a0b05' ) ),
        array( 'title' => 'Parallel HQ', 'tag' => 'Brand + Store', 'category' => 'Branding / UI-UX / Web Development',
               'summary' => 'Identity and storefront for curated thrift.',
               'description' => 'Parallel HQ is a digital storefront and curated brand identity platform built for modern thrifted and vintage apparel. The project blends sustainable fashion aesthetics with an intuitive e-commerce experience, featuring seamless product discovery, editorial-style lookbooks, and a streamlined checkout flow designed to elevate secondhand shopping for the next generation.',
               'image' => '', 'art' => array( 'silk', '#ff2e63', '#ffb3c6', '#4f2bff', '#fff1f5' ) ),
        array( 'title' => 'Vestia', 'tag' => 'Web App', 'category' => 'UI-UX / Web Development',
               'summary' => 'Finding exceptional places to live, simplified.',
               'description' => 'Vestia exists to simplify the search for exceptional living spaces through a modern, trustworthy, and beautifully designed digital experience. It provides intuitive property discovery flows, detailed accommodation insights, and a seamless interface tailored for modern renters.',
               'image' => '', 'art' => array( 'folds', '#e07a5f', '#f2cc8f', '#3d405b', '#f4f1de' ) ),
        array( 'title' => 'Veya', 'tag' => 'Travel', 'category' => 'UI-UX / Web Development',
               'summary' => 'Itineraries, routes and bookings in one plan.',
               'description' => 'Veya is an all-in-one travel management and itinerary planning platform designed to streamline trip coordination. It features interactive route mapping, collaborative travel schedules, real-time booking updates, and an immersive user interface built to simplify destination discovery for modern travelers.',
               'image' => '', 'art' => array( 'streaks', '#2a0a5e', '#8b5cf6', '#3ef07a', '#ffffff' ) ),
        array( 'title' => 'Auslands Care', 'tag' => 'UI/UX Revamp', 'category' => 'UI-UX Design',
               'summary' => 'An NDIS housing site redesigned for accessibility.',
               'description' => 'Auslands Care is a comprehensive UI/UX design revamp for an NDIS accommodation website. The redesign focuses on accessibility, user trust, and a seamless discovery process to help participants and families easily find specialized disability housing and support services.',
               'image' => '', 'art' => array( 'silk', '#0e7c86', '#9ee6d8', '#ff8a5b', '#fdf6ec' ) ),
        array( 'title' => 'BEST DSS', 'tag' => 'Decision Support', 'category' => 'UI-UX / Web Development',
               'summary' => 'Complex data turned into clear decisions.',
               'description' => 'BEST DSS is an advanced decision support system where I spearheaded both the UI/UX design and frontend development. The project focuses on translating complex data structures into clean, intuitive interfaces and responsive, high-performance web components for optimized decision-making.',
               'image' => '', 'art' => array( 'pour', '#f9d71c', '#1d3557', '#3a86ff', '#0b132b' ) ),
        array( 'title' => 'Alan Associates', 'tag' => 'UI/UX + Frontend', 'category' => 'UI-UX / Web Development',
               'summary' => 'A debt-recovery site rebuilt around trust.',
               'description' => 'Alan Associates is a trusted Australian business debt collection and credit management specialist website. I handled the complete UI/UX design revamp and frontend development, creating a clean, professional, and empathetic digital experience designed to build trust and streamline client outreach.',
               'image' => '', 'art' => array( 'marble', '#0b132b', '#1c2541', '#c9a227', '#e0e1dd' ) ),
        array( 'title' => 'Reliable Touch Cleaning Services', 'tag' => 'UI/UX + Frontend', 'category' => 'UI-UX / Web Development',
               'summary' => 'A cleaning-services site built to convert bookings.',
               'description' => 'Reliable Touch Cleaning Services is a modern website redesign and frontend development project. I spearheaded the UI/UX revamp and custom frontend implementation to deliver a clean, trustworthy, and conversion-focused platform optimized for service bookings.',
               'image' => '', 'art' => array( 'marble', '#00b4d8', '#caf0f8', '#0077b6', '#ffffff' ) ),
    );
}

// A project's image URL if its file exists in assets/, otherwise '' (the card uses its generated art).
function seiyann_project_image_url( $project ) {
    if ( empty( $project['image'] ) || ! file_exists( get_template_directory() . '/assets/' . $project['image'] ) ) {
        return '';
    }
    return get_template_directory_uri() . '/assets/' . $project['image'];
}

// Homepage hero slideshow (images in assets/img/hero/, cropped 3:4 and greyscaled).
// All photos are free under the Unsplash License (https://unsplash.com/license):
//   barbican  https://unsplash.com/photos/rEtsek-3HFk   bochum   https://unsplash.com/photos/p7vMzekHXrU
//   belgrade  https://unsplash.com/photos/P2uH1ASIYto   shanghai https://unsplash.com/photos/7WQlCMzGGI8
function seiyann_hero_slides() {
    return array(
        array( 'image' => 'brutalist-barbican.webp', 'place' => 'Barbican Estate, London',    'photographer' => 'Mike Hindle',    'alt' => 'Zig-zag concrete balconies of the Barbican towers in London' ),
        array( 'image' => 'brutalist-bochum.webp',   'place' => 'Ruhr University, Bochum',    'photographer' => 'Julia Taubitz',  'alt' => 'Rows of concrete columns under a raised deck at Ruhr University Bochum' ),
        array( 'image' => 'brutalist-belgrade.webp', 'place' => 'Belgrade, Serbia',           'photographer' => 'Goran Petkovic', 'alt' => 'Stacked weathered concrete volumes of a building in Belgrade' ),
        array( 'image' => 'brutalist-shanghai.webp', 'place' => '1933 Old Millfun, Shanghai', 'photographer' => 'Declan Sun',     'alt' => 'Concrete ramps and bridges inside 1933 Old Millfun in Shanghai' ),
    );
}

// Setup theme features and menu locations
function seiyann_theme_setup() {
    register_nav_menus(array(
        'primary-menu' => __('Primary Desktop Menu', 'seiyann'),
        'mobile-menu'  => __('Mobile Overlay Menu', 'seiyann'),
        'sidebar-nav'  => __('Sidebar Navigation Menu', 'seiyann'),
    ));

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'seiyann_theme_setup');

// Handle portfolio contact form submission
function handle_portfolio_contact_form() {
    if ( ! isset( $_POST['portfolio_contact_nonce'] ) || ! wp_verify_nonce( $_POST['portfolio_contact_nonce'], 'portfolio_contact_verify' ) ) {
        wp_die( 'Security check failed.' );
    }

    $name    = sanitize_text_field( $_POST['contact_name'] );
    $email   = sanitize_email( $_POST['contact_email'] );
    $subject = sanitize_text_field( $_POST['contact_subject'] );
    $message = sanitize_textarea_field( $_POST['contact_message'] );

    $to = 'kurtcyrsfa@gmail.com';
    $email_subject = 'New Portfolio Message: ' . ( !empty($subject) ? $subject : 'General Inquiry' );

    $body  = "You have received a new message from your portfolio contact form:\n\n";
    $body .= "Name: {$name}\n";
    $body .= "Email: {$email}\n";
    $body .= "Subject: {$subject}\n\n";
    $body .= "Message:\n{$message}\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>');

    $sent = wp_mail( $to, $email_subject, $body, $headers );

    $redirect_url = wp_get_referer();
    if ( ! $redirect_url ) {
        $redirect_url = home_url('/contact');
    }

    if ( $sent ) {
        $redirect_url = add_query_arg( 'contact_sent', '1', $redirect_url );
    } else {
        $redirect_url = add_query_arg( 'contact_error', '1', $redirect_url );
    }

    wp_safe_redirect( $redirect_url );
    exit;
}
add_action( 'admin_post_nopriv_submit_portfolio_contact', 'handle_portfolio_contact_form' );
add_action( 'admin_post_submit_portfolio_contact', 'handle_portfolio_contact_form' );