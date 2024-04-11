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
}
add_action('wp_enqueue_scripts', 'nathaliemota_style');

// Chargement de Jquery CDN -- Fix Jquery is not defined
function jqueryCDN()
{
	wp_enqueue_script('jqueryCDN', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);
}
add_action('wp_enqueue_scripts', 'jqueryCDN');

// Chargement Scripts JS
function nathaliemota_script()
{
	wp_enqueue_script('mon_script', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array('jquery'), '1.0', true);
	wp_localize_script('mon_script', 'mon_script_js', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'nathaliemota_script');





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


function nathaliemota_request_photos()
{
	// $args = array('post_type' => 'photo', 'post_per_page' => -1);
	$query = new WP_Query(['post_type' => 'photo', 'post_per_page' => -1]);
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



add_action('wp_ajax_get_post_thumbnail', 'get_post_thumbnail_callback');
add_action('wp_ajax_nopriv_get_post_thumbnail', 'get_post_thumbnail_callback');

function get_post_thumbnail_callback()
{
	$post_id = $_POST['post_id'];
	$thumbnail = get_the_post_thumbnail($post_id, 'thumbnail');
	echo $thumbnail;
	wp_die();
}


add_filter('posts_orderby', 'custom_orderby', 10, 2);

function custom_orderby($orderby, $query)
{
	global $wpdb;
	if ($query->get('orderby') == 'annee') { // Remplacez 'acf_field' par le nom de votre champ ACF
		$orderby = "CAST($wpdb->postmeta.meta_value AS DATE) ASC"; // Remplacez ASC par DESC si vous voulez un tri descendant
	}
	return $orderby;
}
