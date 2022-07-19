<?php
namespace Customind\Control;

class DimensionsControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-dimensions';

	public $responsive = false;

	public $units = array();

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices']    = $this->choices;
		$this->json['responsive'] = $this->responsive;
		$this->json['units']      = $this->units;
	}
}
