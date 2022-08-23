import { useState, useMemo, useEffect, useCallback, createPortal, unmountComponentAtNode } from '@wordpress/element';
import { Button } from '@wordpress/components';

export const useDeviceSelector = () => {
	const [ device, setDevice ] = useState( wp?.customize?.previewedDevice() || 'desktop' );

	const listener = () => {
		setDevice( wp?.customize?.previewedDevice() || 'desktop' );
	};

	useEffect( () => {
		if ( ! wp.customize ) return;
		setTimeout( () => wp.customize.previewedDevice.bind( listener ), 1000 );

		return () => {
			if ( ! wp.customize ) return;
			wp.customize.previewedDevice.unbind( listener );
		};
	}, [] );

	const DeviceSelector = useMemo( () => {
		return ( props ) => (
			<div className="customind-device-selector" { ...props }>
				{ [ 'desktop', 'tablet', 'mobile' ].map( d => (
					<Button
						key={ d }
						className={ `${ d }${ device === d ? ' active' : '' }` }
						onClick={ ( e ) => {
							e.stopPropagation();
							setDevice( d );
							wp?.customize?.previewedDevice?.set( d );
						} }
						icon={ 'mobile' === d ? 'smartphone' : d }
					/>
				) ) }
			</div>
		);
	}, [ device ] );

	return {
		device,
		setDevice( d ) {
			setDevice( d );
			wp?.customize?.previewedDevice?.set( d );
		},
		DeviceSelector,
	};
};

export const usePortal = ( element ) => {
	const [ portal, setPortal ] = useState( {
		render: () => null,
		remove: () => null,
	} );

	const makePortal = useCallback( ( el ) => {
		const Portal = ( { children } ) => createPortal( children, el );
		const remove = () => unmountComponentAtNode( el );
		return {
			render: Portal,
			remove,
		};
	}, [] );

	useEffect( () => {
		if ( element ) portal.remove();
		const newPortal = makePortal( element );
		setPortal( newPortal );
		return () => {
			newPortal.remove( element );
		};
	}, [ element ] );

	return portal.render;
};
