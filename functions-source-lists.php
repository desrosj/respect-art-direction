<?php
/**
 * Source list functionality.
 *
 * @package Respect_Art_Direction
 */

/**
 * Register a new source list.
 *
 * @param string $source_list_name Name of a source list.
 * @param array  $image_sizes      List of image sizes for the source list.
 */
function rad_add_source_list( $source_list_name, $image_sizes = array() ) {
	global $rad_source_lists;

	$rad_source_lists[ $source_list_name ] = $image_sizes;
}

/**
 * Add an image size to a source list.
 *
 * @param string $source_list_name Source list name.
 * @param string $image_size       Image size name.
 */
function rad_add_to_source_list( $source_list_name, $image_size ) {
	global $rad_source_lists;

	$rad_source_lists[ $source_list_name ][] = $image_size;
}

/**
 * Checks if an image size is a registered image source.
 *
 * @param string $image_size Image size name to check.
 *
 * @return bool Whether the image size is a source.
 */
function rad_image_size_is_image_source( $image_size ) {
	global $rad_source_lists;

	return isset( $rad_source_lists[ $image_size ] );
}
