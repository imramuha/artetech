<?php
/*
 * Proper way to enqueue scripts and styles
*/
    function artetech_enqueue_scripts() {
        /* integration of CSS/JS */
        wp_enqueue_style('style', get_stylesheet_directory_uri().'/assets/css/build/app.min.css', false, 'all' );
        wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js//build/app.min.js', null , null , true);
        wp_enqueue_style( 'load-fa', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css' );
    }

    add_action ('wp_enqueue_scripts', 'artetech_enqueue_scripts');

    function my_login_stylesheet() {
        wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/css/build/app.min.css' );
        // wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );
    }
    add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );
    
    // add routing
    Routes::map('login', function(){
        Routes::load('login.php', null, null, 200);
    });

    Routes::map('/', function(){
        Routes::load('dashboard.php', null, null, 200);
    });
    

    Routes::map('periodes', function(){
        Routes::load('periodes.php', null, null, 200);
    });

    Routes::map('periode/:id', function(){
        Routes::load('periode.php', null, null, 200);
    });

    // redirect to auth if not logged in
    function redirect_to_specific_page() {

        if ( !is_user_logged_in() ) {
            auth_redirect();
        } 
    }

    add_action( 'template_redirect', 'redirect_to_specific_page' );

    // redirect fter lohout 
    function ps_redirect_after_logout(){
        wp_redirect( '/' );
        exit();
    }

    add_action('wp_logout','ps_redirect_after_logout');

    // add custom logo yo wp-admin
    function wpb_login_logo() { 
        ?>
            <style type="text/css">
                #login h1 a, .login h1 a {
                    background-image: url("/wp-content/themes/artetech/assets/logo_white.svg");
                    height:100px;
                    width:300px;
                    background-size: 300px 100px;
                    background-repeat: no-repeat;
                    padding-bottom: 10px;
                }
            </style>
        <?php 
    }
    
    add_action( 'login_enqueue_scripts', 'wpb_login_logo' );

    // add home url to the login logo instead of wordpress
    function my_login_logo_url() {
        return home_url();
    }
    add_filter( 'login_headerurl', 'my_login_logo_url' );

    // hide the admin bar for not related users 
    add_action('after_setup_theme', 'remove_admin_bar_user');
    function remove_admin_bar_user() {
        if (current_user_can('administrator') || is_admin() ) {
            show_admin_bar(true);
        } else{
            show_admin_bar(false);
        }
      
    }

    // add multiple roles & set the capabilities [!!]
    function artetech_add_role() {
        add_role( 'administrator', __( 'Administrator' ),        
            array(        
                'read' => true, // true allows this capability
                'edit_posts' => true, // Allows user to edit their own posts
                'edit_pages' => true, // Allows user to edit pages
                'edit_others_posts' => true, // Allows user to edit others posts not just their own
                'create_posts' => true, // Allows user to create new posts
                "list_users" => false,
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
                "list_users" => true,
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
                "list_users" => true,
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
                "list_users" => true,
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
            'menu_position'         => 2,
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

        $labels_periodes = array(
            'name'                  => _x( 'Periodes', 'Post Type General Name', 'ARTE-TECH' ),
            'singular_name'         => _x( 'Periode', 'Post Type Singular Name', 'ARTE-TECH' ),
            'menu_name'             => __( 'Periodes', 'ARTE-TECH' ),
            'name_admin_bar'        => __( 'Periode', 'ARTE-TECH' ),
            'archives'              => __( 'Item Archives', 'ARTE-TECH' ),
            'attributes'            => __( 'Item Attributes', 'ARTE-TECH' ),
            'parent_item_colon'     => __( 'Parent Item:', 'ARTE-TECH' ),
            'all_items'             => __( 'All Periodes', 'ARTE-TECH' ),
            'add_new_item'          => __( 'Add New Item', 'ARTE-TECH' ),
            'add_new'               => __( 'Add New', 'ARTE-TECH' ),
            'new_item'              => __( 'New Item', 'ARTE-TECH' ),
            'edit_item'             => __( 'Edit Item', 'ARTE-TECH' ),
            'update_item'           => __( 'Update Item', 'ARTE-TECH' ),
            'view_item'             => __( 'View Item', 'ARTE-TECH' ),
            'view_items'            => __( 'View Periodes', 'ARTE-TECH' ),
            'search_items'          => __( 'Search Item', 'ARTE-TECH' ),
            'not_found'             => __( 'Not found', 'ARTE-TECH' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'ARTE-TECH' ),
            'featured_image'        => __( 'Featured Image', 'ARTE-TECH' ),
            'set_featured_image'    => __( 'Set featured image', 'ARTE-TECH' ),
            'remove_featured_image' => __( 'Remove featured image', 'ARTE-TECH' ),
            'use_featured_image'    => __( 'Use as featured image', 'ARTE-TECH' ),
            'insert_into_item'      => __( 'Insert into item', 'ARTE-TECH' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'ARTE-TECH' ),
            'items_list'            => __( 'Periodes list', 'ARTE-TECH' ),
            'items_list_navigation' => __( 'Periodes list navigation', 'ARTE-TECH' ),
            'filter_items_list'     => __( 'Filter Periodes list', 'ARTE-TECH' ),
        );

        $args_periodes = array(
            'label'                 => __( 'Periode', 'ARTE-TECH' ),
            'description'           => __( 'Periode type.', 'ARTE-TECH' ),
            'labels'                => $labels_periodes ,
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
  
        register_post_type( 'periode', $args_periodes );

        $labels_kosten= array(
            'name'                  => _x( 'Kosten', 'Post Type General Name', 'ARTE-TECH' ),
            'singular_name'         => _x( 'Kost', 'Post Type Singular Name', 'ARTE-TECH' ),
            'menu_name'             => __( 'Kosten', 'ARTE-TECH' ),
            'name_admin_bar'        => __( 'Kost', 'ARTE-TECH' ),
            'archives'              => __( 'Item Archives', 'ARTE-TECH' ),
            'attributes'            => __( 'Item Attributes', 'ARTE-TECH' ),
            'parent_item_colon'     => __( 'Parent Item:', 'ARTE-TECH' ),
            'all_items'             => __( 'All Kosten', 'ARTE-TECH' ),
            'add_new_item'          => __( 'Add New Item', 'ARTE-TECH' ),
            'add_new'               => __( 'Add New', 'ARTE-TECH' ),
            'new_item'              => __( 'New Item', 'ARTE-TECH' ),
            'edit_item'             => __( 'Edit Item', 'ARTE-TECH' ),
            'update_item'           => __( 'Update Item', 'ARTE-TECH' ),
            'view_item'             => __( 'View Item', 'ARTE-TECH' ),
            'view_items'            => __( 'View Kosten', 'ARTE-TECH' ),
            'search_items'          => __( 'Search Item', 'ARTE-TECH' ),
            'not_found'             => __( 'Not found', 'ARTE-TECH' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'ARTE-TECH' ),
            'featured_image'        => __( 'Featured Image', 'ARTE-TECH' ),
            'set_featured_image'    => __( 'Set featured image', 'ARTE-TECH' ),
            'remove_featured_image' => __( 'Remove featured image', 'ARTE-TECH' ),
            'use_featured_image'    => __( 'Use as featured image', 'ARTE-TECH' ),
            'insert_into_item'      => __( 'Insert into item', 'ARTE-TECH' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'ARTE-TECH' ),
            'items_list'            => __( 'Kosten list', 'ARTE-TECH' ),
            'items_list_navigation' => __( 'Kosten list navigation', 'ARTE-TECH' ),
            'filter_items_list'     => __( 'Filter Kosten list', 'ARTE-TECH' ),
        );

        $args_kosten = array(
            'label'                 => __( 'Kost', 'ARTE-TECH' ),
            'description'           => __( 'Kost type.', 'ARTE-TECH' ),
            'labels'                => $labels_kosten ,
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
  
        register_post_type( 'kost', $args_kosten );
    }
    add_action( 'init', 'custom_post_type', 0 );

    // Enable the option edit in rest
    add_filter( 'acf/rest_api/field_settings/edit_in_rest', '__return_true' );

    // Verstuur een email naar de klant wanneer er een periode voor hem opgesteld wordt!
    function notify_client($post_ID)  {
        // a conditional to check that this is a new post

        if( ( $_POST['post_status'] == 'publish' ) && ( $_POST['original_post_status'] != 'publish' ) ) {

            $fields = get_fields( 227 );
            //print_r($fields);

            $klant_ID = $fields['klant'];
            // what is this??
            $klant = get_user_by( 'id', 5);


            $user_email_address = $klant->user_email;
        
            // create the from details 
            $headers[] = 'From: ARTETECH <manager@artetech.be>';
            // lets cc in the head just because we can 
            // separate the users array
            $send_to = $user_email_address;
            // concatenate a message together
            $message = 'Er is een nieuwe periode toegevoegd voor jou, gelieve die te controleren en bevestigen op de website van www.artetech.be';
            // and finally send the email
            wp_mail($send_to, "Text Message", $message, $headers );
            return $post_ID;
        }
    }

    add_action('publish_periode', 'notify_client');

    // UPDATE/ONDERTEKEN periode/techlogs
    function your_function_to_process_form(){

        $post = $_POST;

        $id = $post['id'];
        $techlogsperiode = json_decode($post['ids']);        
        $commentaar = $post['comment'];
        
        $techlogsperiode_key = "techlogsperiode";
        $techlogsperiode_value = $techlogsperiode;

        update_field( $techlogsperiode_key, $techlogsperiode_value, $id);
        
        $commentaar_key = "commentaar";
        $commentaar_value = $commentaar;

        update_field( $commentaar_key, $commentaar_value, $id);

        $ondertekend_key = "ondertekend";
        $ondertekend_value = true;

        update_field( $ondertekend_key, $ondertekend_value, $id);

        wp_redirect('/');
    }

    add_action( 'admin_post_your_action_name', 'your_function_to_process_form' );

    function add_my_capabilities_oa($cap){
        $role = get_role('onderaannemer');
        $role->add_cap($cap);
   }
   add_my_capabilities_oa('list_users');

   function add_my_capabilities_mw($cap){
        $role = get_role('medewerker');
        $role->add_cap($cap);
    }
    add_my_capabilities_mw('list_users');

    function add_my_capabilities_kl($cap){
        $role = get_role('klant');
        $role->add_cap($cap);
    }
   
   add_my_capabilities_kl('list_users');

?>