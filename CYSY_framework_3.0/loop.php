<?
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */
?>





<? /* If there are no posts to display, such as an empty archive page */
// CYSY Framework  3 Copyright(c) 2012-2013 - CYber SYtes,  Inc. All Rights Reserved ?>
<? if ( ! have_posts() ) : ?>
	<article id="post-0" class="post error404 not-found">
		<h1><? _e( 'Wow... There\'s Nothing Here.', 'CYSY Framework 3' ); ?></h1>
        <p><? _e( 'Apologies, We weren\'t able to find what you\'re looking for. Perhaps searching will help find a related post.', 'CYSY Framework 3' ); ?></p>
        <? get_search_form(); ?>
	</article><!-- #post-0 -->
<? endif; ?>







     
     
<? while ( have_posts() ) : the_post(); ?>

		<article id="post-<? the_ID(); ?>" <? post_class(); ?>>
			<h2 class="entry-title"><a href="<? the_permalink(); ?>" title="<? printf( esc_attr__( 'Permalink to %s', 'CYSY Framework 3' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><? the_title(); ?></a></h2>

			<small><? framework_posted_on(); ?></small>

	<? if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			
				<? the_excerpt(); ?>
                
	<? else : ?>
			
			
			
			
				<!-- BELOW WE ARE DETECTING MOBILE DEVICES... AND APPLYING AN EXCERPT FOR MOBILE DEVICES -->
				
				<?php
				$mobile_browser = '0';
				if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
				    $mobile_browser++;
				}
				if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
				    $mobile_browser++;
				}    
				$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
				$mobile_agents = array(
				    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
				    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
				    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
				    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
				    'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
				    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
				    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
				    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
				    'wapr','webc','winw','winw','xda ','xda-');
				 
				if (in_array($mobile_ua,$mobile_agents)) {
				    $mobile_browser++;
				}
				if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
				    $mobile_browser++;
				}
				if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
				    $mobile_browser = 0;
				}
				
				
				// IF WE'RE USING MOBILE DEVICE, GIVE US JUST THE EXCERPT
				if ($mobile_browser > 0) {
				   the_excerpt();
				}
				
				// OTHERWISE DISPLAY THE FULL CONTENT OF A POST
				else {
				   the_content();
				}   
				 
				?>
			
	<? endif; ?>

			
				<? if ( count( get_the_category() ) ) : ?>
					
						<p><? printf( __( '<span class="%1$s">Posted in</span> %2$s', 'CYSY Framework 3' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?></p>
					
				<? endif; ?>
				<?
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					
						<p><? printf( __( '<span class="%1$s">Tagged</span> %2$s', 'CYSY Framework 3' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?></p>
					
				<? endif; ?>
                <!-- Comments link -->
				<p><? comments_popup_link( __( 'Leave a comment', 'CYSY Framework 3' ), __( '1 Comment', 'CYSY Framework 3' ), __( '% Comments', 'CYSY Framework 3' ) ); ?></p>
				
		</article>

<? endwhile; // End the loop. Whew. ?>

<? /* Display previous_next to next/previous pages when applicable */ ?>
<? if (  $wp_query->max_num_pages > 1 ) : ?>
		<section class="older_newer">
			<div class="alignright"><? next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'CYSY Framework 3' ) ); ?></div>
			<div class="alignleft"><? previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'CYSY Framework 3' ) ); ?></div>
            <div class="clear"></div>
		</section><!-- #nav-below -->
<? endif; ?>
