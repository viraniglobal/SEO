<?php
/**
 * SEO Analyzer
 *
 * @package Virani_SEO_AI_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VSAP_Analyzer {

	/**
	 * Analyze a single post
	 *
	 * @param WP_Post $post Post object.
	 * @return array
	 */
	public static function analyze( $post ) {

		$content = wp_strip_all_tags( $post->post_content );

		$word_count = str_word_count( $content );

		$featured_image = has_post_thumbnail( $post->ID );

		$meta_title = get_post_meta( $post->ID, '_yoast_wpseo_title', true );

		$meta_description = get_post_meta(
			$post->ID,
			'_yoast_wpseo_metadesc',
			true
		);

		return array(

			'post_id' => $post->ID,

			'post_type' => $post->post_type,

			'title' => get_the_title( $post->ID ),

			'url' => get_permalink( $post->ID ),

			'word_count' => $word_count,

			'featured_image' => $featured_image,

			'meta_title' => $meta_title,

			'meta_description' => $meta_description,

			'missing_meta_title' => empty( $meta_title ),

			'missing_meta_description' => empty( $meta_description ),

		);
	}
}