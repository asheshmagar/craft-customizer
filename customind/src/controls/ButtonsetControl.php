<?php
namespace Customind\Control;

class ButtonsetControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-buttonset';

	public $multiple = false;

	public $responsive = false;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices']    = $this->choices;
		$this->json['multiple']   = $this->multiple;
		$this->json['responsive'] = $this->responsive;
	}
}
