<?php
/*
 *
 * @Shortcode Name : Price Table
 * @retrun
 *
 */

if (!function_exists('jobcareer_pb_pricetable')) {

    function jobcareer_pb_pricetable($die = 0) {
        global $jobcareer_node, $count_node, $post, $jobcareer_html_fields, $jobcareer_form_fields;

        $shortcode_element = '';
        $filter_element = 'filterdrag';
        $shortcode_view = '';
        $output = array();
        $cs_counter = $_POST['counter'];
        $PREFIX = CS_SC_PRICETABLE . '|' . CS_SC_PRICETABLEITEM;
        $parseObject = new ShortcodeParse();
        $price_num = 0;
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
            'column_size' => '1/1',
            'pricetable_style' => '',
            'cs_pricetable_section_title' => '',
            'pricetable_title' => '',
            'pricetable_title_bgcolor' => '',
            'pricetable_price' => '',
            'currency_symbols' => '$',
            'pricetable_img' => '',
            'pricetable_period' => '',
            'pricetable_bgcolor' => '',
            'btn_text' => 'Buy Now',
            'btn_link' => '',
            'btn_bg_color' => '',
            'pricetable_featured' => '',
            'pricetable_class' => ''
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
            $price_num = count($atts_content);
        }
        $pricetable_element_size = '25';
        foreach ($defaults as $key => $values) {
            if (isset($atts[$key])) {
                $$key = $atts[$key];
            } else {
                $$key = $values;
            }
        }
        $name = 'jobcareer_pb_pricetable';
        $coloumn_class = 'column_' . $pricetable_element_size;

        if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
            $shortcode_element = 'shortcode_element_class';
            $shortcode_view = 'cs-pbwp-shortcode';
            $filter_element = 'ajax-drag';
            $coloumn_class = '';
        }

        $cs_counter = $cs_counter . rand(11, 555);
        ?>
        <div id="<?php echo esc_attr($name . $cs_counter) ?>_del" class="column  parentdelete <?php echo esc_attr($coloumn_class); ?> <?php echo esc_attr($shortcode_view); ?>" item="pricetable" data="<?php echo jobcareer_element_size_data_array_index($pricetable_element_size) ?>" >
            <?php jobcareer_element_setting($name, $cs_counter, $pricetable_element_size, '', 'th'); ?>
            <div class="cs-wrapp-class-<?php echo esc_attr($cs_counter) ?> <?php echo esc_attr($shortcode_element); ?>" id="<?php echo esc_attr($name . $cs_counter) ?>" style="display: none;">
                <div class="cs-heading-area">
                    <h5><?php esc_html_e('Edit Price Table Options', 'jobcareer'); ?></h5>
                    <a href="javascript:removeoverlay('<?php echo esc_attr($name . $cs_counter) ?>','<?php echo esc_attr($filter_element); ?>')" class="cs-btnclose"><i class="icon-times"></i></a> </div>
                <div class="cs-clone-append cs-pbwp-content">
                    <div class="cs-wrapp-tab-box">
                        <div  id="cs-shortcode-wrapp_<?php echo esc_attr($name . $cs_counter) ?>">
                            <div id="shortcode-item-<?php echo esc_attr($cs_counter); ?>" data-shortcode-template="{{child_shortcode}} [/<?php echo esc_attr(CS_SC_PRICETABLE); ?>]" data-shortcode-child-template="[<?php echo esc_attr(CS_SC_PRICETABLEITEM); ?> {{attributes}}] {{content}} [/<?php echo esc_attr(CS_SC_PRICETABLEITEM); ?>]">
                                <div class="cs-wrapp-clone cs-shortcode-wrapp cs-disable-true" data-template="[<?php echo esc_attr(CS_SC_PRICETABLE); ?> {{attributes}}]">
                                    <?php
                                    if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') {
                                        jobcareer_shortcode_element_size();
                                    }
                                    $cs_opt_array = array(
                                        'name' => esc_html__('Title', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => esc_html__('set title for the item', 'jobcareer'),
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html($pricetable_title),
                                            'id' => 'pricetable_title',
                                            'cust_name' => 'pricetable_title[]',
                                            'classes' => 'input-medium',
                                            'return' => true,
                                        ),
                                    );
                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                    $cs_opt_array = array(
                                        'name' => esc_html__('Price', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => esc_html__('item Price', 'jobcareer'),
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html($pricetable_price),
                                            'id' => 'pricetable_price',
                                            'cust_name' => 'pricetable_price[]',
                                            'classes' => 'input-medium',
                                            'return' => true,
                                        ),
                                    );
                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                    $cs_opt_array = array(
                                        'name' => esc_html__('Currency Symbols', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => esc_html__('Item currency symbols', 'jobcareer'),
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html($currency_symbols),
                                            'id' => 'currency_symbols',
                                            'cust_name' => 'currency_symbols[]',
                                            'classes' => 'input-medium',
                                            'return' => true,
                                        ),
                                    );
                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);


                                    $cs_opt_array = array(
                                        'name' => esc_html__('Time Duration', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => esc_html__('Set a time duration', 'jobcareer'),
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html($pricetable_period),
                                            'id' => 'pricetable_period',
                                            'cust_name' => 'pricetable_period[]',
                                            'classes' => 'input-medium',
                                            'return' => true,
                                        ),
                                    );
                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                    $cs_opt_array = array(
                                        'name' => esc_html__('Table Column Color', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => esc_html__('Provide a hex colour code here (with #) if you want to override the default', 'jobcareer'),
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html($pricetable_bgcolor),
                                            'id' => 'pricetable_bgcolor',
                                            'cust_name' => 'pricetable_bgcolor[]',
                                            'classes' => 'bg_color',
                                            'return' => true,
                                        ),
                                    );
                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                    $cs_opt_array = array(
                                        'name' => esc_html__('Button Text', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => '',
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html($btn_text),
                                            'id' => 'btn_text',
                                            'cust_name' => 'btn_text[]',
                                            'classes' => '',
                                            'return' => true,
                                        ),
                                    );
                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);

                                    $cs_opt_array = array(
                                        'name' => esc_html__('Background Color', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => '',
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_html($btn_bg_color),
                                            'id' => 'btn_bg_color',
                                            'cust_name' => 'btn_bg_color[]',
                                            'classes' => 'bg_color',
                                            'return' => true,
                                        ),
                                    );
                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);


                                    $cs_opt_array = array(
                                        'name' => esc_html__('Button Link', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => '',
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_url($btn_link),
                                            'id' => 'btn_link',
                                            'cust_name' => 'btn_link[]',
                                            'classes' => '',
                                            'return' => true,
                                        ),
                                    );
                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);



                                    $cs_opt_array = array(
                                        'name' => esc_html__('Featured', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => '',
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => $pricetable_featured,
                                            'id' => '',
                                            'cust_name' => 'pricetable_featured[]',
                                            'classes' => 'dropdown chosen-select-no-single',
                                            'options' => array(
                                                'Yes' => esc_html__('Yes', 'jobcareer'),
                                                'No' => esc_html__('NO', 'jobcareer'),
                                            ),
                                            'return' => true,
                                        ),
                                    );

                                    $jobcareer_html_fields->cs_select_field($cs_opt_array);

                                    $cs_opt_array = array(
                                        'name' => esc_html__('Custom Id', 'jobcareer'),
                                        'desc' => '',
                                        'hint_text' => esc_html__('Use this option if you want to use specified id for this element', 'jobcareer'),
                                        'echo' => true,
                                        'field_params' => array(
                                            'std' => esc_url($pricetable_class),
                                            'id' => 'pricetable_class',
                                            'cust_name' => 'pricetable_class[]',
                                            'classes' => '',
                                            'return' => true,
                                        ),
                                    );
                                    $jobcareer_html_fields->cs_text_field($cs_opt_array);
                                    ?>

                                    <ul class="form-elements">
                                        <li class="to-label">
                                            <label><?php esc_html_e('Pricing Features', 'jobcareer'); ?></label>
                                        </li>
                                        <li class="to-field"> <a class="add_field_button" href="#"  onclick="javascript:cs_add_field('cs-shortcode-wrapp_<?php echo esc_js($name . $cs_counter); ?>', 'cs_infobox')"><?php esc_html_e('Add New Feature input box', 'jobcareer'); ?> <i class="icon-plus-circle cs-plus-icon"></i></a>                                           <div class='left-info'>
                                                <div class='left-info'><p><?php esc_html_e('Set feature price of the product', 'jobcareer'); ?></p></div>
                                            </div>

                                        </li>
                                    </ul>
                                </div>
                                <!--Items-->
                                <div class="input_fields_wrap">
                                    <?php
                                    if (isset($price_num) && $price_num <> '' && isset($atts_content) && is_array($atts_content)) {
                                        $itemCounter = 0;
                                        foreach ($atts_content as $pricing) {
                                            $rand_id = $cs_counter . '' . jobcareer_generate_random_string(3);
                                            $itemCounter++;
                                            $pricing_text = $pricing['content'];
                                            $defaults = array('pricing_feature' => '');
                                            foreach ($defaults as $key => $values) {
                                                if (isset($pricing['atts'][$key])) {
                                                    $$key = $pricing['atts'][$key];
                                                } else {
                                                    $$key = $values;
                                                }
                                            }
                                            ?>
                                            <div class='cs-wrapp-clone cs-shortcode-wrapp cs-pbwp-content'  id="cs_infobox_<?php echo esc_attr($rand_id); ?>">
                                                <div class="cs-wrapp-clone cs-shortcode-wrapp">
                                                    <div id="<?php echo 'priceTable_' . esc_attr($rand_id); ?>">
                                                        <ul class="form-elements bcevent_title">
                                                            <li class="to-label">
                                                                <label><?php esc_html_e('Pricing Feature', 'jobcareer'); ?><?php echo esc_attr($itemCounter); ?></label>
                                                            </li>
                                                            <li class="to-field">
                                                                <div class="input-sec">
                                                                    <?php
                                                                    global $jobcareer_form_fields;
                                                                    $cs_opt_array = array(
                                                                        'std' => esc_attr($pricing_feature),
                                                                        'id' => '',
                                                                        'classes' => 'txtfield',
                                                                        'extra_atr' => '',
                                                                        'cust_id' => '',
                                                                        'cust_name' => 'pricing_feature[]',
                                                                        'return' => true,
                                                                        'required' => false
                                                                    );
                                                                    echo jobcareer_special_char($jobcareer_form_fields->cs_form_text_render($cs_opt_array));
                                                                    $cs_opt_array = array(
                                                                        'std' => esc_attr($pricing_feature),
                                                                        'id' => '',
                                                                        'classes' => 'txtfield',
                                                                        'extra_atr' => '',
                                                                        'cust_id' => '',
                                                                        'cust_name' => 'pricing_feature[]',
                                                                        'return' => true,
                                                                        'required' => false
                                                                    );
                                                                    echo jobcareer_special_char($jobcareer_form_fields->cs_form_textarea_render($cs_opt_array));
                                                                    ?>
                                                                </div>
                                                                <div id="price_remove">
                                                                    <a class="remove_field" onclick="javascript:cs_remove_field('cs_infobox_<?php echo esc_js($rand_id); ?>', 'cs-shortcode-wrapp_<?php echo esc_js($name . $cs_counter); ?>')"><i class="icon-minus-circle cs-minus-icon" ></i></a></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <!--Items--> 
                            </div>
                            <div class="hidden-object">
                                <?php
                                $cs_opt_array = array(
                                    'std' => (int) $price_num,
                                    'id' => '',
                                    'before' => '',
                                    'after' => '',
                                    'classes' => 'counter_num',
                                    'extra_atr' => '',
                                    'cust_id' => '',
                                    'cust_name' => 'price_num[]',
                                    'return' => true,
                                    'required' => false
                                );
                                echo jobcareer_special_char($jobcareer_form_fields->cs_form_hidden_render($cs_opt_array));
                                ?>
                            </div>
                            <div class="wrapptabbox">
                                <div class="opt-conts">
                                    <?php if (isset($_POST['shortcode_element']) && $_POST['shortcode_element'] == 'shortcode') { ?>
                                        <ul class="form-elements insert-bg">
                                            <li class="to-field"> <a class="insert-btn cs-main-btn" onclick="javascript:Shortcode_tab_insert_editor('<?php echo esc_js(str_replace('jobcareer_pb_', '', $name)); ?>', 'shortcode-item-<?php echo esc_js($cs_counter); ?>', '<?php echo esc_js($filter_element); ?>')" ><?php esc_html_e('Insert', 'jobcareer'); ?></a> </li>
                                        </ul>
                                        <div id="results-shortocde"></div>
                                    <?php } else { ?>
                                        <?php
                                        $cs_opt_array = array(
                                            'std' => 'pricetable',
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

    add_action('wp_ajax_jobcareer_pb_pricetable', 'jobcareer_pb_pricetable');
}
?>