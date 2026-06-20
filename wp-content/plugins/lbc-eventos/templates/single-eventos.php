<?php
/**
 * Template for displaying a single Evento post.
 */

defined('ABSPATH') || exit;

get_header();
?>

<main class="lbc-eventos-single container py-5">
    <?php while (have_posts()) : the_post(); ?>
        <article id="evento-<?php the_ID(); ?>">

            <?php if (has_post_thumbnail()) : ?>
                <div class="mb-4">
                    <?php the_post_thumbnail('full', [ 'class' => 'evento-featured-img rounded' ]); ?>
                </div>
            <?php endif; ?>

            <h1 class="mb-3"><?php the_title(); ?></h1>

            <ul class="d-md-flex evento-meta gap-2 list-unstyled">
                <?php $date = get_field('data_evento'); ?>
                <?php if ($date) : ?>
                    <li class="event-date text-muted">
                        <i class="bi bi-calendar3 me-2"></i><?php echo esc_html($date); ?>
                    </li>
                <?php endif; ?>

                <?php $local = get_field('local'); ?>
                <?php if ($local) : ?>
                    <li class="event-local">
                        <i class="bi bi-geo-alt me-2"></i><?php echo esc_html($local); ?>
                    </li>
                <?php endif; ?>

                <?php $org = get_field('organizador'); ?>
                <?php if ($org) : ?>
                    <li class="event-org">
                        <i class="bi bi-person me-2"></i><?php echo esc_html($org); ?>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="event-content">
                <?php the_content(); ?>
            </div>

        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
