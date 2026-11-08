<?php
/**
 * The template for displaying search results
 *
 * @package Ansh_Thrifts
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main">
    <div class="thrift-container section-py">
        <header class="page-header text-center mb-10">
            <span class="section-badge"><?php esc_html_e('SEARCH RESULTS', 'ansh-thrifts'); ?></span>
            <h1 class="page-title">
                <?php printf(esc_html__('Search: &ldquo;%s&rdquo;', 'ansh-thrifts'), get_search_query()); ?>
            </h1>
        </header>

        <?php if (have_posts()) : ?>
            <div class="products-editorial-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    if ('product' === get_post_type()) {
                        get_template_part('template-parts/product-card');
                    } else {
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('editorial-post-card'); ?>>
                            <h2 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="post-card-excerpt"><?php the_excerpt(); ?></div>
                        </article>
                        <?php
                    }
                endwhile;
                ?>
            </div>

            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <div class="empty-state-notice text-center">
                <h2><?php esc_html_e('No archived pieces found matching your search.', 'ansh-thrifts'); ?></h2>
                <p><?php esc_html_e('Try searching for vintage brands like Nike, Carhartt, Levi’s or keywords like jackets, cargos, or tees.', 'ansh-thrifts'); ?></p>
                <div class="mt-6">
                    <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>" class="thrift-btn thrift-btn--dark">
                        <?php esc_html_e('Explore All Collections', 'ansh-thrifts'); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();

