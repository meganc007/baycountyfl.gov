<?
/**
 * Custom Post Types
 *
 * @package WordPress
 * @subpackage CYSY Framework 3
 */
 
///////////////////////////////////////////////////////////////////////////// Custom Post Type
// See http://codex.wordpress.org/Custom_Post_Types for help on usage of custom post types

add_action('init', 'nerf_register');

function nerf_register() {
	$args = array(
		'label' => __('Nerf Guns'),
		'singular_label' => __('Nerf Gun'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		// this controls whether or not post can have category format
		'hierarchical' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'tags',),
		// make sure your slug doesn't match other slugs within site build
		'rewrite' => array( 'slug' => 'nerf-guns', 'with_front' => true ),
		'_builtin' =>  false, 
	);

	register_post_type( 'nerf' , $args );
}

// THIS SECTION ADDS SIDEBAR TAXONOMIES TO THE Testimonials CUSTOM POST TYPE in the back office
function add_nerf_types() {
	register_taxonomy(
		// title of taxonomy
		'Gun Categories',
		// post type name goes here
		'nerf',
		array(
			'label' => __('Categories'),
			'sort' => true,
			// this controls whether or not post can have category format, make false if you want Tags instead
			'hierarchical' => true,
			'args' => array('orderby' => 'term_order'),
			'rewrite' => array('slug' => 'gun-types'),
		)
	);
}
 
add_action('init', 'add_nerf_types');

// LIST POST TYPES FROM ALL CATEORIES WITHIN A TAXONOMY WITH A <UL> AND HEADER
/*
$terms = get_terms('project-categories');
			
foreach ($terms as $term) {
	$wpq = array ('taxonomy'=>'project-categories','term'=>$term->slug);
	$query = new WP_Query ($wpq);
	$article_count = $query->post_count;
	echo "<h3>";
	echo $term->name;
	echo "</h3>";
	if ($article_count) {
		echo "<ul>";
		$posts = $query->posts;
		foreach ($posts as $post) {
			echo "<li><a href=\"".get_permalink()."\">".$post->post_title."</a></li>";
		}
		echo "</ul>";
	}
}*/


// LIST POST TYPES FROM A SINGLE CATEGORY FROM A TAXONOMY
/*
$terms = get_terms('project-categories');

$wpq = array ('taxonomy'=>'project-categories','term'=> 'residential-projects');
$query = new WP_Query ($wpq);

echo "<h3>";
echo $term->name;
echo "</h3>";
echo "<ul>";
	
$article_count = $query->post_count;
if ($article_count) {
	
	$posts = $query->posts;
	foreach ($posts as $post) {
		echo "<li><a href=\"".get_permalink()."\">".$post->post_title."</a></li>";
	}
	
}
echo "</ul>";
*/








// IF YOU NEED TO INCLUDE CUSTOM POST TYPES WITHIN THE TRADITIONAL BLOG POSTS USE THE CODE BELOW

/*add_filter( 'pre_get_posts' , 'ucc_include_custom_post_types' );
function ucc_include_custom_post_types( $query ) {
 global $wp_query;

 if ( !is_preview() && !is_admin() && !is_singular() ) {
   $args = array(
     'public' => true ,
     '_builtin' => false
   );
   $output = 'names';
   $operator = 'and';

   $post_types = get_post_types( $args , $output , $operator );

   $post_types = array_merge( $post_types , array( 'post' ) );

   if ($query->is_feed) {
   } else {
     $my_post_type = get_query_var( 'post_type' );
     if ( empty( $my_post_type ) )
       $query->set( 'post_type' , $post_types );
   }
 }

 return $query;
}*/




 
?>