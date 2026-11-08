# Ansh Thrifts - Premium Editorial E-Commerce Theme
## Fully Visually Customizable WordPress & WooCommerce Theme

A production-ready, editorial luxury WordPress & WooCommerce theme engineered specifically for thrift, vintage archives, and curated one-of-a-kind clothing stores.

**100% Visual Customization: No code editing, no Antigravity dependency, and no Node.js runtime required.**

---

## 1. Visual Customization System (No Coding Required)

The theme is equipped with a complete dual visual customization engine built entirely on WordPress-native APIs:

```text
┌────────────────────────────────────────────────────────┐
│             WORDPRESS ADMIN VISUAL CONTROLS            │
├───────────────────────────┬────────────────────────────┤
│ 1. WordPress Customizer   │ 2. Visual Block Builder    │
│ (Global Design System)    │ (Gutenberg Patterns)       │
├───────────────────────────┼────────────────────────────┤
│ • Colors & Backgrounds    │ • Drag-and-drop sections   │
│ • Typography & Font Sizes │ • Add/Remove sections      │
│ • Button Shapes & Colors  │ • Edit headings & text     │
│ • Container Width/Padding │ • Swap images from Media   │
│ • WooCommerce Grid/Cards  │ • Live draft preview       │
│ • Header & Footer Options │ • 9 pre-built patterns     │
└───────────────────────────┴────────────────────────────┘
```

---

## 2. WordPress Customizer Controls

Go to **Appearance &rarr; Customize &rarr; Ansh Thrifts Visual Settings**:

### A. Colors & Backgrounds
- **Primary Page Background**: Change the editorial cream background (`#FAF8F5`).
- **Secondary / Alternate Background**: Change the section sand background (`#F3EFEA`).
- **Primary Text Color**: Set the charcoal/black typography color (`#121212`).
- **Earthy Accent Color**: Change the vintage terracotta/rust accent (`#9E5A3F`).
- **Divider & Border Color**: Customize the subtle separator lines (`#E8E2D8`).

### B. Typography & Font Sizes
- **Heading Font Family**: Choose between *Syne (Modern Editorial Sans)*, *Playfair Display (Luxury Serif)*, *Plus Jakarta Sans (Minimal Geometric)*, or *Georgia*.
- **Body Font Family**: Choose body font family.
- **Body Font Size**: Set default base font size (14px – 20px).
- **Heading Line Height**: Choose Ultra Tight (1.05), Standard (1.15), or Relaxed (1.25).

### C. Buttons & Call-to-Actions
- **Primary Button Background & Text Color**: Customize dark CTA buttons.
- **Button Corner Radius (px)**: Set to `2` for sharp editorial rectangular buttons, or `9999` for sleek pill buttons.
- **Button Text Style**: Choose between `UPPERCASE` or standard capitalization.

### D. Layout, Spacing & Container
- **Max Container Width**: Adjust container width (1000px – 1800px; default: 1380px).
- **Global Border Radius**: Adjust softness of product cards, banners, and modals.
- **Section Vertical Spacing**: Adjust vertical padding between sections (40px – 140px).

### E. Animations & Motion
- **Enable Smooth Interface Animations**: Toggle drawer and page transitions.
- **Enable Product Card Image Hover Zoom**: Toggle the subtle zoom effect when hovering product cards.
- Respects visitor system preferences automatically (`prefers-reduced-motion`).

### F. Header & Announcement Bar
- **Announcement Bar**: Edit text, target link, background color, and text color.
- **Header Layout**: Choose between *Left Logo with Center Menu* or *Centered Logo*.
- **Logo & Favicon**: Set your logo and browser site icon via **Appearance &rarr; Customize &rarr; Site Identity**.

### G. WooCommerce Product Grid & Cards
- **Product Grid Columns**: Switch between 2, 3, 4, or 5 columns on desktop.
- **Product Image Ratio**: Switch between `4:5` (Editorial Portrait), `1:1` (Square), or `3:4` (Tall).
- **Show "1 OF 1" Rarity Badge**: Toggle 1-of-1 badge for unique thrift inventory.
- **Show Condition Badge**: Toggle condition badge display on cards.
- **Show Brand Name**: Toggle brand label above product titles.
- **Enable Quick Add to Bag**: Toggle floating quick-add button on card hover.

### H. Footer & Social Links
- **Footer Background Color**: Customize footer darkness.
- **Show Newsletter Section**: Toggle weekly drop alerts card in footer.
- **Social Links**: Configure Instagram and TikTok links.

---

## 3. Visual Homepage Builder (Drag-and-Drop Gutenberg)

The store owner can visually edit and rearrange the homepage without touching code:

1. In WordPress Admin, go to **Pages &rarr; All Pages** and click **Edit** on your Front Page (e.g. `Home`).
2. Click the **+** (Block Inserter) in the top-left corner, and switch to the **Patterns** tab.
3. Select the **Ansh Thrifts Homepage Builder** category.
4. You will see 9 ready-to-use editorial sections:
   - **Editorial Hero Banner**: Large hero with buttons and rarity stats.
   - **Tops & Bottoms Split Showcase**: Two-column collection banners.
   - **New Arrivals Showcase**: Live dynamic feed of latest WooCommerce products.
   - **Featured Tops Curation**: Live dynamic Tops query.
   - **Featured Bottoms Curation**: Live dynamic Bottoms query.
   - **Promotional Manifesto Banner**: Sustainable circular fashion callout card.
   - **About Philosophy & Value Pillars**: Store story and condition grading box.
   - **Instagram & Community Gallery**: 4-column community photo grid.
   - **Newsletter Drop Alerts Card**: Private drop access subscription box.
5. **Drag and Drop / Reorder**: Use the up/down arrows or drag handles in the Block List View to reorder sections.
6. **Swap Images**: Click any image or banner, click **Replace**, and select an image from your native **WordPress Media Library**.
7. **Edit Text**: Click directly on headings or paragraphs to change any wording.
8. Click **Update / Publish** &mdash; your homepage is updated instantly!

---

## 4. Theme File Structure

```text
ansh-thrifts/
├── style.css                      # Theme metadata & base descriptor
├── functions.php                  # Theme setup, HPOS, taxonomies, AJAX cart & visual loader
├── header.php                     # Announcement bar, header branding, navigation, search modal
├── footer.php                     # Drop newsletter, brand story, links & copyright
├── front-page.php                 # Dual-mode homepage (Gutenberg Visual Builder + Fallback)
├── index.php                      # Fallback journal layout
├── page.php                       # Static pages (Cart, Checkout, Account, Policies)
├── single.php                     # Single post template
├── archive.php                    # Standard archives
├── search.php                     # Live product search result grid
├── 404.php                        # 404 "Vintage Archive Not Found"
├── woocommerce.php                # Native WooCommerce wrapper
├── woocommerce/
│   └── content-product.php        # Loop template utilizing editorial product card
├── template-parts/
│   ├── product-card.php           # 1-of-1 thrift card with condition, brand & hover preview
│   └── filter-bar.php             # Brand, category, condition, price & stock filtering drawer
├── inc/
│   ├── customizer.php             # Full Visual Customizer system (colors, fonts, buttons, WC grid)
│   └── patterns.php               # Native Gutenberg Block Patterns for visual drag-and-drop
├── assets/
│   ├── css/main.css               # Handcrafted CSS3 (cream/sand palette, responsive, reduced-motion)
│   ├── js/main.js                 # Vanilla JS (slide-out cart, mobile menu, search, filter drawers)
│   ├── js/customize-preview.js    # Live Preview JS controller
│   └── images/.gitkeep            # Asset storage
└── README.md                      # Comprehensive client setup & testing guide
```

---

## 5. Installation Instructions

### Direct Upload via WordPress Admin
1. Copy the `ansh-thrifts` folder into `wp-content/themes/ansh-thrifts/` (or upload as a zip).
2. Log into your WordPress Dashboard (`yourdomain.com/wp-admin`).
3. Navigate to **Appearance &rarr; Themes**.
4. Click **Activate** on **Ansh Thrifts**.

---

## 6. Required & Recommended Plugins

| Plugin | Required / Optional | Purpose |
| :--- | :--- | :--- |
| **WooCommerce** (Latest) | **Required** | Core e-commerce engine, checkout, orders, inventory & payments |
| **WooCommerce Stripe / PayPal** | Recommended | Live credit card / digital wallet payment gateway |

*Note: No build tools, Node.js, npm, Vite, or React plugins are needed.*

---

## 7. WooCommerce Category & Brand Setup

### 1. Categories (Tops & Bottoms):
- Go to **Products &rarr; Categories**.
- Create parent category **Tops** (slug: `tops`).
- Subcategories: `t-shirts`, `shirts`, `sweatshirts`, `hoodies`, `jackets`, `other-tops`.
- Create parent category **Bottoms** (slug: `bottoms`).
- Subcategories: `jeans`, `trousers`, `cargo-pants`, `shorts`, `skirts`, `other-bottoms`.

### 2. Brands:
- Go to **Products &rarr; Brands** (or use the shortcut on your Admin Dashboard).
- Add brands like `Nike`, `Levi's`, `Carhartt`, `Adidas`, `Zara`, etc.
- When publishing a product, simply check the brand in the right sidebar.

### 3. Vintage Condition Grading:
- Go to **Products &rarr; Conditions**.
- Default conditions (*Pristine Vintage*, *Like New*, *Excellent Pre-Loved*, *Good Vintage*) are auto-seeded on theme activation.

### 4. 1-of-1 Thrift Inventory:
- When creating a product in **Products &rarr; Add New**:
  - In the **Inventory** tab, check **Manage stock** and set **Stock quantity** to `1`.
  - The theme will automatically label the piece **"1 OF 1"** across cards and product pages!
  - When purchased, it automatically flips to **"ARCHIVED / SOLD"**.

---

## 8. Client Shop Manager Account

Create an account for your non-technical client with least privileges:
1. Go to **Users &rarr; Add New User**.
2. Set Role to **Shop Manager** (do not grant Administrator).
3. The Shop Manager can:
   - Add/edit products, prices, images, stock, categories, brands, and conditions.
   - Fulfill orders and view sales reports.
   - Cannot break theme code or install unauthorized plugins.
4. When they log in, the custom **Ansh Thrifts Quick Store Controls** dashboard widget greets them with one-click shortcuts.

---

## 9. Testing & Quality Verification Checklist

- [x] **Zero Node.js Dependency**: Runs natively on standard PHP 7.4/8.x hosting.
- [x] **Visual Customizer**: All controls under Appearance &rarr; Customize actively update CSS variables and live preview.
- [x] **Gutenberg Visual Builder**: All 9 patterns can be inserted, edited, and rearranged via block editor.
- [x] **Dynamic Product Publishing**: New products published in `/wp-admin` instantly show up in correct categories, shop listings, and brand loops.
- [x] **Native Media Library**: Logos, banners, and product photography use WordPress Media Library.
- [x] **High-Performance Order Storage (HPOS)**: Declared and 100% compatible.
- [x] **Interactive Drawers**: Mini Cart Drawer, Filter Drawer, Search Modal, and Mobile Nav Drawer operate smoothly with zero console errors.
