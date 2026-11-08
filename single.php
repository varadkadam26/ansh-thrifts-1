<?php
/**
 * Template for displaying all single blog posts
 *
 * @package Ansh_Thrifts
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main">
    <div class="thrift-container section-py">
        <div class="single-post-wrapper">
            <?php
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-editorial-article'); ?>>
                    <header class="single-post-header text-center">
                        <span class="post-meta-date"><?php echo get_the_date(); ?></span>
                        <h1 class="single-post-title"><?php the_title(); ?></h1>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="single-post-featured-image">
                            <?php the_post_thumbnail('thrift-hero'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="single-post-content">
                        <?php
                        the_content();
                        ?>
                    </div>
                </article>
                <?php
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();

