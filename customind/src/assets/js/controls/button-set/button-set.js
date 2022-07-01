import { memo, useState } from '@wordpress/element';
import { ButtonGroup, Button } from '@wordpress/components';
import { Tooltip } from '../../components';

const ButtonSet = ( props ) => {
	const [ value, setValue ] = useState( props.setting.get() );

	const {
		label,
		description,
		choices = {},
	} = props.params;

	return (
		<div className="customind-control customind-editor-control">
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
								props.setting.set( key );
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
