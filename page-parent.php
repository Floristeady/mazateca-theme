<?php
/**
 * Template Name: Plantilla superior
 *
 * @package WordPress
 * @subpackage mazateca
 * @since mazateca 1.0
 */

get_header(); ?>

<div id="content" class="site-content row">
	
	<article>
	
	<?php while ( have_posts() ) : the_post(); ?>
	
		<div class="column medium-9 end">
			
			<?php include('inc/breadcrumbs.php'); ?>
		
			<?php // Page title.
				the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header>' ); ?>
			
			<?php if (has_excerpt()) :
				$excerpt = get_the_excerpt(); 
				echo '<h4 class="entry-excerpt">'. $excerpt .'</h4>';
				endif;
			?>
		
		</div>
		
		<div class="row">
		
		<div class="column medium-3 float-left">
			<?php include('inc/sidebar-menu.php'); ?>
		</div>
		
		<div class="column medium-9 float-left">
			
			<?php $images = get_field('gallery_pages'); 
			
			if( $images ): ?>
			<div id="page-gallery" class="flexslider">
				<ul class="slides">
					<?php foreach( $images as $image ): ?>
					<li><img alt="<?php echo $image['alt']; ?>" src="<?php echo $image['sizes']['gallery-image']; ?>"></li>
					 <?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
			
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>
		
		</div>
	
	<?php endwhile; ?>
	
	</article>

</div><!-- #content -->


<?php get_sidebar('menu'); ?>

<?php get_footer(); ?>