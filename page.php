<?php
/**
 * Template for displaying all static pages (including WooCommerce Cart, Checkout & Account)
 *
 * @package Ansh_Thrifts
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main">
    <div class="thrift-container section-py">
        <?php
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('static-page-article'); ?>>
                <?php if (!is_front_page() && !is_cart() && !is_checkout() && !is_account_page()) : ?>
                    <header class="page-header text-center mb-10">
                        <h1 class="page-title"><?php the_title(); ?></h1>
                    </header>
                <?php endif; ?>

                <div class="page-entry-content">
                    <?php
                    the_content();

                    wp_link_pages([
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'ansh-thrifts'),
                        'after'  => '</div>',
                    ]);
                    ?>
                </div>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();

