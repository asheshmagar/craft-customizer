<?php
namespace Customind\Control;

use Customind\Customind;

class GroupControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-group';

	/**
	 * Control's name.
	 *
	 * @var string
	 */
	public $name = '';

	/**
	 * Control's tag.
	 *
	 * @var string
	 */
	public $tab = '';

	/**
	 * Control's fields.
	 *
	 * @var string
	 */
	public $fields = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$this->json['name'] = $this->name;
		$config             = array();
		$framework          = Customind::get_instance();

		if ( isset( $framework->group_configs[ $this->name ]['tabs'] ) ) {
			$tabs = array_keys( $framework->group_configs[ $this->name ]['tabs'] );
			foreach ( $tabs as $tab ) {
				$config['tabs'][ $tab ] = wp_list_sort( $framework->group_configs[ $this->name ]['tabs'][ $tab ], 'priority' );
			}
		} else {
			if ( isset( $framework->group_configs[ $this->name ] ) ) {
				$config = wp_list_sort( $framework->group_configs[ $this->name ], 'priority' );
			}
		}

		$this->json['fields'] = $config;
	}
}
