<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage mazateca
 * @since mazateca 1.0
 */

get_header(); ?>


<div id="content" class="site-content" role="main">
<?php
	
	if ( have_posts() ) :
		// Start the Loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );

		endwhile;
		mazateca_paging_nav();

	else :
		get_template_part( 'content', 'none' );

	endif;
?>

</div>


<?php get_sidebar(); ?>

<?php get_footer(); ?>