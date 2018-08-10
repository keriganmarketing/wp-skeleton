const mix = require('laravel-mix');

require('dotenv').config();

const theme = process.env.WP_THEME;

mix.setResourceRoot('../');
mix.setPublicPath(`public/themes/${theme}/assets`);

mix.js('resources/assets/scripts/app.js', 'scripts');
mix.sass('resources/assets/styles/app.scss', 'styles');
mix.styles([
    'node_modules/alertifyjs/build/css/alertify.min.css',
    'node_modules/alertifyjs/build/css/themes/bootstrap.min.css',
    'public/themes/wordplate/assets/styles/app.css'
], 'public/themes/wordplate/assets/styles/main.css');

mix.version();
