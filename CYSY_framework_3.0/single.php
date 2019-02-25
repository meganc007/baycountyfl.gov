<?
/**
 * The Template for displaying all single posts.
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */

get_header(); ?>
<!-- CYSY Framework 3 Copyright © 2012-2013 - CYber SYtes, Inc. All Rights Reserved -->

	<section class="content container">
		<div class="row">
			<div class="col-xs-12">
			<?php custom_breadcrumbs(); ?>
				<? if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    
        
	        <h1><? the_title(); ?></h1>
	        
	        <small><? framework_posted_on(); ?></small>
	        
			<? the_content(); ?>
	        
	        <div class="clear"></div>
	           
			<p><? framework_posted_in(); ?></p>
			
			<div class="clear"></div>
			
			<? comments_template( '', true ); ?>
    
			<? endwhile; // end of the loop. ?>
			
			</div>
		</div>


	<div class="clear"></div>
    
    </section><!-- .content -->

<? get_footer(); ?>
