<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package Ansh_Thrifts
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main error-404-main">
    <div class="thrift-container section-py text-center">
        <span class="section-badge"><?php esc_html_e('ARCHIVE NOT FOUND', 'ansh-thrifts'); ?></span>
        <h1 class="page-title-404">404</h1>
        <h2 class="error-heading"><?php esc_html_e('This vintage piece has moved on.', 'ansh-thrifts'); ?></h2>
        <p class="error-text">
            <?php esc_html_e('The page or thrift archive you were looking for cannot be located. It may have already sold out or been removed.', 'ansh-thrifts'); ?>
        </p>
        <div class="mt-8">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="thrift-btn thrift-btn--dark">
                <?php esc_html_e('Return to Homepage', 'ansh-thrifts'); ?>
            </a>
            <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>" class="thrift-btn thrift-btn--outline ml-4">
                <?php esc_html_e('Explore All Drops', 'ansh-thrifts'); ?>
            </a>
        </div>
    </div>
</main>

<?php
get_footer();

