<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package prasoon
 */

?>

	<!-- Begin Footer Section -->
	<section class="footer">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<p data-wow-duration="2s" data-wow-delay="0.5s" class="copyright wow fadeInUp"><?php echo esc_attr(get_theme_mod( 'copyright_text', __('Copyrights 2017 Prasoon. All Rights Reserved','prasoon'))); ?></p>
				</div>
			</div>
		</div>
	</section>
	<!-- End Footer Section -->

<?php wp_footer(); ?>

</body>
</html>