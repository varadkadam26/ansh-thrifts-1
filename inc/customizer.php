<?php
/**
 * Ansh Thrifts - Theme Customizer Visual Controls
 * Provides complete visual styling controls with Live Preview support.
 *
 * @package Ansh_Thrifts
 * @version 1.1.0
 */

defined('ABSPATH') || exit;

function ansh_thrifts_customize_register_visual_system($wp_customize) {

    // Main Theme Options Panel
    $wp_customize->add_panel('ansh_visual_panel', [
        'title'       => __('Ansh Thrifts Visual Settings', 'ansh-thrifts'),
        'description' => __('Visually customize colors, typography, buttons, header, footer, animations and WooCommerce displays.', 'ansh-thrifts'),
        'priority'    => 10,
    ]);

    // -------------------------------------------------------------
    // SECTION 1: COLORS & BACKGROUNDS
    // -------------------------------------------------------------
    $wp_customize->add_section('ansh_colors_section', [
        'title'    => __('Colors & Backgrounds', 'ansh-thrifts'),
        'panel'    => 'ansh_visual_panel',
        'priority' => 10,
    ]);

    // Main Cream Background
    $wp_customize->add_setting('ansh_color_bg_cream', [
        'default'           => '#FAF8F5',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ansh_color_bg_cream', [
        'label'    => __('Primary Page Background (Cream)', 'ansh-thrifts'),
        'section'  => 'ansh_colors_section',
    ]));

    // Sand / Secondary Background
    $wp_customize->add_setting('ansh_color_bg_sand', [
        'default'           => '#F3EFEA',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ansh_color_bg_sand', [
        'label'    => __('Secondary / Alternate Background (Sand)', 'ansh-thrifts'),
        'section'  => 'ansh_colors_section',
    ]));

    // Primary Text Color
    $wp_customize->add_setting('ansh_color_text_primary', [
        'default'           => '#121212',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ansh_color_text_primary', [
        'label'    => __('Primary Text & Deep Charcoal', 'ansh-thrifts'),
        'section'  => 'ansh_colors_section',
    ]));

    // Accent Earth / Terracotta
    $wp_customize->add_setting('ansh_color_accent_earth', [
        'default'           => '#9E5A3F',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ansh_color_accent_earth', [
        'label'    => __('Earthy Accent Color (Terracotta/Rust)', 'ansh-thrifts'),
        'section'  => 'ansh_colors_section',
    ]));

    // Subtle Border Color
    $wp_customize->add_setting('ansh_color_border', [
        'default'           => '#E8E2D8',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ansh_color_border', [
        'label'    => __('Divider & Border Color', 'ansh-thrifts'),
        'section'  => 'ansh_colors_section',
    ]));

    // -------------------------------------------------------------
    // SECTION 2: TYPOGRAPHY & SIZING
    // -------------------------------------------------------------
    $wp_customize->add_section('ansh_typography_section', [
        'title'    => __('Typography & Font Sizes', 'ansh-thrifts'),
        'panel'    => 'ansh_visual_panel',
        'priority' => 20,
    ]);

    // Heading Font Family
    $wp_customize->add_setting('ansh_font_heading', [
        'default'           => 'Syne',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_font_heading', [
        'label'       => __('Heading Font Family', 'ansh-thrifts'),
        'description' => __('Select font family for headlines and section titles.', 'ansh-thrifts'),
        'section'     => 'ansh_typography_section',
        'type'        => 'select',
        'choices'     => [
            'Syne'              => 'Syne (Modern Editorial Sans)',
            'Playfair Display'  => 'Playfair Display (Luxury Editorial Serif)',
            'Plus Jakarta Sans' => 'Plus Jakarta Sans (Minimal Geometric Sans)',
            'Georgia'           => 'Georgia (Classic Editorial)',
            'system-ui'         => 'System Native UI',
        ],
    ]);

    // Body Font Family
    $wp_customize->add_setting('ansh_font_body', [
        'default'           => 'Plus Jakarta Sans',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_font_body', [
        'label'   => __('Body Font Family', 'ansh-thrifts'),
        'section' => 'ansh_typography_section',
        'type'    => 'select',
        'choices' => [
            'Plus Jakarta Sans' => 'Plus Jakarta Sans',
            'Inter'             => 'Inter',
            'Helvetica'         => 'Helvetica / Arial',
            'system-ui'         => 'System Native UI',
        ],
    ]);

    // Base Body Font Size (px)
    $wp_customize->add_setting('ansh_font_size_body', [
        'default'           => 16,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_font_size_body', [
        'label'       => __('Body Font Size (px)', 'ansh-thrifts'),
        'section'     => 'ansh_typography_section',
        'type'        => 'number',
        'input_attrs' => ['min' => 12, 'max' => 22, 'step' => 1],
    ]);

    // Heading Line Height
    $wp_customize->add_setting('ansh_heading_line_height', [
        'default'           => '1.15',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_heading_line_height', [
        'label'       => __('Heading Line Height', 'ansh-thrifts'),
        'section'     => 'ansh_typography_section',
        'type'        => 'select',
        'choices'     => [
            '1.05' => 'Ultra Tight (1.05)',
            '1.15' => 'Standard Editorial (1.15)',
            '1.25' => 'Relaxed (1.25)',
        ],
    ]);

    // -------------------------------------------------------------
    // SECTION 3: BUTTONS & CTAS
    // -------------------------------------------------------------
    $wp_customize->add_section('ansh_buttons_section', [
        'title'    => __('Buttons & Call-to-Actions', 'ansh-thrifts'),
        'panel'    => 'ansh_visual_panel',
        'priority' => 30,
    ]);

    // Primary Button Background
    $wp_customize->add_setting('ansh_btn_bg', [
        'default'           => '#121212',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ansh_btn_bg', [
        'label'   => __('Primary Button Background', 'ansh-thrifts'),
        'section' => 'ansh_buttons_section',
    ]));

    // Primary Button Text Color
    $wp_customize->add_setting('ansh_btn_text_color', [
        'default'           => '#FAF8F5',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ansh_btn_text_color', [
        'label'   => __('Primary Button Text Color', 'ansh-thrifts'),
        'section' => 'ansh_buttons_section',
    ]));

    // Button Shape / Border Radius
    $wp_customize->add_setting('ansh_btn_radius', [
        'default'           => 2,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_btn_radius', [
        'label'       => __('Button Corner Radius (px)', 'ansh-thrifts'),
        'description' => __('Set to 2 for crisp editorial edges, or 9999 for rounded pill buttons.', 'ansh-thrifts'),
        'section'     => 'ansh_buttons_section',
        'type'        => 'number',
        'input_attrs' => ['min' => 0, 'max' => 50, 'step' => 1],
    ]);

    // Button Text Transform
    $wp_customize->add_setting('ansh_btn_transform', [
        'default'           => 'uppercase',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_btn_transform', [
        'label'   => __('Button Text Style', 'ansh-thrifts'),
        'section' => 'ansh_buttons_section',
        'type'    => 'select',
        'choices' => [
            'uppercase'  => 'UPPERCASE (Editorial Fashion)',
            'capitalize' => 'Capitalize First Letters',
            'none'       => 'Normal Text',
        ],
    ]);

    // -------------------------------------------------------------
    // SECTION 4: GLOBAL LAYOUT, SPACING & RADIUS
    // -------------------------------------------------------------
    $wp_customize->add_section('ansh_layout_section', [
        'title'    => __('Layout, Spacing & Container', 'ansh-thrifts'),
        'panel'    => 'ansh_visual_panel',
        'priority' => 40,
    ]);

    // Container Max Width (px)
    $wp_customize->add_setting('ansh_container_width', [
        'default'           => 1380,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_container_width', [
        'label'       => __('Max Container Width (px)', 'ansh-thrifts'),
        'section'     => 'ansh_layout_section',
        'type'        => 'number',
        'input_attrs' => ['min' => 1000, 'max' => 1800, 'step' => 20],
    ]);

    // Global Element Border Radius (px)
    $wp_customize->add_setting('ansh_global_radius', [
        'default'           => 2,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_global_radius', [
        'label'       => __('Card & Element Border Radius (px)', 'ansh-thrifts'),
        'section'     => 'ansh_layout_section',
        'type'        => 'number',
        'input_attrs' => ['min' => 0, 'max' => 24, 'step' => 1],
    ]);

    // Section Padding (Vertical)
    $wp_customize->add_setting('ansh_section_padding', [
        'default'           => 80,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_section_padding', [
        'label'       => __('Section Vertical Spacing (px)', 'ansh-thrifts'),
        'section'     => 'ansh_layout_section',
        'type'        => 'number',
        'input_attrs' => ['min' => 40, 'max' => 140, 'step' => 10],
    ]);

    // -------------------------------------------------------------
    // SECTION 5: ANIMATIONS & MOTION
    // -------------------------------------------------------------
    $wp_customize->add_section('ansh_animations_section', [
        'title'    => __('Animations & Motion', 'ansh-thrifts'),
        'panel'    => 'ansh_visual_panel',
        'priority' => 50,
    ]);

    // Enable Smooth Page Transitions & Drawer Animations
    $wp_customize->add_setting('ansh_enable_animations', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('ansh_enable_animations', [
        'label'   => __('Enable Smooth Interface Animations', 'ansh-thrifts'),
        'section' => 'ansh_animations_section',
        'type'    => 'checkbox',
    ]);

    // Enable Product Image Hover Zoom
    $wp_customize->add_setting('ansh_enable_hover_zoom', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_enable_hover_zoom', [
        'label'   => __('Enable Product Card Image Hover Zoom', 'ansh-thrifts'),
        'section' => 'ansh_animations_section',
        'type'    => 'checkbox',
    ]);

    // -------------------------------------------------------------
    // SECTION 6: HEADER & ANNOUNCEMENT BAR
    // -------------------------------------------------------------
    $wp_customize->add_section('ansh_header_builder_section', [
        'title'    => __('Header & Announcement Bar', 'ansh-thrifts'),
        'panel'    => 'ansh_visual_panel',
        'priority' => 60,
    ]);

    // Announcement Background
    $wp_customize->add_setting('ansh_announcement_bg', [
        'default'           => '#121212',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ansh_announcement_bg', [
        'label'   => __('Announcement Bar Background', 'ansh-thrifts'),
        'section' => 'ansh_header_builder_section',
    ]));

    // Announcement Text Color
    $wp_customize->add_setting('ansh_announcement_text_color', [
        'default'           => '#FAF8F5',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ansh_announcement_text_color', [
        'label'   => __('Announcement Bar Text Color', 'ansh-thrifts'),
        'section' => 'ansh_header_builder_section',
    ]));

    // Header Layout Style
    $wp_customize->add_setting('ansh_header_layout', [
        'default'           => 'classic',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('ansh_header_layout', [
        'label'   => __('Header Layout Arrangement', 'ansh-thrifts'),
        'section' => 'ansh_header_builder_section',
        'type'    => 'select',
        'choices' => [
            'classic'  => 'Left Logo & Center Menu (Classic Editorial)',
            'centered' => 'Centered Logo with Split Navigation',
        ],
    ]);

    // -------------------------------------------------------------
    // SECTION 7: WOOCOMMERCE PRODUCT CARDS & GRID
    // -------------------------------------------------------------
    $wp_customize->add_section('ansh_wc_design_section', [
        'title'    => __('WooCommerce Product Grid & Cards', 'ansh-thrifts'),
        'panel'    => 'ansh_visual_panel',
        'priority' => 70,
    ]);

    // Product Grid Columns (Desktop)
    $wp_customize->add_setting('ansh_wc_columns_desktop', [
        'default'           => 4,
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_wc_columns_desktop', [
        'label'   => __('Product Grid Columns (Desktop)', 'ansh-thrifts'),
        'section' => 'ansh_wc_design_section',
        'type'    => 'select',
        'choices' => [
            2 => '2 Columns (Large Editorial Showcase)',
            3 => '3 Columns (Balanced Showcase)',
            4 => '4 Columns (Standard Catalog)',
            5 => '5 Columns (Dense Archive)',
        ],
    ]);

    // Product Card Image Aspect Ratio
    $wp_customize->add_setting('ansh_wc_card_ratio', [
        'default'           => '4/5',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('ansh_wc_card_ratio', [
        'label'   => __('Product Image Ratio', 'ansh-thrifts'),
        'section' => 'ansh_wc_design_section',
        'type'    => 'select',
        'choices' => [
            '4/5' => '4:5 (Editorial Fashion Portrait - Recommended)',
            '1/1' => '1:1 (Square)',
            '3/4' => '3:4 (Tall Portrait)',
        ],
    ]);

    // Show / Hide 1 of 1 Badge
    $wp_customize->add_setting('ansh_wc_show_1of1_badge', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('ansh_wc_show_1of1_badge', [
        'label'   => __('Show "1 OF 1" Rarity Badge on thrift items', 'ansh-thrifts'),
        'section' => 'ansh_wc_design_section',
        'type'    => 'checkbox',
    ]);

    // Show / Hide Condition Badge
    $wp_customize->add_setting('ansh_wc_show_condition_badge', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('ansh_wc_show_condition_badge', [
        'label'   => __('Show Condition Badge on Product Cards', 'ansh-thrifts'),
        'section' => 'ansh_wc_design_section',
        'type'    => 'checkbox',
    ]);

    // Show / Hide Brand Name
    $wp_customize->add_setting('ansh_wc_show_brand', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('ansh_wc_show_brand', [
        'label'   => __('Show Brand Name on Product Cards', 'ansh-thrifts'),
        'section' => 'ansh_wc_design_section',
        'type'    => 'checkbox',
    ]);

    // Quick Add Button on Card
    $wp_customize->add_setting('ansh_wc_enable_quick_add', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('ansh_wc_enable_quick_add', [
        'label'   => __('Enable Quick Add to Bag on Card Hover', 'ansh-thrifts'),
        'section' => 'ansh_wc_design_section',
        'type'    => 'checkbox',
    ]);

    // -------------------------------------------------------------
    // SECTION 8: FOOTER & SOCIAL MEDIA
    // -------------------------------------------------------------
    $wp_customize->add_section('ansh_footer_builder_section', [
        'title'    => __('Footer & Social Links', 'ansh-thrifts'),
        'panel'    => 'ansh_visual_panel',
        'priority' => 80,
    ]);

    // Footer Background
    $wp_customize->add_setting('ansh_footer_bg', [
        'default'           => '#121212',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'ansh_footer_bg', [
        'label'   => __('Footer Background Color', 'ansh-thrifts'),
        'section' => 'ansh_footer_builder_section',
    ]));

    // Show Newsletter Section
    $wp_customize->add_setting('ansh_footer_show_newsletter', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('ansh_footer_show_newsletter', [
        'label'   => __('Show Weekly Drop Newsletter Section', 'ansh-thrifts'),
        'section' => 'ansh_footer_builder_section',
        'type'    => 'checkbox',
    ]);
}
add_action('customize_register', 'ansh_thrifts_customize_register_visual_system', 15);

/**
 * Enqueue Live Preview Script for instantaneous visual feedback
 */
function ansh_thrifts_customize_preview_js() {
    wp_enqueue_script(
        'ansh-customizer-preview',
        get_template_directory_uri() . '/assets/js/customize-preview.js',
        ['customize-preview'],
        ANSH_THRIFTS_VERSION,
        true
    );
}
add_action('customize_preview_init', 'ansh_thrifts_customize_preview_js');

/**
 * Output Dynamic CSS Variables generated from Customizer settings
 */
function ansh_thrifts_output_customizer_css() {
    $bg_cream        = get_theme_mod('ansh_color_bg_cream', '#FAF8F5');
    $bg_sand         = get_theme_mod('ansh_color_bg_sand', '#F3EFEA');
    $text_primary    = get_theme_mod('ansh_color_text_primary', '#121212');
    $accent_earth    = get_theme_mod('ansh_color_accent_earth', '#9E5A3F');
    $border_color    = get_theme_mod('ansh_color_border', '#E8E2D8');

    $font_heading    = get_theme_mod('ansh_font_heading', 'Syne');
    $font_body       = get_theme_mod('ansh_font_body', 'Plus Jakarta Sans');
    $font_size_body  = get_theme_mod('ansh_font_size_body', 16);
    $line_height_hd  = get_theme_mod('ansh_heading_line_height', '1.15');

    $btn_bg          = get_theme_mod('ansh_btn_bg', '#121212');
    $btn_text        = get_theme_mod('ansh_btn_text_color', '#FAF8F5');
    $btn_radius      = get_theme_mod('ansh_btn_radius', 2);
    $btn_transform   = get_theme_mod('ansh_btn_transform', 'uppercase');

    $container_w     = get_theme_mod('ansh_container_width', 1380);
    $global_radius   = get_theme_mod('ansh_global_radius', 2);
    $sec_padding     = get_theme_mod('ansh_section_padding', 80);

    $announcement_bg = get_theme_mod('ansh_announcement_bg', '#121212');
    $announcement_tx = get_theme_mod('ansh_announcement_text_color', '#FAF8F5');
    $footer_bg       = get_theme_mod('ansh_footer_bg', '#121212');

    $columns_desktop = get_theme_mod('ansh_wc_columns_desktop', 4);
    $card_ratio      = get_theme_mod('ansh_wc_card_ratio', '4/5');
    $hover_zoom      = get_theme_mod('ansh_enable_hover_zoom', true);

    $custom_css = "
    :root {
        --bg-cream: {$bg_cream};
        --bg-sand: {$bg_sand};
        --text-primary: {$text_primary};
        --accent-earth: {$accent_earth};
        --border-subtle: {$border_color};
        --font-heading: '{$font_heading}', sans-serif;
        --font-body: '{$font_body}', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        --font-size-base: {$font_size_body}px;
        --container-max: {$container_w}px;
        --radius-sm: {$global_radius}px;
        --btn-radius: {$btn_radius}px;
    }
    body {
        font-size: var(--font-size-base);
    }
    .section-heading, .hero-title, .split-cat-title, .about-title, .newsletter-heading {
        line-height: {$line_height_hd};
    }
    .thrift-btn, .woocommerce div.product form.cart .button {
        text-transform: {$btn_transform};
        border-radius: var(--btn-radius);
    }
    .thrift-btn--dark {
        background-color: {$btn_bg};
        color: {$btn_text};
        border-color: {$btn_bg};
    }
    .announcement-bar {
        background-color: {$announcement_bg};
        color: {$announcement_tx};
    }
    .site-footer {
        background-color: {$footer_bg};
    }
    .section-py {
        padding-top: {$sec_padding}px;
        padding-bottom: {$sec_padding}px;
    }
    .products-editorial-grid {
        grid-template-columns: repeat({$columns_desktop}, 1fr);
    }
    .product-card__media {
        aspect-ratio: {$card_ratio};
    }
    ";

    if (!$hover_zoom) {
        $custom_css .= "
        .product-card:hover .product-card__img--primary,
        .product-card:hover .product-card__img--hover {
            transform: none !important;
        }
        ";
    }

    wp_add_inline_style('ansh-thrifts-main', $custom_css);
}
add_action('wp_enqueue_scripts', 'ansh_thrifts_output_customizer_css', 20);

