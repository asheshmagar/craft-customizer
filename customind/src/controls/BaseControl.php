<?php
/**
 * Customind base control class.
 */

namespace Customind\Control;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class BaseControl.
 */
class BaseControl extends \WP_Customize_Control {

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['default']     = isset( $this->default ) ? $this->default : $this->setting->default;
		$this->json['value']       = $this->value();
		$this->json['link']        = $this->get_link();
		$this->json['id']          = $this->id;
		$this->json['label']       = esc_html( $this->label );
		$this->json['description'] = $this->description;
		$this->json['inputAttrs']  = $this->input_attrs;
	}

	/**
	 * Render the control's content.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	public function render_content() {}
}
