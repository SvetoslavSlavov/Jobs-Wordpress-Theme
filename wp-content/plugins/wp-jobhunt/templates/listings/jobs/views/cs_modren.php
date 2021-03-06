<?php
/**
 * Jobs detail list
 *
 */
global $wpdb;
$main_col = '';
if ($a['cs_job_searchbox'] == 'yes') {
    $main_col = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
}
?>
<div class="hiring-holder <?php echo cs_allow_special_char($main_col); ?>">
    <?php
    include plugin_dir_path(__FILE__) . '../jobs-search-keywords.php';

    if ((isset($a['cs_job_title']) && $a['cs_job_title'] != '') || (isset($a['cs_job_top_search']) && $a['cs_job_top_search'] != "None" && $a['cs_job_top_search'] <> '')) {
        echo ' <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="row">';
        // section title
        if (isset($a['cs_job_title']) && $a['cs_job_title'] != '') {
            echo '<div class="cs-section-title"><h2>' . $a['cs_job_title'] . '</h2>';
            if (isset($a['cs_job_sub_title']) && $a['cs_job_sub_title'] != '') {
                echo '<span>' . $a['cs_job_sub_title'] . '</span>';
            }
            echo '</div>';
        }
        // sub title with total rec 
        if (isset($a['cs_job_top_search']) && $a['cs_job_top_search'] != "None" && $a['cs_job_top_search'] <> '') {

            if (isset($a['cs_job_top_search']) and $a['cs_job_top_search'] == "total_records") {
                echo '<h2>';
                ?><span class="result-count"><?php if (isset($count_post) && $count_post != '') echo esc_html($count_post) . " "; ?></span><?php
                if (isset($specialisms) && is_array($specialisms)) {
                    echo get_specialism_headings($specialisms);
                } else {

                    echo __("Jobs & Vacancies", "jobhunt");
                }
                echo "</h2>";
            } else if (isset($a['cs_job_top_search']) and $a['cs_job_top_search'] == "Filters") {
                include plugin_dir_path(__FILE__) . '../jobs-sort-filters.php';
            }
        }
        echo '</div></div>';
    }
    ?>
    <ul class="jobs-listing modern">
        <?php
        // getting if record not found
        if ($count_post > 0) {
            global $cs_plugin_options;
            $cs_search_result_page = isset($cs_plugin_options['cs_search_result_page']) ? $cs_plugin_options['cs_search_result_page'] : '';
            $loop = new WP_Query($args);
            $flag = 1;
            while ($loop->have_posts()) : $loop->the_post();
                global $post;
                $job_post = $post;
                $cs_job_posted = get_post_meta($post->ID, 'cs_job_posted', true);

                $cs_jobs_address = ''; //get_user_address_string_for_list($post->ID);
                $cs_jobs_thumb_url = ''; //get_post_meta($post->ID, 'job_img', true);
                // get employer images at run time
                $cs_job_employer = get_post_meta($post->ID, "cs_job_username", true); //

                $employer_img = get_the_author_meta('user_img', $cs_job_employer);
                $cs_jobs_address = get_user_address_string_for_list($cs_job_employer, 'usermeta');
                if ($employer_img != '') {
                    $cs_jobs_thumb_url = cs_get_img_url($employer_img, 'cs_media_5');
                }

//                $cs_jobs_thumb_url = get_post_meta($post->ID, 'job_img', true);
//                $cs_jobs_thumb_url = cs_get_img_url($cs_jobs_thumb_url, 'cs_media_5');
                if (!cs_image_exist($cs_jobs_thumb_url) || $cs_jobs_thumb_url == "") {
                    $cs_jobs_thumb_url = esc_url(wp_jobhunt::plugin_url() . 'assets/images/img-not-found16x9.jpg');
                }
                $cs_job_featured = get_post_meta($post->ID, 'cs_job_featured', true);
                // get all job types
                $all_specialisms = get_the_terms($post->ID, 'specialisms');
                $specialisms_values = '';
                $specialisms_class = '';
                $specialism_flag = 1;
                if ($all_specialisms != '') {
                    foreach ($all_specialisms as $specialismsitem) {
                        $specialisms_values .= $specialismsitem->name;
                        $specialisms_class .= $specialismsitem->slug;
                        if ($specialism_flag != count($all_specialisms)) {
                            $specialisms_values .= ", ";
                            $specialisms_class .= " ";
                        }
                        $specialism_flag++;
                    }
                }


                $all_job_type = get_the_terms($post->ID, 'job_type');
                // var_dump( $all_job_type);
                $job_type_values = '';
                $job_type_class = '';
                $job_type_flag = 1;
                if ($all_job_type != '') {
                    foreach ($all_job_type as $job_type) {
                        $t_id_main = $job_type->term_id;
                        $job_type_color_arr = get_option("job_type_color_$t_id_main");
                        $job_type_color = '';
                        if (isset($job_type_color_arr['text'])) {
                            $job_type_color = $job_type_color_arr['text'];
                        }
                        $cs_link = ' href="javascript:void(0);"';
                        if ($cs_search_result_page != '') {
                            $cs_link = ' href="' . esc_url_raw(get_page_link($cs_search_result_page) . '?job_type=' . $job_type->slug) . '"';
                        }
                        $job_type_values .= '<a ' . force_balance_tags($cs_link) . ' class="jobtype-btn" style="color:' . $job_type_color . '; border: solid 1px ' . $job_type_color . ';">' . $job_type->name . '</a>';
                        $job_type_class .= $job_type->slug;
                        if ($job_type_flag != count($all_specialisms)) {
                            $job_type_values .= " ";
                            $job_type_class .= " ";
                        }
                        $job_type_flag++;
                    }
                }
                ?>
                <li>
                    <div class="jobs-content">
                        <?php if ($cs_jobs_thumb_url <> '') { ?>
                            <div class="cs-media">
                                <figure>
                                    <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><img src="<?php echo esc_url($cs_jobs_thumb_url); ?>" alt="image"></a>
                                </figure>
                            </div>
                        <?php } ?>
                        <div class="cs-text">
                            <div class="cs-post-title"><h3><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo the_title(); ?></a></h3></div>
                            <ul>
                                <?php if ($cs_job_posted <> '') { ?><li><span> <?php _e('Posted', 'jobhunt'); ?></span> <?php echo cs_time_elapsed_string($cs_job_posted); ?></li><?php } ?>
                                <?php if ($specialisms_values <> '') { ?> <li><span><?php _e('Specialism', 'jobhunt'); ?></span><?php echo esc_html($specialisms_values); ?></li><?php } ?>
                                <?php if ($cs_jobs_address <> '') { ?> <li><span><?php _e('Location', 'jobhunt'); ?></span><?php echo esc_html($cs_jobs_address); ?></li><?php } ?>

                            </ul>
                            <p><?php echo wp_trim_words($post->post_content, 20, '...'); ?></p>
                            <a class="read-more cs-color" href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php _e('Read more', 'jobhunt'); ?></a>
                            <div class="list-options">
                                <?php
                                if ($job_type_values <> '') {
                                    echo force_balance_tags($job_type_values);
                                }
                                $user = cs_get_user_id();
                                ?>

                                <?php
                                echo '<div class="wish-list"> ';
                                if (!is_user_logged_in() || !$login_user_is_employer_flag) {

                                    if (is_user_logged_in()) {
                                        $user = cs_get_user_id();

                                        $finded_result_list = cs_find_index_user_meta_list($post->ID, 'cs-user-jobs-wishlist', 'post_id', cs_get_user_id());
                                        if (isset($user) and $user <> '' and is_user_logged_in()) {
                                            if (is_array($finded_result_list) && !empty($finded_result_list)) {
                                                ?>
                                                <a class="whishlist_icon shortlist" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="<?php _e("Added to Shortlist", "jobhunt"); ?>" id="<?php echo 'addjobs_to_wishlist' . intval($post->ID); ?>" onclick="cs_removejobs_to_wishlist('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', '<?php echo absint($post->ID); ?>', this)" ><i class="icon-heart6"></i></a> 
                                                <?php
                                            } else {
                                                ?>
                                                <a class="whishlist_icon shortlist" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="<?php _e("Add to Shortlist", "jobhunt"); ?>" id="<?php echo 'addjobs_to_wishlist' . intval($post->ID); ?>" onclick="cs_addjobs_to_wishlist('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', '<?php echo absint($post->ID); ?>', this)" ><i class="icon-heart-o"></i></a> 
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <a class="whishlist_icon shortlist" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="<?php _e("Add to Shortlist", "jobhunt"); ?>" id="<?php echo 'addjobs_to_wishlist' . intval($post->ID); ?>" onclick="cs_addjobs_to_wishlist('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', '<?php echo absint($post->ID); ?>', this)" ><i class="icon-heart-o"></i>
                                            </a> 	
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <button type="button" class="heart-btn shortlist" data-toggle="tooltip" data-placement="top" title="<?php _e("Add to Shortlist", "jobhunt"); ?>" onclick="trigger_func('#btn-header-main-login');"><i class='icon-heart-o'></i></button>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <a class="whishlist_icon shortlist" href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="<?php _e("Add to Shortlist", "jobhunt"); ?>" id="<?php echo 'addjobs_to_wishlist' . intval($post->ID); ?>" onclick="show_alert_msg('<?php echo __("Become a candidate then try again.", "jobhunt"); ?>')" ><i class="icon-heart-o"></i></a>
                                        <?php
                                    }
                                    echo '</div>';
                                    ?>
                            </div>
                        </div>
                    </div>
                </li>

                <?php
                $flag++;
            endwhile;
        } else {
            echo '<li class="ln-no-match">';
            echo '<div class="massage-notfound">
            <div class="massage-title">
             <h6><i class="icon-warning4"></i><strong> ' . __('Sorry !', 'jobhunt') . '</strong>&nbsp; ' . __("There are no listings matching your search.", 'jobhunt') . ' </h6>
            </div>
             <ul>
             	<li>' . __("Please re-check the spelling of your keyword", 'jobhunt') . ' </li>
                <li>' . __("Try broadening your search by using general terms", 'jobhunt') . '</li>
                <li>' . __("Try adjusting the filters applied by you", 'jobhunt') . '</li>
             </ul>
          </div>';
            echo '</li>';
        }
        ?> 
    </ul>
    <?php
//==Pagination Start
    if ($count_post > $cs_blog_num_post && $cs_blog_num_post > 0 && $a['cs_job_show_pagination'] == "pagination") {
        echo '<nav>';
        echo cs_pagination($count_post, $cs_blog_num_post, $qrystr, 'Show Pagination', 'page_job');
        echo ' </nav>';
    }//==Pagination End 
    ?>
</div>
