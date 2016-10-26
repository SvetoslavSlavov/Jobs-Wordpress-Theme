<?php

/**
 * @Twitter Tweets widget Class
 *
 *
 */
if (!class_exists('jobcareer_twitter_widget')) {

    class jobcareer_twitter_widget extends WP_Widget {

        /**
         * Twitter Module construct
         *
         *
         */
        public function __construct() {

            parent::__construct(
                    'jobcareer_twitter_widget', // Base ID
                    esc_html__('CS: Twitter Widget', 'jobcareer'), // Name
                    array('classname' => 'twitter-widget', 'description' => esc_html__('Twitter Widget.', 'jobcareer'),) // Args
            );
        }

        // Start function for backend twitter widget view

        function form($instance) {
            global $jobcareer_form_fields, $jobcareer_html_fields;
            $instance = wp_parse_args((array) $instance, array('title' => ''));
            $title = $instance['title'];
            $username = isset($instance['username']) ? esc_attr($instance['username']) : '';
            $numoftweets = isset($instance['numoftweets']) ? esc_attr($instance['numoftweets']) : '';

            $cs_opt_array = array(
                'name' => esc_html__('Title', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_html($title),
                    'id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('title')),
                    'cust_id' => jobcareer_special_char($this->get_field_name('title')),
                    'return' => true,
                ),
            );

            $jobcareer_html_fields->cs_text_field($cs_opt_array);
            $cs_opt_array = array(
                'name' => esc_html__('User Name', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_html($username),
                    'id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('username')),
                    'cust_id' => jobcareer_special_char($this->get_field_name('username')),
                    'return' => true,
                ),
            );

            $jobcareer_html_fields->cs_text_field($cs_opt_array);
            $cs_opt_array = array(
                'name' => esc_html__('Num of Tweets', 'jobcareer'),
                'desc' => '',
                'hint_text' => '',
                'echo' => true,
                'field_params' => array(
                    'std' => esc_html($numoftweets),
                    'id' => '',
                    'cust_name' => jobcareer_special_char($this->get_field_name('numoftweets')),
                    'cust_id' => jobcareer_special_char($this->get_field_name('numoftweets')),
                    'return' => true,
                ),
            );

            $jobcareer_html_fields->cs_text_field($cs_opt_array);
        }

        // Start function for update twitter data

        function update($new_instance, $old_instance) {

            $instance = $old_instance;
            $instance['title'] = $new_instance['title'];
            $instance['username'] = $new_instance['username'];
            $instance['numoftweets'] = $new_instance['numoftweets'];
            return $instance;
        }

        // Start function for view twitter data

//        function widget($args, $instance) {
//            global $jobcareer_options, $post;
//            extract($args, EXTR_SKIP);
//            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
//            $title = htmlspecialchars_decode(stripslashes($title));
//            $username = $instance['username'];
//            $numoftweets = $instance['numoftweets'];
//            if ($numoftweets == '') {
//                $numoftweets = 2;
//            }
//            echo '<div class="widget widget-twitter">';
//            if (!empty($title) && $title <> ' ') {
//                echo jobcareer_special_char($before_title) . $title . $after_title;
//            }
//
//            if (class_exists('wp_jobhunt')) {
//                if (strlen($username) > 1) {
//                    $text = '';
//                    $return = '';
//                    $cacheTime = 24;
//                    $transName = 'latest-tweets';
//                    jobcareer_include_file(cs_framework::plugin_dir() . 'include/cs-twitter/twitteroauth.php');
//                    $consumerkey = isset($jobcareer_options['cs_consumer_key']) ? $jobcareer_options['cs_consumer_key'] : '';
//                    $consumersecret = isset($jobcareer_options['cs_consumer_secret']) ? $jobcareer_options['cs_consumer_secret'] : '';
//                    $accesstoken = isset($jobcareer_options['cs_access_token']) ? $jobcareer_options['cs_access_token'] : '';
//                    $accesstokensecret = isset($jobcareer_options['cs_access_token_secret']) ? $jobcareer_options['cs_access_token_secret'] : '';
//                    $connection = new TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
//                    $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $username . "&count=" . $numoftweets);
//                    if (!is_wp_error($tweets) and is_array($tweets)) {
//                        set_transient($transName, $tweets, 60 * $cacheTime);
//                    } else {
//                        $tweets = get_transient('latest-tweets');
//                    }
//                    if (!is_wp_error($tweets) and is_array($tweets)) {
//                        $rand_id = rand(5, 300);
//                        $return .= "";
//                        foreach ($tweets as $tweet) {
//                            $user_screen_name = '';
//                            $text = $tweet->{'text'};
//                            if (isset($tweet->{'user'}) && is_array($tweet->{'user'})) {
//                                foreach ($tweet->{'user'} as $type => $userentity) {
//                                    if ($type == 'profile_image_url') {
//                                        $profile_image_url = $userentity;
//                                    } else if ($type == 'screen_name') {
//                                        $screen_name = '<a href="https://twitter.com/' . $userentity . '" target="_blank" class="colrhover" title="' . $userentity . '">@' . $userentity . '</a>';
//                                    }
//                                }
//                            }
//                            if (isset($tweet->{'entities'}) && is_array($tweet->{'entities'})) {
//                                foreach ($tweet->{'entities'} as $type => $entity) {
//                                    if ($type == 'urls') {
//                                        foreach ($entity as $j => $url) {
//                                            $url_href = isset($url->{'url'}) ? $url->{'url'} : '';
//                                            $url_expanded_url = isset($url->{'expanded_url'}) ? $url->{'expanded_url'} : '';
//                                            $url_display_url = isset($url->{'display_url'}) ? $url->{'display_url'} : '';
//
//                                            $display_url = '<a href="' . $url_href . '" target="_blank" title="' . $url_expanded_url . '">' . $url_display_url . '</a>';
//                                            $update_with = 'Read more at ' . $display_url;
//                                            $text = str_replace('Read more at ' . $url_href, '', $text);
//                                            $text = str_replace($url_href, '', $text);
//                                        }
//                                    } else if ($type == 'hashtags') {
//                                        foreach ($entity as $j => $hashtag) {
//                                            $hashtag_text = isset($hashtag->{'text'}) ? $hashtag->{'text'} : '';
//
//                                            $update_with = '<a href="https://twitter.com/search?q=%23' . $hashtag_text . '&amp;src=hash" target="_blank" title="' . $hashtag_text . '">#' . $hashtag_text . '</a>';
//                                            $hashtag_text;
//                                            $text = str_replace('#' . $hashtag_text, $update_with, $text);
//                                        }
//                                    } else if ($type == 'user_mentions') {
//                                        foreach ($entity as $j => $user) {
//                                            $user_screen_name = isset($user->{'screen_name'}) ? $user->{'screen_name'} : '';
//                                            $user_name = isset($user->{'screen_name'}) ? $user->{'name'} : '';
//
//                                            $update_with = '<a href="https://twitter.com/' . $user_screen_name . '" target="_blank" title="' . $user_name . '">@' . $user_screen_name . '</a>';
//                                            $text = str_replace('@' . $user_screen_name, $update_with, $text);
//                                        }
//                                    }
//                                }
//                            }
//                            $posted = '';
//                            if (isset($tweet->{'created_at'}) && $tweet->{'created_at'} != '') {
//                                $large_ts = time();
//                                $n = $large_ts - strtotime($tweet->{'created_at'});
//                                if ($n < (60)) {
//                                    $posted = sprintf(esc_html__('%d seconds ago', 'jobcareer'), $n);
//                                } elseif ($n < (60 * 60)) {
//                                    $minutes = round($n / 60);
//                                    $posted = sprintf(_n('About a Minute Ago', '%d Minutes Ago', $minutes, 'jobcareer'), $minutes);
//                                } elseif ($n < (60 * 60 * 16)) {
//                                    $hours = round($n / (60 * 60));
//                                    $posted = sprintf(_n('About an Hour Ago', '%d Hours Ago', $hours, 'jobcareer'), $hours);
//                                } elseif ($n < (60 * 60 * 24)) {
//                                    $hours = round($n / (60 * 60));
//                                    $posted = sprintf(_n('About an Hour Ago', '%d Hours Ago', $hours, 'jobcareer'), $hours);
//                                } elseif ($n < (60 * 60 * 24 * 6.5)) {
//                                    $days = round($n / (60 * 60 * 24));
//                                    $posted = sprintf(_n('About a Day Ago', '%d Days Ago', $days, 'jobcareer'), $days);
//                                } elseif ($n < (60 * 60 * 24 * 7 * 3.5)) {
//                                    $weeks = round($n / (60 * 60 * 24 * 7));
//                                    $posted = sprintf(_n('About a Week Ago', '%d Weeks Ago', $weeks, 'jobcareer'), $weeks);
//                                } elseif ($n < (60 * 60 * 24 * 7 * 4 * 11.5)) {
//                                    $months = round($n / (60 * 60 * 24 * 7 * 4));
//                                    $posted = sprintf(_n('About a Month Ago', '%d Months Ago', $months, 'jobcareer'), $months);
//                                } elseif ($n >= (60 * 60 * 24 * 7 * 4 * 12)) {
//                                    $years = round($n / (60 * 60 * 24 * 7 * 52));
//                                    $posted = sprintf(_n('About a year Ago', '%d years Ago', $years, 'jobcareer'), $years);
//                                }
//                            }
//                            $return .="<li>";
//                            $return .="<div class='cs-text'>";
//                            //$return .='<p>' . $text . '<a href="https://twitter.com/' . $user->{'screen_name'} . '">' . $user->{'screen_name'} . '</a></p>';
//                            $return .='<p>' . $text . '<a href="https://twitter.com/' . $user_screen_name . '">' . $user_screen_name . '</a></p>';
//                            if ($posted != '') {
//                                $return .="<span class='post-date'><i class='icon-twitter2'></i>(" . $posted . ")</span>";
//                            }
//                            $return .="</div> ";
//                            $return .="</li>";
//                        }
//
//                        if (isset($profile_image_url) && $profile_image_url <> '') {
//                            $profile_image_url = '<img src="' . esc_url($profile_image_url) . '" alt="' . jobcareer_get_post_img_title($post->ID) . '">';
//                        } else {
//                            $profile_image_url = '';
//                        }
//                        $return .= '';
//                        echo '<ul>' . $return . '</ul>';
//                    } else {
//                        if (isset($tweets->errors[0]) && $tweets->errors[0] <> "") {
//                            echo '<span class="bad_authentication">' . $tweets->errors[0]->message . ". Please enter valid Twitter API Keys </span>";
//                        } else {
//                            echo '<span class="bad_authentication">';
//                            echo 'No Tweets Found';
//                            echo '</span>';
//                        }
//                    }
//                } else {
//                    echo '<span class="bad_authentication">';
//                    echo 'No Tweets Found';
//                    echo '</span>';
//                }
//            }
//            echo '</div>';
//        }
        function widget($args, $instance) {
            global $jobcareer_options, $cs_twitter_arg;

            $cs_twitter_arg['consumerkey'] = isset($jobcareer_options['cs_consumer_key']) ? $jobcareer_options['cs_consumer_key']: '';
            $cs_twitter_arg['consumersecret'] = isset($jobcareer_options['cs_consumer_secret']) ? $jobcareer_options['cs_consumer_secret']: '';
            $cs_twitter_arg['accesstoken'] = isset($jobcareer_options['cs_access_token']) ? $jobcareer_options['cs_access_token']: '';
            $cs_twitter_arg['accesstokensecret'] = isset($jobcareer_options['cs_access_token_secret']) ? $jobcareer_options['cs_access_token_secret']: '';
            $cs_cache_limit_time = isset($jobcareer_options['cs_cache_limit_time']) ? $jobcareer_options['cs_cache_limit_time']: '';
            $cs_tweet_num_from_twitter = isset($jobcareer_options['cs_tweet_num_post']) ? $jobcareer_options['cs_tweet_num_post'] : '';
            $cs_twitter_datetime_formate = isset($jobcareer_options['cs_twitter_datetime_formate']) ? $jobcareer_options['cs_twitter_datetime_formate'] : '';
            
            if ($cs_cache_limit_time == '') {
                $cs_cache_limit_time = 60;
            }
            if ($cs_twitter_datetime_formate == '') {
                $cs_twitter_datetime_formate = 'time_since';
            }
            if ($cs_tweet_num_from_twitter == '') {
                $cs_tweet_num_from_twitter = 5;
            }

            extract($args, EXTR_SKIP);
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
            $title = htmlspecialchars_decode(stripslashes($title));
            $username = $instance['username'];
            $numoftweets = $instance['numoftweets'];
            if ($numoftweets == '') {
                $numoftweets = 2;
            }
            echo jobcareer_special_char($before_widget);
            // WIDGET display CODE Start
            if (!empty($title) && $title <> ' ') {
                echo jobcareer_special_char($before_title . $title . $after_title);
            }
             if (class_exists('wp_jobhunt')) {
                 if (strlen($username) > 1) {
                     
                jobcareer_include_file(cs_framework::plugin_dir() . 'include/cs-twitter/display-tweets.php');     
                //require_once trailingslashit(get_template_directory()) . 'include/theme-components/cs-twitter/display-tweets.php';
                display_tweets($username,$cs_twitter_datetime_formate , $cs_tweet_num_from_twitter, $numoftweets, $cs_cache_limit_time);
            }
        }
        }
    }

}
add_action('widgets_init', create_function('', 'return register_widget("jobcareer_twitter_widget");'));


