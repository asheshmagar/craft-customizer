import { memo, useEffect, useState, useRef } from '@wordpress/element';
import { GradientPicker, ColorIndicator, Button } from '@wordpress/components';
import { Tooltip } from '../../components';

const Gradient = ( props ) => {
	const [ value, setValue ] = useState( props.control.setting.get() );
	const [ isOpen, setIsOpen ] = useState( false );
	const {
		label,
		description,
	} = props.control.params;
	const popover = useRef();
	const trigger = useRef();

	useEffect( () => {
		const wrapper = document.querySelector( '.wp-full-overlay-sidebar-content' );
		if ( ! popover.current || ! trigger.current || ! wrapper ) return;
		const listener = ( e ) => {
			if ( ! popover.current?.contains( e.target ) && ! trigger.current?.contains( e.target ) ) {
				setIsOpen( false );
			}
		};
		wrapper.addEventListener( 'click', listener );
		return () => {
			wrapper.removeEventListener( 'click', listener );
		};
	}, [] );

	return (
		<>
			<div className="customind-control customind-gradient-control">
				{ label && (
					<div className="customind-control-head">
						<span className="customize-control-title">{ label }</span>
						{ description && (
							<Tooltip>1
								<span className="customize-control-description">{ description }</span>
							</Tooltip>
						) }
					</div>
				) }
				<Button ref={ trigger } onClick={ () => setIsOpen( ! isOpen ) }>
					<ColorIndicator colorValue={ value } />
					<span>Select color</span>
				</Button>
			</div>
			<div className="customind-gradient-popover-wrap">
				<div ref={ popover } className={ `customind-gradient-popover${ isOpen ? ' open' : '' }` }>
					{ isOpen && (
						<GradientPicker className="customind-gradient-picker" value={ value } onChange={ val => {
							setValue( val );
							props.control.setting.set( val );
						} } />
					) }
				</div>
			</div>
		</>
	);
};

export default memo( Gradient );
