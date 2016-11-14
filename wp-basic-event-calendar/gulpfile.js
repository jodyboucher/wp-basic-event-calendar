var gulp = require('gulp');

gulp.task('styles', function() {
    return gulp.src(['vendor/jodyboucher/basic-event-calendar/lib/basic-event-calendar.min.css'])
        .pipe(gulp.dest('public/css'));
});

gulp.task('scripts', function() {
    return gulp.src(['vendor/jodyboucher/basic-event-calendar/lib/basic-event-calendar.min.js'])
        .pipe(gulp.dest('public/js'));
});


// Default task
gulp.task('default', ['styles', 'scripts']);
