<?php

/*
 *
 * @Shortcode Name : FAQ
 * @retrun
 *
 */
if (!function_exists('jobcareer_faq_shortcode')) {

    function jobcareer_faq_shortcode($atts, $content = "") {
        global $acc_counter, $cs_faq_view_title, $cs_faq_view;
        $acc_counter = rand(40, 9999999);
        $html = '';
        $defaults = array(
            'column_size' => '1/1',
            'class' => 'cs-faq',
            'faq_class' => '',
            'cs_faq_section_title' => '',
            'cs_faq_view' => 'cs-ans-quest'
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $CustomId = '';
        if (isset($faq_class) && $faq_class) {
            $CustomId = 'id="' . $faq_class . '"';
        }
        $section_title = '';
        if (isset($cs_faq_section_title) && trim($cs_faq_section_title) <> '') {
            $section_title = '<div class="cs-section-title"><h2>' . $cs_faq_section_title . '</h2></div>';
        }
        $html .= '<h2>' . $section_title . '</h2>';
        $html .= '<div class="' . $cs_faq_view . ' ' . $faq_class . ' " id="collapseExample-' . $acc_counter . '">' . do_shortcode($content) . '</div>';
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_FAQ, 'jobcareer_faq_shortcode');
    }
}
/*
 *
 * @FAQ Item
 * @retrun
 *
 */
if (!function_exists('cs_faq_item_shortcode')) {

    function cs_faq_item_shortcode($atts, $content = "") {
        global $acc_counter, $faq_animation, $cs_faq_view_title, $cs_faq_view;
        $defaults = array('faq_title' => 'Title', 'faq_active' => 'yes', 'cs_faq_icon' => '', 'cs_faq_view' => 'view-1');
        extract(shortcode_atts($defaults, $atts));
        $faq_count = 0;
        $faq_count = rand(40, 9999999);
        $html = "";
        $active_in = '';
        $active_class = '';
        $styleColapse = '';
        $styleColapse = 'collapse collapsed';
        if (isset($faq_active) && $faq_active == 'yes') {
        $styleColapse = '';
        $active_in = 'in';
        } else {
            $active_class = 'collapsed';
        }
        $cs_faq_icon_class = '';
        if (isset($cs_faq_icon)) {
            $cs_faq_icon_class = '<i class="' . $cs_faq_icon . '"></i>';
        }
        $html = '<div class="panel panel-default"><div class="panel-heading" role="tablist" id="heading4' . $faq_count . '"><a data-toggle="collapse" data-parent="#collapseExample-' . $acc_counter . '" href="#collapseExample-' . $faq_count . '" class="' . sanitize_html_class($faq_active) . '"> <h6 class="panel-title">' . $cs_faq_icon . $faq_title . '</h6></a> </div>';
        $html .= ' <div id="collapseExample-' . $faq_count . '" class="collapse ' . $active_in . ' ">';
        $html .= '<div class="panel-body">';
        $html .= '<ul>';
        $html .= '<li>';
        $html .= do_shortcode($content);
        $html .= '</li>';
        $html .= '</ul>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_FAQITEM, 'cs_faq_item_shortcode');
    }
}
?>