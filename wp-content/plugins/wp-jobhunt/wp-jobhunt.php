<?php

/*
  Plugin Name: WP Job Hunt
  Plugin URI: http://themeforest.net/user/Chimpstudio/
  Description: Job Hunt
  Version: 1.0
  Author: ChimpStudio
  Author URI: http://themeforest.net/user/Chimpstudio/
  License: GPL2
  Copyright 2015  chimpgroup  (email : info@chimpstudio.co.uk)
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, United Kingdom
 */
if (!class_exists('wp_jobhunt')) {

    class wp_jobhunt {

        public $plugin_url;
        public $plugin_dir;

        // public $plugin_user_images_directory;

        /**
         * Start Function of Construct
         */
        public function __construct() {
            add_action('init', array($this, 'load_plugin_textdomain'));

            remove_filter('pre_user_description', 'wp_filter_kses');
            add_filter('pre_user_description', 'wp_filter_post_kses');

            $this->define_constants();
            $this->includes();
        }

        /**
         * Start Function how to Create WC Contants
         */
        private function define_constants() {

            global $post, $wp_query, $cs_plugin_options, $current_user, $cs_jh_scodes, $plugin_user_images_directory;
            $cs_plugin_options = get_option('cs_plugin_options');
            $this->plugin_url = plugin_dir_url(__FILE__);
            $this->plugin_dir = plugin_dir_path(__FILE__);
            $plugin_user_images_directory = 'wp-jobhunt-users';
        }

        /**
         * End Function how to Create WC Contants
         */

        /**
         * Start Function how to add core files used in admin and theme
         */
        public function includes() {
            require_once 'admin/classes/class-save-post-options.php';
            require_once 'templates/elements/shortcode_functions.php';
            //require_once 'admin/include/form-fields/form-fields.php';
            require_once 'admin/include/form-fields/cs_form_fields.php';
            require_once 'admin/include/form-fields/cs_html_fields.php';
            require_once 'classes/class_transactions.php';
            require_once 'include/form-fields/form-fields-frontend.php';
            require_once 'include/form-fields/cs_html_fields_frontend.php';
            require_once 'helpers/notification-helper.php';
            require_once 'admin/settings/plugin_settings.php';
            require_once 'admin/settings/includes/plugin_options.php';    //class-save-post-options
            require_once 'admin/settings/includes/plugin_options_fields.php';
            require_once 'admin/settings/includes/plugin_options_functions.php';
            require_once 'admin/settings/includes/plugin_options_array.php';
            require_once 'admin/settings/user-import/cs_import.php';
            require_once 'admin/include/post-types/jobs/job_custom_fields.php';
            require_once 'admin/include/post-types/candidate/candidate_custom_fields.php';
            require_once 'admin/include/post-types/employer/employer_custom_fields.php';
            require_once 'classes/class_dashboards_templates.php';
            require_once 'templates/dashboards/candidate/templates_functions.php';
            require_once 'templates/dashboards/candidate/templates_ajax_functions.php';
            require_once 'templates/dashboards/employer/employer_functions.php';
            require_once 'templates/dashboards/employer/employer_templates.php';
            require_once 'templates/dashboards/employer/employer_ajax_templates.php';
            //require_once 'classes/class_candidate_dashboard.php';
            require_once 'payments/class-payments.php';
            require_once 'payments/config.php';
            require_once 'admin/include/post-types/jobs/jobs.php';
            // move at user meta
//            require_once 'admin/include/post-types/candidate/candidate.php';
//            require_once 'admin/include/post-types/candidate/candidate_meta.php';
//            require_once 'admin/include/post-types/employer/employer.php';
//            require_once 'admin/include/post-types/employer/employer_meta.php';
            require_once 'admin/include/post-types/transaction/transaction.php';
            require_once 'admin/include/post-types/transaction/transactions_meta.php';
            require_once 'admin/include/post-types/jobs/jobs_meta.php';
            // user meta
            require_once 'admin/include/user-meta/cs_meta.php';
            require_once 'widgets/widgets.php';
            // Cv Package Files
            require_once 'templates/packages/cv/cv_package_elements.php';
            require_once 'templates/packages/cv/cv_package_functions.php';
            // Job Package Files
            require_once 'templates/packages/jobs/job_package_elements.php';
            require_once 'templates/packages/jobs/job_package_functions.php';
            // Job Post Files
            require_once 'templates/elements/job-post/job-post-elements.php';
            require_once 'templates/elements/job-post/job-post-functions.php';
            // Job specialisms Files
            require_once 'templates/elements/specialisms/elements.php';
            require_once 'templates/elements/specialisms/functions.php';
            require_once 'templates/functions.php';
            // employer element   
            require_once 'templates/listings/employer/employer_element.php';
            // Job element   
            require_once 'templates/listings/jobs/jobs_element.php';
            // Job search
            require_once 'templates/elements/jobs-search/jobs-search-element.php';
            // Candidate  
            require_once 'templates/listings/candidate/candidate_element.php';
            // for employer listing
            require_once 'templates/listings/employer/employer_template.php';
            // for job sesker listing
            require_once 'templates/listings/candidate/candidate_template.php';
            // for jobs listing
            require_once 'templates/listings/jobs/jobs_template.php';
            require_once 'templates/elements/jobs-search/jobs-search-template.php';
            // for login
            require_once 'templates/elements/login/login_functions.php';
            require_once 'templates/elements/login/login_forms.php';
            require_once 'templates/elements/login/shortcodes.php';
            require_once 'templates/elements/login/cs-social-login/cs_social_login.php';
            require_once 'templates/elements/login/cs-social-login/google/cs_google_connect.php';
            // linkedin login
            // recaptchas
            require_once 'templates/elements/login/recaptcha/autoload.php';
            // Location Checker
            require_once 'classes/class_location_check.php';
            add_filter('template_include', array(&$this, 'cs_single_template'));
            add_action('wp_enqueue_scripts', array(&$this, 'cs_defaultfiles_plugin_enqueue'));
            add_action('admin_enqueue_scripts', array(&$this, 'cs_defaultfiles_plugin_enqueue'));

            add_action('admin_init', array($this, 'cs_all_scodes'));
            add_filter('body_class', array($this, 'cs_boby_class_names'));
        }

        /**
         * End Function how to add core files used in admin and theme
         */

        /**
         * Start Function how to add Specific CSS Classes by filter
         */
        function cs_boby_class_names($classes) {
            $classes[] = 'wp-jobhunt';
            return $classes;
        }

        /**
         * End Function how to add Specific CSS Classes by filter
         */

        /**
         * Start Function how to access admin panel
         */
        public function prevent_admin_access() {
            if (is_user_logged_in()) {
                if (strpos(strtolower($_SERVER['REQUEST_URI']), '/wp-admin') !== false && !current_user_can('administrator')) {
                    wp_redirect(get_option('siteurl'));
                    add_filter('show_admin_bar', '__return_false');
                }
            }
        }

        /**
         * End Function how to access admin panel
         */

        /**
         * Start Function how to Add textdomain for translation
         */
        public function load_plugin_textdomain() {
            $cs_plugin_options = get_option('cs_plugin_options');
            $languageFile = isset($cs_plugin_options['cs_language_file']) ? $cs_plugin_options['cs_language_file'] : '';
            $locale = apply_filters('plugin_locale', get_locale(), 'jobhunt');
            $dir = trailingslashit(WP_LANG_DIR);
            if (isset($languageFile) && $languageFile != '') {
                load_textdomain('jobhunt', plugin_dir_path(__FILE__) . "languages/" . $cs_plugin_options['cs_language_file']);
            } else {
                
            }
        }

        /**
         * Start Function how to Add User and custom Roles
         */
        public function cs_add_custom_role() {
            add_role('guest', 'Guest', array(
                'read' => true, // True allows that capability
                'edit_posts' => true,
                'delete_posts' => false, // Use false to explicitly deny
            ));
        }

        /**
         * End Function how to Add User and custom Roles
         */

        /**
         * Start Function how to Add plugin urls
         */
        public static function plugin_url() {
            return plugin_dir_url(__FILE__);
        }

        /**
         * End Function how to Add plugin urls
         */

        /**
         * Start Function how to Add image url for plugin directory
         */
        public static function plugin_img_url() {
            return plugin_dir_url(__FILE__);
        }

        /**
         * End Function how to Add image url for plugin directory
         */

        /**
         * Start Function how to Create plugin Directory
         */
        public static function plugin_dir() {
            return plugin_dir_path(__FILE__);
        }

        /**
         * End Function how to Create plugin Directory
         */

        /**
         * Start Function how to Activate the plugin
         */
        public static function activate() {
            global $plugin_user_images_directory;
            add_option('cs_jobhunt_plugin_activation', 'installed');
            add_option('cs_jobhunt', '1');
            // create user role for candidate and employer
            $result = add_role(
                    'cs_employer', __('Employer', 'jobdoor'), array(
                'read' => false,
                'edit_posts' => false,
                'delete_posts' => false,
                    )
            );
            $result = add_role(
                    'cs_candidate', __('Candidate', 'jobdoor'), array(
                'read' => false,
                'edit_posts' => false,
                'delete_posts' => false,
                    )
            );
            //echo "(". $plugin_user_images_directory.")";exit;
            // create users images directory 
            $upload = wp_upload_dir();
            $upload_dir = $upload['basedir'];
            $upload_dir = $upload_dir . '/' . $plugin_user_images_directory;
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777);
            }
        }

        /**
         * End Function how to Activate the plugin
         */

        /**
         * Start Function how to DeActivate the plugin
         */
        static function deactivate() {
            delete_option('cs_jobhunt_plugin_activation');
            delete_option('cs_jobhunt', false);
        }

        /**
         * End Function how to DeActivate the plugin
         */

        /**
         * Start Function how to Add Theme Templates
         */
        public function cs_single_template($single_template) {
            global $post;

            if (get_post_type() == 'candidate') {
                if (is_single()) {
                    $single_template = plugin_dir_path(__FILE__) . 'templates/single_pages/single-candidate.php';
                }
            }
            if (get_post_type() == 'employer') {
                if (is_single()) {
                    $single_template = plugin_dir_path(__FILE__) . 'templates/single_pages/single-employer.php';
                }
            }
            if (get_post_type() == 'jobs') {
                if (is_single()) {
                    $single_template = plugin_dir_path(__FILE__) . 'templates/single_pages/single-jobs.php';
                }
            }
            return $single_template;
        }

        /**
         * End Function how to Add Theme Templates
         */

        /**
         * Start Function how to Includes Default Scripts and Styles
         */
        public function cs_defaultfiles_plugin_enqueue() {
            global $cs_theme_options;
            if (is_admin()) {
                wp_enqueue_media();
            }
            if (!is_admin()) {
                wp_enqueue_style('cs_iconmoon_css', plugins_url('/assets/icomoon/css/iconmoon.css', __FILE__));
                wp_enqueue_style('cs_bootstrap_css', plugins_url('/assets/css/bootstrap.css', __FILE__));
                // temporary off 
                // wp_enqueue_style('cs_widget_css', plugins_url('/assets/css/widget.css', __FILE__));
                $cs_plugin_options = get_option('cs_plugin_options');
                $cs_default_css_option = isset($cs_plugin_options['cs_common-elements-style']) ? $cs_plugin_options['cs_common-elements-style'] : '';
                //Common css Elements
                if ($cs_default_css_option == 'on') {
                    wp_enqueue_style('cs_jobsline_plugin_defalut_elements_css', plugins_url('/assets/css/default-elements.css', __FILE__));
                }
                wp_enqueue_style('cs_jobsline_plugin_css', plugins_url('/assets/css/cs-jobsline-plugin.css', __FILE__));

                wp_enqueue_script('cs_waypoints_min_js', plugins_url('/assets/scripts/waypoints.min.js', __FILE__), '', '', true); //?
            }
            wp_enqueue_style('cs_slicknav_css', plugins_url('/assets/css/slicknav.css', __FILE__));
            wp_enqueue_style('cs_datetimepicker_css', plugins_url('/assets/css/jquery_datetimepicker.css', __FILE__));
            wp_enqueue_style('cs_bootstrap_slider_css', plugins_url('/assets/css/bootstrap-slider.css', __FILE__));
            wp_enqueue_script('cs_bootstrap_slider_js', plugins_url('/assets/scripts/bootstrap-slider.js', __FILE__), '', '', true);
            wp_enqueue_style('cs_chosen_css', plugins_url('/assets/css/chosen.css', __FILE__));

            // All JS files
            //wp_enqueue_script(array('jquery'));
            // temporary off 
            wp_enqueue_script('cs_google_autocomplete_script', cs_server_protocol() . 'maps.googleapis.com/maps/api/js?libraries=places&language=en', '', '', '');
            wp_enqueue_script('cs_bootstrap_min_js', plugins_url('/assets/scripts/bootstrap.min.js', __FILE__), array('jquery'), '', true);

            wp_enqueue_script('cs_my_upload_js', '', array('jquery', 'media-upload', 'thickbox', 'jquery-ui-droppable', 'jquery-ui-datepicker', 'jquery-ui-slider', 'wp-color-picker'));
            wp_enqueue_script('cs_chosen_jquery_js', plugins_url('/assets/scripts/chosen.jquery.js', __FILE__), '', '', true);
            wp_enqueue_script('cs_scripts_js', plugins_url('/assets/scripts/scripts.js', __FILE__), '', '', true);
            wp_enqueue_script('cs_isotope_min_js', plugins_url('/assets/scripts/isotope.min.js', __FILE__), '', '', true); //?
            wp_enqueue_script('cs_modernizr_min_js', plugins_url('/assets/scripts/modernizr.min.js', __FILE__), '', '', '');
            wp_enqueue_script('cs_browser_detect_js', plugins_url('/assets/scripts/browser-detect.js', __FILE__), '', '', '');
            wp_enqueue_script('cs_slick_js', plugins_url('/assets/scripts/slick.js', __FILE__), '', '', true);
            wp_enqueue_script('cs_jquery_sticky_js', plugins_url('/assets/scripts/jquery.sticky.js', __FILE__), '', '', true); //?
            wp_enqueue_script('cs_jobhunt_functions_js', plugins_url('/assets/scripts/jobhunt_functions.js', __FILE__), '', '', true);
            wp_enqueue_script('cs_exra_functions_js', plugins_url('/assets/scripts/extra_functions.js', __FILE__), '', '', true);
            if (!is_admin()) {
                wp_enqueue_script('cs_functions_js', plugins_url('/assets/scripts/functions.js', __FILE__), '', '', true);
            }
            wp_enqueue_script('cs_datetimepicker_js', plugins_url('/assets/scripts/jquery_datetimepicker.js', __FILE__), '', '', true);

            /**
             *
             * @login popup script files
             */
            if (!function_exists('cs_range_slider_scripts')) {

                function cs_range_slider_scripts() {
                    
                }

            }
            /**
             *
             * @login popup script files
             */
            if (!function_exists('cs_google_recaptcha_scripts')) {

                function cs_google_recaptcha_scripts() {
                    wp_enqueue_script('cs_google_recaptcha_scripts', 'https://www.google.com/recaptcha/api.js?onload=cs_multicap&amp;render=explicit', '', '');
                }

            }
            /**
             *
             * @login popup script files
             */
            if (!function_exists('cs_login_box_popup_scripts')) {

                function cs_login_box_popup_scripts() {
                    wp_enqueue_script('cs_uiMorphingButton_fixed_js', plugins_url('/assets/scripts/uiMorphingButton_fixed.js', __FILE__), '', '', true);
                }

            }
            /**
             *
             * @datetime calender script files
             */
            if (!function_exists('cs_datetime_picker_scripts')) {

                function cs_datetime_picker_scripts() {
                    
                }

            }
            /**
             *
             * @sidemenue effect script files
             */
            if (!function_exists('cs_visualnav_sidemenu')) {

                function cs_visualnav_sidemenu() {
                    wp_enqueue_script('cs_jquery_easing_js', plugins_url('/assets/scripts/jquery.easing.1.2.js', __FILE__), '', '', true);
                    wp_enqueue_script('cs_jquery_visualNav_js', plugins_url('/assets/scripts/jquery.visualNav.js', __FILE__), '', '', true);
                    wp_enqueue_script('cs_jquery_smint_js', plugins_url('/assets/scripts/jquery.smint.js', __FILE__), '', '', true); //?
                }

            }

            if (!function_exists('cs_enqueue_count_nos')) {

                function cs_enqueue_count_nos() {
                    wp_enqueue_script('cs_countTo_js', plugins_url('/assets/scripts/jquery.countTo.js'), '', '', true);
                    wp_enqueue_script('cs_inview_js', plugins_url('/assets/scripts/jquery.inview.min.js'), '', '', true);
                }

            }
            /**
             *
             * @Add this enqueue Script
             */
            if (!function_exists('cs_addthis_script_init_method')) {

                function cs_addthis_script_init_method() {
                    wp_enqueue_script('cs_addthis_js', cs_server_protocol() . 's7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e4412d954dccc64', '', '', true);
                }

            }
            /**
             *
             * @social login script
             */
            if (!function_exists('cs_socialconnect_scripts')) {

                function cs_socialconnect_scripts() {
                    wp_enqueue_script('cs_socialconnect_js', plugins_url('/templates/elements/login/cs-social-login/media/js/cs-connect.js', __FILE__), '', '', true);
                }

            }

            /**
             *
             * @google auto complete script
             */
            if (!function_exists('cs_google_autocomplete_scripts')) {

                function cs_google_autocomplete_scripts() {
                    wp_enqueue_script('cs_location_autocomplete_js', plugins_url('/assets/scripts/jquery.location-autocomplete.js', __FILE__), '', '');
                }

            }
            if (is_admin()) {
                // admin css files
                wp_enqueue_style('cs_admin_styles_css', plugins_url('/admin/assets/css/admin_style.css', __FILE__));
                wp_enqueue_style('cs_datatable_css', plugins_url('/admin/assets/css/datatable.css', __FILE__));
                wp_enqueue_style('cs_fonticonpicker_css', plugins_url('/assets/icomoon/css/jquery.fonticonpicker.min.css', __FILE__));
                wp_enqueue_style('cs_iconmoon_css', plugins_url('/assets/icomoon/css/iconmoon.css', __FILE__));
                wp_enqueue_style('cs_fonticonpicker_bootstrap_css', plugins_url('/assets/icomoon/theme/bootstrap-theme/jquery.fonticonpicker.bootstrap.css', __FILE__));
                wp_enqueue_style('cs_bootstrap_css', plugins_url('/admin/assets/css/bootstrap.css', __FILE__));
                // admin js files
                wp_enqueue_script('cs_datatable_js', plugins_url('/admin/assets/scripts/datatable.js', __FILE__), '', '', true);
                wp_enqueue_script('cs_chosen_jquery_js', plugins_url('/assets/scripts/chosen.jquery.js', __FILE__));
                wp_enqueue_script('cs_custom_wp_admin_script_js', plugins_url('/admin/assets/scripts/cs_functions.js', __FILE__),'', '', true);
                wp_enqueue_script('cs_jobsline_shortcodes_js', plugins_url('/admin/assets/scripts/shortcode_functions.js', __FILE__), '', '', true);
                wp_enqueue_script('fonticonpicker_js', plugins_url('/assets/icomoon/js/jquery.fonticonpicker.min.js', __FILE__));
                cs_datetime_picker_scripts();
            }
        }

        /**
         *
         * @Responsive Tabs Styles and Scripts
         */
        public static function cs_enqueue_tabs_script() {
            
        }

        /**
         *
         * @Data Table Style Scripts
         */

        /**
         * Start Function how to Add table Style Script
         */
        public static function cs_data_table_style_script() {
            wp_enqueue_script('cs_jquery_data_table_js', plugins_url('/assets/scripts/jquery.data_tables.js', __FILE__), '', '', true);
            wp_enqueue_style('cs_data_table_css', plugins_url('/assets/css/jquery.data_tables.css', __FILE__));
        }

        /**
         * End Function how to Add Tablit Style Script
         */
        public static function cs_jquery_ui_scripts() {
            
        }

        /**
         * Start Function how to Add Location Picker Scripts
         */
        public function cs_location_gmap_script() {
            wp_enqueue_script('cs_jquery_latlon_picker_js', plugins_url('/assets/scripts/jquery_latlon_picker.js', __FILE__), '', '', true);
        }

        /**
         * End Function how to Add Location Picker Scripts
         */

        /**
         * Start Function how to Add Google Place Scripts
         */
        public function cs_google_place_scripts() {
            wp_enqueue_script('cs_google_autocomplete_script', cs_server_protocol() . 'maps.google.com/maps/api/js?sensor=false&libraries=places', '', '', true);
        }

        // start function for google map files 
        public static function cs_googlemapcluster_scripts() {
            wp_enqueue_script('cs_google_autocomplete_script', cs_server_protocol() . 'maps.google.com/maps/api/js?sensor=false&libraries=places', '', '', true);
            wp_enqueue_script('jquery-googlemapcluster', cs_server_protocol() . 'google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js');
            wp_enqueue_script('cs_map_info_js', plugins_url('/assets/scripts/map_infobox.js', __FILE__), '', '', true);
        }

        /**
         * End Function how to Add Google Place Scripts
         */

        /**
         * Start Function how to Add Google Autocomplete Scripts
         */
        public function cs_autocomplete_scripts() {
            wp_enqueue_script('jquery-ui-autocomplete');
            wp_enqueue_script('jquery-ui-slider');
        }

        /**
         * End Function how to Add Google Autocomplete Scripts
         */
        // Start function for global code
        public function cs_all_scodes() {
            global $cs_jh_scodes;
        }

        // Start function for auto login user
        public function cs_auto_login_user() {
            
        }

    }

}
/*
  Default Sidebars On/OFF Check
 */
add_action('wp_loaded', 'callback_function');

function callback_function() {
    if (!is_admin()) {
        $cs_plugin_options = get_option('cs_plugin_options');
        $cs_default_sidebar_option = isset($cs_plugin_options['cs_default-sidebars']) ? $cs_plugin_options['cs_default-sidebars'] : '';
        if ($cs_default_sidebar_option == 'on') {
            global $wp_registered_sidebars;
            foreach ($wp_registered_sidebars as $sidebar_id) {
                $cs_unregister_id = isset($sidebar_id['id']) ? $sidebar_id['id'] : '';
                if ($cs_unregister_id != '') {
                    unregister_sidebar($sidebar_id['id']);
                }
            }
        }
    }
}

/*
  Custom Css */
/*
  function my_styles_method() {


  //get_template_directory_uri() . '/css/custom_script.css'
  $cs_plugin_options = get_option('cs_plugin_options');
  wp_enqueue_style('custom-style-inline', plugins_url('/assets/css/custom_script.css', __FILE__));
  $cs_custom_css=isset($cs_plugin_options['cs_style-custom-css']) ? $cs_plugin_options['cs_style-custom-css']:'sdfdsa';
  $custom_css = $cs_custom_css;
  wp_add_inline_style( 'custom-style-inline', $custom_css );
  }
  add_action( 'wp_enqueue_scripts', 'my_styles_method' );
 */
/**
 *
 * @Create Object of class To Activate Plugin
 */
if (class_exists('wp_jobhunt')) {
    $cs_jobhunt = new wp_jobhunt();
    register_activation_hook(__FILE__, array('wp_jobhunt', 'activate'));
    register_deactivation_hook(__FILE__, array('wp_jobhunt', 'deactivate'));
}
