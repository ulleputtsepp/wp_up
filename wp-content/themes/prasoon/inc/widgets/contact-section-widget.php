<?php

/**
 * Contact Section widget.
 */


if( ! class_exists('Prasoon_Contact_Section_Widget')) :

class Prasoon_Contact_Section_Widget extends WP_Widget {

    var $defaults;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'pr_contact_widget', // Base ID
			__( 'Prasoon: Contact Section', 'prasoon' ), // Name
			array( 'description' => __( 'Adds Contact section. Section id : contact', 'prasoon' ), ) // Args
		);

        $this->defaults = array(            
            'color' => '#f7f7f7',
            'headingcolor' => '#555555',
            'subheadingcolor' => '#555555',
            'contentcolor' => '#555555',
            'iconbgcolor' => '#00bc16',
            'iconcolor' => '#ffffff',
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
    $address = ! empty( $instance['address'] ) ? $instance['address'] : '';
    $email = ! empty( $instance['email'] ) ? $instance['email'] : '';
    $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : '';
    $contactform = ! empty( $instance['contactform'] ) ? $instance['contactform'] : '';   
    $color   =  ! empty( $instance['color'] ) ? $instance['color'] : $this->defaults['color'];
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];    
    $iconbgcolor   =  ! empty( $instance['iconbgcolor'] ) ? $instance['iconbgcolor'] : $this->defaults['iconbgcolor'];    
    $iconcolor   =  ! empty( $instance['iconcolor'] ) ? $instance['iconcolor'] : $this->defaults['iconcolor'];     

    ?>

    <!-- Contact Section Starts -->
      <section id="contact" style="background:<?php echo $color; ?>;color:<?php echo $contentcolor; ?>">
        <div class="section-inner">
          <div class="container">
            <div class="contact-section">
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
                  <div class="col-md-6">
                    <div class="contact-details">

                      <?php if(!empty($address)){
                        ?>
                          <div class="item wow slideInLeft" data-wow-duration="2s" data-wow-delay="1.1s">
                            <span class="icon">
                              <span class="icon-display" style="background:<?php echo $iconbgcolor; ?>">
                                <i class="fa fa-map-marker" style="color:<?php echo $iconcolor; ?>"></i>
                              </span>
                            </span>
                            <span class="text">
                              <address>
                                  <?php echo $address; ?>
                              </address>
                            </span>
                          </div>
                        <?php
                       }
                     ?>
                    
                    <?php if(!empty($email)){
                     ?>
                        <div class="item wow slideInLeft" data-wow-duration="2s" data-wow-delay="1.3s">
                            <span class="icon">
                              <span class="icon-display" style="background:<?php echo $iconbgcolor; ?>">
                                <i class="fa fa-envelope" style="color:<?php echo $iconcolor; ?>"></i>
                              </span>
                            </span>
                            <span class="text">
                              <p><?php echo $email; ?></p>
                            </span>
                          </div>
                     <?php
                    }
                    ?>

                    <?php if(!empty($phone)){
                      ?>
                        <div class="item wow slideInLeft" data-wow-duration="2s" data-wow-delay="1.5s">
                            <span class="icon">
                              <span class="icon-display" style="background:<?php echo $iconbgcolor; ?>">
                                <i class="fa fa-phone" style="color:<?php echo $iconcolor; ?>"></i>
                              </span>
                            </span>
                            <span class="text">
                              <p><?php echo $phone; ?></p>
                            </span>
                        </div>
                      <?php
                    }
                    ?>
                      
                      <div class="social-icons wow fadeInUp" data-wow-duration="2s" data-wow-delay="2s">
                        <h3><?php 
                                if(!empty($instance['icon1'])) {
                                    _e('FOLLOW US','prasoon'); 
                                }                                
                            ?>                                 
                        </h3>
                        <?php
                          for( $i=1; $i <= 5; $i++ ) { 

                            $icon    = ! empty( $instance['icon'.$i] ) ? $instance['icon'.$i] : '';
                            $iconurl    = ! empty( $instance['iconurl'.$i] ) ? $instance['iconurl'.$i] : '';                           

                            if(!empty($icon)){
                                ?><span class="s-icon"><a href="<?php echo esc_url($iconurl); ?>" target="_blank"><i class="fa <?php echo $icon; ?>"></i></a></span><?php
                            }
                            
                          } ?>                       
                        
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-inner wow fadeInUp" data-wow-duration="2s" data-wow-delay="1.5s">
                      <?php echo do_shortcode("$contactform"); ?>
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
    $address = ! empty( $instance['address'] ) ? $instance['address'] : '';
    $email = ! empty( $instance['email'] ) ? $instance['email'] : '';
    $phone = ! empty( $instance['phone'] ) ? $instance['phone'] : ''; 
    $contactform = ! empty( $instance['contactform'] ) ? $instance['contactform'] : ''; 
    $color   =  ! empty( $instance['color'] ) ? $instance['color'] : $this->defaults['color']; 
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];    
    $iconbgcolor   =  ! empty( $instance['iconbgcolor'] ) ? $instance['iconbgcolor'] : $this->defaults['iconbgcolor'];    
    $iconcolor   =  ! empty( $instance['iconcolor'] ) ? $instance['iconcolor'] : $this->defaults['iconcolor']; 

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
        <label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address','prasoon'); ?></label>
        <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>"><?php echo $address; ?></textarea>
    </p>
		<p>
        <label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:','prasoon'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:','prasoon'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" type="text" value="<?php echo $phone; ?>" />
    </p>

    <p>
        <label for="<?php echo $this->get_field_id('contactform'); ?>"><?php _e('Contact Form Shortcode:','prasoon'); ?></label>
        <textarea class="widefat" rows="10" cols="20" id="<?php echo $this->get_field_id('contactform'); ?>" name="<?php echo $this->get_field_name('contactform'); ?>"><?php echo $contactform; ?></textarea>
    </p>

    <h3><?php _e('Social Icons:','prasoon'); ?></h3>

    <p>       
        <?php _e('You can add upto 5 social icons. Upgrade to pro version for unlimited number of icons','prasoon'); ?>
    </p>

    <div class="widget-block">
        <?php for( $i = 1; $i <= 5; $i++ ) { 

            $icon    = ! empty( $instance['icon'.$i] ) ? $instance['icon'.$i] : '';
            $iconurl    = ! empty( $instance['iconurl'.$i] ) ? $instance['iconurl'.$i] : '';

            ?>
            <div class="widget-block-box">
                <div class="widget-block-head"><a href="#"><?php _e('Icon', 'prasoon');echo $i; ?></a><span class="widget-plus">+</span><span class="widget-minus">-</span></div>
                <div class="widget-block-content">
                    <div>
                        <p>
                            <label for="<?php echo $this->get_field_id('icon'.$i); ?>"><?php _e('FontAwesome Icon (eg fa-facebook):','prasoon'); ?></label>
                            <input class="widefat" id="<?php echo $this->get_field_id('icon'.$i); ?>" name="<?php echo $this->get_field_name('icon'.$i); ?>" type="text" value="<?php echo $icon; ?>" />
                        </p>
                        <p>
                            <label for="<?php echo $this->get_field_id('iconurl'.$i); ?>"><?php _e('Icon URL:','prasoon'); ?></label>
                            <input class="widefat" id="<?php echo $this->get_field_id('iconurl'.$i); ?>" name="<?php echo $this->get_field_name('iconurl'.$i); ?>" type="text" value="<?php echo $iconurl; ?>" />
                        </p>
                    </div>
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

                <h3><?php _e('Icon Background Color:','prasoon'); ?></h3>
                <p>
                    <input class="color" type="text" value="<?php echo $iconbgcolor; ?>" id="<?php echo $this->get_field_id( 'iconbgcolor' ); ?>" name="<?php echo $this->get_field_name( 'iconbgcolor' ); ?>" />
                </p>

                <h3><?php _e('Icon Color:','prasoon'); ?></h3>
                <p>
                    <input class="color" type="text" value="<?php echo $iconcolor; ?>" id="<?php echo $this->get_field_id( 'iconcolor' ); ?>" name="<?php echo $this->get_field_name( 'iconcolor' ); ?>" />
                </p>          

                <p><?php _e('Note: Social icons colors can be set from main Color Settings','prasoon'); ?></p>

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
        $instance['address'] = wp_filter_post_kses($new_instance['address']);
        $instance['email'] = wp_filter_post_kses($new_instance['email']);
        $instance['phone'] = wp_filter_post_kses($new_instance['phone']);
        $instance['contactform'] = strip_tags($new_instance['contactform']);
        $instance['color'] = sanitize_hex_color($new_instance['color']);
        $instance['headingcolor'] = sanitize_hex_color($new_instance['headingcolor']);
        $instance['subheadingcolor'] = sanitize_hex_color($new_instance['subheadingcolor']);
        $instance['iconbgcolor'] = sanitize_hex_color($new_instance['iconbgcolor']);
        $instance['iconcolor'] = sanitize_hex_color($new_instance['iconcolor']);

        for( $i=1; $i <= 5; $i++ ) { 
            $instance['icon'.$i]  = wp_filter_post_kses( $new_instance['icon'.$i] );
            $instance['iconurl'.$i]  = esc_url($new_instance['iconurl'.$i]);
        }

        return $instance;
	}

}
endif;


if( ! function_exists('register_prasoon_contact_section_widget')) :
// register widget
function register_prasoon_contact_section_widget() {
    register_widget( 'Prasoon_Contact_Section_Widget' );
}
endif;

add_action( 'widgets_init', 'register_prasoon_contact_section_widget' );