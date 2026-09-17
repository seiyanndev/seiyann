<?php
function seiyann_enqueue_styles() {
    // Tailwind CSS
    wp_enqueue_script( 'tailwind', 'https://cdn.tailwindcss.com', array(), null, false );

    // Alpine.js Core CDN (loaded in footer with defer)
    wp_enqueue_script( 'alpine', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array(), '3.x.x', true );
}
add_action('wp_enqueue_scripts', 'seiyann_enqueue_styles', 999);

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