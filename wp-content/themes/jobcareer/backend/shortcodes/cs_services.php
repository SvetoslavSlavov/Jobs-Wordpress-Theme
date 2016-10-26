<?php
/*
 *
 * @Shortcode Name : Services
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_services')) {

    function jobcareer_pb_services($die = 0) {
        global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $PREFIX = CS_SC_SERVICES;
        $cs_counter = $_POST['counter'];
        $parseObject = new ShortcodeParse();
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'column_size' => '1/2',
            'cs_service_icon' => '',
            'cs_service_icon_color' => '',
            'cs_service_title' => '',
            'cs_service_link' => '',
            'cs_service_title_color' => '',
            'cs_service_content' => '',
            'cs_service_content_color' => '',
            'cs_service_view' => 'simple', // modern or simple
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if (isset($output['0']['content'])) {
            $atts_content = $output['0']['content'];
        } else {
            $atts_content = "";
        }
        $services_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_services';
        $coloumn_class = 'column_' . $services_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        $counter_count = $cs_counter;
        $rand_counter = jobcareer_generate_random_string(10);
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="services" data="<?php echo jobcareer_element_size_data_array_index($services_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $services_element_size, '', 'check-square-o'); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_SERVICES); ?> {{attributes}}]{{content}}[/<?php echo esc_attr(CS_SC_SERVICES); ?>]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('EDIT SERVICES OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_attr($name . $cs_counter); ?>','<?php echo esc_attr($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content">
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Views', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Set the service style", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => $cs_service_view,
                                'id' => '',
                                'cust_name' => 'cs_service_view[]',
                                'classes' => 'service_postion chosen-select-no-single select-medium',
                                'options' => array(
                                    'simple' => esc_html__('Simple', 'jobcareer'),
                                    'modern' => esc_html__('Modern', 'jobcareer'),
                                ),
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_select_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Enter service title here', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_service_title),
                                'id' => 'cs_service_title',
                                'cust_name' => 'cs_service_title[]',
                                'classes' => 'txtfield',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Title Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Provide a hex colour code here (with #) if you want to override the default.', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_service_title_color),
                                'id' => 'cs_service_title_color',
                                'cust_name' => 'cs_service_title_color[]',
                                'classes' => 'bg_color',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        $rand_id = rand(0, 85498749847);
                        ?>
                        <div class="form-elements" id="cs_infobox_<?php echo esc_attr($rand_id); ?>">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <label><?php esc_html_e('Service Icon', 'jobcareer'); ?></label>
                                <?php
                                if (function_exists('jobcareer_tooltip_text')) {
                                    echo jobcareer_tooltip_text(esc_html__('Select the Icons you would like to show with your accordian title.', 'jobcareer'));
                                }
                                ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <?php jobcareer_fontawsome_icons_box($cs_service_icon, $rand_id, 'cs_service_icon'); ?>
                                <p></p>
                            </div>
                        </div>
                        <?php
                        
                        $cs_opt_array = array(
                            'name' => esc_html__('Icon Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Provide a hex colour code here (with #) for text color. if you want to override the default.', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_service_icon_color),
                                'id' => 'cs_service_icon_color',
                                'cust_name' => 'cs_service_icon_color[]',
                                'classes' => 'bg_color',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        
                        $cs_opt_array = array(
                            'name' => esc_html__('Title Link', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Enter service title link here', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_service_link),
                                'id' => 'cs_service_link',
                                'cust_name' => 'cs_service_link[]',
                                'classes' => 'txtfield',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        
                        $cs_opt_array = array(
                            'name' => esc_html__('Content', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Enter the content here', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_textarea($atts_content),
                                'id' => 'cs_service_content',
                                'extra_atr' => ' data-content-text="cs-shortcode-textarea"',
                                'cust_name' => 'cs_service_content[]',
                                'classes' => '',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);

                        $cs_opt_array = array(
                            'name' => esc_html__('Content Color', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__('Provide a hex colour code here (with #) for text color. if you want to override the default.', 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_html($cs_service_content_color),
                                'id' => 'cs_service_content_color',
                                'cust_name' => 'cs_service_content_color[]',
                                'classes' => 'bg_color',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>
                    </div>

                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter); ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
                    <?php } else { ?>


                        <?php
                        $cs_opt_array = array(
                            'std' => 'services',
                            'id' => '',
                            'before' => '',
                            'after' => '',
                            'classes' => '',
                            'extra_atr' => '',
                            'cust_id' => '',
                            'cust_name' => 'cs_orderby[]',
                            'return' => true,
                            'required' => false
                        );
                        echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => '',
                            'desc' => '',
                            'hint_text' => '',
                            'echo' => true,
                            'field_params' => array(
                                'std' => 'Save',
                                'cust_id' => '',
                                'cust_type' => 'button',
                                'classes' => 'cs-admin-btn',
                                'cust_name' => '',
                                'extra_atr' => 'onclick="javascript:_removerlay(jQuery(this))"',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>  
                    <?php } ?>
                </div>
            </div>
        </div>
        <script>


            /*
             * modern selection box function
             */
            jQuery(document).ready(function ($) {
	                chosen_selectionbox();
					popup_over();
				 });
            /*
             * modern selection box function
             */
        </script>
        <?php
        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_jobcareer_pb_services', 'jobcareer_pb_services');
}
?>