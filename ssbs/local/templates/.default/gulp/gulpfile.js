var syntax        = 'scss';


	var gulp          = require('gulp'),
		sass          = require('gulp-sass'),
		browserSync   = require('browser-sync'),
		concat        = require('gulp-concat'),
		cleancss      = require('gulp-clean-css'),
		rename        = require('gulp-rename'),
		autoprefixer  = require('gulp-autoprefixer');
		// notify        = require('gulp-notify');
		// sourcemaps	  = require('gulp-sourcemaps'),
		// uglify        = require('gulp-uglify-es').default;

gulp.task('styles', function () {
	return gulp.src(['../scss/**/*.scss', '../sass/**/*.sass'])
		// .pipe(sass.sync({outputStyle: 'compressed'}).on("error", notify.onError()))
		.pipe(sass.sync({outputStyle: 'compressed'}))
		.pipe(rename({ suffix: '.min', prefix : '' }))
		.pipe(autoprefixer({
			grid: true,
			overrideBrowserslist: ['last 10 versions']
		}))
		.pipe(cleancss( {level: { 1: { specialComments: 0 } } })) // Opt., comment out when debugging
		.pipe(gulp.dest('../css'))
		.pipe(browserSync.stream());
});

// JS
// gulp.task('scripts', function() {
// 	return gulp.src([
// 		'../js/jquery.js',
// 		'../js/common.js',
// 	])
// 		.pipe(sourcemaps.init())
// 		.pipe(concat('scripts.min.js'))
// 		.pipe(sourcemaps.write('../maps'))
// 		.pipe(gulp.dest('../js'))
// 		.pipe(browserSync.reload({ stream: true }))
// });

//Source map
// gulp.task('map', function() {
// 	return gulp.src('../js/script.js')
// 		.pipe(sourcemaps.init())
// 		.pipe(uglify())
// 		.pipe(concat('script.min.js'))
// 		.pipe(sourcemaps.write(('../maps'), {
// 			mapFile: function(mapFilePath) {
// 				return mapFilePath.replace('.min.js.map', '.map.js');
// 			}
// 		}))
// 		.pipe(gulp.dest('../js'))
// });

gulp.task('watch', function() {
	gulp.watch('../scss/**/*.scss', gulp.parallel('styles'));
	gulp.watch('../sass/**/*.sass', gulp.parallel('styles'));
	// gulp.watch(['../js/common.js'], gulp.parallel('scripts'));
});
gulp.task('default', gulp.parallel('styles', 'watch'));

// gulp.task('maps', function() {
// 	gulp.watch(['../js/script.js'], gulp.parallel('map'));
// });
// gulp.task('JSmap', gulp.parallel('styles',  'maps'));
