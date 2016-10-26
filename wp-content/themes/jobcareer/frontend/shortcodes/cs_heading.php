<?php
// start Heading shortcode front end view function
if (!function_exists('jobcareer_heading_shortcode')) {

    function jobcareer_heading_shortcode($atts, $content = "") {
        $divider_div = '';
        $defaults = array(
            'column_size' => '1/1',
            'heading_title' => '',
            'color_title' => '',
            'heading_color' => '#000',
            'class' => 'cs-heading-shortcode',
            'heading_style' => '',
            'heading_style_type' => '1',
            'heading_size' => '',
            'letter_space' => '',
            'line_height' => '',
            'font_weight' => '',
            'sub_heading_title' => '',
            'heading_font_style' => '',
            'heading_align' => 'center',
            'heading_divider' => '',
            'heading_color' => '',
            'heading_content_color' => ''
        );

        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $html = '';
        $css = '';
        $he_font_style = '';
        $heading_divider = isset($heading_divider) ? $heading_divider : '';
        if (isset($heading_divider) and $heading_divider == 'on') {
        $divider_div = '<div class="spliter-medium"></div>';
        }
        $sub_heading_title = isset($sub_heading_title) ? $sub_heading_title : '';
       if ($heading_font_style <> '') {
        $he_font_style = ' font-style:' . $heading_font_style;
        }
        echo balanceTags($css, false);
        $html .= '<div class="cs-heading">';
		if( $heading_style == 'section_title' ) {
			$html .= '<div class="cs-section-title"><h2 style="color:' . $heading_color . ' !important; font-size: ' . $heading_size . 'px !important; letter-spacing: '.$letter_space.'px !important; line-height: '.$line_height.'px !important; text-align:' . $heading_align . ';' . $he_font_style . ';">' . $heading_title . '</h2></div>';
		} elseif( $heading_style == 'fancy' ) {
			$html .= '<h3 class="cs-fancy" style="color:' . $heading_color . ' !important; font-size: ' . $heading_size . 'px !important; letter-spacing: '.$letter_space.'px !important; line-height: '.$line_height.'px !important; text-align:' . $heading_align . ';' . $he_font_style . ';">' . $heading_title . '</h3>';
		}  else {
        	$html .= '<h' . $heading_style . ' style="color:' . $heading_color . ' !important; font-size: ' . $heading_size . 'px !important; letter-spacing: '.$letter_space.'px !important; line-height: '.$line_height.'px !important; text-align:' . $heading_align . ';' . $he_font_style . ';">' . $heading_title . '</h' . $heading_style . '>';
		}
        $html .= '<div style="color:' . $heading_content_color . ' !important; text-align: ' . $heading_align . ';' . $he_font_style . ';">' . do_shortcode(nl2br($content)) . '</div>';
        $html .= $divider_div;
        $html .= '</div>';
        return do_shortcode($html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_HEADING, 'jobcareer_heading_shortcode');
    }
}