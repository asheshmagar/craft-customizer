<?php
namespace Customind;

class NavigateControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-navigate';

	/**
	 * Control's nav info.
	 *
	 * @var string
	 */
	public $navigate_info = array();

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['navigate_info'] = $this->navigate_info;
	}
}
