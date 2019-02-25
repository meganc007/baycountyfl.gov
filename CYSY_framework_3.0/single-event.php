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
			<?php custom_breadcrumbs(); ?>
				<? //if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?if (have_posts()) :
	                    while (have_posts()) : the_post();
	                $eventphoto = get_post_meta ($post->ID, 'wpcf-event_photo', $single = true);
                    $locationname = get_post_meta ($post->ID, 'wpcf-location_name', $single = true);
                    $eventdate = get_post_meta ($post->ID, 'wpcf-event_date', $single = true);
                    $eventstreet = get_post_meta ($post->ID, 'wpcf-street', $single = true);
                    $eventcity = get_post_meta ($post->ID, 'wpcf-city', $single = true);
                    $eventstate = get_post_meta ($post->ID, 'wpcf-state', $single = true);
                    $eventphonenumber = get_post_meta ($post->ID, 'wpcf-phone_number', $single = true);

                    $exploded = explode('-', $eventdate);
                    $event_year = $exploded[0];
                    $event_month = $exploded[1];
                    $event_day = $exploded[2];

                    $dateObj   = DateTime::createFromFormat('!m', $event_month);
                    $event_month_abbr = $dateObj->format('M'); // outputs Dec
                    $event_month_full = $dateObj->format('F'); // outputs December

                    $areacode= substr($eventphonenumber, 0, 3);
                    $phnumb3 = substr($eventphonenumber, 3, 3);
                    $phnumb4 = substr($eventphonenumber, 6, 10);
				?>
    
        
	        <h1><? the_title(); ?></h1>
	        <p><?php echo 'Event Date: ' . $event_month_full . ' '. $event_day . ', ' . $event_year; ?></p>
	        <p><?php echo the_post_thumbnail(); ?></p>
	        <p><a href="tel:+<?php echo $eventphonenumber; ?>"><?php echo '(' . $areacode . ') ' . $phnumb3 . '-' . $phnumb4 . '</a><br>'; ?>
		        <?php if ( ! empty ( $locationname ) ) { ?>
	                <?php echo $locationname; ?>
	            <?php } ?>
		        <?php if ( ! empty ( $eventstreet ) && ! empty ( $eventcity ) && ! empty ( $eventstate )) { ?>
	                <?php echo '<br>' . $eventstreet . ', ' . $eventcity . ', ' . $eventstate; ?>
	            <?php } ?>
	        </p>			
			<?php the_content(); ?>
	        
	        <div class="clear"></div>
	           

			
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
