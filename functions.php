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
			'nathaliemota_menu' => 'Main Menu'
		)
	);
}
add_action('after_setup_theme', 'nathaliemota_config', 0);
