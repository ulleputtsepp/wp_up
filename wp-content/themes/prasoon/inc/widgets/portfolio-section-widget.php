<?php
/**
 * Portfolio section widget.
 */


if( ! class_exists('Prasoon_Portfolio_Section_Widget')) :
 
class Prasoon_Portfolio_Section_Widget extends WP_Widget {

    var $defaults;

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'pr_portfolio_widget', // Base ID
            __( 'Prasoon: Portfolio Section', 'prasoon' ), // Name
            array( 'description' => __( 'Adds Portfolio section. Section id : portfolio', 'prasoon' ), ) // Args
        );

        $this->defaults = array(
            'number' => '8',
            'color' => '#ffffff',
            'headingcolor' => '#555555',
            'subheadingcolor' => '#555555',
            'hovercolor' => '#af1919',
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
    $number   =  ! empty( $instance['number'] ) ? $instance['number'] : $this->defaults['number'];
    $color   =  ! empty( $instance['color'] ) ? $instance['color'] : $this->defaults['color'];  
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];    
    $hovercolor   =  ! empty( $instance['hovercolor'] ) ? $instance['hovercolor'] : $this->defaults['hovercolor'];  

    ?>


    <section id="portfolio" style="background:<?php echo $color; ?>;">
        <div class="section-inner">
            <div class="container">
                <div class="row">
                    <div class="title wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">
                        <div class="col-md-12">
                            <h3 style="color:<?php echo $headingcolor; ?>"><?php echo $heading; ?></h3>
                            <p style="color:<?php echo $subheadingcolor; ?>"><?php echo $subheading; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="portfolio-section" class="isotope col-lg-12 col-md-12 col-sm-12 col-xs-12  wow fadeInUp animated" data-wow-delay="1.5">
                        <ul id="filter" class="option-set clearfix">
	                        <?php
	                        	if(! empty( $instance['prjcat1'])){
	                        		?><li data-filter="*" class="selected"><a href="#"><?php _e('ALL','prasoon'); ?></a></li><?php
	                        	}
	                        ?>                            
                            <?php
                                $cat=array();
                                for( $i=1; $i<=$number; $i++ ) { 
                                    $prjcat    = ! empty( $instance['prjcat'.$i] ) ? $instance['prjcat'.$i] : '';
                                    $cat[$i-1]=$prjcat;                                    
                                }
                                foreach (array_unique($cat) as $key => $value) {
                                    ?><li data-filter=".<?php echo $value; ?>"><a href="#"><?php echo $value; ?></a></li><?php
                                }                                
                            ?>
                        </ul>
                        <ul id="list" class="portfolio-list clearfix wow zoomIn">
                            <?php
                                for( $i=1; $i<=$number; $i++ ) { 

                                    $imagethumb    = ! empty( $instance['imagethumb'.$i] ) ? $instance['imagethumb'.$i] : '';
                                    $image    = ! empty( $instance['image'.$i] ) ? $instance['image'.$i] : '';
                                    $prjheading    = ! empty( $instance['prjheading'.$i] ) ? $instance['prjheading'.$i] : '';
                                    $prjdescr    = ! empty( $instance['prjdescr'.$i] ) ? $instance['prjdescr'.$i] : '';
                                    $prjcat    = ! empty( $instance['prjcat'.$i] ) ? $instance['prjcat'.$i] : '';

                                    ?>

                                    <?php if(!empty($image)){
                                        ?>
                                            <li class="list_item col-lg-3 col-md-3 col-sm-3 col-xs-12 <?php echo $prjcat; ?>">
                                                <div class="hovereffect" style="background:<?php echo $hovercolor; ?>;">                                                    
                                                    <img class="img-responsive" src="<?php echo esc_url($imagethumb); ?>" alt="<?php echo esc_attr(basename($imagethumb)); ?>">
                                                    <div class="overlay">
                                                        <h4><?php echo $prjheading; ?></h4>
                                                        <p><a title="<?php echo $prjheading; ?> <small><?php echo $prjdescr; ?></small>" class="image-popup-link" href="<?php echo esc_url($image); ?>"><?php _e('VIEW','prasoon'); ?></a></p>
                                                    </div>
                                                </div>                                                
                                            </li>    
                                        <?php
                                    } ?>
                                    
                                    <?php                                                                                
                                }
                            ?>
                        </ul>
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
    $number   =  ! empty( $instance['number'] ) ? $instance['number'] : $this->defaults['number']; 
    $color   =  ! empty( $instance['color'] ) ? $instance['color'] : $this->defaults['color']; 
    $headingcolor   =  ! empty( $instance['headingcolor'] ) ? $instance['headingcolor'] : $this->defaults['headingcolor'];    
    $subheadingcolor   =  ! empty( $instance['subheadingcolor'] ) ? $instance['subheadingcolor'] : $this->defaults['subheadingcolor'];    
    $hovercolor   =  ! empty( $instance['hovercolor'] ) ? $instance['hovercolor'] : $this->defaults['hovercolor'];

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
    <label><strong><?php _e('Add Portfolio:','prasoon'); ?></strong></label><br/>

    <p>
        <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of Portfolio Items:','prasoon'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
    </p>

    <div class="widget-block">
        <?php for( $i = 1; $i <= $number; $i++ ) { 

            $imagethumb    = ! empty( $instance['imagethumb'.$i] ) ? $instance['imagethumb'.$i] : '';
            $image    = ! empty( $instance['image'.$i] ) ? $instance['image'.$i] : '';
            $prjheading    = ! empty( $instance['prjheading'.$i] ) ? $instance['prjheading'.$i] : '';
            $prjdescr    = ! empty( $instance['prjdescr'.$i] ) ? $instance['prjdescr'.$i] : '';                                   
            $prjcat    = ! empty( $instance['prjcat'.$i] ) ? $instance['prjcat'.$i] : '';                                   

            ?>
            <div class="widget-block-box">
                <div class="widget-block-head"><a href="#"><?php _e('Portfolio Item', 'prasoon');echo $i; ?></a><span class="widget-plus">+</span><span class="widget-minus">-</span></div>
                <div class="widget-block-content">  

                    <div>
                        <label for="<?php echo $this->get_field_id( 'imagethumb'.$i ); ?>"><?php _e('Image Thumb (300px X 200px)', 'prasoon'); ?>:</label>
                        <input type="text" id="<?php echo $this->get_field_id( 'imagethumb'.$i ); ?>" name="<?php echo $this->get_field_name( 'imagethumb'.$i ); ?>" value="<?php echo esc_url($imagethumb); ?>" class="pr-img-field"/>
                        <a href="#" class="pr-img-select-image-btn button"><?php _e('Select image', 'prasoon'); ?></a>
                    </div>                  

                    <div>
                        <label for="<?php echo $this->get_field_id( 'image'.$i ); ?>"><?php _e('Image', 'prasoon'); ?>:</label>
                        <input type="text" id="<?php echo $this->get_field_id( 'image'.$i ); ?>" name="<?php echo $this->get_field_name( 'image'.$i ); ?>" value="<?php echo esc_url($image); ?>" class="pr-img-field"/>
                        <a href="#" class="pr-img-select-image-btn button"><?php _e('Select image', 'prasoon'); ?></a>
                    </div>                  
                    <p>
                        <label for="<?php echo $this->get_field_id('prjheading'.$i); ?>"><?php _e('Project Heading','prasoon'); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('prjheading'.$i); ?>" name="<?php echo $this->get_field_name('prjheading'.$i); ?>" type="text" value="<?php echo $prjheading; ?>" />
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id('prjdescr'.$i); ?>"><?php _e('Project Description','prasoon'); ?></label>
                        <textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id('prjdescr'.$i); ?>" name="<?php echo $this->get_field_name('prjdescr'.$i); ?>"><?php echo $prjdescr; ?></textarea>
                        
                    </p>
                    <p>
                        <label for="<?php echo $this->get_field_id('prjcat'.$i); ?>"><?php _e('Project Category','prasoon'); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id('prjcat'.$i); ?>" name="<?php echo $this->get_field_name('prjcat'.$i); ?>" type="text" value="<?php echo $prjcat; ?>" />
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

                <h3><?php _e('Heading Color:','prasoon'); ?></h3>
                <p>
                    <input class="color" type="text" value="<?php echo $headingcolor; ?>" id="<?php echo $this->get_field_id( 'headingcolor' ); ?>" name="<?php echo $this->get_field_name( 'headingcolor' ); ?>" />
                </p>

                <h3><?php _e('Sub Heading Color:','prasoon'); ?></h3>
                <p>
                    <input class="color" type="text" value="<?php echo $subheadingcolor; ?>" id="<?php echo $this->get_field_id( 'subheadingcolor' ); ?>" name="<?php echo $this->get_field_name( 'subheadingcolor' ); ?>" />
                </p>

                <h3><?php _e('Image Hover Color:','prasoon'); ?></h3>
                <p>
                    <input class="color" type="text" value="<?php echo $hovercolor; ?>" id="<?php echo $this->get_field_id( 'hovercolor' ); ?>" name="<?php echo $this->get_field_name( 'hovercolor' ); ?>" />
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
        $instance['number']   = absint($new_instance['number']);
        $instance['color'] = sanitize_hex_color($new_instance['color']);

        for( $i=1; $i<=$instance['number']; $i++ ) { 
            $instance['imagethumb'.$i]  = strip_tags( $new_instance['imagethumb'.$i] );         
            $instance['image'.$i]  = strip_tags( $new_instance['image'.$i] );         
            $instance['prjheading'.$i] = wp_filter_post_kses($new_instance['prjheading'.$i]);
            $instance['prjdescr'.$i] = wp_filter_post_kses($new_instance['prjdescr'.$i]);
            $instance['prjcat'.$i] = wp_filter_post_kses($new_instance['prjcat'.$i]);
        }

        $instance['headingcolor'] = sanitize_hex_color($new_instance['headingcolor']);
        $instance['subheadingcolor'] = sanitize_hex_color($new_instance['subheadingcolor']);
        $instance['hovercolor'] = sanitize_hex_color($new_instance['hovercolor']);

        return $instance;
    }   

}
endif;



if( ! function_exists('register_prasoon_portfolio_section_widget')) :
// register widget
function register_prasoon_portfolio_section_widget() {
    register_widget( 'Prasoon_Portfolio_Section_Widget' );
}
endif;


add_action( 'widgets_init', 'register_prasoon_portfolio_section_widget' );
