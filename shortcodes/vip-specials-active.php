<?php
	call_user_func(function () {
		add_shortcode('vip_specials_active',function ($atts, $content)  {
			$args = [
				'post_type'	=> 'special',
				'meta_key' => '_wpmem_block',
				'meta_value' => 1,
			];
			$query = new WP_Query($args);
			$count = $query->post_count;;
			$singular =  (empty($atts['singular'])) ? 'special' : trim((addslashes($atts['singular'])));
			$plural =  (empty($atts['plural'])) ? 'specials' : trim((addslashes($atts['plural'])));;
			$zero =  (empty($atts['zero'])) ? $plural : trim($atts['zero']);;
			$str = ($count > 1) ? $plural : $singular;
			if ($count == 0){
				return $zero;
			}
      return sprintf(sprintf($content, $str),$count) ;
		});
	});
?>
