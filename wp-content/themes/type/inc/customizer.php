<?php
/**
 * Type Theme Customizer.
 *
 * @package Type
 * @since Type 1.0
 */


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function type_customize_preview_js() {
	wp_enqueue_script( 'type_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20171005', true );
}
add_action( 'customize_preview_init', 'type_customize_preview_js' );


/**
 * Custom Classes
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	class Type_Important_Links extends WP_Customize_Control {

    	public $type = "type-important-links";
	
		public function render_content() {
        $important_links = array(
			'upgrade' => array(
			'link' => esc_url('https://www.designlabthemes.com/brilliant-plus-wordpress-theme/?utm_source=wordpress&utm_campaign=type&utm_content=customizer_link'),
			'text' => __('Try Type Plus', 'type'),
			),
			'theme' => array(
			'link' => esc_url('https://www.designlabthemes.com/type-wordpress-theme/'),
			'text' => __('Theme Homepage', 'type'),
			),
			'documentation' => array(
			'link' => esc_url('https://www.designlabthemes.com/type-documentation/'),
			'text' => __('Theme Documentation', 'type'),
			),
			'rating' => array(
			'link' => esc_url('https://wordpress.org/support/theme/type/reviews/#new-post'),
			'text' => __('Rate This Theme', 'type'),
			),
			'twitter' => array(
			'link' => esc_url('https://twitter.com/designlabthemes'),
			'text' => __('Follow on Twitter', 'type'),
			)
        );
        foreach ($important_links as $important_link) {
        	echo '<p><a class="button" target="_blank" href="' . esc_url( $important_link['link'] ). '" >' . esc_html($important_link['text']) . ' </a></p>';
        	}
    	}
	}

}


/**
 * Theme Settings
 */
function type_theme_customizer( $wp_customize ) {
	
	// Add postMessage support for site title and description for the Theme Customizer.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// Change default WordPress customizer settings
	$wp_customize->get_control( 'background_color' )->section	= 'colors_general';
	$wp_customize->get_control( 'background_color' )->priority  = 1;
	$wp_customize->get_control( 'header_textcolor' )->section	= 'colors_header';
	$wp_customize->get_control( 'header_textcolor' )->priority  = 2;
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title', 'type' );
	
	// Remove default Colors Section
	$wp_customize->remove_section('colors');
	
	
	//Retrieve list of Categories
	$blog_categories = array();
	$blog_categories_obj = get_categories();
	foreach ($blog_categories_obj as $category) {
        $blog_categories[$category->cat_ID] = $category->cat_name;
	}

	// Type Links
	$wp_customize->add_section('type_links_section', array(
		'priority' => 2,
		'title' => __('Type Links', 'type'),
	) );
	
	$wp_customize->add_setting('type_links', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_control(new Type_Important_Links($wp_customize, 'type_links', array(
		'section' => 'type_links_section',
		'settings' => 'type_links',
	) ) );
	
	// Theme Settings
	$wp_customize->add_panel( 'type_panel', array(
    	'title'		=> __( 'Theme Settings', 'type' ),
		'priority'	=> 10,
	) );
	
	// General Section
	$wp_customize->add_section( 'general_section', array(
		'title'		=> __( 'General', 'type' ),
		'priority'	=> 5,
		'panel'		=> 'type_panel',
	) );
	
	// Read More Link
	$wp_customize->add_setting( 'show_read_more', array(
        'default' => 1,
        'sanitize_callback' => 'type_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'show_read_more', array(
	    'label'    => __( 'Display Read More Link', 'type' ),
	    'section'  => 'general_section',
	    'type'     => 'checkbox',
	) );
	
	// Header Section
	$wp_customize->add_section( 'header_section', array(
		'title'       => __( 'Header', 'type' ),
		'priority'    => 10,
		'panel' => 'type_panel',
		'description'	=> __( 'Settings for Site Header.', 'type' ),
	) );
	
	// Header Layout
	$wp_customize->add_setting( 'header_layout', array(
        'default' => 'header-layout1',
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'header_layout', array(
	    'label'    => __( 'Style', 'type' ),
	    'section'  => 'header_section',
	    'type'     => 'radio',
		'choices'  => array(
			'header-layout1' => __('Site Title centered over Header Image + Navbar below', 'type'),
			'header-layout2' => __('Site Title centered above Header Image + Navbar below', 'type'),
			'header-layout3' => __('Site Title centered above Header Image + Top Navbar', 'type'),
			'header-layout4' => __('Site Title left + Menu above Header Image', 'type'),
	) ) );
	
	// Search Icon
	$wp_customize->add_setting( 'show_header_search', array(
        'default' => '',
        'sanitize_callback' => 'type_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'show_header_search', array(
	    'label'    => __( 'Display Search Icon', 'type' ),
	    'section'  => 'header_section',
	    'type'     => 'checkbox',
	) );
	
	// Social Links
	$wp_customize->add_setting( 'show_header_social', array(
        'default' => 1,
        'sanitize_callback' => 'type_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'show_header_social', array(
	    'label'    => __( 'Display Social Links', 'type' ),
	    'section'  => 'header_section',
	    'type'     => 'checkbox',
	) );
	
	// Header Image Padding
	$wp_customize->add_setting( 'header_image_padding', array(
        'default' => 20,
        'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'header_image_padding', array(	
        'label' => __( 'Padding above and below Header Image', 'type' ),
        'section'  => 'header_section',
        'type'     => 'number',
        'active_callback' => 'type_has_header_image',
    ) );
	
	// Header Image Opacity
	$wp_customize->add_setting( 'header_image_opacity', array(
        'default' => 40,
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'header_image_opacity', array(
	    'label'    => __( 'Header Image Opacity', 'type' ),
	    'description' => __('Add a dark overlay to the Header Image, to ensure the right text readability and contrast.', 'type' ),
	    'section'  => 'header_section',
	    'type'     => 'select',
	    'active_callback' => 'type_has_dark_overlay',
		'choices'  => array(
			0  => __( '0%', 'type' ),
			10 => __( '10%', 'type' ),
			20 => __( '20%', 'type' ),
			30 => __( '30%', 'type' ),
			40 => __( '40%', 'type' ),
			50 => __( '50%', 'type' ),
			60 => __( '60%', 'type' ),
			70 => __( '70%', 'type' ),
			80 => __( '80%', 'type' ),
	) ) );
	
	// Featured Posts Section
	$wp_customize->add_section( 'featured_posts', array(
		'title' => __( 'Featured Posts', 'type' ),
		'priority'    => 15,
		'panel' => 'type_panel',
	) );
	
	$wp_customize->add_setting( 'show_featured_posts', array(
        'default' => '',
        'sanitize_callback' => 'type_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'show_featured_posts', array(
	    'label'    => __( 'Display Featured Posts', 'type' ),
	    'description' => __( 'Check this option to highlight some content to your visitors at the top of the Homepage.', 'type' ),
	    'section'  => 'featured_posts',
	    'type'     => 'checkbox',
	) );
	
	$wp_customize->add_setting('featured_posts_category', array(
	    'default' => get_option('default_category'),
	    'sanitize_callback' => 'type_sanitize_choices',
	) );
	
	$wp_customize->add_control('featured_posts_category', array(
	    'description' => __('Select a Category', 'type'),
	    'section'  => 'featured_posts',
	    'type'    => 'select',
	    'choices' => $blog_categories
	) );
	
	$wp_customize->add_setting( 'exclude_featured_posts', array(
        'default' => 1,
        'sanitize_callback' => 'type_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'exclude_featured_posts', array(
	    'label'    => __( 'Avoid duplicate posts', 'type' ),
	    'description' => __('Enable this option to esclude Featured Posts from the Homepage', 'type'),
	    'section'  => 'featured_posts',
	    'type'     => 'checkbox',
	) );
	
	$wp_customize->add_setting( 'show_featured_posts_title', array(
        'default' => '',
        'sanitize_callback' => 'type_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'show_featured_posts_title', array(
	    'label'    => __( 'Display Title', 'type' ),
	    'section'  => 'featured_posts',
	    'type'     => 'checkbox',
	) );
	
	$wp_customize->add_setting( 'featured_posts_title', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'featured_posts_title', array(
		'label' => __( 'Title', 'type' ),
		'description' => __( 'Default is Category Name', 'type' ),
		'type' => 'text',
		'section'  => 'featured_posts',
	) );
		
	// Blog Section
	$wp_customize->add_section( 'blog_section', array(
		'title'       => __( 'Blog', 'type' ),
		'priority'    => 20,
		'panel' => 'type_panel',
		'description'	=> __( 'Settings for Blog Posts Index Page.', 'type' ),
	) );
	
	// Blog Post Layout
	$wp_customize->add_setting( 'blog_layout', array(
        'default' => 'list',
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'blog_layout', array(
	    'label'    => __( 'Post Layout', 'type' ),
	    'section'  => 'blog_section',
	    'type'     => 'radio',
		'choices'  => array(
			'list' => __('List', 'type'),
			'grid' => __('Grid', 'type'),
			'large' => __('Large', 'type'),
	) ) );
	
	// Blog Sidebar Position
	$wp_customize->add_setting( 'blog_sidebar_position', array(
        'default' => 'content-sidebar',
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'blog_sidebar_position', array(
	    'label'    => __( 'Sidebar Position', 'type' ),
	    'section'  => 'blog_section',
	    'type'     => 'select',
		'choices'  => array(
			'content-sidebar' => __('Right Sidebar', 'type'),
			'sidebar-content' => __('Left Sidebar', 'type'),
			'content-fullwidth' => __('No Sidebar Full width', 'type'),
	) ) );
	
	// Blog Excerpt Length
	$wp_customize->add_setting( 'blog_excerpt_length', array(
        'default' => 25,
        'sanitize_callback' => 'absint',
    ) );
	
	$wp_customize->add_control( 'blog_excerpt_length', array(
	    'label'    => __( 'Excerpt length', 'type' ),
	    'section'  => 'blog_section',
	    'type'     => 'number',
	) );
	
	// Archives Section
	$wp_customize->add_section( 'archive_section', array(
		'title'       => __( 'Categories & Archives', 'type' ),
		'priority'    => 25,
		'panel' => 'type_panel',
		'description'	=> __( 'Settings for Category, Tag, Search and Archive Pages.', 'type' ),
	) );
	
	// Archives Post Layout
	$wp_customize->add_setting( 'archive_layout', array(
        'default' => 'list',
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'archive_layout', array(
	    'label'    => __( 'Post Layout', 'type' ),
	    'section'  => 'archive_section',
	    'type'     => 'radio',
		'choices'  => array(
			'list' => __('List', 'type'),
			'grid' => __('Grid', 'type'),
			'large' => __('Large', 'type'),
	) ) );
	
	// Archives Sidebar Position
	$wp_customize->add_setting( 'archive_sidebar_position', array(
        'default' => 'content-sidebar',
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'archive_sidebar_position', array(
	    'label'    => __( 'Sidebar Position', 'type' ),
	    'section'  => 'archive_section',
	    'type'     => 'select',
		'choices'  => array(
			'content-sidebar' => __('Right Sidebar', 'type'),
			'sidebar-content' => __('Left Sidebar', 'type'),
			'content-fullwidth' => __('No Sidebar Full width', 'type'),
	) ) );
	
	// Archives Excerpt Length
	$wp_customize->add_setting( 'archive_excerpt_length', array(
        'default' => 25,
        'sanitize_callback' => 'absint',
    ) );
	
	$wp_customize->add_control( 'archive_excerpt_length', array(
	    'label'    => __( 'Excerpt length', 'type' ),
	    'section'  => 'archive_section',
	    'type'     => 'number',
	) );
		
	// Post Section
	$wp_customize->add_section( 'post_section', array(
		'title'       => __( 'Post', 'type' ),
		'priority'    => 30,
		'panel' => 'type_panel',
	) );
	
	// Feauted Image
	$wp_customize->add_setting( 'post_has_featured_image', array(
        'default' => 1,
        'sanitize_callback' => 'type_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'post_has_featured_image', array(
	    'label'    => __( 'Display Featured Image', 'type' ),
	    'section'  => 'post_section',
	    'type'     => 'checkbox',
	) );
	
	// Post Styles
	$wp_customize->add_setting( 'post_style', array(
        'default' => 'fimg-classic',
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'post_style', array(
	    'label' => __( 'Style', 'type' ),
	    'section'  => 'post_section',
	    'type'     => 'radio',
		'choices'  => array(
			'fimg-classic' => __('Large Featured Image', 'type'),
			'fimg-fullwidth' => __('Full width Featured Image', 'type'),
			),
		'active_callback' => 'type_post_has_featured_image',
	) );
	
	// Post Sidebar Position
	$wp_customize->add_setting( 'post_sidebar_position', array(
        'default' => 'content-sidebar',
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'post_sidebar_position', array(
	    'label'    => __( 'Sidebar Position', 'type' ),
	    'section'  => 'post_section',
	    'type'     => 'select',
		'choices'  => array(
			'content-sidebar' => __('Right Sidebar', 'type'),
			'sidebar-content' => __('Left Sidebar', 'type'),
			'content-centered' => __('No Sidebar Centered', 'type'),
			'content-fullwidth' => __('No Sidebar Full width', 'type'),
	) ) );
	
	// Author Bio
	$wp_customize->add_setting( 'show_author_bio', array(
        'default' => '',
        'sanitize_callback' => 'type_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'show_author_bio', array(
	    'label'    => __( 'Display Author Bio', 'type' ),
	    'section'  => 'post_section',
	    'type'     => 'checkbox',
	) );
	
	// Page Section
	$wp_customize->add_section( 'page_section', array(
		'title'       => __( 'Page', 'type' ),
		'priority'    => 35,
		'panel' => 'type_panel',
	) );
	
	// Featured Image
	$wp_customize->add_setting( 'page_has_featured_image', array(
        'default' => 1,
        'sanitize_callback' => 'type_sanitize_checkbox',
    ) );
   	
	$wp_customize->add_control( 'page_has_featured_image', array(
	    'label'    => __( 'Display Featured Image', 'type' ),
	    'section'  => 'page_section',
	    'type'     => 'checkbox',
	) );
	
	// Page Styles
	$wp_customize->add_setting( 'page_style', array(
        'default' => 'fimg-classic',
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'page_style', array(
	    'label' => __( 'Style', 'type' ),
	    'section'  => 'page_section',
	    'type'     => 'radio',
		'choices'  => array(
			'fimg-classic' => __('Large Featured Image', 'type'),
			'fimg-fullwidth' => __('Full width Featured Image', 'type'),
			),
		'active_callback' => 'type_page_has_featured_image',
	) );
	
	// Page Sidebar Position
	$wp_customize->add_setting( 'page_sidebar_position', array(
        'default' => 'content-sidebar',
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'page_sidebar_position', array(
	    'label'    => __( 'Sidebar Position', 'type' ),
	    'description'    => __( 'Sidebar options for Static Pages. To remove the Sidebar apply No Sidebar Template to the Page.', 'type' ),
	    'section'  => 'page_section',
	    'type'     => 'select',
		'choices'  => array(
			'content-sidebar' => __('Right Sidebar', 'type'),
			'sidebar-content' => __('Left Sidebar', 'type'),
	) ) );
	
	// WooCommerce Section
	$wp_customize->add_section( 'woocommerce_section', array(
		'title'       => __( 'WooCommerce', 'type' ),
		'description' => __('WooCommerce Settings. Cart, Checkout and Account are standard pages. To remove the Sidebar apply the Full width Template to the page.', 'type'),
		'priority'    => 36,
		'panel' => 'type_panel',
		'active_callback' => 'type_woocommerce_check',
	) );

	// WooCommerce Sidebar Position
	$wp_customize->add_setting( 'woocommerce_sidebar_position', array(
        'default' => 'content-sidebar',
        'sanitize_callback' => 'type_sanitize_choices',
    ) );
   	   	
	$wp_customize->add_control( 'woocommerce_sidebar_position', array(
	    'label'    => __( 'Sidebar Position', 'type' ),
	    'description'    => __( 'Sidebar options for WooCommerce Pages (Shop, Product, Product Category)', 'type' ),
	    'section'  => 'woocommerce_section',
	    'type'     => 'select',
		'choices'  => array(
			'content-sidebar' => __('Right Sidebar', 'type'),
			'sidebar-content' => __('Left Sidebar', 'type'),
			'content-fullwidth' => __('No Sidebar Full width', 'type'),
	) ) );
	
	// Logo Max Width (desktop)
	$wp_customize->add_setting( 'logo_width_lg', array(
        'default' => 220,
        'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'logo_width_lg', array(	
        'label' => __( 'Logo Max Width (desktop)', 'type' ),
        'section'  => 'title_tagline',
        'type'     => 'number',
        'priority' => 10, 
    ) );
	
	// Logo Max Width (mobile)
	$wp_customize->add_setting( 'logo_width_sm', array(
        'default' => 180,
        'sanitize_callback' => 'absint',
	) );
	
	$wp_customize->add_control( 'logo_width_sm', array(	
        'label' => __( 'Logo Max Width (mobile)', 'type' ),
        'section'  => 'title_tagline',
        'type'     => 'number',
        'priority' => 11,
    ) );
    
    // Theme Colors
	$wp_customize->add_panel( 'type_colors', array(
    	'title'		=> __( 'Colors', 'type' ),
		'priority'	=> 15,
	) );
	
	// Colors: General
	$wp_customize->add_section( 'colors_general', array(
		'title'	=> __( 'General', 'type' ),
		'panel'	=> 'type_colors',
	) );
	
    // Accent Color
	$wp_customize->add_setting( 'accent_color', array(
		'default' => '#2e64e6',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label' => __( 'Accent Color', 'type' ),
		'priority' => 2,
		'section' => 'colors_general',
	) ) );
	
	// Colors: Header
	$wp_customize->add_section( 'colors_header', array(
		'title'	=> __( 'Header', 'type' ),
		'panel'	=> 'type_colors',
	) );
	
	// Header Background
	$wp_customize->add_setting( 'header_background', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background', array(
		'label' => __( 'Header Background', 'type' ),
		'section' => 'colors_header',
		'priority' => 1,
	) ) );
	
	// Site Tagline Color
	$wp_customize->add_setting( 'site_tagline_color', array(
		'default' => '#888888',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_tagline_color', array(
		'label' => __( 'Site Tagline', 'type' ),
		'section' => 'colors_header',
		'priority'	=> 3,
	) ) );
	
	// Main Menu Background
	$wp_customize->add_setting( 'navbar_background', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'navbar_background', array(
		'label' => __( 'Navbar Background', 'type' ),
		'section' => 'colors_header',
		'priority'	=> 4,
		'active_callback' => 'type_header_layout',
	) ) );
	
	// Menu Item Color
	$wp_customize->add_setting( 'main_menu_color', array(
		'default' => '#222222',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_color', array(
		'label' => __( 'Menu Item', 'type' ),
		'section' => 'colors_header',
		'priority'	=> 5,
	) ) );
	
	// Menu Item hover Color
	$wp_customize->add_setting( 'main_menu_hover_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_menu_hover_color', array(
		'label' => __( 'Menu Item hover', 'type' ),
		'description' => __( 'This option overrides the Accent Color.', 'type'),
		'section' => 'colors_header',
		'priority'	=> 6,
	) ) );
	
	// Social Link Color
	$wp_customize->add_setting( 'social_link_color', array(
		'default' => '#222222',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'social_link_color', array(
		'label' => __( 'Social Link', 'type' ),
		'section' => 'colors_header',
		'priority'	=> 7,
	) ) );
	
	// Search Icon Color
	$wp_customize->add_setting( 'search_icon_color', array(
		'default' => '#222222',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'search_icon_color', array(
		'label' => __( 'Search Icon', 'type' ),
		'section' => 'colors_header',
		'priority'	=> 8,
	) ) );
	
	// Colors: Footer
	$wp_customize->add_section( 'colors_footer', array(
		'title'	=> __( 'Footer', 'type' ),
		'panel'	=> 'type_colors',
	) );
	
	// Footer Widget Area Background
	$wp_customize->add_setting( 'footer_background', array(
		'default' => '#1b2126',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background', array(
		'label' => __( 'Footer Widget Area Background', 'type' ),
		'section' => 'colors_footer',
	) ) );
	
	// Footer Copy Background
	$wp_customize->add_setting( 'footer_copy_background', array(
		'default' => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_copy_background', array(
		'label' => __( 'Footer Background', 'type' ),
		'section' => 'colors_footer',
	) ) );
	
}
add_action('customize_register', 'type_theme_customizer');


/**
 * Sanitize Checkbox
 *
 */ 
function type_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}


/**
 * Sanitize Radio Buttons and Select Lists
 *
 */
function type_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}


/**
 * Checks if Single Post has featured image
 */
function type_post_has_featured_image( $control ) {
    if ( $control->manager->get_setting('post_has_featured_image')->value() == 1 ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Checks if Page has featured image
 */
function type_page_has_featured_image( $control ) {
    if ( $control->manager->get_setting('page_has_featured_image')->value() == 1 ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Checks Header Layout
 */
function type_header_layout( $control ) {
    if ( $control->manager->get_setting('header_layout')->value() != 'header-layout4' ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Checks whether a header image is set or not.
 */
function type_has_header_image( $control ) {
	if ( has_header_image() ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Checks Header Layout and whether a Header image is set or not.
 */
function type_has_dark_overlay( $control ) {
	if ( has_header_image() && $control->manager->get_setting('header_layout')->value() == 'header-layout1' ) {
		return true;
    } else {
        return false;
    }
}


/**
 * Checks if WooCommerce is active.
 */
function type_woocommerce_check( $control ) {
    if ( type_is_woocommerce_active() ) {
    	return true;
    } else { 
	    return false;
    }
}


/**
 * Get Contrast
 *
 */
function type_get_brightness($hex) {
 // returns brightness value from 0 to 255
 // strip off any leading #
 $hex = str_replace('#', '', $hex);

 $c_r = hexdec(substr($hex, 0, 2));
 $c_g = hexdec(substr($hex, 2, 2));
 $c_b = hexdec(substr($hex, 4, 2));

 return (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;
}


/**
 * Add inline CSS for styles handled by the Theme customizer
 *
 */
function type_add_styles() { 
	$logo_width_desktop = esc_attr( get_theme_mod('logo_width_lg') );
	$logo_width_mobile = esc_attr( get_theme_mod('logo_width_sm') );
	
	$header_layout = esc_attr( get_theme_mod('header_layout', 'header-layout1') );
	$header_image_padding = esc_attr(get_theme_mod('header_image_padding', 20) );
	$header_image_opacity = esc_attr( get_theme_mod('header_image_opacity', 40) );
	
	$accent_color = esc_attr( get_theme_mod('accent_color') );
	$site_tagline_color = esc_attr( get_theme_mod('site_tagline_color') );
	$main_menu_color = esc_attr( get_theme_mod('main_menu_color') );
	$main_menu_hover_color = esc_attr( get_theme_mod('main_menu_hover_color') );
	$social_link_color = esc_attr( get_theme_mod('social_link_color') );
	$search_icon_color = esc_attr( get_theme_mod('search_icon_color') );
	$header_background = esc_attr( get_theme_mod('header_background') );
	$navbar_background = esc_attr( get_theme_mod('navbar_background') );
	
	$footer_background = esc_attr( get_theme_mod('footer_background') ); 
	$footer_copy_background = esc_attr( get_theme_mod('footer_copy_background') );
	
	$custom_styles = "";
	
	// Custom Logo
	if ( $logo_width_mobile != '' ) {
		$custom_styles .= "
		@media screen and (max-width: 599px) {
		.site-logo .custom-logo {max-width: {$logo_width_mobile}px;}
		}";
	}
	if ( $logo_width_desktop != '' ) {
		$custom_styles .= "
		@media screen and (min-width: 600px) {
		.site-logo .custom-logo {max-width: {$logo_width_desktop}px;}
		}";
	}

	// Header Image Padding
	if ( $header_image_padding != '' ) {
		$custom_styles .= ".header-image {padding-top: {$header_image_padding}px;padding-bottom: {$header_image_padding}px;}";
	}
	
	// Header Image Opacity
	if ( $header_layout == 'header-layout1' ) {
		$custom_styles .= "
		.header-image:before {
		content: '';
		position: absolute;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		background-color: #000;
		}";
		if ( $header_image_opacity != '' ) {
		$custom_styles .= ".header-image:before {opacity: 0.{$header_image_opacity};}";
		} else {
		$custom_styles .= ".header-image:before {opacity: 0.4;}";
		}	
	}

	// Accent Color
	if ( $accent_color != '' ) {
		$custom_styles .= "
		a, a:hover, .site-info a:hover, .site-credits a:hover, .widget a:hover, .widget-area ul li a:hover, .comment-metadata a:hover,
		.site-title a:hover, .entry-title a:hover, .category-title a:hover,
		.posts-navigation a:hover, .large-post .read-more,
		.main-navigation li:hover > a, .main-navigation li:focus > a,
		.main-navigation .current_page_item > a, .main-navigation .current-menu-item > a,
		.dropdown-toggle:hover, .dropdown-toggle:focus {
		color: {$accent_color};
		}
		button, input[type='button'], input[type='reset'], input[type='submit'], .large-post .read-more:hover, .sidebar .widget_tag_cloud a:hover, .reply a:hover,
		.main-navigation > ul > li.current-menu-item:before {
		background-color: {$accent_color};
		}
		blockquote {border-left-color: {$accent_color};}
		.large-post .read-more, .reply a, .posts-loop .entry-thumbnail:hover img, .list-vertical .entry-thumbnail:hover {
		border-color: {$accent_color};
		}
		.format-audio .entry-thumbnail:after, .format-gallery .entry-thumbnail:after, .format-image .entry-thumbnail:after, .format-quote .entry-thumbnail:after, .format-video .entry-thumbnail:after {
		border-top-color: {$accent_color};
		}";
		if ( type_get_brightness($accent_color) > 155) {
			$custom_styles .= "
			button, input[type='button'], input[type='reset'], input[type='submit'], .large-post .read-more:hover, .sidebar .widget_tag_cloud a:hover, .reply a:hover,
			.format-audio .entry-thumbnail:before, .format-gallery .entry-thumbnail:before, .format-image .entry-thumbnail:before, .format-quote .entry-thumbnail:before, .format-video .entry-thumbnail:before {
			color: rgba(0,0,0,.7);
			}";
		}
	}
	
	// Site Tagline Color
	if ( $site_tagline_color != '' ) {
		$custom_styles .= ".site-description {color: {$site_tagline_color};}";
	}
	
	// Main Menu Color
	if ( $main_menu_color != '' ) {
		$custom_styles .= "
		@media screen and (min-width: 960px) {
		.main-navigation > ul > li > a {color: {$main_menu_color};}
		}";
	}
	
	// Main Menu hover Color
	if ( $main_menu_hover_color != '' ) {
		$custom_styles .= "
		@media screen and (min-width: 960px) {
		.main-navigation > ul > li:hover > a, .main-navigation > ul > li:focus > a,
		.main-navigation > ul > li.current_page_item > a, .main-navigation > ul > li.current-menu-item > a {color: {$main_menu_hover_color};}
		.main-navigation > ul > li.current-menu-item:before {background-color: {$main_menu_hover_color};}
		}";
	}
	
	// Social Link Color
	if ( $social_link_color != '' && $social_link_color != '#222222' ) {
		$custom_styles .= "
		@media screen and (min-width: 960px) {
		.social-menu a, .social-menu a[href]:hover {color: {$social_link_color};}
		.has-header-image .header-image .social-menu a {background-color: {$social_link_color};}
		.social-menu a[href]:hover {opacity: .7;}
		}";
	}
	
	// Search Icon Color
	if ( $search_icon_color != '' ) {
		$custom_styles .= "
		@media screen and (min-width: 960px) {
		.top-search-button {color: {$search_icon_color};}
		.top-search-button:hover {opacity: .7;}
		}";
	}
	
	// Header Background Color
	if ( $header_background != '' ) {
		$custom_styles .= ".site-header {background-color: {$header_background};}";
	}
	
	// Navbar Background Color
	if ( $navbar_background != '' ) {
		$custom_styles .= "
		@media screen and (min-width: 960px) {
		.main-navbar {background-color: {$navbar_background};}
		}";
	}
	
	// Footer Copy Background Color
	if ( $footer_copy_background != '' && $footer_copy_background != '#ffffff' ) {
		$custom_styles .= ".site-footer {background-color: {$footer_copy_background};}";
	
		if ( type_get_brightness($footer_copy_background) > 155) {
			$custom_styles .= "
			.site-info, .site-credits  {
			color: rgba(0,0,0,.6);
			}
			.site-info a, .site-credits a,
			.site-info a:hover, .site-credits a:hover {
			color: rgba(0,0,0,.8);
			}";
		} else {
			$custom_styles .= "
			.site-info, .site-credits  {
			color: rgba(255,255,255,.8);
			}
			.site-info a, .site-credits a,
			.site-info a:hover, .site-credits a:hover {
			color: #ffffff;
			}";
		}
	}
	
	// Footer Widget Area Background Color
	if ( $footer_background != '' ) {
		$custom_styles .= ".site-footer .widget-area {background-color: {$footer_background};}";
	
		if ( type_get_brightness($footer_background) > 155) {
			$custom_styles .= "
			.site-footer .widget-area  {
			color: rgba(0,0,0,.6);
			}
			.site-footer .widget-title,
			.site-footer .widget a, .site-footer .widget a:hover {
			color: rgba(0,0,0,.8);
			}
			.site-footer .widget-area ul li {
			border-bottom-color: rgba(0,0,0,.05);
			}
			.site-footer .widget_tag_cloud a {
			border-color: rgba(0,0,0,.05);
			background-color: rgba(0,0,0,.05);
			}";
		}
	}
	
	if ( $custom_styles != '' ) { 
		wp_add_inline_style( 'type-style', $custom_styles );
	}

}
add_action( 'wp_enqueue_scripts', 'type_add_styles' );
