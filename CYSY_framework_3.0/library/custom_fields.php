<?
/**
 * Custom Fields for Posts, Pages or Post Types
 *
 * @package WordPress
 * @subpackage CYSY Framework 3
 */
 
 
 
 
 
$prefix = 'cysy_custom';
	
$meta_box = array(
	'id' => 'page_fields',
	'title' => 'CYSY Custom Page Fields',
	// 'page' => determines the post type.
	'page' => 'page',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		// example of basic text box
		array( 
              "name" => "Sub Title:",
	          "desc" => "A Test Description for what to insert here",
	          "id" => $prefix."_subtitle",
	          "type" => "text",
	          "std" => ""
              )
		,
		
		// example of a select dropdown
		array(
            "name"      => "Random Colors",
            "id"        => $prefix. "_colors",
            "type"      => "select",
            "options"   => array(
                    "blue"       => "Blue",
                    "green"       => "Green",
                    "red"       => "Red",
                    "yellow"       => "Yellow"

            ),
            "multiple"  => false,
            // this std line determines the selected state of dropdown
            "std"       => array( "blue" ),
            "desc"      => "Sample select box dropdown for you."
        ),
        
        // example of a textarea box usage
		array( 
              "name" => "Description:",
	          "desc" => "Larger Text Area Box for more content.",
	          "id" => $prefix."_description",
	          "type" => "textarea",
	          "std" => ""
              )
	)
);


/* FOR ADDITIONAL META BOX TO APPEAR ON ONE PAGE 

if( in_array($_GET['post'], array( '10','15','23' ) ) ) {

// ADD SPECIFIC CUSTOM FIELD CODE HERE

}


*/




/* This is a set of custom fields used for a separate custom post type
notice the suffix _numbertwo has been added to $prefix and $meta_box throughout
the code. At the bottom of this page we have two large blocks of code
that control the first and second custom meta boxes as well. If you want
to add a third box, just copy and post the blocks of code with the 2's
in them, and replace it with 3's and so on.
*/


/*
$prefix_numbertwo = 'nerf_fields';
	
$meta_box_numbertwo = array(
	'id' => 'page_fields',
	'title' => 'Nerf Gun Custom Fields',
	// 'page' => determines the post type.
	'page' => 'nerf',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
	
		// example of basic text box
		array( 
              "name" => "Sub Title:",
	          "desc" => "A Test Description for what to insert here",
	          "id" => $prefix_numbertwo."_subtitle",
	          "type" => "text",
	          "std" => ""
              )
		,
		
		// example of a select dropdown
		array(
            "name"      => "Random Colors",
            "id"        => $prefix_numbertwo. "_colors",
            "type"      => "select",
            "options"   => array(
                    "blue"       => "Blue",
                    "green"       => "Green",
                    "red"       => "Red",
                    "yellow"       => "Yellow"

            ),
            "multiple"  => false,
            // this std line determines the selected state of dropdown
            "std"       => array( "blue" ),
            "desc"      => "Sample select box dropdown for you."
        ),
        
        // example of a textarea box usage
		array( 
              "name" => "Description:",
	          "desc" => "Larger Text Area Box for more content.",
	          "id" => $prefix_numbertwo."_description",
	          "type" => "textarea",
	          "std" => ""
              )
	)
);

*/






/* ----------------------------------------------- THIS CODE IS FOR THE FIRST CUSTOM FIELDS BOX.. SCROLL DOWN BELOW FOR THE SECOND CUSTOM FIELDS BOX CODE */

add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
	global $meta_box;
	
	add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box() {
	global $meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<strong>' ,$field['name'], '</strong><br />', $field['desc'], '<br />', '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />';
				break;
			case 'textarea':
				echo '<strong>' ,$field['name'], '</strong><br />', $field['desc'], '<br />', '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>';
				break;
			case 'select':
				echo '<strong>' ,$field['name'], '</strong><br />', $field['desc'], '<br />', '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				echo '<strong>' ,$field['name'], '</strong><br />', $field['desc'], '<br />';
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<strong>' ,$field['name'], '</strong><br />', $field['desc'], '<br />', '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
	global $meta_box;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}









/* ----------------------------------------------- THIS CODE IS FOR THE SECOND CUSTOM FIELDS BOX, By Default is deactivated */



/*



add_action('admin_menu', 'mytheme_add_box_numbertwo');

// Add meta box
function mytheme_add_box_numbertwo() {
	global $meta_box_numbertwo;
	
	add_meta_box($meta_box_numbertwo['id'], $meta_box_numbertwo['title'], 'mytheme_show_box_numbertwo', $meta_box_numbertwo['page'], $meta_box_numbertwo['context'], $meta_box_numbertwo['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box_numbertwo() {
	global $meta_box_numbertwo, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';

	foreach ($meta_box_numbertwo['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<strong>' ,$field['name'], '</strong><br />', $field['desc'], '<br />', '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />';
				break;
			case 'textarea':
				echo '<strong>' ,$field['name'], '</strong><br />', $field['desc'], '<br />', '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>';
				break;
			case 'select':
				echo '<strong>' ,$field['name'], '</strong><br />', $field['desc'], '<br />', '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				echo '<strong>' ,$field['name'], '</strong><br />', $field['desc'], '<br />';
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<strong>' ,$field['name'], '</strong><br />', $field['desc'], '<br />', '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

add_action('save_post', 'mytheme_save_data_numbertwo');

// Save data from meta box
function mytheme_save_data_numbertwo($post_id) {
	global $meta_box_numbertwo;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($meta_box_numbertwo['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}



*/






?>