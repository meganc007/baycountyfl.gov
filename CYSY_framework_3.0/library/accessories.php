<?php

/*
 * Theme Accessories
 * Author: Cheyne Sutherland
 */
 

/* ..................................... CONTENT SLIDER ..................................... */
/* This adds a Nivo Slider widget to the theme. For more info, go to http://nivo.dev7studios.com/
 * In order for the slider to function properly, you must add the following to the footer file:
 * <?php include(TEMPLATEPATH . '/accessories/slider/includes/slider_scripts.php'); ?>
 */


// DEFINE WIDGET VARIABLES

	function content_slider_widget($args, $widget_args = 1) {
		
	extract( $args, EXTR_SKIP );
	if ( is_numeric($widget_args) )
	$widget_args = array( 'number' => $widget_args );
	$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
	extract( $widget_args, EXTR_SKIP );
	
	$options = get_option('slider_widget');
	if ( !isset($options[$number]) ) 
	return;

	global $slider_fx;
	global $slider_speed;
	global $slider_pause;
	global $slider_slices;
	global $slider_boxcols;
	global $slider_boxrows;
	global $slider_controls;
	global $slider_prevnext;
	global $slider_hoverprevnext;
	global $slider_hoverpause;
	
	$before_widget = '<!-- CONTENT SLIDER WIDGET -->';
	$after_widget = '<!-- /CONTENT SLIDER WIDGET -->';
	$title = $options[$number]['title'];
	$text1 = $options[$number]['text1'];
	$text2 = $options[$number]['text2'];
	$text3 = $options[$number]['text3'];
	$text4 = $options[$number]['text4'];
	$check = $options[$number]['check'];
	$check1 = $options[$number]['check1'];
	$check2 = $options[$number]['check2'];
	$check3 = $options[$number]['check3'];
	$select = $options[$number]['select'];
	$slider_fx = $select;	
	$slider_speed = $title;
	$slider_pause = $text1;
	$slider_slices = $text2;
	$slider_boxcols = $text3;
	$slider_boxrows = $text4;	
	$slider_controls = $check;
	$slider_prevnext = $check1;
	$slider_hoverprevnext = $check2;
	$slider_hoverpause = $check3;
			
	echo $before_widget; ?>
		
	<!-XXXXXXXXXXXXXXXXXXXX BEGIN SLIDER CONTENT XXXXXXXXXXXXXXXXXXXX-->
	
	<div id="slider" class="nivoSlider">
	
	<img src="<?php bloginfo('template_url'); ?>/accessories/slider/images/photo_slider1.jpg" />
	<img src="<?php bloginfo('template_url'); ?>/accessories/slider/images/photo_slider2.jpg" />
	<img src="<?php bloginfo('template_url'); ?>/accessories/slider/images/photo_slider3.jpg" />
	<img src="<?php bloginfo('template_url'); ?>/accessories/slider/images/photo_slider4.jpg" />
	
	</div>
	
	<!-XXXXXXXXXXXXXXXXXXXXX END SLIDER CONTENT XXXXXXXXXXXXXXXXXXXXX-->
			
	<?php echo $after_widget; }
	
	
// DO NOT EDIT ANYTHING BELOW THIS POINT UNLESS YOU KNOW WHAT YOU ARE DOING!

// BUILDS WIDGET FUNCTIONALITY		

	function content_slider_widget_control($widget_args) {
	
	global $wp_registered_widgets;
	static $updated = false;
	
	if ( is_numeric($widget_args) )
	$widget_args = array( 'number' => $widget_args );			
	$widget_args = wp_parse_args( $widget_args, array( 'number' => -1 ) );
	extract( $widget_args, EXTR_SKIP );
	
	$options = get_option('slider_widget');
		
	if ( !is_array($options) )	
	$options = array();
	
	if ( !$updated && !empty($_POST['sidebar']) ) {
		
	$sidebar = (string) $_POST['sidebar'];	
	$sidebars_widgets = wp_get_sidebars_widgets();
			
	if ( isset($sidebars_widgets[$sidebar]) )
	$this_sidebar =& $sidebars_widgets[$sidebar];
	else
	$this_sidebar = array();
	
	foreach ( (array) $this_sidebar as $_widget_id ) {
	if ( 'content_slider_widget' == $wp_registered_widgets[$_widget_id]['callback'] && isset($wp_registered_widgets[$_widget_id]['params'][0]['number']) ) {
	$widget_number = $wp_registered_widgets[$_widget_id]['params'][0]['number'];
	if ( !in_array( "slider-widget-$widget_number", $_POST['widget-id'] ) )
	unset($options[$widget_number]); }}
	
	foreach ( (array) $_POST['slider-widget'] as $widget_number => $slider_widget ) {
	if ( !isset($slider_widget['title']) && isset($options[$widget_number]) )
	continue;
				
	$title = strip_tags(stripslashes($slider_widget['title']));
	$text1 = strip_tags(stripslashes($slider_widget['text_value1']));
	$text2 = strip_tags(stripslashes($slider_widget['text_value2']));
	$text3 = strip_tags(stripslashes($slider_widget['text_value3']));
	$text4 = strip_tags(stripslashes($slider_widget['text_value4']));				
	$check = $slider_widget['check_value'];
	$check1 = $slider_widget['check_value1'];
	$check2 = $slider_widget['check_value2'];
	$check3 = $slider_widget['check_value3'];
	$select = $slider_widget['select_value'];
				
	// COMPACT VALUES INTO AN ARRAY
	$options[$widget_number] = compact( 'select', 'title', 'text1', 'text2', 'text3', 'text4', 'check', 'check1', 'check2', 'check3' ); }
	
	update_option('slider_widget', $options);
	$updated = true; }
	
	if ( -1 == $number ) { // CHECK TO SEE IF NEW SLIDER
	
	$title = '300';
	$text1 = '5000';
	$text2 = '15';
	$text3 = '8';
	$text4 = '4';
	$check = '';
	$check1 = '';
	$check2 = '';
	$check3 = '';
	$select = '';
	$number = '%i%';
			
	} else { // ELSE GET EXISTING VALUES
		
	$title = attribute_escape($options[$number]['title']); // attribute_escape used for security
	$text1 = attribute_escape($options[$number]['text1']); // attribute_escape used for security
	$text2 = attribute_escape($options[$number]['text2']); // attribute_escape used for security
	$text3 = attribute_escape($options[$number]['text3']); // attribute_escape used for security
	$text4 = attribute_escape($options[$number]['text4']); // attribute_escape used for security
	$check = $options[$number]['check'];
	$check1 = $options[$number]['check1'];
	$check2 = $options[$number]['check2'];
	$check3 = $options[$number]['check3'];
	$select = $options[$number]['select']; } ?>
	
<p>
	<label>Slider Effect:</label><br />
        <select style="width: 226px;" id="select_value_<?php echo $number; ?>" name="slider-widget[<?php echo $number; ?>][select_value]">
        	<option <?php if ($select == 'fade') echo 'selected'; ?> value="fade">Fade</option>
			<option <?php if ($select == 'fold') echo 'selected'; ?> value="fold">Fold</option>
			<option <?php if ($select == 'slideInLeft') echo 'selected'; ?> value="slideInLeft">Slide Left</option>
			<option <?php if ($select == 'slideInRight') echo 'selected'; ?> value="slideInRight">Slide Right</option>
			<option <?php if ($select == 'sliceDown') echo 'selected'; ?> value="sliceDown">Slice Down</option>
			<option <?php if ($select == 'sliceDownLeft') echo 'selected'; ?> value="sliceDownLeft">Slice Down Left</option>
			<option <?php if ($select == 'sliceUp') echo 'selected'; ?> value="sliceUp">Slice Up</option>
			<option <?php if ($select == 'sliceUpLeft') echo 'selected'; ?> value="sliceUpLeft">Slice Up Left</option>
			<option <?php if ($select == 'sliceUpDown') echo 'selected'; ?> value="sliceUpDown">Slice Up Down</option>
			<option <?php if ($select == 'sliceUpDownLeft') echo 'selected'; ?> value="sliceUpDownLeft">Slice Up Down Left</option>
			<option <?php if ($select == 'boxRandom') echo 'selected'; ?> value="boxRandom">Box Random</option>
			<option <?php if ($select == 'boxRainReverse') echo 'selected'; ?> value="boxRainReverse">Box Rain Reverse</option>
			<option <?php if ($select == 'boxRainGrow') echo 'selected'; ?> value="boxRainGrow">Box Rain Grow</option>
			<option <?php if ($select == 'boxRainGrowReverse') echo 'selected'; ?> value="boxRainGrowReverse">Box Rain Grow Reverse</option>
			<option <?php if ($select == 'random') echo 'selected'; ?> value="random">Random</option>
        </select>    
</p>

<p>
	<label style="width: 150px; display: inline-block;">Effect Length:</label><input style="text-align: right;" id="title_value_<?php echo $number; ?>" name="slider-widget[<?php echo $number; ?>][title]" type="text" size="3" value="<?=$title?>" /><label> ms</label><br />
        
	<label style="width: 150px; display: inline-block;">Pause Time:</label><input style="text-align: right;" id="text_value1_<?php echo $number; ?>" name="slider-widget[<?php echo $number; ?>][text_value1]" type="text" size="3" value="<?=$text1?>" /><label> ms</label><br />

	<label style="width: 150px; display: inline-block;">Slices:</label><input style="text-align: right;" id="text_value2_<?php echo $number; ?>" name="slider-widget[<?php echo $number; ?>][text_value2]" type="text" size="3" value="<?=$text2?>" /><br />
        
       <label style="width: 150px; display: inline-block;">Columns:</label><input style="text-align: right;" id="text_value3_<?php echo $number; ?>" name="slider-widget[<?php echo $number; ?>][text_value3]" type="text" size="3" value="<?=$text3?>" /><br />

	<label style="width: 150px; display: inline-block;">Rows:</label><input style="text-align: right;" id="text_value4_<?php echo $number; ?>" name="slider-widget[<?php echo $number; ?>][text_value4]" type="text" size="3" value="<?=$text4?>" />
</p>        

<fieldset style="border: solid 1px #ccc; padding: 10px; text-align: center;">
	<legend>Slider Options</legend>
	<p style="text-align: left;">
		<input style="margin-right: 5px;" id="check_value_<?php echo $number; ?>" name="slider-widget[<?php echo $number; ?>][check_value]" type="checkbox" <?php if($check){ echo 'checked="checked"';} ?> value="true" />Navigation Controls<br />
		
		<input style="margin-right: 5px;" id="check_value1_<?php echo $number; ?>" name="slider-widget[<?php echo $number; ?>][check_value1]" type="checkbox" <?php if($check1){ echo 'checked="checked"';} ?> value="true" />Prev/Next Buttons<br />
		
		<input style="margin-right: 5px;" id="check_value2_<?php echo $number; ?>" name="slider-widget[<?php echo $number; ?>][check_value2]" type="checkbox" <?php if($check2){ echo 'checked="checked"';} ?> value="true" />Show Prev/Next on Hover<br />
		
		<input style="margin-right: 5px;" id="check_value3_<?php echo $number; ?>" name="slider-widget[<?php echo $number; ?>][check_value3]" type="checkbox" <?php if($check3){ echo 'checked="checked"';} ?> value="true" />Pause on Hover
	</p>    
</fieldset>
    
<input type="hidden" name="slider-widget[<?php echo $number; ?>][submit]" value="1" />
    
<?php }
	
// REGISTER WIDGET / SETTINGS	

	function content_slider_widget_register() {
	if ( !$options = get_option('slider_widget') )
	$options = array();
	$widget_ops = array('classname' => 'slider_widget', 'description' => __('Add a powerful content slider to your site'));
	$control_ops = array('width' => 250, 'height' => 350, 'id_base' => 'slider-widget');
	$name = __('Content Slider');
	
	$id = false;
		
	foreach ( (array) array_keys($options) as $o ) {
	
	if ( !isset( $options[$o]['title'] ) )
	continue;
						
	$id = "slider-widget-$o";
	wp_register_sidebar_widget($id, $name, 'content_slider_widget', $widget_ops, array( 'number' => $o ));
	wp_register_widget_control($id, $name, 'content_slider_widget_control', $control_ops, array( 'number' => $o )); }
		
	if ( !$id ) {
	wp_register_sidebar_widget( 'slider-widget-1', $name, 'content_slider_widget', $widget_ops, array( 'number' => -1 ) );
	wp_register_widget_control( 'slider-widget-1', $name, 'content_slider_widget_control', $control_ops, array( 'number' => -1 ) ); }}

// To enable this widget, uncomment the following line.
add_action('init', content_slider_widget_register, 1);










/* ...................................... QUICK SEARCH ...................................... */
/* This adds a custom quick search widget to the theme.
 * In order for the quick search to function properly, you must add the following to the footer file:
 * Footer: <?php include(TEMPLATEPATH . '/accessories/quicksearch/includes/quicksearch_scripts.php'); ?>
 */


// DEFINE WIDGET CLASS
	
	class quicksearch_widget extends WP_Widget {  

// DEFINE WIDGET META DATA
	
	function __construct() {parent::__construct( /* Base ID */'widget_quicksearch', /* Name */'Quick Search', array( 'description' => 'A custom quick search widget' ) ); }  
	
// BUILDS WIDGET OUTPUT

	function widget( $args, $instance ) {
	extract( $args );
	$before_widget = '<!-- QUICK SEARCH -->';
	$after_widget = '<!-- /QUICK SEARCH -->';
	$before_title = '<h3 class="qs-title">';
	$after_title = '</h3>';
	$title = apply_filters( 'widget_title', $instance['title'] );
	global $order;
	global $orderby;
		
	echo $before_widget; ?>
            
	<?php if( isset($_GET['type']) && $_GET['type'] != '') {
			$order = $_GET['type'];
    		switch($order) {          

				case 'graphic': $orderby = 'post_type=projects&order=ASC&orderby=post_date&cat=3&posts_per_page=-1';
				break;

				case 'web': $orderby = 'post_type=projects&order=ASC&orderby=post_date&cat=4&posts_per_page=-1';
        			break;
							  
        		}
		
			} else  {
        
			$orderby = 'post_type=projects&order=ASC&orderby=post_date&cat=3&posts_per_page=-1'; } ?>

        		<select id="order-by" size="8">
        			<option value="graphic" <?php echo (!isset($order) || $order == '' || $order == 'graphic')? 'selected="selected"':''; ?>>Graphic Design</option>
	    			<option value="web" <?php echo ($order == 'web')? 'selected="selected"':''; ?>>Web Design</option>
        		</select>

		<script type="text/javascript">
        	var orderby = jQuery('#order-by');
        	var str;
        	orderby.change(function(){
        	str = jQuery(this).val();
        	window.location.href = "<?php echo home_url(); ?>/portfolio/?type="+str;
        	});
    	</script>	

	<?php echo $after_widget; }

// UPDATES WIDGET TITLE

	function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	return $instance; }

// CHECKS WIDGET FOR UPDATED TITLE

	function form( $instance ) {
	if ( $instance ) { $title = esc_attr( $instance[ 'title' ] );
	} else { $title = __( 'Quick Search', 'text_domain' ); } ?>

	<!-- BUILD WIDGET MENU -->

	<div>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
				
	</div>
		
<?php } }

// REGISTER WIDGET
// To enable this widget, uncomment the following line. 
   register_widget('quicksearch_widget');










/* ..................................... TWITTER FEED ..................................... */
/* This adds a Twitter feed widget to the theme.
 * In order for the Twitter feed to function properly, you must add the following to the footer file:
 * Footer: <?php include(TEMPLATEPATH . '/accessories/twitter/includes/twitter_scripts.php'); ?>
 */


// DEFINE WIDGET CLASS
	
	class twitter_widget extends WP_Widget {  

// DEFINE WIDGET META DATA
	
	function __construct() {parent::__construct( /* Base ID */'widget_twitter', /* Name */'Twitter Feed', array( 'description' => 'A basic Twitter feed widget' ) ); }  
	
// BUILDS WIDGET OUTPUT

	function widget( $args, $instance ) {
	extract( $args );
	$before_widget = '<!-- TWITTER FEED -->';
	$after_widget = '<!-- /TWITTER FEED -->';
	$before_title = "'";
	$after_title = "'";
	$title = apply_filters( 'widget_title', $instance['title'] );
	$text = $instance['text'];
	
	echo $before_widget; ?>
            
		<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: <?php echo $text; ?>, // Number of tweets
  interval: 5000,
  width: 250,
  height: 300,
  
  features: {
    scrollbar: false,
    loop: false,
    live: false,
    behavior: 'default'
  }
}).render().setUser('<?php echo $title; ?>').start();
</script>
		
	<?php echo $after_widget; }

// UPDATES WIDGET TITLE

	function update( $new_instance, $old_instance ) {
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['text'] = strip_tags($new_instance['text']);
	return $instance; }

// CHECKS WIDGET FOR UPDATED TITLE

	function form( $instance ) {
	if ( $instance ) { $title = esc_attr( $instance[ 'title' ] ); $text = esc_attr( $instance[ 'text' ] );
	} else { $title = __( 'cybersytes', 'text_domain' ); $text = __( '4', 'text_domain' ); } ?>

	<!-- BUILD WIDGET MENU -->

	<p>
		<label style="width: 150px; display: inline-block;" for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Username:'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
<label style="width: 168px; display: inline-block;" for="<?php echo $this->get_field_id('title'); ?>"><?php _e('# of Tweets:'); ?></label>
<input style="text-align: right;" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" size="3" value="<?php echo $text; ?>" />
				
	</p>
		
<?php } }

// REGISTER WIDGET
// To enable this widget, uncomment the following line. 
   register_widget('twitter_widget');




?>