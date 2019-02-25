<?
/**
 * framework functions and definitions
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */
 
/* ........................... ADDING BOOTSTRAP ................................ */
/* Below is code to add bootstrap to the site.
To turn it off, just remove the code or comment it out.*/
 
wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/library/bootstrap/css/bootstrap.min.css');
    
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/library/bootstrap/js/bootstrap.min.js', array('jquery'), '', true );
    
    // Register Custom Navigation Walker
    require_once('wp_bootstrap_navwalker.php');


 /* ........................... CUSTOM POST TYPES ................................ */
/* Below is an include to a default custom post type.
To turn it off, just remove the code or comment it out.*/
//include(TEMPLATEPATH . '/library/post_types.php');



/* .............................. CUSTOM FIELDS FOR POSTS/PAGES .................. */
/* Below is an include to default custom fields for the blog posts.
To turn it off, just remove the code or comment it out.*/
//include(TEMPLATEPATH . '/library/custom_fields.php');




 
 
 


// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();




// This theme uses post thumbnails
if ( function_exists( 'add_theme_support' ) ) { // WP 2.9 or Greater
	
   add_theme_support( 'post-thumbnails' );
   set_post_thumbnail_size( 300, 250, true ); // Normal Post Thumbnail
   add_image_size( 'featured-homepage', 640, 310, true ); // Home Page Featured  Thumbnail
   add_image_size( 'tab-thumbnail', 60, 60, true ); // For Tabs
   add_image_size( 'archive-photo-thumbnail', 225, 150, true ); // Archive Thumbnail
   
   add_theme_support( 'automatic-feed-links' );
   
}


//................... CUSTOM NAV MENU ..................................................//
// If you'd like to add a custom navigation to the site, uncomment the block of code below:
// Go to http://codex.wordpress.org/Function_Reference/wp_nav_menu for questions about usage
// CYSY Framework  3 Copyright(c) 2012-2013 - CYber SYtes,  Inc. All Rights Reserved

// To register a custom nav so that you can update it from wordpress back office:
register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'CYSY Framework 3' ),
) );
// To display custom nav in theme use: 
//*** <? wp_nav_menu( array( 'container_class' => 'your_navigation_container', 'theme_location' => 'primary' ) ); ? >



//.................. GIVE CUSTOM NAV MENU ABILITY FOR DESCRIPTIONS .................. //
// CYSY Framework  3 Copyright(c) 2012-2013 - CYber SYtes,  Inc. All Rights Reserved
// To apply this to a theme simply add an item to the wp_nav_menu array like so:
//<? $walker = new My_Walker;
//		wp_nav_menu(array(
//			'menu_class' => 'navigation',
//			'theme_location' => 'primary-menu',
//			'walker' => $walker
//		));
//	? >
class My_Walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = '';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= '<strong>' . $item->title . '</strong>';
		$item_output .= '<span>' . $item->description . '</span>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


//.................. CUSTOM NAV MENU FALLBACK TO SHOW A HOME LINK ....................// 
// CYSY Framework  3 Copyright(c) 2012-2013 - CYber SYtes,  Inc. All Rights Reserved
 /* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 */
function framework_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'framework_page_menu_args' );
	








/**
 * sets the_content length in posts of wordpress
 *
 TO use this, echo this on your page: <? the_content_limit(390,"learn more"); ?>
 */
/*

function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
$content = get_the_content($more_link_text, $stripteaser, $more_file);
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);

if (strlen($_GET['p']) > 0) {
echo $content;
}
else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
$content = substr($content, 0, $espacio);
$content = $content;
echo $content;
echo "<a class=".'learnMore'." href='";
the_permalink();
echo "'>...".$more_link_text."</a></p>";
}
else {
echo $content;
}
}

*/






/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @return int
 // CYSY Framework  3 Copyright(c) 2012-2013 - CYber SYtes,  Inc. All Rights Reserved
 */
function framework_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'framework_excerpt_length' );






/**
 * Set Your Own Custom Excerpt Length
 * To set the amount of words that you want your excerpt to be simply use:
 * <? echo excerpt(15); ?>
 */
 /*
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
*/






/**
 * Returns a "Continue Reading" link for excerpts
 // Copyright(c) 2012-2013 - CYber SYtes,   Inc. All Rights Reserved
 */
function framework_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'CYSY Framework 3' ) . '</a>';
}







/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and framework_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 // CYSY Framework  3 Copyright(c)2012-2013 - CYber SYtes,  Inc. All Rights Reserved
 /*
function framework_auto_excerpt_more( $more ) {
	return ' &hellip;' . framework_continue_reading_link();
}
add_filter( 'excerpt_more', 'framework_auto_excerpt_more' );
*/







/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 */
/*
function framework_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= framework_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'framework_custom_excerpt_more' );
*/









//..................................................... ADD IS_CHILD FUNCTION
// This is a neat little function that allows for you to use interact with a
// page based on whether or not it is a child of a page.
// is_child()
function is_child($parent) {
	global $wp_query;
	if ($wp_query->post->post_parent == $parent) {
		$return = true;
	}
	else {
		$return = false;
	}
	return $return;
}











if ( ! function_exists( 'framework_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function framework_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <? comment_class(); ?> id="li-comment-<? comment_ID(); ?>">
		<div id="comment-<? comment_ID(); ?>">
		<div class="comment-author vcard">
			<? echo get_avatar( $comment, 40 ); ?>
			<? printf( __( '%s <span class="says">says:</span>', 'CYSY Framework 3' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<? if ( $comment->comment_approved == '0' ) : ?>
			<em><? _e( 'Your comment is awaiting moderation.', 'CYSY Framework 3' ); ?></em>
			<br />
		<? endif; ?>

		<div class="comment-meta commentmetadata"><a href="<? echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'CYSY Framework 3' ), get_comment_date(),  get_comment_time() ); ?></a><? edit_comment_link( __( '(Edit)', 'CYSY Framework 3' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><? comment_text(); ?></div>

		<div class="reply">
			<? comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><? _e( 'Pingback:', 'CYSY Framework 3' ); ?> <? comment_author_link(); ?><? edit_comment_link( __('(Edit)', 'CYSY Framework 3'), ' ' ); ?></p>
	<?
			break;
	endswitch;
}
endif;




/**
 * Register widgetized areas, including two sidebars widgets for this framework.
 // CYSY   Framework  3 Copyright(c) 2012-2013 - CYber SYtes,    Inc. All Rights Reserved
 * @since CYSY Framework 3
 * @uses register_sidebar
 */

	
// Area 1, located at the top of the sidebar.
register_sidebar( array(
	'name' => __( 'Primary Widget Area', 'CYSY Framework 3' ),
	'id' => 'primary-widget-area',
	'description' => __( 'The primary widget area', 'CYSY Framework 3' ),
	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );

// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
register_sidebar( array(
	'name' => __( 'Secondary Widget Area', 'CYSY Framework 3' ),
	'id' => 'secondary-widget-area',
	'description' => __( 'The secondary widget area', 'CYSY Framework 3' ),
	'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h3 class="widget-title">',
	'after_title' => '</h3>',
) );




/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 */
function framework_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'framework_remove_recent_comments_style' );






if ( ! function_exists( 'framework_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 */
function framework_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'CYSY Framework 3' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'CYSY Framework 3' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'framework_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 */
function framework_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'CYSY Framework 3' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'CYSY Framework 3' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'CYSY Framework 3' );
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




// Pull an image URL from the media gallery
function sp_get_image($num = 0) {
	global $post;
	$children = get_children(array(
		'post_parent' => $post->ID,
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));

	$count = 0;
    foreach ((array)$children as $key => $value) {
        $images[$count] = $value;
        $count++;
    }
	if(isset($images[$num]))
		return wp_make_link_relative(wp_get_attachment_url($images[$num]->ID));
	else
		return false;
}



/********************* THESE LINES OF CODE ARE FOR THE .htaccess file

The first two lines of code are used to allow you to include .php files from outside of the /wordpress/ directory.

The next two lines of code are used for increasing the upload sizes for media to wordpress.

*** These lines below need to be added to the top of the .htaccess file that is in the root of the site.

php_value allow_url_fopen	on
php_value allow_url_include	on

php_value post_max_size 8M
php_value upload_max_filesize 8M




*/







/*** THIS MODIFIES THE ADMIN LOGIN SCREEN LOGO TO DISPLAY A
CUSTOM LOGO FROM THE THEME DIRECTORY.


add_filter( 'login_headerurl', 'namespace_login_headerurl' );
/**
 * Replaces the login header logo URL
 *
 * @param $url
 */
function namespace_login_headerurl( $url ) {
    $url = home_url( '/' );
    return $url;
}

add_filter( 'login_headertitle', 'namespace_login_headertitle' );
/**
 * Replaces the login header logo title
 *
 * @param $title
 */
function namespace_login_headertitle( $title ) {
    $title = get_bloginfo( 'name' );
    return $title;
}

add_action( 'login_head', 'namespace_login_style' );
/**
 * Replaces the login header logo
 */
function namespace_login_style() {
    echo '<style>.login h1 a { background-image: url( ' . get_template_directory_uri() . '/images/admin_logo.png ) !important; }</style>';
}








// remove version info from head and feeds
// for security buff

function complete_version_removal() {
    return '';
}
add_filter('the_generator', 'complete_version_removal');



// Reformatts dashboard to eliminate a lot of the annoying things our clients see first off.

add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {
global $wp_meta_boxes;
 //Right Now - Comments, Posts, Pages at a glance
//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
//Recent Comments
//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
//Incoming Links
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
//Plugins - Popular, New and Recently updated Wordpress Plugins
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

//Wordpress Development Blog Feed
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
//Other Wordpress News Feed
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
//Quick Press Form
//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
//Recent Drafts List
//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
}







// remove unncessary header info in the <head> of our sites
function remove_header_info() {
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'start_post_rel_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'adjacent_posts_rel_link');
}
add_action('init', 'remove_header_info');

// remove extra css that recent comments widget injects
function remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}
add_action('widgets_init', 'remove_recent_comments_style');


// this changes the footer in the admin section of wordpress
function remove_footer_admin () {
echo 'Site Developed by: <a href="http://www.cysy.com" target="_blank" title="Panama City Beach Web Design">CYber SYtes, Inc. Web SYtes by Design</a>';
}
add_filter('admin_footer_text', 'remove_footer_admin');








//this line of code removes the error messages above login screen if incorrect login is entered.
// basically removes information hackers could use to know if they're having success.
add_filter('login_errors',create_function('$a', "return null;"));








//remove please update now link for clients, but keeps it live for admins
if ( !current_user_can( 'edit_users' ) ) {
  remove_action('admin_notices','update_nag',3);
}





//remove links menu tab from wordpress installs, because we don't use them.
function sb_remove_admin_menus(){

    if ( function_exists('remove_menu_page') ) { 

        remove_menu_page('link-manager.php');  // Remove the Links tab by providing its slug
    }

}
add_action('admin_menu', 'sb_remove_admin_menus');

// Breadcrumbs
function custom_breadcrumbs() {
       
    // Settings
    $separator          = '<span class="glyphicon glyphicon-chevron-right"></span>';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = 'Homepage';
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                   
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo $parents;
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
       
        echo '</ul>';      
    }      
}
?>