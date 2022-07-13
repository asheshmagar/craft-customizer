<?php
namespace Customind\Control;

class TypographyControl extends BaseControl {

	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'customind-typography';

	public $google_fonts = array();

	public $font_size_units = array();

	public $line_height_units = array();

	public $letter_spacing_units = array();

	public function to_json() {
		parent::to_json();
		$this->json['googleFonts']        = $this->get_google_fonts();
		$this->json['sizeUnits']          = $this->font_size_units;
		$this->json['lineHeightUnits']    = array_merge( array( '-' ), $this->line_height_units );
		$this->json['letterSpacingUnits'] = $this->letter_spacing_units;
	}

	private function get_google_fonts() {
		ob_start();
		include_once __DIR__ . '/google-fonts.json';
		return json_decode( ob_get_clean(), true );
	}
}
