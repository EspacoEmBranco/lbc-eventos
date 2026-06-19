<?php

defined('ABSPATH') || exit;

/**
 * Register the "Eventos" Custom Post Type.
 *
 * @return void
 */
function lbc_eventos_register_cpt()
{
    $labels = [
        'name'               => 'Eventos',
        'singular_name'      => 'Evento',
        'add_new'            => 'Adicionar Novo',
        'add_new_item'       => 'Adicionar Novo Evento',
        'edit_item'          => 'Editar Evento',
        'new_item'           => 'Novo Evento',
        'view_item'          => 'Ver Evento',
        'search_items'       => 'Pesquisar Eventos',
        'not_found'          => 'Nenhum evento encontrado',
        'not_found_in_trash' => 'Nenhum evento encontrado no lixo',
        'menu_name'          => 'Eventos',
    ];

    register_post_type('eventos', [
        'labels'      => $labels,
        'public'      => true,
        'has_archive' => true,
        'supports'    => [ 'title', 'editor', 'thumbnail' ],
        'menu_icon'   => 'dashicons-calendar-alt',
        'rewrite'     => [ 'slug' => 'eventos' ],
    ]);
}
add_action('init', 'lbc_eventos_register_cpt');
