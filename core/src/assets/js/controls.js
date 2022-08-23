import * as controls from './controls/index';
import './controls.scss';

for ( const control in controls ) {
	controls[ control ]();
}
