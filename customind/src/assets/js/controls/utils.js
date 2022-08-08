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
		ready() {
			const control = this;
			wp.customize.Control.prototype.ready.call( control );
			control.deferred.embedded.done();
		},
		embed() {
			const control = this,
				section = control.section();

			if ( ! section ) return;

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
				<Component control={ control } customizer={ wp.customize } />,
				control.container[ 0 ]
			);
		},
	} ) );
};
export const getObjectValues = ( object ) => object && 'object' === typeof object ? Object.values( object ).map( getObjectValues ).flat() : [ object ];

export default function timeAgo( input ) {
	const date = new Date( input );
	const formatter = new Intl.RelativeTimeFormat( 'en' );

	const years = 3600 * 24 * 365;
	const months = 3600 * 24 * 30;
	const weeks = 3600 * 24 * 7;
	const days = 3600 * 24;
	const hours = 3600;
	const minutes = 60;
	const seconds = 1;

	const secondsElapsed = ( date.getTime() - Date.now() ) / 1000;
	if ( years < Math.abs( secondsElapsed ) ) {
		const delta = secondsElapsed / years;
		return formatter.format( Math.round( delta ), 'years' );
	} else if ( months < Math.abs( secondsElapsed ) ) {
		const delta = secondsElapsed / months;
		return formatter.format( Math.round( delta ), 'months' );
	}
	if ( weeks < Math.abs( secondsElapsed ) ) {
		const delta = secondsElapsed / weeks;
		return formatter.format( Math.round( delta ), 'weeks' );
	}
	if ( days < Math.abs( secondsElapsed ) ) {
		const delta = secondsElapsed / days;
		return formatter.format( Math.round( delta ), 'days' );
	}
	if ( hours < Math.abs( secondsElapsed ) ) {
		const delta = secondsElapsed / hours;
		return formatter.format( Math.round( delta ), 'hours' );
	}
	if ( minutes < Math.abs( secondsElapsed ) ) {
		const delta = secondsElapsed / minutes;
		return formatter.format( Math.round( delta ), 'minutes' );
	}
	const delta = secondsElapsed / seconds;
	return formatter.format( Math.round( delta ), 'seconds' );
}
