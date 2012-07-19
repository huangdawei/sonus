<?php
/**
 * Custom Child Theme Functions
 *
 * This file's parent directory can be moved to the wp-content/themes directory 
 * to allow this Child theme to be activated in the Appearance - Themes section of the WP-Admin.
 *
 * Included are a set of constants that can be defined to customize aspects of Thematic's 
 * functionality, as well as a sample function that will add a home link to your menu.
 * "Uncomment" or add more to cusomize the functionality of your Child Theme.
 *
 * More ideas can be found in the community documentation for Thematic
 * @link http://docs.thematictheme.com
 *
 * @package ThematicSampleChildTheme
 * @subpackage ThemeInit
 */


// Unleash the power of Thematic's dynamic classes
// 
// define('THEMATIC_COMPATIBLE_BODY_CLASS', true);
// define('THEMATIC_COMPATIBLE_POST_CLASS', true);

// Unleash the power of Thematic's comment form
//
// define('THEMATIC_COMPATIBLE_COMMENT_FORM', true);

// Unleash the power of Thematic's feed link functions
//
// define('THEMATIC_COMPATIBLE_FEEDLINKS', true);


// Adds a home link to your menu
// http://codex.wordpress.org/Template_Tags/wp_page_menu
//function childtheme_menu_args($args) {
//    $args = array(
//        'show_home' => 'Home',
//        'sort_column' => 'menu_order',
//        'menu_class' => 'menu',
//        'echo' => false
//    );
//	return $args;
//}
//add_filter('wp_page_menu_args','childtheme_menu_args');

$url = home_url(); 

// Remove the header
function remove_thematic_actions() {
 remove_action('thematic_header','thematic_blogtitle',3);
}
add_action('init','remove_thematic_actions');

/**
 * Add Back to Top script
 */
function sonus_back_to_top() {
	?>
	<script src="<?php echo $url; ?>/wp-content/themes/sonus/library/scripts/go-top.js"></script>
	<script>
		(new GoTop()).init({
			pageWidth: 980,
			nodeId: 'go-top',
			nodeWidth: 50,
			distanceToBottom: 50,
			hideRegionHeight: 130,
			text: ''
		});
	</script>
	<?php
}
add_action('thematic_after', 'sonus_back_to_top');

// Custom the seach form
function sonus_search_form() {
	$search_form_length = apply_filters('thematic_search_form_length', '21');
	$search_form  = "\n\t\t\t\t\t\t";
	$search_form .= '<form id="searchform" method="get" action="' . home_url() .'/">';
	$search_form .= "\n\n\t\t\t\t\t\t\t";
	$search_form .= '<div>';
	$search_form .= "\n\t\t\t\t\t\t\t\t";
	if (is_search()) {
	    	$search_form .= '<input id="s" name="s" type="text" value="' . esc_html ( stripslashes( $_GET['s'] ) ) .'" size="' . $search_form_length . '" tabindex="1" />';
	} else {
	    	$value = __( 'Search', 'thematic' );
	    	$value = apply_filters( 'search_field_value',$value );
	    	$search_form .= '<input id="s" name="s" type="text" value="' . $value . '" onfocus="if (this.value == \'' . $value . '\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'' . $value . '\';}" size="'. $search_form_length .'" tabindex="1" />';
	}
	$search_form .= "\n\n\t\t\t\t\t\t\t\t";
	
	$search_submit = '<input id="searchsubmit" name="searchsubmit" type="submit" value="' . __('Search', 'thematic') . '" tabindex="2" />';
	
	$search_form .= apply_filters('thematic_search_submit', $search_submit);
	
	$search_form .= "\n\t\t\t\t\t\t\t";
	$search_form .= '</div>';
	
	$search_form .= "\n\n\t\t\t\t\t\t";
	$search_form .= '</form>' . "\n\n\t\t\t\t\t";
	
	echo apply_filters('sonus_search_form', $search_form);
}
add_filter('thematic_search_form', 'sonus_search_form');


function childtheme_theme_link($themelink) {
	return '<a class="child-theme-link" href="http://github.com/huangdawei/sonus/" title="sonus" target="_blank">sonus</a>';
}
add_filter('thematic_theme_link', 'childtheme_theme_link');

?>
