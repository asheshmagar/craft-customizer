import { memo, useState } from '@wordpress/element';
import { SelectControl } from '@wordpress/components';
import { Tooltip } from '../../components';

const DropdownCategories = ( props ) => {
	const [ value, setValue ] = useState( props.control.setting.get() );
	const {
		label,
		description,
		dropdown = {},
	} = props.control.params;

	const options = Object.entries( dropdown || {} )?.map( ( [ id, name ] ) => (
		{ label: name, value: id }
	) ) || [];

	return (
		<div className="customize-control customize-control-customind-dropdown-categories">
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
				</div>
			) }
			<div className="customind-control-body">
				{ !! options.length && (
					<SelectControl value={ options.find( o => o.id === value )?.value || '' } onChange={ val => setValue( val ) } options={ options } />
				) }
			</div>
		</div>
	);
};

export default memo( DropdownCategories );
