<?php
/**
 * Class Test_Breakpoints
 *
 * @package Respect_Art_Direction
 */

/**
 * Test Breakpoint functionality.
 */
class Test_Breakpoints extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	function test_rad_add_breakpoint() {
		global $rad_breakpoints;

		$this->assertEquals( $rad_breakpoints, array() );

		rad_add_breakpoint( 'some_breakpoint_name', '(max-width: 500px)' );

		$this->assertEquals( $rad_breakpoints, array(
			'some_breakpoint_name' => '(max-width: 500px)',
		) );
	}

	/**
	 * Test adding multiple breakpoints at once.
	 */
	function test_rad_add_breakpoints() {
		global $rad_breakpoints;

		rad_add_breakpoints( array(
			'some_breakpoint' => '(a media query)',
			'another_breakpoint' => '(more media queries)',
		) );

		$this->assertEquals( $rad_breakpoints, array(
			'some_breakpoint' => '(a media query)',
			'another_breakpoint' => '(more media queries)',
		) );
	}

	/**
	 * Test retreiving a breakpoint.
	 */
	function test_rad_get_breakpoint() {
		$this->assertFalse( rad_get_breakpoint( 'does_not_exist' ) );

		rad_add_breakpoint( 'test_breakpoint', '(max-width: 500px)' );

		$this->assertEquals( '(max-width: 500px)', rad_get_breakpoint( 'test_breakpoint' ) );
	}

	/**
	 * Test removing a breakpoint.
	 */
	function test_rad_remove_breakpoint() {
		global $rad_breakpoints;

		rad_add_breakpoint( 'test_breakpoint', '(max-width:500px)' );

		$this->assertEquals( array(
			'test_breakpoint' => '(max-width:500px)',
		), $rad_breakpoints );

		rad_remove_breakpoint( 'test_breakpoint' );

		$this->assertEquals( array(), $rad_breakpoints );
	}

	/**
	 * Reset breakpoint global.
	 */
	function tearDown() {
		global $rad_breakpoints;

		$rad_breakpoints = array();
	}
}
