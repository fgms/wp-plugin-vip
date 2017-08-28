<?php
/*
Title: Settings.
Setting: vip_settings
Order: 10
Tab: General
*/

function get_vip_page_choices($post_types = []){
  $choices_array = array(''=>'-- Select  -- ');
  foreach ($post_types as $pt){
    $my_wp_query = new WP_Query();
    $all_wp_pages = $my_wp_query->query(array('post_type'       => $pt,
                                              'posts_per_page'  => 10000,
                                              'orderby'         => 'title',
                                              'order'           => 'asc'));
    foreach ($all_wp_pages as $post){
        $choices_array[$post->ID] =  $post->post_title;
    }
  }
  return $choices_array;
}


piklist('field',[
    'type' => 'select',
    'field' => 'vip_page',
    'label' => __('VIP Club Page'),
    'description' => _(''),
    'choices' => get_vip_page_choices(['page']),
    'columns' => 4,
]);
piklist('field',[
    'type' => 'select',
    'field' => 'vip_register_page',
    'label' => __('VIP Club Registration Page'),
    'description' => _(''),
    'choices' => get_vip_page_choices(['page']),
    'columns' => 4,
]);
