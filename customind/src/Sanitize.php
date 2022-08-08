<?php
/**
 * Sanitize class.
 *
 * @package Customind
 */

namespace Customind;

use WP_Customize_Setting;

/**
 * Sanitize class.
 */
class Sanitize {

	/**
	 * Sanitize checkbox.
	 *
	 * @param $input
	 * @return int|string
	 */
	public static function sanitize_checkbox( $input ) {
		return ( ( 1 === $input || '1' === $input || true === (bool) $input ) ? 1 : '' );
	}

	/**
	 * Sanitize int.
	 *
	 * @param $number
	 * @param WP_Customize_Setting $setting
	 * @return int|string
	 */
	public static function sanitize_int( $number, $setting ) {
		return ( is_numeric( $number ) ? intval( $number ) : $setting->default );
	}

	/**
	 * Sanitize HTML.
	 *
	 * @param $input
	 * @return string
	 */
	public static function sanitize_html( $input ) {
		return wp_kses_post( $input );
	}

	/**
	 * Sanitize no HTML.
	 *
	 * @param $input
	 * @return string
	 */
	public static function sanitize_nohtml( $input ) {
		return wp_filter_nohtml_kses( $input );
	}

	/**
	 * Sanitize a string key.
	 *
	 * @param $input
	 * @return string
	 */
	public static function sanitize_key( $input ) {
		return sanitize_key( $input );
	}

	/**
	 * Sanitize text field.
	 *
	 * @param $input
	 * @return string
	 */
	public static function sanitize_text_field( $input ) {
		return sanitize_text_field( $input );
	}

	/**
	 * Sanitize radio select.
	 *
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

	/**
	 * Sanitize alpha color.
	 *
	 * @param $input
	 * @param WP_Customize_Setting $setting
	 * @return mixed|string
	 */
	public static function sanitize_alpha_color( $input, $setting ) {
		if ( '' === $input ) {
			return '';
		}

		if ( 'header_textcolor' === $setting->id && 'blank' === $input ) {
			return 'blank';
		}

		$color = str_replace( ' ', '', $input );

		if ( false !== strpos( $color, 'rgb' ) ) {
			sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
			$alpha = $alpha ? $alpha : 1;
			return self::to_hex( $red, $green, $blue, $alpha );
		}

		return self::sanitize_hex_color( $input );
	}

	/**
	 * Convert rga to hex.
	 *
	 * @param $red
	 * @param $green
	 * @param $blue
	 * @param $alpha
	 * @return string
	 */
	public static function to_hex( $red, $green, $blue, $alpha = 1 ) {
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
			return "#$red$green$blue$alpha";
		}
		return "#$red$green$blue";
	}

	/**
	 * Sanitize false values.
	 *
	 * @return false
	 */
	public static function sanitize_false_values() {
		return false;
	}

	/**
	 * Sanitize number.
	 *
	 * @param $input
	 * @param WP_Customize_Setting $setting
	 * @return float|int|string
	 */
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

	/**
	 * Sanitize email.
	 *
	 * @param $input
	 * @param WP_Customize_Setting $setting
	 * @return string
	 */
	public static function sanitize_email( $input, $setting ) {
		$email = sanitize_email( $input );
		return ! is_null( $email ) ? $email : $setting->default;
	}

	/**
	 * Sanitize URL.
	 *
	 * @param $input
	 * @return string
	 */
	public static function sanitize_url( $input ) {
		return esc_url_raw( $input );
	}

	/**
	 * Sanitize dropdown categories.
	 *
	 * @param $input
	 * @param WP_Customize_Setting $setting
	 * @return int
	 */
	public static function sanitize_dropdown_categories( $input, $setting ) {
		$input = absint( $input );
		return term_exists( $input, 'category' ) ? $input : $setting->default;
	}

	/**
	 * Sanitize dropdown pages.
	 *
	 * @param $input
	 * @param WP_Customize_Setting $setting
	 * @return int
	 */
	public static function sanitize_dropdown_pages( $input, $setting ) {
		$input = absint( $input );
		return 'publish' === get_post_status( $input ) ? $input : $setting->default;
	}

	/**
	 * Sanitize image upload.
	 *
	 * @param $input
	 * @param WP_Customize_Setting $setting
	 * @return mixed|string
	 */
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

	/**
	 * Sanitize background.
	 *
	 * @param $input
	 * @param WP_Customize_Setting $setting
	 * @return array
	 */
	public static function sanitize_background( $input, $setting ) {
		if ( ! is_array( $input ) ) {
			return array();
		}
		$output = array();
		if ( isset( $input['background-color'] ) ) {
			$output['background-color'] = self::sanitize_alpha_color( $input['background-color'], $setting );
		}
		if ( isset( $input['background-image'] ) ) {
			$output['background-image'] = self::sanitize_image_upload( $input['background-image'], $setting );
		}
		if ( isset( $input['background-repeat'] ) ) {
			$output['background-repeat'] = self::sanitize_text_field( $input['background-repeat'] );
		}
		if ( isset( $input['background-position'] ) ) {
			$output['background-position'] = self::sanitize_text_field( $input['background-position'] );
		}
		if ( isset( $input['background-size'] ) ) {
			$output['background-size'] = self::sanitize_text_field( $input['background-size'] );
		}
		if ( isset( $input['background-attachment'] ) ) {
			$output['background-attachment'] = self::sanitize_text_field( $input['background-attachment'] );
		}
		return $output;
	}

	/**
	 * Sanitize typography.
	 *
	 * @param $input
	 * @param WP_Customize_Setting $setting
	 * @return mixed
	 */
	public static function sanitize_typography( $input, $setting ) {
		return $input;
	}

	/**
	 * Sanitize sortable.
	 *
	 * @param $input
	 * @param WP_Customize_Setting $setting
	 * @return array
	 */
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
