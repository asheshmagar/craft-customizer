<?php
require __DIR__ . '/core/init.php';
require __DIR__ . '/customizer/options.php';

register_nav_menu( 'primary', 'Primary' );
register_sidebar(
	array(
		'id'   => 'sidebar-1',
		'name' => 'Sidebar',
	)
);
