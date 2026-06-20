<?php

defined('ABSPATH') || exit;

/**
 * Renders a bootstrap grid of upcoming events.
 * Usage: [eventos_futuros]/[eventos_futuros limite="6"]
 *
 * @param array $atts Shortcode attributes. Accepts 'limite' (int, default -1 for all).
 * @return string HTML output.
 */
function lbc_eventos_futuros_shortcode($atts)
{
    $atts = shortcode_atts(
        [ 'limite' => -1 ],
        $atts,
        'eventos_futuros'
    );

    $query = new WP_Query(
        [
            'post_type'      => 'eventos',
            'posts_per_page' => intval($atts['limite']),
            'meta_key'       => 'data_evento',
            'orderby'        => 'meta_value',
            'order'          => 'ASC',
            'no_found_rows'  => true,
            'meta_query'     => [
                [
                    'key'     => 'data_evento',
                    'value'   => current_time('Ymd'),
                    'compare' => '>=',
                    'type'    => 'CHAR',
                ],
            ],
        ]
    );

    if (! $query->have_posts()) {
        return '<p class="no-events-message">' . esc_html__('De momento não existem eventos futuros.', 'lbc-eventos') . '</p>';
    }

    ob_start();
    ?>
    <div class="lbc-eventos-grid container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">

            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php
                $date = get_field('data_evento');
                $local       = get_field('local');
                $org = get_field('organizador');
                ?>

                <div class="col">
                    <div class="card h-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <img
                                    src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>"
                                    class="card-img-top"
                                    alt="<?php echo esc_attr(get_the_title()); ?>"
                                >
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="event-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                            <?php if ($date) : ?>
                                <p class="event-date text-muted">
                                    <i class="bi bi-calendar3 me-2"></i><?php echo esc_html($date); ?>
                                </p>
                            <?php endif; ?>
                            <?php if ($local) : ?>
                                <p class="event-local">
                                    <i class="bi bi-geo-alt me-2"></i><?php echo esc_html($local); ?>
                                </p>
                            <?php endif; ?>
                            <?php if ($org) : ?>
                                <p class="event-org">
                                    <i class="bi bi-person me-2"></i><?php echo esc_html($org); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('eventos_futuros', 'lbc_eventos_futuros_shortcode');
