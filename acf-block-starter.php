<?php
/*
* Plugin Name: ACF Block Starter
* Plugin URI: 
* Description: 
* Version: 1.0
* Author: Jacob Martella
* Author URI: 
* License: GPLv3
* Text Domain: acf-block-starter
*/

function acf_starter_add_scripts() {
    $editorStylePath = 'css/editor.css';

    wp_enqueue_style(
        'acf-starter-custom-blocks-css',
        plugins_url( $editorStylePath, __FILE__),
        array(),
        filemtime( plugin_dir_path( __FILE__ ) . 'css/editor.css' )
    );
}

function acf_starter_front_end_assets() {
    // If in the backend, bail out.
    if ( is_admin() ) {
        return;
    }

    $style_path = 'css/block.css';
    wp_enqueue_style(
        'acf-starter-custom-blocks-front-css',
        plugins_url( $style_path, __FILE__ ),
        array(),
        filemtime( plugin_dir_path( __FILE__ ) . 'css/style.css' )
    );
}

function starter_add_acf_custom_blocks() {
    if( function_exists('acf_register_block') ) {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'blocks/starter-block.php';
    }

    acf_register_block(array(
        'name'				=> 'starter-block',
        'title'				=> __('Starter Block'),
        'description'		=> __('A block to get started with using ACF.'),
        'render_callback'	=> 'starter_block_render_callback',
        'category'			=> 'widgets',
        'icon'				=> '',
        'keywords'			=> array( '' ),
    ));
}

add_action( 'enqueue_block_editor_assets', 'acf_starter_add_scripts' );
add_action( 'enqueue_block_assets', 'acf_starter_front_end_assets' );
add_action( 'acf/init', 'starter_add_acf_custom_blocks' );
