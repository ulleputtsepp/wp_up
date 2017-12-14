<?php
/**
 * prasoon functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package prasoon
 */

 // Register Custom Navigation Walker
 require_once(get_template_directory() .'/inc/wp_bootstrap_navwalker.php');

 //Register Required plugin
require_once(get_template_directory() .'/inc/class-tgm-plugin-activation.php');

if ( ! function_exists( 'prasoon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function prasoon_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on prasoon, use a find and replace
	 * to change 'prasoon' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'prasoon', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary', 'prasoon' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );


	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'prasoon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );


	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Prasoon theme info
	 */
	require get_template_directory() . '/inc/theme-info.php';

	/*
	* About page instance
	*/
	$config = array();
	Prasoon_About_Page::init( $config );

}
endif;
add_action( 'after_setup_theme', 'prasoon_setup' );


/**
* Custom Logo 
*
*
*/
if ( ! function_exists( 'prasoon_logo_setup' ) ) :
function prasoon_logo_setup() {
    add_theme_support( 'custom-logo', array(
	   'height'      => 60,
	   'width'       => 180,
	   'flex-height' => true,
	   'flex-width' => true,
	   'header-text' => array( 'prasoon', 'WordPress Free Theme' ),
	) );
}
endif;
add_action( 'after_setup_theme', 'prasoon_logo_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'prasoon_content_width' ) ) :
function prasoon_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'prasoon_content_width', 640 );
}
endif;
add_action( 'after_setup_theme', 'prasoon_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( ! function_exists( 'prasoon_widgets_init' ) ) :
function prasoon_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'prasoon' ),
		'id'            => 'main-sidebar',
		'description'   => __( 'Add widgets here.', 'prasoon' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

  register_sidebar( array(
		'name'          => __( 'Business Template.', 'prasoon' ),
		'id'            => 'business-sidebar',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

}
endif;
add_action( 'widgets_init', 'prasoon_widgets_init' );

/**
* Admin Scripts
*/
if ( ! function_exists( 'prasoon_admin_scripts' ) ) :
function prasoon_admin_scripts($hook) {
	wp_enqueue_media();
	wp_enqueue_style( 'prasoon-admin-css', get_template_directory_uri() . '/layouts/admin.css', false );
	wp_enqueue_style( 'prasoon-info-css', get_template_directory_uri() . '/layouts/prasoon-theme-info.css', false );
	wp_enqueue_script( 'prasoon-admin-js', get_template_directory_uri() . '/js/admin.js', array('jquery'), '', true );

}
endif;
add_action( 'admin_enqueue_scripts', 'prasoon_admin_scripts' );


/**
 * Display Dynamic CSS.
 */
function prasoon_dynamic_css_wrap() {

  require_once( get_parent_theme_file_path( '/layouts/dynamic.css.php' ) );  
?>
  <style type="text/css" id="custom-theme-dynamic-style">
    <?php echo prasoon_dynamic_css_stylesheet(); ?>
  </style>
<?php }
add_action( 'wp_head', 'prasoon_dynamic_css_wrap' );


if ( ! function_exists( 'prasoon_scripts' ) ) :
function prasoon_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/layouts/bootstrap.css', array(), '3.3.6');
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/layouts/font-awesome.css', array(), '4.6.3');	
	wp_enqueue_style( 'google-font', prasoon_google_fonts_url(), array(), null );
	wp_enqueue_style( 'flexslider-css', get_template_directory_uri() . '/layouts/flexslider.css', array(), '2.0');
	wp_enqueue_style( 'owl-carousel-css', get_template_directory_uri() . '/layouts/owl.carousel.css', array(), '2.2.1');
	wp_enqueue_style( 'owl-theme-default-css', get_template_directory_uri() . '/layouts/owl.theme.default.css', array(), '2.2.1');
	wp_enqueue_style( 'magnific-popup-css', get_template_directory_uri() . '/layouts/magnific-popup.css', array(), '');
    wp_enqueue_style( 'prasoon-style', get_template_directory_uri() . '/layouts/main-style.css', array(), '');
	wp_enqueue_style( 'prasoon-responsive', get_template_directory_uri() . '/layouts/main-style-responsive.css', array(), '1.0');
	wp_enqueue_style( 'prasoon-animate', get_template_directory_uri() . '/layouts/animate.css', array(), '1.0');    

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array(), '3.3.6', true );
	wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.js', array('jquery'), '10.2.1', true );
	wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.6.2', true );	
	wp_enqueue_script( 'prasoon-wow', get_template_directory_uri() . '/js/wow.js','', true );
	wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js',array(),'2.0', true );
	wp_enqueue_script( 'jquery-isotope', get_template_directory_uri() . '/js/jquery.isotope.js',array(),'1.5.25', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js',array(),'2.2.1', true );
	wp_enqueue_script( 'parallax', get_template_directory_uri() . '/js/parallax.js',array(),'1.4.2', true );
	wp_enqueue_script( 'jquery-appear', get_template_directory_uri() . '/js/jquery.appear.js',array(),'', true );
	wp_enqueue_script( 'jquery-countTo', get_template_directory_uri() . '/js/jquery.countTo.js',array(),'', true );
	wp_enqueue_script( 'jquery-magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.js',array(),'1.1.0', true );
	wp_enqueue_script( 'prasoon-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '', true );	
	wp_enqueue_script( 'html5shiv',get_template_directory_uri().'/js/html5shiv.js');
  	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'respond', get_template_directory_uri().'/js/respond.js' );
    wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

}
endif;
add_action( 'wp_enqueue_scripts', 'prasoon_scripts' );



/**
* Google Fonts
*/
if ( !function_exists('prasoon_google_fonts_url') ) :
function prasoon_google_fonts_url() {
	$body_font 		= get_theme_mod('body_font_name', 'Lato:400,300,700,900');
	$heading_font 	= get_theme_mod('heading_font_name', 'Lato:400,300,700,900');

	$fonts     		= array();
	$fonts[] 		= esc_attr( str_replace( '+', ' ', $body_font ) );
	$fonts[] 		= esc_attr( str_replace( '+', ' ', $heading_font ) );

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) )
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;	
}
endif;


/**
* Custom excerpt length.
*/
if ( ! function_exists( 'prasoon_my_excerpt_length' ) ) :
function prasoon_my_excerpt_length($length) {
  return 25;
}
endif;
add_filter('excerpt_length', 'prasoon_my_excerpt_length');


/**
* Registers an editor stylesheet for the theme.
*/
if ( ! function_exists( 'prasoon_theme_add_editor_styles' ) ) :
function prasoon_theme_add_editor_styles() {
    add_editor_style(get_template_directory_uri() . '/layouts/custom-editor-style.css' );
}
endif;
add_action( 'admin_init', 'prasoon_theme_add_editor_styles' );


/**
* Custom search form
*/
if ( ! function_exists( 'prasoon_search_form' ) ) :
function prasoon_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div class="search">
      <input type="text" value="' . get_search_query() . '" class="blog-search" name="s" id="s" placeholder="Search here">
      <label for="searchsubmit" class="search-icon"><i class="fa fa-search"></i></label>
      <input type="submit" id="searchsubmit" value="'. esc_attr__( 'Search','prasoon' ) .'" />
    </div>
    </form>';
    return $form;
}
endif;
add_filter( 'get_search_form', 'prasoon_search_form', 100 );

if ( ! function_exists( 'prasoon_search_filter' ) ) :
function prasoon_search_filter($query) {
  if ($query->is_search) {
  $query->set('post_type', 'post');
  }
  return $query;
}
endif;
add_filter('pre_get_posts','prasoon_search_filter');


/** 
*Excerpt More
*/
if ( ! function_exists( 'prasoon_excerpt_more' ) ) :
function prasoon_excerpt_more( $more ) {
    return ' &hellip;';
}
endif;
add_filter('excerpt_more', 'prasoon_excerpt_more');



/** 
*plugins Required
*/
if ( ! function_exists( 'prasoon_register_required_plugins' ) ) :
function prasoon_register_required_plugins() {

    $plugins = array(      
      array(
          'name'               => 'Contact Form 7',
          'slug'               => 'contact-form-7',
          'source'             => '',
          'required'           => false,
          'external_url'       => 'http://contactform7.com/',
          'force_activation'   => false,
      ),      
      array(
          'name'               => 'One Click Demo Import',
          'slug'               => 'one-click-demo-import',
          'source'             => '',
          'required'           => false,
          'external_url'       => 'https://github.com/proteusthemes/one-click-demo-import',
          'force_activation'   => false,
      ),      
    );

    $config = array(
            'id'           => 'prasoon',
            'default_path' => '',
            'menu'         => 'tgmpa-install-plugins',
            'has_notices'  => true,
            'dismissable'  => false,
            'dismiss_msg'  => '',
            'is_automatic' => true,
            'message'      => '',
            'strings'      => array()
    );

    tgmpa( $plugins, $config );

}
endif;
add_action( 'tgmpa_register', 'prasoon_register_required_plugins' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Extra classes for this theme.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Widgets.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load 1 Click Demo Import Setup
 */
require get_template_directory() . '/demo-content/setup.php';

