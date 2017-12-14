<?php

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Prasoon_Custom_Content' ) ) :

	class Prasoon_Custom_Content extends WP_Customize_Control {

		// Whitelist content parameter
		public $content = '';
		/**
		* Render the control's content.
		*
		* Allows the content to be overriden without having to rewrite the wrapper.
		*
		* @since   1.0.0
		* @return  void
		*/
		public function render_content() {

			if ( isset( $this->label ) ) {
				echo '<span class="customize-control-title">' . esc_attr($this->label) . '</span>';
			}

			if ( isset( $this->content ) ) {
				echo esc_attr($this->content);
			}

			if ( isset( $this->description ) ) {
				echo '<span class="description customize-control-description">' . esc_attr($this->description) . '</span>';
			}

		}
	}

endif;


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Prasoon_Documentation' ) ) :

	/* custom information type */
	class Prasoon_Documentation extends WP_Customize_Control {

		//parameters
	    public $type = 'info';
	    public $label = '';
	    /**
		* Render the control's content.
		*
		* Allows the content to be overriden without having to rewrite the wrapper.
		*
		* @since   1.0.0
		* @return  void
		*/
	    public function render_content() {
	    ?>
	        <p><?php echo esc_attr( $this->label ); ?></p>
	    <?php
	    }
	}

endif;


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Prasoon_Info' ) ) :

	/* custom information type */
	class Prasoon_Info extends WP_Customize_Control {

		//parameters
	    public $type = 'info';
	    public $label = '';
	    /**
		* Render the control's content.
		*
		* Allows the content to be overriden without having to rewrite the wrapper.
		*
		* @since   1.0.0
		* @return  void
		*/
	    public function render_content() {
	    ?>
	        <h3 class="info"><?php echo esc_attr( $this->label ); ?></h3>
	    <?php
	    }
	}

endif;