import $ from 'jquery';
import { render } from '@wordpress/element';

export const defineControls = ( type, Component ) => {
	( wp.customize.controlConstructor[ type ] = wp.customize.Control.extend( {
		initialize( id, params ) {
			const control = this,
				args = params || {};

			args.params = args?.params || {};
			args.params.type = args.params?.type ? args.params.type : 'customind';

			wp.customize.Control.prototype.initialize.call( control, id, params );
			control.container[ 0 ].classList.remove( 'customize-control' );
			if ( ! args.params?.content ) {
				args.params.content = $( '<li></li>', {
					id: `customize-control-${ id.replace( /]/g, '' ).replace( /\[/g, '-' ) }`,
					class: `customize-control customize-control-${ args.params.type }`,
				} );
			}
			control.propertyElements = [];
			wp.customize.Control.prototype.initialize.call( control, id, args );
		},
		_setUpSettingRootLinks() {
			const control = this,
				nodes = control.container.find( '[data-customize-setting-link]' );

			$.each( nodes, function() {
				const node = $( this ),
					propName = node.data( 'customizeSettingLink' );
				wp.customize( propName, setting => {
					const el = new wp.customize.Element( node );
					control.element.push( el );
					el.sync( setting );
					el.set( setting() );
				} );
			} );
		},
		_setUpSettingPropertyLinks() {
			const control = this;
			if ( ! control?.setting ) return;
			const nodes = control.container.find( '[data-customize-setting-property-link]' );

			$.each( nodes, function() {
				const node = $( this ),
					propName = node.data( 'customizeSettingPropertyLink' ),
					el = new wp.customize.Element( node );
				control.element.push( el );
				el.set( control.setting()[ propName ] );
				el.bind( newPropValue => {
					let newSetting = control.setting();
					if ( newPropValue !== newSetting[ propName ] ) {
						newSetting = _.clone( newSetting );
						newSetting[ propName ] = newPropValue;
						control.setting.set( newSetting );
					}
				} );
				control.setting.bind( newValue => {
					if ( newValue[ propName ] !== el.get() ) {
						el.set( newValue[ propName ] );
					}
				} );
			} );
		},
		ready() {
			const control = this;
			control._setUpSettingRootLinks();
			control._setUpSettingPropertyLinks();
			wp.customize.Control.prototype.ready.call( control );
			control.deferred.embedded.done( () => {} );
		},
		embed() {
			const control = this,
				section = control.section();
			wp.customize.section( section, sec => {
				if ( sec.expanded() || wp.customize.settings.autofocus.control === control.id ) {
					control.actuallyEmbed();
				} else {
					sec.expanded.bind( expanded => {
						if ( expanded ) control.actuallyEmbed();
					} );
				}
			} );
		},
		actuallyEmbed() {
			const control = this;
			if ( 'resolved' === control.deferred.embedded.state() ) return;
			control.renderContent();
			control.deferred.embedded.resolve();
			control.container.trigger( 'init' );
		},
		focus( args ) {
			const control = this;
			control.actuallyEmbed();
			wp.customize.Control.prototype.focus.call( control, args );
		},
		renderContent() {
			const control = this;
			render(
				<Component { ...control } />,
				control.container[ 0 ]
			);
		},
	} ) );
};
