<?php
/*
 *
 * @Shortcode Name : Mutli Counter
 * @retrun
 *
 */

if (!function_exists('jobcareer_multi_counters_shortcode')) {

    function jobcareer_multi_counters_shortcode($atts, $content = null) {
        global $counter_style, $rand_id, $cs_multi_counters_class, $column_class, $multi_counters_text_color, $section_title, $post, $rand_id;

        $defaults = array(
            'column_size' => '1/1',
            'multi_counters_text_color' => '',
            'cs_multi_counters_text_align' => '',
            'cs_multi_counters_section_title' => '',
            'cs_multi_counters_class' => '',
            'multi_counters_style'
        );
        extract(shortcode_atts($defaults, $atts));
        $rand_id = rand(98, 56666);
        $column_class = jobcareer_custom_column_class($column_size);
        $html = '';
        $section_title = '';
        jobcareer_counter_script();
        $rand_id = rand(9228, 96666);
        $html .= '
		<script type="text/javascript">
		  jQuery(document).ready(function( $ ) {
			jQuery(".cs-counter-' . $rand_id . '").counterUp({
			delay: 10,
			time: 1000
			});
		  });
		</script>';

        if (isset($cs_multi_counters_section_title) and $cs_multi_counters_section_title <> '') {

            $html .= '<div class="cs-section-title">';
            $html .= '<h2>' . $cs_multi_counters_section_title . '</h2>';
            $html .= '</div>';
        }
        $html .= '<div class="cs-counter inner">';
        $html .= '<ul class="dashboard-list">';
        $html .= do_shortcode( $content );
        $html .= '</ul>';
        $html .= '</div>';
        return $html;
    }
	
    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTICOUNTERS, 'jobcareer_multi_counters_shortcode');
    }
}
/*
 *
 * @Shortcode Name : Mutli Counter Item
 * @retrun
 *
 */
if ( ! function_exists('cs_multi_counters_item') ) {

    function cs_multi_counters_item($atts, $content = null) {
        global $multi_counters_style, $rand_id, $cs_testimonial_class, $column_class, $testimonial_text_color, $post;
        $output = '';
        $defaults = array(
            'column_size' => '1/1',
            'counter_style' => '',
            'multi_counters_img' => '',
            'cs_counter_logo' => '',
            'counter_icon' => '',
            'counter_icon_align' => '',
            'counter_icon_color' => '',
            'counter_numbers' => '',
            'counter_number_color' => '',
            'counter_title' => '',
            'counter_link_title' => '',
            'counter_link_url' => '',
            'counter_text_color' => '',
            'counter_border' => '',
            'counter_border_color' => '',
            'counter_class' => '',
        );
        extract(shortcode_atts($defaults, $atts));
        $figure = '';
        $html = '';
        $counter_icon = isset($counter_icon) ? $counter_icon : '';
        $counter_title = isset($counter_title) ? $counter_title : '';
        $counter_text_color = isset($counter_text_color) ? $counter_text_color : '';
        $counter_icon_color = isset($counter_icon_color) ? $counter_icon_color : '';
        $output .= '<li style="color: ' . $counter_number_color . ';">';
		$output .= '<i class="' . $counter_icon . '" style="color:' . $counter_icon_color . ';"></i>';
		$output .= '<div class="cs-text">';
		$output .= '<span class="cs-counter-' . $rand_id . '">' . $counter_numbers . '</span>';
		$output .= '<em style="color:' . $counter_text_color . '">' . $counter_title . '</em>';
		$output .= '</div>';
        $output .= '</li>';

        return $output;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTICOUNTERSITEM, 'cs_multi_counters_item');
    }
}