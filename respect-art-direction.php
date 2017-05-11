<?php
/**
 * Plugin Name: Respect Art Direction
 * Plugin URI:  https://github.com/desrosj/respect-art-direction
 * Description: POC plugin defining art direction for WordPress images.
 * Author:      Jonathan Desrosiers
 * Author URI:  https://jonathandesrosiers.com
 * Text Domain: respect-art-direction
 * Domain Path: /languages
 * Version:     0.2.0-dev
 *
 * @package     Respect_Art_Direction
 */

include_once( 'functions-source-lists.php' );
include_once( 'functions-breakpoints.php' );
include_once( 'functions-display.php' );

global $rad_source_lists, $rad_breakpoints;

$rad_source_lists = array();
$rad_breakpoints = array();

/**
 * Example for registering custom breakpoints and source sets.
 */
function rad_plugins_loaded() {
	/*
	 * Register breakpoints.
	 */
	rad_add_breakpoint( 'rad_large', '(min-width: 1001px)' );
	rad_add_breakpoint( 'rad_medium', '(max-width: 1000px)' );
	rad_add_breakpoint( 'rad_small', '(max-width: 619px)' );

	/*
	 * First image source.
	 */
	rad_add_source_list( 'source_size1', array(
		'rad_large' => array(
			'custom1_large_size',
		),
		'rad_medium' => array(
			'custom1_medium_size',
			'custom1_small_size'
		),
		'rad_small' => array(
			'custom1_medium_size',
			'custom1_small_size',
		),
		'default' => array(
			'custom1_default_size',
		),
	) );

	/*
	 * Second image source.
	 */
	rad_add_source_list( 'source_size2', array(
		'rad_large' => array(
			'custom2_large_size',
		),
		'rad_medium' => array(
			'custom2_medium_size',
		),
		'rad_small' => array(
			'custom2_small_size',
		),
		'default' => array(
			'custom2_medium_size',
		),
	) );
}

/**
 * Register custom image sizes.
 */
function rad_after_setup_theme() {
	add_image_size( 'custom1_large_size', 1200, 300, true );
	add_image_size( 'custom1_medium_size', 600, 300, true );
	add_image_size( 'custom1_small_size', 300, 150, true );
	add_image_size( 'custom1_default_size', 1200, 300, true );

	add_image_size( 'custom2_large_size', 1600, 400, true );
	add_image_size( 'custom2_medium_size', 800, 300, true );
	add_image_size( 'custom2_small_size', 600, 200, true );
}
add_action( 'after_setup_theme', 'rad_after_setup_theme' );
