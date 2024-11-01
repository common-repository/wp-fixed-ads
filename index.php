<?php
/**
 * Plugin Name: WP Fixed Ads
 * Plugin URI: http://madmaskiner.dk/
 * Description: Fixed Side Ads For Wordpress.
 * Version: 1.0
 * Author: Ramandeep Singh	
 * Author URI: http://ramandeepsingh.in
 * License: A "Slug" license name e.g. GPL2
 */
 function madmas_addscripts(){
	wp_enqueue_style( 'madmas-fixed-ads',plugin_dir_url( __FILE__ ).'/css/style.css' );
	//wp_enqueue_script( 'thea-admin', THEAURI.'admin/js/script.js', array( 'wp-color-picker' ), false, true );
 }
 add_action('wp_enqueue_scripts','madmas_addscripts');
 
 
 //register settigns
 function madmas_general_settings() {			
		register_setting( 'madmas_general_settings', 'madmas_general_settings' );
		add_settings_section( 'section_general', 'General Plugin Settings',  'madmas_section_general_desc' , 'wp_fixed_ads' );
		add_settings_field( 'LeftCode', 'Left Code',  'madmas_field_txt1' , 'wp_fixed_ads', 'section_general' );
		add_settings_field( 'RightCode', 'Right Code',  'madmas_field_txt2' , 'wp_fixed_ads', 'section_general');		
		
	}
 add_action( 'admin_init', 'madmas_general_settings' );
 
 //callbacks
 function madmas_section_general_desc(){
 
 }
 function madmas_field_txt1(){
	$options = get_option( 'madmas_general_settings' );
	echo '<textarea id="textarea_example" name="madmas_general_settings[madmas_field_txt1]" rows="5" cols="50">' . @$options[ 'madmas_field_txt1' ] . '</textarea>';
 }
 function madmas_field_txt2(){
	$options = get_option( 'madmas_general_settings' );
	echo '<textarea id="textarea_example" name="madmas_general_settings[madmas_field_txt2]" rows="5" cols="50">' . @$options[ 'madmas_field_txt2' ] . '</textarea>';
 }
 //admin page
 function madmas_admin_menu(){
	
	add_options_page( 'Wp Fixed Ads', 'Wp Fixed Ads', 'manage_options','wp_fixed_ads', 'madmass_admin_page' ); 
}
add_action( 'admin_menu', 'madmas_admin_menu'  );

function madmass_admin_page(){
?>
<div class="wrap">
<form method="post" action="options.php">
	<?php wp_nonce_field( 'update-options' ); ?>
	<?php settings_fields( 'madmas_general_settings' ); ?>
	<?php do_settings_sections( 'wp_fixed_ads' ); ?>
	<?php submit_button(); ?>
</form>
</div>
<?php
}	
// front end	

function madmas_wpfoot(){
	$options = get_option( 'madmas_general_settings' );
	if(!empty($options['madmas_field_txt1'])){
		echo "<div id='madmas_left_fx'>"; 
		echo html_entity_decode($options['madmas_field_txt1']) ;
		echo "</div>";
	}
	if(!empty($options['madmas_field_txt1'])){
		echo "<div id='madmas_right_fx'>"; 
		echo html_entity_decode($options['madmas_field_txt2']) ;
		echo "</div>";
	}		
	
}
add_action('wp_footer','madmas_wpfoot');