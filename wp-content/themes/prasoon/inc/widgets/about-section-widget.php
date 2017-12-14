<?php
/**
 * About section widget.
 */


if( ! class_exists('Prasoon_About_Section_Widget')) :
 
class Prasoon_About_Section_Widget extends WP_Widget {

    var $defaults;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'pr_about_widget', // Base ID
			__( 'Prasoon: About Section', 'prasoon' ), // Name
			array( 'description' => __( 'Adds about section. Section id : about', 'prasoon' ),) // Args
		);
        
        $this->defaults = array(            
            'color' => '#ffffff',            
            'headingcolor' => '#555555',
            'subheadingcolor' => '#555555',            
        );        

        add_action( 'admin_enqueue_scripts', function ( $hook_suffix ) {
            if ( ! in_array( $hook_suffix, array( 'widgets.php', 'customize.php' ) ) ) return;
            wp_enqueue_script( 'wp-color-picker' ); wp_enqueue_style( 'wp-color-picker' );
        }) ;        
	}

    
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	extract( $args );
    extract( wp_parse_args( $instance, $this->defaults ) ); 

    $heading    = ! empty( $instance['heading'] ) ? $instance['heading'] : '';
    $subheading = ! empty( $instance['subheading'] ) ? $instance['subheading'] : '';
	$content = ! empty( $instance['content'] ) ? $instance['content'] : '';
	$buttontext = ! empty( $instance['buttontext'] ) ? $instance['buttontext'] : '';
    $buttonurl = ! empty( $instance['buttonurl'] ) ? $instance['buttonurl'] : '';
    $image =  ! empty( $instance['image'] ) ? $instance['image'] : ''; 
    $image_desc = ! empty( $instance['image_desc'] ) ? $instance['image_desc'] : ''; 

    $color   =  ! empty( $instance['color'] ) ? $instance['color'] : $this->defaults['color'];
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];    
  

	?>
	
    <section id="about" style="background:<?php echo $color; ?>;">
	   <div class="section-inner wow fadeInUp">
            <div class="container">
                <div class="about-section">
                    <div class="row">
                        <div class="title wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">
                            <div class="col-md-12">
                                <h3 style="color:<?php echo $headingcolor; ?>"><?php echo $heading; ?></h3>
                                <p style="color:<?php echo $subheadingcolor; ?>"><?php echo $subheading; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="content">
                            <div class="col-md-5 col-sm-12 col-xs-12 wow slideInLeft" data-wow-duration="2s" data-wow-delay="1.5s">
                                <p><?php echo $content; ?></p>
                                <?php 
                                    if(!empty($buttontext)):
                                        ?><a href="<?php echo esc_url($buttonurl); ?>"><button style="border:0;" type="button" class="btn btn-default black"><?php echo $buttontext; ?> <i class="fa fa-angle-double-right"></i></button></a><?php 
                                    endif 
                                ?>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12 wow slideInRight" data-wow-duration="2s" data-wow-delay="1.5s">
                                <?php
                                    if(!empty($image)):
                                        ?><img class="img-responsive" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(basename($image)); ?>"><?php        
                                    endif;
                                ?>                                
                                <?php 
                                    if(!empty($image_desc)):
                                        ?><p class="img-descr"><?php echo $image_desc; ?></p><?php 
                                    endif 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
	
    <?php

	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
    extract( wp_parse_args( $instance, $this->defaults ) );

	$heading    = ! empty( $instance['heading'] ) ? $instance['heading'] : '';
    $subheading = ! empty( $instance['subheading'] ) ? $instance['subheading'] : '';
    $content = ! empty( $instance['content'] ) ? $instance['content'] : '';
    $buttontext = ! empty( $instance['buttontext'] ) ? $instance['buttontext'] : '';
    $buttonurl = ! empty( $instance['buttonurl'] ) ? $instance['buttonurl'] : '';
    $image =  ! empty( $instance['image'] ) ? $instance['image'] : ''; 
    $image_desc = ! empty( $instance['image_desc'] ) ? $instance['image_desc'] : ''; 

    $color   =  ! empty( $instance['color'] ) ? $instance['color'] : $this->defaults['color']; 
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];   
   

    ?>

    <script>
        jQuery(document).ready(function($) {
            $('#widgets-right .color, .inactive-sidebar .color').wpColorPicker({change: _.throttle( function () { $(this).trigger('change'); }, 1000, {leading: false} )});
            // Executes wpColorPicker function after AJAX is fired on saving the widget
            $(document).ajaxComplete(function() {
                $('#widgets-right .color, .inactive-sidebar .color').wpColorPicker({change: _.throttle( function () { $(this).trigger('change'); }, 1000, {leading: false} )});
            });        
        });
    </script>

   

    <p>
        <label for="<?php echo $this->get_field_id('heading'); ?>"><?php _e('Heading:','prasoon'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('heading'); ?>" name="<?php echo $this->get_field_name('heading'); ?>" type="text" value="<?php echo $heading; ?>" />
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('subheading'); ?>"><?php _e('Sub heading:','prasoon'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('subheading'); ?>" name="<?php echo $this->get_field_name('subheading'); ?>" type="text" value="<?php echo $subheading; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('About Content','prasoon'); ?></label>
        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"><?php echo $content; ?></textarea>
    </p>
	<p>
        <label for="<?php echo $this->get_field_id('buttontext'); ?>"><?php _e('Button Text:','prasoon'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('buttontext'); ?>" name="<?php echo $this->get_field_name('buttontext'); ?>" type="text" value="<?php echo $buttontext; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('buttonurl'); ?>"><?php _e('Button URL:','prasoon'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('buttonurl'); ?>" name="<?php echo $this->get_field_name('buttonurl'); ?>" type="text" value="<?php echo $buttonurl; ?>" />
    </p>

    <div>
        <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Image URL', 'prasoon'); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_url($image); ?>" class="pr-img-field"/>
        <a href="#" class="pr-img-select-image-btn button"><?php _e('Select image', 'prasoon'); ?></a>
    </div>

    <p>
        <label for="<?php echo $this->get_field_id('image_desc'); ?>"><?php _e('Image Description','prasoon'); ?></label>
        <textarea class="widefat" rows="5" cols="8" id="<?php echo $this->get_field_id('image_desc'); ?>" name="<?php echo $this->get_field_name('image_desc'); ?>"><?php echo $image_desc; ?></textarea>
    </p>

    <h3><?php _e('Color Settings:','prasoon'); ?></h3>
    <div class="widget-block">        
        <div class="widget-block-box">
            <div class="widget-block-head"><a href="#"><?php _e('Color Settings','prasoon'); ?> </a><span class="widget-plus">+</span><span class="widget-minus">-</span></div>
            <div class="widget-block-content">
                <h3><?php _e('Background Color:','prasoon'); ?></h3>
                <p>
                    <input class="color" type="text" value="<?php echo $color; ?>" id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' ); ?>" />
                </p>

                <h3><?php _e('Content Color:','prasoon'); ?></h3>
                <p>
                    <?php _e('This is a pro feature. Buy Pro version','prasoon'); ?>
                </p>

                <h3><?php _e('Heading Color:','prasoon'); ?></h3>
                <p>
                    <input class="color" type="text" value="<?php echo $headingcolor; ?>" id="<?php echo $this->get_field_id( 'headingcolor' ); ?>" name="<?php echo $this->get_field_name( 'headingcolor' ); ?>" />
                </p>

                <h3><?php _e('Sub Heading Color:','prasoon'); ?></h3>
                <p>
                    <input class="color" type="text" value="<?php echo $subheadingcolor; ?>" id="<?php echo $this->get_field_id( 'subheadingcolor' ); ?>" name="<?php echo $this->get_field_name( 'subheadingcolor' ); ?>" />
                </p>                

                <h3><?php _e('Button Background Color:','prasoon'); ?></h3>
                <p>
                    <?php _e('This is a pro feature. Buy Pro version','prasoon'); ?>
                </p>

                <h3><?php _e('Button Text Color:','prasoon'); ?></h3>
                <p>
                    <?php _e('This is a pro feature. Buy Pro version','prasoon'); ?>
                </p>

            </div>
        </div>  
    </div>


    <?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
        $instance['heading'] = wp_filter_post_kses($new_instance['heading']);
        $instance['subheading'] = wp_filter_post_kses($new_instance['subheading']);
		$instance['content'] = wp_filter_post_kses($new_instance['content']);
        $instance['buttontext'] = wp_filter_post_kses($new_instance['buttontext']);
        $instance['buttonurl'] = esc_url($new_instance['buttonurl']);
        $instance['image']  = strip_tags( $new_instance['image'] );
        $instance['image_desc']   = wp_filter_post_kses($new_instance['image_desc']);
        $instance['color'] = sanitize_hex_color($new_instance['color']);
        $instance['headingcolor'] = sanitize_hex_color($new_instance['headingcolor']);
        $instance['subheadingcolor'] = sanitize_hex_color($new_instance['subheadingcolor']);      

        return $instance;
	}

}
endif;

if( ! function_exists('register_prasoon_about_section_widget')) :
// register widget
function register_prasoon_about_section_widget() {
    register_widget( 'Prasoon_About_Section_Widget' );
}
endif;

add_action( 'widgets_init', 'register_prasoon_about_section_widget' );