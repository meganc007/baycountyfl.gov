<?
/**
 * The template for displaying Tag Archive pages.
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */

get_header(); ?>
<!-- CYSY Framework 3 Copyright © 2012-2013 - CYber SYtes, Inc. All Rights Reserved -->

	<section class="content">

		<h1><? printf( __( 'Tag Archives: %s', 'CYSY Framework 3' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
	
		<?
	    /* Run the loop for the tag archive to output the posts
	     * If you want to overload this in a child theme then include a file
	     * called loop-tag.php and that will be used instead.
	     */
	     get_template_part( 'loop', 'tag' );
	    ?>
    
	<div class="clear"></div>
    
    </section><!-- .content -->

<? get_sidebar(); ?>
<? get_footer(); ?>
