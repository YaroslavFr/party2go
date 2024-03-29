<?php
/**
 * Extra Product Options Shortcodes
 *
 * @package Extra Product Options/Classes
 * @version 6.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Extra Product Options Shortcodes
 *
 * @package Extra Product Options/Classes
 * @version 6.0
 */
class THEMECOMPLETE_EPO_Shortcodes {

	/**
	 * Register local post type
	 * (This is used in Normal mode)
	 *
	 * @since 4.8
	 */
	public static function register_local_post_type() {

	}

	/**
	 * Shortcode tc_epo_show
	 * (Used for echoing a custom action)
	 *
	 * @param array $atts Shortcode settings.
	 * @param mixed $content Shortcode content.
	 * @since 4.8
	 */
	public static function tc_epo_show( $atts, $content = null ) {
		$vars = shortcode_atts(
			[
				'action' => '',
			],
			$atts
		);

		ob_start();
		do_action( $vars['action'] );

		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	/**
	 * Shortcode tc_epo
	 * (Used for echoing options)
	 *
	 * @param array $atts Shortcode settings.
	 * @param mixed $content Shortcode content.
	 * @since 4.8
	 */
	public static function tc_epo( $atts, $content = null ) {
		$vars = shortcode_atts(
			[
				'id'     => '',
				'prefix' => '',
			],
			$atts
		);

		ob_start();

		if ( $vars['id'] ) {
			THEMECOMPLETE_EPO_DISPLAY()->tm_epo_fields( $vars['id'], $vars['prefix'], true );
			THEMECOMPLETE_EPO_DISPLAY()->tm_add_inline_style();
		}

		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	/**
	 * Shortcode tc_current_epo
	 * (Used for echoing options)
	 *
	 * @param array $atts Shortcode settings.
	 * @param mixed $content Shortcode content.
	 * @since 4.8
	 */
	public static function tc_current_epo( $atts, $content = null ) {
		$vars = shortcode_atts(
			[
				'prefix' => '',
			],
			$atts
		);

		ob_start();

		global $product;
		$id = themecomplete_get_id( $product );
		if ( $id ) {
			THEMECOMPLETE_EPO_DISPLAY()->tm_epo_fields( $id, $vars['prefix'], true );
			THEMECOMPLETE_EPO_DISPLAY()->tm_add_inline_style();
		}

		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	/**
	 * Shortcode tc_epo_totals
	 * (Used for echoing options totals)
	 *
	 * @param array $atts Shortcode settings.
	 * @param mixed $content Shortcode content.
	 * @since 4.8
	 */
	public static function tc_epo_totals( $atts, $content = null ) {
		$vars = shortcode_atts(
			[
				'id'     => '',
				'prefix' => '',
			],
			$atts
		);

		ob_start();

		if ( $vars['id'] ) {
			THEMECOMPLETE_EPO_DISPLAY()->tm_epo_totals( $vars['id'], $vars['prefix'], true );
		}

		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}


	/**
	 * Add shortcodes
	 *
	 * @since 4.8
	 */
	public static function add() {

		add_shortcode( 'tc_epo_show', __CLASS__ . '::tc_epo_show' );
		add_shortcode( 'tc_epo', __CLASS__ . '::tc_epo' );
		add_shortcode( 'tc_current_epo', __CLASS__ . '::tc_current_epo' );
		add_shortcode( 'tc_epo_totals', __CLASS__ . '::tc_epo_totals' );

	}

}
