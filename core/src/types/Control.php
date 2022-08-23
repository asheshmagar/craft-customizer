<?php
/**
 * Control class.
 */

namespace Customind\Types;

defined( 'ABSPATH' ) || exit;

/**
 * Class Control.
 */
class Control {

	/**
	 * @var array $controls.
	 */
	private static $controls;

	/**
	 * Add control.
	 *
	 * @param $name
	 * @param $attributes
	 * @return void
	 */
	public static function add_control( $name, $attributes ) {
		global $wp_customize;
		self::$controls[ $name ] = $attributes;
		if ( isset( $attributes['callback'] ) ) {
			$wp_customize->register_control_type( $attributes['callback'] );
		}
	}

	/**
	 * Get control instance.
	 *
	 * @param $control_type
	 * @return false|string
	 */
	public static function get_control_instance( $control_type ) {
		$control_class = self::get_control( $control_type );
		return isset( $control_class['callback'] ) && class_exists( $control_class['callback'] ) ? $control_class['callback'] : false;
	}

	/**
	 * Get control.
	 *
	 * @param $control_type
	 * @return array|mixed
	 */
	public static function get_control( $control_type ) {
		return isset( self::$controls[ $control_type ] ) ? self::$controls[ $control_type ] : array();
	}

	/**
	 * Get control sanitize callback.
	 *
	 * @param $control
	 * @return false|mixed
	 */
	public static function get_sanitize_callback( $control ) {
		return isset( self::$controls[ $control ]['sanitize_callback'] ) ? self::$controls[ $control ]['sanitize_callback'] : false;
	}
}
