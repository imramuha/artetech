<?php
$context = Timber::get_context();

$context['periode'] = new TimberPost();



// get techlogs between the sent period..
$current_user_id= get_current_user_id();

// var_dump($context);
$startdatum = $context['periode']->startdatum;
$eindatum = $context['periode']->einddatum;
// var_dump($startdatum, $eindatum);

$context['techlogs'] = Timber::get_posts(
    array(
        'post_type' => 'techlog',
        'meta_query' => array(
            array(
                'key'   => 'klant',
                'value' => $current_user_id,
            ),
            array(
                'key' => 'datum',
                // value should be array of (lower, higher) with BETWEEN
                'value' => array( $startdatum, $eindatum),
                'compare' => 'BETWEEN',
            ),
        )
    ));

$context['action'] = esc_url( admin_url('admin-post.php') );

$context['techlog_ids'] = array();

foreach($context['techlogs'] as $techlog) {
    array_push($context['techlog_ids'], $techlog->ID);
}

$context['techlog_ids'] = json_encode($context['techlog_ids']);


// var_dump($context['periode']->startdatum);
Timber::render('periode.twig', $context);