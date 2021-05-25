/*

 Instalation plugins

 npm install --save-dev gulp
 npm install --save-dev jshint gulp-jshint
 npm install --save-dev gulp-uglify
 npm install --save-dev gulp-concat
 npm install --save-dev gulp-rename
 npm install --save-dev gulp-scss
 npm install --save-dev gulp-sass
 npm install --save-dev autoprefixer
 npm install --save-dev gulp-sourcemaps
 npm install --save-dev gulp-minify
 bower install normalize-scss;

 */

var gulp = require('gulp');
var jshint = require('gulp-jshint');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var scss = require('gulp-scss');
var sass = require('gulp-sass');
var autoprefixer = require('autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var minify = require('gulp-minify');

var paths = {

    allScriptsToConvert: [
        'resource/js/*.js',
        'resource/js/**/*.js',
    ],
    allStyleToConvert: [
        'resource/**/self-*.scss',
    ],
    allStyleRunEvent: [
        'resource/**/*.scss',
    ]

};

gulp.task('allScriptFunc',function(){
    return gulp.src(paths.allScriptsToConvert)
        .pipe(rename(function(path){
            // path.dirname = path.dirname.replace("/js","");
        }))
        .pipe(gulp.dest('public/js'));
});

gulp.task('allStyleFunc',function(){
    return gulp.src(paths.allStyleToConvert)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(rename(function(path){
            path.dirname = '';
            path.basename = path.basename.replace("self-","");
            if(path.basename.search('plugin-')===0) {
                path.basename = path.basename.replace("plugin-","");
                path.dirname = '/plugins';
            }
        }))
        .pipe(gulp.dest('public/css'));
});

gulp.task('gulpwatch', function() {
    gulp.watch(paths.allScriptsToConvert, gulp.series('allScriptFunc'));
    gulp.watch(paths.allStyleRunEvent, gulp.series('allStyleFunc'));
});
