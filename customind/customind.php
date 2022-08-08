<?php

use Customind\Customind;

require __DIR__ . '/vendor/autoload.php';

function customind() {
	return Customind::get_instance();
}

customind();
