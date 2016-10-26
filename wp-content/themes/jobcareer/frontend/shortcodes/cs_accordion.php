<?php

/*
 *
 * @Shortcode Name : Accordion
 * @retrun
 *
 */
if (!function_exists('jobcareer_accordion_shortcode')) {

    function jobcareer_accordion_shortcode($atts, $content = "") {
        global $acc_counter, $accordian_style;
        $acc_counter = rand(40, 9999999);
        
        $html = '';
        $defaults = array(
            'column_size' => '1/1',
            'class' => 'cs-accrodian',
            'accordian_style' => '',
            'accordion_class' => '',
            'accordion_animation' => '',
            'cs_accordian_section_title' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $CustomId = '';
        if (isset($accordion_class) && $accordion_class) {
            $CustomId = 'id="' . $accordion_class . '"';
        }
        if (trim($accordion_animation) != '') {
            $accordion_animation = 'wow' . ' ' . $accordion_animation;
        } else {
            $accordion_animation = '';
        }
        $section_title = '';
        if (isset($cs_accordian_section_title) && trim($cs_accordian_section_title) <> '') {
            $section_title = '<div class="cs-section-title"><h2>' . $cs_accordian_section_title . '</h2></div>';
        }
        if ($accordian_style == 'default') {
            $styleClass = 'default';
        } else {
            $styleClass = 'default';
        }
        $html = '<div ' . $CustomId . ' class="' . $column_class . '">';
        $html .= '<h2>' . $section_title . '</h2>';
        $html .= '<div class="panel-group modren ' . $styleClass . ' ' . $accordion_class . ' ' . $accordion_animation . '" id="collapseExample-' . $acc_counter . '">' . do_shortcode($content) . '</div>';
        $html .= '</div>';
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_ACCORDION, 'jobcareer_accordion_shortcode');
    }
}
/*
 *
 * @Accordion Item
 * @retrun
 *
 */
if (!function_exists('jobcareer_accordion_item_shortcode')) {

    function jobcareer_accordion_item_shortcode($atts, $content = "") {
        global $acc_counter, $accordian_style, $accordion_animation;
        $defaults = array(
            'accordion_title' => 'Title',
            'accordion_active' => 'yes',
            'cs_accordian_icon' => ''
        );
        extract(shortcode_atts($defaults, $atts));
        $accordion_count = 0;
        $accordion_count = rand(40, 9999999);
        $html = '';
        $active_in = '';
        $active_class = '';
        $styleColapse = 'collapse collapsed';
        if (isset($accordion_active) && $accordion_active == 'yes') {
            $active_in = 'in';
            $styleColapse = '';
        } else {
            $active_class = 'collapsed';
        }
        $faq_style = '';
        $cs_accordian_icon_class = '';
        if (isset($cs_accordian_icon)) {
            $cs_accordian_icon = '<i class="' . $cs_accordian_icon . '"></i>';
        }
        $content_value = nl2br($content);
        $cs_team_specs_list = str_replace('<br />', '</li><li><i class="icon-arrow-circle-right"></i>', $content_value);
        $html = '<div class="panel panel-default"><div class="panel-heading" role="tab" id="heading4"><a data-toggle="collapse" data-parent="#collapseExample-' . $acc_counter . '" href="#collapseExample-' . $accordion_count . '" class="' . sanitize_html_class($active_class) . '"> <h5 class="panel-title">' . $cs_accordian_icon . $accordion_title . '</h5></a> </div>';
        $html .= '<div id="collapseExample-' . $accordion_count . '" class="collapse ' . $active_in . ' ">';
        $html .= '<div class="panel-body">';
        $html .= '<ul>';
        $html .= '<li>';
        $html .= $cs_team_specs_list;
        $html .= '</li>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_ACCORDIONITEM, 'jobcareer_accordion_item_shortcode');
    }
}
