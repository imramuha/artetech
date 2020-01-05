<?php
    $context = Timber::get_context();

    $current_user_id= get_current_user_id();

    $context['periodes'] = Timber::get_posts(
        array(
            'post_type' => 'periode',
            'meta_query' => array(
                array(
                    'key'   => 'klantperiode',
                    'value' => $current_user_id,
                )
            )
        ));
 
    Timber::render('periodes.twig', $context);
