import { useEffect, useState, memo } from '@wordpress/element';
import { Tooltip } from '../../components';
import { debounce } from 'lodash';

const Editor = ( props ) => {
	const [ value, setValue ] = useState( '' );

	const {
		label,
		description,
	} = props.params;

	useEffect( () => {
		setValue( props.setting.get() );
		const initialize = () => {
			wp.editor.initialize( ( props?.id || 'customind_editor' ), {
				quicktags: true,
				tinymce: {
					wpautop: true,
					toolbar1: 'bold italic bullist numlist link',
					toolbar2: '',
					height: 150,
					mediaButtons: true,
					setup: editor => {
						editor.on( 'Paste Change input Undo Redo', debounce( () => {
							const content = editor.getContent();
							update( content );
						}, 250 ) );
					},
				},
			} );
		};

		if ( document.readyState === 'complete' ) {
			initialize();
		} else {
			document.addEventListener( 'DOMContentLoaded', initialize );
		}
		return () => {
			document.removeEventListener(
				'DOMContentLoaded',
				initialize
			);
			wp.editor.remove( ( props?.id || 'customind_editor' ) );
		};
	}, [] );

	const update = ( val ) => {
		setValue( val );
		props.setting.set( val );
	};

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
			<textarea
				className="wp-editor-area"
				id={ props?.id || 'customind_editor' }
				value={ value }
				onChange={ e => {
					update( e.target.value );
				} }
			/>
		</div>
	);
};

export default memo( Editor );
