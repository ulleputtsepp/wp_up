<?php

/**
 * Blog Section widget.
 */


if( ! class_exists('Prasoon_Blog_Section_Widget')) :

class Prasoon_Blog_Section_Widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'pr_blog_widget', // Base ID
			__( 'Prasoon: Blog Section', 'prasoon' ), // Name
			array( 'description' => __( 'Adds Blog section. Section id : blog', 'prasoon' ), ) // Args
		);

    $this->defaults = array(
      'color' => '#ffffff',
      'headingcolor' => '#555555',
      'subheadingcolor' => '#555555',      
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
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];    
    

  		$options = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
    );

    $query = new WP_Query( $options );
    // run the loop based on the query
    if ( $query->have_posts() ) { ?>
      <section id="blog" style="background:<?php echo $color; ?>;">
        <div class="section-inner">
          <div class="container">
            <div class="blog-section">
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
							while ( $query->have_posts() ) {
							$query->the_post();
							$postid = get_the_ID();
						?>
                    <div class="col-md-4 col-sm-6">
                      <div class="blog-wrap wow fadeInUp" data-wow-duration="2s" data-wow-delay="1.5s">
                        <div class="image">
                          <?php if ( has_post_thumbnail()) {
                            the_post_thumbnail('small');
                          }
                          else { ?>
                          <img src="<?php echo get_template_directory_uri().'/img/blog-bg.jpg' ?>" alt="post-image" /> <?php
                          }
                          ?>
                          <div class="datetime">
                            <div class="datetime-section">
                              <h3><?php the_time('j M'); ?></h3>
                              <h4><?php the_time('Y'); ?></h4>
                            </div>
                          </div>
                        </div>
                        <div class="meta">
                          <span class="postedby"><i class="fa fa-user"></i><?php the_author() ?></span>
                          <span class="comments"><i class="fa fa-comments"></i><?php comments_number('0','1','%'); ?>  <?php _e('Comments','prasoon'); ?></span>                          
                          <span class="category"><i class="fa fa-folder-open"></i><?php the_category(); ?></span>
                        </div>
                        <div class="heading">
                          <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                        </div>
                        
                        <div class="blog-content">
                          <p><?php the_excerpt(); ?></p>
                          <a class="read-more" href="<?php the_permalink() ?>"><?php _e('READ MORE ','prasoon'); ?><i class="fa fa-plus-circle"></i></a>
                        </div>
                      </div>
                    </div>
					<?php
					}?>
                  </div>
              	</div>
          		</div>
            </div>
          </div>
        </section>

       <?php
      }

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
                <p><?php _e('Note: Blog title and Category color can be set from main Color Settings','prasoon'); ?></p>

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
    $instance['headingcolor'] = sanitize_hex_color($new_instance['headingcolor']);
    $instance['subheadingcolor'] = sanitize_hex_color($new_instance['subheadingcolor']);
    

    return $instance;
	}  

}
endif;



if( ! function_exists('register_prasoon_blog_section_widget')) :
// register widget
function register_prasoon_blog_section_widget() {
    register_widget( 'Prasoon_Blog_Section_Widget' );
}
endif;

add_action( 'widgets_init', 'register_prasoon_blog_section_widget' );