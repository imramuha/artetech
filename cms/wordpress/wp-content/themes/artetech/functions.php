<?php
/*
 * Proper way to enqueue scripts and styles
*/
    function artetech_enqueue_scripts() {
        /* integration of CSS/JS */
        wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/build/app.min.css');
        wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js//build/app.min.js', null , null , true);
    /*  wp_enqueue_style( 'bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' );
        */
        wp_enqueue_style( 'load-fa', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css' );
    }

    add_action ('wp_enqueue_scripts', 'artetech_enqueue_scripts');
/*
    // if user isn't logged in, redirect to login
    function artetech_redirect_to_login_if_guest() {
        if ( ! is_admin() && ! is_user_logged_in() && $GLOBALS['pagenow'] !== 'wp-login.php' ) {

            wp_redirect( wp_login_url( $_SERVER['REQUEST_URI'] ) );
            exit;
        }
    }    
    add_action( 'wp_loaded', 'artetech_redirect_to_login_if_guest' );*/

    // add multiple roles & set the capabilities [!!]
    function artetech_add_role() {
        add_role( 'administrator', __( 'Administrator' ),        
            array(        
                'read' => true, // true allows this capability
                'edit_posts' => true, // Allows user to edit their own posts
                'edit_pages' => true, // Allows user to edit pages
                'edit_others_posts' => true, // Allows user to edit others posts not just their own
                'create_posts' => true, // Allows user to create new posts
                'manage_categories' => true, // Allows user to manage post categories
                'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
                'edit_themes' => false, // false denies this capability. User can’t edit your theme
                'install_plugins' => false, // User cant add new plugins
                'update_plugin' => false, // User can’t update any plugins
                'update_core' => false // user cant perform core updates        
            )        
        );

        add_role( 'klant', __( 'Klant' ),            
            array(        
                'read' => true, // true allows this capability
                'edit_posts' => true, // Allows user to edit their own posts
                'edit_pages' => true, // Allows user to edit pages
                'edit_others_posts' => true, // Allows user to edit others posts not just their own
                'create_posts' => true, // Allows user to create new posts
                'manage_categories' => true, // Allows user to manage post categories
                'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
                'edit_themes' => false, // false denies this capability. User can’t edit your theme
                'install_plugins' => false, // User cant add new plugins
                'update_plugin' => false, // User can’t update any plugins
                'update_core' => false // user cant perform core updates        
            )
        );

        add_role( 'werknemer', __( 'Werknemer' ),            
            array(        
                'read' => true, // true allows this capability
                'edit_posts' => true, // Allows user to edit their own posts
                'edit_pages' => true, // Allows user to edit pages
                'edit_others_posts' => true, // Allows user to edit others posts not just their own
                'create_posts' => true, // Allows user to create new posts
                'manage_categories' => true, // Allows user to manage post categories
                'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
                'edit_themes' => false, // false denies this capability. User can’t edit your theme
                'install_plugins' => false, // User cant add new plugins
                'update_plugin' => false, // User can’t update any plugins
                'update_core' => false // user cant perform core updates        
            )

        );

        add_role( 'aannemer', __( 'Aannemer' ),            
            array(        
                'read' => true, // true allows this capability
                'edit_posts' => true, // Allows user to edit their own posts
                'edit_pages' => true, // Allows user to edit pages
                'edit_others_posts' => true, // Allows user to edit others posts not just their own
                'create_posts' => true, // Allows user to create new posts
                'manage_categories' => true, // Allows user to manage post categories
                'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
                'edit_themes' => false, // false denies this capability. User can’t edit your theme
                'install_plugins' => false, // User cant add new plugins
                'update_plugin' => false, // User can’t update any plugins
                'update_core' => false // user cant perform core updates        
            )
        );
    }
    add_action( 'init', 'artetech_add_role' );

    // remove unwanted roles
    function artetech_remove_role() {
        remove_role( 'editor' );
        remove_role( 'author' );
        remove_role( 'contributor' );
        remove_role( 'subscriber' );
    }

    add_action( 'init', 'artetech_remove_role' );


    // redirect user after login based on role :) [!!]


    // add navigation
    


    // customize login page :)

?>