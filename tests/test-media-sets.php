<?php
/**
 * Class Test_Media_Sets
 *
 * @package Respect_Art_Direction
 */

/**
 * Test media set functionality.
 */
class Test_Media_Sets extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	function test_rad_add_media_set() {
		global $rad_media_sets;

		$this->assertEquals( $rad_media_sets, array() );

		rad_add_media_set( 'media_set_1', array(
			'breakpoint_1' => array(
				'image_size_1',
				'image_size_2',
			),
		) );

		$this->assertEquals( $rad_media_sets, array(
			'media_set_1' => array(
				'breakpoint_1' => array(
					'image_size_1',
					'image_size_2',
				),
			),
		) );

		$rad_media_sets = array();
	}

	function test_rad_add_breakpoint_to_media_set() {
		global $rad_media_sets;

		rad_add_breakpoint_to_media_set( 'media_set_2', 'breakpoint_2', 'source_list_1' );

		$this->assertEquals( array(
			'media_set_2' => array(
				'breakpoint_2' => array(
					'source_list_1',
				),
			),
		), $rad_media_sets );

		rad_add_breakpoint_to_media_set( 'media_set_2', 'breakpoint_2', 'source_list_2' );

		$this->assertEquals( array(
			'media_set_2' => array(
				'breakpoint_2' => array(
					'source_list_1',
					'source_list_2',
				),
			),
		), $rad_media_sets );

		rad_add_breakpoint_to_media_set( 'media_set_2', 'breakpoint_3', 'source_list_2' );

		$this->assertEquals( array(
			'media_set_2' => array(
				'breakpoint_2' => array(
					'source_list_1',
					'source_list_2',
				),
				'breakpoint_3' => array(
					'source_list_2',
				),
			),
		), $rad_media_sets );
	}
}
