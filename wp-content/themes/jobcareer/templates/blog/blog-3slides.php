<?php
/**
 * @ Blog slider view 3 Slide
 *
 *
 */

$cs_blog_vars = array('post', 'cs_blog_cat', 'cs_blog_description', 'cs_blog_excerpt', 'cs_notification', 'wp_query', 'cs_blog_grid_layout', 'cs_blog_section_title');
$cs_blog_vars = CS_JOBCAREER_GLOBALS()->globalizing($cs_blog_vars);
extract($cs_blog_vars);

extract($wp_query->query_vars);
$width = '236';
$height = '168';
$args_value = array('posts_per_page' => "-1", 'post_type' => 'post', 'post_status' => 'publish',);

// Blog silder script start here
?> 
<script type='text/javascript'>
    jQuery(document).ready(function () {
        'use strict';
        jQuery('.cs-3-column').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            prevArrow: jQuery('.blog-slider-prev'),
            nextArrow: jQuery('.blog-slider-next'),
            responsive: [
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false
                    }
                }
            ]
        });



    });
</script>
<div class="blog-slider-prev"><a href="javascript:void();" title="<?php echo esc_html__('Previous', 'jobcareer'); ?>"><i class="icon-arrow-left9"></i></a></div>
<div class="blog-slider-next"><a  href="javascript:void();" title="<?php echo esc_html__('Next', 'jobcareer'); ?>"><i class="icon-arrow-right9"></i></a></div>


<ul class="blog-list blog-slide blogs cs-3-column">
    <?php
    $query = new WP_Query($args_value);
    $post_count = $query->post_count;
    if ($query->have_posts()) {
        $postCounter = 0;
        while ($query->have_posts()) : $query->the_post();
            $thumbnail = jobcareer_get_post_img_src($post->ID, $width, $height);
            $cs_postObject = get_post_meta($post->ID, "cs_full_data", true);
            $cs_gallery = get_post_meta($post->ID, 'cs_post_list_gallery', true);
            $cs_gallery = explode(',', $cs_gallery);
            $cs_thumb_view = get_post_meta($post->ID, 'cs_thumb_view', true);
            $cs_post_view = isset($cs_thumb_view) ? $cs_thumb_view : '';
            $current_user = wp_get_current_user();
            $custom_image_url = get_user_meta(get_the_author_meta('ID'), 'user_avatar_display', true);
            $tags = get_tags();
            ?>
            <li class="col-md-3">
                <?php if (isset($thumbnail) and $thumbnail <> '' || $cs_post_view != "slider") { ?>
                    <figure class="effect-julia">
                        <a href="<?php the_permalink(); ?>">
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="" /></a></figure>
                    <?php
                } elseif (isset($cs_post_view) and $cs_post_view == "slider") {
                    jobcareer_post_slick_slider($width, $height, get_the_id(), '');
                }
                ?>
                <div class="cs-text"> 
                    <span><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php echo date('M j, Y', strtotime(get_the_date())); ?></a></span>
                    <h5><a href="<?php the_permalink(); ?>">
                            <?php echo wp_trim_words(get_the_title(), 4); ?></a>
                    </h5>
                    <?php if ($cs_blog_description == 'yes') { ?>
                        <p> <?php echo jobcareer_get_excerpt($cs_blog_excerpt, 'true', ''); ?></p>
                    <?php
                    }
                    ?> 
                    <div class="post-option">
                        <span class="post-comment"><a href="<?php the_permalink(); ?>#comments"><i class="icon-comment"></i><?php
                                $num_comments = get_comments_number($post->ID); // get_comments_number returns only a numeric value
                                echo absint($num_comments);
                                ?></a></span>
                        <a href="<?php the_permalink(); ?>" class="readmore cs-color"><?php esc_html_e('Read More', 'jobcareer'); ?></a> 
                    </div>

                </div>
            </li>

            <?php
        endwhile;
    } else {
        $cs_notification->error('No blog post found.');
    }
    ?>
</ul>