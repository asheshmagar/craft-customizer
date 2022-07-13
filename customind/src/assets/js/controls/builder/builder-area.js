import { memo, useMemo, useState } from '@wordpress/element';
import { ReactSortable } from 'react-sortablejs';
import { Button, Popover, ButtonGroup } from '@wordpress/components';
import { getObjectValues } from '../utils';

const BuilderArea = ( props ) => {
	const [ isOpen, setIsOpen ] = useState( false );
	const {
		areaItems = [],
		value = {},
		update,
		control: {
			params: {
				choices,
			},
		},
		remove,
	} = props;

	const sortableList = useMemo( () => areaItems.map( v => ( { id: v } ) ), [ areaItems ] );

	const currentAvailableItems = useMemo( () => {
		const savedItems = getObjectValues( value ) || [];
		return Object.keys( choices ).filter( i => -1 === savedItems.indexOf( i ) );
	}, [ value ] );

	return (
		<div className="customind-builder-area-wrap">
			<ReactSortable
				ghostClass="customind-builder-item-placeholder"
				chosenClass="customind-builder-item-chosen"
				dragClass="customind-builder-item-dragging"
				group={ `customind-builder-group-${ props.control.id }` }
				className={ props.className }
				tag={ 'div' }
				list={ sortableList }
				setList={ list => {
					let newList = [];
					if ( list?.length > 0 ) {
						newList = list.map( li => li.id );
					}
					update( newList );
				} }
			>
				{ sortableList.map( li => (
					<div className="customind-builder-item" key={ li.id }>
						<span className="customind-builder-item-handle">
							<svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" aria-hidden="true" focusable="false">
								<path d="M5 4h2V2H5v2zm6-2v2h2V2h-2zm-6 8h2V8H5v2zm6 0h2V8h-2v2zm-6 6h2v-2H5v2zm6 0h2v-2h-2v2z" />
							</svg>
						</span>
						<span className="customind-builder-item-title">
							{ choices?.[ li.id ]?.name || '' }
						</span>
						 <Button icon="no-alt" onClick={ () => remove( li.id ) } />
					</div>
				) ) }
			</ReactSortable>
			<Button icon="plus" onClick={ () => setIsOpen( open => ! open ) } />
			{ isOpen && (
				<Popover placement="top center" className="customind-builder-popover" onClose={ () => setIsOpen( false ) } onFocusOutside={ () => setIsOpen( false ) }>
					<div className="customind-builder-popover-available-items">
						{ currentAvailableItems?.length > 0 ? (
							<ButtonGroup>
								{ currentAvailableItems.map( item => (
									<Button key={ item } onClick={ () => {
										update( [ ...areaItems, item ] );
										setIsOpen( false );
									} }>
										{ choices?.[ item ]?.name || '' }
									</Button>
								) ) }
							</ButtonGroup>
						) : (
							<p>No components</p>
						) }
					</div>
				</Popover>
			) }
		</div>

	);
};

export default memo( BuilderArea );