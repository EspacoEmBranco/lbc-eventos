<?php
/**
 * Plugin Name: LBC Eventos
 * Description: Plugin para gerir e apresentar eventos.
 * Version: 1.0.0
 * Author: João Dias
 * Text Domain: lbc-eventos
 */

defined('ABSPATH') || exit;
define('LBC_EVENTOS_PATH', plugin_dir_path(__FILE__));
define('LBC_EVENTOS_URL', plugin_dir_url(__FILE__));

require_once LBC_EVENTOS_PATH . 'includes/cpt.php';
require_once LBC_EVENTOS_PATH . 'includes/shortcode.php';

register_activation_hook(__FILE__, 'lbc_eventos_activate');
register_deactivation_hook(__FILE__, 'lbc_eventos_deactivate');

/**
 * Runs on plugin activation.
 * Blocks activation if ACF is not active, then registers the CPT and flushes
 * rewrite rules so the /eventos/ permalink is available immediately.
 *
 * @return void
 */
function lbc_eventos_activate()
{
    if (! function_exists('acf')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(
            esc_html__('Para garantir o correto funcionamento do plugin LBC Eventos, é necessário que o plugin Advanced Custom Fields (ACF) esteja instalado e activo.', 'lbc-eventos'),
            esc_html__('Dependência em falta', 'lbc-eventos'),
            [ 'back_link' => true ]
        );
    }

    lbc_eventos_register_cpt();
    flush_rewrite_rules();
}

/**
 * Runs on plugin deactivation.
 * Flushes rewrite rules to remove the /eventos/ slug from WordPress routing.
 *
 * @return void
 */
function lbc_eventos_deactivate()
{
    flush_rewrite_rules();
}

/**
 * Shows an admin error notice if ACF is deactivated while this plugin is active.
 *
 * @return void
 */
function lbc_eventos_acf_notice()
{
    if (! function_exists('acf')) {
        ?>
		<div class="notice notice-error">
			<p><?php esc_html_e('Para garantir o correto funcionamento do plugin LBC Eventos, é necessário que o plugin Advanced Custom Fields (ACF) esteja instalado e activo.', 'lbc-eventos'); ?></p>
		</div>
		<?php
    }
}
add_action('admin_notices', 'lbc_eventos_acf_notice');

/**
 * Enqueues Bootstrap 5 CSS from CDN on the frontend and custom style.
 * Used by both the shortcode grid and the single post template.
 *
 * @return void
 */
function lbc_eventos_enqueue_assets()
{
    wp_enqueue_style(
        'bootstrap-5',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        [],
        '5.3.3'
    );
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        [],
        '1.11.3'
    );
    wp_enqueue_style(
        'lbc-eventos',
        LBC_EVENTOS_URL . 'assets/style.css',
        [ 'bootstrap-5', 'bootstrap-icons' ],
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'lbc_eventos_enqueue_assets');
