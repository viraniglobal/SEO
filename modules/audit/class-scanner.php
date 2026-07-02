<?php
/**
 * SEO Scanner
 *
 * @package Virani_SEO_AI_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VSAP_Scanner {

	/**
	 * Run Full SEO Scan
	 *
	 * @return array
	 */
	public function scan() {

		$post_types = array( 'post', 'page' );

		// WooCommerce Products.
		if ( post_type_exists( 'product' ) ) {
			$post_types[] = 'product';
		}

		// Clear previous audit.
		VSAP_Database::clear_audits();

		$posts = get_posts(
			array(
				'post_type'      => $post_types,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'orderby'        => 'ID',
				'order'          => 'ASC',
			)
		);

		$results = array();

		foreach ( $posts as $post ) {

			$row = VSAP_Analyzer::analyze( $post );

			// Save into database.
			VSAP_Database::save_audit(
				array(
					'post_id'          => $row['post_id'],
					'post_type'        => $row['post_type'],
					'url'              => $row['url'],
					'title'            => $row['title'],
					'meta_title'       => $row['meta_title'],
					'meta_description' => $row['meta_description'],
					'h1_count'         => $row['h1_count'] ?? 0,
					'missing_alt'      => $row['missing_alt'] ?? 0,
					'word_count'       => $row['word_count'],
					'status'           => 'completed',
				)
			);

			$results[] = $row;
		}

		return array(
			'success' => true,
			'message' => sprintf(
				'SEO Audit completed successfully. %d pages scanned.',
				count( $results )
			),
			'total'   => count( $results ),
			'results' => $results,
		);
	}
}