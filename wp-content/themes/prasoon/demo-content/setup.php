<?php
/**
 * Functions to provide support for the One Click Demo Import plugin (wordpress.org/plugins/one-click-demo-import)
 *
 * @package prasoon
 */


/**
 *  Set Import files
 */
function prasoon_set_import_files() {
    return array(
        array(
            'import_file_name'           => __('Demo content', 'prasoon'),
            'local_import_file'          => trailingslashit( get_template_directory() ) . 'demo-content/files/demo-content.xml',           
            'local_import_widget_file'   => trailingslashit( get_template_directory() ) . 'demo-content/files/demo-widgets.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/files/demo-customizer.dat',            
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'prasoon_set_import_files' );

/**
 * Actions after import
 */
function prasoon_after_import_setup() {

	//Assign menus to their locations
    $main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    //Assign front page
    $front_page = get_page_by_title( 'Home' );  
    $blog_page = get_page_by_title( 'Blog Default' );  

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page -> ID );    
    update_option( 'page_for_posts', $blog_page -> ID ); 

    //Assign the Front Page template
    update_post_meta( $front_page -> ID, '_wp_page_template', 'page-templates/business-template.php' );

}
add_action( 'pt-ocdi/after_import', 'prasoon_after_import_setup' );