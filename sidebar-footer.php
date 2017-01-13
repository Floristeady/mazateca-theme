<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage mazateca
 * @since mazateca 1.0
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'first-footer-widget-area'  )
		&& ! is_active_sidebar( 'second-footer-widget-area' )
	)
		return;
	// If we get this far, we have widgets. Let's do this.
?>



<?php if ( is_active_sidebar( 'second-footer-widget-area' ) ) : ?>
					<ul class="column medium-12 widget-footer">
						<?php dynamic_sidebar( 'second-footer-widget-area' ); ?>
					</ul>
<?php endif; ?>

<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
					<ul class="column medium-12 widget-footer small-centered">
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					</ul>
<?php endif; ?>




