<?php
/**
 * The template for displaying the footer
 *
 * @package Multi_Maiven
 */

?>

    <?php do_action('mm_footer_before'); ?>

    <footer id="colophon" class="site-footer">
        <?php do_action('mm_footer_inside_before'); ?>
        
        <div class="mm-container">
            <?php
            // Render footer columns with widget areas
            mm_render_footer_columns();
            
            // Render footer menus with alignment
            mm_render_footer_menus();
            
            // Display responsive footer ad (if enabled)
            if (get_theme_mod('mm_show_footer_ad', true)) {
                mm_display_responsive_ad('footer');
            }
            ?>
        </div>
        
        <?php 
        // Include the bottom footer bar
        get_template_part('template-parts/footer/footer-bottom');
        ?>
        
        <?php do_action('mm_footer_inside_after'); ?>
    </footer><!-- #colophon -->

    <?php do_action('mm_footer_after'); ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>