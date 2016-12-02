<?php
/**
 * Require theme specific autoloader
 */
require_once __DIR__ . '/vendor/autoload.php';

//Loads the ACF files in inc/acf/
require_once('inc/acf/loader.php');
add_action('init', 'load_acf');

//Sets up Routemaster
if (class_exists('ooRoutemaster')) {
    include 'Router.class.php';

    $router = Router::getInstance();
    $router->setup();
    // store the router in the theme, once it is initialised
    add_action('oowp_theme_init', function ($theme) use ($router) {
        $theme->router = $router;
    });
}

/**
 * Put your WordPress functions here
 */

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script('vendor', get_stylesheet_directory_uri() . '/public/js/vendor.js');
    wp_enqueue_script('app', get_stylesheet_directory_uri() . '/public/js/app.js', ['vendor']);
    wp_enqueue_style('app', get_stylesheet_directory_uri() . '/public/css/app.css');
});

add_theme_support('post-thumbnails');
