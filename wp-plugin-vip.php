<?php
/**
 * Plugin Name: VIP Club
 * Plugin URI: https://github.com/fgms/wp-plugin-vip/
 * Description: Creates VIP Club with the use of WP-MEMBERS plugin
 * Version: 0.0.1
 * Author: Fifth Gear Marketing
 * Author URI: https://github.com/fgms/wp-plugin-vip
 * License: GPL-3.0
 * Plugin Type: Piklist
 */


require_once __DIR__ .'/shortcodes/vip-specials-active.php';

/*** Filter for adding twig locations source: wp-theme-twig ***/
add_filter('fg_theme_master_twig_locations', function($timberLocationsArray){
  $a = [];
  // overrides theme and child theme (if not needs to change filter execution)
  $a[] = __DIR__ .'/twig-templates';
  // gives plugin override
  $a[] = get_stylesheet_directory(). '/twig-templates/plugin';
  return array_merge($a,$timberLocationsArray);
},15);

/*** filter for adding settings page source: piklist plugin ***/
add_filter('piklist_admin_pages', function($pages){
  $pages[] = [
   'page_title' => __('VIP Club Settings')
   ,'menu_title' => __('VIP Club', 'piklist')
   ,'sub_menu' => 'options-general.php'
   ,'capability' => 'manage_options'
   ,'menu_slug' => 'vip_settings'
   ,'setting' => 'vip_settings'
   ,'single_line' => true
   ,'save_text' => 'Save Settings'
  ];
  return $pages;
});

add_action( 'admin_notices', 'fgms_plugin_vip_admin_notice');


add_action( 'wp_enqueue_scripts', function(){
  /*
  if (is_plugin_active('wp-less/bootstrap.php') ){
		wp_enqueue_style('wp-plugin-vip-style-less',plugin_dir_url( __FILE__ ) . 'assets/less/style.less');
	}
	else {
		wp_enqueue_style( 'wp-plugin-vip-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css' );
	}

  wp_enqueue_script('wp-plugin-vip-script',  plugin_dir_url( __FILE__ ) .'assets/js/script.js');
*/
}, 35);

add_filter( 'wpmem_login_form', 'fg_wpmem_form', 10, 2 );
add_filter( 'wpmem_login_form_rows','fg_wpmem_form_row',10,2);
add_filter( 'wpmem_register_form', 'fg_wpmem_form', 10, 2 );
add_filter( 'wpmem_register_form_rows','fg_wpmem_form_row',10,2);

/** Added for vip Section **/
// redirects logged in users to specials
add_action( 'template_redirect', function(){
  // settings from admin page
  $options = get_option('vip_settings');
  $vip_page_registration_id =  ((!empty($options['vip_register_page'])) AND (intval($options['vip_register_page']) > 0) ) ? intval($options['vip_register_page']) : 0;
  $vip_page_id = ((!empty($options['vip_page'])) AND (intval($options['vip_page']) > 0) ) ? intval($options['vip_page']) : 0;
  // checking to see if page is logged in and page is either vip page or register page to redirect to specials
	if (is_user_logged_in() AND (is_page($vip_page_id) OR is_page($vip_page_registration_id)) ) {
		wp_redirect(get_post_type_archive_link('special'));
		exit;
	}
  // checking to see if special single has been block and user not signed in then redirect to vip page /vip/
  if (is_singular('special')){
    if ( (get_post_meta(get_the_ID(),'_wpmem_block',true) == 1) AND (!is_user_logged_in()) ){
      wp_redirect(get_permalink($vip_page_id));
      exit;
    }
  }
});


function fg_wpmem_form ($form, $action){
  $title = [
    'login' => '<h2>Member Login</h2>',
    'new' => ' ',
    'edit' => ' ',
    'pwdchange' => ' '
  ];
  // Remove Title and replace with new Title
  if (!empty($title[$action])){
    $form = preg_replace('/<legend>(.*?)<\/legend>/', $title[$action], $form, -1, $count);
  }
  $form .= '<style>.captcha { text-align: left; margin-bottom: 12px;}.req-text{font-size: 0.8em; padding-top: 12px; font-style: italic;}</style>';
  return ($form);
}

function fg_wpmem_form_row($rows, $action){
  foreach ($rows as &$row){
    $count = 0;
    $row['row_before'] = '<div class="form-group" style="max-width: 500px;">';
    $row['row_after'] ='</div>';
    $row['field_before'] = '';
    $row['field_after'] = '';
    $row['field'] = preg_replace('/class=\\".*\\"/', 'class="form-control"', $row['field'], -1, $count);
  }
  //  echo '<pre>'.  htmlentities(print_R($rows,true)). '</pre>';
  return $rows;
}
function fgms_plugin_vip_admin_notice(){
  $messages = [];
  if (!is_plugin_active('wp-members/wp-members.php')){
  	$messages[] = __( 'VIP Club Plugin Requires WP-Members Plugin ', 'wp-plugin-vip' );
  }
  if (!is_plugin_active('wp-plugin-cpt/wp-plugin.cpt.php')){
  	$messages[] = __( 'VIP Club Plugin Requires Custom Posttypes Plugin by Fgms', 'wp-plugin-vip' );
  }
  foreach ($messages as $message){
    printf( '<div class="error notice is-dismissable"><p>%s</p></div>',  esc_html( $message ) );
  }


}
