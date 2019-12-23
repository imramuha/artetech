<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ARTE-TECH</title>

        <?php wp_head(); ?>
    </head>

    <!-- to add a class to our body -->
    <body <?php echo body_class(); ?> >
    <!-- Roep de navigatie op-->
    <h1>ARTE-TECH HEADER</h1>
    <?php get_template_part( 'templates/navigation/navigation-template' ); ?>
