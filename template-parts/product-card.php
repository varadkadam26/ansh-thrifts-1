<?php
/**
 * Template part for displaying a thrift product card
 * Respects live WooCommerce Design settings from WordPress Customizer.
 *
 * @package Ansh_Thrifts
 * @version 1.1.0
 */

defined('ABSPATH') || exit;

global $product;

if (empty($product) || !$product->is_visible()) {
    return;
}

$product_id      = $product->get_id();
$brand_name      = ansh_thrifts_get_product_brand($product_id);
$condition_name  = ansh_thrifts_get_product_condition($product_id);
$is_in_stock     = $product->is_in_stock();
$stock_quantity  = $product->get_stock_quantity();
$is_one_of_one   = ($product->managing_stock() && $stock_quantity === 1);
$gallery_ids     = $product->get_gallery_image_ids();
$has_hover_image = !empty($gallery_ids);
$hover_img_url   = $has_hover_image ? wp_get_attachment_image_url($gallery_ids[0], 'thrift-card') : '';

// Visual Customizer Controls
$show_1of1      = get_theme_mod('ansh_wc_show_1of1_badge', true);
$show_condition = get_theme_mod('ansh_wc_show_condition_badge', true);
$show_brand     = get_theme_mod('ansh_wc_show_brand', true);
$show_quick_add = get_theme_mod('ansh_wc_enable_quick_add', true);
?>

<div class="product-card <?php echo esc_attr(!$is_in_stock ? 'is-out-of-stock' : ''); ?>" data-product-id="<?php echo esc_attr($product_id); ?>">
    <div class="product-card__media">
        <a href="<?php echo esc_url($product->get_permalink()); ?>" class="product-card__link">
            <?php 
            if (has_post_thumbnail($product_id)) {
                echo get_the_post_thumbnail($product_id, 'thrift-card', [
                    'class' => 'product-card__img product-card__img--primary',
                    'loading' => 'lazy',
                    'alt' => esc_attr($product->get_name())
                ]);
            } else {
                $placeholder = function_exists('wc_placeholder_img_src') ? wc_placeholder_img_src('thrift-card') : '';
                echo '<img src="' . esc_url($placeholder) . '" alt="' . esc_attr__('Placeholder', 'ansh-thrifts') . '" class="product-card__img product-card__img--primary">';
            }

            if ($has_hover_image && $hover_img_url) {
                echo '<img src="' . esc_url($hover_img_url) . '" alt="' . esc_attr($product->get_name()) . '" class="product-card__img product-card__img--hover" loading="lazy">';
            }
            ?>
        </a>

        <!-- Badges & Indicators -->
        <div class="product-card__badges">
            <?php if (!$is_in_stock) : ?>
                <span class="badge badge--sold"><?php esc_html_e('ARCHIVED / SOLD', 'ansh-thrifts'); ?></span>
            <?php else : ?>
                <?php if ($is_one_of_one && $show_1of1) : ?>
                    <span class="badge badge--rare"><?php esc_html_e('1 OF 1', 'ansh-thrifts'); ?></span>
                <?php endif; ?>
                <?php if ($product->is_on_sale()) : ?>
                    <span class="badge badge--sale"><?php esc_html_e('SALE', 'ansh-thrifts'); ?></span>
                <?php endif; ?>
                <?php if (!empty($condition_name) && $show_condition) : ?>
                    <span class="badge badge--condition"><?php echo esc_html($condition_name); ?></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <!-- Quick Action Floating Button -->
        <?php if ($is_in_stock && $show_quick_add) : ?>
            <div class="product-card__quick-actions">
                <?php if ($product->is_type('simple')) : ?>
                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" 
                       data-quantity="1" 
                       class="quick-add-btn ajax_add_to_cart add_to_cart_button" 
                       data-product_id="<?php echo esc_attr($product_id); ?>" 
                       data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" 
                       aria-label="<?php esc_attr_e('Quick add to bag', 'ansh-thrifts'); ?>">
                        + <?php esc_html_e('Add to Bag', 'ansh-thrifts'); ?>
                    </a>
                <?php else : ?>
                    <a href="<?php echo esc_url($product->get_permalink()); ?>" class="quick-add-btn">
                        <?php esc_html_e('Select Size', 'ansh-thrifts'); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="product-card__content">
        <?php if (!empty($brand_name) && $show_brand) : ?>
            <span class="product-card__brand"><?php echo esc_html($brand_name); ?></span>
        <?php endif; ?>

        <h3 class="product-card__title">
            <a href="<?php echo esc_url($product->get_permalink()); ?>">
                <?php echo esc_html($product->get_name()); ?>
            </a>
        </h3>

        <div class="product-card__price">
            <?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
    </div>
</div>
