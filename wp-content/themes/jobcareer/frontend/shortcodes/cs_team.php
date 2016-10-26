<?php

/*
 *
 * @Shortcode Name : Teams
 * @retrun
 *
 */
if (!function_exists('jobcareer_teams_shortcode')) {

    function jobcareer_teams_shortcode($atts, $content = "") {
        global $post;

        $defaults = array('column_size' => '1/1', 'cs_team_section_title' => '', 'cs_team_name' => '', 'cs_team_designation' => '', 'cs_team_title' => '', 'cs_team_profile_image' => '', 'cs_team_fb_url' => '', 'cs_team_twitter_url' => '', 'cs_team_googleplus_url' => '', 'cs_team_skype_url' => '', 'cs_team_email' => '');
        extract(shortcode_atts($defaults, $atts));

        $column_class = jobcareer_custom_column_class($column_size);
        $html = '';
        $html .= '<div class="cs-team cs-teamgrid ">';
        $html .= '<article class="col-md-3">';
        $html .= '<div class="cs-wrapteam">';


        $html .= '<div class="cs-text">';
        $cs_team_name = isset($cs_team_name) ? $cs_team_name : '';
        $cs_team_designation = isset($cs_team_designation) ? $cs_team_designation : '';
        $cs_team_profile_image = isset($cs_team_profile_image) ? $cs_team_profile_image : '';

        if (isset($cs_team_designation) && $cs_team_designation != '') {
            $html .= '<span>' . $cs_team_designation . '</span>';
        }

        $html = '';
        $html .='<div class="cs-team">';
        $html .='<figure><img src="' . esc_url($cs_team_profile_image) . '"  alt="' . jobcareer_get_post_img_title($post->ID) . '"></figure>';
        $html .='<div class="team-info">';
        $html .='<h5>' . $cs_team_name . '</h5>';
        $html .='<span>' . $cs_team_designation . '</span>';
        $html .='<div class="team-social-info">';
        $html .='<ul>';

        if ($cs_team_fb_url || $cs_team_twitter_url || $cs_team_googleplus_url || $cs_team_skype_url || $cs_team_email) {

            if (isset($cs_team_fb_url) && $cs_team_fb_url != '') {
                $html .='<li><a href="' . esc_url($cs_team_fb_url) . '" target="_blank"><i class="icon-facebook8 facebook"></i></a></li>';
            }

            if (isset($cs_team_twitter_url) && $cs_team_twitter_url != '') {

                $html .='<li><a href="' . esc_url($cs_team_twitter_url) . '" target="_blank"><i class="icon-twitter7 twitter"></i></a></li>';
            }

            if (isset($cs_team_skype_url) && $cs_team_skype_url != '') {

                $html .='<li><a href="' . esc_url($cs_team_skype_url) . '" target="_blank"><i class="icon-linkedin5 linkedin"></i></a></li>';
            }
        }
        $html .='</ul>';
        $html .='<div class="team-send-email">';
        if (isset($cs_team_email) && $cs_team_email != '' && is_email($cs_team_email)) {

            $html .='<a href="mailto:' . sanitize_email($cs_team_email) . '" target="_blank"><i class="icon-envelope-o"></i> '.esc_html__('Send Email','jobcareer').'</a>';
        }
        $html .='</div>';
        $html .='</div>';
        $html .='</div>';
        $html .='</div>';


        if (isset($section_title)) {
            return $section_title . ' ' . $html;
        } else {
            return $html;
        }
    }

    if (function_exists('cs_short_code'))
        cs_short_code(CS_SC_TEAM, 'jobcareer_teams_shortcode');
}