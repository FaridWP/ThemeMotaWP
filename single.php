<?php

/**
 * Template Name: Single Custom Post Template
 * Template Post Type: photo
 */

get_header();


// Récupérer le contenu du champ personnalisé avec ACF
$type = get_field('type');
$reference = get_field('reference');
$annee = get_field('annee');
$image = get_the_post_thumbnail(get_the_ID(), 'full'); // 'full' récupère la taille d'origine de l'image

// Afficher les données récupérées
if ($type) {
	echo '<h2>' . esc_html($type) . '</h2>';
}

if ($reference) {
	echo '<p>' . esc_html($reference) . '</p>';
}
if ($annee) {
	echo '<p>' . esc_html($annee) . '</p>';
}
// Vérifier si l'image mise en avant existe pour le post actuel
if (has_post_thumbnail()) {
	// Récupérer l'image mise en avant
	$image = get_the_post_thumbnail(get_the_ID(), 'full');

	// Afficher l'image mise en avant
	if ($image) {
		echo $image;
	}
}

// Affichage du petit slider photo
$prev_post = get_previous_post();
$next_post = get_next_post();

if (!empty($prev_post)) {
	echo '<a href="' . get_permalink($prev_post->ID) . '" class="prev-post-link">Previous</a>';
	echo '<img src="' . get_the_post_thumbnail_url($prev_post->ID) . '" class="prev-post-thumbnail" style="display: none;">';
}

if (!empty($next_post)) {
	echo '<a href="' . get_permalink($next_post->ID) . '" class="next-post-link">Next</a>';
	echo '<img src="' . get_the_post_thumbnail_url($next_post->ID) . '" class="next-post-thumbnail" style="display: none;">';
}


// NE PAS TOUCHER
// Catégorie du post actuel
$categories = get_the_category();
$category = !empty($categories) ? $categories[0]->term_id : '';

// Query pour afficher 2 posts(images) de la catégorie actuelle
$related_posts_args = array(
	'post_type' => 'photo',
	'posts_per_page' => 2,
	'cat' => $category,
	'post__not_in' => array(get_the_ID()), // Exclure l'image du post actuel
	'orderby' => 'rand',
);

$related_posts_query = new WP_Query($related_posts_args);

// S'il y a des posts semblablent, les afficher
if ($related_posts_query->have_posts()) :
?>
	<div>
		<h3>VOUS AIMEREZ AUSSI</h3>
		<ul>
			<?php while ($related_posts_query->have_posts()) : $related_posts_query->the_post(); ?>
				<li>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php if (has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('thumbnail'); ?>
						</a>
					<?php endif; ?>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>
<?php
	// Reset post data
	wp_reset_postdata();
endif;

get_footer();
