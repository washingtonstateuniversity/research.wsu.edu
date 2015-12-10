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
	if ( isset( $post->featured_image ) && isset( $post->_embedded->{'https://api.w.org/featuredmedia'} ) && 0 < count( $post->_embedded->{'https://api.w.org/featuredmedia'} ) ) {
		$subset_feature = $post->_embedded->{'https://api.w.org/featuredmedia'}[0]->media_details;

		if ( isset( $subset_feature->sizes->{'spine-medium_size'} ) ) {
			$subset->thumbnail = $subset_feature->sizes->{'spine-medium_size'}->source_url;
		} else {
			$subset->thumbnail = $post->_embedded->{'https://api.w.org/featuredmedia'}[0]->source_url;
		}
	} else {
		$subset->thumbnail = false;
	}

	return $subset;
}