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

        add_role( 'medewerker', __( 'Medewerker' ),            
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

        add_role( 'onderaannemer', __( 'Onderaannemer' ),            
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

    // add custom post type
    function custom_post_type() {

        $labels_gereedschappen = array(
            'name'                  => _x( 'Gereedschappen', 'Post Type General Name', 'ARTE-TECH' ),
            'singular_name'         => _x( 'Gereedschap', 'Post Type Singular Name', 'ARTE-TECH' ),
            'menu_name'             => __( 'Gereedschappen', 'ARTE-TECH' ),
            'name_admin_bar'        => __( 'Gereedschap', 'ARTE-TECH' ),
            'archives'              => __( 'Item Archives', 'ARTE-TECH' ),
            'attributes'            => __( 'Item Attributes', 'ARTE-TECH' ),
            'parent_item_colon'     => __( 'Parent Item:', 'ARTE-TECH' ),
            'all_items'             => __( 'All Gereedschappen', 'ARTE-TECH' ),
            'add_new_item'          => __( 'Add New Item', 'ARTE-TECH' ),
            'add_new'               => __( 'Add New', 'ARTE-TECH' ),
            'new_item'              => __( 'New Item', 'ARTE-TECH' ),
            'edit_item'             => __( 'Edit Item', 'ARTE-TECH' ),
            'update_item'           => __( 'Update Item', 'ARTE-TECH' ),
            'view_item'             => __( 'View Item', 'ARTE-TECH' ),
            'view_items'            => __( 'View Gereedschappen', 'ARTE-TECH' ),
            'search_items'          => __( 'Search Item', 'ARTE-TECH' ),
            'not_found'             => __( 'Not found', 'ARTE-TECH' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'ARTE-TECH' ),
            'featured_image'        => __( 'Featured Image', 'ARTE-TECH' ),
            'set_featured_image'    => __( 'Set featured image', 'ARTE-TECH' ),
            'remove_featured_image' => __( 'Remove featured image', 'ARTE-TECH' ),
            'use_featured_image'    => __( 'Use as featured image', 'ARTE-TECH' ),
            'insert_into_item'      => __( 'Insert into item', 'ARTE-TECH' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'ARTE-TECH' ),
            'items_list'            => __( 'Gereedschappen list', 'ARTE-TECH' ),
            'items_list_navigation' => __( 'Gereedschappen list navigation', 'ARTE-TECH' ),
            'filter_items_list'     => __( 'Filter Gereedschappen list', 'ARTE-TECH' ),
        );

        $args_gereedschappen = array(
            'label'                 => __( 'Gereedschap', 'ARTE-TECH' ),
            'description'           => __( 'Gereedschap type.', 'ARTE-TECH' ),
            'labels'                => $labels_gereedschappen ,
            'supports'              => array( 'title'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'gereedschap', $args_gereedschappen );


        $labels_activiteiten = array(
            'name'                  => _x( 'Activiteiten', 'Post Type General Name', 'ARTE-TECH' ),
            'singular_name'         => _x( 'Activiteit', 'Post Type Singular Name', 'ARTE-TECH' ),
            'menu_name'             => __( 'Activiteiten', 'ARTE-TECH' ),
            'name_admin_bar'        => __( 'Activiteit', 'ARTE-TECH' ),
            'archives'              => __( 'Item Archives', 'ARTE-TECH' ),
            'attributes'            => __( 'Item Attributes', 'ARTE-TECH' ),
            'parent_item_colon'     => __( 'Parent Item:', 'ARTE-TECH' ),
            'all_items'             => __( 'All Activiteiten', 'ARTE-TECH' ),
            'add_new_item'          => __( 'Add New Item', 'ARTE-TECH' ),
            'add_new'               => __( 'Add New', 'ARTE-TECH' ),
            'new_item'              => __( 'New Item', 'ARTE-TECH' ),
            'edit_item'             => __( 'Edit Item', 'ARTE-TECH' ),
            'update_item'           => __( 'Update Item', 'ARTE-TECH' ),
            'view_item'             => __( 'View Item', 'ARTE-TECH' ),
            'view_items'            => __( 'View Activiteiten', 'ARTE-TECH' ),
            'search_items'          => __( 'Search Item', 'ARTE-TECH' ),
            'not_found'             => __( 'Not found', 'ARTE-TECH' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'ARTE-TECH' ),
            'featured_image'        => __( 'Featured Image', 'ARTE-TECH' ),
            'set_featured_image'    => __( 'Set featured image', 'ARTE-TECH' ),
            'remove_featured_image' => __( 'Remove featured image', 'ARTE-TECH' ),
            'use_featured_image'    => __( 'Use as featured image', 'ARTE-TECH' ),
            'insert_into_item'      => __( 'Insert into item', 'ARTE-TECH' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'ARTE-TECH' ),
            'items_list'            => __( 'Activiteiten list', 'ARTE-TECH' ),
            'items_list_navigation' => __( 'Activiteiten list navigation', 'ARTE-TECH' ),
            'filter_items_list'     => __( 'Filter Activiteiten list', 'ARTE-TECH' ),
        );

        $args_activiteiten = array(
            'label'                 => __( 'Activiteit', 'ARTE-TECH' ),
            'description'           => __( 'Activiteit type.', 'ARTE-TECH' ),
            'labels'                => $labels_activiteiten,
            'supports'              => array( 'title'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 4,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'activiteit', $args_activiteiten );

        $labels_techlogs = array(
            'name'                  => _x( 'Techlogs', 'Post Type General Name', 'ARTE-TECH' ),
            'singular_name'         => _x( 'Techlog', 'Post Type Singular Name', 'ARTE-TECH' ),
            'menu_name'             => __( 'Techlogs', 'ARTE-TECH' ),
            'name_admin_bar'        => __( 'Techlog', 'ARTE-TECH' ),
            'archives'              => __( 'Item Archives', 'ARTE-TECH' ),
            'attributes'            => __( 'Item Attributes', 'ARTE-TECH' ),
            'parent_item_colon'     => __( 'Parent Item:', 'ARTE-TECH' ),
            'all_items'             => __( 'All Techlogs', 'ARTE-TECH' ),
            'add_new_item'          => __( 'Add New Item', 'ARTE-TECH' ),
            'add_new'               => __( 'Add New', 'ARTE-TECH' ),
            'new_item'              => __( 'New Item', 'ARTE-TECH' ),
            'edit_item'             => __( 'Edit Item', 'ARTE-TECH' ),
            'update_item'           => __( 'Update Item', 'ARTE-TECH' ),
            'view_item'             => __( 'View Item', 'ARTE-TECH' ),
            'view_items'            => __( 'View Techlogs', 'ARTE-TECH' ),
            'search_items'          => __( 'Search Item', 'ARTE-TECH' ),
            'not_found'             => __( 'Not found', 'ARTE-TECH' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'ARTE-TECH' ),
            'featured_image'        => __( 'Featured Image', 'ARTE-TECH' ),
            'set_featured_image'    => __( 'Set featured image', 'ARTE-TECH' ),
            'remove_featured_image' => __( 'Remove featured image', 'ARTE-TECH' ),
            'use_featured_image'    => __( 'Use as featured image', 'ARTE-TECH' ),
            'insert_into_item'      => __( 'Insert into item', 'ARTE-TECH' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'ARTE-TECH' ),
            'items_list'            => __( 'Techlogs list', 'ARTE-TECH' ),
            'items_list_navigation' => __( 'Techlogs list navigation', 'ARTE-TECH' ),
            'filter_items_list'     => __( 'Filter Techlogs list', 'ARTE-TECH' ),
        );

        $args_techlogs = array(
            'label'                 => __( 'Techlog', 'ARTE-TECH' ),
            'description'           => __( 'Techlog type.', 'ARTE-TECH' ),
            'labels'                => $labels_techlogs ,
            'supports'              => array( 'title', 'custom-fields' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 3,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'techlog', $args_techlogs );
    }
    add_action( 'init', 'custom_post_type', 0 );
/*
    // show acf fields into REST API    
    $post_type = "techlog";
    function my_rest_prepare_post($data, $post, $request) {
        $_data = $data->data;
        $fields = get_fields($post->ID);
        foreach ($fields as $key => $value) {
            $_data[$key] = get_field($key, $post->ID);
        }
        $data->data = $_data;
        return $data;
    }
    add_filter("rest_prepare_{$post_type}", 'my_rest_prepare_post', 10, 3);*/

    // Enable the option edit in rest
    add_filter( 'acf/rest_api/field_settings/edit_in_rest', '__return_true' );
    // embeds all meta keys in the post object so we can retrieve them through WP-API without authentication


    // redirect user after login based on role :) [!!]


    // add navigation
    


    // customize login page :)

?>