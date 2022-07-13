import { memo } from '@wordpress/element';
import { Button, Dashicon } from '@wordpress/components';
import { Tooltip } from '../../components';

const Navigate = ( props ) => {
	const {
		navigate_info: { target_id: targetId, target_label: targetLabel },
		label,
		description,
	} = props.control.params;

	if ( ! targetLabel || ! targetId ) {
		return null;
	}

	return (
		<div className="customize-control customize-control-customind-navigate">
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
				<Button onClick={ () => props.customizer?.section( targetId ) && props.customizer.section( targetId ).focus() }>
					<span>{ targetLabel }</span>
					<Dashicon icon="arrow-right-alt2" />
				</Button>
			</div>
		</div>
	);
};

export default memo( Navigate );
