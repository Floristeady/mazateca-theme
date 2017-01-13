<?php
/**
 * Template Name: Plantilla inicio
 * @package WordPress
 * @subpackage mazateca
 * @since mazateca 1.0
 */

get_header(); ?>

<div id="content" class="site-content">
	
	<?php while ( have_posts() ) : the_post(); ?>
		
		<?php // Gallery home
		$rows = get_field('gallery_home');  ?>
		<?php if($rows) { ?>
		<div id="home-gallery" class="flexslider">
				<ul class="slides">
					<?php foreach($rows as $row) { ?>
					<li>
					 	<?php if ($row['gallery_image']) { ?>
						 	<span class="img">
						 	<?php $attachment_id = $row['gallery_image'];
							 echo wp_get_attachment_image( $attachment_id, 'large-content-image'); ?>
						 	</span>
						 <?php } ?>		
						<span class="back">
						<?php if ($row['gallery_short_text']) { ?>
						<div class="row">
							<div class="text">
								<div class="inner columns small-12 large-5 left">
									<h1><?php echo $row['gallery_short_text'] ?></h1>
									<h2><?php echo $row['gallery_long_text'] ?></h2>
								</div>
								<div class="columns small-12 large-4 left end">
									<a title="Saber más" class="button button-border-yellow" href="<?php echo $row['gallery_link_button'] ?>"><span><?php echo $row['gallery_text_button'] ?></span></a>
								</div>
							</div>
						</div>
						</span>
						<?php } ?>	
						
					</li>				
					<?php } ?>
				</ul>
		</div>
		<?php } ?>
		
		<div id="section-about">
			
			<div class="row">
			
				<?php if(get_field('intro_img')) : ?>	
				<div class="column medium-6">
					<span class="img">
					<?php $attachment_id = get_field('intro_img');
					echo wp_get_attachment_image( $attachment_id, 'medium'); ?>
					</span>
					
				</div>
				<?php endif; ?> 
				
				<div class="column medium-6">
					
					<div class="text">
						
						<?php if(get_field('intro_title')) : ?>	
						  	<h2><?php the_field('intro_title'); ?> </h2>
						<?php endif; ?> 
						
						<?php if(get_field('intro_text')) : ?>	
						  	<?php the_field('intro_text'); ?>
						<?php endif; ?> 
						
						<?php if(get_field('intro_link')) : ?>	
						  	<a class="button button-border-green" title="Saber más" href="<?php the_field('intro_link'); ?>"><span><?php the_field('intro_link_text'); ?></span></a>
						<?php endif; ?> 
					
					</div>
					
				</div>
			
			</div>
			
		</div>
						
		<?php // Gallery home
		$rows = get_field('featured_home');  ?>
		<?php if($rows) { ?>
		<div id="section-featured">
			
			<?php foreach($rows as $row) { ?>
			<?php $attachment_id = $row['featured_image']; ?>

			<div class="column medium-6" style="background-image: url(<?php echo $attachment_id ?>);">
				
				<div class="inner">
					
					<h3><?php echo $row['featured_title'] ?></h3>
					<?php echo $row['featured_text'] ?>
					<a title="saber más" href="<?php echo $row['featured_link'] ?>" class="button">Saber más</a>
					
				</div>
				
			</div>
			<?php } ?>
		
		</div>
		<?php } ?>

		<div id="section-video">
			
			<div class="row">
				
				<div class="column medium-6">
					
					<div class="text">
						
						<?php if(get_field('video_title')) : ?>	
						  	<h2><?php the_field('video_title'); ?> </h2>
						<?php endif; ?> 
						
						<?php if(get_field('video_text')) : ?>	
						  	<?php the_field('video_text'); ?>
						<?php endif; ?> 
						
						<?php if(get_field('video_link')) : ?>	
						  	<a class="button button-border-green"  title="Saber más" href="<?php the_field('video_link'); ?>"><span><?php the_field('video_text_button'); ?></span></a>
						<?php endif; ?> 
					
					</div>
					
				</div>
				
				<?php if(get_field('video_code')) : ?>	
				<div class="column medium-6">
					<span class="video">
					<?php the_field('video_code'); ?>
					</span>
					
				</div>
				<?php endif; ?> 

			
			</div>
			
		</div>

		

	<?php endwhile; ?>

</div><!-- #content -->

<?php get_footer(); ?>