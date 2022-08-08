<?php
namespace Customind\Types;

use WP_Customize_Section;

class UpsellSection extends WP_Customize_Section {

	public $type = 'customind-upsell-section';

	public $url = '';

	public $id = '';

	public function json() {
		$json        = parent::json();
		$json['url'] = esc_url( $this->url );
		$json['id']  = $this->id;
		return $json;
	}

	public function render_template() {}
}
