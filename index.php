<?php get_header(); ?>

<section class="accueil">
    <?php

    // Obtenir les images des articles aléatoires pour le Header
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'orderby' => 'rand',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

            // Obtenir l'ID de l'image sélectionnée
            $image_id = get_post_thumbnail_id();

            if ($image_id) {
                $image_url = wp_get_attachment_image_url($image_id, 'full'); // Obtenir l'URL de l'image
                echo '<div class="hero__header">';
                echo '<h1 class="hero__header--text">PHOTOGRAPHE EVENT</h1>';
                echo '<img class="hero__header--photo" src="' . $image_url . '" alt="' . get_the_title() . '">';
                echo '</div>';
            }

        endwhile;
    endif;


    wp_reset_postdata();

    ?>


</section>


<?php
// if (have_posts()) :
//     while (have_posts()) : the_post();

//         get_template_part('content-page', get_post_format());

//     endwhile;
// endif;
?>

<?php get_footer(); ?>