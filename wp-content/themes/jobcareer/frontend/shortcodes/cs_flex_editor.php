<?php

/*
 *
 * @File : Flex column
 * @retrun
 *
 */

if (!function_exists('jobcareer_editor_shortocde')) {
    function jobcareer_editor_shortocde($atts, $content = "") {
			
        $defaults = array(
            'cs_editor_content_title' => '',
            'cs_column_class' => '',
            'column_bg_color' => '' > '1'
        );
        $html = '';
   	extract(shortcode_atts($defaults, $atts));
	if(isset($cs_editor_content_title) && $cs_editor_content_title <> ""){
	$html .= '<h2>'. $cs_editor_content_title.'</h2>';
	}
        $content = nl2br($content);
		$content = jobcareer_custom_shortcode_decode($content);
        $html .= '<div class="cs_flex_editor"><div class="row">' . do_shortcode($content) . '</div></div>';
        
	return $html;
        
	 }
       if (function_exists('cs_short_code')){
        cs_short_code(CS_SC_EDITOR, 'jobcareer_editor_shortocde');
	}
}