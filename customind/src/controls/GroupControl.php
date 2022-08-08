<?php
namespace Customind\Controls;

use function customind;

class GroupControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-group';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$config    = array();
		$framework = customind();
		$id        = $this->id;

		if ( isset( $framework->group_configs[ $id ]['tabs'] ) ) {
			$tabs = array_keys( $framework->group_configs[ $id ]['tabs'] );
			foreach ( $tabs as $tab ) {
				$config['tabs'][ $tab ] = wp_list_sort( $framework->group_configs[ $id ]['tabs'][ $tab ], 'priority' );
			}
		} else {
			if ( isset( $framework->group_configs[ $id ] ) ) {
				$config = wp_list_sort( $framework->group_configs[ $id ], 'priority' );
			}
		}

		$this->input_attrs['fields'] = $config;
		$this->json['inputAttrs']    = $this->input_attrs;
	}
}
