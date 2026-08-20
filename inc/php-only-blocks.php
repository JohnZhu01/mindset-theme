<?php
/**
 * Register PHP-only blocks.
 *
 * @package Mindset_Theme
 */

/**
 * Register the Service Posts block.
 */
function mindset_register_php_blocks()
{
    register_block_type(
        'mindset-blocks/service-posts',
        array(
            'title' => __('Service Posts', 'mindset-theme'),
            'icon' => 'admin-tools',
            'category' => 'widgets',
            'description' => __('Displays all published Service posts.', 'mindset-theme'),
            'keywords' => array(
                __('services', 'mindset-theme'),
                __('service posts', 'mindset-theme'),
            ),
            'render_callback' => 'mindset_render_service_posts',
            'supports' => array(
                'autoRegister' => true,
            ),
        )
    );
}
add_action('init', 'mindset_register_php_blocks');

/**
 * Render published Service posts grouped by Service Category terms.
 *
 * @return string Rendered block markup.
 */
function mindset_render_service_posts($attributes)
{
    $wrapper_attributes = get_block_wrapper_attributes(
        array(
            'class' => 'service-posts',
        )
    );

    $service_terms = get_terms(
        array(
            'taxonomy' => 'fwd-service-category',
            'hide_empty' => true,
            'orderby' => 'name',
            'order' => 'ASC',
        )
    );

    if (is_wp_error($service_terms) || empty($service_terms)) {
        return sprintf(
            '<div %1$s><p>%2$s</p></div>',
            $wrapper_attributes,
            esc_html__('No services found.', 'mindset-theme')
        );
    }

    ob_start();
    ?>
        <div <?php echo $wrapper_attributes; ?>>
            <nav
                class="service-posts__navigation"
                aria-label="<?php esc_attr_e('Services', 'mindset-theme'); ?>"
            >
                <?php
                foreach ($service_terms as $service_term) {
                    ?>
                        <a href="#service-category-<?php echo esc_attr($service_term->slug); ?>">
                            <?php echo esc_html($service_term->name); ?>
                        </a>
                        <?php
                }
                ?>
            </nav>

            <?php
            foreach ($service_terms as $service_term) {
                $service_query = new WP_Query(
                    array(
                        'post_type' => 'fwd-service',
                        'post_status' => 'publish',
                        'posts_per_page' => -1,
                        'orderby' => 'title',
                        'order' => 'ASC',
                        'no_found_rows' => true,
                        'update_post_meta_cache' => false,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'fwd-service-category',
                                'field' => 'term_id',
                                'terms' => $service_term->term_id,
                            ),
                        ),
                    )
                );

                if (!$service_query->have_posts()) {
                    continue;
                }
                ?>
                    <section
                        id="service-category-<?php echo esc_attr($service_term->slug); ?>"
                        class="service-posts__category"
                    >
                        <h2 class="service-posts__category-title">
                            <?php echo esc_html($service_term->name); ?>
                        </h2>

                        <?php
                        while ($service_query->have_posts()) {
                            $service_query->the_post();
                            ?>
                                <article id="post-<?php the_ID(); ?>" class="service-post">
                                    <h3 class="service-post__title">
                                        <?php the_title(); ?>
                                    </h3>

                                    <div class="service-post__content">
                                        <?php the_content(); ?>
                                    </div>
                                </article>
                            <?php
                        }
                        ?>
                    </section>
                    <?php

                wp_reset_postdata();
            }
            ?>
        </div>
        <?php

        return ob_get_clean();
}
