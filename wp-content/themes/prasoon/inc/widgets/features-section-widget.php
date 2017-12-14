<?php
/**
 * Features section widget.
 */


if( ! class_exists('Prasoon_Features_Section_Widget')) :
 
class Prasoon_Features_Section_Widget extends WP_Widget {

    var $defaults;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'pr_features_widget', // Base ID
			__( 'Prasoon: Features Section', 'prasoon' ), // Name
			array( 'description' => __( 'Adds Features section. Section id : features', 'prasoon' ), ) // Args
		);

        $this->defaults = array(
            'color' => '#fbfbfb',
            'headingcolor' => '#555555',
            'subheadingcolor' => '#555555',            
            'fheadingcolor' => '#555555',            
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
    $image =  ! empty( $instance['image'] ) ? $instance['image'] : '';     

    $color   =  ! empty( $instance['color'] ) ? $instance['color'] : $this->defaults['color'];
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];        
    $fheadingcolor   =  ! empty( $instance['fheadingcolor'] ) ? $instance['fheadingcolor'] : $this->defaults['fheadingcolor'];     

	?>

    <section id="features" style="background:<?php echo $color; ?>;">
        <div class="section-inner content-style-2">
            <div class="container">
                <div class="content-section">
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
                            <div class="col-md-3">
                                <?php
                                for( $i=1; $i<4; $i++ ) { 
                                    $fheading    = ! empty( $instance['fheading'.$i] ) ? $instance['fheading'.$i] : '';
                                    $fsubheading    = ! empty( $instance['fsubheading'.$i] ) ? $instance['fsubheading'.$i] : '';                        

                                    ?>
                                    <?php if(!empty($fheading)){
                                        ?>
                                        <div class="content-block wow slideInLeft" data-wow-duration="2s" data-wow-delay="<?php echo $i/3; ?>s">
                                            <span class="badge"><label><?php echo $i ;?></label></span>
                                            <h5 style="color:<?php echo $fheadingcolor; ?>"><?php echo $fheading; ?></h5>
                                            <p><?php echo $fsubheading; ?></p>
                                        </div>
                                        <?php
                                    }
                                    
                                }
                                ?>
                            </div>

                            <div class="col-md-6">
                                <div class="content-image wow fadeInUp" data-wow-duration="2s" data-wow-delay="1.5s">
                                    <img src="<?php echo esc_url($image); ?>" class="img-responsive" alt="<?php echo esc_attr(basename($image)); ?>" style="width:100%;">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <?php
                                for( $i=4; $i<7; $i++ ) { 
                                    $fheading    = ! empty( $instance['fheading'.$i] ) ? $instance['fheading'.$i] : '';
                                    $fsubheading    = ! empty( $instance['fsubheading'.$i] ) ? $instance['fsubheading'.$i] : '';                        

                                    ?>

                                    <?php if(!empty($fheading)){
                                        ?>
                                        <div class="content-block wow slideInRight" data-wow-duration="2s" data-wow-delay="<?php echo $i/3; ?>s">
                                            <span class="badge"><label><?php echo $i ;?></label></span>
                                            <h5 style="color:<?php echo $fheadingcolor; ?>"><?php echo $fheading; ?></h5>
                                            <p><?php echo $fsubheading; ?></p>
                                        </div>
                                        <?php
                                    }                                   
                                }
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
    $image =  ! empty( $instance['image'] ) ? $instance['image'] : ''; 

    $color   =  ! empty( $instance['color'] ) ? $instance['color'] : $this->defaults['color']; 
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];        
    $fheadingcolor   =  ! empty( $instance['fheadingcolor'] ) ? $instance['fheadingcolor'] : $this->defaults['fheadingcolor'];
   

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

    <div>
        <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Center Image URL', 'prasoon'); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'image'); ?>" name="<?php echo $this->get_field_name( 'image'); ?>" value="<?php echo esc_url($image); ?>" class="pr-img-field"/>
        <a href="#" class="pr-img-select-image-btn button"><?php _e('Select image', 'prasoon'); ?></a>
    </div>
  
    <br/>
    <label><strong><?php _e('Features list:','prasoon'); ?></strong></label><br/>

    <div class="widget-block">
        <?php for( $i = 1; $i < 7; $i++ ) { 

            $fheading    = ! empty( $instance['fheading'.$i] ) ? $instance['fheading'.$i] : '';
            $fsubheading    = ! empty( $instance['fsubheading'.$i] ) ? $instance['fsubheading'.$i] : '';   

            ?>
            <div class="widget-block-box">
                <div class="widget-block-head"><a href="#"><?php _e('Feature', 'prasoon');echo $i; ?></a><span class="widget-plus">+</span><span class="widget-minus">-</span></div>
                <div class="widget-block-content">                    
                    <p>
                        <label for="<?php echo $this->get_field_id('fheading'.$i); ?>"><?php _e('Heading','prasoon');echo $i; ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('fheading'.$i); ?>" name="<?php echo $this->get_field_name('fheading'.$i); ?>" type="text" value="<?php echo $fheading; ?>" />
                        <label for="<?php echo $this->get_field_id('fsubheading'.$i); ?>"><?php _e('Subheading','prasoon');echo $i; ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('fsubheading'.$i); ?>" name="<?php echo $this->get_field_name('fsubheading'.$i); ?>" type="text" value="<?php echo $fsubheading; ?>" />
                    </p>
                </div>
            </div>
            <?php
        }
        ?>
    </div>     

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

                <h3><?php _e('Small Heading Color:','prasoon'); ?></h3>
                <p>
                    <input class="color" type="text" value="<?php echo $fheadingcolor; ?>" id="<?php echo $this->get_field_id( 'fheadingcolor' ); ?>" name="<?php echo $this->get_field_name( 'fheadingcolor' ); ?>" />
                </p>

                <h3><?php _e('Icon Background Color:','prasoon'); ?></h3>
                <p>
                    <?php _e('This is a pro feature. Buy Pro version','prasoon'); ?>
                </p>

                <h3><?php _e('Icon Color:','prasoon'); ?></h3>
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
        $instance['image']  = strip_tags( $new_instance['image'] );        
        $instance['color'] = sanitize_hex_color($new_instance['color']);

        for( $i=1; $i<7; $i++ ) {          
            $instance['fheading'.$i] = wp_filter_post_kses($new_instance['fheading'.$i]);
            $instance['fsubheading'.$i] = wp_filter_post_kses($new_instance['fsubheading'.$i]);
        }

        $instance['headingcolor'] = sanitize_hex_color($new_instance['headingcolor']);
        $instance['subheadingcolor'] = sanitize_hex_color($new_instance['subheadingcolor']);        
        $instance['fheadingcolor'] = sanitize_hex_color($new_instance['fheadingcolor']);        

        return $instance;
	}    

}
endif;



if( ! function_exists('register_prasoon_features_section_widget')) :
// register widget
function register_prasoon_features_section_widget() {
    register_widget( 'Prasoon_Features_Section_Widget' );
}
endif;


add_action( 'widgets_init', 'register_prasoon_features_section_widget' );
