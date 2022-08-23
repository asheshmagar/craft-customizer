<?php
/**
 * Initialize.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use Customind\Core;

// Autoloader.
require __DIR__ . '/vendor/autoload.php';

// Save instance of object as global.
$GLOBALS['customind'] = Core::get_instance();
