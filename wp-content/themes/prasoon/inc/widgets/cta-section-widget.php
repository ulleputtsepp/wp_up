<?php
/**
 * Call to Action Section widget.
 */


if( ! class_exists('Prasoon_CTA_Section_Widget')) :

class Prasoon_CTA_Section_Widget extends WP_Widget {

	var $defaults;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'pr_cta_widget', // Base ID
			__( 'Prasoon: Call to Action Section', 'prasoon' ), // Name
			array( 'description' => __( 'Adds Call to Action section. Section id : cta', 'prasoon' ), ) // Args
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
    	$button_text    = ! empty( $instance['button_text'] ) ? $instance['button_text'] : '';
        $button_url    = ! empty( $instance['button_url'] ) ? $instance['button_url'] : '';
		$image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		$radio_buttons= ! empty( $instance['radio_buttons'] ) ? $instance['radio_buttons'] : '';
		$ps_radio_buttons= ! empty( $instance['ps_radio_buttons'] ) ? $instance['ps_radio_buttons'] : '';		

		?>

		<?php 
			if ($radio_buttons === 'radio_option_1') {
				if($ps_radio_buttons === 'ps_radio_option_1') {
					?><section id="cta" style="background:url(<?php echo esc_url($image); ?>) no-repeat;background-attachment:fixed;background-size:cover;"><?php					
				}
				else{
					?><section id="cta" data-parallax="scroll" data-image-src="<?php echo esc_url($image); ?>"><?php										
				}						
			}
			else{
				?><section id="cta" style="background:url(<?php echo esc_url($image); ?>) no-repeat;background-size:cover;"><?php					
			}
		?>		
			<div class="img-overlay">
		        <div class="section-inner">
		            <div class="container">
		                <div class="cta-section">
		                    <div class="row">
		                        <div class="title">
		                            <div class="col-md-12">
		                                <div class="cta-title wow fadeInUp center" data-wow-duration="2s" data-wow-delay="1s">
		                                    <h2><?php echo $heading; ?></h2>
		                                    <p><?php echo $subheading; ?></p>
		                                    <?php if(!empty($button_text)){
						                      ?>
						                        <a href="<?php echo esc_url($button_url); ?>">
						                          	<button type="button" class="btn btn-default trans"><?php echo $button_text; ?>
						                          		<i class="fa fa-angle-double-right"></i>
						                          	</button>
						                        </a>
						                      <?php
						                    } ?>	                                    
		                                </div>
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
	$heading    = ! empty( $instance['heading'] ) ? $instance['heading'] : '';
    $subheading = ! empty( $instance['subheading'] ) ? $instance['subheading'] : '';
    $button_text    = ! empty( $instance['button_text'] ) ? $instance['button_text'] : '';
    $button_url    = ! empty( $instance['button_url'] ) ? $instance['button_url'] : '';
	$image = ! empty( $instance['image'] ) ? $instance['image'] : '';    
    $radio_buttons= ! empty( $instance['radio_buttons'] ) ? $instance['radio_buttons'] : '';
    $ps_radio_buttons= ! empty( $instance['ps_radio_buttons'] ) ? $instance['ps_radio_buttons'] : '';   

    ?>  
    

    	<div>
            <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Background Image URL', 'prasoon'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_url($image); ?>" class="pr-img-field"/>
            <a href="#" class="pr-img-select-image-btn button"><?php _e('Select image', 'prasoon'); ?></a>
        </div>

        <p>
	        <label for="<?php echo $this->get_field_id('heading'); ?>"><?php _e('Heading:','prasoon'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('heading'); ?>" name="<?php echo $this->get_field_name('heading'); ?>" type="text" value="<?php echo $heading; ?>" />
	    </p>

		<p>
	        <label for="<?php echo $this->get_field_id('subheading'); ?>"><?php _e('Sub heading:','prasoon'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('subheading'); ?>" name="<?php echo $this->get_field_name('subheading'); ?>" type="text" value="<?php echo $subheading; ?>" />
	    </p>

	    <p>
            <label for="<?php echo $this->get_field_id( 'button_text'); ?>"><?php _e( 'Button Text', 'prasoon' ); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text'); ?>" value="<?php echo esc_attr( $button_text ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php _e( 'Button Url', 'prasoon' ); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" value="<?php echo esc_url( $button_url ); ?>" />
        </p>	


    	<h3><?php _e('Enable Parallax Scrolling:','prasoon'); ?></h3>
        <p>
            <input class="" id="<?php echo $this->get_field_id('radio_option_1'); ?>" name="<?php echo $this->get_field_name('radio_buttons'); ?>" type="radio" value="<?php _e('radio_option_1', 'prasoon'); ?>" <?php if($radio_buttons === 'radio_option_1'){ echo 'checked="checked"'; } ?> />
            <label for="<?php echo $this->get_field_id('radio_buttons'); ?>"><?php _e('Yes','prasoon'); ?></label><br>
            <input class="" id="<?php echo $this->get_field_id('radio_option_2'); ?>" name="<?php echo $this->get_field_name('radio_buttons'); ?>" type="radio" value="<?php _e('radio_option_2', 'prasoon'); ?>" <?php if($radio_buttons === 'radio_option_2'){ echo 'checked="checked"'; } ?> />
            <label for="<?php echo $this->get_field_id('radio_buttons'); ?>"><?php _e('No','prasoon'); ?></label>
        </p>

        <h3><?php _e('Choose Parallax Scrolling Type:','prasoon'); ?></h3>
        <p>
            <input class="" id="<?php echo $this->get_field_id('ps_radio_option_1'); ?>" name="<?php echo $this->get_field_name('ps_radio_buttons'); ?>" type="radio" value="<?php _e('ps_radio_option_1', 'prasoon'); ?>" <?php if($ps_radio_buttons === 'ps_radio_option_1'){ echo 'checked="checked"'; } ?> />
            <label for="<?php echo $this->get_field_id('ps_radio_buttons'); ?>"><?php _e('Background Fixed','prasoon'); ?></label><br>
            <input class="" id="<?php echo $this->get_field_id('ps_radio_option_2'); ?>" name="<?php echo $this->get_field_name('ps_radio_buttons'); ?>" type="radio" value="<?php _e('ps_radio_option_2', 'prasoon'); ?>" <?php if($ps_radio_buttons === 'ps_radio_option_2'){ echo 'checked="checked"'; } ?> />
            <label for="<?php echo $this->get_field_id('ps_radio_buttons'); ?>"><?php _e('Background Scroll','prasoon'); ?></label>
        </p>
       
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

		$instance[ 'heading'] = wp_filter_post_kses( $new_instance['heading'] );
        $instance[ 'subheading'] = wp_filter_post_kses( $new_instance['subheading'] );
        $instance[ 'button_text'] = wp_filter_post_kses( $new_instance['button_text'] );
        $instance[ 'button_url'] = esc_url( $new_instance['button_url'] );
		$instance['image']  = strip_tags( $new_instance['image'] );    	
    	$instance['radio_buttons'] = wp_filter_post_kses($new_instance['radio_buttons']);
    	$instance['ps_radio_buttons'] = wp_filter_post_kses($new_instance['ps_radio_buttons']);    	

    	return $instance;
	}

}
endif;



if( ! function_exists('register_prasoon_cta_section_widget')) :
// register widget
function register_prasoon_cta_section_widget() {
    register_widget( 'Prasoon_CTA_Section_Widget' );
}
endif;

add_action( 'widgets_init', 'register_prasoon_cta_section_widget' );
