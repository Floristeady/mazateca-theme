<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage mazateca
 * @since mazateca 1.0
 */

get_header(); ?>

<div id="content" class="site-content">

	<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title">
			<?php
				if ( is_day() ) :
					printf( __( 'Daily Archives: %s', 'mazateca' ), get_the_date() );

				elseif ( is_month() ) :
					printf( __( 'Monthly Archives: %s', 'mazateca' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'mazateca' ) ) );

				elseif ( is_year() ) :
					printf( __( 'Yearly Archives: %s', 'mazateca' ), get_the_date( _x( 'Y', 'yearly archives date format', 'mazateca' ) ) );

				else :
					_e( 'Archives', 'mazateca' );

				endif;
			?>
		</h1>
	</header>

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

<?php get_sidebar(); ?>

<?php get_footer(); ?>