<?php
/**
 * Filter Bar for WooCommerce Shop & Category Archives
 *
 * @package Ansh_Thrifts
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

// Current query params
$current_brand     = isset($_GET['brand']) ? sanitize_text_field($_GET['brand']) : '';
$current_condition = isset($_GET['condition']) ? sanitize_text_field($_GET['condition']) : '';
$current_instock   = isset($_GET['in_stock']) ? sanitize_text_field($_GET['in_stock']) : '';
$current_min_price = isset($_GET['min_price']) ? floatval($_GET['min_price']) : '';
$current_max_price = isset($_GET['max_price']) ? floatval($_GET['max_price']) : '';
$current_orderby   = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'menu_order';

// Get base URL without filter params
$current_url = strtok($_SERVER["REQUEST_URI"], '?');

// Fetch dynamic brands
$all_brands = get_terms([
    'taxonomy'   => 'product_brand',
    'hide_empty' => true,
]);

// Fetch dynamic conditions
$all_conditions = get_terms([
    'taxonomy'   => 'product_condition',
    'hide_empty' => true,
]);

// Fetch Tops & Bottoms categories
$tops_cat    = get_term_by('slug', 'tops', 'product_cat');
$bottoms_cat = get_term_by('slug', 'bottoms', 'product_cat');
?>

<div class="thrift-filter-bar">
    <div class="filter-bar-header">
        <div class="filter-categories-nav">
            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="filter-pill <?php echo (!is_product_category() && empty($current_brand)) ? 'is-active' : ''; ?>">
                <?php esc_html_e('All Archive', 'ansh-thrifts'); ?>
            </a>
            <?php if ($tops_cat && !is_wp_error($tops_cat)) : ?>
                <a href="<?php echo esc_url(get_term_link($tops_cat)); ?>" class="filter-pill <?php echo (is_product_category('tops') || (is_product_category() && term_is_ancestor_of($tops_cat->term_id, get_queried_object_id(), 'product_cat'))) ? 'is-active' : ''; ?>">
                    <?php esc_html_e('Tops', 'ansh-thrifts'); ?>
                </a>
            <?php endif; ?>
            <?php if ($bottoms_cat && !is_wp_error($bottoms_cat)) : ?>
                <a href="<?php echo esc_url(get_term_link($bottoms_cat)); ?>" class="filter-pill <?php echo (is_product_category('bottoms') || (is_product_category() && term_is_ancestor_of($bottoms_cat->term_id, get_queried_object_id(), 'product_cat'))) ? 'is-active' : ''; ?>">
                    <?php esc_html_e('Bottoms', 'ansh-thrifts'); ?>
                </a>
            <?php endif; ?>
        </div>

        <button type="button" class="filter-drawer-toggle-btn" id="filter-drawer-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
            <span><?php esc_html_e('Refine & Filter', 'ansh-thrifts'); ?></span>
        </button>
    </div>

    <!-- Active Filter Tags (if any are active) -->
    <?php if (!empty($current_brand) || !empty($current_condition) || !empty($current_instock) || !empty($current_min_price) || !empty($current_max_price)) : ?>
        <div class="active-filters-chips">
            <span class="active-filters-label"><?php esc_html_e('Active Filters:', 'ansh-thrifts'); ?></span>
            <?php if (!empty($current_brand)) : ?>
                <span class="filter-chip">
                    <?php echo esc_html(sprintf(__('Brand: %s', 'ansh-thrifts'), $current_brand)); ?>
                    <a href="<?php echo esc_url(remove_query_arg('brand')); ?>" class="chip-remove">&times;</a>
                </span>
            <?php endif; ?>
            <?php if (!empty($current_condition)) : ?>
                <span class="filter-chip">
                    <?php echo esc_html(sprintf(__('Condition: %s', 'ansh-thrifts'), $current_condition)); ?>
                    <a href="<?php echo esc_url(remove_query_arg('condition')); ?>" class="chip-remove">&times;</a>
                </span>
            <?php endif; ?>
            <?php if (!empty($current_instock)) : ?>
                <span class="filter-chip">
                    <?php esc_html_e('In Stock Only', 'ansh-thrifts'); ?>
                    <a href="<?php echo esc_url(remove_query_arg('in_stock')); ?>" class="chip-remove">&times;</a>
                </span>
            <?php endif; ?>
            <a href="<?php echo esc_url($current_url); ?>" class="clear-all-filters-btn">
                <?php esc_html_e('Reset All', 'ansh-thrifts'); ?>
            </a>
        </div>
    <?php endif; ?>
</div>

<!-- Slide-Out Filter Drawer -->
<div id="filter-drawer" class="filter-drawer" aria-hidden="true">
    <div class="drawer-overlay" id="filter-drawer-overlay"></div>
    <div class="drawer-panel filter-drawer-panel">
        <div class="drawer-header">
            <span class="drawer-title"><?php esc_html_e('FILTER ARCHIVE', 'ansh-thrifts'); ?></span>
            <button type="button" class="drawer-close-btn" id="filter-drawer-close-btn">&times;</button>
        </div>
        <form method="get" action="<?php echo esc_url($current_url); ?>" class="filter-form">
            <?php if (isset($_GET['s'])) : ?>
                <input type="hidden" name="s" value="<?php echo esc_attr($_GET['s']); ?>">
            <?php endif; ?>
            <?php if (isset($_GET['post_type'])) : ?>
                <input type="hidden" name="post_type" value="<?php echo esc_attr($_GET['post_type']); ?>">
            <?php endif; ?>

            <!-- Brand Filter -->
            <?php if (!empty($all_brands) && !is_wp_error($all_brands)) : ?>
                <div class="filter-group">
                    <label class="filter-group-title"><?php esc_html_e('Brand', 'ansh-thrifts'); ?></label>
                    <select name="brand" class="filter-select">
                        <option value=""><?php esc_html_e('All Brands', 'ansh-thrifts'); ?></option>
                        <?php foreach ($all_brands as $brand_term) : ?>
                            <option value="<?php echo esc_attr($brand_term->slug); ?>" <?php selected($current_brand, $brand_term->slug); ?>>
                                <?php echo esc_html($brand_term->name); ?> (<?php echo esc_html($brand_term->count); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <!-- Item Condition Filter -->
            <?php if (!empty($all_conditions) && !is_wp_error($all_conditions)) : ?>
                <div class="filter-group">
                    <label class="filter-group-title"><?php esc_html_e('Condition Grading', 'ansh-thrifts'); ?></label>
                    <select name="condition" class="filter-select">
                        <option value=""><?php esc_html_e('All Conditions', 'ansh-thrifts'); ?></option>
                        <?php foreach ($all_conditions as $cond_term) : ?>
                            <option value="<?php echo esc_attr($cond_term->slug); ?>" <?php selected($current_condition, $cond_term->slug); ?>>
                                <?php echo esc_html($cond_term->name); ?> (<?php echo esc_html($cond_term->count); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

            <!-- Availability (In Stock) -->
            <div class="filter-group">
                <label class="filter-group-title"><?php esc_html_e('Availability', 'ansh-thrifts'); ?></label>
                <label class="filter-checkbox-label">
                    <input type="checkbox" name="in_stock" value="1" <?php checked($current_instock, '1'); ?>>
                    <span><?php esc_html_e('Available pieces only (exclude sold archives)', 'ansh-thrifts'); ?></span>
                </label>
            </div>

            <!-- Price Range -->
            <div class="filter-group">
                <label class="filter-group-title"><?php esc_html_e('Price Range', 'ansh-thrifts'); ?></label>
                <div class="price-input-row">
                    <input type="number" name="min_price" placeholder="<?php esc_attr_e('Min', 'ansh-thrifts'); ?>" value="<?php echo esc_attr($current_min_price); ?>" class="filter-num-input" min="0">
                    <span>&ndash;</span>
                    <input type="number" name="max_price" placeholder="<?php esc_attr_e('Max', 'ansh-thrifts'); ?>" value="<?php echo esc_attr($current_max_price); ?>" class="filter-num-input" min="0">
                </div>
            </div>

            <!-- Sort By -->
            <div class="filter-group">
                <label class="filter-group-title"><?php esc_html_e('Sort By', 'ansh-thrifts'); ?></label>
                <select name="orderby" class="filter-select">
                    <option value="date" <?php selected($current_orderby, 'date'); ?>><?php esc_html_e('Latest Drops', 'ansh-thrifts'); ?></option>
                    <option value="price" <?php selected($current_orderby, 'price'); ?>><?php esc_html_e('Price: Low to High', 'ansh-thrifts'); ?></option>
                    <option value="price-desc" <?php selected($current_orderby, 'price-desc'); ?>><?php esc_html_e('Price: High to Low', 'ansh-thrifts'); ?></option>
                    <option value="popularity" <?php selected($current_orderby, 'popularity'); ?>><?php esc_html_e('Most Popular', 'ansh-thrifts'); ?></option>
                </select>
            </div>

            <div class="filter-form-actions">
                <button type="submit" class="thrift-btn thrift-btn--dark w-full">
                    <?php esc_html_e('Apply Filters', 'ansh-thrifts'); ?>
                </button>
                <a href="<?php echo esc_url($current_url); ?>" class="thrift-btn thrift-btn--outline w-full text-center">
                    <?php esc_html_e('Clear Filters', 'ansh-thrifts'); ?>
                </a>
            </div>
        </form>
    </div>
</div>

