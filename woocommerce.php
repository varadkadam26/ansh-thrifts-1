<?php
/**
 * WooCommerce Fallback Template
 *
 * @package Ansh_Thrifts
 * @version 1.0.0
 */

defined('ABSPATH') || exit;

get_header();
?>

<main id="primary" class="site-main woocommerce-main">
    <div class="thrift-container">
        <?php woocommerce_content(); ?>
    </div>
</main>

<?php
get_footer();

