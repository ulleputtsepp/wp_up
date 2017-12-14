<?php
/**
 * Counters Section widget.
 */


if( ! class_exists('Prasoon_Counters_Section_Widget')) :

class Prasoon_Counters_Section_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'pr_counters_widget', // Base ID
			__( 'Prasoon: Counters Section', 'prasoon' ), // Name
			array( 'description' => __( 'Adds Counters section. Section id : counters', 'prasoon' ), ) // Args
		);
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

		$name1    = ! empty( $instance['name1'] ) ? $instance['name1'] : '';
    	$value1 = ! empty( $instance['value1'] ) ? $instance['value1'] : '';
    	$name2    = ! empty( $instance['name2'] ) ? $instance['name2'] : '';
    	$value2 = ! empty( $instance['value2'] ) ? $instance['value2'] : '';
    	$name3    = ! empty( $instance['name3'] ) ? $instance['name3'] : '';
    	$value3 = ! empty( $instance['value3'] ) ? $instance['value3'] : '';
    	$name4    = ! empty( $instance['name4'] ) ? $instance['name4'] : '';
    	$value4 = ! empty( $instance['value4'] ) ? $instance['value4'] : '';    	
		$image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		$radio_buttons= ! empty( $instance['radio_buttons'] ) ? $instance['radio_buttons'] : '';
		$ps_radio_buttons= ! empty( $instance['ps_radio_buttons'] ) ? $instance['ps_radio_buttons'] : '';

		?>

		<?php 
			if ($radio_buttons === 'radio_option_1') {
				if($ps_radio_buttons === 'ps_radio_option_1') {
					?><section id="counters" style="background:url(<?php echo esc_url($image); ?>) no-repeat;background-attachment:fixed;background-size:cover;"><?php					
				}
				else{
					?><section id="counters" data-parallax="scroll" data-image-src="<?php echo esc_url($image); ?>"><?php										
				}						
			}
			else{
				?><section id="counters" style="background:url(<?php echo esc_url($image); ?>) no-repeat;background-size:cover;"><?php					
			}
		?>		
			<div class="img-overlay">
		        <div class="section-inner">
		            <div class="container">
		                <div class="counter-section">
		                    <div class="row">
		                        <div class="content">
		                            <div class="col-md-3 col-sm-6">
		                                <div class="heading-counters">
		                                    <h2><span class="timer" data-from="0" data-to="<?php echo $value1; ?>" data-speed="1500" data-refresh-interval="5">0</span></h2>
		                                </div>
		                                <div class="description-counters">
		                                    <p><?php echo $name1; ?></p>
		                                </div>
		                            </div>
		                            <div class="col-md-3 col-sm-6">
		                                <div class="heading-counters">
		                                    <h2><span class="timer" data-from="0" data-to="<?php echo $value2; ?>" data-speed="2000" data-refresh-interval="5">0</span></h2>
		                                </div>
		                                <div class="description-counters">
		                                    <p><?php echo $name2; ?></p>
		                                </div>
		                            </div>
		                            <div class="col-md-3 col-sm-6">
		                                <div class="heading-counters">
		                                    <h2><span class="timer" data-from="0" data-to="<?php echo $value3; ?>" data-speed="1500" data-refresh-interval="5">0</span></h2>
		                                </div>
		                                <div class="description-counters">
		                                    <p><?php echo $name3; ?></p>
		                                </div>
		                            </div>
		                            <div class="col-md-3 col-sm-6">
		                                <div class="heading-counters">
		                                    <h2><span class="timer" data-from="0" data-to="<?php echo $value4; ?>" data-speed="1500" data-refresh-interval="5">0</span></h2>
		                                </div>
		                                <div class="description-counters">
		                                    <p><?php echo $name4; ?></p>
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

	$name1    = ! empty( $instance['name1'] ) ? $instance['name1'] : '';
    $value1 = ! empty( $instance['value1'] ) ? $instance['value1'] : '';
    $name2    = ! empty( $instance['name2'] ) ? $instance['name2'] : '';
    $value2 = ! empty( $instance['value2'] ) ? $instance['value2'] : '';
    $name3    = ! empty( $instance['name3'] ) ? $instance['name3'] : '';
    $value3 = ! empty( $instance['value3'] ) ? $instance['value3'] : '';
    $name4    = ! empty( $instance['name4'] ) ? $instance['name4'] : '';
    $value4 = ! empty( $instance['value4'] ) ? $instance['value4'] : '';    	
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
	        <label for="<?php echo $this->get_field_id('name1'); ?>"><?php _e('Name 1:','prasoon'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('name1'); ?>" name="<?php echo $this->get_field_name('name1'); ?>" type="text" value="<?php echo $name1; ?>" />
	    </p>

		<p>
	        <label for="<?php echo $this->get_field_id('value1'); ?>"><?php _e('Value 1:','prasoon'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('value1'); ?>" name="<?php echo $this->get_field_name('value1'); ?>" type="text" value="<?php echo $value1; ?>" />
	    </p>

	    <p>
	        <label for="<?php echo $this->get_field_id('name2'); ?>"><?php _e('Name 2:','prasoon'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('name2'); ?>" name="<?php echo $this->get_field_name('name2'); ?>" type="text" value="<?php echo $name2; ?>" />
	    </p>

		<p>
	        <label for="<?php echo $this->get_field_id('value2'); ?>"><?php _e('Value 2:','prasoon'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('value2'); ?>" name="<?php echo $this->get_field_name('value2'); ?>" type="text" value="<?php echo $value2; ?>" />
	    </p>

	    <p>
	        <label for="<?php echo $this->get_field_id('name3'); ?>"><?php _e('Name 3:','prasoon'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('name3'); ?>" name="<?php echo $this->get_field_name('name3'); ?>" type="text" value="<?php echo $name3; ?>" />
	    </p>

		<p>
	        <label for="<?php echo $this->get_field_id('value3'); ?>"><?php _e('Value 3:','prasoon'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('value3'); ?>" name="<?php echo $this->get_field_name('value3'); ?>" type="text" value="<?php echo $value3; ?>" />
	    </p>

	    <p>
	        <label for="<?php echo $this->get_field_id('name4'); ?>"><?php _e('Name 4:','prasoon'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('name4'); ?>" name="<?php echo $this->get_field_name('name4'); ?>" type="text" value="<?php echo $name4; ?>" />
	    </p>

		<p>
	        <label for="<?php echo $this->get_field_id('value4'); ?>"><?php _e('Value 4:','prasoon'); ?></label>
	        <input class="widefat" id="<?php echo $this->get_field_id('value4'); ?>" name="<?php echo $this->get_field_name('value4'); ?>" type="text" value="<?php echo $value4; ?>" />
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

		$instance[ 'name1'] = wp_filter_post_kses( $new_instance['name1'] );
        $instance[ 'value1'] = absint( $new_instance['value1'] );
        $instance[ 'name2'] = wp_filter_post_kses( $new_instance['name2'] );
        $instance[ 'value2'] = absint( $new_instance['value2'] );
        $instance[ 'name3'] = wp_filter_post_kses( $new_instance['name3'] );
        $instance[ 'value3'] = absint( $new_instance['value3'] );
        $instance[ 'name4'] = wp_filter_post_kses( $new_instance['name4'] );
        $instance[ 'value4'] = absint( $new_instance['value4'] );        
		$instance['image']  = strip_tags( $new_instance['image'] );    	
    	$instance['radio_buttons'] = wp_filter_post_kses($new_instance['radio_buttons']);
    	$instance['ps_radio_buttons'] = wp_filter_post_kses($new_instance['ps_radio_buttons']);

    	return $instance;
	}

}
endif;



if( ! function_exists('register_prasoon_counters_section_widget')) :
// register widget
function register_prasoon_counters_section_widget() {
    register_widget( 'Prasoon_Counters_Section_Widget' );
}
endif;

add_action( 'widgets_init', 'register_prasoon_counters_section_widget' );
