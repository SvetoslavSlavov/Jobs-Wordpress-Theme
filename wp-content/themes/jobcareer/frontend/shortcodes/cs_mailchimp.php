<?php

// Start function for Mailchimp shortcode/element front end view

if (!function_exists('jobcareer_mailchimp_shortcode')) {

    function jobcareer_mailchimp_shortcode($atts, $content = "") {

        $defaults = array(
            'column_size' => '1/1',
            'mailchimp_title' => '',
            'color_title' => '',
            'mailchimp_color' => '#000',
            'class' => 'cs-mailchimp-shortcode',
            'mailchimp_style' => '',
            'mailchimp_size' => '',
            'font_weight' => '',
            'sub_mailchimp_title' => '',
            'mailchimp_font_style' => '',
            'mailchimp_align' => 'center',
            'mailchimp_divider' => '',
            'mailchimp_color' => '',
            'mailchimp_content_color' => ''
        );

        extract(shortcode_atts($defaults, $atts));
        $column_class = jobcareer_custom_column_class($column_size);
        $html = "";
        ?>
        <div class="widget widget-newsletter">
            <div class="widget-title"><h5><?php echo esc_html($mailchimp_title); ?></h5></div>	
            <div class="fieldset">   
                <?php echo '<p>' . do_shortcode($content) . '</p>'; ?>
                <?php cs_custom_mailchimp(); ?>	
            </div>
        </div>
        <?php
        $html = ob_get_clean();
        return $html;
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_MAILCHIMP, 'jobcareer_mailchimp_shortcode');
    }
}

 