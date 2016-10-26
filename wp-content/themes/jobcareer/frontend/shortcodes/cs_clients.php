<?php

/*
 *
 * @Shortcode Name : Clients
 * @retrun
 *
 */

if (!function_exists('jobcareer_clients_shortcode')) {

    function jobcareer_clients_shortcode($atts, $content = "") {
        global $post, $cs_clients_view, $cs_client_border, $cs_client_gray, $cs_client_style;
        $defaults = array(
            'column_size' => '',
            'cs_clients_view' => 'Grid View',
            'cs_client_border' => 'Yes',
            'cs_client_style' => '',
            'cs_client_section_title' => '',
            'cs_client_class' => ''
        );
        extract(shortcode_atts($defaults, $atts));


        $CustomId = '';
        if (isset($cs_client_class) && $cs_client_class) {
            $CustomId = 'id="' . $cs_client_class . '"';
        }

        $column_class = jobcareer_custom_column_class($column_size);
        $owlcount = rand(40, 9999999);
        $title = "";
        if (isset($cs_client_section_title) && $cs_client_section_title <> "") {
            $title = $cs_client_section_title;
        }

        if (isset($cs_client_style) && $cs_client_style <> '') {
            $cs_client_style = $cs_client_style;
        } else {
            $cs_client_style = '';
        }

        $html = '';
        jobcareer_enqueue_slick_script();
        $html = "";
        if ($title <> "") {
            $html .= '<h2>' . esc_attr($title) . '</h2>';
        }
		if( $cs_client_style == 'simple' ) {
			$html .= '<div class="cs-clinets">';
			$html .= '<div class="container">';
			$html .= '<div class="row">';
			$html .= do_shortcode($content);
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			return $html;
		} else {
			$html .= '<div class="cs-clinets">';
			$html .= '<div class="container">';
			$html .= '<div class="row">';
			$html .= '<ul class="clients">';
			$html .= do_shortcode($content);
			$html .= '</ul>';
			$html .= '</div>';
			$html .= '</div>';
			$html .= '</div>';
			return $html;
			?>
	
			<script type='text/javascript'>
				jQuery(document).ready(function () {
					'use strict';
					jQuery('.clients').slick({
						slidesToShow: 3,
						slidesToScroll: 1,
						autoplay: true,
						autoplaySpeed: 2000,
					});
				});
			</script>
        <?php
		}
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_CLIENTS, 'jobcareer_clients_shortcode');
    }
}

/*
 *
 * @Clinets Item
 * @retrun
 *
 */
if (!function_exists('cs_clients_item_shortcode')) {

    function cs_clients_item_shortcode($atts, $content = "") {
        global $post, $cs_clients_view, $cs_client_border, $cs_client_gray, $cs_client_style;
        $defaults = array('cs_bg_color' => '', 'cs_website_url' => '', 'cs_client_title' => '', 'cs_client_logo' => '');
        extract(shortcode_atts($defaults, $atts));
        $randomid = rand(0, 999);

        $html = '';
        $cs_client_logo = isset($cs_client_logo) ? $cs_client_logo : '';
        $cs_website_url = isset($cs_website_url) ? $cs_website_url : '';
        $tooltip = '';
        if (isset($cs_client_title) && $cs_client_title != '') {
            $tooltip = 'title="' . $cs_client_title . '"';
        }

        $cs_url = $cs_website_url ? $cs_website_url : 'javascript:;';
		if( $cs_client_style == 'simple' ) {
			$html .= '<div class="col-lg-2 col-md-3 col-sm-4 col-xs-12"><img src="' . esc_url($cs_client_logo) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '"/></div>';
		} else {
        	$html .= '<li class="col-lg-2 col-md-3 col-sm-4 col-xs-12"><img src="' . esc_url($cs_client_logo) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '"/></li>';
		}
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_CLIENTSITEM, 'cs_clients_item_shortcode');
    }
}