<?php

/*
 *
 * @File : Flex column
 * @retrun
 *
 */

if (!function_exists('jobcareer_column_shortocde')) {

    function jobcareer_column_shortocde($atts, $content = "") {

        $defaults = array(
            'column_size' => '',
            'flex_column_section_title' => '',
            'cs_image_url' => '',
            'flex_column_text' => '',
            'cs_column_class' => '',
            'content_title_color' => '',
            'column_bg_color' => '' > '1'
        );

        $html = '';
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $flex_column_text = isset($flex_column_text) ? $flex_column_text : '';
        $section_title = '';
        if (isset($cs_image_url) && $cs_image_url != '') {
            $cs_image_url;
        }
        if (trim($content_title_color) != '') {
            $content_title_color = $content_title_color;
        } else {
            $content_title_color = '';
        }
        $jobcareer_column_bg_color = '';
        if (trim($column_bg_color) != '' || ($cs_image_url) != '') {
            $jobcareer_column_bg_class = 'has-bg-color';
        } else {
            $jobcareer_column_bg_class = '';
        }

        if (trim($cs_column_class) != '') {
         $cs_column_class_id = $cs_column_class;
        } else {
         $cs_column_class_id = '';
        }
        if ($flex_column_section_title && trim($flex_column_section_title) != '') {
            $section_title = '<div class="cs-section-title"><div class="section-inner"><h2>' . $flex_column_section_title . '</h2></div></div>';
        }

        if ($flex_column_text && trim($flex_column_text) != '') {
        $content .= '<p style="color:' . esc_attr($content_title_color) . '">' . $flex_column_text . '</p>';
        }
        $content = nl2br($content);
        $content = jobcareer_custom_shortcode_decode($content);
        $html = do_shortcode($content);
        $html = '<div style="background-image:url(' . esc_url($cs_image_url) . '); color:' . $content_title_color . '; background-color:' . $column_bg_color . ';" class="' . $jobcareer_column_bg_class . ' ' . $column_class . '">'
                . do_shortcode($section_title) . $html .
                '</div>';
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_COLUMN, 'jobcareer_column_shortocde');
    }
}