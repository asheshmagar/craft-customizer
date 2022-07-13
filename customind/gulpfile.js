const request = require( 'request' );
const fs = require( 'fs' );
const gulp = require( 'gulp' );

gulp.task( 'fetch:google-fonts', () => {
	return request( 'https://google-webfonts-helper.herokuapp.com/api/fonts', ( error, response, body ) => {
		if ( ! error && response.statusCode === 200 ) {
			const fonts = JSON.parse( body )
				.sort( function( a, b ) {
					return a.family.localeCompare( b.family );
				} );
			fs.writeFile( 'src/controls/google-fonts.json', JSON.stringify( fonts, null, 2 ), function( err ) {
				if ( ! err ) {
					// eslint-disable-next-line no-console
					console.log( 'Google fonts updated!' );
				}
			} );
		}
	} );
} );
