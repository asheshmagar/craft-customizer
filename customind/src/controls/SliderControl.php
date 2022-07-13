<?php
namespace Customind\Control;

class SliderControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-slider';

	/**
	 * Suffix.
	 *
	 * @var string
	 */
	public $suffix = '';

	/**
	 * Responsive.
	 *
	 * @var boolean
	 */
	public $responsive = false;

	/**
	 * Units.
	 *
	 * @var array
	 */
	public $units = array();

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['suffix']     = $this->suffix;
		$this->json['responsive'] = $this->responsive;
		$this->json['units']      = $this->units;
	}
}
