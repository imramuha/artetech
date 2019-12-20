<?php
/*
 * Proper way to enqueue scripts and styles
*/
    function artetech_enqueue_scripts() {
        /* integration of CSS/JS */
        wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/sass//build/app.min.css');
        wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js//build/app.min.js', null , null , true);
    /*  wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' );
        */
        wp_enqueue_style( 'load-fa', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css' );
    }

    add_action ('wp_enqueue_scripts', 'artetech_enqueue_scripts');

?>