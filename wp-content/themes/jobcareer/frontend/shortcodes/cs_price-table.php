<?php

/*
 *
 * @Shortcode Name : Start function for Price Table  shortcode/element front end view
 * @retrun
 *
 */

if (!function_exists('jobcareer_pricetable_shortcode')) {

    function jobcareer_pricetable_shortcode($atts, $content = "") {
        global $pricetable_style;
         $defaults = array(
            'column_size' => '1/1',
            'pricetable_style' => 'simple',
            'pricetable_title' => '',
            'cs_pricetable_section_title' => '',
            'pricetable_title_bgcolor' => '',
            'pricetable_price' => '',
            'currency_symbols' => '$',
            'pricetable_period' => '',
            'pricetable_bgcolor' => '',
            'btn_text' => 'Buy Now',
            'btn_link' => '',
            'btn_bg_color' => '',
            'pricetable_featured' => '',
            'pricetable_class' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $CustomId = '';
        if (isset($pricetable_class) && $pricetable_class) {
            $CustomId = 'id="' . $pricetable_class . '"';
        }
        $html = '';
        $bgcolor_style = '';
        if (isset($btn_bg_color) && trim($btn_bg_color) <> '') {
            $btn_bg_color = ' style="background-color:' . $btn_bg_color . '"';
        }
        if (isset($pricetable_bgcolor) && trim($pricetable_bgcolor) <> '') {
            $bgcolor_style = ' style="background:' . $pricetable_bgcolor . '"';
        }
        if (isset($cs_pricetable_section_title) && $cs_pricetable_section_title <> "") {
            $cs_pricetable_section_title = $cs_pricetable_section_title;
        }
        if (isset($pricetable_title) && $pricetable_title <> "") {
            $pricetable_title = $pricetable_title;
        }
        if (isset($pricetable_title_bgcolor) && $pricetable_title_bgcolor <> "") {
            $pricetable_title_bgcolor = 'style="background:' . $pricetable_title_bgcolor . ' !important;"';
        }
        if (isset($pricetable_price) && $pricetable_price <> "") {
            $pricetable_price = $pricetable_price;
        }
        if (isset($btn_text) && $btn_text <> "") {
            $btn_text = $btn_text;
        }
        if (isset($btn_link) && $btn_link <> "") {
            $btn_link = $btn_link;
        }
       $active = '';
       if (isset($pricetable_featured) && $pricetable_featured == 'Yes') {
            $active = 'active';
        }
        if (isset($currency_symbols) && $currency_symbols <> "") {
            $currency_symbols = $currency_symbols;
        }
        if (isset($pricetable_period) && $pricetable_period <> "") {
            $pricetable_period = $pricetable_period;
        }
        $html = '<div class="' . $CustomId . '">';
        $html .='<div class="price-table">';
        $html .='<div> <span class="price">' . $currency_symbols . '' . $pricetable_price . '<em>' . $pricetable_period . '</em></span>';
        $html .='<h3>' . $pricetable_title . '</h3>';
        $html .= '<ul class="price-list">';
        $html .='' . do_shortcode($content) . '';
        $html .='</ul>';
        $html .='<a href="' . esc_url($btn_link) . '" class="cs-color acc-submit">' . $btn_text . '</a> </div>';
        $html .='</div>';
        $html .='</div>';
        return $html;
    }

    if (function_exists('cs_short_code'))
        cs_short_code(CS_SC_PRICETABLE, 'jobcareer_pricetable_shortcode');
}

/*
 *
 * @Price Table Item
 * @retrun
 *
 */
if (!function_exists('cs_pricing_item')) {

    function cs_pricing_item($atts, $content = "") {
        global $pricetable_style;
        $defaults = array('pricing_feature' => '');
        extract(shortcode_atts($defaults, $atts));
        $html = '';
        $priceCheck = '';
        if ($pricetable_style == 'classic' || $pricetable_style == 'clean') {
            $priceCheck = '';
        }
        if (isset($pricing_feature) && $pricing_feature != '') {
            $html .='<li>' . $pricing_feature . '</li>';
        }
       return $html;
      }

      if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_PRICETABLEITEM, 'cs_pricing_item');
    }
}