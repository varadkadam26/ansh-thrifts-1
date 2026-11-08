<?php
/**
 * Footer Template
 *
 * @package Ansh_Thrifts
 * @version 1.0.0
 */

defined('ABSPATH') || exit;
?>

    <footer id="colophon" class="site-footer">
        <?php if (get_theme_mod('ansh_footer_show_newsletter', true)) : ?>
        <!-- Newsletter Drop Section -->
        <div class="footer-newsletter">
            <div class="thrift-container">
                <div class="newsletter-card">
                    <div class="newsletter-content">
                        <span class="newsletter-badge"><?php esc_html_e('VINTAGE ARCHIVE DROPS', 'ansh-thrifts'); ?></span>
                        <h3 class="newsletter-heading"><?php esc_html_e('Never miss a Sunday drop.', 'ansh-thrifts'); ?></h3>
                        <p class="newsletter-sub"><?php esc_html_e('Most thrift pieces are 1-of-1 and never restocked. Join 8,000+ fashion collectors for private early access 15 minutes before public drop.', 'ansh-thrifts'); ?></p>
                    </div>
                    <form class="newsletter-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing to Ansh Thrifts drop alerts!');">
                        <div class="newsletter-input-group">
                            <input type="email" placeholder="<?php esc_attr_e('Enter your email address...', 'ansh-thrifts'); ?>" required class="newsletter-input">
                            <button type="submit" class="thrift-btn thrift-btn--dark">
                                <?php esc_html_e('Join Early Access', 'ansh-thrifts'); ?>
                            </button>
                        </div>
                        <span class="newsletter-disclaimer"><?php esc_html_e('We respect your inbox. Unsubscribe anytime.', 'ansh-thrifts'); ?></span>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Main Footer Links -->
        <div class="footer-main">
            <div class="thrift-container">
                <div class="footer-grid">
                    <!-- Column 1: Brand Ethos -->
                    <div class="footer-col brand-col">
                        <h4 class="footer-logo"><?php bloginfo('name'); ?></h4>
                        <p class="brand-ethos">
                            <?php esc_html_e('Curating rare streetwear, timeless outerwear, and premium vintage archives since 2021. Championing circular fashion by breathing new life into extraordinary garments.', 'ansh-thrifts'); ?>
                        </p>
                        <div class="footer-socials">
                            <?php 
                            $insta = get_theme_mod('ansh_social_instagram', 'https://instagram.com');
                            $tiktok = get_theme_mod('ansh_social_tiktok', 'https://tiktok.com');
                            ?>
                            <?php if ($insta): ?>
                                <a href="<?php echo esc_url($insta); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                </a>
                            <?php endif; ?>
                            <?php if ($tiktok): ?>
                                <a href="<?php echo esc_url($tiktok); ?>" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path></svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Column 2: Tops Categories -->
                    <div class="footer-col">
                        <h5 class="footer-heading"><?php esc_html_e('Tops & Layers', 'ansh-thrifts'); ?></h5>
                        <ul class="footer-links">
                            <li><a href="<?php echo esc_url(home_url('/product-category/tops/')); ?>"><?php esc_html_e('All Tops', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/tops/jackets/')); ?>"><?php esc_html_e('Jackets & Outerwear', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/tops/hoodies/')); ?>"><?php esc_html_e('Hoodies & Sweats', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/tops/t-shirts/')); ?>"><?php esc_html_e('Graphic & Vintage Tees', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/tops/shirts/')); ?>"><?php esc_html_e('Oversized Shirts', 'ansh-thrifts'); ?></a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Bottoms Categories -->
                    <div class="footer-col">
                        <h5 class="footer-heading"><?php esc_html_e('Bottoms & Denim', 'ansh-thrifts'); ?></h5>
                        <ul class="footer-links">
                            <li><a href="<?php echo esc_url(home_url('/product-category/bottoms/')); ?>"><?php esc_html_e('All Bottoms', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/bottoms/jeans/')); ?>"><?php esc_html_e('Vintage Levi’s & Denim', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/bottoms/cargo-pants/')); ?>"><?php esc_html_e('Military & Tactical Cargos', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/bottoms/trousers/')); ?>"><?php esc_html_e('Pleated Trousers', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/bottoms/shorts/')); ?>"><?php esc_html_e('Shorts & Skirts', 'ansh-thrifts'); ?></a></li>
                        </ul>
                    </div>

                    <!-- Column 4: Client Services -->
                    <div class="footer-col">
                        <h5 class="footer-heading"><?php esc_html_e('Client Services', 'ansh-thrifts'); ?></h5>
                        <ul class="footer-links">
                            <li><a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account')); ?>"><?php esc_html_e('Track Your Order', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/shipping-returns/')); ?>"><?php esc_html_e('Shipping & Returns', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/condition-guide/')); ?>"><?php esc_html_e('Condition Grading Standard', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('About Our Sourcing', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>"><?php esc_html_e('Contact Showroom', 'ansh-thrifts'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright Bar -->
        <div class="footer-bottom">
            <div class="thrift-container footer-bottom-inner">
                <p class="copyright-text">
                    &copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved. Powered by WooCommerce.', 'ansh-thrifts'); ?>
                </p>
                <div class="policy-links">
                    <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>"><?php esc_html_e('Privacy Policy', 'ansh-thrifts'); ?></a>
                    <span class="sep">&bull;</span>
                    <a href="<?php echo esc_url(home_url('/terms-and-conditions/')); ?>"><?php esc_html_e('Terms of Service', 'ansh-thrifts'); ?></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to top button -->
    <button type="button" id="back-to-top" class="back-to-top" aria-label="<?php esc_attr_e('Back to top', 'ansh-thrifts'); ?>">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="18 15 12 9 6 15"></polyline>
        </svg>
    </button>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>

