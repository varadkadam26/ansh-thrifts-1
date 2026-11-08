<?php
/**
 * The template for displaying the Homepage
 * Supports both WordPress Gutenberg Visual Page Builder (Drag & Drop patterns)
 * and dynamic fallback sections.
 *
 * @package Ansh_Thrifts
 * @version 1.1.0
 */

defined('ABSPATH') || exit;

get_header();

// Check if current front page has Gutenberg content created by the store owner
$has_custom_page_content = false;
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $content = trim(get_the_content());
        if (!empty($content)) {
            $has_custom_page_content = true;
        }
    }
}
?>

<main id="primary" class="site-main front-page-main">

<?php 
if ($has_custom_page_content) : 
    // RENDER VISUAL GUTENBERG BLOCKS & PATTERNS (Allows visual drag-and-drop, editing & rearranging)
    the_content();
else :
    // DEFAULT VISUAL SECTIONS (Active out-of-the-box before page editor customization)
    $hero_badge = get_theme_mod('ansh_hero_badge', 'AUTUMN / WINTER 2026 ARCHIVE');
    $hero_title = get_theme_mod('ansh_hero_title', 'Curated Vintage & One-of-a-Kind Fashion');
    $hero_desc  = get_theme_mod('ansh_hero_desc', 'Handpicked streetwear, rare designer archives, premium denim, and timeless thrift silhouettes. Each garment carries a unique past.');
    $hero_btn1  = get_theme_mod('ansh_hero_btn1_text', 'Explore Tops');
    $hero_url1  = get_theme_mod('ansh_hero_btn1_url', home_url('/product-category/tops/'));
    $hero_btn2  = get_theme_mod('ansh_hero_btn2_text', 'Explore Bottoms');
    $hero_url2  = get_theme_mod('ansh_hero_btn2_url', home_url('/product-category/bottoms/'));
    $hero_bg    = get_theme_mod('ansh_hero_bg_image', '');
?>

    <!-- 1. EDITORIAL HERO BANNER -->
    <section class="editorial-hero <?php echo !empty($hero_bg) ? 'has-bg-image' : ''; ?>" style="<?php echo !empty($hero_bg) ? 'background-image: url(' . esc_url($hero_bg) . ');' : ''; ?>">
        <div class="thrift-container hero-inner">
            <div class="hero-content">
                <?php if (!empty($hero_badge)) : ?>
                    <span class="hero-badge reveal-fade"><?php echo esc_html($hero_badge); ?></span>
                <?php endif; ?>

                <h1 class="hero-title reveal-fade"><?php echo esc_html($hero_title); ?></h1>

                <p class="hero-description reveal-fade"><?php echo esc_html($hero_desc); ?></p>

                <div class="hero-cta-group reveal-fade">
                    <a href="<?php echo esc_url($hero_url1); ?>" class="thrift-btn thrift-btn--dark">
                        <?php echo esc_html($hero_btn1); ?> &rarr;
                    </a>
                    <a href="<?php echo esc_url($hero_url2); ?>" class="thrift-btn thrift-btn--outline">
                        <?php echo esc_html($hero_btn2); ?>
                    </a>
                </div>

                <div class="hero-stats reveal-fade">
                    <div class="stat-item">
                        <strong>100%</strong>
                        <span>Hand-Inspected &amp; Authenticated</span>
                    </div>
                    <div class="stat-item">
                        <strong>1-of-1</strong>
                        <span>Unique Archived Pieces</span>
                    </div>
                    <div class="stat-item">
                        <strong>Zero</strong>
                        <span>Fast Fashion Waste</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. SPLIT CATEGORY SHOWCASE (TOPS & BOTTOMS) -->
    <section class="section-py category-split-showcase">
        <div class="thrift-container">
            <div class="category-split-grid">
                <!-- Tops Showcase Card -->
                <a href="<?php echo esc_url(home_url('/product-category/tops/')); ?>" class="split-cat-card split-cat-card--tops">
                    <div class="split-cat-bg split-cat-bg--tops"></div>
                    <div class="split-cat-overlay"></div>
                    <div class="split-cat-content">
                        <span class="cat-micro-tag"><?php esc_html_e('ARCHIVE CURATION 01', 'ansh-thrifts'); ?></span>
                        <h2 class="split-cat-title"><?php esc_html_e('TOPS', 'ansh-thrifts'); ?></h2>
                        <p class="split-cat-sub"><?php esc_html_e('Vintage Leather, Distressed Hoodies, Carhartt Jackets &amp; Band Tees', 'ansh-thrifts'); ?></p>
                        <span class="split-cat-link"><?php esc_html_e('Browse Tops Collection &rarr;', 'ansh-thrifts'); ?></span>
                    </div>
                </a>

                <!-- Bottoms Showcase Card -->
                <a href="<?php echo esc_url(home_url('/product-category/bottoms/')); ?>" class="split-cat-card split-cat-card--bottoms">
                    <div class="split-cat-bg split-cat-bg--bottoms"></div>
                    <div class="split-cat-overlay"></div>
                    <div class="split-cat-content">
                        <span class="cat-micro-tag"><?php esc_html_e('ARCHIVE CURATION 02', 'ansh-thrifts'); ?></span>
                        <h2 class="split-cat-title"><?php esc_html_e('BOTTOMS', 'ansh-thrifts'); ?></h2>
                        <p class="split-cat-sub"><?php esc_html_e('Classic 90s Levi’s 501, Parachute Pants, Cargo Pantalons &amp; Tailored Trousers', 'ansh-thrifts'); ?></p>
                        <span class="split-cat-link"><?php esc_html_e('Browse Bottoms Collection &rarr;', 'ansh-thrifts'); ?></span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- 3. NEW ARRIVALS (DYNAMIC WOOCOMMERCE QUERY) -->
    <section class="section-py product-showcase-section bg-sand">
        <div class="thrift-container">
            <div class="section-header">
                <div>
                    <span class="section-badge"><?php esc_html_e('FRESH VINTAGE ARCHIVE', 'ansh-thrifts'); ?></span>
                    <h2 class="section-heading"><?php esc_html_e('New Arrivals &amp; Recent Drops', 'ansh-thrifts'); ?></h2>
                </div>
                <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>" class="view-all-link">
                    <?php esc_html_e('View Complete Archive', 'ansh-thrifts'); ?> &rarr;
                </a>
            </div>

            <div class="products-editorial-grid">
                <?php
                $new_arrivals = ansh_thrifts_get_products([
                    'limit'   => get_theme_mod('ansh_wc_columns_desktop', 4),
                    'orderby' => 'date',
                    'order'   => 'DESC',
                ]);

                if (!empty($new_arrivals)) {
                    foreach ($new_arrivals as $wc_prod) {
                        $GLOBALS['product'] = $wc_prod;
                        get_template_part('template-parts/product-card');
                    }
                    wp_reset_postdata();
                } else {
                    ?>
                    <div class="store-empty-notice">
                        <p><strong><?php esc_html_e('New Sunday drop incoming!', 'ansh-thrifts'); ?></strong></p>
                        <p><?php esc_html_e('Once you publish products in WooCommerce (under Products &rarr; Add New), they will dynamically display here.', 'ansh-thrifts'); ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- 4. FEATURED TOPS SECTION (DYNAMIC TOPS CATEGORY) -->
    <section class="section-py product-showcase-section">
        <div class="thrift-container">
            <div class="section-header">
                <div>
                    <span class="section-badge"><?php esc_html_e('CURATION / TOPS', 'ansh-thrifts'); ?></span>
                    <h2 class="section-heading"><?php esc_html_e('Featured Tops &amp; Outerwear', 'ansh-thrifts'); ?></h2>
                </div>
                <a href="<?php echo esc_url(home_url('/product-category/tops/')); ?>" class="view-all-link">
                    <?php esc_html_e('Explore All Tops', 'ansh-thrifts'); ?> &rarr;
                </a>
            </div>

            <div class="products-editorial-grid">
                <?php
                $tops_products = ansh_thrifts_get_products([
                    'limit'    => get_theme_mod('ansh_wc_columns_desktop', 4),
                    'category' => ['tops'],
                ]);

                if (!empty($tops_products)) {
                    foreach ($tops_products as $wc_prod) {
                        $GLOBALS['product'] = $wc_prod;
                        get_template_part('template-parts/product-card');
                    }
                    wp_reset_postdata();
                } else {
                    ?>
                    <div class="store-empty-notice">
                        <p><?php esc_html_e('Assign products to the "Tops" category in WooCommerce to feature them here.', 'ansh-thrifts'); ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- 5. PROMOTIONAL EDITORIAL BANNER -->
    <section class="promo-editorial-banner">
        <div class="thrift-container">
            <div class="promo-card">
                <div class="promo-tag"><?php esc_html_e('CIRCULAR FASHION MANIFESTO', 'ansh-thrifts'); ?></div>
                <h3 class="promo-title"><?php esc_html_e('Every piece has a past. Give it a future.', 'ansh-thrifts'); ?></h3>
                <p class="promo-text"><?php esc_html_e('Fast fashion produces 92 million tonnes of textile waste yearly. Every thrifted item you purchase from Ansh Thrifts keeps premium garments in rotation and out of landfills.', 'ansh-thrifts'); ?></p>
                <div class="promo-actions">
                    <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>" class="thrift-btn thrift-btn--dark">
                        <?php esc_html_e('Shop Mindful Fashion', 'ansh-thrifts'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. FEATURED BOTTOMS SECTION (DYNAMIC BOTTOMS CATEGORY) -->
    <section class="section-py product-showcase-section bg-sand">
        <div class="thrift-container">
            <div class="section-header">
                <div>
                    <span class="section-badge"><?php esc_html_e('CURATION / BOTTOMS', 'ansh-thrifts'); ?></span>
                    <h2 class="section-heading"><?php esc_html_e('Featured Bottoms &amp; Vintage Denim', 'ansh-thrifts'); ?></h2>
                </div>
                <a href="<?php echo esc_url(home_url('/product-category/bottoms/')); ?>" class="view-all-link">
                    <?php esc_html_e('Explore All Bottoms', 'ansh-thrifts'); ?> &rarr;
                </a>
            </div>

            <div class="products-editorial-grid">
                <?php
                $bottoms_products = ansh_thrifts_get_products([
                    'limit'    => get_theme_mod('ansh_wc_columns_desktop', 4),
                    'category' => ['bottoms'],
                ]);

                if (!empty($bottoms_products)) {
                    foreach ($bottoms_products as $wc_prod) {
                        $GLOBALS['product'] = $wc_prod;
                        get_template_part('template-parts/product-card');
                    }
                    wp_reset_postdata();
                } else {
                    ?>
                    <div class="store-empty-notice">
                        <p><?php esc_html_e('Assign products to the "Bottoms" category in WooCommerce to feature them here.', 'ansh-thrifts'); ?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- 7. SHOP BY BRAND TAXONOMY -->
    <section class="section-py brand-grid-section">
        <div class="thrift-container">
            <div class="section-header text-center">
                <span class="section-badge"><?php esc_html_e('AUTHENTIC ARCHIVES', 'ansh-thrifts'); ?></span>
                <h2 class="section-heading"><?php esc_html_e('Shop by Curated Brand', 'ansh-thrifts'); ?></h2>
                <p class="section-sub"><?php esc_html_e('Browse original pieces from world-renowned vintage and streetwear brands.', 'ansh-thrifts'); ?></p>
            </div>

            <div class="brands-grid">
                <?php
                $brands = get_terms([
                    'taxonomy'   => 'product_brand',
                    'hide_empty' => false,
                    'number'     => 12,
                ]);

                if (!empty($brands) && !is_wp_error($brands)) {
                    foreach ($brands as $brand) {
                        $brand_link = get_term_link($brand);
                        ?>
                        <a href="<?php echo esc_url($brand_link); ?>" class="brand-card">
                            <span class="brand-card__name"><?php echo esc_html($brand->name); ?></span>
                            <span class="brand-card__count"><?php echo esc_html(sprintf(_n('%s piece', '%s pieces', $brand->count, 'ansh-thrifts'), $brand->count)); ?></span>
                        </a>
                        <?php
                    }
                } else {
                    $sample_brands = ['Nike Vintage', 'Levi\'s', 'Carhartt', 'Adidas', 'Ralph Lauren', 'Zara Studio', 'Stüssy', 'Dickies'];
                    foreach ($sample_brands as $sb) {
                        ?>
                        <div class="brand-card">
                            <span class="brand-card__name"><?php echo esc_html($sb); ?></span>
                            <span class="brand-card__count"><?php esc_html_e('Thrift Archive', 'ansh-thrifts'); ?></span>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- 8. ABOUT THE THRIFT STORE PHILOSOPHY -->
    <section class="section-py about-preview-section bg-sand">
        <div class="thrift-container">
            <div class="about-grid">
                <div class="about-content">
                    <span class="section-badge"><?php esc_html_e('OUR STORY &amp; PHILOSOPHY', 'ansh-thrifts'); ?></span>
                    <h2 class="about-title"><?php esc_html_e('Curated with obsession. Restored with respect.', 'ansh-thrifts'); ?></h2>
                    <p class="about-p">
                        <?php esc_html_e('At Ansh Thrifts, we believe clothing should be treasured, not discarded. Each item in our collection is handpicked from vintage archives across the globe, inspected for quality, and professionally laundered.', 'ansh-thrifts'); ?>
                    </p>
                    <p class="about-p">
                        <?php esc_html_e('Because our pieces are true vintage and one-offs, when an item sells out, it’s gone forever. We take exact measurements so you get the perfect fit every time.', 'ansh-thrifts'); ?>
                    </p>
                </div>
                <div class="about-visual">
                    <div class="about-quote-box">
                        <p class="quote-text">“Style isn’t about what’s trending on TikTok this week. It’s about wearing pieces with soul, history, and craftsmanship.”</p>
                        <span class="quote-author">&mdash; Ansh Thrifts Archive Studio</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. INSTAGRAM / COMMUNITY GRID -->
    <section class="section-py instagram-community-section">
        <div class="thrift-container">
            <div class="section-header text-center">
                <span class="section-badge">@ansh.thrifts</span>
                <h2 class="section-heading"><?php esc_html_e('Seen on the Community', 'ansh-thrifts'); ?></h2>
                <p class="section-sub"><?php esc_html_e('Tag #AnshArchive to be featured on our editorial gallery.', 'ansh-thrifts'); ?></p>
            </div>

            <div class="instagram-grid">
                <div class="insta-tile insta-tile-1"><div class="insta-overlay"><span>#VintageStyle</span></div></div>
                <div class="insta-tile insta-tile-2"><div class="insta-overlay"><span>#90sOversized</span></div></div>
                <div class="insta-tile insta-tile-3"><div class="insta-overlay"><span>#Levis501</span></div></div>
                <div class="insta-tile insta-tile-4"><div class="insta-overlay"><span>#SustainableFashion</span></div></div>
            </div>
        </div>
    </section>

<?php endif; ?>

</main>

<?php
get_footer();
