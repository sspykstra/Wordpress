<?php //add more buttons (font size select) to the rich text editor (TinyMCE)
//see http://pablisher.nicer2.com/how-to-extend-the-usability-of-tinymce-in-wordpress/

	function register_additional_button($buttons) {
	   array_unshift($buttons, 'fontsizeselect');
	   return $buttons;
	}
	add_filter('mce_buttons_2', 'register_additional_button');
?>
<?php //custom php dump function
function _dump(){$a=func_get_args();echo '<pre style="background-color:#F5F5F5;color:#333333;border:1px solid rgba(0, 0, 0, 0.15);border-radius:4px 4px 4px 4px;display:block;font-size:13px;line-height:20px;padding:9.5px;white-space:pre-wrap;word-break:break-all;word-wrap:break-word;">';foreach($a as $b){if(is_array($b)&&$b)print_r($b);else var_dump($b);}echo '</pre>';}
?>
<?php //disable the Admin Bar

	add_filter('show_admin_bar','__return_false');
	remove_action('personal_options','_admin_bar_preferences');
?>
<?php //enable widget sidebar
	if ( function_exists('register_sidebar') )
	register_sidebar();
?>
<?php //remove 'p' tag around images in content
	function filter_ptags_on_images($content){
	   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
	}
	add_filter('the_content', 'filter_ptags_on_images');
?>
<?php //disable default image links
	function wpb_imagelink_setup() {
		$image_set = get_option( 'image_default_link_type' );

		if ($image_set !== 'none') {
			update_option('image_default_link_type', 'none');
		}
	}
	add_action('admin_init', 'wpb_imagelink_setup', 10);
?>