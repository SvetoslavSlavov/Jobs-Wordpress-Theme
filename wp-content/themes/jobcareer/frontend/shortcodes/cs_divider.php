<?php

/*
 *
 * @Shortcode Name : Divider
 * @retrun
 *
 */
if (!function_exists('jobcareer_divider_shortcode')) {

    function jobcareer_divider_shortcode($atts) {
        $html = '';
        $defaults = array(
            'column_size' => '1/1',
            'divider_style' => 'crossy',
            'divider_height' => '1',
            'divider_margin_top' => '',
            'divider_margin_bottom' => '',
            'line' => 'Wide',
            'color' => '#000',
            'cs_divider_class' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $divider_height = isset($divider_height) ? $divider_height : '';
        $divider_div = '<div class="spliter-medium"></div>';
        $divider_margin_top = isset($divider_margin_top) ? $divider_margin_top : '';
        $divider_margin_bottom = isset($divider_margin_bottom) ? $divider_margin_bottom : '';
        $html .= '<div style="margin-top:' . $divider_margin_top . 'px; margin-bottom:' . $divider_margin_bottom . 'px; height:' . $divider_height . 'px;">' . $divider_div . '</div>';
        return do_shortcode($html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_DIVIDER, 'jobcareer_divider_shortcode');
    }
}