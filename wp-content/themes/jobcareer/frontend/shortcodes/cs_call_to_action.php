<?php

/*
 *
 * @File : Call to action
 * @retrun
 *
 */
if (!function_exists('jobcareer_call_to_action')) {

    function jobcareer_call_to_action($atts, $content = "") {
        $defaults = array(
            'column_size' => '1/1',
            'cs_call_to_action_section_title' => '',
            'cs_content_type' => '',
            'cs_call_action_title' => '',
            'cs_call_action_contents' => '',
            'cs_contents_color' => '',
            'cs_call_action_icon' => '',
            'cs_icon_color' => '#FFF',
            'cs_call_to_action_icon_background_color' => '',
            'cs_call_to_action_button_text' => '',
            'cs_call_to_action_button_link' => '#',
            'cs_call_to_action_bg_img' => '',
            'animate_style' => 'slide',
            'cs_call_to_action' => '',
            'cs_contents_bg_color' => '',
            'cs_call_action_view' => '',
			'cs_call_action_text_align' => '',
            'cs_call_to_action_img' => '',
            'class' => 'cs-article-box',
            'cs_call_to_action_class' => ''
        );



        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $cell_button = '';
        $CustomId = '';
        $html = '';

        $cs_call_to_action_button_text = isset($cs_call_to_action_button_text) ? $cs_call_to_action_button_text : '';
        $cs_call_to_action_button_link = isset($cs_call_to_action_button_link) ? $cs_call_to_action_button_link : '';
        $cs_call_to_action = isset($cs_call_to_action) ? $cs_call_to_action : '';
        $cs_call_to_action_icon_background_color = isset($cs_call_to_action_icon_background_color) ? $cs_call_to_action_icon_background_color :
                '';
        $cs_call_to_action_img = isset($cs_call_to_action_img) ? $cs_call_to_action_img : '';

        if (isset($cs_call_to_action_class) && $cs_call_to_action_class) {
            $CustomId = 'id="' . $cs_call_to_action_class . '"';
        }

        $section_title = '';
        if (isset($cs_call_to_action_section_title) && trim($cs_call_to_action_section_title) <> '') {
            $html .= '<div class="cs-section-title"><h2 class="">' . $cs_call_to_action_section_title . '</h2></div>';
        }


        $cs_call_action_title = isset($cs_call_action_title) ? $cs_call_action_title : '';
        $image = '';

        if (trim($cs_call_to_action_bg_img) != '' ) {
            $image = 'background-image:url(' . $cs_call_to_action_bg_img . ');';
        }

        $background_view_call = 'style="background:url(' . $cs_call_to_action_img . ') no-repeat ' . $cs_contents_bg_color . ' left !important;"';
        $background_view_call_bg_color = 'style="background:' . $cs_contents_bg_color . '"';


        if (isset($cs_call_action_view) and $cs_call_action_view == 'button') {

            $html .= '<div class="callToaction" ' . $background_view_call . '>';
            $html .= '<div class="cs-text align-'.$cs_call_action_text_align.'">';
            $html .= '<h3 style="color:' . $cs_contents_color . ' !important">' . $cs_call_action_title . '</h3>';
            $html .= '<p style="color:' . $cs_contents_color . '">' . do_shortcode($content) . '</p>';
            $html .= '</div>';

            if (isset($cs_call_to_action_button_text) and $cs_call_to_action_button_text <> '') {

                $html .= '<a href="' . esc_url($cs_call_to_action_button_link) . '" class="cs-bgcolor acc-submit pull-right" style="background:' . $cs_call_to_action_icon_background_color . '!important;">' . $cs_call_to_action_button_text . '</a>';
            }
            $html .= '</div>';
            return '<div ' . $CustomId . ' class="leftaction">' . $html . '</div>';
        } else {

            $html .= '<div class="callToaction" ' . $background_view_call . '>';
            $html .= '<div class="cs-text align-'.$cs_call_action_text_align.'">';
            $html .= '<h3 style="color:' . $cs_contents_color . ' !important;">' . $cs_call_action_title . '</h3>';
            $html .= '<p style="color:' . $cs_contents_color . ' !important;">' . do_shortcode($content) . '</p>';
            $html .= '</div>';

            if (isset($cs_call_to_action_button_text) and $cs_call_to_action_button_text <> '') {

                $html .= '<a href="' . esc_url($cs_call_to_action_button_link) . '" class="cs-bgcolor acc-submit pull-right" style="background:' . $cs_call_to_action_icon_background_color . '!important;">' . $cs_call_to_action_button_text . '</a>';
            }
            $html .= '</div>';
            return '<div ' . $CustomId . ' class="leftaction">' . $html . '</div>';
        }
        ?>

        <?php

    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_CALLTOACTION, 'jobcareer_call_to_action');
    }
}