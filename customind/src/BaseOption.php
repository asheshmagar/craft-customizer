<?php
/**
 * BaseOption class.
 *
 * @package Customind
 */

namespace Customind;

use WP_Customize_Manager;

/**
 * Base class for Customind options.
 */
class BaseOption {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_filter( 'customind_customizer_options', array( $this, 'register_options' ), 10, 2 );
	}

	/**
	 * Register options.
	 *
	 * @param array $options
	 * @param WP_Customize_Manager $customize
	 * @return array
	 */
	public function register_options( $options, $customize ) {
		return $options;
	}
}
