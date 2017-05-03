<?php
/**
 * Breakpoint functionality.
 *
 * @package Respect_Art_Direction
 */

/**
 * Register a new break point.
 *
 * @param string $breakpoint_name Breakpoint name.
 * @param string $media_queries   Media query properties for the breakpoint.
 */
function rad_add_breakpoint( $breakpoint_name, $media_queries = '' ) {
	global $rad_breakpoints;

	$rad_breakpoints[ $breakpoint_name ] = $media_queries;
}

/**
 * Retrieve a breakpoint.
 *
 * @param string $breakpoint_name Breakpoint to retrieve.
 *
 * @return bool|mixed False if breakpoint does not exist, breakpoint data if it does.
 */
function rad_get_breakpoint( $breakpoint_name ) {
	global $rad_breakpoints;

	if ( empty( $rad_breakpoints[ $breakpoint_name ] ) ) {
		return false;
	}

	return $rad_breakpoints[ $breakpoint_name ];
}
