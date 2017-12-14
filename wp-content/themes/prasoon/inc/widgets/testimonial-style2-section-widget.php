<?php
/**
 * Testimonial Section widget.
 */


if( ! class_exists('Prasoon_Testimonial_Style2_Section_Widget')) :

class Prasoon_Testimonial_Style2_Section_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'pr_testimonial_style2_widget', // Base ID
			__( 'Prasoon [NEW]: Testimonial Section', 'prasoon' ), // Name
			array( 'description' => __( '[NEW] Adds Testimonials section. Section id : testimonials', 'prasoon' ), ) // Args
		);

		$this->defaults = array(
            'number' => '3',            
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
		extract( wp_parse_args( $instance, $this->defaults ) );		

		$image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		$number   =  ! empty( $instance['number'] ) ? $instance['number'] : $this->defaults['number'];

		$radio_buttons= ! empty( $instance['radio_buttons'] ) ? $instance['radio_buttons'] : '';
		$ps_radio_buttons= ! empty( $instance['ps_radio_buttons'] ) ? $instance['ps_radio_buttons'] : '';

		?>
	
		<section id="testimonials">
			<?php 
				if ($radio_buttons === 'radio_option_1') {
					if($ps_radio_buttons === 'ps_radio_option_1') {
						?><div class="cover-testimonial" style="background:url(<?php echo esc_url($image); ?>) no-repeat;background-attachment:fixed;background-size:cover;"><div class="cover-testimonial-overlay"></div><?php
					}
					else{
						?><div class="cover-testimonial" data-parallax="scroll" data-image-src="<?php echo esc_url($image); ?>"><div class="cover-testimonial-overlay"></div><?php		
					}						
				}
				else{
					?><div class="cover-testimonial" style="background: url(<?php echo esc_url($image); ?>) no-repeat;background-size: cover;"><div class="cover-testimonial-overlay"></div><?php	
				}
			?>
        
	        <div class="testimonial-section">
	            <div class="container">
	                <div id="text-carousel" class="carousel slide" data-ride="carousel">
	                    <!-- Wrapper for slides -->
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="carousel-inner wow fadeInUp" data-wow-delay="1s">
	                              	<?php
                                        for( $i=1; $i<=$number; $i++ ) { 
                                            $cimage    = ! empty( $instance['cimage'.$i] ) ? $instance['cimage'.$i] : '';
                                            $cname    = ! empty( $instance['cname'.$i] ) ? $instance['cname'.$i] : '';
                                            $cdesg    = ! empty( $instance['cdesg'.$i] ) ? $instance['cdesg'.$i] : '';
                                            $cmessage    = ! empty( $instance['cmessage'.$i] ) ? $instance['cmessage'.$i] : '';
                                            ?>
											
											<div class="item">
												<div class="content">
													<div class="carousel-content">
														<div class="quote"></div>
														<p><?php echo $cmessage; ?></p>
														<div class="client-image">
															<?php 
																if(!empty($cimage)){
																	?><img src="<?php echo esc_url($cimage); ?>" alt="<?php echo esc_attr(basename($cimage)); ?>"><?php
																}
															?>															
															<h3><?php echo $cname; ?></h3>
															<p class="client-company"><?php echo $cdesg; ?></p>
														</div>
													</div>
												</div>
											</div>                                                                                         
										<?php
                                        }
                                    ?> 
	                    		</div>
	              			</div>
	          			</div>
						
						<!-- Controls -->
	                    <a class="left carousel-control" href="#text-carousel" data-slide="prev">
	                       	<span class="glyphicon glyphicon-chevron-left"></span>
	                    </a>
	                    <a class="right carousel-control" href="#text-carousel" data-slide="next">
	                       	<span class="glyphicon glyphicon-chevron-right"></span>
	                    </a>
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

	$image = ! empty( $instance['image'] ) ? $instance['image'] : '';
    $number   =  ! empty( $instance['number'] ) ? $instance['number'] : $this->defaults['number'];
    $radio_buttons= ! empty( $instance['radio_buttons'] ) ? $instance['radio_buttons'] : '';
    $ps_radio_buttons= ! empty( $instance['ps_radio_buttons'] ) ? $instance['ps_radio_buttons'] : '';

    ?>

    	<div>
            <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Background Image URL', 'prasoon'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_url($image); ?>" class="pr-img-field"/>
            <a href="#" class="pr-img-select-image-btn button"><?php _e('Select image', 'prasoon'); ?></a>
        </div>

		<p>
        	<label for="<?php echo $this->get_field_id('nop'); ?>"><?php _e('Number of posts:','prasoon'); ?></label>
        	<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
    	</p>

    	<div class="widget-block">
	        <?php for( $i = 1; $i <= $number; $i++ ) {    
	            $cimage    = ! empty( $instance['cimage'.$i] ) ? $instance['cimage'.$i] : '';
                $cname    = ! empty( $instance['cname'.$i] ) ? $instance['cname'.$i] : '';
                $cdesg    = ! empty( $instance['cdesg'.$i] ) ? $instance['cdesg'.$i] : '';
                $cmessage    = ! empty( $instance['cmessage'.$i] ) ? $instance['cmessage'.$i] : '';
	            
	            ?>

	            <div class="widget-block-box">
	                <div class="widget-block-head"><a href="#"><?php _e('Testimonial', 'prasoon');echo $i; ?></a><span class="widget-plus">+</span><span class="widget-minus">-</span></div>
	                <div class="widget-block-content">
	                	<div>
					        <label for="<?php echo $this->get_field_id( 'cimage'.$i ); ?>"><?php _e('Client Image URL', 'prasoon'); ?>:</label>
					        <input type="text" id="<?php echo $this->get_field_id( 'cimage'.$i ); ?>" name="<?php echo $this->get_field_name( 'cimage'.$i); ?>" value="<?php echo esc_url($cimage); ?>" class="pr-img-field"/>
					        <a href="#" class="pr-img-select-image-btn button"><?php _e('Select image', 'prasoon'); ?></a>
					    </div>
	                    <p>
	                        <label for="<?php echo $this->get_field_id('cname'.$i); ?>"><?php _e('Client Name','prasoon'); ?></label>
	                        <input class="widefat" id="<?php echo $this->get_field_id('cname'.$i); ?>" name="<?php echo $this->get_field_name('cname'.$i); ?>" type="text" value="<?php echo $cname; ?>" />
	                    </p>
	                    <p>
	                        <label for="<?php echo $this->get_field_id('cdesg'.$i); ?>"><?php _e('Designation','prasoon'); ?></label>
	                        <input class="widefat" id="<?php echo $this->get_field_id('cdesg'.$i); ?>" name="<?php echo $this->get_field_name('cdesg'.$i); ?>" type="text" value="<?php echo $cdesg; ?>" />
	                    </p>
	                    <p>
					        <label for="<?php echo $this->get_field_id('cmessage'.$i); ?>"><?php _e('Message','prasoon'); ?></label>
					        <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('cmessage'.$i); ?>" name="<?php echo $this->get_field_name('cmessage'.$i); ?>"><?php echo $cmessage; ?></textarea>
					    </p>
	                </div>
	            </div>                       
	            <?php
	        }  ?>
	         
	    </div>


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
		$instance['image']  = strip_tags( $new_instance['image'] );
    	$instance['number']   = absint($new_instance['number']);
    	$instance['radio_buttons'] = wp_filter_post_kses($new_instance['radio_buttons']);
    	$instance['ps_radio_buttons'] = wp_filter_post_kses($new_instance['ps_radio_buttons']);

    	for( $i=1; $i<= $instance['number']; $i++ ) {          
            $instance['cimage'.$i] = strip_tags($new_instance['cimage'.$i]);
            $instance['cname'.$i] = wp_filter_post_kses($new_instance['cname'.$i]);
            $instance['cdesg'.$i] = wp_filter_post_kses($new_instance['cdesg'.$i]);
            $instance['cmessage'.$i] = wp_filter_post_kses($new_instance['cmessage'.$i]);
        }

    	return $instance;
	}

}
endif;



if( ! function_exists('register_prasoon_testimonial_style2_section_widget')) :
// register widget
function register_prasoon_testimonial_style2_section_widget() {
    register_widget( 'Prasoon_Testimonial_Style2_Section_Widget' );
}
endif;

add_action( 'widgets_init', 'register_prasoon_testimonial_style2_section_widget' );
