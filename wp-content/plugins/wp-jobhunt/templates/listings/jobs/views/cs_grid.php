<?php
/**
 * Jobs Grid view
 *
 */
global $wpdb;
$main_col = '';
$content_box_classes = 'col-lg-3 col-md-3 col-sm-6 col-xs-12';
if ($a['cs_job_searchbox'] == 'yes') {
    $main_col = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
    $content_box_classes = 'col-lg-4 col-md-4 col-sm-6 col-xs-12';
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
            } elseif (isset($a['cs_job_top_search']) and $a['cs_job_top_search'] == "Filters") {
                include plugin_dir_path(__FILE__) . '../jobs-sort-filters.php';
            }
        }
        echo '</div></div>';
    }
    ?>
    <div class="row">
        <ul class="jobs-listing grid">
            <?php
            // getting if record not found
            if ($count_post > 0) {
                global $cs_plugin_options;
                $cs_search_result_page = isset($cs_plugin_options['cs_search_result_page']) ? $cs_plugin_options['cs_search_result_page'] : '';
                $loop = new WP_Query($args);

                $flag = 1;
                while ($loop->have_posts()) : $loop->the_post();
                    global $post;
                    $list_job_id = $post->ID;
                    $job_post = $post;
                    $cs_job_posted = get_post_meta($post->ID, 'cs_job_posted', true);
                    $cs_job_featured = get_post_meta($post->ID, 'cs_job_featured', true);
                    $cs_jobs_address = '';
                    $cs_jobs_thumb_url = ''; //get_post_meta($post->ID, 'job_img', true);
                    // get employer images at run time
                    $cs_job_employer = get_post_meta($post->ID, "cs_job_username", true); //
                    $employer_img =  get_the_author_meta('user_img', $cs_job_employer);
                    $cs_jobs_address = get_user_address_string_for_list($cs_job_employer, 'usermeta');
//                    $cs_job_employer_data = cs_get_postmeta_data('cs_user', $cs_job_employer, '=', 'employer', true);
//                    $employer_img = '';
//                    if (isset($cs_job_employer_data)) {
//                        foreach ($cs_job_employer_data as $cs_job_employer_single) {
//                            $employer_img = get_post_meta($cs_job_employer_single->ID, "user_img", true);
//                            $cs_jobs_address = get_user_address_string_for_list($cs_job_employer_single->ID);
//                        }
//                    }
                    if ($employer_img != '') {
                        $cs_jobs_thumb_url = cs_get_img_url($employer_img, 'cs_media_5');
                    }
//                    $cs_jobs_thumb_url = get_post_meta($post->ID, 'job_img', true);
//                    $cs_jobs_thumb_url = cs_get_img_url($cs_jobs_thumb_url, 'cs_media_5');
                    if (!cs_image_exist($cs_jobs_thumb_url) || $cs_jobs_thumb_url == "") {
                        $cs_jobs_thumb_url = esc_url(wp_jobhunt::plugin_url() . 'assets/images/img-not-found16x9.jpg');
                    }
                    $cs_jobs_feature_url = esc_url(wp_jobhunt::plugin_url() . 'assets/images/img-feature.png');
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
                            //$job_type_class .= get_term_link($t_id_main);	
                            $cs_link = ' href="javascript:void(0);"';
                            if ($cs_search_result_page != '') {
                                $cs_link = ' href="' . esc_url_raw(get_page_link($cs_search_result_page) . '?job_type=' . $job_type->slug) . '"';
                            }
                            $job_type_values .= '<div class="cs-grid-job-type"><a ' . force_balance_tags($cs_link) . ' class="jobtype-btn" style="color:' . $job_type_color . ';">' . $job_type->name . '</a></div>';

                            if ($job_type_flag != count($all_specialisms)) {
                                $job_type_values .= " ";
                                $job_type_class .= " ";
                            }
                            $job_type_flag++;
                        }
                    }
                    ?>
                    <li class="<?php echo esc_html($content_box_classes); ?>">
                        <div class="jobs-content">
                            <div class="cs-media">
                                <?php if ($cs_jobs_thumb_url <> '') { ?>
                                    <figure><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><img alt="" src="<?php echo esc_url($cs_jobs_thumb_url); ?>"></a></figure>
                                <?php }if (isset($cs_job_featured) and $cs_job_featured == "yes" || $cs_job_featured == "on") {
                                    ?>
                                    <span class="listing-featered"><?php _e('FEATURED', 'jobhunt'); ?></span>
                                <?php } ?>
                            </div>
                            <div class="cs-text">
                                <span class="cs-categories cs-color"> <?php echo esc_html($specialisms_values); ?></span>
                                <div class="cs-post-title"><h6><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php the_title(); ?></a></h6></div>
                                <?php echo force_balance_tags($job_type_values); ?>
                                <div class="post-options">
                                    <?php if ($cs_jobs_address <> '') { ?>
                                        <span class="cs-location"><?php echo esc_html($cs_jobs_address); ?></span>
                                    <?php } if ($cs_job_posted <> '') {
                                        ?><span class="cs-post-date"><?php echo cs_time_elapsed_string($cs_job_posted); ?></span>
                                    <?php } ?>
                                </div>
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
    </div>
    <?php
    //==Pagination Start
    if ($count_post > $cs_blog_num_post && $cs_blog_num_post > 0 && $a['cs_job_show_pagination'] == "pagination") {
        echo '<nav>';
        echo cs_pagination($count_post, $cs_blog_num_post, $qrystr, 'Show Pagination', 'page_job');
        echo '</nav>';
    }//==Pagination End 
    ?>
</div>