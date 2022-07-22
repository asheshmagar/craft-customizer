import { memo, useState, useCallback, useEffect, useRef } from '@wordpress/element';
import { cloneDeep, isEqual } from 'lodash';
import BuilderArea from './builder-area';
import { Button } from '@wordpress/components';
import { usePortal } from '../hooks';

const Builder = ( props ) => {
	const [ value, setValue ] = useState( props.control.setting.get() || {} );
	const [ open, setOpen ] = useState( false );
	const {
		areas = {},
		section,
	} = props.control.params;
	const builderRef = useRef();
	const Portal = usePortal( document.getElementById( 'customize-controls' ) );

	const update = ( row, area, items ) => {
		const newValue = cloneDeep( value );
		newValue[ row ][ area ] = items;
		if ( ! isEqual( newValue, value ) ) {
			setValue( newValue );
			props.control.setting.set( newValue );
		}
	};

	const remove = ( row, area, item ) => {
		const newValue = cloneDeep( value );
		newValue[ row ][ area ] = ( newValue?.[ row ]?.[ area ] || [] ).filter( v => v !== item );
		if ( ! isEqual( newValue, value ) ) {
			setValue( newValue );
			props.control.setting.set( newValue );
		}
	};

	const getAreaItems = useCallback( ( row, area ) => value?.[ row ]?.[ area ] || [], [ value ] );

	useEffect( () => {
		const sec = props.customizer.section( section );
		if ( sec?.panel() ) {
			const panel = props.customizer.panel( sec.panel() );
			if ( panel ) {
				panel.expanded.bind( isExpanded => {
					setOpen( isExpanded );
				} );
			}
		}
		setOpen( true );
	}, [] );

	useEffect( () => {
		const resizePreviewer = () => {
			if ( ! builderRef.current ) return;
			const height = builderRef.current?.offsetHeight || '';
			if ( open ) {
				props.customizer.previewer.container.css( 'max-height', `calc(100vh - ${ height }px)` );
				props.customizer.previewer.container.css( {
					maxHeight: `calc(100vh - ${ height }px)`,
					marginTop: 0,
				} );
			} else {
				props.customizer.previewer.container.css( {
					maxHeight: '100vh',
					marginTop: '0',
				} );
			}
		};
		resizePreviewer();
		window.addEventListener( 'resize', resizePreviewer );
		return () => {
			window.removeEventListener( 'resize', resizePreviewer );
		};
	}, [ open ] );

	return (
		<div className="customind-control customind-builder-control">
			<Portal>
				<div data-control={ props.control.id } className={ `customind-builder${ open ? ' open' : '' }` }>
					<div ref={ builderRef } className="customind-builder-rows-wrap">
						<div className="customind-builder-rows">
							{ Object.keys( areas ).map( row => (
								<div key={ row } className={ `customind-builder-row customind-builder-row-${ row }` }>
									<Button className="customind-builder-row-action" icon="admin-generic" />
									<div className="customind-builder-areas">
										{ Object.keys( areas?.[ row ] || {} ).map( ( area ) => {
											return (
												<BuilderArea
													key={ area }
													className={ `customind-builder-area customind-builder-area-${ area }` }
													remove={ ( item ) => remove( row, area, item ) }
													areaItems={ getAreaItems( row, area ) }
													value={ value }
													update={ ( val ) => update( row, area, val ) }
													{ ...props }
												/>
											);
										} ) }
									</div>
								</div>
							) ) }
						</div>
					</div>
				</div>
			</Portal>
		</div>
	);
};

export default memo( Builder );
