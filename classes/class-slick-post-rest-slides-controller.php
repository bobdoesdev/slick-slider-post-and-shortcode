<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Extend the main WP_REST_Posts_Controller to a private endpoint controller.
 */
class Slick_Slides_Post_REST_Controller extends WP_REST_Posts_Controller {
  
    public function prepare_item_for_response( $post, $request ) {
		$GLOBALS['post'] = $post;

		setup_postdata( $post );

		$schema = $this->get_item_schema();

		// Base fields for every post.
		$data = array();

		if ( ! empty( $schema['properties']['id'] ) ) {
			$data['id'] = $post->ID;
		}

		if ( ! empty( $schema['properties']['date'] ) ) {
			$data['date'] = $this->prepare_date_response( $post->post_date_gmt, $post->post_date );
		}

		if ( ! empty( $schema['properties']['date_gmt'] ) ) {
			$data['date_gmt'] = $this->prepare_date_response( $post->post_date_gmt );
		}

		if ( ! empty( $schema['properties']['guid'] ) ) {
			$data['guid'] = array(
				/** This filter is documented in wp-includes/post-template.php */
				'rendered' => apply_filters( 'get_the_guid', $post->guid ),
				'raw'      => $post->guid,
			);
		}
		
		if ( ! empty( $schema['properties']['slug'] ) ) {
			$data['slug'] = $post->post_name;
		}

		if ( ! empty( $schema['properties']['status'] ) ) {
			$data['status'] = $post->post_status;
		}

		if ( ! empty( $schema['properties']['type'] ) ) {
			$data['type'] = $post->post_type;
		}

		if ( ! empty( $schema['properties']['link'] ) ) {
			$data['link'] = get_permalink( $post->ID );
		}

		if ( ! empty( $schema['properties']['title'] ) ) {
			add_filter( 'protected_title_format', array( $this, 'protected_title_format' ) );

			$data['title'] = array(
				'raw'      => $post->post_title,
				'rendered' => get_the_title( $post->ID ),
			);

			remove_filter( 'protected_title_format', array( $this, 'protected_title_format' ) );
		}

		$has_password_filter = false;

		if ( $this->can_access_password_content( $post, $request ) ) {
			// Allow access to the post, permissions already checked before.
			add_filter( 'post_password_required', '__return_false' );

			$has_password_filter = true;
		}

		if ( ! empty( $schema['properties']['content'] ) ) {
			$data['content'] = array(
				'raw'       => $post->post_content,
				/** This filter is documented in wp-includes/post-template.php */
				'rendered'  => post_password_required( $post ) ? '' : apply_filters( 'the_content', $post->post_content ),
				'protected' => (bool) $post->post_password,
			);
		}

		if ( ! empty( $schema['properties']['excerpt'] ) ) {
			/** This filter is documented in wp-includes/post-template.php */
			$excerpt = apply_filters( 'the_excerpt', apply_filters( 'get_the_excerpt', $post->post_excerpt, $post ) );
			$data['excerpt'] = array(
				'raw'       => $post->post_excerpt,
				'rendered'  => post_password_required( $post ) ? '' : $excerpt,
				'protected' => (bool) $post->post_password,
			);
		}

		if ( $has_password_filter ) {
			// Reset filter.
			remove_filter( 'post_password_required', '__return_false' );
		}	

		if ( ! empty( $schema['properties']['featured_media'] ) ) {
			$data['featured_media'] = (int) get_post_thumbnail_id( $post->ID );
			$data['featured_thumb_url'] = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID, 'thumbnail' ) );
			$data['featured_media_url'] = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		}

		if ( ! empty( $schema['properties']['menu_order'] ) ) {
			$data['menu_order'] = (int) $post->menu_order;
		}


		if ( ! empty( $schema['properties']['meta'] ) ) {
			$data['meta'] = $this->meta->get_value( $post->ID, $request );
		}

		$taxonomies = wp_list_filter( get_object_taxonomies( $this->post_type, 'objects' ), array( 'show_in_rest' => true ) );

		foreach ( $taxonomies as $taxonomy ) {
			$base = ! empty( $taxonomy->rest_base ) ? $taxonomy->rest_base : $taxonomy->name;

			if ( ! empty( $schema['properties'][ $base ] ) ) {
				$terms = get_the_terms( $post, $taxonomy->name );
				$data[ $base ] = $terms ? array_values( wp_list_pluck( $terms, 'term_id' ) ) : array();
			}
		}

		$context = ! empty( $request['context'] ) ? $request['context'] : 'view';
		$data    = $this->add_additional_fields_to_object( $data, $request );
		$data    = $this->filter_response_by_context( $data, $context );

		// Wrap the data in a response object.
		$response = rest_ensure_response( $data );

		//$response->add_links( $this->prepare_links( $post ) );

		/**
		 * Filters the post data for a response.
		 *
		 * The dynamic portion of the hook name, `$this->post_type`, refers to the post type slug.
		 *
		 * @since 4.7.0
		 *
		 * @param WP_REST_Response $response The response object.
		 * @param WP_Post          $post     Post object.
		 * @param WP_REST_Request  $request  Request object.
		 */
		return apply_filters( "rest_prepare_{$this->post_type}", $response, $post, $request );
	}
	
}