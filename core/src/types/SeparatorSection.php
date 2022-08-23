<?php
/**
 * SeparatorSection class.
 */

namespace Customind\Types;

defined( 'ABSPATH' ) || exit;

use WP_Customize_Section;

/**
 * SeparatorSection class.
 */
class SeparatorSection extends WP_Customize_Section {

	/**
	 * @var string $type.
	 */
	public $type = 'customind-separator';

	/**
	 * Render.
	 *
	 * @return void
	 */
	public function render_template() {}
}
