<?php
namespace Customind;

class SortableControl extends BaseControl {

	/**
	 * Controls type.
	 *
	 * @var string
	 */
	public $type = 'customind-sortable';

	public $unsortable = array();

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @return void
	 */
	public function to_json() {
		parent::to_json();
		$choices                  = $this->choices;
		$this->json['choices']    = array_reduce(
			array_keys( $this->choices ),
			function( $acc, $curr ) use ( $choices ) {
				if ( ! in_array( $curr, $this->unsortable, true ) ) {
					$acc[ $curr ] = $choices[ $curr ];
				}
				return $acc;
			},
			array()
		);
		$this->json['unsortable'] = array_reduce(
			$this->unsortable,
			function( $acc, $curr ) use ( $choices ) {
				if ( in_array( $curr, $this->unsortable, true ) ) {
					$acc[ $curr ] = $choices[ $curr ];
				}
				return $acc;
			},
			array()
		);
	}

	private function isAssoc( $array ) {
		if ( array() === $array ) {
			return false;
		}
		return array_keys( $array ) !== range( 0, count( $array ) - 1 );
	}
}
