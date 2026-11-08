/**
 * Live Customizer Preview Controller
 * Handles instantaneous CSS variable changes without reloading iframe.
 */
(function($) {
    'use strict';

    if (!wp || !wp.customize) return;

    // Colors
    wp.customize('ansh_color_bg_cream', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--bg-cream', newVal);
        });
    });

    wp.customize('ansh_color_bg_sand', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--bg-sand', newVal);
        });
    });

    wp.customize('ansh_color_text_primary', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--text-primary', newVal);
        });
    });

    wp.customize('ansh_color_accent_earth', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--accent-earth', newVal);
        });
    });

    // Typography
    wp.customize('ansh_font_heading', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--font-heading', "'" + newVal + "', sans-serif");
        });
    });

    wp.customize('ansh_font_size_body', function(value) {
        value.bind(function(newVal) {
            document.body.style.fontSize = newVal + 'px';
        });
    });

    // Container & Spacing
    wp.customize('ansh_container_width', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--container-max', newVal + 'px');
        });
    });

    wp.customize('ansh_global_radius', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--radius-sm', newVal + 'px');
        });
    });

    wp.customize('ansh_btn_radius', function(value) {
        value.bind(function(newVal) {
            document.documentElement.style.setProperty('--btn-radius', newVal + 'px');
        });
    });

    // Buttons
    wp.customize('ansh_btn_bg', function(value) {
        value.bind(function(newVal) {
            $('.thrift-btn--dark').css('background-color', newVal).css('border-color', newVal);
        });
    });

    wp.customize('ansh_btn_text_color', function(value) {
        value.bind(function(newVal) {
            $('.thrift-btn--dark').css('color', newVal);
        });
    });

    // Announcement Bar
    wp.customize('ansh_announcement_bg', function(value) {
        value.bind(function(newVal) {
            $('.announcement-bar').css('background-color', newVal);
        });
    });

    wp.customize('ansh_announcement_text_color', function(value) {
        value.bind(function(newVal) {
            $('.announcement-bar, .announcement-text').css('color', newVal);
        });
    });

    // Grid Columns
    wp.customize('ansh_wc_columns_desktop', function(value) {
        value.bind(function(newVal) {
            $('.products-editorial-grid').css('grid-template-columns', 'repeat(' + newVal + ', 1fr)');
        });
    });

})(jQuery);

