<?php
namespace Customind;

use WP_Customize_Setting;

class Sanitize {

	public static function sanitize_checkbox( $input ) {
		return ( ( 1 === $input || '1' === $input || true === (bool) $input ) ? 1 : '' );
	}

	public static function sanitize_int( $number, $setting ) {
		return ( is_numeric( $number ) ? intval( $number ) : $setting->default );
	}

	public static function sanitize_html( $input ) {
		return wp_kses_post( $input );
	}

	public static function sanitize_nohtml( $input ) {
		return wp_filter_nohtml_kses( $input );
	}

	public static function sanitize_key( $input ) {
		return sanitize_key( $input );
	}

	public static function sanitize_text_field( $input ) {
		return sanitize_text_field( $input );
	}

	/**
	 * @param $input
	 * @param WP_Customize_Setting $setting
	 * @return string
	 */
	public static function sanitize_radio_select( $input, $setting ) {
		$input   = self::sanitize_text_field( $input );
		$choices = $setting->manager->get_control( $setting->id )->choices;
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}

	public static function sanitize_hex_color( $input ) {
		if ( empty( $input ) ) {
			return '';
		}
		if ( preg_match( '|^#([A-Fa-f\d]{3}){1,2}$|', $input ) ) {
			return $input;
		}
		return '';
	}

	public static function sanitize_alpha_color( $input, $setting ) {
		if ( '' === $input ) {
			return '';
		}
		if ( 'header_textcolor' === $setting->id && 'blank' === $input ) {
			return 'blank';
		}
		if ( false === strpos( $input, 'rgb' ) ) {
			return self::sanitize_hex_color( $input );
		}
		$color = str_replace( ' ', '', $input );
		if ( strpos( $color, 'rgba' ) !== false ) {
			sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
			if ( 'background_color' === $setting->id || 'header_textcolor' === $setting->id ) {
				return self::convert_rgba_to_hex( $red, $green, $blue, $alpha );
			}
			return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
		}
		sscanf( $color, 'rgb(%d,%d,%d)', $red, $green, $blue );
		if ( 'background_color' === $setting->id || 'header_textcolor' === $setting->id ) {
			return self::convert_rgba_to_hex( $red, $green, $blue );
		}
		return 'rgb(' . $red . ',' . $green . ',' . $blue . ')';
	}

	public static function convert_rgba_to_hex( $red, $green, $blue, $alpha = 1 ) {
		$red   = dechex( (int) $red );
		$green = dechex( (int) $green );
		$blue  = dechex( (int) $blue );
		$alpha = (float) $alpha;
		if ( strlen( $red ) < 2 ) {
			$red = '0' . $red;
		}
		if ( strlen( $green ) < 2 ) {
			$green = '0' . $green;
		}
		if ( strlen( $blue ) < 2 ) {
			$blue = '0' . $blue;
		}
		if ( $alpha < 1 ) {
			$alpha = $alpha * 255;
			if ( $alpha < 7 ) {
				$alpha = '0' . dechex( $alpha );
			} else {
				$alpha = dechex( $alpha );
			}
			return $red . $green . $blue . $alpha;
		}
		return $red . $green . $blue;
	}

	public static function sanitize_false_values() {
		return false;
	}

	public static function sanitize_number( $input, $setting ) {
		$input_attrs = $setting->manager->get_control( $setting->id )->input_attrs;
		if ( isset( $input_attrs ) ) {
			$input_attrs['min']  = isset( $input_attrs['min'] ) ? $input_attrs['min'] : 0;
			$input_attrs['step'] = isset( $input_attrs['step'] ) ? $input_attrs['step'] : 1;
			if ( isset( $input_attrs['max'] ) && $input > $input_attrs['max'] ) {
				$input = $input_attrs['max'];
			} elseif ( $input < $input_attrs['min'] ) {
				$input = $input_attrs['min'];
			}
			if ( $input ) {
				$input = (int) $input;
			}
		}
		return is_numeric( $input ) ? $input : $setting->default;
	}

	public static function sanitize_email( $input, $setting ) {
		$email = sanitize_email( $input );
		return ! is_null( $email ) ? $email : $setting->default;
	}

	public static function sanitize_url( $input ) {
		return esc_url_raw( $input );
	}

	public static function sanitize_dropdown_categories( $input, $setting ) {
		$input = absint( $input );
		return term_exists( $input, 'category' ) ? $input : $setting->default;
	}

	public static function sanitize_dropdown_pages( $input, $setting ) {
		$input = absint( $input );
		return 'publish' === get_post_status( $input ) ? $input : $setting->default;
	}

	public static function sanitize_image_upload( $input, $setting ) {
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
			'bmp'          => 'image/bmp',
			'tiff|tif'     => 'image/tiff',
			'ico'          => 'image/x-icon',
		);
		$file  = wp_check_filetype( $input, $mimes );
		return $file['ext'] ? $input : '';
	}

	public static function sanitize_background( $input, $setting ) {
		if ( ! is_array( $input ) ) {
			return array();
		}
		$output = array();
		if ( isset( $background_args['background-color'] ) ) {
			$output['background-color'] = self::sanitize_alpha_color( $background_args['background-color'], $setting );
		}
		if ( isset( $background_args['background-image'] ) ) {
			$output['background-image'] = self::sanitize_image_upload( $background_args['background-image'], $setting );
		}
		if ( isset( $background_args['background-repeat'] ) ) {
			$output['background-repeat'] = self::sanitize_text_field( $background_args['background-repeat'] );
		}
		if ( isset( $background_args['background-position'] ) ) {
			$output['background-position'] = self::sanitize_text_field( $background_args['background-position'] );
		}
		if ( isset( $background_args['background-size'] ) ) {
			$output['background-size'] = self::sanitize_text_field( $background_args['background-size'] );
		}
		if ( isset( $background_args['background-attachment'] ) ) {
			$output['background-attachment'] = self::sanitize_text_field( $background_args['background-attachment'] );
		}
		return $output;
	}

	public static function sanitize_typography( $input, $setting ) {
		return $input;
	}

	public static function sanitize_gradient( $input ) {
		return ! is_array( $input ) ? $input : array();
	}

	public static function sanitize_sortable( $input, $setting ) {
		$choices    = $setting->manager->get_control( $setting->id )->choices;
		$input_keys = $input;
		foreach ( (array) $input_keys as $key => $value ) {
			if ( ! array_key_exists( $value, $choices ) ) {
				unset( $input[ $key ] );
			}
		}
		return ( is_array( $input ) ? $input : $setting->default );
	}
}
