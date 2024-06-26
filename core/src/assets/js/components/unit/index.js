import { Dropdown, Button, ButtonGroup } from '@wordpress/components';
import { memo } from '@wordpress/element';

const UnitPicker = ( props ) => {
	const { value, onChange, units = [] } = props;
	return (
		<Dropdown
			className="customind-units"
			position="bottom center"
			renderToggle={ ( { isOpen, onToggle } ) => (
				<Button onClick={ onToggle } aria-expanded={ isOpen }>
					{ value }
				</Button>
			) }
			renderContent={ ( { onToggle } ) => (
				<ButtonGroup>
					{ units.map( u => (
						<Button
							className={ value === u ? 'is-primary' : '' }
							key={ u }
							onClick={ ( e ) => {
								e.stopPropagation();
								onToggle();
								onChange( u );
							} }
						>
							{ '' === u ? '-' : u }
						</Button>
					) ) }
				</ButtonGroup>
			) }
		/>
	);
};

export default memo( UnitPicker );
