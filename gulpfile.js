const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

// Tarefa para compilar SCSS
gulp.task('sass', function () {
  return gulp.src('sass/**/*.scss')   // origem
    .pipe(sass())                     // compila
    .pipe(gulp.dest('css'));          // destino
});

// Tarefa padrão: assistir alterações
gulp.task('watch', function () {
  gulp.watch('sass/**/*.scss', gulp.series('sass'));
});
