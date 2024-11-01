<?php
/**
 * Plugin Name: Shortcode Menu Dropdown
 * Plugin URI: http://www.butternutgutter.com/shortcode-generator-menu-dropdown/
 * Description: Sister plugin that creates a menu dropdown for shortcodes in the editor to be used with Shortcode Generator Version 1.1 | By Kyle Getson http://www.getson.info/shortcode-generator (based on Kevin Chard's snippet at http://wpsnipp.com/index.php/functions-php/update-automatically-create-media_buttons-for-shortcode-selection/  
 * Author: Daniel Pisciotta
 * Author URI: http://www.butternutgutter.com/
 * Version: 1.0
 */




add_action('media_buttons','add_sc_select',11);
function add_sc_select(){
    global $shortcode_tags;
     /* ------------------------------------- */
     /* enter names of shortcode to exclude bellow */
     /* ------------------------------------- */
    $exclude = array("wp_caption", "embed");
    echo '&nbsp;<select id="sc_select"><option>Shortcode</option>';
    foreach ($shortcode_tags as $key => $val){
	    if(!in_array($key,$exclude)){
		if(substr($key, 0, 4) === 'scg_'){
	            $shortcodes_list .= '<option value="['.$key.']">'.$key.'</option>';
		}
		else{
	            $shortcodes_list .= '<option value="['.$key.'][/'.$key.']">'.$key.'</option>';
		}
    	    }
        }
     echo $shortcodes_list;
     echo '</select>';
}
add_action('admin_head', 'button_js');
function button_js() {
	echo '<script type="text/javascript">
	jQuery(document).ready(function(){
	   jQuery("#sc_select").change(function() {
			  send_to_editor(jQuery("#sc_select :selected").val());
        		  return false;
		});
	});
	</script>';
}



?>