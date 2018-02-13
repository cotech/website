const gulp = require('gulp')
const sass = require('gulp-sass')
const concat = require('gulp-concat')
const when = require('gulp-if')
const uglify = require('gulp-uglify')
const prefix = require('gulp-autoprefixer')
const merge = require('merge-stream')

const assetsPath = './assets'
const publicPath = './public'

const PROD = process.argv
  .join('')
  .includes('--production')

gulp.task('copy', () => {
  return merge(
    gulp
      .src(`${assetsPath}/img/**/*`)
      .pipe(gulp.dest(`${publicPath}/img`)),

    gulp
      .src('node_modules/foundation-icons/svgs/**/*')
      .pipe(gulp.dest(`${publicPath}/foundation-icons/svgs`)),

    gulp
      .src('node_modules/foundation-icons/*.{woff,ttf}')
      .pipe(gulp.dest(`${publicPath}/css`)),

    gulp
      .src('node_modules/leaflet/dist/images/**/*')
      .pipe(gulp.dest(`${publicPath}/css/images`)),

    gulp
      .src([
        `${assetsPath}/fonts/**/*`,
        'node_modules/font-awesome/fonts/**/*'
      ])
      .pipe(gulp.dest(`${publicPath}/fonts`))
  )
})

gulp.task('scripts:app', () => {
  return gulp
    .src(`${assetsPath}/js/**/*.js`)
    .pipe(concat('app.js'))
    .pipe(when(PROD, uglify()))
    .pipe(gulp.dest(`${publicPath}/js`))
})

gulp.task('scripts:vendor', () => {
  return gulp
    .src([
      'node_modules/jquery/dist/jquery.js',
      'node_modules/leaflet/dist/leaflet.js',
      'node_modules/what-input/dist/what-input.js',
      'node_modules/foundation-sites/dist/foundation.js',
      'node_modules/datatables.net/js/jquery.dataTables.js',
      'node_modules/datatables.net-zf/js/dataTables.foundation.js'
    ])
    .pipe(concat('vendor.js'))
    .pipe(uglify())
    .pipe(gulp.dest(`${publicPath}/js`))
})

gulp.task('styles', () => {
  return gulp
    .src(`${assetsPath}/scss/app.scss`)
    .pipe(sass({
      includePaths: [
        'node_modules/foundation-icons/',
        'node_modules/foundation-sites/scss/',
        'node_modules/font-awesome/scss/',
        'node_modules/leaflet/dist/'
      ]
    })
    .on('error', sass.logError))
    .pipe(prefix('last 2 version', 'ie 8', 'ie 9'))
    .pipe(gulp.dest(`${publicPath}/css`))
})

gulp.task('watch', ['scripts:app', 'styles'], () => {
  return gulp.watch([
    `${assetsPath}/js/**/*.js`,
    `${assetsPath}/scss/**/*.scss`
  ] , ['scripts:app', 'styles'])
})

gulp.task('scripts', ['scripts:vendor', 'scripts:app'])
gulp.task('default', ['copy', 'scripts', 'styles'])
