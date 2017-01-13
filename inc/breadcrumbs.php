<div id="breadcrumbs" class="">
		<p><a href="/"> <?php _e('Home', 'mazateca') ?></a> 
		<span class="separator">></span> 
		<?php if (is_page()) { ?>
			<?php if($post->post_parent) {
					$parent_title = get_the_title($post->post_parent);
					$parent_url = get_permalink($post->post_parent);?>
					<a href="<?php echo $parent_url ?>"><?php echo $parent_title; ?> </a><span class="separator"> > </span>
			<?php } ?>
			<span class="current"><?php the_title(); ?></span>
		
		<?php } elseif (is_category() || is_single()) { ?>
			<a href="<?php echo get_permalink( get_page_by_path( 'novedades' ) ) ?>"> <?php _e('Novedades', 'mazateca') ?></a><span class="separator"> > </span>
			<?php  echo '<span class="cat">';
			the_category('</span><span class="separator"> > </span><span class="current">');
            if (is_single()) {
                echo '</span><span class="separator"> > </span><span class="current">';
                the_title();
                echo '</span>';
            }  ?>
		<?php } elseif (is_home()) { 
			echo"<span class='current'>"; echo'Novedades </span>';
		 } elseif (is_tag()) { 
			echo"<span class='current'>"; printf( __( 'Tag Archives: %s', 'mazateca' ), single_tag_title( '', false ) ); echo'</span>';
		 } elseif (is_month()) {?>
		 	<a href="<?php echo get_permalink( get_page_by_path( 'novedades' ) ) ?>"> <?php _e('Novedades', 'mazateca') ?></a><span class="separator"> > </span><span class='current'>
			<?php printf( __( 'Monthly Archives: %s', 'mazateca' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'mazateca' ) ) ); ?> </span>
		<?php }	elseif ( is_day() ) {?>
		 	<a href="<?php echo get_permalink( get_page_by_path( 'novedades' ) ) ?>"> <?php _e('Novedades', 'mazateca') ?></a><span class="separator"> > </span>
			<?php
			printf( __( 'Daily Archives: %s', 'mazateca' ), get_the_date() );
		 } elseif (is_author()) { 
			echo"<span class='current'>"; printf( __( 'All posts by %s', 'mazateca' ), get_the_author() );  				echo'</span>';
		 } elseif (is_search()) { 
			echo"<span class='current'>"; printf( __( 'Search Results for: %s', 'mazateca' ), get_search_query() ); echo '</span>';
		 } else { ?>
		
		<?php  } ?>
		</p>
</div>