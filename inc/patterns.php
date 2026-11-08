<?php
/**
 * Ansh Thrifts - Native Gutenberg Block Patterns & Visual Page Builder
 * Allows complete drag-and-drop homepage composition directly inside WordPress Block Editor.
 *
 * @package Ansh_Thrifts
 * @version 1.1.0
 */

defined('ABSPATH') || exit;

function ansh_thrifts_register_block_patterns() {
    if (!function_exists('register_block_pattern_category') || !function_exists('register_block_pattern')) {
        return;
    }

    // Register Category for Pattern Inserter
    register_block_pattern_category('ansh-thrifts', [
        'label' => __('Ansh Thrifts Homepage Builder', 'ansh-thrifts'),
    ]);

    // 1. HERO BANNER PATTERN
    register_block_pattern('ansh-thrifts/hero-banner', [
        'title'       => __('Editorial Hero Banner', 'ansh-thrifts'),
        'description' => __('Full-width editorial hero with headings, buttons, and archive badges.', 'ansh-thrifts'),
        'categories'  => ['ansh-thrifts', 'header'],
        'content'     => '<!-- wp:group {"align":"full","className":"editorial-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull editorial-hero"><div class="thrift-container hero-inner">
<!-- wp:paragraph {"className":"hero-badge"} -->
<p class="hero-badge">AUTUMN / WINTER 2026 ARCHIVE</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"hero-title"} -->
<h1 class="wp-block-heading hero-title">Curated Vintage &amp; One-of-a-Kind Fashion</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"hero-description"} -->
<p class="hero-description">Handpicked streetwear, rare designer archives, premium denim, and timeless thrift silhouettes. Each garment carries a unique past.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"hero-cta-group"} -->
<div class="wp-block-buttons hero-cta-group"><!-- wp:button {"className":"thrift-btn thrift-btn--dark"} -->
<div class="wp-block-button thrift-btn thrift-btn--dark"><a class="wp-block-button__link wp-element-button" href="/product-category/tops/">Shop Tops &rarr;</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"thrift-btn thrift-btn--outline"} -->
<div class="wp-block-button thrift-btn thrift-btn--outline"><a class="wp-block-button__link wp-element-button" href="/product-category/bottoms/">Shop Bottoms</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:columns {"className":"hero-stats"} -->
<div class="wp-block-columns hero-stats"><!-- wp:column {"className":"stat-item"} -->
<div class="wp-block-column stat-item"><p><strong>100%</strong><span>Hand-Inspected &amp; Authenticated</span></p></div>
<!-- /wp:column -->

<!-- wp:column {"className":"stat-item"} -->
<div class="wp-block-column stat-item"><p><strong>1-of-1</strong><span>Unique Archived Pieces</span></p></div>
<!-- /wp:column -->

<!-- wp:column {"className":"stat-item"} -->
<div class="wp-block-column stat-item"><p><strong>Zero</strong><span>Fast Fashion Waste</span></p></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div></div>
<!-- /wp:group -->',
    ]);

    // 2. CATEGORY SPLIT GRID (TOPS & BOTTOMS)
    register_block_pattern('ansh-thrifts/category-split', [
        'title'       => __('Tops & Bottoms Split Showcase', 'ansh-thrifts'),
        'description' => __('Two-column visual category banner for Tops and Bottoms collections.', 'ansh-thrifts'),
        'categories'  => ['ansh-thrifts'],
        'content'     => '<!-- wp:group {"align":"full","className":"section-py category-split-showcase","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-py category-split-showcase"><div class="thrift-container">
<!-- wp:columns {"className":"category-split-grid"} -->
<div class="wp-block-columns category-split-grid"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"split-cat-card split-cat-card--tops","layout":{"type":"default"}} -->
<div class="wp-block-group split-cat-card split-cat-card--tops"><div class="split-cat-bg split-cat-bg--tops"></div><div class="split-cat-overlay"></div><div class="split-cat-content">
<!-- wp:paragraph {"className":"cat-micro-tag"} --><p class="cat-micro-tag">ARCHIVE CURATION 01</p><!-- /wp:paragraph -->
<!-- wp:heading {"level":2,"className":"split-cat-title"} --><h2 class="wp-block-heading split-cat-title">TOPS</h2><!-- /wp:heading -->
<!-- wp:paragraph {"className":"split-cat-sub"} --><p class="split-cat-sub">Vintage Leather, Distressed Hoodies, Carhartt Jackets &amp; Band Tees</p><!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"split-cat-link"} --><p class="split-cat-link"><a href="/product-category/tops/">Browse Tops Collection &rarr;</a></p><!-- /wp:paragraph -->
</div></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"split-cat-card split-cat-card--bottoms","layout":{"type":"default"}} -->
<div class="wp-block-group split-cat-card split-cat-card--bottoms"><div class="split-cat-bg split-cat-bg--bottoms"></div><div class="split-cat-overlay"></div><div class="split-cat-content">
<!-- wp:paragraph {"className":"cat-micro-tag"} --><p class="cat-micro-tag">ARCHIVE CURATION 02</p><!-- /wp:paragraph -->
<!-- wp:heading {"level":2,"className":"split-cat-title"} --><h2 class="wp-block-heading split-cat-title">BOTTOMS</h2><!-- /wp:heading -->
<!-- wp:paragraph {"className":"split-cat-sub"} --><p class="split-cat-sub">Classic 90s Levi’s 501, Parachute Pants, Cargo Pantalons &amp; Tailored Trousers</p><!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"split-cat-link"} --><p class="split-cat-link"><a href="/product-category/bottoms/">Browse Bottoms Collection &rarr;</a></p><!-- /wp:paragraph -->
</div></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div></div>
<!-- /wp:group -->',
    ]);

    // 3. NEW ARRIVALS & RECENT DROPS
    register_block_pattern('ansh-thrifts/new-arrivals', [
        'title'       => __('New Arrivals Showcase (WooCommerce)', 'ansh-thrifts'),
        'description' => __('Live dynamic feed of freshly published thrift pieces.', 'ansh-thrifts'),
        'categories'  => ['ansh-thrifts'],
        'content'     => '<!-- wp:group {"align":"full","className":"section-py bg-sand","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-py bg-sand"><div class="thrift-container">
<!-- wp:group {"className":"section-header","layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group section-header"><div>
<span class="section-badge">FRESH VINTAGE ARCHIVE</span>
<h2 class="section-heading">New Arrivals &amp; Recent Drops</h2>
</div>
<a href="/shop/" class="view-all-link">View Complete Archive &rarr;</a>
</div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[products limit="4" columns="4" orderby="date" order="DESC"]
<!-- /wp:shortcode -->
</div></div>
<!-- /wp:group -->',
    ]);

    // 4. FEATURED TOPS SECTION
    register_block_pattern('ansh-thrifts/featured-tops', [
        'title'       => __('Featured Tops Curation (WooCommerce)', 'ansh-thrifts'),
        'description' => __('Dynamic product showcase filtered to the Tops category.', 'ansh-thrifts'),
        'categories'  => ['ansh-thrifts'],
        'content'     => '<!-- wp:group {"align":"full","className":"section-py","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-py"><div class="thrift-container">
<!-- wp:group {"className":"section-header","layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group section-header"><div>
<span class="section-badge">CURATION / TOPS</span>
<h2 class="section-heading">Featured Tops &amp; Outerwear</h2>
</div>
<a href="/product-category/tops/" class="view-all-link">Explore All Tops &rarr;</a>
</div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[products category="tops" limit="4" columns="4"]
<!-- /wp:shortcode -->
</div></div>
<!-- /wp:group -->',
    ]);

    // 5. FEATURED BOTTOMS SECTION
    register_block_pattern('ansh-thrifts/featured-bottoms', [
        'title'       => __('Featured Bottoms Curation (WooCommerce)', 'ansh-thrifts'),
        'description' => __('Dynamic product showcase filtered to the Bottoms category.', 'ansh-thrifts'),
        'categories'  => ['ansh-thrifts'],
        'content'     => '<!-- wp:group {"align":"full","className":"section-py bg-sand","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-py bg-sand"><div class="thrift-container">
<!-- wp:group {"className":"section-header","layout":{"type":"flex","justifyContent":"space-between"}} -->
<div class="wp-block-group section-header"><div>
<span class="section-badge">CURATION / BOTTOMS</span>
<h2 class="section-heading">Featured Bottoms &amp; Vintage Denim</h2>
</div>
<a href="/product-category/bottoms/" class="view-all-link">Explore All Bottoms &rarr;</a>
</div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[products category="bottoms" limit="4" columns="4"]
<!-- /wp:shortcode -->
</div></div>
<!-- /wp:group -->',
    ]);

    // 6. PROMOTIONAL MANIFESTO BANNER
    register_block_pattern('ansh-thrifts/promo-manifesto', [
        'title'       => __('Promotional Manifesto Banner', 'ansh-thrifts'),
        'description' => __('Editorial callout card promoting sustainable vintage fashion.', 'ansh-thrifts'),
        'categories'  => ['ansh-thrifts'],
        'content'     => '<!-- wp:group {"align":"full","className":"promo-editorial-banner","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull promo-editorial-banner"><div class="thrift-container">
<!-- wp:group {"className":"promo-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group promo-card">
<div class="promo-tag">CIRCULAR FASHION MANIFESTO</div>
<h3 class="promo-title">Every piece has a past. Give it a future.</h3>
<p class="promo-text">Fast fashion produces 92 million tonnes of textile waste yearly. Every thrifted item you purchase from Ansh Thrifts keeps premium garments in rotation and out of landfills.</p>
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"thrift-btn thrift-btn--dark"} -->
<div class="wp-block-button thrift-btn thrift-btn--dark"><a class="wp-block-button__link wp-element-button" href="/shop/">Shop Mindful Fashion</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
</div></div>
<!-- /wp:group -->',
    ]);

    // 7. ABOUT THE STORE SECTION
    register_block_pattern('ansh-thrifts/about-philosophy', [
        'title'       => __('About Philosophy & Value Pillars', 'ansh-thrifts'),
        'description' => __('Story section explaining garment inspection, condition grading, and eco packaging.', 'ansh-thrifts'),
        'categories'  => ['ansh-thrifts'],
        'content'     => '<!-- wp:group {"align":"full","className":"section-py about-preview-section bg-sand","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-py about-preview-section bg-sand"><div class="thrift-container">
<!-- wp:columns {"className":"about-grid"} -->
<div class="wp-block-columns about-grid"><!-- wp:column -->
<div class="wp-block-column"><span class="section-badge">OUR STORY &amp; PHILOSOPHY</span>
<h2 class="about-title">Curated with obsession. Restored with respect.</h2>
<p class="about-p">At Ansh Thrifts, we believe clothing should be treasured, not discarded. Each item in our collection is handpicked from vintage archives across the globe, inspected for quality, and professionally laundered.</p>
<p class="about-p">Because our pieces are true vintage and one-offs, when an item sells out, it’s gone forever. We take exact measurements so you get the perfect fit every time.</p>
</div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"className":"about-quote-box"} -->
<div class="wp-block-group about-quote-box"><p class="quote-text">“Style isn’t about what’s trending on TikTok this week. It’s about wearing pieces with soul, history, and craftsmanship.”</p>
<span class="quote-author">&mdash; Ansh Thrifts Archive Studio</span></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div></div>
<!-- /wp:group -->',
    ]);

    // 8. INSTAGRAM COMMUNITY GRID
    register_block_pattern('ansh-thrifts/instagram-gallery', [
        'title'       => __('Instagram & Community Gallery', 'ansh-thrifts'),
        'description' => __('Visual photo grid for community styling and social media.', 'ansh-thrifts'),
        'categories'  => ['ansh-thrifts'],
        'content'     => '<!-- wp:group {"align":"full","className":"section-py instagram-community-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull section-py instagram-community-section"><div class="thrift-container">
<div class="section-header text-center">
<span class="section-badge">@ansh.thrifts</span>
<h2 class="section-heading">Seen on the Community</h2>
<p class="section-sub">Tag #AnshArchive to be featured on our editorial gallery.</p>
</div>
<!-- wp:columns {"className":"instagram-grid"} -->
<div class="wp-block-columns instagram-grid"><!-- wp:column -->
<div class="wp-block-column"><div class="insta-tile insta-tile-1"><div class="insta-overlay"><span>#VintageStyle</span></div></div></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><div class="insta-tile insta-tile-2"><div class="insta-overlay"><span>#90sOversized</span></div></div></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><div class="insta-tile insta-tile-3"><div class="insta-overlay"><span>#Levis501</span></div></div></div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column"><div class="insta-tile insta-tile-4"><div class="insta-overlay"><span>#SustainableFashion</span></div></div></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
</div></div>
<!-- /wp:group -->',
    ]);

    // 9. NEWSLETTER DROP ALERTS
    register_block_pattern('ansh-thrifts/newsletter-drop', [
        'title'       => __('Newsletter Drop Alerts Card', 'ansh-thrifts'),
        'description' => __('Newsletter registration card for weekly drops.', 'ansh-thrifts'),
        'categories'  => ['ansh-thrifts'],
        'content'     => '<!-- wp:group {"align":"full","className":"footer-newsletter","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull footer-newsletter"><div class="thrift-container">
<div class="newsletter-card">
<div class="newsletter-content">
<span class="newsletter-badge">VINTAGE ARCHIVE DROPS</span>
<h3 class="newsletter-heading">Never miss a Sunday drop.</h3>
<p class="newsletter-sub">Most thrift pieces are 1-of-1 and never restocked. Join 8,000+ fashion collectors for private early access 15 minutes before public drop.</p>
</div>
<form class="newsletter-form" onsubmit="event.preventDefault(); alert(\'Subscribed!\');">
<div class="newsletter-input-group">
<input type="email" placeholder="Enter your email address..." required class="newsletter-input">
<button type="submit" class="thrift-btn thrift-btn--dark">Join Early Access</button>
</div>
</form>
</div>
</div></div>
<!-- /wp:group -->',
    ]);
}
add_action('init', 'ansh_thrifts_register_block_patterns');

