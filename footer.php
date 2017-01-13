<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage mazateca
 * @since mazateca 1.0
 */
?>
	
	<footer id="footer" class="site-footer" role="contentinfo">
		<div id="footer-content" class="row">
			
		<?php get_sidebar( 'footer' ); ?>
		
		</div>
	</footer><!-- footer -->
	
	</section><!-- #main -->
	
	<?php wp_footer(); ?>
	</body>
</html>