<?php
/**
 * Header Template
 *
 * @package Ansh_Thrifts
 * @version 1.0.0
 */

defined('ABSPATH') || exit;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site-wrapper">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'ansh-thrifts'); ?></a>

    <?php 
    // Announcement Bar
    $show_announcement = get_theme_mod('ansh_announcement_enable', true);
    $announcement_text = get_theme_mod('ansh_announcement_text', 'SUSTAINABLE ARCHIVE: WORLDWIDE SHIPPING &bull; FRESH DROPS EVERY SUNDAY 6PM GMT');
    $announcement_link = get_theme_mod('ansh_announcement_link', '');
    if ($show_announcement && !empty($announcement_text)) : 
    ?>
        <div class="announcement-bar">
            <div class="thrift-container">
                <?php if (!empty($announcement_link)) : ?>
                    <a href="<?php echo esc_url($announcement_link); ?>" class="announcement-text"><?php echo wp_kses_post($announcement_text); ?></a>
                <?php else : ?>
                    <span class="announcement-text"><?php echo wp_kses_post($announcement_text); ?></span>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Main Navigation Header -->
    <header id="masthead" class="site-header">
        <div class="thrift-container header-inner">
            <!-- Mobile Menu Toggle -->
            <button type="button" class="mobile-menu-toggle" id="mobile-menu-open-btn" aria-label="<?php esc_attr_e('Open Navigation Menu', 'ansh-thrifts'); ?>" aria-expanded="false" aria-controls="mobile-drawer">
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
                <span class="hamburger-line"></span>
            </button>

            <!-- Brand Logo / Title -->
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="site-title-link">
                        <span class="brand-name"><?php bloginfo('name'); ?></span>
                        <span class="brand-tagline"><?php esc_html_e('ARCHIVE &bull; THRIFT', 'ansh-thrifts'); ?></span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Desktop Primary Navigation -->
            <nav id="site-navigation" class="main-navigation desktop-only" aria-label="<?php esc_attr_e('Primary Navigation', 'ansh-thrifts'); ?>">
                <?php
                if (has_nav_menu('primary-menu')) {
                    wp_nav_menu([
                        'theme_location' => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ]);
                } else {
                    // Fallback to core store sections
                    ?>
                    <ul class="nav-menu">
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'ansh-thrifts'); ?></a></li>
                        <li><a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>"><?php esc_html_e('All Drops', 'ansh-thrifts'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/product-category/tops/')); ?>"><?php esc_html_e('Tops', 'ansh-thrifts'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/product-category/bottoms/')); ?>"><?php esc_html_e('Bottoms', 'ansh-thrifts'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/brands/')); ?>"><?php esc_html_e('Brands', 'ansh-thrifts'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('Our Philosophy', 'ansh-thrifts'); ?></a></li>
                    </ul>
                    <?php
                }
                ?>
            </nav>

            <!-- Header Action Utilities -->
            <div class="header-actions">
                <!-- Search Button -->
                <button type="button" class="header-action-btn search-toggle-btn" id="search-modal-open-btn" aria-label="<?php esc_attr_e('Search products', 'ansh-thrifts'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </button>

                <!-- My Account Link -->
                <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account')); ?>" class="header-action-btn account-link" aria-label="<?php esc_attr_e('My Account', 'ansh-thrifts'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>

                <!-- Cart / Thrift Bag Trigger -->
                <button type="button" class="header-action-btn cart-trigger" id="mini-cart-toggle-btn" aria-label="<?php esc_attr_e('View shopping bag', 'ansh-thrifts'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="cart-badge" id="header-cart-count">
                        <?php echo function_exists('WC') && WC()->cart ? esc_html(WC()->cart->get_cart_contents_count()) : '0'; ?>
                    </span>
                </button>
            </div>
        </div>

        <!-- Category Sub-Navigation Bar -->
        <div class="category-subnav desktop-only">
            <div class="thrift-container category-subnav-inner">
                <a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>" class="cat-pill is-active"><?php esc_html_e('All Collections', 'ansh-thrifts'); ?></a>
                <a href="<?php echo esc_url(home_url('/product-category/tops/')); ?>" class="cat-pill"><?php esc_html_e('Tops (Jackets, Tees, Knits)', 'ansh-thrifts'); ?></a>
                <a href="<?php echo esc_url(home_url('/product-category/bottoms/')); ?>" class="cat-pill"><?php esc_html_e('Bottoms (Denim, Cargos, Trousers)', 'ansh-thrifts'); ?></a>
                <a href="<?php echo esc_url(home_url('/shop/?orderby=date')); ?>" class="cat-pill cat-pill--accent"><?php esc_html_e('&starf; Weekly Sunday Drop', 'ansh-thrifts'); ?></a>
                <a href="<?php echo esc_url(home_url('/shop/?on_sale=1')); ?>" class="cat-pill"><?php esc_html_e('Vintage Archives On Sale', 'ansh-thrifts'); ?></a>
            </div>
        </div>
    </header>

    <!-- Mobile Slide-out Drawer Menu -->
    <div id="mobile-drawer" class="mobile-drawer" aria-hidden="true">
        <div class="drawer-overlay" id="mobile-drawer-overlay"></div>
        <div class="drawer-panel">
            <div class="drawer-header">
                <span class="drawer-title"><?php esc_html_e('MENU', 'ansh-thrifts'); ?></span>
                <button type="button" class="drawer-close-btn" id="mobile-drawer-close-btn" aria-label="<?php esc_attr_e('Close Menu', 'ansh-thrifts'); ?>">&times;</button>
            </div>
            <div class="drawer-body">
                <nav class="mobile-nav">
                    <?php
                    if (has_nav_menu('primary-menu')) {
                        wp_nav_menu([
                            'theme_location' => 'primary-menu',
                            'menu_class'     => 'mobile-nav-list',
                            'container'      => false,
                        ]);
                    } else {
                        ?>
                        <ul class="mobile-nav-list">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop')); ?>"><?php esc_html_e('All Drops', 'ansh-thrifts'); ?></a></li>
                            <li class="menu-heading"><?php esc_html_e('CATEGORIES', 'ansh-thrifts'); ?></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/tops/')); ?>">&mdash; <?php esc_html_e('Tops & Outerwear', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/product-category/bottoms/')); ?>">&mdash; <?php esc_html_e('Bottoms & Denim', 'ansh-thrifts'); ?></a></li>
                            <li class="menu-heading"><?php esc_html_e('STORE INFO', 'ansh-thrifts'); ?></li>
                            <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('Our Philosophy', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>"><?php esc_html_e('Contact & Showroom', 'ansh-thrifts'); ?></a></li>
                            <li><a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/my-account')); ?>"><?php esc_html_e('My Account / Orders', 'ansh-thrifts'); ?></a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </nav>
            </div>
        </div>
    </div>

    <!-- Search Modal / Overlay -->
    <div id="search-modal" class="search-modal" aria-hidden="true">
        <div class="search-modal-overlay" id="search-modal-close-overlay"></div>
        <div class="search-modal-container">
            <div class="search-modal-top">
                <span class="search-badge"><?php esc_html_e('SEARCH VINTAGE ARCHIVE', 'ansh-thrifts'); ?></span>
                <button type="button" class="search-close-btn" id="search-modal-close-btn" aria-label="<?php esc_attr_e('Close search', 'ansh-thrifts'); ?>">&times;</button>
            </div>
            <form role="search" method="get" class="search-form-editorial" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="hidden" name="post_type" value="product">
                <input type="search" class="search-input-field" placeholder="<?php esc_attr_e('Search Nike, Carhartt, vintage leather, cargos...', 'ansh-thrifts'); ?>" value="<?php echo get_search_query(); ?>" name="s" autofocus>
                <button type="submit" class="search-submit-btn" aria-label="<?php esc_attr_e('Submit search', 'ansh-thrifts'); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>
            <div class="search-quick-tags">
                <span class="quick-label"><?php esc_html_e('Popular searches:', 'ansh-thrifts'); ?></span>
                <a href="<?php echo esc_url(home_url('/?s=jacket&post_type=product')); ?>">Leather Jacket</a>
                <a href="<?php echo esc_url(home_url('/?s=cargo&post_type=product')); ?>">Cargo Pants</a>
                <a href="<?php echo esc_url(home_url('/?s=hoodie&post_type=product')); ?>">Vintage Hoodie</a>
                <a href="<?php echo esc_url(home_url('/?s=denim&post_type=product')); ?>">501 Denim</a>
            </div>
        </div>
    </div>

    <!-- Slide-Out Cart / Bag Drawer -->
    <div id="cart-drawer" class="cart-drawer" aria-hidden="true">
        <div class="drawer-overlay" id="cart-drawer-overlay"></div>
        <div class="drawer-panel cart-drawer-panel">
            <div class="drawer-header">
                <div class="cart-header-title">
                    <span class="drawer-title"><?php esc_html_e('YOUR THRIFT BAG', 'ansh-thrifts'); ?></span>
                </div>
                <button type="button" class="drawer-close-btn" id="cart-drawer-close-btn" aria-label="<?php esc_attr_e('Close bag', 'ansh-thrifts'); ?>">&times;</button>
            </div>
            <div class="drawer-body cart-drawer-body" id="drawer-cart-items-wrapper">
                <?php ansh_thrifts_render_cart_drawer_contents(); ?>
            </div>
        </div>
    </div>

