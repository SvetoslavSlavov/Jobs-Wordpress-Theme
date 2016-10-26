<?php

/*
 *
 * @Shortcode Name : Start function for Price table shortcode/element front end view
 * @retrun
 *
 */

if (!function_exists('jobcareer_multi_price_table_shortcode')) {

    function jobcareer_multi_price_table_shortcode($atts, $content = null) {
        global $pricetable_style, $jobcareer_multi_price_table_class, $column_class, $testimonial_text_color, $jobcareer_multi_price_table_section_title, $post;
        $randomid = rand(0, 999);
        $defaults = array('column_size' => '1/1', 'jobcareer_multi_price_table_section_title' => '', 'pricetable_style' => '');
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
            $html = '';
        if (isset($pricetable_style) and $pricetable_style == 'simple') {

            if (isset($jobcareer_multi_price_table_section_title) and $jobcareer_multi_price_table_section_title <> '') {
                echo '<h2>' . esc_attr($jobcareer_multi_price_table_section_title) . '</h2>';
            }
            $html .= '<div class="price-table">';
            $html .= do_shortcode($content);
            $html .= '</div>'; 
        } else {
            $html .= '<div class="row">';
            $html .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
            if (isset($jobcareer_multi_price_table_section_title) and $jobcareer_multi_price_table_section_title <> '') {
            $html .= '<div class="cs-section-title">';
            $html .= '<h2>' . esc_attr($jobcareer_multi_price_table_section_title) . '</h2>';
            $html .= '</div>';
            }
            $html .= '</div>';
            $html .= ' <ul class="cs-pricetable">';
            $html .= do_shortcode($content);
            $html .= '</ul>';
            $html .= '</div>';
        }

        return '<div class="' . $column_class . '"> ' . $html . '</div>';
    }

         if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTIPRICETABLE, 'jobcareer_multi_price_table_shortcode');
    }
}

/*
 *
 * @Shortcode Name :  Start function for Pricetable Item shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('jobcareer_multi_price_table_item')) {

    function jobcareer_multi_price_table_item($atts, $content = null) {
        global $pricetable_style, $post;
        $defaults = array(
            'multi_price_table_text' => '',
            'multi_price_table_currency' => '',
            'multi_price_table_time_duration' => '',
            'multi_pricetable_price' => '',
            'multi_price_table_button_text' => '',
            'multi_price_table_title_color' => '',
            'multi_price_table_button_color' => '',
            'pricing_detail' => '',
            'pricetable_featured' => '',
            'multi_price_table_button_color_bg' => '',
            'multi_price_table_button_column_color' => '',
            'multi_price_table_column_bgcolor' => '',
            'button_link' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        $html = '';
        $pricing_detail = isset($pricing_detail) ? $pricing_detail : '';
        $bg_color = "";
        $column_bg_color = "";
        if (isset($multi_price_table_column_bgcolor) && $multi_price_table_column_bgcolor <> '') {
            $column_bg_color = esc_attr($multi_price_table_column_bgcolor);
        }

        if (isset($pricetable_style) and $pricetable_style == "simple") {
            $featured_cell = "";
            if (isset($pricetable_featured) && $pricetable_featured == 'Yes') {
                $featured_cell = "cs-featured";
            }
            if (isset($multi_price_table_button_color_bg) && $multi_price_table_button_color_bg <> '') {
                $bg_color = 'style="background:' . esc_attr($multi_price_table_button_color_bg) . ';"';
            }

            $html .= '<article class="col-md-4 ' . esc_attr($featured_cell) . '"  style="background:' . esc_attr($column_bg_color) . '">';
            if ($multi_price_table_currency != '' || $multi_pricetable_price != '' || $multi_price_table_time_duration != '') {
                $html .= '<span class="price">' . $multi_price_table_currency . '' . $multi_pricetable_price . '<em>' . $multi_price_table_time_duration . '</em></span>';
            }
           if ($multi_price_table_button_text != '') {
                $html .= '<h3 style="color:' . $multi_price_table_title_color . ' !important">' . $multi_price_table_text . '</h3>';
            }
            $html .= '<ul class="price-list">';
            $html .= do_shortcode($content);
            $html .= '</ul>';

            if ($multi_price_table_button_text != '') {
                $html .= '<a href="' . esc_url($button_link) . '" class="cs-color acc-submit" style="background-color:' . $multi_price_table_button_column_color . ' !important; color:' . $multi_price_table_button_color . ' !important">' . $multi_price_table_button_text . '</a>';
            }

            $html .= '</article>';
        } else {
            
           $featured_cell = "";
            if (isset($pricetable_featured) && $pricetable_featured == 'Yes') {
                $featured_cell = "active";
            }
            $html .= '<li class="col-lg-4 col-md-4 col-sm-6 col-xs-12">';
            $html .= '<div style="background-color:#fff;" class="pricetable-holder ' . esc_attr($featured_cell) . '">';
            $html .= '<h2 style="color:' . esc_attr($multi_price_table_title_color) . ' !important; background:' . esc_attr($column_bg_color) . '; padding:55px 40px;">' . esc_attr($multi_price_table_text) . '</h2>';
            $html .= '<div class="price-holder">';
            $html .= '<div class="cs-price">';
            $html .= '<p>' . do_shortcode($content) . '</p>';
            $html .= '<span><em>' . esc_attr($multi_price_table_currency) . '' . esc_attr($multi_pricetable_price) . '</em><small>' . esc_attr($multi_price_table_time_duration) . '</small></span>';
            $html .= '</div>';
            $html .= '<a style="background-color:' . $multi_price_table_button_column_color . ' !important; color:' . $multi_price_table_button_color . ' !important" class="cs-bgcolor cs-button" href="' . esc_url($button_link) . '">' . esc_attr($multi_price_table_button_text) . '</a>';
            $html .= '</div>';
            $html .= ' </div>';
            $html .= ' </li>';
           }
           return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTIPRICETABLEITEM, 'jobcareer_multi_price_table_item');
    }
}

/*
 *
 * @Shortcode Name : Price Features
 * @retrun
 *
 */
if (!function_exists('cs_price_features')) {

    function cs_price_features($atts, $content = null) {
        global $pricetable_style, $jobcareer_multi_price_table_class, $column_class, $jobcareer_multi_price_table_section_title, $post;
       $defaults = array();
        extract(shortcode_atts($defaults, $atts));
        $html = '<li><span>' . do_shortcode($content) . '</span></li>';
        return $html;
    }
       if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_PRICE_FEATURES, 'cs_price_features');
    }
}