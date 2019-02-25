<?
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 
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
				<?
		/* Queue the first post, that way we know
		 * what date we're dealing with (if that is the case).
		 *
		 * We reset this later so we can run the loop
		 * properly with a call to rewind_posts().
		 */
		if ( have_posts() )
			the_post();
		?>
		
					<h1>
		<? if ( is_day() ) : ?>
						<? printf( __( 'Daily Archives: <span>%s</span>', 'CYSY Framework 3' ), get_the_date() ); ?>
		<? elseif ( is_month() ) : ?>
						<? printf( __( 'Monthly Archives: <span>%s</span>', 'CYSY Framework 3' ), get_the_date('F Y') ); ?>
		<? elseif ( is_year() ) : ?>
						<? printf( __( 'Yearly Archives: <span>%s</span>', 'CYSY Framework 3' ), get_the_date('Y') ); ?>
		<? else : ?>
						<? _e( 'Highlight Archives', 'CYSY Framework 3' ); ?>
		<? endif; ?>
					</h1>
		
		<?
			/* Queue the first post, that way we know
			 * what date we're dealing with (if that is the case).
			 *
			 * We reset this later so we can run the loop
			 * properly with a call to rewind_posts().
			 */
			$args = array(
		        'post_type' => array( 'highlight' ),
		        'orderby' => 'date',
		        'order' => 'DESC',
	        );
	        $events = new WP_Query($args);
			if ($events->have_posts()) :
	                    while ($events->have_posts()) : $events->the_post();
        ?>
			<div class="col-xs-12 col-sm-4 pad-bottom">
                <div class="featured-content text-center">
                    <h3><?php echo the_title(); ?></h3>
                    <div class="featured-image">
                        <img alt="" src="<?php echo the_post_thumbnail_url(); ?>" />
                    </div>
                    <p><?php echo the_excerpt(); ?></p>
                    <a href="<?php echo the_permalink(); ?>" class="readmore">
                        <span class="read-more">Read More <span class="glyphicon glyphicon-chevron-right"></span></span>
                    </a>
                </div>
            </div>
		<?php
	        //End Loop
	        endwhile;
	        endif;
	    ?>


	<div class="clear"></div>
    
    </section><!-- .content -->


<? get_footer(); ?>
