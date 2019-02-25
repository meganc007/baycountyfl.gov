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
			<h1>
				<? if ( is_day() ) : ?>
								<? printf( __( 'Daily Archives: <span>%s</span>', 'CYSY Framework 3' ), get_the_date() ); ?>
				<? elseif ( is_month() ) : ?>
								<? printf( __( 'Monthly Archives: <span>%s</span>', 'CYSY Framework 3' ), get_the_date('F Y') ); ?>
				<? elseif ( is_year() ) : ?>
								<? printf( __( 'Yearly Archives: <span>%s</span>', 'CYSY Framework 3' ), get_the_date('Y') ); ?>
				<? else : ?>
								<? _e( 'Events', 'CYSY Framework 3' ); ?>
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
		        'post_type' => array( 'event' ),
		        'orderby' => 'date',
		        'order' => 'DESC',
	        );
	        $events = new WP_Query($args);
			if ($events->have_posts()) :
	                    while ($events->have_posts()) : $events->the_post();
	                $eventdate = get_post_meta ($post->ID, 'wpcf-event_date', $single = true);
	                $eventphoto = get_post_meta ($post->ID, 'wpcf-event_photo', $single = true);
	                $exploded = explode('-', $eventdate);
	                $event_year = $exploded[0];
	                $event_month = $exploded[1];
	                $event_day = $exploded[2];

	                $dateObj   = DateTime::createFromFormat('!m', $event_month);
	                $event_month_abbr = $dateObj->format('M'); // outputs Dec
	                $event_month_full = $dateObj->format('F'); // outputs December
			?>
			<div class="col-xs-12 pad-top">
                <div class="col-xs-12 pad-left30">
                    <div class="calendar">
                        <div class="pull-left calendarinfo">
                            <h3 class="eventheader"><?php echo $event_month_abbr;?></h3>
                            <p class="eventday"><?php echo $event_day; ?></p>
                        </div>
                        <div class="eventlist">
                            <h3><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h3>
                            <?php if ( ! empty ( $eventstreet ) && ! empty ( $eventcity ) && ! empty ( $eventstate )) { ?>
                                <p class="eventlocation"><?php echo $eventstreet . ', ' . $eventcity . ', ' . $eventstate; ?></p>
                            <?php } ?>
                            <?php echo the_excerpt(); ?>
                        </div>
                    </div>
                </div>
            </div>
			<?
			
			/* Since we called the_post() above, we need to
			 * rewind the loop back to the beginning that way
			 * we can run the loop properly, in full.
			 */
			//rewind_posts();
		
			/* Run the loop for the archives page to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-archives.php and that will be used instead.
			 */
			// get_template_part( 'loop', 'archive' );
			?>
			
		<?php
	        //End Loop
	        endwhile;
	        endif;
	    ?>
    </div>
    </div>
	<div class="clear"></div>
    
    </section><!-- .content -->


<? get_footer(); ?>
