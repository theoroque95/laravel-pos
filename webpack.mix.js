let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
	.copy('resources/assets/js/epson/epos-2.3.0.js', 'public/js')
	.copy('resources/assets/js/epson/epos-print-editor-en.js', 'public/js')
	.copy('resources/assets/js/epson/editor-main.js', 'public/js')
	.copy('resources/assets/js/epson/editor-print.js', 'public/js')
	.copy('resources/assets/js/epson/editor-preview.js', 'public/js')
	.copy('resources/assets/js/epson/editor-import.js', 'public/js')
	.copy('resources/assets/js/epson/editor-export.js', 'public/js')
   .less('resources/assets/less/AdminLTE.less', 'public/css')
   .sass('resources/assets/sass/app.scss', 'public/css');