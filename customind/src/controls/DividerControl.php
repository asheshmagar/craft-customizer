<?php
namespace Customind\Control;

class DividerControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-divider';

	/**
	 * Placement.
	 *
	 * @var string
	 */
	public $placement = 'above';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['placement'] = $this->placement;
	}
}
