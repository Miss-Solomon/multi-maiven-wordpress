/**
 * File main.js.
 *
 * Main JavaScript functionality for the theme.
 */

(function() {
    'use strict';

    // Variables
    const body = document.body;
    const siteHeader = document.querySelector('.site-header');
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNavigation = document.querySelector('.main-navigation');
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    const skipLink = document.querySelector('.skip-link');
    
    // Initialize
    function init() {
        setupMobileMenu();
        setupDropdownMenus();
        setupStickyHeader();
        setupSkipLinkFocus();
        setupAccessibleMenus();
        setupIconList();
    }

    // Mobile Menu
    function setupMobileMenu() {
        if (!menuToggle || !mainNavigation) {
            return;
        }

        // Hide menu toggle button if menu is empty and return early.
        if (mainNavigation.getElementsByTagName('ul').length === 0) {
            menuToggle.style.display = 'none';
            return;
        }

        // Add aria attributes
        menuToggle.setAttribute('aria-expanded', 'false');
        mainNavigation.setAttribute('aria-expanded', 'false');

        menuToggle.addEventListener('click', function() {
            const expanded = menuToggle.getAttribute('aria-expanded') === 'true' || false;
            
            menuToggle.setAttribute('aria-expanded', !expanded);
            mainNavigation.setAttribute('aria-expanded', !expanded);
            mainNavigation.classList.toggle('toggled');
            
            if (expanded) {
                menuToggle.setAttribute('aria-label', 'Open menu');
            } else {
                menuToggle.setAttribute('aria-label', 'Close menu');
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInside = mainNavigation.contains(event.target) || menuToggle.contains(event.target);
            
            if (!isClickInside && mainNavigation.classList.contains('toggled')) {
                mainNavigation.classList.remove('toggled');
                menuToggle.setAttribute('aria-expanded', 'false');
                mainNavigation.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Open menu');
            }
        });
    }

    // Dropdown Menus
    function setupDropdownMenus() {
        if (!dropdownToggles.length) {
            return;
        }

        dropdownToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = this.parentNode;
                
                parent.classList.toggle('focus');
                this.setAttribute('aria-expanded', 
                    this.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'
                );
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const openMenus = document.querySelectorAll('.menu-item-has-children.focus');
            
            openMenus.forEach(function(menu) {
                if (!menu.contains(event.target)) {
                    menu.classList.remove('focus');
                    const toggle = menu.querySelector('.dropdown-toggle');
                    if (toggle) {
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });
    }

    // Sticky Header
    function setupStickyHeader() {
        if (!siteHeader || !body.classList.contains('has-sticky-header')) {
            return;
        }

        let lastScrollTop = 0;
        const headerHeight = siteHeader.offsetHeight;
        const scrollThreshold = 50;

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
            
            // Add sticky class when scrolled past threshold
            if (currentScroll > headerHeight) {
                siteHeader.classList.add('sticky');
                body.style.paddingTop = headerHeight + 'px';
                
                // Hide on scroll down, show on scroll up
                if (currentScroll > lastScrollTop && currentScroll > headerHeight + scrollThreshold) {
                    siteHeader.classList.add('sticky-hidden');
                } else {
                    siteHeader.classList.remove('sticky-hidden');
                }
            } else {
                siteHeader.classList.remove('sticky');
                siteHeader.classList.remove('sticky-hidden');
                body.style.paddingTop = '0';
            }
            
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
        }, { passive: true });
    }

    // Skip Link Focus
    function setupSkipLinkFocus() {
        if (!skipLink) {
            return;
        }

        skipLink.addEventListener('click', function() {
            const target = document.querySelector(this.getAttribute('href'));
            
            if (target) {
                target.setAttribute('tabindex', '-1');
                target.focus();
                
                target.addEventListener('blur', function() {
                    this.removeAttribute('tabindex');
                }, { once: true });
            }
        });
    }

    // Accessible Menus
    function setupAccessibleMenus() {
        const menuLinks = document.querySelectorAll('.main-navigation a');
        
        menuLinks.forEach(function(link) {
            link.addEventListener('focus', function() {
                let parent = this.parentElement;
                
                while (parent && parent.classList) {
                    if (parent.classList.contains('menu-item-has-children')) {
                        parent.classList.add('focus');
                    }
                    parent = parent.parentElement;
                }
            });
            
            link.addEventListener('blur', function() {
                let parent = this.parentElement;
                
                while (parent && parent.classList) {
                    if (parent.classList.contains('menu-item-has-children')) {
                        parent.classList.remove('focus');
                    }
                    parent = parent.parentElement;
                }
            });
        });
    }

    // Icon List
    function setupIconList() {
        const iconLists = document.querySelectorAll('.mm-icon-list');
        
        iconLists.forEach(function(list) {
            const listItems = list.querySelectorAll('li');
            
            listItems.forEach(function(item) {
                item.classList.add('mm-icon-list-item');
            });
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
