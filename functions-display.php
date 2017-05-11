<?php
/**
 * Functions for displaying images within a <picture> tag.
 *
 * @package Respect_Art_Direction
 */

/**
 * If a post thumbnail is requested for a source set, display a <picture> tag.
 *
 * @param string       $html              The post thumbnail HTML.
 * @param int          $post_id           The post ID.
 * @param string       $post_thumbnail_id The post thumbnail ID.
 * @param string|array $size              The post thumbnail size. Image size or array of width and height
 *                                        values (in that order). Default 'post-thumbnail'.
 * @param string       $attr              Query string of attributes.
 *
 * @return mixed
 */
function rad_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
	if ( ! rad_image_size_is_image_source( $size ) ) {
		return $html;
	}

	return rad_the_post_thumbnail_with_art_direction( $post_thumbnail_id, $size );
}
add_filter( 'post_thumbnail_html', 'rad_post_thumbnail_html', 10, 5 );

/**
 * Display an image with art direction.
 *
 * @param sting|int $image_id    Image ID.
 * @param string    $source_size Source set size.
 *
 * @return string Image HTML markup.
 */
function rad_the_post_thumbnail_with_art_direction( $image_id, $source_size = '' ) {
	global $rad_source_lists;

	$html = '<picture>';

	foreach ( $rad_source_lists[ $source_size ] as $breakpoint => $size ) {
		$sources = array();
		$breakpoint_info = rad_get_breakpoint( $breakpoint );

		foreach ( $size as $current_size ) {
			$image_src = wp_get_attachment_image_src( $image_id, $current_size );
			$sources[] = $image_src[0] . ' ' . $image_src[1] . 'w';
		}

		$html .= '<source';

		if ( ! empty( $breakpoint_info ) ) {
			$html .= ' media="' . esc_attr( $breakpoint_info ) . '"';
		}

		$html .= ' srcset="' . implode( ', ', $sources ) . '" />';
	}

	$default = wp_get_attachment_image_src( $image_id, 'custom1_default_size' );

	$html .= '<img src="' . $default[0] . '" alt="Detail of the above quilt, highlighting the embroidery and exotic stitchwork." />';

	$html .= '</picture>';

	return $html;
}
