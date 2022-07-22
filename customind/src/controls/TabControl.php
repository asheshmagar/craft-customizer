<?php
namespace Customind\Control;

class TabControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-tab';

	public $active_tab = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['choices']   = $this->choices;
		$this->json['activeTab'] = $this->active_tab;
	}
}
