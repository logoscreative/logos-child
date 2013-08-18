module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                'js/plugins/*.js',
                '!js/scripts.min.js'
            ]
        },
        recess: {
            dist: {
                options: {
                    compile: true,
                    compress: true
                },
                files: {
                    'assets/css/main.min.css': [
                        'less/main.less'
                    ]
                }
            }
        },
        uglify: {
            dist: {
                files: {
                    'js/scripts.min.js': [
                        'js/plugins/*.js'
                    ]
                }
            }
        },
        imageoptim: {
            files: [
                'assets/img'
            ],
            options: {
                quitAfter: true
            }
        },
        watch: {
            less: {
                files: [
                    'less/*.less'
                ],
                tasks: ['recess']
            },
            js: {
                files: [
                    '<%= jshint.all %>'
                ],
                tasks: ['jshint', 'uglify']
            }
        },
        clean: {
            dist: [
                'css/main.min.css',
                'js/scripts.min.js'
            ]
        }
    });

    // Load tasks
    grunt.loadTasks('tasks');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-recess');
    grunt.loadNpmTasks('grunt-imageoptim');

    // Register tasks
    grunt.registerTask('default', [
        'clean',
        'recess',
        //'uglify',
        'imageoptim'
    ]);
    grunt.registerTask('dev', [
        'watch'
    ]);

};
