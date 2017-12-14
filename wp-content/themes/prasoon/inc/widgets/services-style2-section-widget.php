<?php
/**
 * Services style 2 section widget.
 */


if( ! class_exists('Prasoon_Services_Style2_Section_Widget')) :
 
class Prasoon_Services_Style2_Section_Widget extends WP_Widget {

    var $defaults;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'pr_services_style2_widget', // Base ID
			__( 'Prasoon: Services 4 Column Section', 'prasoon' ), // Name
			array( 'description' => __( 'Adds Services 4 Column section. Section id : services-1', 'prasoon' ), ) // Args
		);

        $this->defaults = array(
            'color' => '#ffffff',
            'rowsnumber'=>'1',
            'headingcolor' => '#555555',
            'subheadingcolor' => '#555555',            
            'iconbgcolor' => '#e4e4e4',           
            
        );

        add_action( 'admin_enqueue_scripts', function ( $hook_suffix ) {
            if ( ! in_array( $hook_suffix, array( 'widgets.php', 'customize.php' ) ) ) return;
            wp_enqueue_script( 'wp-color-picker' ); wp_enqueue_style( 'wp-color-picker' );
        });
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
    $rowsnumber   =  ! empty( $instance['rowsnumber'] ) ? $instance['rowsnumber'] : $this->defaults['rowsnumber'];    

    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];        
    $iconbgcolor   =  ! empty( $instance['iconbgcolor'] ) ? $instance['iconbgcolor'] : $this->defaults['iconbgcolor'];           
	?>

    <section id="services-1" style="background:<?php echo $color; ?>;">
      <div class="section-inner">
        <div class="container">
          <div class="services-section">
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
              for( $i=1; $i<=4*$rowsnumber; $i++ ) { 

                $font_icon    = ! empty( $instance['font_icon'.$i] ) ? $instance['font_icon'.$i] : '';
                $title    = ! empty( $instance['title'.$i] ) ? $instance['title'.$i] : '';
                $content    = ! empty( $instance['content'.$i] ) ? $instance['content'.$i] : '';
                $button_text    = ! empty( $instance['button_text'.$i] ) ? $instance['button_text'.$i] : '';
                $button_url    = ! empty( $instance['button_url'.$i] ) ? $instance['button_url'.$i] : '';

                ?>
                <div class="col-md-3 col-sm-6">
                  <div class="services-style2 wow fadeInUp" data-wow-duration="3s" data-wow-delay="<?php echo $i/2; ?>s">
                    <?php if(!empty($font_icon)){
                        ?>
                            <div class="icon-service hvr-float" style="background:<?php echo $iconbgcolor; ?>;">
                              <i class="fa <?php echo $font_icon; ?>"  ></i>
                            </div>
                        <?php
                    } ?>
                    
                    <div class="heading">
                      <h4><?php echo $title; ?></h4>
                    </div>
                    <div class="descr">
                      <p><?php echo $content; ?></p>
                    </div>

                    <?php if(!empty($button_text)){
                      ?>
                          <div class="read-more">
                            <a href="<?php echo esc_url($button_url); ?>"><button style="border:0;" type="button" class="btn btn-default black"><?php echo $button_text; ?></button></a>
                          </div>
                      <?php
                    }
                    ?>
                  </div>
                </div> <?php
              } ?>
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
    $rowsnumber   =  ! empty( $instance['rowsnumber'] ) ? $instance['rowsnumber'] : $this->defaults['rowsnumber'];   

    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];        
    $iconbgcolor   =  ! empty( $instance['iconbgcolor'] ) ? $instance['iconbgcolor'] : $this->defaults['iconbgcolor'];           

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
        <label for="<?php echo $this->get_field_id('rowsnumber'); ?>"><?php _e('Number of Rows:','prasoon'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('rowsnumber'); ?>" name="<?php echo $this->get_field_name('rowsnumber'); ?>" type="text" value="<?php echo $rowsnumber; ?>" />
    </p>

    <div class="services-block">
        <?php for( $i = 1; $i <=4*$rowsnumber; $i++ ) { ?>
            <div class="services-block-box">
                <div class="services-block-head"><a href="#"><?php _e('Block','prasoon');echo $i; ?> </a><span class="service-plus">+</span><span class="service-minus">-</span></div>
                <div class="services-block-content">
                    <?php $font_icon = ! empty( $instance['font_icon'.$i] ) ? $instance['font_icon'.$i] : ''; ?>
                    <?php $title = ! empty( $instance['title'.$i] ) ? $instance['title'.$i] : ''; ?>
                    <?php $content = ! empty( $instance['content'.$i] ) ? $instance['content'.$i] : ''; ?>
                    <?php $button_text = ! empty( $instance['button_text'.$i] ) ? $instance['button_text'.$i] : ''; ?>
                    <?php $button_url = ! empty( $instance['button_url'.$i] ) ? $instance['button_url'.$i] : ''; ?>
                    <p>
                        <label for="<?php echo $this->get_field_id( 'font_icon'.$i ); ?>"><?php _e( 'Font-Awesome Icon (for eg: fa-mobile)', 'prasoon' ); ?>:</label>
                        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'font_icon'.$i ); ?>" name="<?php echo $this->get_field_name( 'font_icon'.$i ); ?>" value="<?php echo esc_attr( $font_icon ); ?>" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id( 'title'.$i ); ?>"><?php _e( 'Title', 'prasoon' ); ?>:</label>
                        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title'.$i ); ?>" name="<?php echo $this->get_field_name( 'title'.$i ); ?>" value="<?php echo esc_attr( $title ); ?>" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id( 'content'.$i ); ?>"><?php _e( 'Content', 'prasoon' ); ?>:</label>
                        <textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('content'.$i); ?>" name="<?php echo $this->get_field_name('content'.$i); ?>"><?php echo $content; ?></textarea>
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id( 'button_text'.$i ); ?>"><?php _e( 'Button Text', 'prasoon' ); ?>:</label>
                        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text'.$i ); ?>" name="<?php echo $this->get_field_name( 'button_text'.$i ); ?>" value="<?php echo esc_attr( $button_text ); ?>" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id( 'button_url'.$i ); ?>"><?php _e( 'Button Url', 'prasoon' ); ?>:</label>
                        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_url'.$i ); ?>" name="<?php echo $this->get_field_name( 'button_url'.$i ); ?>" value="<?php echo esc_url( $button_url ); ?>" />
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>

    <h3><?php _e('Color Settings:','prasoon'); ?></h3>
    <div class="services-block">        
        <div class="services-block-box">
            <div class="services-block-head"><a href="#"><?php _e('Color Settings','prasoon'); ?> </a><span class="service-plus">+</span><span class="service-minus">-</span></div>
            <div class="services-block-content">
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
                    <?php _e('This is a pro feature. Buy Pro version','prasoon'); ?>
                </p>

                <h3><?php _e('Button Color:','prasoon'); ?></h3>
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
        $instance[ 'rowsnumber'] = absint( $new_instance['rowsnumber'] );
        $instance[ 'heading'] = wp_filter_post_kses( $new_instance['heading'] );
        $instance[ 'subheading'] = wp_filter_post_kses( $new_instance['subheading'] );
        $instance['color'] = sanitize_hex_color($new_instance['color']);

        for( $i=1; $i<=4*$instance[ 'rowsnumber']; $i++ ) {
            $instance[ 'font_icon'.$i ] = strip_tags( $new_instance[ 'font_icon'.$i ] );
            $instance[ 'title'.$i ] = wp_filter_post_kses($new_instance['title'.$i]);
            $instance[ 'content'.$i ] = wp_filter_post_kses($new_instance['content'.$i]);
            $instance[ 'button_text'.$i ] = wp_filter_post_kses($new_instance['button_text'.$i]);
            $instance[ 'button_url'.$i ] = esc_url($new_instance['button_url'.$i]);
        }

        $instance['headingcolor'] = sanitize_hex_color($new_instance['headingcolor']);
        $instance['subheadingcolor'] = sanitize_hex_color($new_instance['subheadingcolor']);        
        $instance['iconbgcolor'] = sanitize_hex_color($new_instance['iconbgcolor']);        

        return $instance;
	}  

}
endif;



if( ! function_exists('register_prasoon_services_style2_section_widget')) :
// register widget
function register_prasoon_services_style2_section_widget() {
    register_widget( 'Prasoon_Services_Style2_Section_Widget' );
}
endif;


add_action( 'widgets_init', 'register_prasoon_services_style2_section_widget' );
