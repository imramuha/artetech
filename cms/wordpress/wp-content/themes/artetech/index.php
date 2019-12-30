<!-- HEADER -->
<?php get_header(); ?>

<!-- Roep de homepagine-template op -->
<?php //get_template_part('dashboard'); 
$context = array();

$current_user_id= get_current_user_id();

$context['techlogs'] = Timber::get_posts(
    array(
        'post_type' => 'techlog',
        'meta_query' => array(
            array(
                'key'   => 'klant',
                'value' => $current_user_id,
            )
        )
    ));

Timber::render('index.twig', $context);
?>

<!-- FOOTER -->
<?php get_footer(); ?> 