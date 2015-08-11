var gulp = require('gulp'),
			less = require('gulp-less'),
            uglifycss = require("gulp-uglifycss"),
			path = require('path'),
			watch = require('gulp-watch'),
			autoprefixer = require('gulp-autoprefixer'),
			browserSync = require('browser-sync'),
			uglify = require('gulp-uglify'),
			sourcemaps = require('gulp-sourcemaps'),
			jshint = require('gulp-jshint'),
			imageResize = require('gulp-image-resize'),
			rename = require("gulp-rename"),
			changed = require("gulp-changed"),
            plumber = require("gulp-plumber"),
            cmq = require('gulp-combine-media-queries');


var run = require('gulp-run');

//gulp.src(['js/**/*.js', '!js/**/*.min.js'])

gulp.task('default', function () {

    // console.log( process.cwd() );
    // if (process.cwd() == '/home/nathan/bandi-restaurant') {
         var devProxy = "phd.dev.chand.co";
    // } else {
    //     var devProxy = "bandi.dev.chand.co";
    // }


	browserSync({
	        proxy: devProxy,
	        files: "library/css/*.css"
	    });
	
	//gulp.watch('./library/less/**/*.less', ['compile-css']);

    gulp.watch('./library/less/**/*.less', ['compile-css']);

	gulp.watch(['./library/js/*.js', '!./library/js/main-built.js'], ['javascript']);

});



gulp.task('javascript', function() {
	 gulp.src(['./library/js/*.js','./library/js/components/*.js', '!./library/js/main-built.js',  '!./library/js/cf7.js'])  	// ignore vendor stuff
     .pipe(plumber())    
     .pipe(jshint())
     .pipe(jshint.reporter('default'));

//    gulp.src(['./library/js/**/*.js', '!./library/js/require.js'])  	
       //.pipe(uglify())
  //     .pipe(gulp.dest('library/dist/js'));

    
    run('r.js -o build.js').exec();
});


gulp.task('compile-css', function () {
	gulp.src('./library/less/main.less')
				.pipe(plumber())    
                .pipe(sourcemaps.init())
			    .pipe(less())
			    .pipe(autoprefixer())
                //.pipe(uglifycss())
                .pipe(sourcemaps.write('./maps'))
			    .pipe(gulp.dest('./library/css/'));



    gulp.src('./library/less/admin.less')
                .pipe(plumber())    
                .pipe(sourcemaps.init())
                .pipe(less())
                .pipe(autoprefixer())
                //.pipe(uglifycss())
                .pipe(sourcemaps.write('./maps'))
                .pipe(gulp.dest('./library/css/'));

    gulp.src('./library/less/editor-style.less')
                .pipe(plumber())    
                .pipe(sourcemaps.init())
                .pipe(less())
                .pipe(autoprefixer())
                //.pipe(uglifycss())
                .pipe(sourcemaps.write('./maps'))
                .pipe(gulp.dest('./library/css/'));


    gulp.src('./library/less/style-bootstrap.less')
                .pipe(plumber())    
                //.pipe(sourcemaps.init())
                .pipe(less())
                .pipe(autoprefixer())
                //.pipe(uglifycss())
                
                .pipe(gulp.dest('./library/css/'));

   return; 

});

gulp.task('dist-css', function () {
    gulp.src('./library/less/main.less')
                .pipe(less())
                .pipe(autoprefixer())
                .pipe(cmq({
                  log: true
                }))
                .pipe(uglifycss())
                .pipe(gulp.dest('./library/css/'));

   


    gulp.src('./library/less/admin.less')
                //.pipe(sourcemaps.init())
                .pipe(less())
                .pipe(autoprefixer())
                .pipe(uglifycss())
                //.pipe(sourcemaps.write('./maps'))
                .pipe(gulp.dest('./library/css/'));

    gulp.src('./library/less/editor-style.less')
                //.pipe(sourcemaps.init())
                .pipe(less())
                .pipe(autoprefixer())
                .pipe(uglifycss())
                //.pipe(sourcemaps.write('./maps'))
                .pipe(gulp.dest('./library/css/'));



});




gulp.task('resize-images', function () {

	// this doesn't happen automatically, because it's a bit intensive, it should be done when we need.
	
	var originalName;

     gulp.src("images/src/**/*.{jpg,png}")
    .pipe(changed("images/dist"))


    // This isn't ideal, but it'll work fine
    // Make sure that you go BIGGEST FIRST because of piping

    // Need to change renaming to the wordpress convention

    // need to specify heights?

    // need to do lossless optimisation

    // remember to set new name as well as new size for each resize.
    .pipe(imageResize({ 
    	imageMagick : true,
    	width : 200
    }))
    .pipe(rename(function (path) {
    	originalName = path.basename;
        path.basename = originalName + "-200";        
    }))
    .pipe(gulp.dest("images/dist"))
 

    .pipe(imageResize({ 
    	imageMagick : true,
    	width : 100
    }))
    .pipe(rename(function (path) {
        path.basename = originalName + "-100";        
    }))
    .pipe(gulp.dest("images/dist"));

});




