<?php

/*
 *
 * @Shortcode Name : Start function for Map shortcode/element front end view
 * @retrun
 *
 */
if (!function_exists('jobcareer_map_shortcode')) {

    function jobcareer_map_shortcode($atts, $content = "") {
        global $header_map, $jobcareer_form_fields;
        $defaults = array(
            'column_size' => '1/1',
            'cs_map_section_title' => '',
            'map_title' => '',
            'map_height' => '',
            'map_lat' => '51.507351',
            'map_lon' => '-0.127758',
            'map_zoom' => '',
            'map_type' => '',
            'map_info' => '',
            'map_info_width' => '200',
            'map_info_height' => '200',
            'map_marker_icon' => '',
            'map_show_marker' => 'true',
            'map_controls' => '',
            'map_draggable' => '',
            'map_scrollwheel' => '',
            'map_conactus_content' => '',
            'map_border' => '',
            'map_border_color' => '',
            'cs_map_style' => '',
            'cs_map_class' => '',
            'cs_map_directions' => 'off'
        );
        extract(shortcode_atts($defaults, $atts));

        $CustomId = '';
        if (isset($cs_map_class) && $cs_map_class) {
            $CustomId = 'id="' . $cs_map_class . '"';
        }

        if ($map_info_width == '' || $map_info_height == '') {
            $map_info_width = '300';
            $map_info_height = '150';
        }

        if (isset($map_height) && $map_height == '') {
            $map_height = '500';
        }

        if ($header_map) {
            $column_class = '';
            $header_map = false;
        } else {
            $column_class = jobcareer_custom_column_class($column_size);
        }

        $section_title = '';

        if ($cs_map_section_title && trim($cs_map_section_title) != '') {
            $section_title = '<div class="cs-section-title"><h2>' . $cs_map_section_title . '</h2></div>';
        }
        $map_dynmaic_no = rand(6548, 9999999);
        if ($map_show_marker == "true") {
            $map_show_marker = " var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: '',
                        icon: '" . $map_marker_icon . "',
                        shadow: ''
                    });
            ";
        } else {
            $map_show_marker = "var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: '',
                        icon: '',
                        shadow: ''
                    });";
        }
        $border = '';
        if (isset($map_border) && $map_border == 'yes' && $map_border_color != '') {
            $border = 'border:1px solid ' . $map_border_color . '; ';
        }
		
		jobcareer_google_map_script();

        $map_type = isset($map_type) ? $map_type : '';
        $map_dynmaic_no = jobcareer_generate_random_string('10');
        $html = '';
        $html .= '<div ' . $CustomId . ' class="' . $cs_map_class . ' " style="animation-duration:">';
        $html .= $section_title;
        $html .= '<div class="clear"></div>';
        $html .= '<div class="cs-map-section" style="' . $border . ';">';
        $html .= '<div class="cs-map">';
        $html .= '<div class="cs-map-content">';
        
        if ($cs_map_directions == 'on') {
            $html .= '<div class="cs-dir-srch-box" id="cs-dir-srch-box">';
            $cs_opt_array = array(
                'std' => '',
                'id' => '',
                'before' => '',
                'after' => '',
                'classes' => '',
                'extra_atr' => 'placeholder="' . esc_html__('Enter Location', 'jobcareer') . '"',
                'cust_id' => 'cs_end_direction',
                'cust_name' => '',
                'return' => true,
                'required' => false
            );
            
            $html .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);
            
            $html .= '<i class="icon-arrow-down8"></i>
                        <ul id="cs_direction_mode" class="cs_direction_mode">
                                <li class="cs-active" data-value="DRIVING">' . esc_html__("Driving", 'jobcareer') . '</li>
                                <li data-value="WALKING">' . esc_html__("Walking", 'jobcareer') . '</li>
                                <li data-value="BICYCLING">' . esc_html__("Bicycling", 'jobcareer') . '</li>
                                <li data-value="TRANSIT">' . esc_html__("Transit", 'jobcareer') . '</li>
                        </ul>';
            
            $cs_opt_array = array(
                'std' => 'DRIVING',
                'id' => '',
                'before' => '',
                'after' => '',
                'classes' => '',
                'extra_atr' => '',
                'cust_id' => 'cs_chng_dir_mode',
                'cust_name' => '',
                'return' => true,
                'required' => false
            );
            
            $html .= $jobcareer_form_fields->cs_form_hidden_render($cs_opt_array);
            
            $html .= '<label class="search-button">';
            $cs_opt_array = array(
                'name' => '',
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => '',
                    'cust_id' => 'cs_search_direction',
                    'cust_type' => 'button',
                    'classes' => 'cs_search_direction',
                    'cust_name' => '',
                    'extra_atr' => '',
                    'return' => true,
                ),
            );
            $html .= $jobcareer_html_fields->cs_text_field($cs_opt_array);
            
            $html .= '</label></div>';
        }
        $html .= '<div class="mapcode iframe mapsection gmapwrapp" id="map_canvas' . $map_dynmaic_no . '" style="height:' . $map_height . 'px;"> </div>';
        
        if ($cs_map_directions == 'on') {
            $html .= '<div id="cs-directions-panel"></div>';
        }
        
        $html .= '</div>';
        $html .= '</div>';
        $html .= "<script type='text/javascript'>
                    jQuery(window).load(function(){
						'use strict';
                        setTimeout(function(){
                        jQuery('.cs-map-" . $map_dynmaic_no . "').animate({
                            'height':'" . $map_height . "'
                        },400)
                        },400)
                    })
		    var panorama;
                    function initialize() {
                    var myLatlng = new google.maps.LatLng(" . $map_lat . ", " . $map_lon . ");
                    var mapOptions = {
                        zoom: " . $map_zoom . ",
                        scrollwheel: " . $map_scrollwheel . ",
                        draggable: " . $map_draggable . ",
                        streetViewControl: false,
                        center: myLatlng,
                        mapTypeId: google.maps.MapTypeId." . $map_type . ",
                        disableDefaultUI: " . $map_controls . ",
                        };";

        if ($cs_map_directions == 'on') {
            $html .= "var directionsDisplay;
                      var directionsService = new google.maps.DirectionsService();
                      directionsDisplay = new google.maps.DirectionsRenderer();";
        }

        $html .= "var map = new google.maps.Map(document.getElementById('map_canvas" . $map_dynmaic_no . "'), mapOptions);";

        if ($cs_map_directions == 'on') {
            $html .= "directionsDisplay.setMap(map);
                        directionsDisplay.setPanel(document.getElementById('cs-directions-panel'));

                        function cs_calc_route() {
                                var myLatlng = new google.maps.LatLng(" . $map_lat . ", " . $map_lon . ");
                                var start = myLatlng;
                                var end = document.getElementById('cs_end_direction').value;
                                var mode = document.getElementById('cs_chng_dir_mode').value;
                                var request = {
                                        origin:start,
                                        destination:end,
                                        travelMode: google.maps.TravelMode[mode]
                                };
                                directionsService.route(request, function(response, status) {
                                        if (status == google.maps.DirectionsStatus.OK) {
                                                directionsDisplay.setDirections(response);
                                        }
                                });
                        }

                        document.getElementById('cs_search_direction').addEventListener('click', function() {
                                cs_calc_route();
                        });";
        }

        $html .= "
                        var styles = '';
                        if(styles != ''){
                            var styledMap = new google.maps.StyledMapType(styles, {name: 'Styled Map'});
                            map.mapTypes.set('map_style', styledMap);
                            map.setMapTypeId('map_style');
                        }
                        var infowindow = new google.maps.InfoWindow({
                            content: '" . $map_info . "',
                            maxWidth: " . $map_info_width . ",
                            maxHeight: " . $map_info_height . ",
                            
                        });
                        " . $map_show_marker . "
                        //google.maps.event.addListener(marker, 'click', function() {
                            if (infowindow.content != ''){
                              infowindow.open(map, marker);
                               map.panBy(1,-60);
                               google.maps.event.addListener(marker, 'click', function(event) {
                                infowindow.open(map, marker);
                               });
                            }
                        //});
                            panorama = map.getStreetView();
                            panorama.setPosition(myLatlng);
                            panorama.setPov(({
                              heading: 265,
                              pitch: 0
                            }));

                    }
					
                        function cs_toggle_street_view(btn) {
                          var toggle = panorama.getVisible();
                          if (toggle == false) {
                                if(btn == 'streetview'){
                                  panorama.setVisible(true);
                                }
                          } else {
                                if(btn == 'mapview'){
                                  panorama.setVisible(false);
                                }
                          }
                        }

                google.maps.event.addDomListener(window, 'load', initialize);
                </script>";

        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MAP, 'jobcareer_map_shortcode');
    }
}