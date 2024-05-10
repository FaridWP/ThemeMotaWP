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



    // Récupération des champs ACF pour les tri Selects/Options
    $categories = array(
        'taxonomy' => 'categorie',
    );

    $cats = get_categories($categories);

    $formats = array(
        'taxonomy' => 'format',
    );

    $forms = get_categories($formats);

    ?>


    <div class="gallery">
        <div class="gallery__inputs">

            <div class="gallery__inputs__filters">
                <div class="custom-select" onclick="toggleDropdown()">
                    <div class="selected-option" id="categorie-option">Catégories</div>
                    <div class="arrow"><?php echo '<img class="arrow__cat" src="' . get_stylesheet_directory_uri() . '/assets/images/chevron-down-s.png' . '" alt="flèche filtre">'; ?></div>

                    <div class="dropdown-content" id="categorieDropdown" style="display: none;">
                        <?php foreach ($cats as $cat) { ?>
                            <div class="option cat" value="<?php echo $cat->slug; ?>" onclick="selectOption('<?php echo $cat->name; ?>')"><?php echo $cat->name; ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="custom-select" onclick="toggleDropdownFormat()">
                    <div class="selected-option-format">Formats</div>
                    <div class="arrow"><?php echo '<img class="arrow__format" src="' . get_stylesheet_directory_uri() . '/assets/images/chevron-down-s.png' . '" alt="flèche filtre">'; ?></div>

                    <div class="dropdown-content" id="formatDropdown" style="display: none;">
                        <?php foreach ($forms as $form) { ?>
                            <div class="option format" value="'<?php echo $form->slug; ?>'" onclick="selectOptionFormat('<?php echo $form->name; ?>')"><?php echo $form->name; ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="gallery__inputs__date">
                <div class="custom-select" onclick="toggleDropdownDate()">
                    <div class="selected-option-date">Trier par</div>
                    <div class="arrow"><?php echo '<img class="arrow__date" src="' . get_stylesheet_directory_uri() . '/assets/images/chevron-down-s.png' . '" alt="flèche filtre">'; ?></div>

                    <div class="dropdown-content" id="dateDropdown" style="display: none;">
                        <div class="option date" onclick="selectOptionDate('à partir des plus récentes')" value="new">à partir des plus récentes</div>
                        <div class="option date" onclick="selectOptionDate('à partir des plus anciennes')" value="old">à partir des plus anciennes</div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="gallery__photos">
        <section class="container__bottom">
            <!-- Affichage de la gallerie ici avec appel AJAX (init.js / script-home.js) -->
        </section>
    </div>

</section>


<?php get_footer(); ?>