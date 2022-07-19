import { memo } from '@wordpress/element';

const Hidden = ( props ) => {
	const value = props.control.setting.get();
	let name = props.control.params.settings.default;
	name = name.replace( '[', '-' );
	name = name.replace( ']', '' );
	const cssClass = `hidden-field-${ name }`;

	return (
		<input type="hidden" className={ cssClass } data-name={ name } value={ JSON.stringify( value ) } />
	);
};

export default memo( Hidden );
