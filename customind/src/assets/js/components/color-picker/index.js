import { Button, ColorIndicator, ColorPicker, Popover } from '@wordpress/components';
import { useState, memo } from '@wordpress/element';
import './controls.scss';

const CustomindColorPicker = ( props ) => {
	const {
		value = '',
		onChange = () => {},
	} = props;
	const [ isOpen, setIsOpen ] = useState( false );

	return (
		<div className="customind-color-picker">
			<Button onClick={ () => setIsOpen( ! isOpen ) }>
				<ColorIndicator colorValue={ value } />
				<span>Select color</span>
			</Button>
			{ isOpen && (
				<Popover
					className="customind-color"
					position="bottom center"
					onClose={ () => setIsOpen( false ) }
					onFocusOutside={ () => setIsOpen( false ) }
				>
					<ColorPicker
						color={ value }
						onChangeComplete={ val => {
							const { hex, rgb } = val;
							let newColor = hex;
							if ( rgb.a !== 1 ) {
								newColor = `rgba(${ rgb.r },${ rgb.g },${ rgb.b },${ rgb.a })`;
							}
							onChange( newColor );
						} }
						enableAlpha
						copyFormat={ [ 'hex' ] }
					/>
				</Popover>
			) }
		</div>
	);
};

export default memo( CustomindColorPicker );
