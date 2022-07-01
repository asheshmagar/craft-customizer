import { memo, useState } from '@wordpress/element';
import { Tooltip, CustomindColorPicker } from '../../components';

const Color = ( props ) => {
	const [ value, setValue ] = useState( props.setting.get() );
	const {
		label,
		description,
	} = props.params;

	return (
		<div className="customize-control customize-control-customind-color">
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
			<div className="customind-control-body">
				<CustomindColorPicker value={ value } onChange={ ( color ) => {
					setValue( color );
					props.setting.set( color );
				} } />
			</div>
		</div>
	);
};

export default memo( Color );
