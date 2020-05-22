const mix = require('laravel-mix');
const webpack = require('webpack');

if (mix.inProduction()) {
    ['admin', 'user'].forEach(function (item) {
        require(`${__dirname}/webpack-${item}.mix.js`);
    });
} else {
// console.log(process.env.npm_config_section)
    if (['admin', 'user'].includes(process.env.npm_config_section)) {
        require(`${__dirname}/webpack-${process.env.npm_config_section}.mix.js`);
    } else {
        mix.js('resources/js/app.js', 'public/panel/app/js')
            .sass('resources/sass/app.scss', 'public/panel/app/css')
            .styles([
                'resources/css/utils/adminlte.css',
                'resources/css/utils/custom-style.css',
            ], 'public/panel/app/css/panel.css')
            .scripts([
                'resources/js/utils/adminlte.js',
                'resources/js/utils/demo.js',
            ], 'public/panel/app/js/panel.js');
    }
}

mix.babelConfig({
    plugins: ['@babel/plugin-syntax-dynamic-import'],
});

mix.webpackConfig({
    plugins: [
        new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)
    ],
    output: {
        chunkFilename: 'panel/app/js/[name].js',
        publicPath: process.env.APP_URL
    },
    module: {
        rules: [{
            test: /\.js$/,
            exclude: /node_modules/,
            loader: 'babel-loader',
            options: {
                presets: ['@babel/preset-env'],
            },
        }]
    },
});

mix
    .options({
        postCss: [
            require('autoprefixer'),
        ],
    });

mix.setResourceRoot(process.env.APP_URL);

if (mix.inProduction()) {
    mix.version();
    mix.disableNotifications();
}
