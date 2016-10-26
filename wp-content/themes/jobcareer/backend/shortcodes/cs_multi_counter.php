<?php
/*
 *
 * @Shortcode Name : multi_counters
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_multi_counters')) {

    function jobcareer_pb_multi_counters($die = 0) {
        global $jobcareer_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $multi_counters_num = 0;
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_MULTICOUNTERS . '|' . CS_SC_MULTICOUNTERSITEM;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array('column_size' => '1/1', 'multi_counters_text_color' => '', 'cs_multi_counters_text_align' => '', 'cs_multi_counters_section_title' => '', 'cs_multi_counters_class' => '', 'multi_counters_style');
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
            $multi_counters_num = count($atts_content);
        }
        $multi_counters_element_size = '67';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_multi_counters';
        $coloumn_class = 'column_' . $multi_counters_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo jobcareer_special_char($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo jobcareer_special_char($coloumn_class); ?> <?php echo jobcareer_special_char($shortcode_view); ?>" item="multi_counters" data="<?php echo jobcareer_element_size_data_array_index($multi_counters_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $multi_counters_element_size, '', 'comments-o', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo jobcareer_special_char($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter) ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('EDIT MULTI COUNTER OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter) ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_MULTICOUNTERS); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_MULTICOUNTERSITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_MULTICOUNTERSITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true cs-pbwp-content" data-template="[<?php echo esc_attr(CS_SC_MULTICOUNTERS); ?> {{attributes}}]">
                                <?php
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                } //multi_counters_style
                                ?>

                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Section Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Enter section title for this counter.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_multi_counters_section_title),
                                        'cust_id' => '',
                                        'classes' => 'txtfield',
                                        'cust_name' => 'cs_multi_counters_section_title[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                ?>

                            </div>
                            <?php
                            if (isset($multi_counters_num) && $multi_counters_num <> '' && isset($atts_content) && is_array($atts_content)) {

                                foreach ($atts_content as $multi_counters) {

                                    $rand_string = rand(324335, 9234299);
                                    $counter_count = rand(324335, 9234299);
                                    $multi_counters_text = $multi_counters['content'];

                                    $defaults = array(
                                        'column_size' => '1/1',
                                        'counter_style' => '',
                                        'multi_counters_img' => '',
                                        'cs_counter_logo' => '',
                                        'counter_icon' => '',
                                        'counter_icon_align' => '',
                                        'counter_icon_color' => '',
                                        'counter_numbers' => '',
                                        'counter_number_color' => '',
                                        'counter_title' => '',
                                        'counter_link_title' => '',
                                        'counter_link_url' => '',
                                        'counter_text_color' => '',
                                        'counter_border' => '',
                                        'counter_icon_type' => '',
                                        'counter_border_color' => '',
                                        'counter_class' => '',
                                    );
                                    foreach ($defaults as $key => $values) {
                                        if (isset($multi_counters['atts'][$key])) {
                                            $$key = $multi_counters['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content' id="cs_infobox_<?php echo jobcareer_special_char($rand_string); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php esc_html_e('Multi Counters', 'jobcareer'); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a>
                                        </header>
                                        <div class="selected_icon_type<?php echo esc_attr($counter_count) ?>" id="selected_view_icon_icon_type<?php echo esc_attr($counter_count) ?>" <?php
                                        if ($counter_style == "icon-border" || $counter_icon_type == "icon") {
                                            echo 'style="display:block"';
                                        } else {
                                            echo 'style="display:block"';
                                        }
                                        ?>>



                                            <div class="form-elements" id="<?php echo intval($rand_string); ?>">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <label><?php esc_html_e('Font awsome Icon:', 'jobcareer'); ?></label>
                                                    <?php
                                                    if (function_exists('jobcareer_tooltip_text')) {
                                                        echo jobcareer_tooltip_text('Choose icon for counter.');
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <?php jobcareer_fontawsome_icons_box($counter_icon, $rand_string, 'counter_icon'); ?>
                                                    <p></p>
                                                </div>
                                            </div>

                                            <?php
                                            $cs_opt_array = array(
                                                'name' => esc_html__('Icon Color', 'jobcareer'),
                                                'desc' => '',
                                                'hint_text' => esc_html__("Set icon color here", 'jobcareer'),
                                                'echo' => true,
                                                'field_params' => array(
                                                    'std' => esc_attr($counter_icon_color),
                                                    'cust_id' => '',
                                                    'classes' => 'bg_color',
                                                    'cust_name' => 'counter_icon_color[]',
                                                    'return' => true,
                                                ),
                                            );

                                            $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                            ?>
                                        </div>


                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Set number', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Set counting numbers for count", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_attr($counter_numbers),
                                                'cust_id' => '',
                                                'classes' => '',
                                                'cust_name' => 'counter_numbers[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        ?>
                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Number Color', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Set counter number color with this.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($counter_number_color),
                                                'cust_id' => '',
                                                'classes' => 'bg_color',
                                                'cust_name' => 'counter_number_color[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        ?>

                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Title', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Enter title of counter icon.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($counter_title),
                                                'cust_id' => '',
                                                'classes' => 'txtfield',
                                                'cust_name' => 'counter_title[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        ?>

                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Title Color', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Set title color.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => jobcareer_special_char($counter_text_color),
                                                'cust_id' => '',
                                                'classes' => 'bg_color',
                                                'cust_name' => 'counter_text_color[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        ?>



                                        <div class="selected_image_type" id="selected_view_border_type<?php echo esc_attr($counter_count) ?>" <?php
                                        if ($counter_style == "icon-border") {
                                            echo 'style="display:block"';
                                        } else {
                                            echo 'style="display:none"';
                                        }
                                        ?>>

                                            <?php
                                            $cs_opt_array = array(
                                                'name' => esc_html__('Border Frame', 'jobcareer'),
                                                'desc' => '',
                                                'hint_text' => esc_html__("Choose border Yes/No.", 'jobcareer'),
                                                'echo' => true,
                                                'field_params' => array(
                                                    'std' => $counter_border,
                                                    'id' => '',
                                                    'cust_id' => '',
                                                    'cust_name' => 'counter_border[]',
                                                    'classes' => 'dropdown chosen-select-no-single select-medium',
                                                    'options' => array(
                                                        'off' => esc_html__('No', 'jobcareer'),
                                                        'on' => esc_html__('Yes', 'jobcareer'),
                                                    ),
                                                    'return' => true,
                                                ),
                                            );

                                            $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                            ?>
                                        </div>

                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Custom Id', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Use this option if you want to use specified id for this element.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_attr($counter_class),
                                                'cust_id' => '',
                                                'classes' => 'txtfield input-medium',
                                                'cust_name' => 'counter_class[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        ?>
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
                                }
                            }
                            ?>
                        </div>
                        <div class="hidden-object">
                            <?php
                            $cs_opt_array = array(
                                'std' => jobcareer_special_char($multi_counters_num),
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'multi_counters_num[]',
                                'return' => true,
                                'required' => false
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                            ?>

                        </div>
                        <div class="wrapptabbox cs-pbwp-content cs-zero-padding">
                            <div class="opt-conts">
                                <ul class="form-elements">
                                    <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('multi_counters', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo admin_url('admin-ajax.php'); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add Multi Counters', 'jobcareer'); ?></a> </li>
                                    <div id="loading" class="shortcodeload"></div>
                                </ul>
                                <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                                    <ul class="form-elements insert-bg noborder">
                                        <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('jobcareer_pb_', '', $name); ?>', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                                    </ul>
                                    <div id="results-shortocde"></div>
                                <?php } else { ?>
                                    <?php
                                    $cs_opt_array = array(
                                        'std' => 'multi_counters',
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

    add_action('wp_ajax_jobcareer_pb_multi_counters', 'jobcareer_pb_multi_counters');
}