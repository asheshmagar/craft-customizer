<?php
namespace Customind\Control;

class RadioImageControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-radio-image';

	/**
	 * Image col.
	 *
	 * @var integer
	 */
	public $image_col = 1;

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['col']     = $this->image_col;
		$this->json['choices'] = $this->choices;
	}
}
