<?php

/**
 *
 * Text Domain: nathaliemota
 * @link http://codex.wordpress.org/Plugin_API
 *
 */

//  Chargement CSS
function nathaliemota_style()
{
	wp_enqueue_style('nathalie-style', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('hamburger', get_stylesheet_directory_uri() . '/assets/dist/hamburgers.min.css');
	wp_enqueue_style('select2CSS', get_stylesheet_directory_uri() . '/assets/dist/select2.min.css');
}
add_action('wp_enqueue_scripts', 'nathaliemota_style');

// Chargement de Jquery CDN -- Fix Jquery is not defined
function jqueryCDN()
{
	wp_enqueue_script('jqueryCDN', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);
}
add_action('wp_enqueue_scripts', 'jqueryCDN');



// Chargement Scripts JS
add_action('wp_enqueue_scripts', 'nathaliemota_script');
function nathaliemota_script()
{
	if (is_home()) {
		wp_enqueue_script('script_home', get_stylesheet_directory_uri() . '/assets/js/script-home.js', ['jquery'], '6.5.2', true);
	}
	wp_enqueue_script('mon_script', get_stylesheet_directory_uri() . '/assets/js/script.js', ['jquery'], '6.5.2', true);
	wp_localize_script('mon_script', 'mon_script_js', array('ajax_url' => admin_url('admin-ajax.php')));
	// wp_localize_script('mon_script', 'ajaxurl', admin_url('admin-ajax.php'));
}





function nathaliemota_config()
{
	add_theme_support('custom-logo', array(
		'height' => 22,
		'width' => 345,
		'flex-height' => true,
		'flex-width' => true
	));

	register_nav_menus(
		array(
			'nathaliemota_menu' => 'Main Menu',
			'footer_menu' => 'Footer Menu',
		)
	);
}
add_action('after_setup_theme', 'nathaliemota_config', 0);


function cptui_register_my_cpts_photo()
{

	/**
	 * Post Type: Photos.
	 */

	$labels = [
		"name" => esc_html__("Photos", "nathaliemota"),
		"singular_name" => esc_html__("Photo", "nathaliemota"),
		"menu_name" => esc_html__("Mes photos", "nathaliemota"),
		"all_items" => esc_html__("Toues les photos", "nathaliemota"),
		"add_new" => esc_html__("Ajouter photo", "nathaliemota"),
		"add_new_item" => esc_html__("Ajouter une nouvelle photo", "nathaliemota"),
		"edit_item" => esc_html__("Modifier la photo", "nathaliemota"),
		"new_item" => esc_html__("Nouvelle photo", "nathaliemota"),
		"view_item" => esc_html__("Voir la photo", "nathaliemota"),
		"view_items" => esc_html__("Voir les photos", "nathaliemota"),
		"search_items" => esc_html__("Rechercher des photos", "nathaliemota"),
		"not_found" => esc_html__("Aucune photo trouvée", "nathaliemota"),
		"not_found_in_trash" => esc_html__("Aucune photo trouvée dans la corbeille", "nathaliemota"),
		"parent" => esc_html__("Photo parent :", "nathaliemota"),
		"featured_image" => esc_html__("Image mise en avant pour cette photo", "nathaliemota"),
		"set_featured_image" => esc_html__("Définir image mise en avant pour cette photo", "nathaliemota"),
		"remove_featured_image" => esc_html__("Retirer image mise en avant pour cette photo", "nathaliemota"),
		"use_featured_image" => esc_html__("Utiliser image mise en avant pour cette photo", "nathaliemota"),
		"archives" => esc_html__("Archive de photo", "nathaliemota"),
		"insert_into_item" => esc_html__("Insérer dans la photo", "nathaliemota"),
		"uploaded_to_this_item" => esc_html__("Televerser cette photo", "nathaliemota"),
		"filter_items_list" => esc_html__("Filtrer la liste des photos", "nathaliemota"),
		"items_list_navigation" => esc_html__("Navigation de liste des photos", "nathaliemota"),
		"items_list" => esc_html__("Liste des photos", "nathaliemota"),
		"attributes" => esc_html__("Attributs des photos", "nathaliemota"),
		"name_admin_bar" => esc_html__("Photo", "nathaliemota"),
		"item_published" => esc_html__("Photo publiée", "nathaliemota"),
		"item_published_privately" => esc_html__("Photo publiée en privé", "nathaliemota"),
		"item_reverted_to_draft" => esc_html__("Photo repassée en brouillon", "nathaliemota"),
		"item_trashed" => esc_html__("Photo supprimée", "nathaliemota"),
		"item_scheduled" => esc_html__("Photo planifiée", "nathaliemota"),
		"item_updated" => esc_html__("Photo mise à jour", "nathaliemota"),
		"parent_item_colon" => esc_html__("Photo parent :", "nathaliemota"),
	];

	$args = [
		"label" => esc_html__("Photos", "nathaliemota"),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => false,
		"rewrite" => ["slug" => "photo", "with_front" => true],
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-format-image",
		"supports" => ["title", "editor", "thumbnail", "author"],
		"taxonomies" => ["categorie", "format"],
		"show_in_graphql" => false,
	];

	register_post_type("photo", $args);
}

add_action('init', 'cptui_register_my_cpts_photo');


// Ajax Base
function nathaliemota_request_photos()
{
	$args = array('post_type' => 'photo', 'post_per_page' => -1);
	$query = new WP_Query($args);
	if ($query->have_posts()) {
		$response = $query;
	} else {
		$response = false;
	}

	wp_send_json($response);
	wp_die();
}
add_action('wp_ajax_request_photos', 'nathaliemota_request_photos');
add_action('wp_ajax_nopriv_request_photos', 'nathaliemota_request_photos');


// Ajax Tri par Catégorie
function nathaliemota_tri_categories()
{

	$args = array(
		'post_type' => 'photo',
		'order' => 'ASC',
		'posts_per_page' => 8
	);

	$args['tax_query'] = array(
		array(
			'taxonomy' => 'categorie',
			'field'    => 'slug',
			'terms'    => $_POST['sort'],
		),
	);


	// Requête triée
	$posts = new WP_Query($args);
	// Création de la variable pour le template part
	set_query_var('query_photos', $posts);

	// Affichage des posts
	if ($posts->have_posts()) :

		echo get_template_part('template-parts/photo', 'block');

		if ($posts->found_posts >= 8) :
			// Affichage du bouton
			echo '<div class="button__home">
            <button class="button__home__btn">Charger plus</button>
        </div>';
		endif;

	else :
		echo 'Aucun post trouvé !';
	endif;

	wp_die();
}
add_action('wp_ajax_tri_categories', 'nathaliemota_tri_categories');
add_action('wp_ajax_nopriv_tri_categories', 'nathaliemota_tri_categories');

// Ajax Tri par Format
function nathaliemota_tri_format()
{

	$args = array(
		'post_type' => 'photo',
		'order' => 'ASC',
		'posts_per_page' => 8
	);

	$args['tax_query'] = array(
		array(
			'taxonomy' => 'format',
			'field'    => 'slug',
			'terms'    => $_POST['sort'],
		),
	);


	// Requête triée
	$posts = new WP_Query($args);
	// Création de la variable pour le template part
	set_query_var('query_photos', $posts);

	// Affichage des posts
	if ($posts->have_posts()) :

		echo get_template_part('template-parts/photo', 'block');

		if ($posts->found_posts >= 8) :
			// Affichage du bouton
			echo '<div class="button__home">
            <button class="button__home__btn">Charger plus</button>
        </div>';
		endif;

	else :
		echo 'Aucun post trouvé !';
	endif;

	wp_die();
}
add_action('wp_ajax_tri_format', 'nathaliemota_tri_format');
add_action('wp_ajax_nopriv_tri_format', 'nathaliemota_tri_format');

// Ajax Tri par Date
function nathaliemota_tri_date()
{
	$order = $_POST['sort'];

	$args = array(
		'post_type' => 'photo',
		'order' => $_POST['sort'],
		'posts_per_page' => $_POST['posts_per_page']
	);


	// Requête triée
	$posts = new WP_Query($args);
	// Création de la variable pour le template part
	set_query_var('query_photos', $posts);

	// Affichage des posts
	if ($posts->have_posts()) :

		echo get_template_part('template-parts/photo', 'block');

		if ($posts->found_posts >= 8) :
			// Affichage du bouton
			echo '<div class="button__home">
            <button class="button__home__btn"  data-order="' . $order . '" onclick="loadMoreDate(this.dataset.order)">Charger plus</button>
        </div>';
		endif;
		wp_reset_postdata();
	else :
		echo 'Aucun post trouvé !';
	endif;

	wp_die();
}
add_action('wp_ajax_tri_date', 'nathaliemota_tri_date');
add_action('wp_ajax_nopriv_tri_date', 'nathaliemota_tri_date');


// Ajax Tri Accueil
function nathaliemota_tri_home()
{
	$order = $_POST['sort'];

	$args = array(
		'post_type' => 'photo',
		'order' => $_POST['sort'],
		'posts_per_page' => $_POST['posts_per_page']
	);


	// Requête triée
	$posts = new WP_Query($args);
	// Création de la variable pour le template part
	set_query_var('query_photos', $posts);

	// Affichage des posts
	if ($posts->have_posts()) :

		echo get_template_part('template-parts/photo', 'block');

		if ($posts->found_posts >= 8) :
			// Affichage du bouton
			echo '<div class="button__home">
            <button class="button__home__btn"  data-order="' . $order . '" onclick="loadMore(this.dataset.order)">Charger plus</button>
        </div>';
		endif;
		wp_reset_postdata();
	else :
		echo 'Aucun post trouvé !';
	endif;

	wp_die();
}
add_action('wp_ajax_tri_home', 'nathaliemota_tri_home');
add_action('wp_ajax_nopriv_tri_home', 'nathaliemota_tri_home');


// TESTS
// add_action('wp_enqueue_scripts', 'my_ajax_test_enqueue_scripts');
// function my_ajax_test_enqueue_scripts()
// {
// 	wp_enqueue_script('ajax-test', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);
// 	wp_localize_script('ajax-test', 'ajax_test_params', array(
// 		'ajax_url' => admin_url('admin-ajax.php'),
// 		'nonce' => wp_create_nonce('ajax-test-nonce')
// 	));
// }

// add_action('wp_ajax_my_ajax_test', 'my_ajax_test_callback');
// add_action('wp_ajax_nopriv_my_ajax_test', 'my_ajax_test_callback');

// function my_ajax_test_callback()
// {
// 	check_ajax_referer('ajax-test-nonce', 'security');

// 	// Code de votre test AJAX
// 	echo "AJAX est reconnu dans WordPress.";

// 	wp_die();
// }
