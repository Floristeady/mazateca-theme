<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage mazateca
 * @since mazateca 1.0
 */

get_header(); ?>

<div id="content" class="site-content row" role="main">

	<?php
		
		while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );

			mazateca_post_nav();

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
	?>

</div><!-- #content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
