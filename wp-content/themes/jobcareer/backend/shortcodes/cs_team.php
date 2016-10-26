<?php
/*
 *
 * @Shortcode Name : Teams
 * @retrun
 *
 */
if (!function_exists('jobcareer_pb_teams')) {

    function jobcareer_pb_teams($die = 0) {
        global $jobcareer_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;
        ;
        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $counter = $_POST['counter'];
        if (isset($_POST['action']) && !isset($_POST['shortcode_element_id'])) {
            $POSTID = '';
            $shortcode_element_id = '';
            $cs_counter = $_POST['counter'];
        } else {
            $POSTID = $_POST['POSTID'];
            $cs_counter = $_POST['counter'];
            $PREFIX = CS_SC_TEAM;
            $shortcode_element_id = $_POST['shortcode_element_id'];
            $shortcode_str = stripslashes($shortcode_element_id);
            $parseObject = new ShortcodeParse();
            $output = $parseObject->cs_shortcodes($output, $shortcode_str, true, $PREFIX);
        }
        $defaults = array('cs_team_section_title' => '', 'cs_team_name' => '', 'cs_team_designation' => '', 'cs_team_title' => '', 'cs_team_profile_image' => '', 'cs_team_fb_url' => '', 'cs_team_twitter_url' => '', 'cs_team_googleplus_url' => '', 'cs_team_skype_url' => '', 'cs_team_email' => '', 'teams_class' => '', 'teams_animation' => '');

        if (isset($output['0']['atts'])) {
            $atts = $output['0']['atts'];
        } else {
            $atts = array();
        }

        if (isset($output['0']['content'])) {
            $cs_team_description = $output['0']['content'];
        } else {
            $cs_team_description = "";
        }

        $teams_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_teams';
        $coloumn_class = 'column_' . $teams_element_size;
        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }
        $rand_counter = rand(888, 9999999);
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="teams" data="<?php echo jobcareer_element_size_data_array_index($teams_element_size) ?>">
            <?php jobcareer_element_setting($name, $cs_counter, $teams_element_size, '', 'newspaper-o'); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter); ?>" data-shortcode-template="[<?php echo esc_attr(CS_SC_TEAM); ?> {{attributes}}]{{content}}[/<?php echo esc_attr(CS_SC_TEAM); ?>]"  style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('EDIT TEAM OPTIONS', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_attr($name . $cs_counter); ?>','<?php echo esc_attr($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-pbwp-content">
                    <div class="cs-wrapp-clone cs-shortcode-wrapp">
                        <?php
                        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                            jobcareer_shortcode_element_size();
                        }
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Name', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter team member name here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_team_name),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_team_name[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>


                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Designation', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Enter team member designation here.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_team_designation),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_team_designation[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'std' => $cs_team_profile_image,
                            'id' => 'team_profile_image',
                            'name' => esc_html__('Team Profile Image', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => '',
                            'echo' => true,
                            'array' => true,
                            'field_params' => array(
                                'std' => $cs_team_profile_image,
                                'cust_id' => '',
                                'id' => 'team_profile_image',
                                'return' => true,
                                'array' => true,
                                'array_txt' => false,
                            ),
                        );

                        $jobcareer_html_fields->cs_upload_file_field($cs_opt_array);
                        ?>
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Facebook', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Insert facebook profile URL of member.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_team_fb_url),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_team_fb_url[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Twitter URL', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Insert twitter profile URL of member.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_team_twitter_url),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_team_twitter_url[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>

                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Linkedin', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Insert linkedin profile URL of member.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => esc_attr($cs_team_skype_url),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_team_skype_url[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>
                        <?php
                        $cs_opt_array = array(
                            'name' => esc_html__('Email', 'jobcareer'),
                            'desc' => '',
                            'hint_text' => esc_html__("Add member email for any one can contact.", 'jobcareer'),
                            'echo' => true,
                            'field_params' => array(
                                'std' => sanitize_email($cs_team_email),
                                'cust_id' => '',
                                'classes' => '',
                                'cust_name' => 'cs_team_email[]',
                                'return' => true,
                            ),
                        );
                        $jobcareer_html_fields->cs_text_field($cs_opt_array);
                        ?>


                    </div>
                    <div class="wrapptabbox no-padding-lr">
                        <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                            <ul class="form-elements insert-bg">
                                <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', '<?php echo esc_js($name . $cs_counter) ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                            </ul>
                            <div id="results-shortocde"></div>
                        <?php } else { ?>

                            <?php
                            $cs_opt_array = array(
                                'std' => 'teams',
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
                 * popup over 
                 */
                popup_over();
                /*
                 *End popup over 
                 */
            </script>
            <?php
            if ($die <> 1) {
                die();
            }
        }

        add_action('wp_ajax_jobcareer_pb_teams', 'jobcareer_pb_teams');
    }
    ?>