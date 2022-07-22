import { memo, useState } from '@wordpress/element';
import { useDeviceSelector } from '../hooks';
import { Tooltip } from '../../components';
import { TextControl, Dropdown, Button, ButtonGroup } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const Dimensions = ( props ) => {
	const [ value, setValue ] = useState( props.control.setting.get() || {} );
	const [ sync, setSync ] = useState( true );
	const { device, DeviceSelector } = useDeviceSelector();
	const {
		label,
		description,
		units,
		responsive = false,
	} = props.control.params;

	const update = ( val, type ) => {
		let newVal = { ...value };

		if ( 'unit' !== type ) {
			if ( responsive ) {
				newVal = { ...newVal, [ device ]: sync ? { ...( newVal?.[ device ] ), top: val, right: val, bottom: val, left: val } : { ...( newVal?.[ device ] ), [ type ]: val } };
			} else {
				newVal = sync ? { ...newVal, top: val, right: val, bottom: val, left: val } : { ...newVal, [ type ]: val };
			}
		} else {
			if ( responsive ) { // eslint-disable-line no-lonely-if
				newVal = { ...newVal, [ device ]: { ...( newVal?.[ device ] || {} ), unit: val } };
			} else {
				newVal = { ...newVal, unit: val };
			}
		}
		setValue( newVal );
		props.control.setting.set( newVal );
	};

	return (
		<div className="customind-control customind-dimensions-control">
			{ label && (
				<div className="customind-control-head">
					<span className="customize-control-title">{ label }</span>
					{
						description && (
							<Tooltip>
								<span className="customize-control-description">{ description }</span>
							</Tooltip>
						)
					}
					{ responsive && <DeviceSelector /> }
				</div>
			) }
			<div className="customind-control-body">
				<ul>
					{ [
						{ key: 'top', value: __( 'Top' ) },
						{ key: 'right', value: __( 'Right' ) },
						{ key: 'bottom', value: __( 'Bottom' ) },
						{ key: 'left', value: __( 'Left' ) },
					].map( pos => (
						<li key={ pos.key }><TextControl type="number" label={ pos.value } onChange={ val => update( val, pos.key ) } value={ responsive ? ( value?.[ device ]?.[ pos.key ] || '' ) : ( value?.[ pos.key ] || '' ) } /></li>
					) ) }
					<li>
						<Button onClick={ () => setSync( ! sync ) } icon={ sync ? 'admin-links' : 'editor-unlink' } />
						{ units?.length > 0 && (
							<Dropdown
								className="customind-dimensions-units"
								position="bottom center"
								renderToggle={ ( { isOpen, onToggle } ) => (
									<Button onClick={ onToggle } aria-expanded={ isOpen }>
										{ responsive ? ( value?.[ device ]?.unit ?? 'px' ) || '-' : ( value?.unit ?? 'px' ) || '-' }
									</Button>
								) }
								renderContent={ ( { onToggle } ) => (
									<ButtonGroup>
										{ units.map( u => (
											<Button
												className={ ( responsive ? ( value?.[ device ]?.unit ?? 'px' ) : ( value?.unit ?? 'px' ) ) === u ? 'is-primary' : '' }
												key={ u }
												onClick={ ( e ) => {
													e.stopPropagation();
													update( u, 'unit' );
													onToggle();
												} }
											>
												{ '' === u ? '-' : u }
											</Button>
										) ) }
									</ButtonGroup>
								) }
							/>
						) }
					</li>
				</ul>
			</div>
		</div>
	);
};

export default memo( Dimensions );
