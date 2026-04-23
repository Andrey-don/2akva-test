<?php 
/**
* Gridster functions and definitions
*
* @package 2akva
*/

define('SPEC_BASE_URL', get_template_directory_uri());
define('HOME_URL', get_home_url());
define('SPEC_JS', SPEC_BASE_URL . '/js');
define('SPEC_CSS', SPEC_BASE_URL . '/css');
define('SPEC_IMAGES', SPEC_BASE_URL . '/images');
define('SPEC_VIDEO', SPEC_BASE_URL . '/videos');
define('SPEC_FONTS', SPEC_BASE_URL . '/fonts');
// define('MIN', '.min');
define('MIN', '');

// Downgrade jQuery to 3.x — webflow.js is incompatible with jQuery 4.0 (WP 6.9+)
// Only on frontend: admin needs bundled jQuery for media library and other UI
add_filter('script_loader_src', function($src, $handle) {
	if (!is_admin() && $handle === 'jquery-core') {
		return 'https://code.jquery.com/jquery-3.7.1.min.js';
	}
	return $src;
}, 10, 2);


function my_scripts(){
	wp_enqueue_script('webflow-js', SPEC_JS.'/webflow.js', array('jquery'), '', TRUE);
	wp_enqueue_script('custom-js', SPEC_JS.'/custom.js', array('jquery'), '', TRUE);
}
add_action( 'wp_enqueue_scripts', 'my_scripts',999 );
function my_styles(){
	wp_enqueue_style('normalize-css', SPEC_CSS .'/normalize'.MIN.'.css', array(), '');
	wp_enqueue_style('webflow-css', SPEC_CSS .'/webflow.css', array(), '');
	wp_enqueue_style('2akva2.webflow-css', SPEC_CSS .'/2akva2.webflow.css', array(), '');
	wp_enqueue_style('animate-css', SPEC_CSS .'/animate.css', array(), '');
	wp_enqueue_style('custom-css', SPEC_CSS .'/custom.css', array(), '');
	wp_enqueue_style('main-style-css', SPEC_BASE_URL.'/style.css', array(), '');
}
add_action( 'wp_enqueue_scripts', 'my_styles',999 );

// require_once('custom/wp-bootstrap-navwalker.php');
// require_once('custom/theme_settings.php');
// require_once('custom/pagination.php');
require_once('custom/menu_walker.php');
require_once('custom/breadcumbs.php');
require_once('custom/feature.php');  // Добавляем всякого


function do_excerpt($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if (count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words).' ...';
}

// function new_excerpt_length($length) {return 30;}  // Длина 
// add_filter('excerpt_length', 'new_excerpt_length');


add_theme_support('menus');
add_theme_support('post-thumbnails');
add_theme_support('widgets');

register_nav_menus(array('header_menu' => 'Верхнее меню'));
// register_nav_menus(array('footer_menu' => 'Меню в футере'));


## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
add_filter( 'get_the_archive_title', function( $title ){
	return preg_replace('~^[^:]+: ~', '', $title );
});

add_filter( 'excerpt_length', function(){
	return 15;
});
add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $more ){
	return '...';
}

// Register custom post types (previously handled by Toolset Types plugin)
add_action('init', function() {
	register_post_type('equipmente', array(
		'labels' => array(
			'name'          => 'Оборудование',
			'singular_name' => 'Оборудование',
		),
		'public'       => true,
		'has_archive'  => true,
		'rewrite'      => array('slug' => 'equipmente', 'with_front' => false, 'hierarchical' => true),
		'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
		'hierarchical' => true,
		'show_in_nav_menus' => true,
	));

	register_post_type('areas_of_use', array(
		'labels' => array(
			'name'          => 'Области применения',
			'singular_name' => 'Область применения',
		),
		'public'       => true,
		'has_archive'  => true,
		'rewrite'      => array('slug' => 'areas_of_use', 'with_front' => false),
		'supports'     => array('title', 'editor', 'thumbnail', 'excerpt'),
		'hierarchical' => false,
		'show_in_nav_menus' => true,
	));
});

// Fix: WordPress 5.3.x + PHP 8.2 — missing root rewrite rule for static front page
add_filter('rewrite_rules_array', function($rules) {
	$front_page_id = get_option('page_on_front');
	if (get_option('show_on_front') === 'page' && $front_page_id) {
		$root_rule = array('$' => 'index.php?page_id=' . intval($front_page_id));
		$rules = $root_rule + $rules;
	}
	return $rules;
});
?>