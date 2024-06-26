import { useEffect, useState, useRef } from '@wordpress/element';
import { Popover, Icon } from '@wordpress/components';
import PropTypes from 'prop-types';
import './controls.scss';

const Tooltip = ( { children, position = 'bottom center', width = 150, trigger = 'hover', ...props } ) => {
	const [ isOpen, setIsOpen ] = useState( false );
	const ref = useRef();

	useEffect( () => {
		const el = ref.current;
		if ( ! el ) return;
		if ( 'hover' === trigger ) {
			el?.addEventListener( 'mouseenter', () => setIsOpen( true ) );
			el?.addEventListener( 'mouseleave', () => setIsOpen( false ) );
		} else if ( 'click' === trigger ) {
			el?.addEventListener( 'click', () => setIsOpen( ! isOpen ) );
		}
		return () => {
			if ( 'hover' === trigger ) {
				el?.removeEventListener( 'mouseenter', () => setIsOpen( true ) );
				el?.removeEventListener( 'mouseleave', () => setIsOpen( false ) );
			} else if ( 'click' === trigger ) {
				el?.addEventListener( 'click', () => setIsOpen( ! isOpen ) );
			}
		};
	}, [] );

	return (
		<span ref={ ref } { ...props } className="customind-tooltip" >
			<Icon icon="info-outline" />
			{ isOpen && (
				<Popover
					focusOnMount={ false }
					className="customind-tooltip"
					position={ position }
					onClose={ () => setIsOpen( false ) }
					onFocusOutside={ () => setIsOpen( false ) }
					noArrow={ false }
				>
					<div style={ { minWidth: width + 'px', width: width + 'px', textAlign: 'center' } } className="tgwcfb-tooltip-content">
						{ children }
					</div>
				</Popover>
			) }
		</span>
	);
};

Tooltip.propTypes = {
	children: PropTypes.oneOfType( [
		PropTypes.arrayOf( PropTypes.node ),
		PropTypes.node,
	] ).isRequired,
	position: PropTypes.string,
	width: PropTypes.number,
	trigger: PropTypes.oneOf( [ 'click', 'hover' ] ),
};

export default Tooltip;
