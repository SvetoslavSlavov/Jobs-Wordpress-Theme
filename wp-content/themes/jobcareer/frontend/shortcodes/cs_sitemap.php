<?php
/**
 * @Spacer html form for page builder
 */
if (!function_exists('jobcareer_sitemap_shortcode')) {

    function jobcareer_sitemap_shortcode($atts, $content = "") {
        global $cs_border;

        $defaults = array('cs_sitemap_section_title' => '');
        extract(shortcode_atts($defaults, $atts));

        $cs_sitemap_section_title = $cs_sitemap_section_title ? $cs_sitemap_section_title : '';
        ob_start();
        ?>
        <div class="row">
            <div class="sitemap-links">	
                <?php if (isset($cs_sitemap_section_title) && $cs_sitemap_section_title != '') { ?>
                    <div class="cs-section-title col-md-12">
                        <h1><?php echo esc_html($cs_sitemap_section_title); ?></h1>
                    </div> 
                <?php } ?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h3><?php esc_html_e('Pages', 'jobcareer'); ?></h3>
                        <ul>
                            <?php
                            $args = array(
                                'posts_per_page' => "-1",
                                'post_type' => 'page',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                            );
                            $query = new WP_Query($args);
                            $post_count = $query->post_count;
                            if ($query->have_posts()) {
                                while ($query->have_posts()) : $query->the_post();
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                    <?php
                                endwhile;
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="site-maps-links">
                        <h4><?php esc_html_e('Tags', 'jobcareer'); ?></h4>
                        <ul>
                            <?php
                            $tags = get_tags(array('order' => 'ASC', 'post_type' => 'post', 'order' => 'DESC'));
                            foreach ((array) $tags as $tag) {
                                ?>
                                <li> <?php echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" rel="tag">' . $tag->name . ' (' . $tag->count . ') </a>'; ?></li>
                                <?php
                            }
                            ?>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h4><?php esc_html_e('Posts', 'jobcareer'); ?></h4>
                        <ul>
                            <?php
                            $args = array(
                                'posts_per_page' => "-1",
                                'post_type' => 'post',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                            );
                            $query = new WP_Query($args);
                            $post_count = $query->post_count;
                            if ($query->have_posts()) {
                                while ($query->have_posts()) : $query->the_post();
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 3, '...'); ?></a></li>
                                    <?php
                                endwhile;
                            }
                            ?>

                        </ul>
                    </div>	
                    <div class="site-maps-links">
                        <h4><?php esc_html_e('Categories', 'jobcareer'); ?></h4>
                        <ul>
                            <?php
                            $args = array(
                                'show_option_all' => '',
                                'order' => 'ASC',
                                'post_type' => 'post',
                                'order' => 'ASC',
                                'style' => 'list',
                                'title_li' => '',
                                'taxonomy' => 'category'
                            );

                            wp_list_categories($args);
                            ?>

                        </ul>
                    </div>	
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h4><?php esc_html_e('jobcareer', 'jobcareer'); ?></h4>
                        <ul>
                            <?php
                            $args = array(
                                'posts_per_page' => "-1",
                                'post_type' => 'jobcareer',
                                'order' => 'ASC',
                                'post_status' => 'publish',
                            );
                            $query = new WP_Query($args);
                            $post_count = $query->post_count;
                            if ($query->have_posts()) {
                                while ($query->have_posts()) : $query->the_post();
                                    ?>
                                    <li><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 3, '...'); ?></a></li>
                                    <?php
                                endwhile;
                            }
                            ?>
                        </ul>
                    </div>	
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="site-maps-links">
                        <h4><?php esc_html_e('Specialisms', 'jobcareer'); ?></h4>
                        <ul>
                            <?php
                            $customPostTaxonomies = get_object_taxonomies('jobcareer');
                            ?>

                            <?php
                            foreach ($customPostTaxonomies as $tax) {
                                $args = array(
                                    'orderby' => 'title',
                                    'hierarchical' => 1,
                                    'taxonomy' => $tax,
                                    'title_li' => ''
                                );

                                wp_list_categories($args);
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div> 
        </div> 
        <?php
        $cs_sitemap = ob_get_clean();
        return do_shortcode($cs_sitemap);
    }

    if (function_exists('cs_short_code')) {
        cs_short_code(CS_SC_SITEMAP, 'jobcareer_sitemap_shortcode');
    }
}