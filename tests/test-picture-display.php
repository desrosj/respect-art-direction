<?php
/**
 * Class Test_Picture_Display
 *
 * @package Respect_Art_Direction
 */

/**
 * Test <picture> tag display functionality.
 */
class Test_Picture_Display extends WP_UnitTestCase {

	/**
	 * Test that the Post Thumbnail HTML is properly overridden.
	 */
	function test_rad_the_post_thumbnail_with_art_direction() {
		global $rad_source_lists;

		$post_id = $this->factory->post->create( array(
			'post_title' => 'A Test Page',
			'post_type' => 'page',
		) );

		add_image_size( 'test_image_size_1', 1200, 600, true );
		add_image_size( 'test_image_size_2', 600, 300, true );
		add_image_size( 'test_image_size_3', 300, 150, true );
		add_image_size( 'test_image_size_4', 1000, 800, true );
		add_image_size( 'test_image_size_5', 500, 400, true );

		$orig_file = DIR_TESTDATA . '/images/33772.jpg';
		$test_file = '/tmp/33772.JPG';
		copy( $orig_file, $test_file );

		$attachment_id = $this->factory->attachment->create_object( $test_file, 0, array(
			'post_mime_type' => 'image/jpg',
		) );

		$this->assertNotEmpty( $attachment_id );

		// Add as featured image.
		update_post_meta( $post_id, '_thumbnail_id', $attachment_id );

		// Register breakpoints and source lists for this test.
		rad_add_breakpoint( 'large', '(min-width: 1001px)' );
		rad_add_breakpoint( 'medium', '(max-width: 1000px)' );

		rad_add_source_list( 'my_source_list', array(
			'large' => array(
				'test_image_size_1',
				'test_image_size_2',
				'test_image_size_3',
			),
			'medium' => array(
				'test_image_size_4',
				'test_image_size_5',
			),
		) );

		$markup = get_the_post_thumbnail( $post_id, 'my_source_list' );

		$this->assertEquals( '<picture>
<source media="(min-width: 1001px)" srcset="http://example.org/wp-content/uploads//tmp/33772.JPG 1w, http://example.org/wp-content/uploads//tmp/33772.JPG 1w, http://example.org/wp-content/uploads//tmp/33772.JPG 1w" />
<source media="(max-width: 1000px)" srcset="http://example.org/wp-content/uploads//tmp/33772.JPG 1w, http://example.org/wp-content/uploads//tmp/33772.JPG 1w" />
<img src="http://example.org/wp-content/uploads//tmp/33772.JPG" alt="Detail of the above quilt, highlighting the embroidery and exotic stitchwork." />
</picture>', $markup );

		// Cleanup.
		$rad_source_lists = array();
		unlink( $test_file );
	}
}
