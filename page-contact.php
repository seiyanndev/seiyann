<?php
/**
 * Template Name: Contact Page
 * The template for displaying the Contact page
 *
 * @package Seiyann
 */

get_header(); 
?>

<!-- Contact Page Container (Dedicated Page Flow) -->
<main class="flex-1 flex flex-col justify-between px-12 md:px-24 lg:px-36 pt-12 pb-6 ml-24 overflow-hidden">
    <!-- Top Header & Main Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 w-full animate-page-load pt-4 items-start">
        
        <!-- Left Column: Heading and Bio -->
        <div class="lg:col-span-12">
            <div class="flex items-center space-x-3 text-xs tracking-widest text-gray-400 uppercase font-medium mb-3" style="font-family: 'Montserrat', sans-serif;">
                <span class="w-6 h-[1px] bg-gray-300"></span>
                <span>Contact</span>
            </div>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-gray-900 leading-[1.1] mb-6 whitespace-nowrap">
                Let’s work together.
            </h1>
            <p class="text-gray-500 text-sm max-w-xl leading-relaxed font-normal">
                Have a project in mind, a question, or just want to say hello? I'd love to hear from you. Feel free to reach out using the form or through my socials.
            </p>
        </div>

    </div>

    <!-- Enclosing Rectangle Box with Transparent Background -->
    <div class="w-full bg-transparent p-0 my-8 animate-page-load load-delay-1">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <!-- Left Side inside Box: Contact Info -->
            <div class="lg:col-span-4 space-y-6 pt-2">
                <!-- Email -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 rounded-xl bg-gray-100 flex items-center justify-center text-gray-800 flex-shrink-0 border border-gray-200/60 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold" style="font-family: 'Montserrat', sans-serif;">Email</p>
                        <a href="mailto:kurtcyrsfa@gmail.com" class="text-xs font-semibold text-gray-900 hover:text-black transition-colors">kurtcyrsfa@gmail.com</a>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 rounded-xl bg-gray-100 flex items-center justify-center text-gray-800 flex-shrink-0 border border-gray-200/60 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold" style="font-family: 'Montserrat', sans-serif;">Phone</p>
                        <a href="tel:+639942025107" class="text-xs font-semibold text-gray-900 hover:text-black transition-colors">+63 9942025107</a>
                    </div>
                </div>

                <!-- Location -->
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 rounded-xl bg-gray-100 flex items-center justify-center text-gray-800 flex-shrink-0 border border-gray-200/60 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold" style="font-family: 'Montserrat', sans-serif;">Location</p>
                        <p class="text-xs font-semibold text-gray-900">Lucena, Philippines</p>
                    </div>
                </div>
            </div>

            <!-- Middle Side inside Box: Sleek Minimalist Contact Form -->
            <div class="lg:col-span-5 flex flex-col justify-center">
                <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST" class="space-y-6">
                    <input type="hidden" name="action" value="submit_portfolio_contact">
                    <?php wp_nonce_field('portfolio_contact_verify', 'portfolio_contact_nonce'); ?>

                    <!-- Name & Email Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="relative">
                            <label class="block text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-2" style="font-family: 'Montserrat', sans-serif;">Name *</label>
                            <input type="text" name="contact_name" required placeholder="Your name" class="w-full bg-transparent border-b border-gray-300 pb-2 text-xs text-gray-900 focus:outline-none focus:border-black transition-colors placeholder:text-gray-300">
                        </div>
                        <div class="relative">
                            <label class="block text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-2" style="font-family: 'Montserrat', sans-serif;">Email *</label>
                            <input type="email" name="contact_email" required placeholder="your@email.com" class="w-full bg-transparent border-b border-gray-300 pb-2 text-xs text-gray-900 focus:outline-none focus:border-black transition-colors placeholder:text-gray-300">
                        </div>
                    </div>

                    <!-- Subject Dropdown -->
                    <div class="relative">
                        <label class="block text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-2" style="font-family: 'Montserrat', sans-serif;">Subject</label>
                        <div class="relative">
                            <select name="contact_subject" class="w-full bg-transparent border-b border-gray-300 pb-2 text-xs text-gray-900 focus:outline-none focus:border-black transition-colors appearance-none cursor-pointer">
                                <option value="" disabled selected>Select a subject</option>
                                <option value="New Project Inquiry">New Project Inquiry</option>
                                <option value="Collaboration">Collaboration</option>
                                <option value="Friendly Chat">Friendly Chat</option>
                            </select>
                            <div class="absolute right-0 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Message Textarea -->
                    <div class="relative">
                        <label class="block text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-2" style="font-family: 'Montserrat', sans-serif;">Message *</label>
                        <textarea name="contact_message" rows="3" required placeholder="Type your message here..." class="w-full bg-transparent border-b border-gray-300 pb-2 text-xs text-gray-900 focus:outline-none focus:border-black transition-colors placeholder:text-gray-300 resize-none"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" class="inline-flex items-center space-x-3 py-3 px-6 rounded-full bg-black hover:bg-gray-800 text-white text-xs font-bold tracking-widest uppercase transition-all duration-300 shadow-sm group cursor-pointer" style="font-family: 'Montserrat', sans-serif;">
                            <span class="w-6 h-6 rounded-full bg-white/10 flex items-center justify-center group-hover:-translate-x-0.5 transition-transform">&rarr;</span>
                            <span>Send Message</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Side inside Box: Get In Touch & Socials with Vertical Separator Border -->
            <div class="lg:col-span-3 flex flex-col justify-between space-y-8 pl-0 lg:pl-8 border-l border-gray-200/80">
                <!-- Top Tag & Mini CTA -->
                <div>
                    <div class="flex items-center space-x-3 text-[10px] tracking-widest text-gray-400 uppercase font-semibold mb-2" style="font-family: 'Montserrat', sans-serif;">
                        <span class="w-6 h-[1px] bg-gray-300"></span>
                        <span>Get in Touch</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 leading-tight">Let's create something great.</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">Whether it's a new project, a collaboration, or just a friendly chat — I'm all ears.</p>
                </div>

                <!-- Social Links List with Image Icons -->
                <div>
                    <p class="text-[10px] tracking-widest uppercase text-gray-400 font-semibold mb-4" style="font-family: 'Montserrat', sans-serif;">Follow Me</p>
                    <div class="space-y-3 text-xs font-semibold" style="font-family: 'Montserrat', sans-serif;">
                        <a href="https://linkedin.com" target="_blank" rel="noopener" class="flex items-center space-x-3 text-gray-800 hover:text-black transition-colors group">
                            <span class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200/60 shadow-sm flex-shrink-0">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/Linkedin.png" alt="LinkedIn" class="w-full h-full object-cover">
                            </span>
                            <span>LinkedIn</span>
                        </a>
                        <a href="https://github.com" target="_blank" rel="noopener" class="flex items-center space-x-3 text-gray-800 hover:text-black transition-colors group">
                            <span class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200/60 shadow-sm flex-shrink-0">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/Github.png" alt="GitHub" class="w-full h-full object-cover">
                            </span>
                            <span>GitHub</span>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener" class="flex items-center space-x-3 text-gray-800 hover:text-black transition-colors group">
                            <span class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200/60 shadow-sm flex-shrink-0">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/Instagram.png" alt="Instagram" class="w-full h-full object-cover">
                            </span>
                            <span>Instagram</span>
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener" class="flex items-center space-x-3 text-gray-800 hover:text-black transition-colors group">
                            <span class="w-6 h-6 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden border border-gray-200/60 shadow-sm flex-shrink-0">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/Facebook.png" alt="Facebook" class="w-full h-full object-cover">
                            </span>
                            <span>Facebook</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Bottom Footer Tagline Bar -->
    <div class="flex justify-between items-center w-full pt-4 mt-2 border-t border-gray-200/60 text-xs tracking-widest text-gray-400 uppercase font-medium animate-page-load load-delay-2" style="font-family: 'Montserrat', sans-serif;">
        <span>Good ideas. Better together.</span>
        <span>K A</span>
    </div>
</main>

<style>
    @keyframes pageLoadEntry {
        from {
            opacity: 0;
            transform: translateY(16px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-page-load {
        opacity: 0;
        animation: pageLoadEntry 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .load-delay-1 { animation-delay: 0.1s; }
    .load-delay-2 { animation-delay: 0.2s; }
</style>

<?php 
get_footer();