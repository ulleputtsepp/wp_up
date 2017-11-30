<?php


/**
 * Change the attached sizes to Hamilton sizes
 */
function minimalist_portfolio_epp_thumb_size( $sizes ) {

	$sizes['thumb'] = 'hamilton_preview-image';

	return $sizes;
}

add_filter( 'phort/archive/masonry-hovercard/attached_sizes', 'minimalist_portfolio_epp_thumb_size' );
add_filter( 'phort/single/masonry/attached_sizes', 'minimalist_portfolio_epp_thumb_size' );