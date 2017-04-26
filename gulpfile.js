/**
 * Created by kokoala on 19/04/2017.
 */


var gulp = require('gulp'),
    php = require('gulp-connect-php'),
    browserSync = require('browser-sync');

var reload = browserSync.reload;
var exec = require('child_process').exec;


gulp.task('php', function () {
    php.server({base: 'web', port: 8010, keepalive: true});
});
gulp.task('browser-sync', ['php'], function () {
    browserSync({
        proxy: '127.0.0.1:8010',
        port: 8080,
        open: false,
        notify: false,
        snippetOptions: {


            // Provide a custom Regex for inserting the snippet.
            rule: {
                match: /<watcher\/>/i,
                fn: function (snippet, match) {
                    console.log("match", match);
                    return snippet;
                }
            }
        }
    });
});

gulp.task('phpUnit', function (cb) {
    exec('phpunit --coverage-text -v', function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        cb(err);
    });
})


gulp.task('default', ['browser-sync'], function () {
    "use strict";
    var watcher = gulp.watch(['src/**/*.php'], [reload]);
    gulp.watch(['test/**/*.php'], ['phpUnit']);



    watcher.on('change', function(event) {
        console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');

    });
});