var elixir = require('laravel-elixir');

elixir.config.sourcemaps = true;
elixir.config.assetsPath = 'assets/';
elixir.config.publicPath = 'public/';
elixir.config.css.sass.folder = 'scss';

var paths = {
    npm: '../../node_modules/',
    assets: elixir.config.assetsPath,
    public: elixir.config.publicPath,
    foundation: '../../node_modules/foundation-sites/js/foundation/'
};

elixir(function(mix) {
    mix
        .sass('app.scss', null, null, { includePaths: [
            'node_modules/foundation-sites/scss/',
            'node_modules/font-awesome/scss/'
        ]})

        .scripts([
            paths.npm + 'jquery/dist/jquery.js',
            paths.npm + 'foundation-sites/dist/foundation.js',
            paths.npm + 'what-input/dist/what-input.js'
            // add other libraries as you need them
            // paths.foundation + 'foundation.topbar.js',
            // paths.foundation + 'foundation.offcanvas.js',
            // paths.foundation + 'foundation.equalizer.js',
            // paths.foundation + 'foundation.accordion.js',
        ], paths.public + 'js/vendor.js')

        //todo: webpack this?
        .scripts([
            'app.js'
        ], paths.public + 'js/app.js')

        //images to public folder
        .copy(paths.assets + 'images', paths.public + 'images/')

        //move fonts to public folder
        .copy([
            paths.npm + 'font-awesome/fonts'
        ], paths.public + 'fonts/');
});