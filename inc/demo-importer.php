<?php
/**
 * Ansh Thrifts - One-Click Demo Data Generator
 * Seeds Tops, Bottoms, Curated Brands, Conditions, and Sample 1-of-1 Thrift Pieces.
 *
 * @package Ansh_Thrifts
 * @version 1.1.0
 */

defined('ABSPATH') || exit;

// Add admin menu for Demo Setup
add_action('admin_menu', function () {
    add_theme_page(
        __('Ansh Thrifts Demo Setup', 'ansh-thrifts'),
        __('Thrift Demo Setup', 'ansh-thrifts'),
        'manage_options',
        'ansh-thrifts-demo',
        'ansh_thrifts_render_demo_page'
    );
});

function ansh_thrifts_render_demo_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $seeded = false;
    if (isset($_POST['ansh_run_demo_seed']) && check_admin_referer('ansh_seed_demo_nonce')) {
        ansh_thrifts_execute_demo_seed();
        $seeded = true;
    }
    ?>
    <div class="wrap" style="max-width: 800px; margin-top: 30px;">
        <h1 style="font-family: 'Georgia', serif; font-size: 28px; margin-bottom: 10px;">
            <?php esc_html_e('Ansh Thrifts &bull; Store Demo Generator', 'ansh-thrifts'); ?>
        </h1>
        <p style="font-size: 15px; color: #555; line-height: 1.6;">
            <?php esc_html_e('Instantly populate your store with Tops & Bottoms categories, vintage brands (Nike, Levi’s, Carhartt), thrift condition grades, and 8 curated 1-of-1 sample thrift pieces. Perfect for previewing your store before publishing real inventory.', 'ansh-thrifts'); ?>
        </p>

        <?php if ($seeded) : ?>
            <div class="notice notice-success is-dismissible" style="padding: 12px; margin-top: 20px;">
                <p><strong><?php esc_html_e('&check; Success! Demo thrift categories, brands, conditions, and products have been seeded.', 'ansh-thrifts'); ?></strong></p>
                <p><a href="<?php echo esc_url(home_url('/')); ?>" target="_blank" class="button button-primary"><?php esc_html_e('View Live Homepage &rarr;', 'ansh-thrifts'); ?></a> <a href="<?php echo esc_url(admin_url('edit.php?post_type=product')); ?>" class="button"><?php esc_html_e('View Seeded Products', 'ansh-thrifts'); ?></a></p>
            </div>
        <?php endif; ?>

        <div style="background: #fff; border: 1px solid #ccd0d4; padding: 25px; margin-top: 20px; border-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <h2 style="margin-top: 0;"><?php esc_html_e('What will be created:', 'ansh-thrifts'); ?></h2>
            <ul style="list-style: disc; margin-left: 20px; color: #444; line-height: 1.8;">
                <li><strong><?php esc_html_e('Parent Categories:', 'ansh-thrifts'); ?></strong> Tops (with T-shirts, Jackets, Hoodies) and Bottoms (with Jeans, Cargo Pants, Trousers).</li>
                <li><strong><?php esc_html_e('Curated Brands:', 'ansh-thrifts'); ?></strong> Carhartt, Levi’s, Nike Vintage, Stüssy, Ralph Lauren, Zara Studio.</li>
                <li><strong><?php esc_html_e('Condition Grading:', 'ansh-thrifts'); ?></strong> Pristine Vintage, Like New, Excellent Pre-Loved, Good Vintage.</li>
                <li><strong><?php esc_html_e('8 Demo Thrift Pieces:', 'ansh-thrifts'); ?></strong> Configured with 1-of-1 inventory quantities and authentic vintage pricing.</li>
            </ul>

            <form method="post" style="margin-top: 25px;">
                <?php wp_nonce_field('ansh_seed_demo_nonce'); ?>
                <button type="submit" name="ansh_run_demo_seed" class="button button-primary button-hero" style="font-weight: bold;">
                    <?php esc_html_e('Seed Demo Thrift Store Data', 'ansh-thrifts'); ?>
                </button>
            </form>
        </div>
    </div>
    <?php
}

function ansh_thrifts_execute_demo_seed() {
    if (!class_exists('WooCommerce')) {
        return;
    }

    // 1. Create Categories: Tops & Bottoms
    $tops_term = term_exists('Tops', 'product_cat');
    if (!$tops_term) {
        $tops_term = wp_insert_term('Tops', 'product_cat', ['slug' => 'tops']);
    }
    $tops_id = is_array($tops_term) ? $tops_term['term_id'] : $tops_term;

    $bottoms_term = term_exists('Bottoms', 'product_cat');
    if (!$bottoms_term) {
        $bottoms_term = wp_insert_term('Bottoms', 'product_cat', ['slug' => 'bottoms']);
    }
    $bottoms_id = is_array($bottoms_term) ? $bottoms_term['term_id'] : $bottoms_term;

    // Subcategories
    $subcats = [
        ['name' => 'Jackets', 'slug' => 'jackets', 'parent' => $tops_id],
        ['name' => 'Hoodies & Sweats', 'slug' => 'hoodies', 'parent' => $tops_id],
        ['name' => 'Graphic Tees', 'slug' => 't-shirts', 'parent' => $tops_id],
        ['name' => 'Vintage Denim', 'slug' => 'jeans', 'parent' => $bottoms_id],
        ['name' => 'Cargo Pants', 'slug' => 'cargo-pants', 'parent' => $bottoms_id],
        ['name' => 'Trousers', 'slug' => 'trousers', 'parent' => $bottoms_id],
    ];
    foreach ($subcats as $sc) {
        if (!term_exists($sc['slug'], 'product_cat')) {
            wp_insert_term($sc['name'], 'product_cat', ['slug' => $sc['slug'], 'parent' => $sc['parent']]);
        }
    }

    // 2. Create Brands
    $brands = ['Carhartt', 'Levi\'s', 'Nike Vintage', 'Stüssy', 'Ralph Lauren', 'Zara Studio'];
    foreach ($brands as $b) {
        if (!term_exists($b, 'product_brand')) {
            wp_insert_term($b, 'product_brand');
        }
    }

    // 3. Create Sample 1-of-1 Products
    $sample_products = [
        [
            'name'      => 'Vintage Carhartt J97 Detroit Jacket (1998)',
            'price'     => 145,
            'cat'       => 'tops',
            'brand'     => 'Carhartt',
            'condition' => 'Excellent Pre-Loved',
            'desc'      => 'Authentic Detroit workwear jacket in classic faded brown duck canvas with blanket lining. Beautiful natural patina and distressing.'
        ],
        [
            'name'      => '1994 Levi’s 501 Original Fit Stone Wash Denim',
            'price'     => 85,
            'cat'       => 'bottoms',
            'brand'     => 'Levi\'s',
            'condition' => 'Pristine Vintage',
            'desc'      => 'Deadstock 90s made-in-USA Levi’s 501. Straight leg silhouette with original red tab and paper patch intact.'
        ],
        [
            'name'      => '90s Nike Center Swoosh Heavyweight Hoodie',
            'price'     => 95,
            'cat'       => 'tops',
            'brand'     => 'Nike Vintage',
            'condition' => 'Like New',
            'desc'      => 'Rare embroidered middle swoosh hoodie in washed charcoal black. Boxy oversized vintage fit.'
        ],
        [
            'name'      => 'Vintage Tactical Multi-Pocket Cargo Trousers',
            'price'     => 78,
            'cat'       => 'bottoms',
            'brand'     => 'Stüssy',
            'condition' => 'Good Vintage',
            'desc'      => 'Heavyweight cotton ripstop parachute cargos with adjustable ankle drawstrings and authentic field wear.'
        ],
        [
            'name'      => 'Ralph Lauren Oversized Oxford Corduroy Shirt',
            'price'     => 62,
            'cat'       => 'tops',
            'brand'     => 'Ralph Lauren',
            'condition' => 'Like New',
            'desc'      => 'Classic 90s wide-wale corduroy button-down in deep olive green with subtle embroidered pony.'
        ],
        [
            'name'      => 'Vintage Distressed Pleated Relaxed Trousers',
            'price'     => 68,
            'cat'       => 'bottoms',
            'brand'     => 'Zara Studio',
            'condition' => 'Pristine Vintage',
            'desc'      => 'High-waisted double-pleated wool blend trousers in warm taupe. Tailored drape with wide leg break.'
        ],
    ];

    foreach ($sample_products as $pdata) {
        // Check if product already exists by title
        $existing = get_page_by_title($pdata['name'], OBJECT, 'product');
        if ($existing) {
            continue;
        }

        $product = new WC_Product_Simple();
        $product->set_name($pdata['name']);
        $product->set_status('publish');
        $product->set_catalog_visibility('visible');
        $product->set_description($pdata['desc']);
        $product->set_short_description('1-of-1 Curated Thrift Archive Piece. Hand-inspected and authenticated.');
        $product->set_regular_price((string) $pdata['price']);
        $product->set_manage_stock(true);
        $product->set_stock_quantity(1); // 1 of 1 thrift piece!
        $product->set_stock_status('instock');

        // Assign Category
        $cat_term = get_term_by('slug', $pdata['cat'], 'product_cat');
        if ($cat_term) {
            $product->set_category_ids([$cat_term->term_id]);
        }

        $new_id = $product->save();

        if ($new_id) {
            // Assign Brand
            wp_set_object_terms($new_id, $pdata['brand'], 'product_brand');
            // Assign Condition
            wp_set_object_terms($new_id, $pdata['condition'], 'product_condition');
        }
    }
}

