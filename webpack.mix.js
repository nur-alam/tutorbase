let mix = require('laravel-mix');

mix.setPublicPath('./assets/dist');

mix.js('assets/src/scripts/app.js', 'assets/dist/js/app.min.js').sass(
	'assets/src/sass/style.scss',
	'assets/dist/css/style.min.css'
);
