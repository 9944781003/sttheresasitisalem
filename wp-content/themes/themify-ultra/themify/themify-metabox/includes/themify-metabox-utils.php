<?php

/**
 * Takes an array of options and return a one dimensional array of all the field names
 *
 * @return array
 * @since 1.0.2
 */


function themify_metabox_get_field_names( $arr ) {
	$list = array();
	if( ! empty( $arr ) ){ 
	    foreach( $arr as $metabox ){
		    if( ! empty( $metabox['options'] ) ) {
			    $list = array_merge( $list, wp_list_pluck( themify_metabox_make_flat_fields_array( $metabox['options'] ), 'name' ) );
		    }
	    }
	}

	return apply_filters( 'themify_metabox_get_field_names', array_unique( $list ), $arr );
}

/**
 * Takes an options array and returns a one-dimensional list of fields
 *
 * @return array
 * @since 1.0.2
 */
function themify_metabox_make_flat_fields_array( $arr ) {
	$list = array();
	foreach ( $arr as $field ) {
	    if ( ! isset( $field['type'] ) ) {
			continue;
		}
		if ( $field['type'] === 'multi' ) {
			foreach ( $field['meta']['fields'] as $_field ) {
				$list[] = $_field;
			}
		} elseif ( $field['type'] === 'toggle_group' ) {
			foreach ( $field['meta'] as $_field ) {
				$list[] = $_field;
			}
		} else {
			$list[] = $field;
		}
	}

	return $list;
}

/**
 * Check if assignments are applied in the current context
 *
 * @since 1.0
 */
function themify_verify_assignments( $assignments ) {
	$query_object = get_queried_object();

	if ( ! empty( $assignments['roles'] )
		// check if *any* of user's role(s) matches
		&& ! count( array_intersect( wp_get_current_user()->roles, array_keys( $assignments['roles'], true ) ) )
	) {
		return false; // bail early.
	}
	unset( $assignments['roles'] );

	if ( ! empty($assignments ) ) {
		

		if (
			( isset($assignments['general']['home']) && is_front_page())
			|| (isset( $assignments['general']['page'] ) &&  is_page() && ! is_front_page() )
			|| ( is_singular('post') && isset($assignments['general']['single']) )
			|| ( isset($assignments['general']['search']) && is_search() )
			|| ( isset($assignments['general']['author'])  && is_author())
			|| ( isset($assignments['general']['category']) && is_category())
			|| ( isset($assignments['general']['tag'])  && is_tag())
			|| ( isset($query_object->post_type,$assignments['general'][$query_object->post_type]) && is_singular() && $query_object->post_type !== 'page' && $query_object->post_type !== 'post' )
			|| ( isset($query_object->taxonomy,$assignments['general'][$query_object->taxonomy]) && is_tax())
		) {
			return true;
		} else { // let's dig deeper into more specific visibility rules
			if ( ! empty( $assignments['tax'] ) ) {
				if ( is_single() ) {
					if ( ! empty( $assignments['tax']['category_single'] ) ) {
						$categories = wp_get_post_categories( get_queried_object_id(), array( 'fields' => 'slugs' ) );
						if ( array_intersect( array_keys( $assignments['tax']['category_single'], true ), $categories ) ) {
							return true;
						}
					}
				} else {
					foreach ( $assignments['tax'] as $tax => $terms ) {
						$terms = array_keys( $terms );
						if ( ( $tax === 'category' && is_category($terms) ) || ( $tax === 'post_tag' && is_tag( $terms ) ) || ( is_tax( $tax, $terms ) )
						) {
							return true;
						}
					}
				}
			}
			if (! empty( $assignments['post_type'] ) ) {
				foreach ( $assignments['post_type'] as $post_type => $posts ) {
					$posts = array_keys( $posts );
					if (
						// Post single
						( $post_type === 'post' && is_single() && is_single( $posts ) )
						// Page view
						|| ( $post_type === 'page' && (
								( is_page() && is_page( $posts ) )
								|| ( ! is_front_page() && is_home() && in_array( get_post_field( 'post_name', get_option( 'page_for_posts' ) ), $posts ,true ) ) // check for Posts page
								|| ( class_exists( 'WooCommerce', false ) && function_exists( 'is_shop' ) && is_shop() && in_array( get_post_field( 'post_name', wc_get_page_id( 'shop' )), $posts,true  ) ) // check for Shop page
						) )
						// Custom Post Types single view check
						|| ( is_singular( $post_type ) && in_array( $query_object->post_name, $posts,true ) )
					) {
						return true;
					}
				}
			}
		}
	}
	return false;

}

/**
 * Take an array and converts it to multiple input[type="hidden"]
 *
 * @return string
 */
function themify_array_to_input( $array, $prefix = '' ) {
	$output = '';
	if ( (bool) count( array_filter( array_keys( $array ), 'is_string' ) ) ) {
		foreach ( $array as $key => $value ) {
			if ( empty( $prefix ) ) {
				$name = $key;
			} else {
				$name = $prefix . '[' . $key . ']';
			}
			if ( is_array( $value ) ) {
				$output .= themify_array_to_input( $value, $name );
			} else {
				$output .= '<input type="hidden" value="' . $value .'" name="' . $name .'">';
			}
		}
	} else {
		foreach ($array as $item) {
			if ( is_array($item) ) {
				$output .= themify_array_to_input( $item, $prefix . '[]' );
			} else {
				$output .= '<input type="hidden" name="' . $prefix . '[]" value="' . $item .'">';
			}
		}
	}

	return $output;
}
