<?php

/*
 *
 * @Shortcode Name : Start function for Services shortcode/element front end view 
 * @retrun
 *
 */
if (!function_exists('jobcareer_services_shortcode')) {

    function jobcareer_services_shortcode($atts, $content = null) {
        global $service_type, $post;
        $defaults = array(
            'column_size' => '',
            'cs_service_icon' => '',
            'cs_service_icon_color' => '',
            'cs_service_title' => '',
            'cs_service_link' => '',
            'cs_service_title_color' => '',
            'cs_service_content' => '',
            'cs_service_content_color' => '',
            'cs_service_view' => 'simple', // modern or simple
        );
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $html = '';
        $cs_service_view = isset($cs_service_view) ? $cs_service_view : '';
        $cs_service_icon = isset($cs_service_icon) ? $cs_service_icon : '';
        $cs_service_icon_color = isset($cs_service_icon_color) ? $cs_service_icon_color : '';
        $cs_service_title = isset($cs_service_title) ? $cs_service_title : '';
        $cs_service_link = isset($cs_service_link) ? $cs_service_link : '';
        $cs_service_title_color = isset($cs_service_title_color) ? $cs_service_title_color : '';
        $cs_service_content = isset($cs_service_content) ? $cs_service_content : '';
        $cs_service_content_color = isset($cs_service_content_color) ? $cs_service_content_color : '';

        if (isset($column_class) && $column_class != '') {
            $html .= '<div class="' . $column_class . '">';
        }
        if (isset($cs_service_view) && $cs_service_view == 'simple') {


            $html .= '<div class="cs-services simple">';
            if (isset($cs_service_icon) && $cs_service_icon != '') {
                $color_string = '';
                if (isset($cs_service_icon_color) && $cs_service_icon_color != '') {
                    $color_string = ' style="color:' . $cs_service_icon_color . ';"';
                }
                $html .= '<span><i class="' . $cs_service_icon . '" ' . $color_string . '></i></span>';
            }

            if ((isset($cs_service_title) && $cs_service_title != '') || (isset($cs_service_content) && $cs_service_content != '')) {
                $html .= '<div class="cs-text">';
                if (isset($cs_service_title) && $cs_service_title != '') {
                    $color_string = '';
                    if (isset($cs_service_title_color) && $cs_service_title_color != '') {
                        $color_string = ' style="color:' . $cs_service_title_color . ';"';
                    }
                    $html .= '<h6 ' . $color_string . '><a href="' . esc_url($cs_service_link) . '">' . $cs_service_title . '</a></h6>';
                }
                if (isset($cs_service_content) && $cs_service_content != '') {
                    $color_string = '';
                    if (isset($cs_service_content_color) && $cs_service_content_color != '') {
                        $color_string = ' style="color:' . $cs_service_content_color . ';"';
                    }
                    $html .= '<p ' . $color_string . '>' . $cs_service_content . '</p> ';
                }

                $html .= '</div>';
            }

            $html .= '</div>';
        } else {
            $html .= '<div class="cs-services modern">';
            if (isset($cs_service_icon) && $cs_service_icon != '') {
                $color_string = '';
                if (isset($cs_service_icon_color) && $cs_service_icon_color != '') {
                    $color_string = ' style="color:' . $cs_service_icon_color . ';"';
                }
                $html .= '<span><i class="' . $cs_service_icon . '" ' . $color_string . '></i></span>';
            }

            if ((isset($cs_service_title) && $cs_service_title != '') || (isset($cs_service_content) && $cs_service_content != '')) {
                $html .= '<div class="cs-text">';
                if (isset($cs_service_title) && $cs_service_title != '') {
                    $color_string = '';
                    if (isset($cs_service_title_color) && $cs_service_title_color != '') {
                        $color_string = ' style="color:' . $cs_service_title_color . ';"';
                    }
                    $html .= '<h4 ' . $color_string . '><a href="' . esc_url($cs_service_link) . '">' . $cs_service_title . '</a></h4>';
                }
                if (isset($cs_service_content) && $cs_service_content != '') {
                    $color_string = '';
                    if (isset($cs_service_content_color) && $cs_service_content_color != '') {
                        $color_string = ' style="color:' . $cs_service_content_color . ';"';
                    }
                    $html .= '<p ' . $color_string . '>' . $cs_service_content . '</p> ';
                }

                $html .= '</div>';
            }

            $html .= '</div>';
        }
        if (isset($column_class) && $column_class != '') {
            $html .='</div>';
        }
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_SERVICES, 'jobcareer_services_shortcode');
    }
}
/*
 *
 * @ Start function for Services Contents shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('cs_service_content')) {

    function cs_service_content($atts, $content = null) {
        $defaults = array('content' => '');
        extract(shortcode_atts($defaults, $atts));
        return $content;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code('content', 'cs_service_content');
    }
}
?>