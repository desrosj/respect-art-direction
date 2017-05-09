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
	function test_rad_add_image_source() {
		global $rad_image_sources;

		$this->assertEquals( $rad_image_sources, array() );

		rad_add_image_source( 'test_source', array( 'image_size_1', 'image_size_2' ) );

		$this->assertEquals( $rad_image_sources, array(
			'test_source' => array(
				'image_size_1',
				'image_size_2',
			),
		) );
	}

	/**
	 * Test rad_image_size_is_image_source().
	 */
	function test_rad_image_size_is_image_source() {
		rad_add_image_source( 'another_test_source' );

		$this->assertTrue( rad_image_size_is_image_source( 'another_test_source' ) );
	}
}
