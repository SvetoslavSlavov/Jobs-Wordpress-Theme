<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $wpdb, $cs_plugin_options, $cs_candidate_title;
if ($a['cs_candidate_searchbox'] == 'yes') {
    echo '<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">';
}
?>
<div class="hiring-holder">
    <?php
    include plugin_dir_path(__FILE__) . '../candidate-search-keywords.php';
    ?>
    <ul class="cs-candidate-grid row">
        <?php
        // getting if record not found
        if ($count_post > 0) {

            $loop = new WP_User_Query($args);

            $flag = 1;
            if (!empty($loop->results)) {
                foreach ($loop->results as $cs_user) {

                    $cs_job_posted = get_user_meta($cs_user->ID, 'cs_job_posted', true);
                    $cs_minimum_salary = get_user_meta($cs_user->ID, 'cs_minimum_salary', true);
                    $cs_job_title = get_user_meta($cs_user->ID, 'cs_job_title', true);
                    $cs_job_featured = get_user_meta($cs_user->ID, 'cs_job_featured', true);
                    $cs_jobs_address = get_user_address_string_for_list($cs_user->ID, 'usermeta');
                    $cs_jobs_thumb_url = get_user_meta($cs_user->ID, 'user_img', true);

                    $cs_job_featured = get_user_meta($cs_user->ID, 'cs_job_featured', true);
                    // get all job types
                    $all_specialisms = get_user_meta($cs_user->ID, 'cs_specialisms', true);
                    $specialisms_values = '';
                    $specialisms_class = '';
                    $specialism_html = '';
                    $specialism_flag = 1;
                    if ($all_specialisms != '') {
                        foreach ($all_specialisms as $specialisms_item) {
                            $specialismsitem = get_term_by('slug', $specialisms_item, 'specialisms');
                            if (is_object($specialismsitem)) {
                                if ($specialism_flag == 1) {
                                    $specialism_html .= '<span><a>' . $specialismsitem->name . '</a><span>';
                                } else {
                                    $specialism_html .= ', <span><a>' . $specialismsitem->name . '</a><span>';
                                }
                                $specialisms_values .= $specialismsitem->name;
                                $specialisms_class .= $specialismsitem->slug;
                                if ($specialism_flag != count($all_specialisms)) {
                                    $specialisms_values .= ", ";
                                    $specialisms_class .= " ";
                                }
                                $specialism_flag++;
                            }
                        }
                    }

                    $cs_jobs_thumb_url = get_user_meta($cs_user->ID, 'user_img', true);
                    $cs_jobs_thumb_url = cs_get_img_url($cs_jobs_thumb_url, 'cs_media_4');
                    $cs_ext = pathinfo($cs_jobs_thumb_url, PATHINFO_EXTENSION);
                    $cs_currency_sign = isset($cs_plugin_options['cs_currency_sign']) ? $cs_plugin_options['cs_currency_sign'] : '';
                    ?>
                    <li class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <div class="candidate-content">
                            <div class="cs-media">
                                <figure>
                                    <?php if ($cs_jobs_thumb_url != '' && $cs_ext != '') { ?>
                                        <a href="<?php echo esc_url(get_author_posts_url($cs_user->ID)); ?>"><img alt="" src="<?php echo esc_url($cs_jobs_thumb_url); ?>"></a>
                                        <?php
                                    } else {

                                        $cs_jobs_thumb_url = esc_url(wp_jobhunt::plugin_url() . 'assets/images/candidate-no-image.jpg');
                                        ?>
                                        <a href="<?php echo esc_url(get_author_posts_url($cs_user->ID)); ?>"><img alt="" src="<?php echo esc_url($cs_jobs_thumb_url); ?>"></a>
                                        <?php
                                    }
                                    if ($specialisms_values != '') {
                                        ?>
                                        <figcaption>
                                            <span>
                                                <?php
                                                echo esc_html($specialisms_values);
                                                if (isset($cs_minimum_salary) && $cs_minimum_salary != '') {
                                                    ?>
                                                    <em><?php echo esc_html($cs_currency_sign) . ' ' . esc_html($cs_minimum_salary); ?></em>
                                                <?php } ?>
                                            </span>
                                        </figcaption>
                                        <?php
                                    }
                                    ?>
                                </figure>
                            </div>
                            <div class="candidate-text">
                                <div class="cs-post-title">
                                    <h3><a href="<?php echo esc_url(get_author_posts_url($cs_user->ID)); ?>"><?php echo force_balance_tags($cs_user->display_name); ?></a></h3>
                                </div>
                                <?php
                                if ($cs_jobs_address <> '') { ?>
                                    <div class="post-option">
                                        <span class="address"><?php echo esc_html($cs_jobs_address); ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                    <?php
                    $flag++;
                }
            }
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
    if ((isset($users_per_page) && $count_post > $users_per_page && $users_per_page > 0) && $a['cs_candidate_show_pagination'] == 'pagination') {
        echo '<nav>';
        cs_user_pagination($total_pages, $page);
        echo '</nav>';
    }//==Pagination End 
    ?>
</div>
<?php
if ($a['cs_candidate_searchbox'] == 'yes') {
    echo '</div>';
}
?>

