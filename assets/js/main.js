/**
 * Ansh Thrifts - Pure Vanilla JavaScript Controller
 * Zero external libraries or Node.js runtime dependencies.
 */

document.addEventListener('DOMContentLoaded', () => {
    'use strict';

    // 1. Mobile Menu Drawer
    const mobileMenuOpenBtn  = document.getElementById('mobile-menu-open-btn');
    const mobileDrawer       = document.getElementById('mobile-drawer');
    const mobileDrawerClose  = document.getElementById('mobile-drawer-close-btn');
    const mobileOverlay      = document.getElementById('mobile-drawer-overlay');

    function toggleMobileMenu(isOpen) {
        if (!mobileDrawer) return;
        if (isOpen) {
            mobileDrawer.classList.add('is-drawer-open');
            mobileDrawer.setAttribute('aria-hidden', 'false');
            if (mobileMenuOpenBtn) mobileMenuOpenBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        } else {
            mobileDrawer.classList.remove('is-drawer-open');
            mobileDrawer.setAttribute('aria-hidden', 'true');
            if (mobileMenuOpenBtn) mobileMenuOpenBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }
    }

    if (mobileMenuOpenBtn) {
        mobileMenuOpenBtn.addEventListener('click', () => toggleMobileMenu(true));
    }
    if (mobileDrawerClose) {
        mobileDrawerClose.addEventListener('click', () => toggleMobileMenu(false));
    }
    if (mobileOverlay) {
        mobileOverlay.addEventListener('click', () => toggleMobileMenu(false));
    }

    // 2. Search Modal
    const searchModalOpenBtn  = document.getElementById('search-modal-open-btn');
    const searchModal         = document.getElementById('search-modal');
    const searchModalCloseBtn = document.getElementById('search-modal-close-btn');
    const searchModalOverlay  = document.getElementById('search-modal-close-overlay');
    const searchInput         = searchModal ? searchModal.querySelector('input[type="search"]') : null;

    function toggleSearchModal(isOpen) {
        if (!searchModal) return;
        if (isOpen) {
            searchModal.classList.add('is-search-open');
            searchModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            setTimeout(() => {
                if (searchInput) searchInput.focus();
            }, 100);
        } else {
            searchModal.classList.remove('is-search-open');
            searchModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }

    if (searchModalOpenBtn) {
        searchModalOpenBtn.addEventListener('click', () => toggleSearchModal(true));
    }
    if (searchModalCloseBtn) {
        searchModalCloseBtn.addEventListener('click', () => toggleSearchModal(false));
    }
    if (searchModalOverlay) {
        searchModalOverlay.addEventListener('click', () => toggleSearchModal(false));
    }

    // 3. Mini Cart Drawer
    const miniCartToggleBtn = document.getElementById('mini-cart-toggle-btn');
    const cartDrawer        = document.getElementById('cart-drawer');
    const cartDrawerClose   = document.getElementById('cart-drawer-close-btn');
    const cartOverlay       = document.getElementById('cart-drawer-overlay');

    function toggleCartDrawer(isOpen) {
        if (!cartDrawer) return;
        if (isOpen) {
            cartDrawer.classList.add('is-drawer-open');
            cartDrawer.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        } else {
            cartDrawer.classList.remove('is-drawer-open');
            cartDrawer.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }

    if (miniCartToggleBtn) {
        miniCartToggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleCartDrawer(true);
        });
    }
    if (cartDrawerClose) {
        cartDrawerClose.addEventListener('click', () => toggleCartDrawer(false));
    }
    if (cartOverlay) {
        cartOverlay.addEventListener('click', () => toggleCartDrawer(false));
    }

    // Open cart drawer automatically when WooCommerce AJAX adds an item
    if (typeof jQuery !== 'undefined') {
        jQuery(document.body).on('added_to_cart', () => {
            toggleCartDrawer(true);
        });
    }

    // 4. Filter Drawer
    const filterDrawerBtn   = document.getElementById('filter-drawer-btn');
    const filterDrawer      = document.getElementById('filter-drawer');
    const filterDrawerClose = document.getElementById('filter-drawer-close-btn');
    const filterOverlay     = document.getElementById('filter-drawer-overlay');

    function toggleFilterDrawer(isOpen) {
        if (!filterDrawer) return;
        if (isOpen) {
            filterDrawer.classList.add('is-drawer-open');
            filterDrawer.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        } else {
            filterDrawer.classList.remove('is-drawer-open');
            filterDrawer.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }

    if (filterDrawerBtn) {
        filterDrawerBtn.addEventListener('click', () => toggleFilterDrawer(true));
    }
    if (filterDrawerClose) {
        filterDrawerClose.addEventListener('click', () => toggleFilterDrawer(false));
    }
    if (filterOverlay) {
        filterOverlay.addEventListener('click', () => toggleFilterDrawer(false));
    }

    // 5. Global Escape Key Handler
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            toggleMobileMenu(false);
            toggleSearchModal(false);
            toggleCartDrawer(false);
            toggleFilterDrawer(false);
        }
    });

    // 6. Back to Top Button
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                backToTopBtn.classList.add('is-visible');
            } else {
                backToTopBtn.classList.remove('is-visible');
            }
        }, { passive: true });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
});

