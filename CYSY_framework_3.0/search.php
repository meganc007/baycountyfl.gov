<?
/**
 * The template for displaying Search Results pages.
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */

get_header(); ?>
<!-- CYSY Framework 3 Copyright(c)2012-2013 - CYber SYtes, Inc. All Rights Reserved -->
<div class="container">
	<div class="row">
		<div class="col-xs-12">
		<?php custom_breadcrumbs(); ?>
			<section class="content">


				<? if ( have_posts() ) : ?>
				
				    <h1><? printf( __( 'Search Results for: %s', 'CYSY Framework 3' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				    <?
				    /* Run the loop for the search to output the results.
				     * If you want to overload this in a child theme then include a file
				     * called loop-search.php and that will be used instead.
				     */
				     get_template_part( 'loop', 'search' );
				    ?>
				    
				<? else : ?>
				
				    <h1><? _e( 'Nothing Found', 'CYSY Framework 3' ); ?></h1>
				    <p><? _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'CYSY Framework 3' ); ?></p>
				    <? get_search_form(); ?>
				    
				<? endif; ?>
				
				

			<div class="clear"></div>
		    
		    </section><!-- .content -->
	    </div>
    </div>
</div>

<? get_footer(); ?>
