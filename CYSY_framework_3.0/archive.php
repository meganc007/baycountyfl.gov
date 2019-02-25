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
						<? _e( 'Blog Archives', 'CYSY Framework 3' ); ?>
		<? endif; ?>
					</h1>
		
		<?
		/* Since we called the_post() above, we need to
		 * rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts();
	
		/* Run the loop for the archives page to output the posts.
		 * If you want to overload this in a child theme then include a file
		 * called loop-archives.php and that will be used instead.
		 */
		 get_template_part( 'loop', 'archive' );
		?>
			</div>
		</div>

		


	<div class="clear"></div>
    
    </section><!-- .content -->


<? get_footer(); ?>
