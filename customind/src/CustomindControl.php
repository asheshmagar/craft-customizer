<?php

namespace Customind;

class CustomindControl {

	public static $controls;

	public static function add_control( $name, $attributes ) {
		global $wp_customize;
		self::$controls[ $name ] = $attributes;
		if ( isset( $attributes['callback'] ) ) {
			$wp_customize->register_control_type( $attributes['callback'] );
		}
	}

	public static function get_control_instance( $control_type ) {
		$control_class = self::get_control( $control_type );
		return isset( $control_class['callback'] ) && class_exists( $control_class['callback'] ) ? $control_class['callback'] : false;
	}

	public static function get_control( $control_type ) {
		return isset( self::$controls[ $control_type ] ) ? self::$controls[ $control_type ] : array();
	}

	public static function get_sanitize_callback( $control ) {
		return isset( self::$controls[ $control ]['sanitize_callback'] ) ? self::$controls[ $control ]['sanitize_callback'] : false;
	}
}
