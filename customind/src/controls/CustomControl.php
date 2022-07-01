<?php
namespace Customind;

class CustomControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-custom';

	/**
	 * Info.
	 *
	 * @var string
	 */
	public $info = '';

	/**
	 * Links
	 *
	 * @var array
	 */
	public $links = array();


	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['info']  = $this->info;
		$this->json['links'] = $this->links;
	}
}
