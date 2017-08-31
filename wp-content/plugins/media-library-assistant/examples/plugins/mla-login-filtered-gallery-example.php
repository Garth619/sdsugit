<?php
/**
 * Provides an [mla_gallery] parameter to restrict items to logged-in users based on an Att. Categories term
 *
 * In this example, a custom "members-only" parameter names an Att. Category term.
 * If the current user is not logged in any items assigned to the term are excluded from the gallery results.
 * This can be combined with a "simple" attachment_category query. For example:
 *
 * [mla_gallery members_only=client attachment_category=cityscape tax_include_children=false]
 *
 * This example plugin uses one of the many filters available in the [mla_gallery] shortcode
 * and illustrates a technique you can use to customize the gallery display.
 *
 * Created for support topic "exclude some files for non subcribed users"
 * opened on 7/12/2017 by "agustynen".
 * https://wordpress.org/support/topic/multiple-calls-to-a-smaller-amount
 *
 * @package MLA Login-filtered Gallery Example
 * @version 1.00
 */

/*
Plugin Name: MLA Login-filtered Gallery Example
Plugin URI: http://fairtradejudaica.org/media-library-assistant-a-wordpress-plugin/
Description: Restricts items to logged-in users based on an Att. Categories term
Author: David Lingren
Version: 1.00
Author URI: http://fairtradejudaica.org/our-story/staff/

Copyright 2017 David Lingren

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You can get a copy of the GNU General Public License by writing to the
	Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110, USA
*/

/**
 * Class MLA Login-filtered Gallery Example restricts items to logged-in users based on an Att. Categories term
 *
 * @package MLA Login-filtered Gallery Example
 * @since 1.00
 */
class MLALoginFilteredGalleryExample {
	/**
	 * Initialization function, similar to __construct()
	 *
	 * @since 1.00
	 */
	public static function initialize() {
		// The filters are only useful for front-end posts/pages; exit if in the admin section
		if ( is_admin() ) {
			return;
		}

		add_filter( 'mla_gallery_attributes', 'MLALoginFilteredGalleryExample::mla_gallery_attributes_filter', 10, 1 );
	}

	/**
	 * MLA Gallery (Display) Attributes
	 *
	 * The $shortcode_attributes array is where you will find any of your own parameters that are coded in the
	 * shortcode, e.g., [mla_gallery random_category="abc"].
	 *
	 * @since 1.00
	 *
	 * @param	array	the shortcode parameters passed in to the shortcode
	 */
	public static function mla_gallery_attributes_filter( $shortcode_attributes ) {
		global $wpdb;
//error_log( __LINE__ . ' MLALoginFilteredGalleryExample::mla_gallery_attributes_filter shortcode_attributes = ' . var_export( $shortcode_attributes, true ), 0 );

		// ignore shortcodes without the random_category parameter
		if ( empty( $shortcode_attributes['members_only'] ) ) {
			return $shortcode_attributes;
		}
		
		// ignore restrictions for logged in user
		$current_user = wp_get_current_user();
		if ( ( $current_user instanceof WP_User ) && ( 0 !== $current_user->ID ) ) {
			return $shortcode_attributes;
		}

		// Validate other tax_query parameters or set defaults
		$tax_operator = 'IN';
		if ( isset( $shortcode_attributes['tax_operator'] ) ) {
			$attr_value = strtoupper( $shortcode_attributes['tax_operator'] );
			if ( in_array( $attr_value, array( 'IN', 'NOT IN', 'AND' ) ) ) {
				$tax_operator = $attr_value;
			}
			
			unset( $shortcode_attributes['tax_operator'] );
		}

		$tax_include_children = true;
		if ( isset( $shortcode_attributes['tax_include_children'] ) ) {
			if ( 'false' == strtolower( $shortcode_attributes['tax_include_children'] ) ) {
				$tax_include_children = false;
			}
			
			unset( $shortcode_attributes['tax_include_children'] );
		}

		// Compose the simple tax query, if pesent
		if ( isset( $shortcode_attributes['attachment_category'] ) ) {
			$tax_query = array ('relation' => 'AND' );
			$tax_query[] =	array( 'taxonomy' => 'attachment_category', 'field' => 'slug', 'terms' => explode( ',', $shortcode_attributes['attachment_category'] ), 'operator' => $tax_operator, 'include_children' => $tax_include_children );
			unset( $shortcode_attributes['attachment_category'] );
		} else {
			$tax_query = array ();
		}

		// Add the members_only exclusion query
		$tax_query[] =	array( 'taxonomy' => 'attachment_category', 'field' => 'slug', 'terms' => explode( ',', $shortcode_attributes['members_only'] ), 'operator' => 'NOT IN', 'include_children' => $tax_include_children );

		$shortcode_attributes['tax_query'] = $tax_query;
//error_log( __LINE__ . ' MLALoginFilteredGalleryExample::mla_gallery_attributes_filter shortcode_attributes = ' . var_export( $shortcode_attributes, true ), 0 );
		
		return $shortcode_attributes;
	} // mla_gallery_attributes_filter
} // Class MLALoginFilteredGalleryExample

/*
 * Install the filters at an early opportunity
 */
add_action('init', 'MLALoginFilteredGalleryExample::initialize');
?>