<?
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */
?>



</section><!-- .main -->

<footer class="container-fluid">
	<div class="row">
		<div class="col-xs-12 bg orange-box">
			<div class="col-xs-12 col-sm-4 fcol">
	            <h4 class="uppercase">Menu</h4>
	            <?php wp_nav_menu( array( 'menu'=> 'footer-nav', 'theme_location' => 'footer', 'depth' => 2, 'container' => 'div', 'container_class' => '', 'container_id' => 'footer-navigation', 'menu_class' => 'footer-nav', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker()) ); ?>
	        </div>
	        <div class="col-xs-12 col-sm-4 fcol">
	            <h4 class="uppercase">Location</h4>
	            <p>1111 Street Name<br>City Name, State, zip</p>
	            <p>Phone number: <br>
	            Fax number: <br>
	            Email: </p>
	        </div>
	        <div class="col-xs-12 col-sm-4 fcol marginbot">
	            <h4 class="uppercase">Constitutional Offices</h4>
	            <ul>
	            	<li>Supervisor of Elections</li>
		            <li>Property Appraiser</li>
		            <li>Sheriff</li>
		            <li>Tax Collector</li>
		            <li>Clerk of the Circuit Court</li>
	            </ul>	            
	        </div>
	        <div class="clear"></div>
	        <div class="row">
	        	<div class="col-xs-12 copyright text-center">
					<p>&copy; Copyright <?php the_time('Y') ?>. All Rights Reserved. Site Designed by: <a href="http://www.cysy.com" target="_blank" title="Panama City Beach Web Design">CYber SYtes, Inc. Web SYtes by Design</a>.</p>
				</div>
	        </div>
	        <div class="clear"></div>
		</div>
	</div>

</footer>


<!-- ************  This is a decent place to begin creating your own Greatness. Scripts go here people. -->


<script type="text/javascript" src="<? bloginfo('template_url'); ?>/js/modernizr-2.5.3.js"></script>



<!-- ************  end of decent place -->

<?
	/* ****** Always ****** have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>


    
</body>
</html>





<!-- CYSY  Framework  3 Copyright(c) 2012-2013  - CYber SYtes,  Inc.  All  Rights  Reserved  -->