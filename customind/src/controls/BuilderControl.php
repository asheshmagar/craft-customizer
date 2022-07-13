<?php
namespace Customind\Control;

class BuilderControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-builder';

	public $areas = array();

	public function to_json() {
		parent::to_json();
		$this->json['areas']   = $this->areas;
		$this->json['choices'] = $this->choices;
	}
}
