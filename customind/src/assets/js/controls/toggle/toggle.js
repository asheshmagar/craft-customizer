import { ToggleControl } from '@wordpress/components';
import { useState, memo } from '@wordpress/element';
import { Tooltip } from '../../components';

const Toggle = ( props ) => {
	const [ value, setValue ] = useState( props.setting.get() );
	const {
		label,
		description,
	} = props.params;
	return (
		<div className="customize-control customind-toggle-control">
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
			<ToggleControl
				checked={ !! value }
				onChange={ () => {
					setValue( ! value );
					props.setting.set( ! value );
				} }
			/>
		</div>
	);
};

export default memo( Toggle );
