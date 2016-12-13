var elixir = require('laravel-elixir');

elixir.config.sourcemaps = true;
elixir.config.assetsPath = 'assets/';
elixir.config.publicPath = 'public/';
elixir.config.css.sass.folder = 'scss';

var paths = {
    npm: '../../node_modules/',
    assets: elixir.config.assetsPath,
    public: elixir.config.publicPath,
    foundation: '../../node_modules/foundation-sites/js/',
    foundationIcons: 'node_modules/foundation-icons/foundation-icons'
};

elixir(function(mix) {
    mix
        .sass('app.scss', null, null, { includePaths: [
            'node_modules/foundation-sites/scss/',
            'node_modules/font-awesome/scss/',
            'node_modules/leaflet/dist/'
        ]})

        .scripts([
            paths.npm + 'jquery/dist/jquery.js',
            paths.npm + 'leaflet/dist/leaflet.js',
            paths.npm + 'what-input/dist/what-input.js',
            paths.foundation + 'foundation.core.js',
            paths.foundation + 'foundation.util.mediaQuery.js',
            paths.foundation + 'foundation.sticky.js',
            paths.foundation + 'foundation.util.triggers.js'
        ], paths.public + 'js/vendor.js')

        //todo: webpack this?
        .scripts([
            'app.js'
        ], paths.public + 'js/app.js')

        //images to public folder
        .copy(paths.assets + 'img', paths.public + 'img/')

        //leaflet images to css/images
        .copy('node_modules/leaflet/dist/images', paths.public + 'css/images/')

        //move fonts to public folder
        .copy([
            paths.assets + 'fonts',
            'node_modules/font-awesome/fonts'
        ], paths.public + 'fonts/')

        //move foundation-icons to public folder
        .copy('node_modules/foundation-icons/svgs', paths.public + 'foundation-icons/svgs/')
        .copy([
            paths.foundationIcons + '.css',
            paths.foundationIcons + '.eot',
            paths.foundationIcons + '.scss',
            paths.foundationIcons + '.svg',
            paths.foundationIcons + '.ttf',
            paths.foundationIcons + '.woff'
        ], paths.public + 'foundation-icons/')
    ;
});
