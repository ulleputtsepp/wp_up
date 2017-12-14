<?php
/**
 * Team section widget.
 */


if( ! class_exists('Prasoon_Team_Section_Widget')) :
 
class Prasoon_Team_Section_Widget extends WP_Widget {

    var $defaults;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'pr_team_style2_widget', // Base ID
			__( 'Prasoon: Team Section', 'prasoon' ), // Name
			array( 'description' => __( 'Adds Team section. Section id : team', 'prasoon' ), ) // Args
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
    $color   =  ! empty( $instance['color'] ) ? $instance['color'] : $this->defaults['color'];  
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];        

	?>

    <section id="team" style="background:<?php echo $color; ?>;">
        <div class="section-inner">
            <div class="container">
                <div class="team-section">
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

                            <?php
                                for( $i=1; $i<=4; $i++ ) { 

                                    $image    = ! empty( $instance['image'.$i] ) ? $instance['image'.$i] : '';
                                    $name    = ! empty( $instance['name'.$i] ) ? $instance['name'.$i] : '';
                                    $descr    = ! empty( $instance['descr'.$i] ) ? $instance['descr'.$i] : '';
                                    $desg    = ! empty( $instance['desg'.$i] ) ? $instance['desg'.$i] : '';
                                    $icon1    = ! empty( $instance['icon1'.$i] ) ? $instance['icon1'.$i] : '';
                                    $icon1url    = ! empty( $instance['icon1url'.$i] ) ? $instance['icon1url'.$i] : '';
                                    $icon2    = ! empty( $instance['icon2'.$i] ) ? $instance['icon2'.$i] : '';
                                    $icon2url    = ! empty( $instance['icon2url'.$i] ) ? $instance['icon2url'.$i] : '';
                                    $icon3    = ! empty( $instance['icon3'.$i] ) ? $instance['icon3'.$i] : '';
                                    $icon3url    = ! empty( $instance['icon3url'.$i] ) ? $instance['icon3url'.$i] : '';

                                    ?>

                                    <?php if(!empty($image)){
                                            ?>
                                            <div class="col-md-3 col-sm-6">
                                                <div class="team-container wow fadeInUp" data-wow-duration="3s" data-wow-delay="<?php echo $i/2; ?>s">
                                                    <div class="team view-team">
                                                        <div class="image-container">
                                                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(basename($image)); ?>">
                                                        </div>    
                                                        
                                                        <div class="team-mask">
                                                            <h4><?php echo $name; ?></h4>
                                                            <p><?php echo $descr; ?></p>                                                    
                                                            <span class="team"><a href="<?php echo esc_url($icon1url); ?>"><i class="fa <?php echo $icon1; ?>"></i></a></span>
                                                            <span class="team"><a href="<?php echo esc_url($icon2url); ?>"><i class="fa <?php echo $icon2; ?>"></i></a></span>
                                                            <span class="team"><a href="<?php echo esc_url($icon3url); ?>"><i class="fa <?php echo $icon3; ?>"></i></a></span>
                                                        </div>
                                                    </div>
                                                    <div class="description">
                                                        <h4><?php echo $name; ?></h4>
                                                        <span><?php echo $desg; ?></span>
                                                    </div>
                                                </div>
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
    

    <br/>
    <label><strong><?php _e('Add Team Members:','prasoon'); ?></strong></label><br/>

    <p>
       <?php _e('You can add upto 4 Team members. Upgrade to pro version for unlimited number of team members','prasoon'); ?>
    </p>

    <div class="widget-block">
        <?php for( $i = 1; $i <= 4; $i++ ) { 

            $image    = ! empty( $instance['image'.$i] ) ? $instance['image'.$i] : '';
            $name    = ! empty( $instance['name'.$i] ) ? $instance['name'.$i] : '';
            $descr    = ! empty( $instance['descr'.$i] ) ? $instance['descr'.$i] : '';
            $desg    = ! empty( $instance['desg'.$i] ) ? $instance['desg'.$i] : '';
            $icon1    = ! empty( $instance['icon1'.$i] ) ? $instance['icon1'.$i] : '';
            $icon1url    = ! empty( $instance['icon1url'.$i] ) ? $instance['icon1url'.$i] : '';
            $icon2    = ! empty( $instance['icon2'.$i] ) ? $instance['icon2'.$i] : '';
            $icon2url    = ! empty( $instance['icon2url'.$i] ) ? $instance['icon2url'.$i] : '';
            $icon3    = ! empty( $instance['icon3'.$i] ) ? $instance['icon3'.$i] : '';
            $icon3url    = ! empty( $instance['icon3url'.$i] ) ? $instance['icon3url'.$i] : '';            

            ?>
            <div class="widget-block-box">
                <div class="widget-block-head"><a href="#"><?php _e('Team Member', 'prasoon');echo $i; ?></a><span class="widget-plus">+</span><span class="widget-minus">-</span></div>
                <div class="widget-block-content">  

                    <div>
                        <label for="<?php echo $this->get_field_id( 'image'.$i ); ?>"><?php _e('Image URL', 'prasoon'); ?>:</label>
                        <input type="text" id="<?php echo $this->get_field_id( 'image'.$i ); ?>" name="<?php echo $this->get_field_name( 'image'.$i ); ?>" value="<?php echo esc_url($image); ?>" class="pr-img-field"/>
                        <a href="#" class="pr-img-select-image-btn button"><?php _e('Select image', 'prasoon'); ?></a>
                    </div>                  
                    <p>
                        <label for="<?php echo $this->get_field_id('name'.$i); ?>"><?php _e('Name','prasoon'); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('name'.$i); ?>" name="<?php echo $this->get_field_name('name'.$i); ?>" type="text" value="<?php echo $name; ?>" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id('desg'.$i); ?>"><?php _e('Designation','prasoon'); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('desg'.$i); ?>" name="<?php echo $this->get_field_name('desg'.$i); ?>" type="text" value="<?php echo $desg; ?>" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id('descr'.$i); ?>"><?php _e('Small Description','prasoon'); ?></label>
                        <textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('descr'.$i); ?>" name="<?php echo $this->get_field_name('descr'.$i); ?>"><?php echo $descr; ?></textarea>
                    </p>

                    <p>
                        <label for="<?php echo $this->get_field_id('icon1'.$i); ?>"><?php _e( 'Font-Awesome Icon1 (for eg: fa-facebook)', 'prasoon' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('icon1'.$i); ?>" name="<?php echo $this->get_field_name('icon1'.$i); ?>" type="text" value="<?php echo $icon1; ?>" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id('icon1url'.$i); ?>"><?php _e( 'Icon1 Url', 'prasoon' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('icon1url'.$i); ?>" name="<?php echo $this->get_field_name('icon1url'.$i); ?>" type="text" value="<?php echo esc_url($icon1url); ?>" />
                    </p>

                    <p>
                        <label for="<?php echo $this->get_field_id('icon2'.$i); ?>"><?php _e( 'Font-Awesome Icon2 (for eg: fa-twitter)', 'prasoon' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('icon2'.$i); ?>" name="<?php echo $this->get_field_name('icon2'.$i); ?>" type="text" value="<?php echo $icon2; ?>" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id('icon2url'.$i); ?>"><?php _e( 'Icon2 Url', 'prasoon' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('icon2url'.$i); ?>" name="<?php echo $this->get_field_name('icon2url'.$i); ?>" type="text" value="<?php echo esc_url($icon2url); ?>" />
                    </p>

                    <p>
                        <label for="<?php echo $this->get_field_id('icon3'.$i); ?>"><?php _e( 'Font-Awesome Icon3 (for eg: fa-google-plus)', 'prasoon' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('icon3'.$i); ?>" name="<?php echo $this->get_field_name('icon3'.$i); ?>" type="text" value="<?php echo $icon3; ?>" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id('icon3url'.$i); ?>"><?php _e( 'Icon3 Url', 'prasoon' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('icon3url'.$i); ?>" name="<?php echo $this->get_field_name('icon3url'.$i); ?>" type="text" value="<?php echo esc_url($icon3url); ?>" />
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
        $instance['color'] = sanitize_hex_color($new_instance['color']);

        for( $i=1; $i<=4; $i++ ) { 
            $instance['image'.$i]  = strip_tags( $new_instance['image'.$i] );         
            $instance['name'.$i] = wp_filter_post_kses($new_instance['name'.$i]);
            $instance['descr'.$i] = wp_filter_post_kses($new_instance['descr'.$i]);
            $instance['desg'.$i] = wp_filter_post_kses($new_instance['desg'.$i]);
            $instance['icon1'.$i] = wp_filter_post_kses($new_instance['icon1'.$i]);
            $instance['icon1url'.$i] = esc_url($new_instance['icon1url'.$i]);
            $instance['icon2'.$i] = wp_filter_post_kses($new_instance['icon2'.$i]);
            $instance['icon2url'.$i] = esc_url($new_instance['icon2url'.$i]);
            $instance['icon3'.$i] = wp_filter_post_kses($new_instance['icon3'.$i]);
            $instance['icon3url'.$i] = esc_url($new_instance['icon3url'.$i]);
            
        }

        $instance['headingcolor'] = sanitize_hex_color($new_instance['headingcolor']);
        $instance['subheadingcolor'] = sanitize_hex_color($new_instance['subheadingcolor']);        

        return $instance;
	}   

}
endif;



if( ! function_exists('register_prasoon_team_section_widget')) :
// register widget
function register_prasoon_team_section_widget() {
    register_widget( 'Prasoon_Team_Section_Widget' );
}
endif;


add_action( 'widgets_init', 'register_prasoon_team_section_widget' );
