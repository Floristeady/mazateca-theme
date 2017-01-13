<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage mazateca
 * @since mazateca 1.0
 */

get_header(); ?>

<div id="content" class="site-content">

	<?php if ( have_posts() ) : ?>

	<header class="archive-header">
		<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'mazateca' ), single_cat_title( '', false ) ); ?></h1>

		<?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
		?>
	</header>

	<div class="">

		<?php 

			while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );

			endwhile;

			mazateca_paging_nav();

		else :
		
			get_template_part( 'content', 'none' );

		endif;
	?>
	
	</div>
	
</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>