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

    // Capabilities page: scroll-driven "lens" section + proof matrix
    if ( is_page( 'capabilities' ) ) {
        $caps_css = get_template_directory() . '/assets/css/capabilities.css';
        wp_enqueue_style( 'seiyann-capabilities', get_template_directory_uri() . '/assets/css/capabilities.css', array(), filemtime( $caps_css ) );

        $caps_js = get_template_directory() . '/assets/js/capabilities.js';
        wp_enqueue_script( 'seiyann-capabilities', get_template_directory_uri() . '/assets/js/capabilities.js', array( 'gsap', 'gsap-scrolltrigger' ), filemtime( $caps_js ), true );
    }

    // About page: crossing "toolbox" tapes
    if ( is_page( 'about' ) ) {
        $about_css = get_template_directory() . '/assets/css/about.css';
        wp_enqueue_style( 'seiyann-about', get_template_directory_uri() . '/assets/css/about.css', array(), filemtime( $about_css ) );

        $about_js = get_template_directory() . '/assets/js/about-tools.js';
        wp_enqueue_script( 'seiyann-about-tools', get_template_directory_uri() . '/assets/js/about-tools.js', array( 'gsap' ), filemtime( $about_js ), true );

        $intro_js = get_template_directory() . '/assets/js/about-intro.js';
        wp_enqueue_script( 'seiyann-about-intro', get_template_directory_uri() . '/assets/js/about-intro.js', array( 'gsap', 'gsap-scrolltrigger' ), filemtime( $intro_js ), true );
    }

    // Experience page: "service record" cards
    if ( is_page( 'experience' ) ) {
        $exp_css = get_template_directory() . '/assets/css/experience.css';
        wp_enqueue_style( 'seiyann-experience', get_template_directory_uri() . '/assets/css/experience.css', array(), filemtime( $exp_css ) );

        $exp_js = get_template_directory() . '/assets/js/experience.js';
        wp_enqueue_script( 'seiyann-experience', get_template_directory_uri() . '/assets/js/experience.js', array( 'gsap', 'gsap-scrolltrigger' ), filemtime( $exp_js ), true );
    }

    // Contact page: "request form"
    if ( is_page( 'contact' ) ) {
        $contact_css = get_template_directory() . '/assets/css/contact.css';
        wp_enqueue_style( 'seiyann-contact', get_template_directory_uri() . '/assets/css/contact.css', array(), filemtime( $contact_css ) );

        $contact_js = get_template_directory() . '/assets/js/contact.js';
        wp_enqueue_script( 'seiyann-contact', get_template_directory_uri() . '/assets/js/contact.js', array( 'gsap' ), filemtime( $contact_js ), true );
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

// Capabilities page: the four stages of the "lens" section and the rows of the proof matrix.
// Which projects back each one is derived from the project categories (seiyann_project_caps()).
function seiyann_capabilities() {
    return array(
        'brand' => array(
            'title'        => 'Brand Identity',
            'summary'      => 'Visual systems that make a business recognisable at a glance.',
            'deliverables' => array( 'Logo design', 'Brand guidelines', 'Print & digital collateral', 'Visual systems' ),
        ),
        'ui' => array(
            'title'        => 'UI/UX Design',
            'summary'      => 'Interfaces that are clear, intuitive and built around the people using them.',
            'deliverables' => array( 'Wireframes & prototypes', 'User research', 'Interactive design', 'Responsive design' ),
        ),
        'web' => array(
            'title'        => 'Web Development',
            'summary'      => 'Responsive web applications, from the database to deployment.',
            'deliverables' => array( 'Frontend development', 'Backend development', 'Database management', 'Deployment' ),
        ),
        'e2e' => array(
            'title'        => 'End-to-End',
            'summary'      => 'One person from first sketch to shipped product, so nothing gets lost between design and code.',
            'deliverables' => array( 'Concept development', 'Art direction', 'Visual storytelling', 'End-to-end production' ),
        ),
    );
}

// Capability keys a project demonstrates, from its category text. End-to-end = all three disciplines.
function seiyann_project_caps( $project ) {
    $caps = array();
    if ( false !== stripos( $project['category'], 'Branding' ) )        { $caps[] = 'brand'; }
    if ( false !== stripos( $project['category'], 'UI-UX' ) )           { $caps[] = 'ui'; }
    if ( false !== stripos( $project['category'], 'Web Development' ) ) { $caps[] = 'web'; }
    if ( 3 === count( $caps ) )                                           { $caps[] = 'e2e'; }
    return $caps;
}

// Experience page "service record" (page-experience.php), newest first.
// PLACEHOLDER CONTENT: carried over from the previous page design; Kurt will replace it with his real history.
// Fields: `end` = '' means current (stamped CURRENT). `type`/`location` optional (hidden when empty).
// `tools` = names from seiyann_tools() (shown with their logos). `projects` = titles from seiyann_projects() (linked).
function seiyann_experience() {
    return array(
        array( 'role' => 'Social Media Manager / Graphic Designer', 'org' => 'XYZ Digital Agency',
               'start' => '2025', 'end' => '', 'type' => '', 'location' => '',
               'duties' => array( 'Managed social media content and campaigns across multiple platforms.', 'Created graphics and digital materials for brand promotion.', 'Planned and organized content calendar and influencer collaborations.' ),
               'tools' => array(), 'projects' => array() ),
        array( 'role' => 'Web Developer / IT Specialist', 'org' => 'ABC Solutions',
               'start' => '2024', 'end' => '2025', 'type' => '', 'location' => '',
               'duties' => array( 'Developed and maintained web applications and internal systems.', 'Worked with UI/UX and frontend technologies (HTML, CSS, JavaScript).', 'Collaborated with cross-functional teams on technical projects.' ),
               'tools' => array( 'HTML', 'CSS', 'JavaScript' ), 'projects' => array() ),
        array( 'role' => 'Project / Organization Experience', 'org' => 'University / Student Organization',
               'start' => '2022', 'end' => '2024', 'type' => '', 'location' => '',
               'duties' => array( 'Led and participated in various projects and initiatives.', 'Organized events, workshops, and community activities.', 'Collaborated with teams and stakeholders to achieve goals.' ),
               'tools' => array(), 'projects' => array() ),
        array( 'role' => 'UI/UX Designer Intern', 'org' => 'Design Studio Hub',
               'start' => '2021', 'end' => '2022', 'type' => 'Internship', 'location' => '',
               'duties' => array( 'Assisted in conducting user research and persona mapping.', 'Created wireframes, user flows, and interactive prototypes in Figma.', 'Participated in client design reviews and design system maintenance.' ),
               'tools' => array( 'Figma' ), 'projects' => array() ),
        array( 'role' => 'Freelance Web Developer', 'org' => 'Self-Employed',
               'start' => '2020', 'end' => '2021', 'type' => 'Freelance', 'location' => '',
               'duties' => array( 'Built custom WordPress websites and landing pages for small businesses.', 'Optimized site performance, responsiveness, and basic on-page SEO.', 'Managed direct client communications and project requirements.' ),
               'tools' => array( 'WordPress' ), 'projects' => array() ),
        array( 'role' => 'Open Source Contributor', 'org' => 'Community Projects',
               'start' => '2019', 'end' => '2020', 'type' => '', 'location' => '',
               'duties' => array( 'Contributed bug fixes and documentation to frontend repositories.', 'Collaborated globally via GitHub issues and pull requests.', 'Engaged with developer communities to improve software accessibility.' ),
               'tools' => array( 'GitHub' ), 'projects' => array() ),
    );
}

// About page "toolbox" tapes. `icon` is a Simple Icons slug in assets/img/tools/ (simple-icons 16.34.0,
// CC0), or a neutral glyph for tools Simple Icons doesn't carry: '' = code brackets (VS Code, logo removed
// at Microsoft's request), 'glyph:chat' (ChatGPT, OpenAI logos removed), 'glyph:orbit' (Antigravity, not listed).
// `hex` is the brand colour a chip fills with on hover. `tape`: 'ink' (languages/frameworks) or 'paper' (tools/apps).
function seiyann_tools() {
    return array(
        array( 'name' => 'HTML',          'icon' => 'html5',       'hex' => '#E34F26', 'tape' => 'ink' ),
        array( 'name' => 'CSS',           'icon' => 'css',         'hex' => '#663399', 'tape' => 'ink' ),
        array( 'name' => 'JavaScript',    'icon' => 'javascript',  'hex' => '#F7DF1E', 'tape' => 'ink' ),
        array( 'name' => 'Tailwind CSS',  'icon' => 'tailwindcss', 'hex' => '#06B6D4', 'tape' => 'ink' ),
        array( 'name' => 'React',         'icon' => 'react',       'hex' => '#61DAFB', 'tape' => 'ink' ),
        array( 'name' => 'PHP',           'icon' => 'php',         'hex' => '#777BB4', 'tape' => 'ink' ),
        array( 'name' => 'Laravel',       'icon' => 'laravel',     'hex' => '#FF2D20', 'tape' => 'ink' ),
        array( 'name' => 'Python',        'icon' => 'python',      'hex' => '#3776AB', 'tape' => 'ink' ),
        array( 'name' => 'WordPress',     'icon' => 'wordpress',   'hex' => '#21759B', 'tape' => 'ink' ),
        array( 'name' => 'SQL',           'icon' => 'mysql',       'hex' => '#4479A1', 'tape' => 'ink' ),
        array( 'name' => 'Supabase',      'icon' => 'supabase',    'hex' => '#3FCF8E', 'tape' => 'ink' ),
        array( 'name' => 'VS Code',       'icon' => '',            'hex' => '#007ACC', 'tape' => 'paper' ),
        array( 'name' => 'Cursor',        'icon' => 'cursor',      'hex' => '#000000', 'tape' => 'paper' ),
        array( 'name' => 'Git',           'icon' => 'git',         'hex' => '#F03C2E', 'tape' => 'paper' ),
        array( 'name' => 'GitHub',        'icon' => 'github',      'hex' => '#181717', 'tape' => 'paper' ),
        array( 'name' => 'Figma',         'icon' => 'figma',       'hex' => '#F24E1E', 'tape' => 'paper' ),
        array( 'name' => 'GSAP',          'icon' => 'gsap',        'hex' => '#0AE448', 'tape' => 'paper' ),
        array( 'name' => 'Claude',        'icon' => 'claude',       'hex' => '#D97757', 'tape' => 'paper' ),
        array( 'name' => 'ChatGPT',       'icon' => 'glyph:chat',   'hex' => '#10A37F', 'tape' => 'paper' ),
        array( 'name' => 'Gemini',        'icon' => 'googlegemini', 'hex' => '#8E75B2', 'tape' => 'paper' ),
        array( 'name' => 'Antigravity',   'icon' => 'glyph:orbit',  'hex' => '#4285F4', 'tape' => 'paper' ),
    );
}

// Inline SVG for a tool (fills with currentColor so the chip controls its colour).
function seiyann_tool_icon( $slug ) {
    $glyphs = array(
        'glyph:chat'  => '<path d="M4 5h16v11H9l-5 4z"/><path d="M8.5 10.5h.01M12 10.5h.01M15.5 10.5h.01"/>',
        'glyph:orbit' => '<circle cx="12" cy="12" r="3"/><ellipse cx="12" cy="12" rx="10" ry="4.5" transform="rotate(-30 12 12)"/><path d="M19.5 4.5h.01"/>',
        ''            => '<path d="M8 7l-5 5 5 5M16 7l5 5-5 5M13.5 4l-3 16"/>',
    );
    $file = get_template_directory() . '/assets/img/tools/' . $slug . '.svg';
    if ( isset( $glyphs[ $slug ] ) || ! file_exists( $file ) ) {
        $paths = isset( $glyphs[ $slug ] ) ? $glyphs[ $slug ] : $glyphs[''];
        return '<svg class="tool-icon" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">' . $paths . '</svg>';
    }
    $svg = file_get_contents( $file );
    $svg = preg_replace( '#<title>.*?</title>#s', '', $svg );
    return str_replace( '<svg ', '<svg class="tool-icon" aria-hidden="true" fill="currentColor" ', $svg );
}

// Readable text colour (#0a0a0a or #ffffff) on top of a hex background.
function seiyann_on_color( $hex ) {
    $hex = ltrim( $hex, '#' );
    list( $r, $g, $b ) = array_map( 'hexdec', str_split( $hex, 2 ) );
    $luminance = ( 0.299 * $r + 0.587 * $g + 0.114 * $b ) / 255;
    return $luminance > 0.6 ? '#0a0a0a' : '#ffffff';
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

// Contact details used across the site (Contact page "direct lines" card, form recipient).
function seiyann_contact() {
    return array(
        'email'     => 'kurtcyrsfa@gmail.com',
        'phone'     => '0994 202 5107',   // shown on the page
        'phone_tel' => '+639942025107',   // dialled (international format works from abroad)
        'location'  => 'Lucena City, Philippines',
        'timezone'  => 'Asia/Manila',     // for the live local-time clock
        'socials'   => array(
            array( 'code' => 'in', 'name' => 'LinkedIn',  'handle' => 'kurt-atoat',    'url' => 'https://www.linkedin.com/in/kurt-atoat/' ),
            array( 'code' => 'gh', 'name' => 'GitHub',    'handle' => 'seiyanndev',    'url' => 'https://github.com/seiyanndev' ),
            array( 'code' => 'ig', 'name' => 'Instagram', 'handle' => 'kurtcyrs',      'url' => 'https://www.instagram.com/kurtcyrs/' ),
            array( 'code' => 'fb', 'name' => 'Facebook',  'handle' => 'kurt.atoat.90', 'url' => 'https://www.facebook.com/kurt.atoat.90' ),
        ),
    );
}

// Handle portfolio contact form submission: emails the form data to the address in seiyann_contact(),
// then redirects back to the form with ?contact_sent=1 or ?contact_error=1|invalid (shown as a
// RECEIVED / RETURNED stamp on the page).
function handle_portfolio_contact_form() {
    if ( ! isset( $_POST['portfolio_contact_nonce'] ) || ! wp_verify_nonce( $_POST['portfolio_contact_nonce'], 'portfolio_contact_verify' ) ) {
        wp_die( 'Security check failed.' );
    }

    $redirect_url = wp_get_referer();
    if ( ! $redirect_url ) {
        $redirect_url = home_url( '/contact/' );
    }
    // Drop the result of any earlier submission so only this one's shows.
    $redirect_url = remove_query_arg( array( 'contact_sent', 'contact_error' ), strtok( $redirect_url, '#' ) );

    // Honeypot: a hidden field people never see. Bots that fill it get a fake success, and no email.
    if ( ! empty( $_POST['contact_website'] ) ) {
        wp_safe_redirect( add_query_arg( 'contact_sent', '1', $redirect_url ) . '#request' );
        exit;
    }

    $name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
    $email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
    $subject = isset( $_POST['contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) ) : '';
    $message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

    // Required fields (also enforced in the browser; this covers requests that skip it).
    if ( '' === $name || ! is_email( $email ) || '' === $message ) {
        wp_safe_redirect( add_query_arg( 'contact_error', 'invalid', $redirect_url ) . '#request' );
        exit;
    }

    $contact = seiyann_contact();
    $to = $contact['email'];
    $email_subject = 'New Portfolio Message: ' . ( !empty($subject) ? $subject : 'General Inquiry' );

    $body  = "You have received a new message from your portfolio contact form:\n\n";
    $body .= "Name: {$name}\n";
    $body .= "Email: {$email}\n";
    $body .= "Subject: {$subject}\n\n";
    $body .= "Message:\n{$message}\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $name . ' <' . $email . '>');

    $sent = wp_mail( $to, $email_subject, $body, $headers );

    if ( $sent ) {
        $redirect_url = add_query_arg( 'contact_sent', '1', $redirect_url );
    } else {
        $redirect_url = add_query_arg( 'contact_error', '1', $redirect_url );
    }

    wp_safe_redirect( $redirect_url . '#request' );
    exit;
}
add_action( 'admin_post_nopriv_submit_portfolio_contact', 'handle_portfolio_contact_form' );
add_action( 'admin_post_submit_portfolio_contact', 'handle_portfolio_contact_form' );