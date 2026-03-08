const { src, dest, watch } = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const rename = require('gulp-rename');

function styles() {
    return src('scss/style.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(dest('assets/css'))
        .pipe(cleanCSS())
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest('assets/css'));
}

function watchFiles() {
    watch('scss/**/*.scss', styles);
}

exports.styles = styles;
exports.watch = watchFiles;
exports.default = watchFiles;