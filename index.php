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

    <div class="gallery">
        <div class="gallery__inputs">
            <div class="gallery__inputs__filters">
                <div class="gallery__inputs__filters--category">
                    <?php
                    $categories = array(
                        'taxonomy' => 'categorie',
                    );

                    $cats = get_categories($categories);
                    ?>
                    <form id="sort-category" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post">
                        <select name="categorie" id="sort-taxonomy">
                            <option value="">Catégories</option>
                            <?php foreach ($cats as $cat) { ?>
                                <option value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
                            <?php } ?>
                        </select>
                    </form>

                </div>
                <div class="gallery__inputs__filters--format">
                    <?php
                    $formats = array(
                        'taxonomy' => 'format',
                    );

                    $forms = get_categories($formats);
                    ?>

                    <select name="format">
                        <option value="">Formats</option>
                        <?php foreach ($forms as $form) { ?>
                            <option value="<?php echo $form->name; ?>"><?php echo $form->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="gallery__inputs__date">
                <select name="date">
                    <option value="new">Trier par</option>
                    <option value="new">à partir des plus récentes</option>
                    <option value="old">à partir des plus anciennes</option>
                </select>
            </div>
        </div>
        <div class="gallery__photos"></div>
    </div>
    <div id="filtered-posts">
        <!-- Les posts triés seront affichés ici -->
    </div>
</section>

<?php
// if (have_posts()) :
//     while (have_posts()) : the_post();

//         get_template_part('content-page', get_post_format());

//     endwhile;
// endif;
?>

<?php get_footer(); ?>