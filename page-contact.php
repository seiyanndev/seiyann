<?php
/**
 * Template Name: Contact Page
 *
 * "The Dossier", File No. 003: Request Form. A "direct lines" card (email, phone, local time,
 * channels) beside a printed request form with a rubber-stamp submit button.
 *
 * The form posts to admin-post.php → handle_portfolio_contact_form() (functions.php), which emails it
 * and redirects back with ?contact_sent=1 or ?contact_error=1|invalid, shown here as a RECEIVED /
 * RETURNED stamp. Details: seiyann_contact(). Styles: assets/css/contact.css. Motion: assets/js/contact.js.
 *
 * @package Seiyann
 */

get_header();

$contact  = seiyann_contact();
$subjects = array( 'New project', 'Full-time role', 'Collaboration', 'Just saying hi' );

// Result of a submission (set by the handler's redirect).
$sent  = isset( $_GET['contact_sent'] );
$error = isset( $_GET['contact_error'] ) ? sanitize_key( wp_unslash( $_GET['contact_error'] ) ) : '';
?>

<main class="contact flex-1 px-6 sm:px-12 md:px-24 lg:px-36 pt-12 pb-24 md:ml-24">

    <!-- ============ Header ============ -->
    <header class="ct-hero" id="ct-hero">
        <div class="ct-eyebrow">
            <span class="ct-eyebrow-line"></span>
            <span>Contact</span><span class="ct-eyebrow-sep">/</span><span>File No. 003</span>
        </div>
        <h1 class="ct-title">
            <span class="ct-line"><span>Open a file.</span></span>
            <span class="ct-line is-muted"><span>Let's work together.</span></span>
        </h1>
        <p class="ct-lede">Have a project in mind, a question, or just want to say hello? Fill in the request below, or reach me directly.</p>
    </header>

    <div class="ct-body" id="ct-body">

        <!-- ============ Direct lines (ID-card style) ============ -->
        <aside class="ct-card" aria-label="Direct contact details">
            <span class="ct-card-label">Direct lines</span>

            <dl class="ct-fields">
                <div>
                    <dt>Email</dt>
                    <dd class="ct-email">
                        <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a>
                        <button type="button" class="ct-copy" data-copy="<?php echo esc_attr( $contact['email'] ); ?>" aria-label="Copy email address">
                            <span class="ct-copy-label">Copy</span>
                        </button>
                    </dd>
                </div>
                <div>
                    <dt>Phone</dt>
                    <dd><a href="tel:<?php echo esc_attr( $contact['phone_tel'] ); ?>"><?php echo esc_html( $contact['phone'] ); ?></a></dd>
                </div>
                <div>
                    <dt>Based in</dt>
                    <dd><?php echo esc_html( $contact['location'] ); ?></dd>
                </div>
                <div>
                    <dt>Local time</dt>
                    <dd><span class="ct-clock" data-tz="<?php echo esc_attr( $contact['timezone'] ); ?>">&mdash;</span> <span class="ct-tz">PHT</span></dd>
                </div>
                <div>
                    <dt>Status</dt>
                    <dd><b class="ct-status-dot" aria-hidden="true"></b>Open to work &mdash; full-time or freelance</dd>
                </div>
            </dl>

            <span class="ct-card-label ct-card-label--channels">Channels</span>
            <ul class="ct-channels">
                <?php foreach ( $contact['socials'] as $social ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank" rel="noopener">
                            <span class="ct-channel-code" aria-hidden="true"><?php echo esc_html( $social['code'] ); ?></span>
                            <span class="ct-channel-name"><?php echo esc_html( $social['name'] ); ?></span>
                            <span class="ct-channel-handle">@<?php echo esc_html( $social['handle'] ); ?></span>
                            <span class="ct-channel-arrow" aria-hidden="true">&nearr;</span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="ct-barcode" aria-hidden="true">
                <span class="ct-barcode-bars"></span>
                <span class="ct-barcode-text">KA &middot; 003 &middot; LUC-PH</span>
            </div>
        </aside>

        <!-- ============ Request form ============ -->
        <section class="req" id="request" aria-labelledby="req-title">
            <span class="req-tape" aria-hidden="true">Form 003 &mdash; Request</span>

            <header class="req-head">
                <h2 id="req-title" class="req-title">Request form</h2>
                <span class="req-form-no">Form 003</span>
            </header>

            <?php if ( $sent ) : ?>
                <!-- Success: the request is "on file" -->
                <div class="req-result is-received" role="status">
                    <span class="req-result-stamp">Received</span>
                    <p class="req-result-title">Your request is on file.</p>
                    <p class="req-result-text">Thanks for reaching out &mdash; I'll get back to you by email soon.</p>
                    <a class="req-result-link" href="<?php echo esc_url( remove_query_arg( array( 'contact_sent', 'contact_error' ) ) ); ?>#request">File another request &rarr;</a>
                </div>
            <?php else : ?>

                <?php if ( $error ) : ?>
                    <!-- Error: the request was "returned"; the form stays below to try again -->
                    <div class="req-result is-returned" role="alert">
                        <span class="req-result-stamp">Returned</span>
                        <p class="req-result-title"><?php echo 'invalid' === $error ? 'Some fields need another look.' : "Your request couldn't be sent."; ?></p>
                        <p class="req-result-text">
                            <?php if ( 'invalid' === $error ) : ?>
                                Please add your name, a valid email and a message, then file it again.
                            <?php else : ?>
                                Please try again, or email me directly at <a href="mailto:<?php echo esc_attr( $contact['email'] ); ?>"><?php echo esc_html( $contact['email'] ); ?></a>.
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endif; ?>

                <form class="req-form" id="req-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="POST">
                    <input type="hidden" name="action" value="submit_portfolio_contact">
                    <?php wp_nonce_field( 'portfolio_contact_verify', 'portfolio_contact_nonce' ); ?>

                    <!-- Honeypot: hidden from people; bots that fill it are ignored by the handler -->
                    <div class="req-hp" aria-hidden="true">
                        <label>Website <input type="text" name="contact_website" tabindex="-1" autocomplete="off"></label>
                    </div>

                    <div class="req-row">
                        <label class="req-label" for="contact_name"><span class="req-num">01</span>Name <i>*</i></label>
                        <input class="req-input" type="text" id="contact_name" name="contact_name" required autocomplete="name" placeholder="Your name">
                    </div>

                    <div class="req-row">
                        <label class="req-label" for="contact_email"><span class="req-num">02</span>Email <i>*</i></label>
                        <input class="req-input" type="email" id="contact_email" name="contact_email" required autocomplete="email" placeholder="you@email.com">
                    </div>

                    <fieldset class="req-row req-subjects">
                        <legend class="req-label"><span class="req-num">03</span>Regarding</legend>
                        <div class="req-options">
                            <?php foreach ( $subjects as $i => $subject ) : ?>
                                <label class="req-option">
                                    <input type="radio" name="contact_subject" value="<?php echo esc_attr( $subject ); ?>"<?php checked( 0, $i ); ?>>
                                    <span class="req-box" aria-hidden="true"></span>
                                    <span><?php echo esc_html( $subject ); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </fieldset>

                    <div class="req-row req-row--message">
                        <label class="req-label" for="contact_message"><span class="req-num">04</span>Message <i>*</i></label>
                        <textarea class="req-input req-message" id="contact_message" name="contact_message" rows="5" required placeholder="Tell me about your project, role or idea..."></textarea>
                    </div>

                    <div class="req-submit-row">
                        <span class="req-note">* Required. Your details are only used to reply to you.</span>
                        <button type="submit" class="req-stamp" id="req-submit">
                            <span>File request</span>
                        </button>
                    </div>
                </form>
            <?php endif; ?>
        </section>
    </div>

    <!-- Sign-off, printed on a strip of tape. Full-bleed: negative margins cancel <main>'s padding and nav margin. -->
    <p class="ct-signoff -mx-6 sm:-mx-12 md:-mr-24 md:-ml-48 lg:-mr-36 lg:-ml-60" aria-hidden="true"><span>Good ideas. Better together. &mdash; Good ideas. Better together. &mdash; Good ideas. Better together. &mdash; Good ideas. Better together.</span></p>
</main>

<?php
get_footer();
