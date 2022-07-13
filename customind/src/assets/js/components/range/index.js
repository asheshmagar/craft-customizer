import { SelectControl, RangeControl } from '@wordpress/components';
import { memo, useCallback } from '@wordpress/element';
import './controls.scss';

const CustomindRange = ( props ) => {
	const {
		value,
		units = [],
		onChange,
		...otherProps
	} = props;

	const update = useCallback( ( val, type = 'value' ) => {
		const newValue = { ...value, [ type ]: val };
		onChange( newValue );
	}, [ value ] );

	return (
		<div className="customind-range">
			<RangeControl
				value={ value?.value || '' }
				onChange={ val => update( val ) }
				{ ...otherProps }
			/>
			{ 0 < units?.length && (
				<SelectControl
					onChange={ val => update( '-' === val ? '' : val, 'unit' ) }
					options={ units.map( u => ( { label: u, name: u } ) ) }
					value={ value?.unit || 'px' }
				/>
			) }
		</div>
	);
};

export default memo( CustomindRange );
