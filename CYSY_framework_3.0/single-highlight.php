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
			<div class="col-xs-12 pad-bottom">
			<?php custom_breadcrumbs(); ?>
				<? //if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?if (have_posts()) :
	                    while (have_posts()) : the_post();
				?>
    
        
	        <h1><? the_title(); ?></h1>
	        <p><?php echo the_post_thumbnail(); ?></p>			
			<?php the_content(); ?>
			<p><a href="http://cysy.pairserver.com/bbocc.gov/highlight/">Back to Highlights</a></p>
			
			<div class="clear"></div>
			<?php
		        //End Loop
		        endwhile;
		        endif;
		    ?>
    
			<? //endwhile; // end of the loop. ?>
			
			</div>
		</div>


	<div class="clear"></div>
    
    </section><!-- .content -->

<? get_footer(); ?>
