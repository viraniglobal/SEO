<?php
/**
 * Database Helper
 *
 * @package Virani_SEO_AI_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VSAP_Database {

	/**
	 * Plugin Version
	 *
	 * @return string
	 */
	public static function version() {
		return VSAP_VERSION;
	}

	/**
	 * Get Audit Table
	 *
	 * @return string
	 */
	public static function audits_table() {

		global $wpdb;

		return $wpdb->prefix . 'vsap_audits';
	}

	/**
	 * Clear Previous Audit
	 *
	 * @return void
	 */
	public static function clear_audits() {

		global $wpdb;

		$wpdb->query(
			'TRUNCATE TABLE ' . self::audits_table()
		);
	}

	/**
	 * Save Audit Record
	 *
	 * @param array $data Audit row.
	 * @return bool
	 */
	public static function save_audit( array $data ) {

		global $wpdb;

		$result = $wpdb->insert(
			self::audits_table(),
			array(
				'post_id'          => isset( $data['post_id'] ) ? (int) $data['post_id'] : 0,
				'post_type'        => sanitize_text_field( $data['post_type'] ?? '' ),
				'url'              => esc_url_raw( $data['url'] ?? '' ),
				'title'            => sanitize_text_field( $data['title'] ?? '' ),
				'meta_title'       => sanitize_text_field( $data['meta_title'] ?? '' ),
				'meta_description' => sanitize_textarea_field( $data['meta_description'] ?? '' ),
				'h1_count'         => isset( $data['h1_count'] ) ? (int) $data['h1_count'] : 0,
				'missing_alt'      => isset( $data['missing_alt'] ) ? (int) $data['missing_alt'] : 0,
				'word_count'       => isset( $data['word_count'] ) ? (int) $data['word_count'] : 0,
				'status'           => sanitize_text_field( $data['status'] ?? 'completed' ),
			),
			array(
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%s',
			)
		);

		return ( false !== $result );
	}

	/**
	 * Get Latest Audits
	 *
	 * @param int $limit Number of rows.
	 * @return array
	 */
	public static function get_audits( $limit = 100 ) {

		global $wpdb;

		$limit = absint( $limit );

		return $wpdb->get_results(
			$wpdb->prepare(
				"SELECT * FROM " . self::audits_table() . " ORDER BY id DESC LIMIT %d",
				$limit
			),
			ARRAY_A
		);
	}

	/**
	 * Get Dashboard Summary
	 *
	 * @return array
	 */
	public static function get_summary() {

		global $wpdb;

		$table = self::audits_table();

		return array(
			'total_pages' => (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table}" ),
			'missing_meta_title' => (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table} WHERE meta_title=''" ),
			'missing_meta_description' => (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$table} WHERE meta_description=''" ),
			'missing_alt' => (int) $wpdb->get_var( "SELECT SUM(missing_alt) FROM {$table}" ),
			'average_word_count' => (int) $wpdb->get_var( "SELECT AVG(word_count) FROM {$table}" ),
		);
	}
}