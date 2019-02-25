<?
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */
get_header(); ?>
<script>
    // $(document).scroll(function highlightsfadein() {
    //     $('.featured-content').css('opacity', '0');
    //     var pg_pos = $(this).scrollTop();
    //     if (pg_pos >= 250) {
    //         $('.featured-content').fadeTo(1250, 1);
    //     }
    // });
    $(document).scroll(function addanimation() {
        var pg_pos = $(this).scrollTop();
        if ( $( window ).height() >= 1900 ) {
            var sizetester = 1;
        }

        $('.calendar').css('opacity', '0');
        if (pg_pos >= 1200 || ( sizetester == 1 && pg_pos >= 800 ) ) {
            $('#events').addClass('animated rubberBand');
            $('.calendar').css('opacity', '1');
            $('.calendar').addClass('animated lightSpeedIn');
        }
        $('.fcol').css('opacity', '0');

        if (pg_pos >= 1200 || ( sizetester == 1 && pg_pos >= 900 ) ) {
        	$('.fcol').css('opacity', '1');
            $('.fcol').addClass('animated slideInDown');
        }
    });
</script>
    <section class="container-fluid">
        <div class="row">
            <div id="slider" class="col-xs-12 text-center blue-box shadow">
                <?php echo do_shortcode('[wds id="1"]'); ?>
            </div>
        </div>
        <div class="clear"></div>
    </section>
    <section class="container-fluid">
        <div class="row highlights-section">
            <div class="col-xs-12">
                <p>
                    <h1 class="pull-left animated bounceInLeft">Area Highlights</h1>
                    <span class="pull-right readmore-span animated bounceInRight"><a href="<?php echo get_post_type_archive_link( 'highlight' ); ?>">See More <span class="glyphicon glyphicon-chevron-right"></span></a></span>
                </p>
            </div>
            <div class="col-xs-12">
                <?php
                    //Start Loop
                    $args = array(
                    'post_type' => array( 'highlight' ),
                    'posts_per_page' => 3,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    );
                    $recentpost = new WP_Query($args);
                    if ($recentpost->have_posts()) :
                    while ($recentpost->have_posts()) : $recentpost->the_post();
                ?>
                <div class="col-xs-12 col-sm-4">
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
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="row">
            <div class="col-xs-12 blue-box-top shadow mar-top75">
                <div id="eventdiv" class="eventsbg events">
                    <h2 id="events" class="text-center">Upcoming Events</h2>
                    <?php
                    //Start Loop
                    $args = array(
                    'post_type' => array( 'event' ),
                    'posts_per_page' => 4,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    );
                    $recentpost = new WP_Query($args);
                    if ($recentpost->have_posts()) :
                    while ($recentpost->have_posts()) : $recentpost->the_post();

                    $eventphoto = get_post_meta ($post->ID, 'wpcf-event_photo', $single = true);
                    $locationname = get_post_meta ($post->ID, 'wpcf-location_name', $single = true);
                    $eventdate = get_post_meta ($post->ID, 'wpcf-event_date', $single = true);
                    $eventstreet = get_post_meta ($post->ID, 'wpcf-street', $single = true);
                    $eventcity = get_post_meta ($post->ID, 'wpcf-city', $single = true);
                    $eventstate = get_post_meta ($post->ID, 'wpcf-state', $single = true);
                    $eventzip = get_post_meta ($post->ID, 'wpcf-zip', $single = true);
                    $eventphonenumber = get_post_meta ($post->ID, 'wpcf-phone_number', $single = true);

                    $exploded = explode('-', $eventdate);
                    $event_year = $exploded[0];
                    $event_month = $exploded[1];
                    $event_day = $exploded[2];

                    $dateObj   = DateTime::createFromFormat('!m', $event_month);
                    $event_month_abbr = $dateObj->format('M'); // outputs Dec
                    $event_month_full = $dateObj->format('F'); // outputs December
                ?>
                <div class="col-xs-12 col-md-6">
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
                <?php
                //End Loop
                endwhile;
                endif;
                ?>
                <div class="clear"></div>
                <div class="col-xs-12 pull-right">
                    <span class="more-events pull-right"><a href="/bbocc.gov/event">More Events<span class="glyphicon glyphicon-chevron-right"></span></a></span>
                </div>
                <div class="clear"></div>
                </div>
            </div>
        </div>
    </section>
    <div class="clear"></div>

<? get_footer(); ?>
