<?php
/*
 *
 * @Shortcode Name : Clients
 * @retrun
 *
 */

if (!function_exists('jobcareer_pb_clients')) {

    function jobcareer_pb_clients($die = 0) {
        global $jobcareer_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $clients_num = 0;
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
        } else {
            $POSTID = $_POST['POSTID'];
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $PREFIX = CS_SC_CLIENTS . '|' . CS_SC_CLIENTSITEM;
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array(
            'cs_clients_view' => 'Grid View',
            'cs_client_border' => 'Yes',
            'cs_client_style' => '',
            'cs_client_section_title' => '',
            'cs_client_class' => ''
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
            $clients_num = count($atts_content);
        }
        $clients_element_size = '100';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_clients';
        $coloumn_class = 'column_' . $clients_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        $randD_id = rand(34, 453453);
        ?>
        <div id="<?php echo jobcareer_special_char($name . $cs_counter); ?>_del" class="column  parentdelete <?php echo jobcareer_special_char($coloumn_class); ?> <?php echo jobcareer_special_char($shortcode_view); ?>" item="column" data="<?php echo jobcareer_element_size_data_array_index($clients_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $clients_element_size, '', 'weixin'); ?>
            <div class="cs-wrapp-class-<?php echo jobcareer_special_char($cs_counter) ?> <?php echo jobcareer_special_char($shortcode_element); ?>" id="<?php echo jobcareer_special_char($name . $cs_counter); ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Edit Client Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo jobcareer_special_char($name . $cs_counter) ?>','<?php echo jobcareer_special_char($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a>
                </div>
                <div class="cs-clone-append cs-pbwp-content" >
                    <div class="cs-wrapp-tab-box">
                        <div id="shortcode-item-<?php echo esc_attr($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_CLIENTS); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_CLIENTSITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_CLIENTSITEM); ?>]">
                            <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[<?php echo esc_attr(CS_SC_CLIENTS); ?> {{attributes}}]">
                                <?php
                                if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                    jobcareer_shortcode_element_size();
                                }
                                ?>
                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Section Title', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Enter Section title for Clients.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => jobcareer_special_char($cs_client_section_title),
                                        'cust_id' => '',
                                        'classes' => '',
                                        'cust_name' => 'cs_client_section_title[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                ?>

                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Styles', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Select clients style with this drop down two styles avaiable slider and grid.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => $cs_client_style,
                                        'id' => '',
                                        'cust_id' => 'cs_client_style',
                                        'cust_name' => 'cs_client_style[]',
                                        'classes' => 'cs_client_style chosen-select-no-single select-medium',
                                        'options' => array(
                                            '' => esc_html__('Please Select', 'jobcareer'),
                                            'simple' => esc_html__('Simple', 'jobcareer'),
											'slider' => esc_html__('Slider', 'jobcareer'),
                                        ),
                                        'return' => true,
                                    ),
                                );
                                $jobcareer_html_fields->cs_select_field($cs_opt_array);
                                ?>    



                                <?php
                                $cs_opt_array = array(
                                    'name' => esc_html__('Custom Id', 'jobcareer'),
                                    'desc' => '',
                                    'hint_text' => esc_html__("Use this option if you want to use specified id for this element.", 'jobcareer'),
                                    'echo' => true,
                                    'field_params' => array(
                                        'std' => esc_attr($cs_client_class),
                                        'cust_id' => '',
                                        'classes' => 'txtfield input-medium',
                                        'cust_name' => 'cs_client_class[]',
                                        'return' => true,
                                    ),
                                );

                                $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                ?>

                            </div>
                            <?php
                            if (isset($clients_num) && $clients_num <> '' && isset($atts_content) && is_array($atts_content)) {
                                $itemCounter = 0;
                                foreach ($atts_content as $clients_items) {
                                    $itemCounter++;
                                    $rand_id = $cs_counter . '' . jobcareer_generate_random_string(3);
                                    $defaults = array('cs_bg_color' => '', 'cs_website_url' => '', 'cs_client_title' => '', 'cs_client_logo' => '');
                                    foreach ($defaults as $key => $values) {
                                        if (isset($clients_items['atts'][$key])) {
                                            $$key = $clients_items['atts'][$key];
                                        } else {
                                            $$key = $values;
                                        }
                                    }
                                    ?>
                                    <div class='cs-wrapp-clone cs-shortcode-wrapp'  id="cs_infobox_<?php echo jobcareer_special_char($rand_id); ?>">
                                        <header>
                                            <h4><i class='icon-arrows'></i><?php esc_html_e('Clients', 'jobcareer'); ?></h4>
                                            <a href='#' class='deleteit_node'><i class='icon-minus-circle'></i><?php esc_html_e('Remove', 'jobcareer'); ?></a></header>

                                        <?php
                                        $cs_opt_array = array(
                                            'name' => esc_html__('Website Url', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__("Enter your client URL.", 'jobcareer'),
                                            'echo' => true,
                                            'field_params' => array(
                                                'std' => esc_url($cs_website_url),
                                                'cust_id' => '',
                                                'classes' => '',
                                                'cust_name' => 'cs_website_url[]',
                                                'return' => true,
                                            ),
                                        );

                                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                        ?>

                                        <?php
                                        $cs_opt_array = array(
                                            'std' => $cs_client_logo,
                                            'id' => 'client_logo',
                                            'name' => esc_html__('Background Image', 'jobcareer'),
                                            'desc' => '',
                                            'hint_text' => esc_html__('Attach client logo here from media gallery.', 'jobcareer'),
                                            'echo' => true,
                                            'array' => true,
                                            'field_params' => array(
                                                'std' => $cs_client_logo,
                                                'cust_id' => '',
                                                'id' => 'client_logo',
                                                'return' => true,
                                                'array' => true,
                                                'array_txt' => false,
                                            ),
                                        );
                                        $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);
                                        ?>
                                    </div>

                                    <script>
                                        /*
                                       

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
                                'std' => (int) $clients_num,
                                'id' => '',
                                'before' => '',
                                'after' => '',
                                'classes' => 'fieldCounter',
                                'extra_atr' => '',
                                'cust_id' => '',
                                'cust_name' => 'clients_num[]',
                                'return' => true,
                                'required' => false
                            );
                            echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                            ?>
                        </div>
                        <div class="wrapptabbox no-padding-lr">
                            <div class="opt-conts">
                                <ul class="form-elements noborder">

                                    <li class="to-field"> <a href="#" class="add_servicesss cs-main-btn" onclick="jobcareer_shortcode_element_ajax_call('clients', 'shortcode-item-<?php echo jobcareer_special_char($cs_counter); ?>', '<?php echo jobcareer_special_char(admin_url('admin-ajax.php')); ?>')"><i class="icon-plus-circle"></i><?php esc_html_e('Add Client', 'jobcareer'); ?></a> </li>

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
                                    'std' => 'clients',
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
        <script>

           jQuery(document).ready(function ($) {
	                chosen_selectionbox();
					popup_over();
				 });
           
             
        </script>
        <?php
        if ($die <> 1) {
            die();
        }
    }

    add_action('wp_ajax_jobcareer_pb_clients', 'jobcareer_pb_clients');
}
?>