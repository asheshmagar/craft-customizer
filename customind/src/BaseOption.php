<?php
namespace Customind;

class BaseOption {

	public function __construct() {
		add_filter( 'customind_customizer_options', array( $this, 'register_options' ), 10, 2 );
	}

	public function register_options( $options, $customize ) {
		return $options;
	}
}
