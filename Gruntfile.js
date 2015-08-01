module.exports = function(grunt) {

    // Register the NPM tasks we want
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Register the tasks we want to run
    grunt.registerTask('default', [
        'concat',
        'cssmin:css',
        'uglify:js'
    ]);

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        
        paths: {
            assets: 'web',
            bower: 'vendor/bower',
            css : '<%= paths.assets %>/css',
            js: '<%= paths.assets %>/js',
            dist: '<%= paths.assets %>/dist',
        },

        concat: {
            css: {
                src: [
                    '<%= paths.bower %>/pure/pure-min.css',
                    '<%= paths.css %>/*'
                ],
                dest: '<%= paths.dist %>/app.css'
            },
            js : {
                src: [
                    '<%= paths.js %>/*.js'
                ],
                dest: '<%= paths.dist %>/app.js'
            }
        },
        
        cssmin : {
            css:{
                src: '<%= paths.dist %>/app.css',
                dest: '<%= paths.dist %>/app.min.css'
            }
        },
        
        uglify: {
            js: {
                files: {
                    '<%= paths.dist %>/app.min.js' : ['<%= paths.dist %>/app.js']
                }
            }
        },
    });
};