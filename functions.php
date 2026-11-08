<?php
/**
 * Ansh Thrifts Theme Functions & Definitions
 *
 * @package Ansh_Thrifts
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

define('ANSH_THRIFTS_VERSION', '1.0.0');
define('ANSH_THRIFTS_DIR', get_template_directory());
define('ANSH_THRIFTS_URI', get_template_directory_uri());

/**
 * 1. THEME SETUP & WOOCOMMERCE SUPPORT
 */
function ansh_thrifts_setup() {
    load_theme_textdomain('ansh-thrifts', ANSH_THRIFTS_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('custom-spacing');
    add_theme_support('custom-line-height');
    add_theme_support('appearance-tools');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);

    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // WooCommerce Native Theme Supports
    add_theme_support('woocommerce', [
        'thumbnail_image_width' => 600,
        'single_image_width'    => 1000,
        'product_grid'          => [
            'default_rows'    => 4,
            'min_rows'        => 2,
            'max_rows'        => 12,
            'default_columns' => 4,
            'min_columns'     => 2,
            'max_columns'     => 6,
        ],
    ]);
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    // Register Navigation Menus
    register_nav_menus([
        'primary-menu'  => esc_html__('Primary Header Menu', 'ansh-thrifts'),
        'category-menu' => esc_html__('Shop Categories Bar', 'ansh-thrifts'),
        'footer-menu'   => esc_html__('Footer Quick Links', 'ansh-thrifts'),
        'footer-policy' => esc_html__('Footer Policies Menu', 'ansh-thrifts'),
    ]);

    // Custom Image Sizes for Editorial Photography
    add_image_size('thrift-card', 600, 750, true);
    add_image_size('thrift-hero', 1600, 900, true);
    add_image_size('thrift-square', 600, 600, true);
}
add_action('after_setup_theme', 'ansh_thrifts_setup');

/**
 * 2. HIGH-PERFORMANCE ORDER STORAGE (HPOS) COMPATIBILITY
 */
add_action('before_woocommerce_init', function () {
    if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('cart_checkout_blocks', __FILE__, true);
    }
});

/**
 * 3. ENQUEUE SCRIPTS & STYLES
 */
function ansh_thrifts_scripts() {
    // Fonts: Syne / Cormorant Garamond & Plus Jakarta Sans
    wp_enqueue_style(
        'ansh-google-fonts',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Syne:wght@500;600;700;800&family=Playfair+Display:ital,wght@0,500;0,600;1,400&display=swap',
        [],
        null
    );

    // Main Compiled CSS
    wp_enqueue_style(
        'ansh-thrifts-main',
        ANSH_THRIFTS_URI . '/assets/css/main.css',
        [],
        ANSH_THRIFTS_VERSION
    );

    // Theme Descriptor Stylesheet
    wp_enqueue_style('ansh-thrifts-style', get_stylesheet_uri(), ['ansh-thrifts-main'], ANSH_THRIFTS_VERSION);

    // Main Vanilla JS
    wp_enqueue_script(
        'ansh-thrifts-main-js',
        ANSH_THRIFTS_URI . '/assets/js/main.js',
        [],
        ANSH_THRIFTS_VERSION,
        true
    );

    // Localize Script for AJAX & WooCommerce interactions
    wp_localize_script('ansh-thrifts-main-js', 'anshThriftsData', [
        'ajaxUrl'     => admin_url('admin-ajax.php'),
        'nonce'       => wp_create_nonce('ansh_thrifts_nonce'),
        'cartUrl'     => function_exists('wc_get_cart_url') ? wc_get_cart_url() : '',
        'checkoutUrl' => function_exists('wc_get_checkout_url') ? wc_get_checkout_url() : '',
        'isLoggedIn'  => is_user_logged_in(),
    ]);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'ansh_thrifts_scripts');

/**
 * 4. REGISTER CUSTOM TAXONOMIES: BRAND & CONDITION
 */
function ansh_thrifts_register_taxonomies() {
    // 4A. Brand Taxonomy
    $brand_labels = [
        'name'              => _x('Brands', 'taxonomy general name', 'ansh-thrifts'),
        'singular_name'     => _x('Brand', 'taxonomy singular name', 'ansh-thrifts'),
        'search_items'      => __('Search Brands', 'ansh-thrifts'),
        'all_items'         => __('All Brands', 'ansh-thrifts'),
        'parent_item'       => __('Parent Brand', 'ansh-thrifts'),
        'parent_item_colon' => __('Parent Brand:', 'ansh-thrifts'),
        'edit_item'         => __('Edit Brand', 'ansh-thrifts'),
        'update_item'       => __('Update Brand', 'ansh-thrifts'),
        'add_new_item'      => __('Add New Brand', 'ansh-thrifts'),
        'new_item_name'     => __('New Brand Name', 'ansh-thrifts'),
        'menu_name'         => __('Brands', 'ansh-thrifts'),
    ];

    register_taxonomy('product_brand', ['product'], [
        'hierarchical'      => false,
        'labels'            => $brand_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'brand', 'with_front' => false],
        'show_in_rest'      => true,
    ]);

    // 4B. Thrift Condition Taxonomy
    $condition_labels = [
        'name'              => _x('Item Conditions', 'taxonomy general name', 'ansh-thrifts'),
        'singular_name'     => _x('Condition', 'taxonomy singular name', 'ansh-thrifts'),
        'search_items'      => __('Search Conditions', 'ansh-thrifts'),
        'all_items'         => __('All Conditions', 'ansh-thrifts'),
        'edit_item'         => __('Edit Condition', 'ansh-thrifts'),
        'update_item'       => __('Update Condition', 'ansh-thrifts'),
        'add_new_item'      => __('Add New Condition', 'ansh-thrifts'),
        'new_item_name'     => __('New Condition Name', 'ansh-thrifts'),
        'menu_name'         => __('Conditions', 'ansh-thrifts'),
    ];

    register_taxonomy('product_condition', ['product'], [
        'hierarchical'      => false,
        'labels'            => $condition_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'condition', 'with_front' => false],
        'show_in_rest'      => true,
    ]);
}
add_action('init', 'ansh_thrifts_register_taxonomies', 0);

/**
 * Seed default conditions upon theme activation if empty
 */
function ansh_thrifts_seed_default_terms() {
    if (!taxonomy_exists('product_condition')) {
        return;
    }
    $default_conditions = [
        'Pristine Vintage'    => 'Unworn or deadstock vintage condition.',
        'Like New'            => 'Flawless condition with zero signs of wear.',
        'Excellent Pre-Loved' => 'Minimal gentle wear, no stains or holes.',
        'Good Vintage'        => 'Authentic vintage wear, beautifully distressed.'
    ];

    foreach ($default_conditions as $name => $desc) {
        if (!term_exists($name, 'product_condition')) {
            wp_insert_term($name, 'product_condition', ['description' => $desc]);
        }
    }
}
add_action('after_switch_theme', 'ansh_thrifts_seed_default_terms');

/**
 * 5. WOOCOMMERCE HOOKS, WRAPPERS & HELPERS
 */

// Custom wrapper markup
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', function () {
    echo '<main id="primary" class="site-main shop-main"><div class="thrift-container">';
}, 10);

add_action('woocommerce_after_main_content', function () {
    echo '</div></main>';
}, 10);

// Single Product: Thrift Meta Display (Brand, Condition & 1-of-1 Rarity)
add_action('woocommerce_single_product_summary', function () {
    global $product;
    if (!$product) return;
    $brand     = ansh_thrifts_get_product_brand($product->get_id());
    $condition = ansh_thrifts_get_product_condition($product->get_id());
    $is_1of1   = ($product->managing_stock() && $product->get_stock_quantity() === 1);
    ?>
    <div class="single-thrift-meta-top">
        <?php if (!empty($brand)) : ?>
            <a href="<?php echo esc_url(home_url('/?brand=' . urlencode(sanitize_title($brand)))); ?>" class="single-brand-tag">
                <?php echo esc_html($brand); ?>
            </a>
        <?php endif; ?>

        <?php if (!empty($condition)) : ?>
            <span class="single-condition-pill">
                <?php esc_html_e('Condition: ', 'ansh-thrifts'); ?><strong><?php echo esc_html($condition); ?></strong>
            </span>
        <?php endif; ?>

        <?php if ($is_1of1) : ?>
            <span class="single-rare-pill">
                &starf; <?php esc_html_e('1 of 1 Archive Piece', 'ansh-thrifts'); ?>
            </span>
        <?php endif; ?>
    </div>
    <?php
}, 4);

// Single Product: Direct "Buy Now" Button
add_action('woocommerce_after_add_to_cart_button', function () {
    global $product;
    if (!$product || !$product->is_in_stock()) return;
    ?>
    <a href="<?php echo esc_url(add_query_arg('ansh_buy_now', $product->get_id(), wc_get_checkout_url())); ?>" class="thrift-btn thrift-btn--buy-now">
        <?php esc_html_e('Buy It Now (Fast Checkout)', 'ansh-thrifts'); ?>
    </a>
    <?php
}, 15);

// Single Product: Thrift Assurance & Vintage Care Information
add_action('woocommerce_single_product_summary', function () {
    ?>
    <div class="thrift-product-guarantee">
        <div class="guarantee-row">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
            <div>
                <strong><?php esc_html_e('100% Hand-Vetted & Sanitized', 'ansh-thrifts'); ?></strong>
                <span><?php esc_html_e('Professionally washed, steam-treated and graded.', 'ansh-thrifts'); ?></span>
            </div>
        </div>
        <div class="guarantee-row">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 14 14"></polyline></svg>
            <div>
                <strong><?php esc_html_e('One-of-a-Kind Item', 'ansh-thrifts'); ?></strong>
                <span><?php esc_html_e('Once sold, this unique vintage piece will not restock.', 'ansh-thrifts'); ?></span>
            </div>
        </div>
        <div class="guarantee-row">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
            <div>
                <strong><?php esc_html_e('Fast Tracked Shipping', 'ansh-thrifts'); ?></strong>
                <span><?php esc_html_e('Dispatched within 24 hours in eco-packaging.', 'ansh-thrifts'); ?></span>
            </div>
        </div>
    </div>
    <?php
}, 35);

// Disable default WooCommerce breadcrumbs in favor of clean custom header
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

/**
 * Output Filter Bar before WooCommerce shop loop
 */
add_action('woocommerce_before_shop_loop', function () {
    if (function_exists('is_shop') && (is_shop() || (function_exists('is_product_taxonomy') && is_product_taxonomy()))) {
        get_template_part('template-parts/filter-bar');
    }
}, 15);

/**
 * Custom Query Modifications for Brand, Condition & Availability Filters
 */
function ansh_thrifts_filter_shop_query($query) {
    if (!is_admin() && $query->is_main_query() && function_exists('is_shop') && (is_shop() || (function_exists('is_product_taxonomy') && is_product_taxonomy()))) {
        $tax_query = (array) $query->get('tax_query');

        // Brand Filter
        if (!empty($_GET['brand'])) {
            $tax_query[] = [
                'taxonomy' => 'product_brand',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['brand']),
            ];
        }

        // Condition Filter
        if (!empty($_GET['condition'])) {
            $tax_query[] = [
                'taxonomy' => 'product_condition',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['condition']),
            ];
        }

        if (!empty($_GET['brand']) || !empty($_GET['condition'])) {
            $tax_query['relation'] = 'AND';
            $query->set('tax_query', $tax_query);
        }

        // In Stock Filter
        if (!empty($_GET['in_stock']) && $_GET['in_stock'] === '1') {
            $meta_query = (array) $query->get('meta_query');
            $meta_query[] = [
                'key'     => '_stock_status',
                'value'   => 'instock',
                'compare' => '=',
            ];
            $query->set('meta_query', $meta_query);
        }
    }
}
add_action('pre_get_posts', 'ansh_thrifts_filter_shop_query');

/**
 * AJAX Cart Fragments: update cart drawer count dynamically
 */
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    if (!function_exists('WC')) {
        return $fragments;
    }
    ob_start();
    ?>
    <span class="cart-badge" id="header-cart-count">
        <?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>
    </span>
    <?php
    $fragments['#header-cart-count'] = ob_get_clean();

    ob_start();
    ?>
    <div id="drawer-cart-items-wrapper">
        <?php ansh_thrifts_render_cart_drawer_contents(); ?>
    </div>
    <?php
    $fragments['#drawer-cart-items-wrapper'] = ob_get_clean();

    return $fragments;
});

/**
 * Render Mini Cart Drawer Contents
 */
function ansh_thrifts_render_cart_drawer_contents() {
    if (!function_exists('WC') || !WC()->cart) {
        return;
    }

    if (WC()->cart->is_empty()) {
        ?>
        <div class="empty-cart-state">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
                <line x1="3" y1="6" x2="21" y2="6"/>
                <path d="M16 10a4 4 0 0 1-8 0"/>
            </svg>
            <p class="empty-title"><?php esc_html_e('Your thrift bag is empty', 'ansh-thrifts'); ?></p>
            <p class="empty-sub"><?php esc_html_e('Our one-of-a-kind vintage pieces sell quickly. Start exploring new drops now.', 'ansh-thrifts'); ?></p>
            <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>" class="thrift-btn thrift-btn--dark">
                <?php esc_html_e('Explore Vintage Collection', 'ansh-thrifts'); ?>
            </a>
        </div>
        <?php
        return;
    }
    ?>
    <ul class="mini-cart-list">
        <?php
        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                $thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('thumbnail'), $cart_item, $cart_item_key);
                $product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                $product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                ?>
                <li class="mini-cart-item" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                    <a href="<?php echo esc_url($product_permalink); ?>" class="mini-cart-thumb">
                        <?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </a>
                    <div class="mini-cart-details">
                        <a href="<?php echo esc_url($product_permalink); ?>" class="mini-cart-name">
                            <?php echo wp_kses_post($product_name); ?>
                        </a>
                        <div class="mini-cart-meta">
                            <span class="mini-cart-price"><?php echo $product_price; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
                            <?php if ($cart_item['quantity'] > 1): ?>
                                <span class="mini-cart-qty">&times; <?php echo esc_html($cart_item['quantity']); ?></span>
                            <?php else: ?>
                                <span class="thrift-unique-badge"><?php esc_html_e('1 of 1', 'ansh-thrifts'); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php
                        echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
                            '<a href="%s" class="remove-mini-item" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times; Remove</a>',
                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                            esc_attr(sprintf(__('Remove %s from bag', 'ansh-thrifts'), wp_strip_all_tags($product_name))),
                            esc_attr($product_id),
                            esc_attr($cart_item_key),
                            esc_attr($_product->get_sku())
                        ), $cart_item_key);
                        ?>
                    </div>
                </li>
                <?php
            }
        }
        ?>
    </ul>
    <div class="mini-cart-footer">
        <div class="mini-cart-subtotal">
            <span><?php esc_html_e('Subtotal', 'ansh-thrifts'); ?></span>
            <strong><?php wc_cart_totals_subtotal_html(); ?></strong>
        </div>
        <p class="mini-cart-notice"><?php esc_html_e('Shipping & taxes calculated at checkout.', 'ansh-thrifts'); ?></p>
        <div class="mini-cart-actions">
            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="thrift-btn thrift-btn--dark w-full">
                <?php esc_html_e('Proceed to Checkout', 'ansh-thrifts'); ?>
            </a>
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="thrift-btn thrift-btn--outline w-full">
                <?php esc_html_e('View Full Bag', 'ansh-thrifts'); ?>
            </a>
        </div>
    </div>
    <?php
}

/**
 * Buy Now Button Handler (Direct to Checkout)
 */
function ansh_thrifts_buy_now_action() {
    if (isset($_REQUEST['ansh_buy_now']) && !empty($_REQUEST['ansh_buy_now'])) {
        $product_id = absint($_REQUEST['ansh_buy_now']);
        $quantity   = isset($_REQUEST['quantity']) ? absint($_REQUEST['quantity']) : 1;
        $variation_id = isset($_REQUEST['variation_id']) ? absint($_REQUEST['variation_id']) : 0;

        if (function_exists('WC') && $product_id > 0) {
            WC()->cart->empty_cart();
            if ($variation_id > 0) {
                WC()->cart->add_to_cart($product_id, $quantity, $variation_id);
            } else {
                WC()->cart->add_to_cart($product_id, $quantity);
            }
            wp_safe_redirect(wc_get_checkout_url());
            exit;
        }
    }
}
add_action('template_redirect', 'ansh_thrifts_buy_now_action');

/**
 * 6. THEME CUSTOMIZER CONFIGURATION
 */
function ansh_thrifts_customize_register($wp_customize) {
    // Section: Announcement Bar
    $wp_customize->add_section('ansh_announcement_section', [
        'title'    => __('Announcement Bar', 'ansh-thrifts'),
        'priority' => 20,
    ]);

    $wp_customize->add_setting('ansh_announcement_enable', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('ansh_announcement_enable', [
        'label'    => __('Show Announcement Bar', 'ansh-thrifts'),
        'section'  => 'ansh_announcement_section',
        'type'     => 'checkbox',
    ]);

    $wp_customize->add_setting('ansh_announcement_text', [
        'default'           => 'SUSTAINABLE ARCHIVE: WORLDWIDE SHIPPING &bull; FRESH DROPS EVERY SUNDAY 6PM GMT',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('ansh_announcement_text', [
        'label'    => __('Announcement Text', 'ansh-thrifts'),
        'section'  => 'ansh_announcement_section',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('ansh_announcement_link', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('ansh_announcement_link', [
        'label'    => __('Announcement Link (optional)', 'ansh-thrifts'),
        'section'  => 'ansh_announcement_section',
        'type'     => 'url',
    ]);

    // Section: Editorial Hero Banner
    $wp_customize->add_section('ansh_hero_section', [
        'title'    => __('Editorial Hero Banner', 'ansh-thrifts'),
        'priority' => 25,
    ]);

    $wp_customize->add_setting('ansh_hero_badge', [
        'default'           => 'AUTUMN / WINTER 2026 ARCHIVE',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ansh_hero_badge', [
        'label'   => __('Hero Sub-Tag / Badge', 'ansh-thrifts'),
        'section' => 'ansh_hero_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('ansh_hero_title', [
        'default'           => 'Curated Vintage & One-of-a-Kind Fashion',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ansh_hero_title', [
        'label'   => __('Hero Main Title', 'ansh-thrifts'),
        'section' => 'ansh_hero_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('ansh_hero_desc', [
        'default'           => 'Handpicked streetwear, rare designer archives, premium denim, and timeless thrift silhouettes. Each garment carries a unique past.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('ansh_hero_desc', [
        'label'   => __('Hero Subtitle', 'ansh-thrifts'),
        'section' => 'ansh_hero_section',
        'type'    => 'textarea',
    ]);

    $wp_customize->add_setting('ansh_hero_btn1_text', [
        'default'           => 'Shop Tops',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ansh_hero_btn1_text', [
        'label'   => __('Button 1 Text', 'ansh-thrifts'),
        'section' => 'ansh_hero_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('ansh_hero_btn1_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('ansh_hero_btn1_url', [
        'label'   => __('Button 1 URL', 'ansh-thrifts'),
        'section' => 'ansh_hero_section',
        'type'    => 'url',
    ]);

    $wp_customize->add_setting('ansh_hero_btn2_text', [
        'default'           => 'Shop Bottoms',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ansh_hero_btn2_text', [
        'label'   => __('Button 2 Text', 'ansh-thrifts'),
        'section' => 'ansh_hero_section',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('ansh_hero_btn2_url', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('ansh_hero_btn2_url', [
        'label'   => __('Button 2 URL', 'ansh-thrifts'),
        'section' => 'ansh_hero_section',
        'type'    => 'url',
    ]);

    $wp_customize->add_setting('ansh_hero_bg_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'ansh_hero_bg_image', [
        'label'   => __('Hero Background Image', 'ansh-thrifts'),
        'section' => 'ansh_hero_section',
    ]));

    // Section: Social Media & Contact Links
    $wp_customize->add_section('ansh_social_section', [
        'title'    => __('Social Links & Brand Story', 'ansh-thrifts'),
        'priority' => 30,
    ]);

    $wp_customize->add_setting('ansh_social_instagram', [
        'default'           => 'https://instagram.com',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('ansh_social_instagram', [
        'label'   => __('Instagram URL', 'ansh-thrifts'),
        'section' => 'ansh_social_section',
        'type'    => 'url',
    ]);

    $wp_customize->add_setting('ansh_social_tiktok', [
        'default'           => 'https://tiktok.com',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('ansh_social_tiktok', [
        'label'   => __('TikTok URL', 'ansh-thrifts'),
        'section' => 'ansh_social_section',
        'type'    => 'url',
    ]);
}
add_action('customize_register', 'ansh_thrifts_customize_register');

/**
 * 7. CLIENT ADMIN EXPERIENCE & DASHBOARD SHORTCUTS
 */
function ansh_thrifts_add_dashboard_widgets() {
    if (current_user_can('edit_products') || current_user_can('manage_woocommerce')) {
        wp_add_dashboard_widget(
            'ansh_thrifts_quick_actions',
            __('Ansh Thrifts &bull; Quick Store Controls', 'ansh-thrifts'),
            'ansh_thrifts_render_admin_dashboard_widget'
        );
    }
}
add_action('wp_dashboard_setup', 'ansh_thrifts_add_dashboard_widgets');

function ansh_thrifts_render_admin_dashboard_widget() {
    ?>
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 12px; padding: 10px 0;">
        <a href="<?php echo esc_url(admin_url('post-new.php?post_type=product')); ?>" class="button button-primary" style="padding: 10px; text-align: center; height: auto;">
            <strong>+ Add New Piece</strong><br><small style="font-weight: normal;">Upload thrift product</small>
        </a>
        <a href="<?php echo esc_url(admin_url('edit.php?post_type=product')); ?>" class="button" style="padding: 10px; text-align: center; height: auto;">
            <strong>All Products</strong><br><small style="font-weight: normal;">Inventory & stock</small>
        </a>
        <a href="<?php echo esc_url(admin_url('edit.php?post_type=shop_order')); ?>" class="button" style="padding: 10px; text-align: center; height: auto;">
            <strong>View Orders</strong><br><small style="font-weight: normal;">Customer purchases</small>
        </a>
        <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=product_brand&post_type=product')); ?>" class="button" style="padding: 10px; text-align: center; height: auto;">
            <strong>Manage Brands</strong><br><small style="font-weight: normal;">Nike, Levi's, etc.</small>
        </a>
        <a href="<?php echo esc_url(admin_url('admin.php?page=wc-reports')); ?>" class="button" style="padding: 10px; text-align: center; height: auto;">
            <strong>Sales Analytics</strong><br><small style="font-weight: normal;">Revenue reports</small>
        </a>
        <a href="<?php echo esc_url(admin_url('themes.php?page=ansh-thrifts-demo')); ?>" class="button" style="padding: 10px; text-align: center; height: auto; background: #faf8f5;">
            <strong>&starf; Demo Setup</strong><br><small style="font-weight: normal;">Seed sample drops</small>
        </a>
    </div>
    <div style="margin-top: 15px; border-top: 1px solid #ddd; padding-top: 10px; font-size: 13px; color: #555;">
        <p><strong>Thrift Store Pro-Tip:</strong> For unique one-of-a-kind vintage pieces, set <em>Inventory &rarr; Manage Stock</em> to checked and set <em>Quantity</em> to <code>1</code>. The theme will automatically label it <strong>"1 of 1"</strong>!</p>
    </div>
    <?php
}

/**
 * 8. DYNAMIC PRODUCT QUERY HELPER
 * Fetches dynamic WooCommerce products with custom args
 */
function ansh_thrifts_get_products($args = []) {
    if (!function_exists('wc_get_products')) {
        return [];
    }
    $defaults = [
        'status'  => 'publish',
        'limit'   => 8,
        'orderby' => 'date',
        'order'   => 'DESC',
    ];
    $parsed_args = wp_parse_args($args, $defaults);
    return wc_get_products($parsed_args);
}

/**
 * Helper to get brand name of a product
 */
function ansh_thrifts_get_product_brand($product_id) {
    $brands = get_the_terms($product_id, 'product_brand');
    if (!empty($brands) && !is_wp_error($brands)) {
        return $brands[0]->name;
    }
    return '';
}

/**
 * Helper to get condition name of a product
 */
function ansh_thrifts_get_product_condition($product_id) {
    $conditions = get_the_terms($product_id, 'product_condition');
    if (!empty($conditions) && !is_wp_error($conditions)) {
        return $conditions[0]->name;
    }
    return '';
}

/**
 * Filter WooCommerce Shop Loop Columns dynamically from Customizer
 */
add_filter('loop_shop_columns', function ($cols) {
    return get_theme_mod('ansh_wc_columns_desktop', 4);
});

/**
 * 9. LOAD VISUAL SYSTEM: CUSTOMIZER, GUTENBERG PATTERNS & DEMO GENERATOR
 */
require_once ANSH_THRIFTS_DIR . '/inc/customizer.php';
require_once ANSH_THRIFTS_DIR . '/inc/patterns.php';
require_once ANSH_THRIFTS_DIR . '/inc/demo-importer.php';

