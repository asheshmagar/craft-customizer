import { memo, useState } from '@wordpress/element';
import { Tooltip } from '../../components';

const RadioImage = ( props ) => {
	const [ value, setValue ] = useState( props.control.setting.get() || '' );

	const {
		label,
		description,
		choices,
		col = 2,
	} = props.control.params;

	const update = ( val ) => {
		setValue( val );
		props.control.setting.set( val );
	};

	return (
		<div className="customize-control customize-control-customind-sortable">
			{ label && (
				<div className="customind-control-head">
					<span className="customize-control-title">{ label }</span>
					{ description && (
						<Tooltip>
							<span className="customize-control-description">{ description }</span>
						</Tooltip>
					) }
				</div>
			) }
			<div className="customind-control-body" style={ { '--customind-col': col } }>
				{ Object.entries( choices ).map( ( [ k, v ] ) => (
					<div role="button" tabIndex={ 0 } onClick={ () => update( k ) } onKeyDown={ e => {
						if ( e.code === 'Enter' ) {
							update( k );
						}
					} } key={ k } data-id={ k } className={ `customind-radio-image${ value === k ? ' active' : '' }` } data-label={ v?.label || null }>
						{ v?.url && (
							<img style={ { width: '100%' } } src={ v.url } alt={ v?.label || k } />
						) }
					</div>
				) ) }
			</div>
		</div>
	);
};

export default memo( RadioImage );
