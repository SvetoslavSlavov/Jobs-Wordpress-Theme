<?php
/*
 *
 * @Shortcode Name :  Start function for Multiple Service shortcode/element front end view
 * @retrun
 *
 */

if (!function_exists('jobcareer_multiple_services_shortcode')) {

    function jobcareer_multiple_services_shortcode($atts, $content = "") {
        $defaults = array(
            'column_size' => '1/1',
            'cs_multiple_service_section_title' => '',
            'cs_multiple_services_view' => '',
            'cs_service_content_align' => '',
            'cs_service_image_align' => '',
        );
        global $post, $cs_multiple_services_view, $cs_service_content_align, $cs_service_image_align;
        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $cs_section_title = '';
        $randomid = rand(0, 999);
        if (isset($cs_multiple_service_section_title) && trim($cs_multiple_service_section_title) <> '') {
            $cs_section_title = '<div class="cs-section-title"><h2>' . esc_html($cs_multiple_service_section_title) . '</h2></div>';
            echo jobcareer_special_char($cs_section_title);
        }
        $cs_html = '';

        if (isset($cs_multiple_services_view) and $cs_multiple_services_view == "slider") {
            $randomid = rand(0, 999);
            $cs_html .= $cs_section_title;
            jobcareer_enqueue_slick_script();
            ?>
            <script type='text/javascript'>
                jQuery(document).ready(function () {
                    jQuery('.hiring-slider slider<?php echo absint($randomid) ?>').slick({
                        autoplay: true,
                        autoplaySpeed: 2000,
                    });
                });
            </script>
            <?php
            $cs_html = '<section class="cs-hiring-slider">';
            $cs_html .= '<ul class="hiring-slider slider' . $randomid . '">';
            $cs_html .= do_shortcode($content);
            $cs_html .= '</ul>';
            $cs_html .= '</section>';
        } else {

            $cs_html .= '<div class="row">';
            $cs_html .= '<div class="section-fullwidtht col-lg-12 col-md-12 col-sm-12 col-xs-12">';
            $cs_html .= '<div class="row">';
            $cs_html .= do_shortcode($content);
            $cs_html .= ' </div>';
            $cs_html .= ' </div>';
            $cs_html .= '</div>';
        }
        return do_shortcode($cs_html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTPLESERVICES, 'jobcareer_multiple_services_shortcode');
    }
}

/*
 *
 * @Multiple  Start function for Multiple Service Item  shortcode/element front end view
 * @retrun
 *
 */

if (!function_exists('cs_multiple_services_item_shortcode')) {

    function cs_multiple_services_item_shortcode($atts, $content = "") {
        $defaults = array(
            'cs_title_color' => '',
            'cs_text_color' => '', 'cs_bg_color' => '',
            'cs_website_url' => '',
            'cs_multiple_service_title' => '',
            'cs_multiple_service_logo' => '',
            'cs_multiple_service_btn' => '',
            'cs_multiple_service_btn_link' => '',
            'cs_multiple_service_btn_bg_color' => '',
            'cs_multiple_service_btn_txt_color' => '',
            'cs_service_image_icon' => '',
            'cs_service_image_circle' => '',
            'cs_sercices_icon' => '',
            'cs_service_icon_size' => '',
            'cs_service_icon_color' => '',
            'cs_service_icon_circle' => '',
            'cs_button_link' => '',
            'cs_button_text' => '',
            'cs_button_text_color' => '',
            'cs_button_color' => '',
            'cs_service_content_color' => '',
            'cs_service_background_color' => '',
            'cs_service_image_size' => '',
        );
        global $post, $cs_multiple_services_view, $cs_service_content_align, $cs_service_image_align;
        extract(shortcode_atts($defaults, $atts));
        $html = '';
        $icon_border = $cs_service_title_color = $cs_service_title = '';
        $cs_title_color = isset($cs_title_color) ? $cs_title_color : '';
        $cs_text_color = isset($cs_text_color) ? $cs_text_color : '';
        $cs_website_url = isset($cs_website_url) ? $cs_website_url : '';
        $cs_style_class = "";

        if (isset($cs_service_postion_modern) and $cs_service_postion_modern == "top") {
            $cs_style_class = "cs_class_top";
        } else
        if (isset($cs_service_postion_modern) and $cs_service_postion_modern == "center") {
            $cs_style_class = "cs_class_center";
        } else
        if (isset($cs_service_postion_modern) and $cs_service_postion_modern == "right") {
            $cs_style_class = "cs_class_right";
        } else
        if (isset($cs_service_postion_modern) and $cs_service_postion_modern == "left") {
            $cs_style_class = "cs_class_left";
        }
        $cs_content_style_class = "";
        if (isset($cs_service_content_align) and $cs_service_content_align == "left") {
            $cs_content_style_class = "cs-text left";
        } else
        if (isset($cs_service_content_align) and $cs_service_content_align == "right") {
            $cs_content_style_class = "cs-text right";
        } else
        if (isset($cs_service_content_align) and $cs_service_content_align == "center") {
            $cs_content_style_class = "cs-text center";
        }
        $cs_image_style_class = "";
        if (isset($cs_service_image_align) and $cs_service_image_align == "left") {
            $cs_image_style_class = "cs-media left";
        } else
        if (isset($cs_service_image_align) and $cs_service_image_align == "right") {
            $cs_image_style_class = "cs-media right";
        } else
        if (isset($cs_service_image_align) and $cs_service_image_align == "top_right") {
            $cs_image_style_class = "cs-media top-right";
        } else
        if (isset($cs_service_image_align) and $cs_service_image_align == "top_left") {
            $cs_image_style_class = "cs-media top-left";
        } else
        if (isset($cs_service_image_align) and $cs_service_image_align == "top_center") {
            $cs_image_style_class = "cs-media top-center";
        }
        if (isset($cs_service_icon_color) && $cs_service_icon_color != '') {
            $iconColor = $cs_service_icon_color;
        } else {
            $iconColor = '';
        }

        $circle = '';
        if (isset($cs_service_image_circle) && $cs_service_image_circle == 'yes') {
            $circle = 'circle';
        }
        $icon_circle = '';
        if (isset($cs_service_icon_circle) && $cs_service_icon_circle == 'yes') {
            $circle = 'circle';
            $icon_circle = 'icon-circle';
        }
        if (isset($cs_multiple_services_view) && $cs_multiple_services_view == 'simple') {
            $html .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">';
            $html .= '<div class="cs-services">';
            $html .= '<div class="' . esc_attr($cs_image_style_class) . ' ' . esc_attr($circle) . '"> ';
            if (isset($cs_multiple_service_logo) and $cs_multiple_service_logo <> "") {
                $html .= '<figure style="background:' . esc_attr($cs_service_background_color) . '"><img src="' . esc_url($cs_multiple_service_logo) . '" alt="" class=" ' . esc_attr($cs_service_image_size) . ' "></figure>';
            } else {
                $html .= '<span class="' . esc_attr($icon_circle) . '"><i style="color:' . $iconColor . ' !important;background:' . esc_attr($cs_service_background_color) . ' !important;" class="' . esc_attr($cs_sercices_icon) . ' ' . esc_attr($cs_service_icon_size) . ' ' . esc_attr($icon_border) . ' "></i></span>';
            }
            $html .= '</div>';
            $html .= '<div class="' . esc_attr($cs_content_style_class) . '">';
            $html .= '<h3  style="color:' . $cs_title_color . '  !important;">' . $cs_multiple_service_title . '</h3>';
            $html .= '<p style="color: ' . $cs_service_content_color . ' !important; font-size: 13px;">' . do_shortcode($content) . '</p>';

            if (isset($cs_button_text) && $cs_button_text <> "") {
                $html .= '<a class="cs-button" href="' . esc_url($cs_button_link) . '" style="background:' . $cs_button_color . '; color:' . esc_attr($cs_button_text_color) . ' !important;">' . $cs_button_text . '</a>';
            }
            $html .= '</div>';
            $html .= ' </div>';
            $html .= '</div>';
        } else if (isset($cs_multiple_services_view) && $cs_multiple_services_view == 'slider') {
            $html .= '<li>';
            $html .= '<figure><a href="' . esc_url($cs_website_url) . '"><img src="' . esc_url($cs_multiple_service_logo) . '" alt=""/></a></figure>';
            $html .= '<div class="heading">';
            $html .= '<h3><a href="' . esc_url($cs_website_url) . '" ' . $cs_title_color . '>' . $cs_multiple_service_title . '</a></h3>';
            $html .= '<p ' . $cs_text_color . ' >' . do_shortcode($content) . '</p>';
            $html .= '</div>';
            $html .= '</li>';
        } else {
            $iconColor = isset($iconColor) ? $iconColor : '';

            $html .= '<div class="cs-services">';

            $html .= '<div class="' . esc_attr($cs_image_style_class) . ' ' . esc_attr($circle) . '"> ';

            if (isset($cs_service_bg_image) and $cs_service_bg_image <> "") {

                $html .= '<figure style="background:' . esc_attr($cs_service_background_color) . '"><img src="' . esc_url($cs_service_bg_image) . '" alt="" class=" ' . esc_attr($cs_service_image_size) . ' "></figure>';
            } else {
                $html .= '<span class="' . esc_attr($icon_circle) . '"><i style="color:' . $iconColor . ' !important;background:' . esc_attr($cs_service_background_color) . ' !important;" class="' . esc_attr($cs_sercices_icon) . ' ' . esc_attr($cs_service_icon_size) . ' ' . esc_attr($icon_border) . ' ' . esc_attr($cs_service_icon_size) . ' "></i></span>';
            }
            $html .= '</div>';
            $html .= '<div class="' . esc_attr($cs_content_style_class) . '">';
            $html .= '<h3  style="color:' . $cs_service_title_color . '  !important;">' . $cs_service_title . '</h3>';
            $html .= '<p style="color: ' . $cs_service_content_color . '; font-size: 13px;">' . do_shortcode($content) . '</p>';

            if (isset($cs_button_text) && $cs_button_text <> "") {

                $html .= '<a class="cs-button" href="' . esc_url($cs_button_link) . '" style="background:' . $cs_button_color . '; color:' . esc_attr($cs_button_text_color) . ' !important;">' . $cs_button_text . '</a>';
            }
            $html .= '</div>';
            $html .= '</div> ';
        }

        return do_shortcode($html);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MULTPLESERVICESITEM, 'cs_multiple_services_item_shortcode');
    }
}
?>