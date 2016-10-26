<?php
/*
 *
 * @Shortcode Name : Heading
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_mailchimp')) {

    function jobcareer_pb_mailchimp($die = 0) {
        global $jobcareer_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $counter = $_POST['counter'];
        $cs_counter = $_POST['counter'];
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_MAILCHIMP;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'mailchimp_title' => '',
            'mailchimp_style' => ''
        );
        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }
        if (isset($output['0']['content'])) {
            $mailchimp_content = $output['0']['content'];
        } else {
            $mailchimp_content = '';
        }
        $mailchimp_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_mailchimp';
        $coloumn_class = 'column_' . $mailchimp_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="heading" data="<?php echo jobcareer_element_size_data_array_index($mailchimp_element_size) ?>" >
        <?php jobcareer_element_setting($name, $cs_counter, $mailchimp_element_size, '', 'h-square', $type = ''); ?>
            <div class="cs-wrapp-class-<?php echo intval($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>"  data-shortcode-template="[<?php echo esc_attr(CS_SC_MAILCHIMP); ?> {{attributes}}]{{content}}[/<?php echo esc_attr(CS_SC_MAILCHIMP); ?>]" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('EDIT MAIL CHIMP OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_js($name . $cs_counter) ?>','<?php echo esc_js($filter_element); ?>')"
                       class="cs-btnclose"><i class="icon-times"></i>
                    </a>
                </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
        <?php
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            jobcareer_shortcode_element_size();
        }
        ?>


        <?php
        $cs_opt_array = array(
            'name' => esc_html__('Style', 'jobcareer'),
            'desc' => '',
            'hint_text' => esc_html__("Choose mailchimp style with this dropdown.", 'jobcareer'),
            'echo' => true,
            'field_params' => array(
                'std' => $mailchimp_style,
                'id' => '',
                'cust_id' => '',
                'cust_name' => 'mailchimp_style[]',
                'classes' => 'chosen-select-no-single select-medium',
                'options' => array(
                    'simple' => esc_html__('Simple', 'jobcareer'),
                    'modren' => esc_html__('Modern', 'jobcareer'),
                ),
                'return' => true,
            ),
        );

        $jobcareer_html_fields->cs_select_field($cs_opt_array);
      
                        $cs_opt_array = array(
                            'name' => esc_html__('Title', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter title for mailchimp here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => jobcareer_special_char($mailchimp_title),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'mailchimp_title[]',
                                'return' => true,
                            ),
                        );

                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                      
                        $cs_opt_array = array(
                            'name' => esc_html__('Content', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter mailchimp text Example : (Signup Weekly Newsletter.)", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_textarea($mailchimp_content),
                                'cust_id' => '',
                                'classes' => 'txtfield',
                                'cust_name' => 'mailchimp_content[]',
                                'return' => true,
                                'extra_atr' => 'data-content-text="cs-shortcode-textarea"',
                            ),
                        );

                        $jobcareer_html_fields->cs_textarea_field($cs_opt_array);
                        ?>




                    </div>
        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                        <ul class="form-elements insert-bg">
                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo str_replace('jobcareer_pb_', '', $name); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                        </ul>
                        <div id="results-shortocde"></div>
        <?php } else { ?>
                        <?php
                        $cs_opt_array = array(
                            'std' => 'mailchimp',
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

    add_action('wp_ajax_jobcareer_pb_mailchimp', 'jobcareer_pb_mailchimp');
}