<?
/**
 * Template Name: Full Width, No Sidebar
 *
 * A custom page template without sidebar.
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */

get_header(); ?>
<!-- CYSY Framework 3 Copyright(c)2012-2013 - CYber SYtes, Inc. All Rights Reserved -->

	<section class="content">

		<? if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
			<h1 class="entry-title"><? the_title(); ?></h1>
			<? the_content(); ?>
			<div class="clear"></div>
		
		    <? // comments_template( '', true ); ?>
		
		<? endwhile; ?>

	<div class="clear"></div>
    
    </section><!-- .content -->

<? get_footer(); ?>
