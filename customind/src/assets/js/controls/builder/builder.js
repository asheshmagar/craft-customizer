import { memo, useState, useCallback, useEffect } from '@wordpress/element';
import { cloneDeep, isEqual } from 'lodash';
import BuilderPortal from './builder-portal';
import BuilderArea from './builder-area';

const Builder = ( props ) => {
	const [ value, setValue ] = useState( props.control.setting.get() || {} );
	const [ open, setOpen ] = useState( false );
	const {
		areas = {},
		section,
	} = props.control.params;

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
					setOpen( !! isExpanded );
				} );
			}
		}
		setOpen( true );
	}, [] );

	return (
		<div className="customize-control customize-control-customind-builder">
			<BuilderPortal>
				<div className={ `customind-builder-wrap${ open ? ' open' : '' }` }>
					<div className="customind-builder">
						{ Object.keys( areas ).map( row => (
							<div key={ row } className={ `customind-builder-areas customind-builder-areas-${ row }` }>
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
						) ) }
					</div>
				</div>
			</BuilderPortal>
		</div>
	);
};

export default memo( Builder );
