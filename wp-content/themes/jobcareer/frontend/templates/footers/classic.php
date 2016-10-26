<?php
$jobcareer_options = CS_JOBCAREER_GLOBALS()->theme_options();
$cs_footer_back_to_top = isset($jobcareer_options['cs_footer_back_to_top']) ? $jobcareer_options['cs_footer_back_to_top'] : '';
$footer_background_color = isset($jobcareer_options['cs_copyright_bg_color']) ? $jobcareer_options['cs_copyright_bg_color'] : '';
$cs_sub_footer_menu = isset($jobcareer_options['cs_sub_footer_menu']) ? $jobcareer_options['cs_sub_footer_menu'] : '';
$cs_sub_footer_social_icons = isset($jobcareer_options['cs_sub_footer_social_icons']) ? $jobcareer_options['cs_sub_footer_social_icons'] : '';
$cs_copy_right = isset($jobcareer_options['cs_copy_right']) ? $jobcareer_options['cs_copy_right'] : '';
?> <div style="background-color:<?php echo esc_html($footer_background_color); ?>;" class="cs-copyright">
    <div class="container">
        <div class="cs-copyright-area">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

                    <?php
                    if (function_exists('jobcareer_footer_logo')) {
                        jobcareer_footer_logo();
                    }
                    ?>
                    <div class="footer-links">
                        <?php if ($cs_sub_footer_menu == 'on') { ?>
                            <div class="footer-nav">
                                <?php
                                if (function_exists('jobcareer_navigation')) {
                                    jobcareer_navigation('footer-menu', '', '', '');
                                }
                                ?>
                            </div>
                            <?php
                        }
                        $cs_allowed_tags = array(
                            'a' => array('href' => array(), 'class' => array()),
                            'b' => array(),
                            'i' => array('class' => array()),
                        );
                        if (isset($cs_copy_right) and $cs_copy_right <> '') {
                            echo wp_kses(htmlspecialchars_decode($cs_copy_right), $cs_allowed_tags);
                        } else {
                            echo ' <p class="copyrights">
                                    ' . gmdate("Y") . '' . esc_html__('Jobs Wordpress Theme All rights reserved. Design by', 'jobcareer') . '	<a href="#" target="_blank">' . get_option("blogname") . '</a>
                                    </p>';
                        }
                        ?>                                    
                    </div>
                    <?php
                    if (isset($cs_sub_footer_social_icons) && $cs_sub_footer_social_icons == 'on') {
                        echo "<ul class=''>";
                        if (function_exists('jobcareer_social_network_footer')) {
                            jobcareer_social_network_footer();
                        }
                        echo "</ul>";
                    }
                    ?>
                </div>
                <?php if (isset($cs_footer_back_to_top) && $cs_footer_back_to_top == 'on') { ?>
                    <div class="col-md-3">
                        <div class="back-to-top">
                            <a href="#" style="color:#fff;"><?php esc_html_e("Back to top", 'jobcareer'); ?><i class="icon-arrow-up7"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
