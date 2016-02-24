var   gulp = require('gulp'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
       del = require('del');

var dest = 'ajax-twitter';

var copy = [
  '*.php',
  'config',
  '!config/credentials.php',
  'readme.md',
  'license.txt'
]

gulp.task('js', function () {
  gulp.src(['./js/tweets.js', './node_modules/twitter-text/twitter-text.js'])
  .pipe(concat('ajax-twitter.js'))
  .pipe(uglify())
  .pipe(gulp.dest(dest + '/js'));
});

gulp.task('copy', function () {
  gulp.src(copy)
  .pipe(gulp.dest(dest));
});

gulp.task('build', ['js', 'copy']);



gulp.task('clean', function () {
  del(dest);
});