import { memo, useState } from '@wordpress/element';
import { ButtonGroup, Button } from '@wordpress/components';
import { Tooltip } from '../../components';

const ButtonSet = ( props ) => {
	const [ value, setValue ] = useState( props.control.setting.get() );

	const {
		label,
		description,
		choices = {},
	} = props.control.params;

	return (
		<div className="customind-control customind-button-set-control">
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
			{ Object.keys( choices )?.length && (
				<ButtonGroup>
					{ Object.entries( choices ).map( ( [ key, val ] ) => (
						<Button
							key={ key }
							onClick={ () => {
								setValue( key );
								props.control.setting.set( key );
							} }
							variant={ key === value ? 'primary' : 'secondary' }
							className={ key }
						>
							{ val }
						</Button>
					) ) }
				</ButtonGroup>
			) }
		</div>
	);
};

export default memo( ButtonSet );
