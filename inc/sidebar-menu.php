<?php
/**
 * The Sidebar containing submenu
 *
 * @package WordPress
 * @subpackage simplesteady
 * @since simplesteady 1.0
 */
?>

<div id="sidebar-menu" class="resize">    
		 <?php $titlepadre = get_the_title();
		
		 $titlecustom = 'Más información del proyecto:';
		 $ancestors = $post->ancestors;
         if(!$post->post_parent){
          // will display the subpages of this top level page
          $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&sort_order=ASC&sort_column=menu_order");
          
          } else {

          if($ancestors)
          {
          // now you can get the the top ID of this page
          // wp is putting the ids DESC, thats why the top level ID is the last one
          $ancestors = end($ancestors); 
          $children = wp_list_pages("title_li=&child_of=".$ancestors."&echo=0&sort_order=ASC&sort_column=menu_order");
          $titlenamer = get_the_title($post->post_parent);
          
          $tituloDelPapaDelPapa = '';
          if($post->post_parent) {
			$parent = get_post($post->post_parent);
			if ($parent->post_parent){
				$grandpa = get_post($parent->post_parent);
				$titlenamer = get_the_title($grandpa->ID);
				//print "titulo padre es: " . $titlenamer;
			}
			}
          		  
          // you will always get the whole subpages list
          }
      }
          if ($children) { ?>
          <h3> <?php if (!empty($titlenamer)) {echo $titlenamer;} else {print $titlecustom;} ?> </h3>
              <ul>
                  <?php echo $children; ?>
              </ul>
          <?php } ?>
          
  </div>