<?php
/**
 * WPSEO plugin file.
 *
 * @package WPSEO\Admin
 */

/** @noinspection PhpUnusedLocalVariableInspection */
$alerts_data = Yoast_Alerts::get_template_variables();

<<<<<<< HEAD
$options  = WPSEO_Options::get_options( array( 'wpseo' ) );
$notifier = new WPSEO_Configuration_Notifier( $options );
$notifier->listen();

/* translators: %1$s expands to Yoast SEO. */
$wpseo_dashboard_header = sprintf( esc_html__( '%1$s Dashboard', 'wordpress-seo' ), 'Yoast SEO' );

?>
<div class="yoast-alerts">

	<h2><?php echo esc_html( $wpseo_dashboard_header ); ?></h2>

	<?php echo $notifier->notify(); ?>

	<div class="yoast-container yoast-container__alert">
		<?php require WPSEO_PATH . 'admin/views/partial-alerts-errors.php'; ?>
	</div>

	<div class="yoast-container yoast-container__warning">
		<?php require WPSEO_PATH . 'admin/views/partial-alerts-warnings.php'; ?>
=======
$notifier = new WPSEO_Configuration_Notifier();
$notifier->listen();

$wpseo_contributors_phrase = sprintf(
	/* translators: %1$s expands to Yoast SEO */
	__( 'See who contributed to %1$s.', 'wordpress-seo' ),
	'Yoast SEO'
);

?>

<div class="tab-block">
	<div class="yoast-alerts">

		<?php echo $notifier->notify(); ?>

		<div class="yoast-container yoast-container__alert">
			<?php require WPSEO_PATH . 'admin/views/partial-alerts-errors.php'; ?>
		</div>

		<div class="yoast-container yoast-container__warning">
			<?php require WPSEO_PATH . 'admin/views/partial-alerts-warnings.php'; ?>
		</div>

>>>>>>> 183795979354da53b136df92de933c2cb84a544a
	</div>
</div>

<div class="tab-block">
	<h3><?php esc_html_e( 'Credits', 'wordpress-seo' ); ?></h3>
	<p>
		<span class="dashicons dashicons-groups"></span>
		<a href="<?php WPSEO_Shortlinker::show( 'http://yoa.st/yoast-seo-credits' ); ?>"><?php echo esc_html( $wpseo_contributors_phrase ); ?></a>
	</p>
</div>

<?php

/**
 * Action: 'wpseo_internal_linking' - Hook to add the internal linking analyze interface to the interface.
 *
 * @deprecated 7.0
 */
do_action_deprecated( 'wpseo_internal_linking', array(), 'WPSEO 7.0' );
