<?
/**
 * The Header for the theme
 *
 * Displays all of the <head> section and everything that 
 resides above your content in the code and will be repeating 
 for all pages of the site. There are exceptions that you can use if statements for
 * @package WordPress
 * @subpackage CYSY Framework 3
 * @since CYSY Framework 3.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
<link href="https://fonts.googleapis.com/css?family=Abel|Hammersmith+One|Merriweather|Montserrat" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- This is just a lot of code for applying custom titles based on the information for pages -->
<title>
<?php global $page, $paged; wp_title( '|', true, 'right' ); bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'framework' ), max( $paged, $page ) );
?>
</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<? bloginfo( 'pingback_url' ); ?>" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- This is the default call to the styles.css file within this theme -->
<link rel="stylesheet" type="text/css" media="all" href="<? bloginfo( 'stylesheet_url' ); ?>" />

<?
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* ****  ALWAYS **** have wp_head() just before the closing </head> tag of your theme */
	wp_head();
?>
<!-- Copyright(c) 2012-2013 - CYber SYtes,  Inc. All Rights Reserved -->


</head>


<!-- Be sure to keep the body_class(); function in the <body> tag below. -->
<body <? body_class(); ?>>

<header class="site_header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="col-xs-12 col-md-3 text-center pad-bottom pad-top">
                    <img alt="" src="<?php bloginfo('stylesheet_directory'); ?>/images/baycountylogo.png">
                </div>
                <div class="col-xs-12 col-md-9">
                    <div class="col-xs-12">
                        <? get_search_form(); ?>
                        <script type="text/javascript">
                            // focus on search field after it has loaded
                            document.getElementById('s') && document.getElementById('s').focus();
                        </script>
                    </div>
                    <nav id="primary-bootstrap-menu" class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">
                            <div class="">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-navigation">
                                    <span>Menu</span>
                                </button>
                            </div>
                            <?php wp_nav_menu( array( 'menu'=> 'primary', 'theme_location' => 'primary', 'depth' => 2, 'container' => 'div', 'container_class' => 'collapse navbar-collapse', 'container_id' => 'primary-navigation', 'menu_class' => 'nav navbar-nav pull-right', 'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 'walker' => new wp_bootstrap_navwalker()) ); ?>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>    
</header>

<section class="main">
