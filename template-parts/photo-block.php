<?php

/**
 * Template part for displaying block photo
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NathalieMota
 */
?>
<?php $related_posts_query = get_query_var('query_photos'); ?>

<ul>
    <?php while ($related_posts_query->have_posts()) : $related_posts_query->the_post(); ?>
        <li class="block__photo__item">
            <?php if (has_post_thumbnail()) : ?>
                <div id="overlay__photo" class="overlay">
                    <div class="overlay__icon__lightbox">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Icon_fullscreen.png'; ?>">
                    </div>
                    <div class="overlay__icon__eye">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Icon_eye.png'; ?>"></a>
                    </div>
                    <div class="overlay__text">
                        <p class="titre-photo"><?php echo get_field('reference') ?></p>
                        <p class="titre-photo"><?php echo array_shift(get_the_terms(get_the_ID(), 'categorie'))->name ?></p>
                    </div>
                </div>
                <a class="overlay__on" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full'); ?>
                </a>
            <?php endif; ?>
        </li>
    <?php endwhile; ?>
</ul>