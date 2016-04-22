<?php 

add_action( 'wp_enqueue_scripts', 'research_enqueue_scripts');
/*
 * Enqueue custom scripting in child theme.
 */
function research_enqueue_scripts() {
	wp_enqueue_style( 'custom-style', get_stylesheet_directory_uri() . '/assets/custom-research.css' );
}

add_filter( 'wsu_content_syndicate_host_data', 'research_filter_syndicate_host_data', 10, 2 );
/**
 * Filter the thumbnail used from a remote host with WSU Content Syndicate
 *
 * @param object $subset Data associated with a single remote item.
 * @param object $post   Original data used to build the subset.
 *
 * @return object Modified data.
 */
function research_filter_syndicate_host_data( $subset, $post ) {
	if ( is_array( $post ) && ! empty ( $post['featured_media'] ) && ! empty( $post['_links']['wp:featuredmedia'] ) ) {
		$media_request_url = $post['_links']['wp:featuredmedia'][0]['href'];
		$media_request = WP_REST_Request::from_url( $media_request_url );
		$media_response = rest_do_request( $media_request );
		$data = $media_response->data;
		$data = $data['media_details']['sizes'];

		if ( isset( $data['spine-medium-size'] ) ) {
			$subset->thumbnail = $data['spine-medium-size']['source_url'];
		} else {
			$subset->thumbnail = $media_response->data['source_url'];
		}
	} elseif ( isset( $post->featured_media ) && isset( $post->_embedded->{'wp:featuredmedia'} ) && 0 < count( $post->_embedded->{'wp:featuredmedia'} ) ) {
		$subset_feature = $post->_embedded->{'wp:featuredmedia'}[0]->media_details;

		if ( isset( $subset_feature->sizes->{'spine-medium_size'} ) ) {
			$subset->thumbnail = $subset_feature->sizes->{'spine-medium_size'}->source_url;
		} else {
			$subset->thumbnail = $post->_embedded->{'wp:featuredmedia'}[0]->source_url;
		}
	} else {
		$subset->thumbnail = false;
	}

	return $subset;
}

add_action( 'wp_head', 'research_add_meta_tags' );
/**
 * Output a mobile specific meta tag on stage.research.wsu.edu
 */
function research_add_meta_tags() {
	global $current_blog;

	if ( 'stage.research.wsu.edu' !== $current_blog->domain ) {
		return;
	}

	?><meta name="apple-mobile-web-app-capable" content="yes"><?php
}
