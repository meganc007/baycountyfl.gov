<?
/**
 * The Sidebar containing the primary and secondary widget areas.
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */
?>

		<aside>
			<ul>

			<?
				/* When we call the dynamic_sidebar() function, it'll spit out
				 * the widgets for that widget area. If it instead returns false,
				 * then the sidebar simply doesn't exist, so we'll hard-code in
				 * some default sidebar stuff just in case.
				 */
				if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
	
			<li>
				<? get_search_form(); ?>
			</li>

			<li>
				<h3><? _e( 'Archives', 'CYSY Framework 3' ); ?></h3>
				<ul>
					<? wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li>

			<li>
				<h3><? _e( 'Meta', 'CYSY Framework 3' ); ?></h3>
				<ul>
					<? wp_register(); ?>
					<li><? wp_loginout(); ?></li>
					<? wp_meta(); ?>
				</ul>
			</li>

			<? endif; // end primary widget area ?>
            
            
            
            
			</ul>
		</aside><!-- end ASIDE -->
		<!-- CYSY Framework 3 Copyright(c)2012-2013  - CYber SYtes, Inc. All Rights  Reserved -->