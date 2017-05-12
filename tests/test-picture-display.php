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
	 * Post ID of test page.
	 *
	 * @var int
	 */
	public $post_id;

	/**
	 * Post ID of test attachment.
	 *
	 * @var int
	 */
	public $attachment_id;

	/**
	 * Test file upload path.
	 *
	 * @var string
	 */
	public $test_file;

	/**
	 * Set up test.
	 *
	 * - Add image sizes.
	 * - Add a few breakpoints.
	 * - Add a source list.
	 * - Create test page.
	 * - Create test attachment post.
	 * - Assign attachment as featured image on the test page.
	 */
	function setUp() {
		$original_file = DIR_TESTDATA . '/images/33772.jpg';

		add_image_size( 'test_image_size_1', 1200, 600, true );
		add_image_size( 'test_image_size_2', 600, 300, true );
		add_image_size( 'test_image_size_3', 300, 150, true );
		add_image_size( 'test_image_size_4', 1000, 800, true );
		add_image_size( 'test_image_size_5', 500, 400, true );

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

		$this->post_id = $this->factory->post->create( array(
			'post_title' => 'A Test Page',
			'post_type' => 'page',
		) );

		$this->test_file = '/tmp/33772.jpg';
		copy( $original_file, $this->test_file );

		$this->attachment_id = $this->factory->attachment->create_object( $this->test_file, 0, array(
			'post_mime_type' => 'image/jpg',
		) );

		$this->assertNotEmpty( $this->attachment_id );

		// Add as featured image.
		update_post_meta( $this->post_id, '_thumbnail_id', $this->attachment_id );
	}

	/**
	 * Test the regular image markup is output if no source list name is passed.
	 */
	function test_rad_the_post_thmbnail_with_invalid_source_list_name() {
		$expected = '<img src="http://example.org/wp-content/uploads//tmp/33772.jpg" class="attachment-my_fake_source_list size-my_fake_source_list wp-post-image" alt="" />';
		$actual = $actual = get_the_post_thumbnail( $this->post_id, 'my_fake_source_list' );

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * Test that the Post Thumbnail HTML is properly overridden.
	 */
	function test_rad_the_post_thumbnail_with_art_direction() {
		$expected = '<picture>
<source media="(min-width: 1001px)" srcset="http://example.org/wp-content/uploads//tmp/33772.jpg 1w, http://example.org/wp-content/uploads//tmp/33772.jpg 1w, http://example.org/wp-content/uploads//tmp/33772.jpg 1w" />
<source media="(max-width: 1000px)" srcset="http://example.org/wp-content/uploads//tmp/33772.jpg 1w, http://example.org/wp-content/uploads//tmp/33772.jpg 1w" />
<img src="http://example.org/wp-content/uploads//tmp/33772.jpg" alt="Detail of the above quilt, highlighting the embroidery and exotic stitchwork." />
</picture>';
		$actual = get_the_post_thumbnail( $this->post_id, 'my_source_list' );

		$this->assertEquals( $expected, $actual );
	}

	/**
	 * Remove all changes from this test class.
	 */
	function tearDown() {
		global $rad_source_lists, $rad_breakpoints;

		$rad_source_lists = array();
		$rad_breakpoints = array();

		remove_image_size( 'test_image_size_1', 1200, 600, true );
		remove_image_size( 'test_image_size_2', 600, 300, true );
		remove_image_size( 'test_image_size_3', 300, 150, true );
		remove_image_size( 'test_image_size_4', 1000, 800, true );
		remove_image_size( 'test_image_size_5', 500, 400, true );

		unlink( $this->test_file );
	}
}
