<?php
/**
 * Dashboard Template
 *
 * @package Virani_SEO_AI_Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$summary = VSAP_Database::get_summary();

$total_pages              = $summary['total_pages'] ?? 0;
$missing_meta_title       = $summary['missing_meta_title'] ?? 0;
$missing_meta_description = $summary['missing_meta_description'] ?? 0;
$missing_alt              = $summary['missing_alt'] ?? 0;
$average_word_count       = $summary['average_word_count'] ?? 0;

$seo_health = 100;

$seo_health -= min( $missing_meta_title, 20 );
$seo_health -= min( $missing_meta_description, 20 );
$seo_health -= min( $missing_alt, 20 );

if ( $seo_health < 0 ) {
	$seo_health = 0;
}
?>

<div class="wrap">

	<h1>🚀 Virani SEO AI Pro</h1>

	<div class="vsap-dashboard">

		<?php VSAP_Admin::card( 'SEO Health', $seo_health . '%' ); ?>

		<?php VSAP_Admin::card( 'Pages Scanned', $total_pages ); ?>

		<?php VSAP_Admin::card( 'Missing Meta Title', $missing_meta_title ); ?>

		<?php VSAP_Admin::card( 'Missing Meta Description', $missing_meta_description ); ?>

		<?php VSAP_Admin::card( 'Missing ALT', $missing_alt ); ?>

		<?php VSAP_Admin::card( 'Average Word Count', $average_word_count ); ?>

	</div>

	<p style="margin-top:30px;">

		<button
			id="vsap-start-audit"
			class="button button-primary button-large">

			🚀 Start Full SEO Audit

		</button>

	</p>

	<div id="vsap-audit-log"></div>

</div>