var exec = require('child_process').exec;
var gulp = require('gulp');
var elixir = require('laravel-elixir');
require('laravel-elixir-rollup');

elixir.config.sourcemaps = false;

elixir(function(mix) {

    //console.log(elixir.config);

    // Delete versioned json file and all js, css in public to prevent conflicts
    mix.task('delete-assets');

    mix.sass('app.scss');
    mix.rollup('app.js');

    mix.version([
        'public/css/app.css',
        'public/js/app.js'
    ]);

    mix.task('delete-temp-assets');
});

gulp.task('delete-assets', function() {

    var cmd_rm = 'rm -f ';
    var cmd_slash = '/';

    if (process.platform === 'win32') {
        cmd_rm = 'del /F /Q ';
        cmd_slash = '\\';
    }

    console.log('Executing shell commands:');

    rm_manifest_cmd = cmd_rm + '"' + elixir.config.publicPath + cmd_slash + 'rev-manifest.json"';
    console.log(rm_manifest_cmd);
    exec(rm_manifest_cmd);

    rm_css_cmd = cmd_rm + '"' + elixir.config.publicPath + cmd_slash + elixir.config.css.outputFolder + cmd_slash + '*"';
    console.log(rm_css_cmd);
    exec(rm_css_cmd);

    rm_js_cmd = cmd_rm + '"' + elixir.config.publicPath + cmd_slash + elixir.config.js.outputFolder + cmd_slash + '*"';
    console.log(rm_js_cmd);
    exec(rm_js_cmd);
});

gulp.task('delete-temp-assets', function() {

    var cmd_rm = 'rm -Rvf ';
    var cmd_slash = '/';

    if (process.platform === 'win32') {
        cmd_rm = 'del /F /Q ';
        cmd_slash = '\\';
    }

    console.log('Executing shell commands:');

    rm_css_cmd = cmd_rm + elixir.config.publicPath + cmd_slash + elixir.config.css.outputFolder + cmd_slash;
    console.log(rm_css_cmd);
    exec(rm_css_cmd);

    rm_js_cmd = cmd_rm + elixir.config.publicPath + cmd_slash + elixir.config.js.outputFolder + cmd_slash;
    console.log(rm_js_cmd);
    exec(rm_js_cmd);
});
