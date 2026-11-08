<?php
/**
 * The template for displaying archive pages
 *
 * @package Ansh_Thrifts
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main">
    <div class="thrift-container section-py">
        <?php if (have_posts()) : ?>
            <header class="page-header text-center mb-10">
                <h1 class="page-title"><?php the_archive_title(); ?></h1>
                <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
            </header>

            <div class="posts-grid">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('editorial-post-card'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="post-card-thumb">
                                <?php the_post_thumbnail('thrift-card'); ?>
                            </a>
                        <?php endif; ?>
                        <div class="post-card-content">
                            <span class="post-card-date"><?php echo get_the_date(); ?></span>
                            <h2 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="post-card-excerpt"><?php the_excerpt(); ?></div>
                        </div>
                    </article>
                    <?php
                endwhile;
                ?>
            </div>

            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <div class="empty-state-notice text-center">
                <h2><?php esc_html_e('No items found', 'ansh-thrifts'); ?></h2>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();

