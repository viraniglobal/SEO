<?php
/**
 * SEO Audit Results
 *
 * @package Virani_SEO_AI_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VSAP_Results {

	/**
	 * Build audit summary.
	 *
	 * @param array $results Analyzer results.
	 * @return array
	 */
	public static function build_summary( array $results ) {

		$summary = array(
			'total_pages'                 => count( $results ),
			'missing_meta_title'          => 0,
			'missing_meta_description'    => 0,
			'featured_images_missing'     => 0,
			'total_words'                 => 0,
		);

		foreach ( $results as $item ) {

			if ( ! empty( $item['missing_meta_title'] ) ) {
				$summary['missing_meta_title']++;
			}

			if ( ! empty( $item['missing_meta_description'] ) ) {
				$summary['missing_meta_description']++;
			}

			if ( empty( $item['featured_image'] ) ) {
				$summary['featured_images_missing']++;
			}

			$summary['total_words'] += (int) $item['word_count'];
		}

		$summary['average_words'] = $summary['total_pages'] > 0
			? round( $summary['total_words'] / $summary['total_pages'] )
			: 0;

		return $summary;
	}
}