<?php
$var_arrays = array('cs_page_option');
$cs_options_array_global_vars = CS_JOBCAREER_GLOBALS()->globalizing($var_arrays);
extract($cs_options_array_global_vars);

jobcareer_include_file(ABSPATH . '/wp-admin/includes/file.php');

// Home Demo
$home_demo = jobcareer_get_demo_content('home.json');

$cs_page_option[] = array();
$cs_page_option['theme_options'] = array(
    'select' => array(
        'home' => esc_html__('Home', 'jobcareer'),
    ),
    'home' => array(
        'name' => esc_html__('Home', 'jobcareer'),
        'page_slug' => 'home',
        'theme_option' => $home_demo,
        'thumb' => 'Import-Dummy-Data-Jobs'
    ),
);
