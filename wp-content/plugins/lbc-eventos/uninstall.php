<?php
/**
 * Uninstall routine for LBC Eventos.
 * Runs when the plugin is deleted via the WordPress admin.
 * Removes all Evento posts and their associated metadata.
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

$eventos = get_posts(
    [
        'post_type'   => 'eventos',
        'post_status' => 'any',
        'numberposts' => -1,
        'fields'      => 'ids',
    ]
);

foreach ( $eventos as $id ) {
    wp_delete_post( $id, true );
}
