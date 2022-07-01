<?php

use Customind\Framework;

define( 'CUSTOMIND_FILE', __FILE__ );

require __DIR__ . '/vendor/autoload.php';

function Customind() {
	return Framework::instance();
}

Customind();
