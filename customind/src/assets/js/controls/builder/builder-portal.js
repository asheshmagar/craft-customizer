import { createPortal } from '@wordpress/element';

export default ( { children } ) => createPortal( children, document.getElementById( 'customize-controls' ) );
