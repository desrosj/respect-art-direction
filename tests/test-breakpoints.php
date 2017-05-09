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
	 * Test retreiving a breakpoint.
	 */
	function test_rad_get_breakpoint() {
		$this->assertFalse( rad_get_breakpoint( 'does_not_exist' ) );

		rad_add_breakpoint( 'test_breakpoint', '(max-width: 500px)' );

		$this->assertEquals( '(max-width: 500px)', rad_get_breakpoint( 'test_breakpoint' ) );
	}
}
