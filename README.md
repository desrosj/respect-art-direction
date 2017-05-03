# Respect Art Direction

[![Build Status](https://travis-ci.org/desrosj/respect-art-direction.svg?branch=master)](https://travis-ci.org/desrosj/respect-art-direction)
[![Test Coverage](https://codeclimate.com/github/desrosj/respect-art-direction/badges/coverage.svg)](https://codeclimate.com/github/desrosj/respect-art-direction/coverage)
[![Code Climate](https://codeclimate.com/github/desrosj/respect-art-direction/badges/gpa.svg)](https://codeclimate.com/github/desrosj/respect-art-direction)
[![Issue Count](https://codeclimate.com/github/desrosj/respect-art-direction/badges/issue_count.svg)](https://codeclimate.com/github/desrosj/respect-art-direction)

In [version 4.4, WordPress merged responsive image support in core](https://make.wordpress.org/core/2015/11/10/responsive-images-in-wordpress-4-4/).
This meant sites would automatically benefit from responsive images through the
`srcset` attribute.

However, this feature does not account for art direction, a common problem in
responsive design.

This plugin is a proof of concept for a way to solve this.

## Approach

WordPress core defines several image sizes (large, medium, thumbnail, and
medium_large). Other image sizes need to be defined within a plugin or theme as
needed using the `after_setup_theme` action hook.

In themes, defined image sizes usually have specific purposes. A banner image,
or related post image, for example.

```php
function mytheme_add_image_sizes() {
    add_image_size( 'header_banner', 1200, 200, true );
    add_image_size( 'related_post', 400, 300, true );
}
add_action( 'after_setup_theme', 'mytheme_add_image_sizes' );
```

What if we took a similar approach to defining breakpoints and image sources?

### Defining Breakpoints

```php
function mytheme_add_breakpoints() {
    rad_add_breakpoint( 'mytheme_large', '(min-width: 1000px)' );
    rad_add_breakpoint( 'mytheme_medium', '(min-width: 480px)' );
    rad_add_breakpoint( 'mytheme_small', '(max-width: 479px)' );
}
add_action( 'after_setup_theme', 'mytheme_add_breakpoints' );
```

A breakpoint consists of a name, and a media query that attribute.

### Defining Image Sources

```php
function mytheme_add_image_sources() {
    rad_add_image_source( 'source_size1', array(
        'mytheme_large' => array(
            'custom1_large_size',
        ),
        'mytheme_medium' => array(
            'custom1_medium_size',
        ),
        'mytheme_small' => array(
            'custom1_small_size',
        ),
        'default' => array(
            'custom1_default_size',
        ),
    ) );
}
add_action( 'after_setup_theme', 'mytheme_add_image_sources' );
```

An image source is a name and a multidimensional array. The key of each array
index represents the breakpoint it belongs to, and the values in each array
represent the registered image sizes that belong to that breakpoint.

The image source name is a sort of pseudo image name. If you request markup
using a source set as the image size, it will replace the markup with a
`<picture>` tag properly populated with `<source>` tags. based on the
registered breakpoints and image sizes.
