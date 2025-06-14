/**
 * Dark Mode Toggle
 *
 * Handles the dark mode toggle functionality.
 */

(function() {
    'use strict';

    // Variables
    const body = document.body;
    const darkModeToggles = document.querySelectorAll('.dark-mode-toggle');
    const darkModeClass = 'dark-mode';
    const darkModeStorageKey = 'multiMaivenDarkMode';
    const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

    // Functions
    function setDarkMode(isDark) {
        if (isDark) {
            body.classList.add(darkModeClass);
            localStorage.setItem(darkModeStorageKey, 'dark');
            updateToggles(true);
        } else {
            body.classList.remove(darkModeClass);
            localStorage.setItem(darkModeStorageKey, 'light');
            updateToggles(false);
        }
    }

    function toggleDarkMode() {
        const isDark = body.classList.contains(darkModeClass);
        setDarkMode(!isDark);
    }

    function updateToggles(isDark) {
        darkModeToggles.forEach(toggle => {
            // Update toggle state
            toggle.setAttribute('aria-pressed', isDark ? 'true' : 'false');
            
            // Update toggle text if it has a label
            const label = toggle.querySelector('.toggle-label');
            if (label && typeof multiMaivenDarkMode !== 'undefined' && multiMaivenDarkMode.labels) {
                label.textContent = isDark ? 
                    multiMaivenDarkMode.labels.light : 
                    multiMaivenDarkMode.labels.dark;
            }
            
            // Update toggle icon if it has one
            const icon = toggle.querySelector('.toggle-icon');
            if (icon && typeof multiMaivenDarkMode !== 'undefined' && multiMaivenDarkMode.icons) {
                // If icons are defined in the localized data, use them
                if (multiMaivenDarkMode.icons) {
                    icon.innerHTML = isDark ? 
                        multiMaivenDarkMode.icons.light : 
                        multiMaivenDarkMode.icons.dark;
                }
                // Otherwise just toggle a class for CSS to handle
                else {
                    if (isDark) {
                        icon.classList.add('is-dark-mode');
                    } else {
                        icon.classList.remove('is-dark-mode');
                    }
                }
            }
        });
    }

    function initDarkMode() {
        // Check for saved user preference
        const savedMode = localStorage.getItem(darkModeStorageKey);
        
        if (savedMode) {
            // If we have a saved preference, use it
            setDarkMode(savedMode === 'dark');
        } else if (typeof multiMaivenDarkMode !== 'undefined' && multiMaivenDarkMode.defaultMode) {
            // If we have a default mode set in the customizer, use it
            setDarkMode(multiMaivenDarkMode.defaultMode === 'dark');
        } else {
            // Otherwise, use the system preference
            setDarkMode(darkModeMediaQuery.matches);
        }
        
        // Add event listeners to toggles
        darkModeToggles.forEach(toggle => {
            toggle.addEventListener('click', toggleDarkMode);
        });
        
        // Listen for system preference changes
        darkModeMediaQuery.addEventListener('change', e => {
            // Only update if the user hasn't set a preference
            if (!localStorage.getItem(darkModeStorageKey)) {
                setDarkMode(e.matches);
            }
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDarkMode);
    } else {
        initDarkMode();
    }

})();
