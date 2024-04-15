<?php

/**
 * Template Name: Single Custom Post Template
 * Template Post Type: photo
 */

get_header();
?>
<section class="single__post">
	<?php
	$titre = get_the_title();
	// $format = get_post_format();
	$terms = get_the_terms(get_the_ID(), 'categorie');
	$formats = get_the_terms(get_the_ID(), 'format');
	// Catégorie du post actuel
	$categories = get_the_category();
	// $category = !empty($categories) ? $categories[0]->term_id : '';


	// Récupérer le contenu du champ personnalisé avec ACF
	$type = get_field('type');
	$reference = get_field('reference');
	$annee = get_field('annee');
	$image = get_the_post_thumbnail(get_the_ID(), 'full'); // 'full' récupère la taille d'origine de l'image

	?>
	<section class="container__top">
		<div class="container__top__text">
			<?php
			// Afficher les données récupérées
			if ($titre) {
				echo '<h2>' . esc_html($titre) . '</h2>';
			}
			if ($reference) {
				echo '<p class="titre-photo">Référence :<span id="reference"> ' . esc_html($reference) . '</span></p>';
			}

			if ($terms && !is_wp_error($terms)) {
				echo '<ul>';
				foreach ($terms as $term) {
					echo '<li class="titre-photo">Catégorie : ' . esc_html($term->name) . '</li>';
				}
				echo '</ul>';
			}
			if ($formats && !is_wp_error($formats)) {
				echo '<ul>';
				foreach ($formats as $format) {
					echo '<li class="titre-photo">Format : ' . esc_html($format->name) . '</li>';
				}
				echo '</ul>';
			}
			if ($type) {
				echo '<p class="titre-photo">Type : ' . esc_html($type) . '</p>';
			}
			if ($annee) {
				echo '<p class="titre-photo">Année : ' . esc_html($annee) . '</p>';
			}
			?>
			<div class="container__top__text--line"></div>
		</div>
		<div class="container__top__img">
			<?php
			// Vérifier si l'image mise en avant existe pour le post actuel
			if (has_post_thumbnail()) {
				// Récupérer l'image mise en avant
				$image = get_the_post_thumbnail(get_the_ID(), 'full');

				// Afficher l'image mise en avant
				if ($image) {
					echo $image;
				}
			}
			?>
		</div>
	</section>



	<section class="container__button">
		<!-- Bouton Contact -->
		<div class="container__button__contact">
			<div class="container__button__contact--text">
				<p>Cette photo vous intéresse ?</p>
			</div>
			<div class="container__button__contact--btn">
				<button type="button" class="contact_photo">Contact</button>
			</div>
		</div>

		<div class="container__button__slider">
			<?php
			/*
			// Affichage du petit slider photo
			$prev_post = get_previous_post();
			$next_post = get_next_post();
			$left_arrow = get_stylesheet_directory_uri() . '/assets/images/left_arrow.png';
			$right_arrow = get_stylesheet_directory_uri() . '/assets/images/right_arrow.png';



			if (!empty($prev_post)) {
				echo '<button class="left_arrow"><a href="' . get_permalink($prev_post->ID) . '" class="prev-post-link"><img class="" src="' . $left_arrow . '"  /></a></button>';
				echo '<img src="' . get_the_post_thumbnail_url($prev_post->ID) . '" class="prev-post-thumbnail" style="display: none;">';
			}

			if (!empty($next_post)) {
				echo '<button class="right_arrow"><a href="' . get_permalink($next_post->ID) . '" class="next-post-link"><img class="" src="' . $right_arrow . '"  /></a></button>';
				echo '<img src="' . get_the_post_thumbnail_url($next_post->ID) . '" class="next-post-thumbnail" style="display: none;">';
			}
			*/
			// Définir les arguments de la requête pour récupérer les articles triés par le champ ACF
			$args = array(
				'post_type' => 'photo',
				'posts_per_page' => -1, // Récupérer tous les articles
				'meta_key' => 'annee',
				'orderby' => 'meta_value', // Tri par la valeur du champ ACF (date)
				'order' => 'ASC', // Tri en ordre croissant
				'meta_type' => 'DATE', // Type du champ ACF
			);

			$query = new WP_Query($args);

			// Récupérer les ID des articles triés dans un tableau
			$post_ids = array();
			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post();
					$post_ids[] = get_the_ID();
				}
				wp_reset_postdata(); // Réinitialise les données de la requête
			}

			// Trouver la position actuelle de l'article dans le tableau trié
			$current_index = array_search(get_the_ID(), $post_ids);

			// Récupérer les ID des articles précédent et suivant dans le tableau trié
			$prev_post_id = isset($post_ids[$current_index - 1]) ? $post_ids[$current_index - 1] : null;
			$next_post_id = isset($post_ids[$current_index + 1]) ? $post_ids[$current_index + 1] : null;


			// Afficher les liens précédent et suivant avec des classes pour les miniatures
			$left_arrow = get_stylesheet_directory_uri() . '/assets/images/left_arrow.png';
			$right_arrow = get_stylesheet_directory_uri() . '/assets/images/right_arrow.png';

			if ($prev_post_id) {
				echo '<button class="left_arrow"><a href="' . get_permalink($prev_post_id) . '" class="prev-post-link"><img class="" src="' . $left_arrow . '"  /></a></button>';
			}
			echo '<img src="' . get_the_post_thumbnail_url($prev_post_id) . '" class="prev-post-thumbnail" style="display: none;">';

			if ($next_post_id) {
				echo '<button class="right_arrow"><a href="' . get_permalink($next_post_id) . '" class="next-post-link"><img class="" src="' . $right_arrow . '"  /></a></button>';
			}
			echo '<img src="' . get_the_post_thumbnail_url($next_post_id) . '" class="next-post-thumbnail" style="display: none;">';


			?>
		</div>
	</section>


	<?php

	// NE PAS TOUCHER
	// Query pour afficher 2 posts(images) de la catégorie actuelle

	$cats = wp_get_post_terms(get_the_ID(), 'categorie');


	$related_posts_args = array(
		'post_type' => 'photo',
		'posts_per_page' => 2,
		'tax_query' => array(
			array(
				'taxonomy' => 'categorie', // le custom vocabulary des taxonomies
				'field'    => 'slug',
				'terms'    => array($cats[0]->slug), // prend le premier slug
			),
		),
		'post__not_in' => array(get_the_ID()), // Exclure l'image du post actuel
		'orderby' => 'rand',
	);

	$related_posts_query = new WP_Query($related_posts_args);

	// S'il y a des posts semblablent, les afficher
	if ($related_posts_query->have_posts()) :
	?>
		<section class="container__bottom">
			<h3>VOUS AIMEREZ AUSSI</h3>
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
		</section>
	<?php
		// Reset post data
		wp_reset_postdata();
	endif;

	/*
	if ($related_posts_query->have_posts()) :
		?>
			<section class="container__bottom">
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
			</section>
		<?php
			// Reset post data
			wp_reset_postdata();
		endif;
*/
	?>
</section>
<?php
get_footer();
