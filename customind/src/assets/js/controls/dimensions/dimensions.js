import { memo, useState } from '@wordpress/element';
import { useDeviceSelector } from '../hooks';
import { Tooltip } from '../../components';
import { TextControl, Dashicon } from '@wordpress/components';

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
		<div className="customize-control customize-control-customind-dimension">
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
				{ units && (
					<div className="customind-units">
						{ units.map( u => (
							<span key={ u } role="button" tabIndex={ 0 } onKeyDown={ e => e.code === 'Enter' && update( u, 'unit' ) } onClick={ () => update( u, 'unit' ) } className={ u }>{ u }</span>
						) ) }
					</div>
				) }
				<ul>
					{ [ 'top', 'right', 'bottom', 'left' ].map( pos => (
						<li key={ pos }><TextControl type="number" onChange={ val => update( val, pos ) } value={ responsive ? ( value?.[ device ]?.[ pos ] || '' ) : ( value?.[ pos ] || '' ) } /></li>
					) ) }
					{ /* eslint-disable-next-line jsx-a11y/no-noninteractive-element-to-interactive-role */ }
					<li tabIndex={ 0 } role="button" onKeyDown={ e => e.code === 'Enter' && setSync( ! sync ) } onClick={ () => setSync( ! sync ) }>
						<Dashicon icon={ sync ? 'admin-links' : 'editor-unlink' } />
					</li>
				</ul>
			</div>
		</div>
	);
};

export default memo( Dimensions );
