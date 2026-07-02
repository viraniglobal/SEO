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
	 * Analyze a post/page/product.
	 *
	 * @param WP_Post $post Post object.
	 * @return array
	 */
	public static function analyze( $post ) {

		$content = wp_strip_all_tags( $post->post_content );

		$word_count = str_word_count( $content );

		$featured_image = has_post_thumbnail( $post->ID );

		/*
		 * Meta Title Detection
		 */

		$meta_title = '';

		// Yoast SEO.
		if ( empty( $meta_title ) ) {
			$meta_title = get_post_meta( $post->ID, '_yoast_wpseo_title', true );
		}

		// Rank Math.
		if ( empty( $meta_title ) ) {
			$meta_title = get_post_meta( $post->ID, 'rank_math_title', true );
		}

		// AIOSEO.
		if ( empty( $meta_title ) ) {
			$meta_title = get_post_meta( $post->ID, '_aioseo_title', true );
		}

		// WordPress fallback.
		if ( empty( $meta_title ) ) {
			$meta_title = get_the_title( $post->ID );
		}

		/*
		 * Meta Description Detection
		 */

		$meta_description = '';

		// Yoast SEO.
		if ( empty( $meta_description ) ) {
			$meta_description = get_post_meta(
				$post->ID,
				'_yoast_wpseo_metadesc',
				true
			);
		}

		// Rank Math.
		if ( empty( $meta_description ) ) {
			$meta_description = get_post_meta(
				$post->ID,
				'rank_math_description',
				true
			);
		}

		// AIOSEO.
		if ( empty( $meta_description ) ) {
			$meta_description = get_post_meta(
				$post->ID,
				'_aioseo_description',
				true
			);
		}

		// WordPress fallback.
		if ( empty( $meta_description ) ) {
			$meta_description = wp_trim_words(
				$content,
				25,
				''
			);
		}

		/*
		 * SEO Score
		 */

		$score = 100;

		if ( $word_count < 300 ) {
			$score -= 20;
		}

		if ( ! $featured_image ) {
			$score -= 10;
		}

		if ( empty( $meta_title ) ) {
			$score -= 15;
		}

		if ( empty( $meta_description ) ) {
			$score -= 15;
		}

		if ( $score < 0 ) {
			$score = 0;
		}

		return array(

			'post_id' => $post->ID,

			'post_type' => $post->post_type,

			'title' => get_the_title( $post->ID ),

			'url' => get_permalink( $post->ID ),

			'word_count' => $word_count,

			'featured_image' => $featured_image,

			'meta_title' => $meta_title,

			'meta_description' => $meta_description,

			'h1_count' => 0,

			'missing_alt' => 0,

			'missing_meta_title' => empty( $meta_title ),

			'missing_meta_description' => empty( $meta_description ),

			'seo_score' => $score,

		);

	}
}