<?php
/**
 * SEO Audit Controller
 *
 * @package Virani_SEO_AI_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class VSAP_Audit {

	/**
	 * Initialize AJAX hooks.
	 *
	 * @return void
	 */
	public static function init() {

		add_action(
			'wp_ajax_vsap_start_audit',
			array( self::class, 'start' )
		);
	}

	/**
	 * Start SEO Audit.
	 *
	 * @return void
	 */
	public static function start() {

		check_ajax_referer( 'vsap_audit', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error(
				array(
					'message' => 'Permission denied.',
				)
			);
		}

		try {

			$scanner = new VSAP_Scanner();

			$scan = $scanner->scan();

			$summary = VSAP_Results::build_summary(
				$scan['results']
			);

			wp_send_json_success(
				array(
					'success' => true,
					'message' => $scan['message'],
					'summary' => $summary,
					'results' => $scan['results'],
				)
			);

		} catch ( \Exception $e ) {

			wp_send_json_error(
				array(
					'success' => false,
					'message' => $e->getMessage(),
				)
			);

		}
	}
}