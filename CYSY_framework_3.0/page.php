<?
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */

get_header(); ?>
<!-- CYSY Framework 3 Copyright(c)2012-2013 - CYber SYtes, Inc. All Rights Reserved -->
<div class="container">
	<div class="row">
		<section class="content col-xs-12">
		<?php custom_breadcrumbs(); ?>

			<? if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			
			    
				<h1><? the_title(); ?></h1>
				<? the_content(); ?>
			    <div class="clear"></div>
			
			    <? //comments_template( '', true ); ?>
			
			<? endwhile; ?>

		<div class="clear"></div>
	    
	    </section><!-- .content -->
	</div>
</div>
<? get_footer(); ?>