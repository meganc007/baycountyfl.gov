<?
/**
 * The template for displaying 404 pages (Not Found).
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */

get_header(); ?>
<!-- CYSY Framework 3 Copyright © 2012-2013 - CYber SYtes, Inc. All Rights Reserved -->
<div class="container">
	<div class="row">

		<section class="content col-xs-12">

			<h1><? _e( 'Wow... There\'s Nothing Here.', 'CYSY Framework 3' ); ?></h1>
			<p><? _e( 'Apologies, We weren\'t able to find what you\'re looking for. Perhaps searching will help find a related post.', 'CYSY Framework 3' ); ?></p>
				<? get_search_form(); ?>
			
			<script type="text/javascript">
				// focus on search field after it has loaded
				document.getElementById('s') && document.getElementById('s').focus();
			</script>

		<div class="clear"></div>
	    
	    </section><!-- .content -->
	</div>
</div>
<? get_footer(); ?>