<?php
/*
 * Start function for multi services backend view
 */
if (!function_exists('jobcareer_pb_multiple_services')) {

    function jobcareer_pb_multiple_services($die = 0) {
        global $jobcareer_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $multiple_services_num = 0;
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_MULTPLESERVICES . '|' . CS_SC_MULTPLESERVICESITEM;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'cs_multiple_service_section_title' => '',
            'cs_multiple_services_view' => '',
            'cs_service_content_align' => '',
            'cs_service_image_align' => '',
            'cs_service_styles' => '',
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if (isset($output['0']['content'])) {
            $atts_content = $output['0']['content'];
        } else {
            $atts_content = array();
        }
        if (is_array($atts_content)) {
            $multiple_services_num = count($atts_content);
        }
        $multiple_services_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }

        $name = 'jobcareer_pb_multiple_services';
        $coloumn_class = 'column_' . $multiple_services_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        $randD_id = rand(34213234, 453324453);
        ?>
        <div id="<?php echo jobcareer_special_char($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo jobcareer_special_char($coloumn_class); ?> <?php echo jobcareer_special_char($shortcode_view); ?>" item="multiple_services" data="<?php echo jobcareer_element_size_data_array_index($multiple_services_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $multiple_services_element_size, '', 'weixin'); ?>
            <div class="cs-wrapp-class-<?php echo jobcareer_special_char($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter); ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Edit Multiple services Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter) ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content" >
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo esc_attr($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_MULTPLESERVICES); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_MULTPLESERVICESITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_MULTPLESERVICESITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[<?php echo esc_attr(CS_SC_MULTPLESERVICES); ?> {{attributes}}]">
                                <?php
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                }
                                ?>
                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Section Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Add section title here.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_multiple_service_section_title),
                                        'cust_id' => '',
                                        'classes' => '',
                                        'cust_name' => 'cs_multiple_service_section_title[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                $cs_opt_array = array(
                                    'name' => esc_html__('View', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Choose style for multiple services.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_multiple_services_view,
                                        'id' => '',
                                        'cust_id' => 'cs_size',
                                        'cust_name' => 'cs_multiple_services_view[]',
                                        'classes' => 'cs_size chosen-select select-medium',
                                        'options' => array(
                                            'simple' => esc_html__('Simple', 'jobcareer'),
                                            'fancy' => esc_html__('Fancy', 'jobcareer'),
                                            'slider' => esc_html__('Slider', 'jobcareer'),
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);

                                  $cs_opt_array = array(
                                    'name' => esc_html__(' 123 Content Align', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Set the position of service image here", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_service_content_align,
                                        'id' => '',
                                        'cust_name' => 'cs_service_content_align[]',
                                        'classes' => 'dropdown chosen-select',
                                        'options' => array(
                                            'left' => esc_html__('Left', 'jobcareer'),
                                            'right' => esc_html__('Right', 'jobcareer'),
                                            'center' => esc_html__('Center', 'jobcareer')
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);


                                $cs_opt_array = array(
                                    'name' => esc_html__('Image Align', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Set the position of service image here.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_service_image_align,
                                        'id' => '',
                                        'cust_name' => 'cs_service_image_align[]',
                                        'classes' => 'dropdown chosen-select',
                                        'options' => array(
                                            'left' => esc_html__('Left', 'jobcareer'),
                                            'right' => esc_html__('right', 'jobcareer'),
                                            'top_tight' => esc_html__('Top Right', 'jobcareer'),
                                            'top_left' => esc_html__('Top left', 'jobcareer'),
                                            'top_center' => esc_html__('Top center', 'jobcareer'),
                                        ),
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                            ?>
                            </div>
                                <?php
                                if (isset($multiple_services_num) && $multiple_services_num <> '' && isset($atts_content) && is_array($atts_content)) {
                                    $itemCounter = 0;
                                    foreach ($atts_content as $multiple_services_items) {
                                        $itemCounter++;
                                        $rand_id = rand(3453499, 94646890);
                                        $cs_multiple_service_text = $multiple_services_items['content'];
                                        $defaults = array('cs_title_color' => '', 'cs_text_color' => '', 'cs_bg_color' => '', 'cs_website_url' => '', 'cs_multiple_service_title' => '', 'cs_multiple_service_logo' => '', 'cs_multiple_service_btn' => '', 'cs_multiple_service_btn_link' => '', 'cs_multiple_service_btn_bg_color' => '', 'cs_multiple_service_btn_txt_color' => '',
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

                                        foreach ($defaults as $key => $values) {
                                            if (isset($multiple_services_items['atts'][$key])) {
                                                $$key = $multiple_services_items['atts'][$key];
                                            } else {
                                                $$key = $values;
                                            }
                                        }
                                        ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo jobcareer_special_char($rand_id); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php esc_html_e('Multiple services', 'jobcareer'); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a>
                                        </header>
                <?php
                $cs_opt_array = array(
                    'name' => esc_html__('Title', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__("Add service title here..", 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => jobcareer_special_char($cs_multiple_service_title),
                        'cust_id' => 'cs_multiple_service_title',
                        'classes' => '',
                        'cust_name' => 'cs_multiple_service_title[]',
                        'return' => true,
                    ),
                );

                $jobcareer_html_fields->cs_text_field($cs_opt_array);
                ?>

                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Title Color', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Set title color from here.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_attr($cs_title_color),
                                                'cust_id' => 'cs_title_color',
                                                'classes' => 'bg_color',
                                                'cust_name' => 'cs_title_color[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        ?>
 
                                        <?php
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
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Services Background Color', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Set the Service Background', 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_html($cs_service_background_color),
                                                'id' => 'cs_service_background_color',
                                                'cust_name' => 'cs_service_background_color[]',
                                                'classes' => 'bg_color',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);


                                        $cs_opt_array = array(
                                            'std' => $cs_multiple_service_logo,
                                            'id' => 'multiple_service_logo',
                                            'name' => esc_html__('Multiple service Logo', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => '',
                                            'echo' => true,
                                            'array' => true,
                                            'field_params' => array(
                                                'std' => $cs_multiple_service_logo,
                                                'cust_id' => '',
                                                'id' => 'multiple_service_logo',
                                                'return' => true,
                                                'array' => true,
                                                'array_txt' => false,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);



                                        $cs_opt_array = array(
                                            'name' => esc_html__('Image Size', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Set the Icon font size here", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => $cs_service_image_size,
                                                'id' => '',
                                                'cust_name' => 'cs_service_image_size[]',
                                                'classes' => 'service_postion chosen-select-no-single select-medium',
                                                'options' => array(
                                                    'img-xs' => esc_html__('Extra Small', 'jobcareer'),
                                                    'img-sm' => esc_html__('Small', 'jobcareer'),
                                                    'img-md' => esc_html__('Medium', 'jobcareer'),
                                                    'img-ml' => esc_html__('Medium Large', 'jobcareer'),
                                                    'img-lg' => esc_html__('Large', 'jobcareer'),
                                                    'free-size' => esc_html__('Free Size', 'jobcareer'),
                                                ),
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_select_field($cs_opt_array);


                                        $cs_opt_array = array(
                                            'name' => esc_html__('Icon / Image with Title', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Set the icon/image with title", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => $cs_service_image_icon,
                                                'id' => '',
                                                'cust_name' => 'cs_service_image_icon[]',
                                                'classes' => 'service_postion chosen-select-no-single select-medium',
                                                'options' => array(
                                                    'yes' => esc_html__('Yes', 'jobcareer'),
                                                    'no' => esc_html__('no', 'jobcareer'),
                                                ),
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_select_field($cs_opt_array);

                                        $cs_opt_array = array(
                                            'name' => esc_html__('Image Circle', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Set the icon/image with title", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => $cs_service_image_circle,
                                                'id' => '',
                                                'cust_name' => 'cs_service_image_circle[]',
                                                'classes' => 'service_postion chosen-select-no-single select-medium',
                                                'options' => array(
                                                    'yes' => esc_html__('Yes', 'jobcareer'),
                                                    'no' => esc_html__('no', 'jobcareer'),
                                                ),
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_select_field($cs_opt_array);

                                        $rand_id = rand(0, 85498749847);
                                        ?>	 				


                                        <div class="form-elements" id="cs_infobox_<?php echo esc_attr($rand_id); ?>">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <label><?php esc_html_e('Fontawsome Icon', 'jobcareer'); ?></label>
                <?php
                if (function_exists('jobcareer_tooltip_text')) {
                    echo jobcareer_tooltip_text('Select the Icons you would like to show with your accordian title.');
                }
                ?>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <?php jobcareer_fontawsome_icons_box($cs_sercices_icon, $rand_id, 'cs_sercices_icon'); ?>
                                                <p></p>
                                            </div>
                                        </div>
                <?php
                $cs_opt_array = array(
                    'name' => esc_html__('Icon Font Size', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__("Set the icon/image with title", 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => $cs_service_icon_size,
                        'id' => '',
                        'cust_name' => 'cs_service_icon_size[]',
                        'classes' => 'service_postion chosen-select-no-single select-medium',
                        'options' => array(
                            'icon-xs' => esc_html__('Extra Small', 'jobcareer'),
                            'icon-sm' => esc_html__('Small', 'jobcareer'),
                            'icon-md' => esc_html__('Medium', 'jobcareer'),
                            'icon-ml' => esc_html__('Medium Large', 'jobcareer'),
                            'icon-lg' => esc_html__('Large', 'jobcareer'),
                            'icon-xl' => esc_html__('Extra Large', 'jobcareer'),
                            'icon-xxl' => esc_html__('Free Size', 'jobcareer'),
                        ),
                        'return' => true,
                    ),
                );

                $jobcareer_html_fields->cs_select_field($cs_opt_array);


                $cs_opt_array = array(
                    'name' => esc_html__('Icon Color', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__('Set the position of service image here', 'jobcareer'),
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
                    'name' => esc_html__('Icon Circle on/off', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__("Set the Icon Circle", 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => $cs_service_icon_circle,
                        'id' => '',
                        'cust_name' => 'cs_service_icon_circle[]',
                        'classes' => 'dropdown chosen-select',
                        'options' => array(
                            'yes' => esc_html__('Yes', 'jobcareer'),
                            'no' => esc_html__('No', 'jobcareer'),
                        ),
                        'return' => true,
                    ),
                );

                $jobcareer_html_fields->cs_select_field($cs_opt_array);



                $cs_opt_array = array(
                    'name' => esc_html__('Button Link', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__('Enter button link here', 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_url($cs_button_link),
                        'id' => 'cs_button_link',
                        'cust_name' => 'cs_button_link[]',
                        'classes' => '',
                        'return' => true,
                    ),
                );
                $jobcareer_html_fields->cs_text_field($cs_opt_array);

                $cs_opt_array = array(
                    'name' => esc_html__('Button Text', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__('Button text color', 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_html($cs_button_text),
                        'id' => 'cs_button_text',
                        'cust_name' => 'cs_button_text[]',
                        'classes' => '',
                        'return' => true,
                    ),
                );
                $jobcareer_html_fields->cs_text_field($cs_opt_array);


                $cs_opt_array = array(
                    'name' => esc_html__('Button Text Color', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__('Enter button text color text here', 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_html($cs_button_text_color),
                        'id' => 'cs_button_text_color',
                        'cust_name' => 'cs_button_text_color[]',
                        'classes' => 'bg_color',
                        'return' => true,
                    ),
                );
                $jobcareer_html_fields->cs_text_field($cs_opt_array);




                $cs_opt_array = array(
                    'name' => esc_html__('Button Background Color', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__('Provide a hex colour code here (with #) for button background color. if you want to override the default', 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_html($cs_button_color),
                        'id' => 'cs_button_color',
                        'cust_name' => 'cs_button_color[]',
                        'classes' => 'bg_color',
                        'return' => true,
                    ),
                );
                $jobcareer_html_fields->cs_text_field($cs_opt_array);
 
                $cs_opt_array = array(
                    'name' => esc_html__('Website Url', 'jobcareer'),
                    'desc' => '',
                    'hint_text' => esc_html__("e.g. http://yourdomain.com/.", 'jobcareer'),
                    'echo' => true,
                    'field_params' => array(
                        'std' => esc_attr($cs_website_url),
                        'cust_id' => 'cs_website_url',
                        'classes' => '',
                        'cust_name' => 'cs_website_url[]',
                        'return' => true,
                    ),
                );

                $jobcareer_html_fields->cs_text_field($cs_opt_array);
           
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Text', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Enter little description about service.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($cs_multiple_service_text),
                                                'cust_id' => '',
                                                'classes' => 'txtfield',
                                                'cust_name' => 'cs_multiple_service_text[]',
                                                'return' => true,
                                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);
                                        ?>
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
            }
        }
        ?>
                            </div>
                            <div class="hidden-object">
                                <?php
                                $cs_opt_array = array(
                                    'std' => (int) $multiple_services_num,
                                    'id' => '',
                                    'before' => '',
                                    'after' => '',
                                    'classes' => 'fieldCounter',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'multiple_services_num[]',
                                    'return' => true,
                                    'required' => false
                                );
                                echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                                ?>
                            </div>
                        </div>

                    </div>
                    <div class="wrapptabbox no-padding-lr">
                        <div class="opt-conts">
                            <ul class="form-elements noborder">
                                <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('multiple_services', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add Multiple service', 'jobcareer'); ?></a> </li>
                                <div id="loading" class="shortcodeload"></div>
                            </ul>
                        </div>
        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                            <ul class="form-elements insert-bg">
                                <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo jobcareer_special_char(str_replace('jobcareer_pb_', '', $name)); ?>', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                            </ul>
                            <div id="results-shortocde"></div>
        <?php } else { ?>
            <?php
            $cs_opt_array = array(
                'std' => 'multiple_services',
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

    add_action('wp_ajax_jobcareer_pb_multiple_services', 'jobcareer_pb_multiple_services');
}
?>
