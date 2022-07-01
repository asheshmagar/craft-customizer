import { memo } from '@wordpress/element';
import ReactHtmlParser from 'react-html-parser';
import { Button } from '@wordpress/components';

const Custom = ( props ) => {
	const {
		label,
		info,
		links,
	} = props.params;

	return (
		<div className="customize-control customize-control-customind-custom">
			{ label && (
				<div className="customind-control-head">
					<span className="customize-control-title">{ label }</span>
				</div>
			) }
			<div className="customind-control-body">
				{ info && (
					ReactHtmlParser( info )
				) }
				{ links && (
					<ul className="customind-links">
						{ links.map( ( l, idx ) => (
							<li className="customind-link" key={ idx }>
								<Button variant="primary" href={ l?.url || null }>
									{ l.text }
								</Button>
							</li>
						) ) }
					</ul>
				) }
			</div>
		</div>
	);
};

export default memo( Custom );
