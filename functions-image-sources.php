<?php
/**
 * Image source functionality.
 *
 * @package Respect_Art_Direction
 */

/**
 * Register a new image source.
 *
 * @param string $source_set_name Name of an image source.
 * @param array  $image_sizes     List of image sizes for the sourcesource.
 */
function rad_add_image_source( $source_set_name, $image_sizes = array() ) {
	global $image_sources;

	$image_sources[ $source_set_name ] = $image_sizes;
}

/**
 * Checks if an image size is a registered image source.
 *
 * @param string $image_size Image size name to check.
 *
 * @return bool Whether the image size is a source.
 */
function rad_image_size_is_image_source( $image_size ) {
	global $image_sources;

	return isset( $image_sources[ $image_size ] );
}
