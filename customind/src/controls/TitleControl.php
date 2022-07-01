<?php
namespace Customind;

class TitleControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-title';

	/**
	 * Link.
	 *
	 * @var string
	 */
	public $link = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['link'] = esc_url( $this->link );
	}
}
