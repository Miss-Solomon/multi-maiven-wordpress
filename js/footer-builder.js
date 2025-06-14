/**
 * Multi Maiven Footer Builder Live Preview
 * Handles live preview functionality in WordPress Customizer for footer options
 */

(function($) {
    'use strict';

    // Footer Background Color
    wp.customize('mm_footer_bg_color', function(value) {
        value.bind(function(to) {
            $('.site-footer').css('background-color', to);
        });
    });

    // Footer Text Color
    wp.customize('mm_footer_text_color', function(value) {
        value.bind(function(to) {
            $('.site-footer').css('color', to);
            $('.site-footer a').css('color', to);
        });
    });

    // Copyright Text
    wp.customize('mm_copyright_text', function(value) {
        value.bind(function(to) {
            $('.bottom-footer-center').html(to);
        });
    });

    // Footer Top Padding
    wp.customize('mm_footer_padding_top', function(value) {
        value.bind(function(to) {
            $('.site-footer').css('padding-top', to + 'px');
        });
    });

    // Footer Bottom Padding
    wp.customize('mm_footer_padding_bottom', function(value) {
        value.bind(function(to) {
            $('.site-footer').css('padding-bottom', to + 'px');
        });
    });

    // Footer Border
    wp.customize('mm_footer_border', function(value) {
        value.bind(function(to) {
            if (to) {
                $('.site-footer').css('border-top', '1px solid var(--mm-color-border)');
            } else {
                $('.site-footer').css('border-top', 'none');
            }
        });
    });

    // Footer Column Count - Live Preview
    wp.customize('mm_footer_column_count', function(value) {
        value.bind(function(to) {
            // Update the grid template columns
            $('.footer-columns').css('grid-template-columns', 'repeat(' + to + ', 1fr)');
            
            // Show/hide columns based on count
            $('.footer-column').each(function(index) {
                if (index < to) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });

    // Primary Footer Menu Alignment
    wp.customize('mm_footer_primary_alignment', function(value) {
        value.bind(function(to) {
            var $primaryMenu = $('.footer-primary-menu .footer-navigation');
            
            // Remove existing alignment classes
            $primaryMenu.removeClass('footer-menu-align-left footer-menu-align-center footer-menu-align-right');
            
            // Add new alignment class
            $primaryMenu.addClass('footer-menu-align-' + to);
            
            // Update CSS properties
            switch(to) {
                case 'left':
                    $primaryMenu.css({
                        'text-align': 'left',
                        'justify-content': 'flex-start'
                    });
                    $primaryMenu.find('ul').css('justify-content', 'flex-start');
                    break;
                case 'center':
                    $primaryMenu.css({
                        'text-align': 'center',
                        'justify-content': 'center'
                    });
                    $primaryMenu.find('ul').css('justify-content', 'center');
                    break;
                case 'right':
                    $primaryMenu.css({
                        'text-align': 'right',
                        'justify-content': 'flex-end'
                    });
                    $primaryMenu.find('ul').css('justify-content', 'flex-end');
                    break;
            }
        });
    });

    // Secondary Footer Menu Alignment
    wp.customize('mm_footer_secondary_alignment', function(value) {
        value.bind(function(to) {
            var $secondaryMenu = $('.footer-secondary-menu .footer-navigation');
            
            // Remove existing alignment classes
            $secondaryMenu.removeClass('footer-menu-align-left footer-menu-align-center footer-menu-align-right');
            
            // Add new alignment class
            $secondaryMenu.addClass('footer-menu-align-' + to);
            
            // Update CSS properties
            switch(to) {
                case 'left':
                    $secondaryMenu.css({
                        'text-align': 'left',
                        'justify-content': 'flex-start'
                    });
                    $secondaryMenu.find('ul').css('justify-content', 'flex-start');
                    break;
                case 'center':
                    $secondaryMenu.css({
                        'text-align': 'center',
                        'justify-content': 'center'
                    });
                    $secondaryMenu.find('ul').css('justify-content', 'center');
                    break;
                case 'right':
                    $secondaryMenu.css({
                        'text-align': 'right',
                        'justify-content': 'flex-end'
                    });
                    $secondaryMenu.find('ul').css('justify-content', 'flex-end');
                    break;
            }
        });
    });

    // Show/Hide Footer Advertisement
    wp.customize('mm_show_footer_ad', function(value) {
        value.bind(function(to) {
            if (to) {
                $('.responsive-footer-ad').show();
            } else {
                $('.responsive-footer-ad').hide();
            }
        });
    });
    
    // Bottom Footer Bar Background Color
    wp.customize('mm_bottom_bar_bg_color', function(value) {
        value.bind(function(to) {
            $('.bottom-footer-bar').css('background-color', to);
        });
    });
    
    // Bottom Footer Bar Text Color
    wp.customize('mm_bottom_bar_text_color', function(value) {
        value.bind(function(to) {
            $('.bottom-footer-bar').css('color', to);
            $('.bottom-footer-bar a').css('color', to);
        });
    });
    
    // Bottom Footer Bar Left Content
    wp.customize('mm_bottom_bar_left', function(value) {
        value.bind(function(to) {
            // Check if layout is reversed
            var isReversed = $('.bottom-footer-bar').hasClass('reverse-layout');
            
            // Update the appropriate div based on reverse layout status
            if (isReversed) {
                $('.bottom-footer-right').html(to);
            } else {
                $('.bottom-footer-left').html(to);
            }
        });
    });
    
    // Bottom Footer Bar Right Content
    wp.customize('mm_bottom_bar_right', function(value) {
        value.bind(function(to) {
            // Check if layout is reversed
            var isReversed = $('.bottom-footer-bar').hasClass('reverse-layout');
            
            // Update the appropriate div based on reverse layout status
            if (isReversed) {
                $('.bottom-footer-left').html(to);
            } else {
                $('.bottom-footer-right').html(to);
            }
        });
    });

    // Helper function to update footer layout
    function updateFooterLayout() {
        var columns = wp.customize('mm_footer_column_count')();
        var primaryAlign = wp.customize('mm_footer_primary_alignment')();
        var secondaryAlign = wp.customize('mm_footer_secondary_alignment')();
        
        // Update columns
        $('.footer-columns').css('grid-template-columns', 'repeat(' + columns + ', 1fr)');
        
        // Update menu alignments
        updateMenuAlignment('.footer-primary-menu .footer-navigation', primaryAlign);
        updateMenuAlignment('.footer-secondary-menu .footer-navigation', secondaryAlign);
    }

    // Helper function to update menu alignment
    function updateMenuAlignment(selector, alignment) {
        var $menu = $(selector);
        
        // Remove existing alignment classes
        $menu.removeClass('footer-menu-align-left footer-menu-align-center footer-menu-align-right');
        
        // Add new alignment class
        $menu.addClass('footer-menu-align-' + alignment);
        
        // Update CSS properties
        var cssProps = {};
        var ulCssProps = {};
        
        switch(alignment) {
            case 'left':
                cssProps = {
                    'text-align': 'left',
                    'justify-content': 'flex-start'
                };
                ulCssProps = { 'justify-content': 'flex-start' };
                break;
            case 'center':
                cssProps = {
                    'text-align': 'center',
                    'justify-content': 'center'
                };
                ulCssProps = { 'justify-content': 'center' };
                break;
            case 'right':
                cssProps = {
                    'text-align': 'right',
                    'justify-content': 'flex-end'
                };
                ulCssProps = { 'justify-content': 'flex-end' };
                break;
        }
        
        $menu.css(cssProps);
        $menu.find('ul').css(ulCssProps);
    }

    // Initialize footer layout on customizer ready
    wp.customize.bind('ready', function() {
        // Apply initial footer layout
        setTimeout(updateFooterLayout, 100);
    });

    // Add visual feedback for customizer controls
    $(document).ready(function() {
        // Add hover effects for better UX
        $('.customize-control').on('mouseenter', function() {
            $(this).addClass('mm-control-hover');
        }).on('mouseleave', function() {
            $(this).removeClass('mm-control-hover');
        });
        
        // Add custom CSS for better customizer experience
        var customCSS = `
            .mm-control-hover {
                background-color: rgba(0, 123, 255, 0.05);
                border-radius: 4px;
                transition: background-color 0.2s ease;
            }
            
            .customize-control h3 {
                color: #23282d;
                font-weight: 600;
                margin-top: 20px;
                margin-bottom: 10px;
                padding-bottom: 8px;
                border-bottom: 1px solid #ddd;
            }
            
            .customize-control-select select,
            .customize-control-range input {
                width: 100%;
            }
            
            .customize-control-color .wp-color-picker {
                width: 100%;
            }
        `;
        
        if (!document.getElementById('mm-footer-builder-styles')) {
            var styleElement = document.createElement('style');
            styleElement.id = 'mm-footer-builder-styles';
            styleElement.textContent = customCSS;
            document.head.appendChild(styleElement);
        }
    });

})(jQuery);