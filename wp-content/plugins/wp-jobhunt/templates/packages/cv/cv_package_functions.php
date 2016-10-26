<?php

/*
 *
 * @Shortcode Name : CV Package
 * @retrun
 *
 * Start Function how to Crea shortcode of CV Packages
 *
 */
if (!function_exists('cs_cv_package_shortcode')) {

    function cs_cv_package_shortcode($atts) {
        global $post, $current_user, $cs_form_fields2;
        $defaults = array(
            'cv_package_title' => '',
            'cv_pkges' => '',
        );
        extract(shortcode_atts($defaults, $atts));
        $cs_html = '';
        $cs_plugin_options = get_option('cs_plugin_options');
        if (class_exists('cs_employer_functions')) {
            $cs_emp_funs = new cs_employer_functions();
        }
        $cv_pkges = explode(',', $cv_pkges);
        if ($cv_package_title != '') {
            $cs_html .= '<div class="cs-section-title"><h2>' . $cv_package_title . '</h2></div>';
        }
        $currency_sign = isset($cs_plugin_options['cs_currency_sign']) ? $cs_plugin_options['cs_currency_sign'] : '$';
        $cs_emp_dashboard = isset($cs_plugin_options['cs_emp_dashboard']) ? $cs_plugin_options['cs_emp_dashboard'] : '';
        $cs_cv_pkgs_options = isset($cs_plugin_options['cs_cv_pkgs_options']) ? $cs_plugin_options['cs_cv_pkgs_options'] : '';
        $cs_pkg_subs = $cs_emp_funs->is_cv_pkg_subs();
        if (is_user_logged_in() && !$cs_emp_funs->is_employer()) {
            $cs_html .= '<div id="cs-not-emp" class="alert alert-warning" style="display:none;">' . __('Become an Employer first to Subscribe the Package.', 'jobhunt') . '<a href="#" class="close" data-dismiss="alert">&times;</a></div>';
        }
        $rand_id = rand(0, 9999999);
        $cs_html .= '<div class="price-packege" id="cs-cv-form' . $rand_id . '" data-ajaxurl="' . esc_url(admin_url('admin-ajax.php')) . '">
                        <div class="row">';
        if (is_array($cs_cv_pkgs_options) && sizeof($cs_cv_pkgs_options) > 0) {
            $cs_pkg_counter = 0;
            foreach ($cs_cv_pkgs_options as $cv_pkg_key => $cv_pkg) {
                if (isset($cv_pkg_key) && $cv_pkg_key <> '' && in_array($cv_pkg_key, $cv_pkges)) {
                    $cs_rand_id = rand(53445, 65765);
                    $cv_pkg_id = isset($cv_pkg['cv_pkg_id']) ? $cv_pkg['cv_pkg_id'] : '';
                    $cv_pkg_title = isset($cv_pkg['cv_pkg_title']) ? $cv_pkg['cv_pkg_title'] : '';
                    $cv_pkg_price = isset($cv_pkg['cv_pkg_price']) ? $cv_pkg['cv_pkg_price'] : '';
                    $cv_pkg_cvs = isset($cv_pkg['cv_pkg_cvs']) ? $cv_pkg['cv_pkg_cvs'] : '';
                    $cv_pkg_dur = isset($cv_pkg['cv_pkg_dur']) ? $cv_pkg['cv_pkg_dur'] : '';
                    $cv_pkg_dur_period = isset($cv_pkg['cv_pkg_dur_period']) ? $cv_pkg['cv_pkg_dur_period'] : '';
                    $cv_pkg_desc = isset($cv_pkg['cv_pkg_desc']) ? $cv_pkg['cv_pkg_desc'] : '';
                    $cs_pkg_chkd = '';
                    if ($cs_pkg_counter == 0) {
                        $cs_pkg_chkd = ' checked="checked"';
                    }
                    $cs_pckg_price = $cv_pkg_price;
                    if (is_user_logged_in() && $cs_emp_funs->cs_is_pkg_subscribed($cv_pkg_id)) {
                        $cs_pckg_price = 0;
                    }
                    $cs_html .= '<article class="col-md-4">
                                    <div class="price-holder">
					<div class="detail">
                                            <h4>' . CS_FUNCTIONS()->cs_special_chars($cv_pkg_title) . '</h4>
                                                <span class="cs-cv-price"><strong><sup>' . esc_attr($currency_sign) . '</sup>' . CS_FUNCTIONS()->cs_num_format($cv_pkg_price) . '</strong> ' . __('only', 'jobhunt') . '</span>';

                    if ($cv_pkg_desc != '') {
                        $cs_html .= '<p>' . CS_FUNCTIONS()->cs_special_chars($cv_pkg_desc) . '</p>';
                    }
                    $cs_html .='<span><i class="icon-check-circle"></i>' . sprintf(__('Access to %s Resumes', 'jobhunt'), absint($cv_pkg_cvs)) . '</span>
                                                    <span><i class="icon-check-circle"></i>' . sprintf(__('%s %s', 'jobhunt'), $cv_pkg_dur, $cv_pkg_dur_period) . __(' duration', 'jobhunt') . ' </span>';
                    $cs_html .= '</div>
                                    <div class="buy-now">
                                        ';


                    $user_role = cs_get_loginuser_role();
                    if (!is_user_logged_in()) {
                        $cs_html .= '<a class="cs-bgcolor acc-submit" onclick="trigger_func(\'#btn-header-main-login\');">' . __('Buy Now', 'jobhunt') . '</a>';
                    } else if (is_user_logged_in() && !((isset($user_role) && $user_role <> '' && $user_role == 'cs_employer') )) {

                        $cs_html .= '<a id="cs_emp_check_' . absint($cs_rand_id) . '" class="cs-bgcolor acc-submit">' . __('Buy Now', 'jobhunt') . '</a>';
                    } else {
                        $cs_html .= '
						<form method="post" action="' . get_permalink($cs_emp_dashboard) . '?profile_tab=packages">
							<input class="cs-bgcolor slct-cv-pkg" type="submit" value="' . __('Buy Now', 'jobhunt') . '">
							<input type="radio" name="cs_packge" value="' . absint($cv_pkg_id) . '" style="display:none; position:absolute;" />
							<input type="hidden" name="cs_pkg_transaction" value="1">
						</form>';
                    }
                    $cs_html .= '</div>
				</div>
				</article>';
                }
                $cs_pkg_counter++;
            }
        }
        $cs_html .= '</div>
		</div>';
        return do_shortcode($cs_html);
    }

    add_shortcode('cs_cv_package', 'cs_cv_package_shortcode');
}
