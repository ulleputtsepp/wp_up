<?php
/**
 * About style 2 section widget.
 */


if( ! class_exists('Prasoon_About_Style2_Section_Widget')) :
 
class Prasoon_About_Style2_Section_Widget extends WP_Widget {

    var $defaults;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'pr_about_style2_widget', // Base ID
			__( 'Prasoon: About Style 2 Section', 'prasoon' ), // Name
			array( 'description' => __( 'Adds about style2 section. Section id : about-1', 'prasoon' ), ) // Args
		);

        $this->defaults = array(
            'number' => '6',
            'color' => '#ffffff',
            'skillcolor' => '#00a8e1',
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
    $image =  ! empty( $instance['image'] ) ? $instance['image'] : ''; 
    $skillsheading= ! empty( $instance['skillsheading'] ) ? $instance['skillsheading'] : ''; 
    $number   =  ! empty( $instance['number'] ) ? $instance['number'] : $this->defaults['number'];

    $skillcolor   =  ! empty( $instance['skillcolor'] ) ? $instance['skillcolor'] : $this->defaults['skillcolor'];
    $color   =  ! empty( $instance['color'] ) ? $instance['color'] : $this->defaults['color'];
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];    
    

	?>

    <!-- Begin About Section -->
    <section id="about-1" style="background:<?php echo $color; ?>;">
        <div class="section-inner">
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
                        <div class="content wow fadeInUp" data-wow-duration="2s" data-wow-delay="1.5s">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="inner-content">
                                    <p><?php echo $content; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section id="content-style1" style="background:<?php echo $color; ?>;">
        <div class="section-inner content-style-1">
            <div class="container">
                <div class="content-section">                   
                    <div class="row">
                        <div class="content">
                            <div class="col-md-6">
                                <div class="image wow fadeInLeft" data-wow-duration="2s" data-wow-delay="1s">
                                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(basename($image)); ?>" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="title wow fadeInRight" data-wow-duration="2s" data-wow-delay="1s" style="text-align:left;">
                                    <h3 style="color:<?php echo $headingcolor; ?>"><?php echo $skillsheading; ?></h3>
                                </div>
                                <div class="skills-content">                                    
                                    <ul class="progress-skill-bar">
                                        <?php
                                            for( $i=1; $i<=$number; $i++ ) { 
                                                $skillname    = ! empty( $instance['skillname'.$i] ) ? $instance['skillname'.$i] : '';
                                                $skillvalue    = ! empty( $instance['skillvalue'.$i] ) ? $instance['skillvalue'.$i] : '';                        
                                                ?>
                                                <?php if(!empty($skillname) && !empty($skillvalue)){
                                                    ?>
                                                        <li>
                                                            <span><b><?php echo $skillname; ?></b> - <?php echo $skillvalue; ?>%</span>
                                                            <div class="progress_skill">
                                                                <div style="background:<?php echo $skillcolor; ?>" class="bar" data-value="<?php echo $skillvalue; ?>" role="progressbar" data-height="100" style="width: <?php echo $skillvalue; ?>%; height: 100%;">
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php
                                                }                                            
                                            }
                                        ?>
                                    </ul>
                                </div>
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
    $image =  ! empty( $instance['image'] ) ? $instance['image'] : '';     
    $skillsheading= ! empty( $instance['skillsheading'] ) ? $instance['skillsheading'] : '';
    $number   =  ! empty( $instance['number'] ) ? $instance['number'] : $this->defaults['number'];

    $skillcolor   =  ! empty( $instance['skillcolor'] ) ? $instance['skillcolor'] : $this->defaults['skillcolor'];
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

    <h3><?php _e('Left Image and Skills Section:','prasoon'); ?></h3><br/>
    <div>
        <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Image URL', 'prasoon'); ?>:</label>
        <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image'); ?>" value="<?php echo esc_url($image); ?>" class="pr-img-field"/>
        <a href="#" class="pr-img-select-image-btn button"><?php _e('Select image', 'prasoon'); ?></a>
    </div>
    <p>
        <label for="<?php echo $this->get_field_id('skillsheading'); ?>"><?php _e('Skill Section Heading:','prasoon'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('skillsheading'); ?>" name="<?php echo $this->get_field_name('skillsheading'); ?>" type="text" value="<?php echo $skillsheading; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Skills:','prasoon'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
    </p>
    <div class="widget-block">
        <?php 
            for( $i = 1; $i <= $number; $i++ ) {    
                $skillname    = ! empty( $instance['skillname'.$i] ) ? $instance['skillname'.$i] : '';
                $skillvalue    = ! empty( $instance['skillvalue'.$i] ) ? $instance['skillvalue'.$i] : '';                                          
                
                ?>
                    <div class="widget-block-box">
                        <div class="widget-block-head"><a href="#"><?php _e('Skill', 'prasoon');echo $i; ?></a><span class="widget-plus">+</span><span class="widget-minus">-</span></div>
                        <div class="widget-block-content">
                            <p>
                                <label for="<?php echo $this->get_field_id('skillname'.$i); ?>"><?php _e('Skill Name','prasoon');echo $i; ?></label>
                                <input class="widefat" id="<?php echo $this->get_field_id('skillname'.$i); ?>" name="<?php echo $this->get_field_name('skillname'.$i); ?>" type="text" value="<?php echo $skillname; ?>" />
                                <label for="<?php echo $this->get_field_id('skillvalue'.$i); ?>"><?php _e('Skill Value','prasoon'); echo $i.' Without %'; ?></label>
                                <input class="widefat" id="<?php echo $this->get_field_id('skillvalue'.$i); ?>" name="<?php echo $this->get_field_name('skillvalue'.$i); ?>" type="text" value="<?php echo $skillvalue; ?>" />
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

                <h3><?php _e('Skill Bar color:','prasoon'); ?></h3>
                <p>
                    <input class="color" type="text" value="<?php echo $skillcolor; ?>" id="<?php echo $this->get_field_id( 'skillcolor' ); ?>" name="<?php echo $this->get_field_name( 'skillcolor' ); ?>" />
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
        $instance['image']  = strip_tags( $new_instance['image'] );
        $instance['skillsheading']   = wp_filter_post_kses($new_instance['skillsheading']);
        $instance['number'] = absint($new_instance['number']);
        $instance['skillcolor'] = sanitize_hex_color($new_instance['skillcolor']);
        $instance['color'] = sanitize_hex_color($new_instance['color']);

        for( $i=1; $i<= $instance['number']; $i++ ) {          
            $instance['skillname'.$i] = wp_filter_post_kses($new_instance['skillname'.$i]);
            $instance['skillvalue'.$i] = wp_filter_post_kses($new_instance['skillvalue'.$i]);
        }

        $instance['headingcolor'] = sanitize_hex_color($new_instance['headingcolor']);
        $instance['subheadingcolor'] = sanitize_hex_color($new_instance['subheadingcolor']);       

        return $instance;
	}    

}
endif;



if( ! function_exists('register_prasoon_about_style2_section_widget')) :
// register widget
function register_prasoon_about_style2_section_widget() {
    register_widget( 'Prasoon_About_Style2_Section_Widget' );
}
endif;

add_action( 'widgets_init', 'register_prasoon_about_style2_section_widget' );