<?
/**
 * The template for displaying Category Archive pages.
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */

get_header(); ?>
<!-- CYSY Framework 3 Copyright © 2012-2013 - CYber SYtes, Inc. All Rights Reserved -->


	<section class="content">


	    <h1><? printf( __( 'Category Archives: %s', 'CYSY Framework 3' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
	    <?
	        $category_description = category_description();
	        if ( ! empty( $category_description ) )
	            echo '<div class="archive-meta">' . $category_description . '</div>';
	    
	    /* Run the loop for the category page to output the posts.
	     * If you want to overload this in a child theme then include a file
	     * called loop-category.php and that will be used instead.
	     */
	    get_template_part( 'loop', 'category' );
	    ?>
    
    <div class="clear"></div>
    
    </section><!-- .content -->

<? get_sidebar(); ?>
<? get_footer(); ?>
