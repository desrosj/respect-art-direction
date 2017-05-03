<?php
/**
 * Source set functionality.
 *
 * @package Respect_Art_Direction
 */

/**
 * Register a new source set.
 *
 * @param string $source_set_name Name of source set.
 * @param array  $image_sizes     List of image sizes for source set.
 */
function rad_add_source_set( $source_set_name, $image_sizes = array() ) {
	global $source_sizes;

	$source_sizes[ $source_set_name ] = $image_sizes;
}

/**
 * Checks if an image size is a registered source set.
 *
 * @param string $image_size Image size name to check.
 *
 * @return bool Whether the image size is a source set.
 */
function rad_image_size_is_source_set( $image_size ) {
	global $source_sizes;

	return isset( $source_sizes[ $image_size ] );
}
