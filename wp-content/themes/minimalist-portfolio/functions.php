<?php


/**
 * Enqueue Styles and Scripts
 */
function minimalist_portfolio_enqueue() {

	if ( is_admin() ) {
		return;
	}

	// Necessary styles
	wp_enqueue_style( 'minimalist-portfolio-hamilton-style', get_template_directory_uri() . '/style.css', array( 'hamilton-fonts' ) );
	wp_enqueue_style( 'minimalist-portfolio-style', get_stylesheet_uri() );

	// Refresh portfolio after the page load
	wp_add_inline_script( 'phort-app', '
		(function(){
			setTimeout( function() {
				wp.hooks.doAction("phort.portfolio.refresh");
			}, 50);
		})();' );
}

add_action( 'wp_enqueue_scripts', 'minimalist_portfolio_enqueue', 100 );


/*
 * Easy Photography Portfolio Configuration
 */
$__DIR = get_stylesheet_directory();

if ( class_exists( 'Colormelon_Photography_Portfolio' ) ) {
	require_once $__DIR . '/inc/easy-photography-portfolio.php';
}
else {
	require $__DIR . '/inc/plugins/tgm_plugin_activation.php';
	require $__DIR . '/inc/plugins/recommend_plugins.php';
}

/**
 * Display the welcome message in admin panel
 */
if ( is_admin() ) {
	require $__DIR . '/inc/welcome_message.php';
}
