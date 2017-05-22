<?php
/**
 * Media set functionality.
 *
 * @package Respect_Art_Direction
 */

/**
 * Register a media set.
 *
 * A media set is a list of breakpoints with source lists for that breakpoint.
 *
 * Example:
 *
 * array(
 * 	'breakpoint-name-1' => array(
 * 		'source_list_1',
 * 	),
 * 	'breakpoint-name-2' => array(
 * 		'source_list_1',
 * 		'source_list_2',
 * 	)
 * )
 *
 * @param string $name        Name of the media set.
 * @param array  $breakpoints An array of source lists for registered breakpoints.
 */
function rad_add_media_set( $name, $breakpoints ) {
	global $rad_media_sets;

	$rad_media_sets[ $name ] = $breakpoints;
}

/**
 * Adds a breakpoint to a media set with the specified source list.
 *
 * @param string $name        Media set name.
 * @param string $breakpoint  Breakpoint name.
 * @param string}array $source_list Source list name.
 */
function rad_add_breakpoint_to_media_set( $name, $breakpoint, $source_list ) {
	global $rad_media_sets;

	if ( ! isset( $rad_media_sets ) ) {
		$rad_media_sets = array();
	}

	$rad_media_sets[ $name ][ $breakpoint ][] = $source_list;
}

/**
 * Checks if a media list is registered.
 *
 * @param string $media_list_name Image size name to check.
 *
 * @return bool Whether the list name is a registered media list.
 */
function rad_image_size_is_media_set( $media_list_name ) {
	global $rad_media_sets;

	return isset( $rad_media_sets[ $media_list_name ] );
}
