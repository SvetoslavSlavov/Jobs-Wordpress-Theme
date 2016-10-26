<?php

/*
 *
 * @File : Frontend view for List shortcode and element
 * @retrun
 *
 */
if (!function_exists('jobcareer_list_shortcode')) {

    function jobcareer_list_shortcode($atts, $content = "") {
        global $cs_border, $cs_list_type, $counter;
        $defaults = array(
            'column_size' => '',
            'cs_list_section_title' => '',
            'cs_list_type' => '',
            'cs_list_icon' => '',
            'cs_border' => '',
            'cs_list_item' => '',
            'cs_list_class' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        $customID = '';

        if (isset($column_size) && $column_size != '') {
            $column_class = jobcareer_custom_column_class($column_size);
        } else {
            $column_class = '';
        }
        if (isset($cs_list_class) && $cs_list_class != '') {
            $customID = 'id="' . $cs_list_class . '"';
        }
        $html = "";
        $cs_list_typeClass = '';
        $section_title = '';
        if ($cs_list_section_title && trim($cs_list_section_title) != '') {
            $section_title = '<div class="cs-section-title"><h2>' . $cs_list_section_title . '</h2></div>';
			echo cs_special_char($section_title);
        }
        if (isset($cs_list_type) && $cs_list_type == 'numeric-icon') {
            $html .= '<ol>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'alphabetic') {
            $html .= '<ol  style="list-style-type: lower-alpha;">';
        } else
            $html .= '<ul class="' . $cs_list_typeClass . '">';

        $html .= do_shortcode($content);  // render content

        if (isset($cs_list_type) && $cs_list_type == 'numeric-icon') {
            $html .= '</ol>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'alphabetic') {
            $html .= '</ol>';
        } else {
            $html .= '</ul>';
        }

        $html .= '<div ' . $customID . ' class="liststyle terms-detail ' . $column_class . '  ' . $cs_list_class . '">';
        $html .= '</div>';
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_LIST, 'jobcareer_list_shortcode');
    }
}

//  start Render list item functions
if (!function_exists('cs_list_item_shortcode')) {

    function cs_list_item_shortcode($atts, $content = "") {
        global $cs_border, $cs_list_icon, $cs_list_type, $counter;
        $html = '';
        $defaults = array('cs_list_icon' =>
            '', 'cs_list_item' =>
            '', 'cs_cusotm_class' =>
            '', 'cs_custom_animation' =>
            '', 'cs_custom_animation' =>
            '');
        extract(shortcode_atts($defaults, $atts));
        if ($cs_border == 'yes') {
            $border = 'has_border';
        } else {
            $border = '';
        }
        if (isset($cs_list_type) && $cs_list_type == 'icon') {
            $html .= '<li class="' . $border . '" style="list-style-type:none !important;"><i class="' . $cs_list_icon . '"></i>' . do_shortcode(htmlspecialchars_decode($content)) . '</li>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'default') {
            $html .= '<li class="' . $border . '" style="list-style-type:none !important;">&middot; ' . do_shortcode(htmlspecialchars_decode($content)) . '</li>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'built') {
            $html .= '<li class="' . $border . '" style="list-style-type:disc !important;">' . do_shortcode(htmlspecialchars_decode($content)) . '</li>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'numeric-icon') {
            $html .= '<li class="' . $border . '" > ' . do_shortcode(htmlspecialchars_decode($content)) . '</li>';
        } else
        if (isset($cs_list_type) && $cs_list_type == 'alphabetic') {
            $html .= '<li class="' . $border . '" style="list-style:lower-alpha !important;"> ' . do_shortcode(htmlspecialchars_decode($content)) . '</li>';
        }

        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_LISTITEM, 'cs_list_item_shortcode');
    }
}