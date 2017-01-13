<?php
/**
 * mazateca functions and definitions
 *
 * The first function, mazateca_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * For information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage mazateca
 * @since mazateca 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 1024;

/** Tell WordPress to run mazateca_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'mazateca_setup' );

if ( ! function_exists( 'mazateca_setup' ) ):

/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 */
function mazateca_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( array( 'css/editor-style.css', mazateca_font_url() ) );
	
	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'large-content-image', 1440, 550, true );
	add_image_size( 'medium-content-image', 720, 438, true );
	add_image_size( 'gallery-image', 760, 500, true );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'mazateca', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'mazateca' ),
		'secondary' => __( 'Secondary Navigation', 'mazateca' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
	) );
		
	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'mazateca_custom_background_args', array(
		'default-color' => 'ffffff',
	) ) );
	
} endif;


/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since mazateca 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function mazateca_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'mazateca' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'mazateca_wp_title', 10, 2 );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since mazateca 1.0
 */
function mazateca_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'mazateca_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since mazateca 1.0
 * @return int
 */
function mazateca_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'mazateca_excerpt_length' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and mazateca_continue_reading_link().
 *
 * @since mazateca 1.0
 */
function mazateca_auto_excerpt_more( $more ) {
	return ' &hellip;' . mazateca_continue_reading_link();
}
add_filter( 'excerpt_more', 'mazateca_auto_excerpt_more' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since mazateca 1.0
 * @return string "Continue Reading" link
 */
function mazateca_continue_reading_link() {
	return '';
}

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since mazateca 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function mazateca_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= mazateca_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'mazateca_custom_excerpt_more' );

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override mazateca_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since mazateca 1.0
 * @uses register_sidebar
 */
function mazateca_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'mazateca' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Main Sidebar Widget', 'mazateca' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'mazateca' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'Secondary Sidebar Widget', 'mazateca' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'mazateca' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer', 'mazateca' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'mazateca' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'An optional widget area for your site footer', 'mazateca' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	

}
/** Register sidebars by running mazateca_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'mazateca_widgets_init' );

/**
 * Register Google font for mazateca.
 *
 * @since mazateca 1.0
 *
 * @return string
 */
function mazateca_font_url() {
	$font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Font: on or off', 'mazateca' ) ) {
		$font_url = add_query_arg( 'family', 'Cabin:700,400italic,400|Roboto+Slab', "//fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since mazateca 1.0
 *
 * @return void
 */
function mazateca_scripts() {
	// Add font, used in the main stylesheet.
	wp_enqueue_style( 'mazateca-font', mazateca_font_url(), array(), null );
	
	wp_enqueue_style( 'foundation.min.css', get_template_directory_uri() . '/css/foundation.min.css', array(), '6.1.2' );
	
	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/css/genericons.css', array(), '3.0.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'mazatecasteady-style', get_stylesheet_uri(), array( 'genericons' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	
}
add_action( 'wp_enqueue_scripts', 'mazateca_scripts' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 *
 * @since mazateca 1.0
 *
 * @return void
 */
function mazateca_admin_fonts() {
	wp_enqueue_style( 'mazateca-font', mazateca_font_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'mazateca_admin_fonts' );


if ( ! function_exists( 'mazateca_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since mazateca 1.0
 *
 * @return void
 */
function mazateca_posted_on() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		echo '<span class="featured-post">' . __( 'Sticky', 'mazateca' ) . '</span>';
	}

	// Set up and print post meta information.
	printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);
}
endif;
if ( ! function_exists( 'mazateca_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since mazateca 1.0
 */
function mazateca_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s.', 'mazateca' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s.', 'mazateca' );
	} else {
		$posted_in = __( 'Bookmark the <a href="/%3$s/" rel="bookmark">permalink</a>.', 'mazateca' );
	}

	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


/**
 * Add Admin
 *
 * @since mazateca 1.0
 */
	require_once(TEMPLATEPATH . '/theme-admin/general-options.php');

	// remove version info from head and feeds (http://digwp.com/2009/07/remove-wordpress-version-number/)
	function mazateca_complete_version_removal() {
		return '';
	}
	add_filter('the_generator', 'mazateca_complete_version_removal');

/**
 * Change Search Form input type from "text" to "search" and add placeholder text
 *
 * @since mazateca 1.0
 */
	function mazateca_search_form ( $form ) {
		$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<div><label class="screen-reader-text" for="s">' . __('Search for:', 'mazateca') . '</label>
		<input type="search" placeholder="'. __('Search for:', 'mazateca'). '" value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" class="hide" id="searchsubmit" value="'. esc_attr__('Search') .'" />
		</div>
		</form>';
		return $form;
	}
	add_filter( 'get_search_form', 'mazateca_search_form' );


/**
 *  Adds excerpt on pages
 */
 
add_post_type_support( 'page', 'excerpt');

/**
 * Find out if blog has more than one category.
 *
 * @since mazateca 1.0
 *
 * @return boolean true if blog has more than 1 category
 */
function mazateca_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'mazateca_category_count' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'mazateca_category_count', $all_the_cool_cats );
	}

	if ( 1 !== (int) $all_the_cool_cats ) {
		// This blog has more than 1 category so mazateca_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so mazateca_categorized_blog should return false
		return false;
	}
}

if ( ! function_exists( 'mazateca_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since mazateca 1.0
 *
 * @return void
 */
function mazateca_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'mazateca' ),
		'next_text' => __( 'Next &rarr;', 'mazateca' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'mazateca' ); ?></h1>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}
endif;

if ( ! function_exists( 'mazateca_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since mazateca 1.0
 *
 * @return void
 */
function mazateca_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}

	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'mazateca' ); ?></h1>
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '<span class="meta-nav">Published In</span>%title', 'mazateca' ) );
			else :
				previous_post_link( '%link', __( '<span class="meta-nav">Previous Post</span>%title', 'mazateca' ) );
				next_post_link( '%link', __( '<span class="meta-nav">Next Post</span>%title', 'mazateca' ) );
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since mazateca 1.0
 *
 * @return void
*/
function mazateca_post_thumbnail() {
	if ( post_password_required() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
	<?php the_post_thumbnail(); ?>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
	<?php the_post_thumbnail(); ?>
	</a>

	<?php endif; // End is_singular()
}

/**
 * Comments Page Off
 *
 * @since mazateca 1.0
 *
*/
function my_default_content( $post_content, $post ) {
    if( $post->post_type )
    switch( $post->post_type ) {
        case 'page':
            $post->comment_status = 'closed';
        break;
    }
    return $post_content;
}
add_filter( 'default_content', 'my_default_content', 10, 2 );


?>