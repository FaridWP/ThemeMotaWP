<?php get_header(); ?>
<h1>Accueil</h1>
<?php
if (have_posts()) :
    while (have_posts()) : the_post();

        get_template_part('content-page', get_post_format());

    endwhile;
endif;



?>
<?php get_footer(); ?>