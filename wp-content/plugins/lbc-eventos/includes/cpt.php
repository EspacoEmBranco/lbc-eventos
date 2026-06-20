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
        'name'               => __( 'Eventos', 'lbc-eventos' ),
        'singular_name'      => __( 'Evento', 'lbc-eventos' ),
        'add_new'            => __( 'Adicionar Novo', 'lbc-eventos' ),
        'add_new_item'       => __( 'Adicionar Novo Evento', 'lbc-eventos' ),
        'edit_item'          => __( 'Editar Evento', 'lbc-eventos' ),
        'new_item'           => __( 'Novo Evento', 'lbc-eventos' ),
        'view_item'          => __( 'Ver Evento', 'lbc-eventos' ),
        'search_items'       => __( 'Pesquisar Eventos', 'lbc-eventos' ),
        'not_found'          => __( 'Nenhum evento encontrado', 'lbc-eventos' ),
        'not_found_in_trash' => __( 'Nenhum evento encontrado no lixo', 'lbc-eventos' ),
        'menu_name'          => __( 'Eventos', 'lbc-eventos' ),
    ];

    register_post_type('eventos', [
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'supports'     => [ 'title', 'editor', 'thumbnail' ],
        'menu_icon'    => 'dashicons-calendar-alt',
        'rewrite'      => [ 'slug' => 'eventos' ],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'lbc_eventos_register_cpt');
