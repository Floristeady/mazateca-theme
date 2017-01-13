<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage mazateca
 * @since mazateca 1.0
 */
?>

<div id="sidebar">
			
	<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>

	<ul class="widget-list">
		<?php dynamic_sidebar( 'primary-widget-area' ); ?>
	</ul>
	
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

	<ul class="widget-list">
		<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
	</ul>

	<?php endif; ?>

</div>