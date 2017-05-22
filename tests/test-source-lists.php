<?php
/**
 * Class Test_Image_Sources
 *
 * @package Respect_Art_Direction
 */

/**
 * Test Image Source functionality.
 */
class Test_Image_Sources extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	function test_rad_add_source_list() {
		global $rad_source_lists;

		$this->assertEquals( $rad_source_lists, array() );

		rad_add_source_list( 'test_source', array(
			'image_size_1',
			'image_size_2',
		) );

		$this->assertEquals( $rad_source_lists, array(
			'test_source' => array(
				'image_size_1',
				'image_size_2',
			),
		) );

		rad_add_source_list( 'test_source_2', array(
			'image_size_3',
			'image_size_4',
		) );

		$this->assertEquals( $rad_source_lists, array(
			'test_source' => array(
				'image_size_1',
				'image_size_2',
			),
			'test_source_2' => array(
				'image_size_3',
				'image_size_4'
			),
		) );

		$rad_source_lists = array();
	}

	/**
	 * Test rad_image_size_is_image_source().
	 */
	function test_rad_image_size_is_image_source() {
		rad_add_source_list( 'another_test_source' );

		$this->assertTrue( rad_image_size_is_image_source( 'another_test_source' ) );

		$rad_source_lists = array();
	}
}
