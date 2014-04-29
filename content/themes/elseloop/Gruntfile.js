module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    clean:
      ["assets/css/build/min"],

    sass: {
      dist: {
        options: {
          style: 'expanded', // we'll compress it later
          compass: true,
          loadPath: require('node-neat').includePaths
        },
        files: {
          // destination : source
          'assets/css/build/style.css': 'assets/sass/styles.scss'
        },
      }
    },

    autoprefixer: {
      options: {
        browsers: ['last 2 version']
      },
      no_dest: {
        src: 'assets/css/build/style.css'
      }
    },

    cssmin: {
      add_banner: {
        options: {
          banner: '/* elseloop version 5, 2014 */'
        },
        files: {
          'assets/css/build/min/style.min.css': ['assets/css/build/*.css']
        }
      }
    },

    jshint: {
      options: {
        curly: true,
        eqeqeq: true,
        eqnull: true,
        browser: true,
        globals: {
          jQuery: true
        },
      },
      beforeconcat: ['assets/js/app.js']
    },

    concat: {
      dist: {
        src: [
          'assets/js/libs/jquery-1.10.2.js',
          'assets/js/libs/moment.min.js',
          'assets/js/libs/handlebars-1.1.2.js',
          'assets/js/libs/ember-1.5.0.js',
          'assets/js/libs/ember-model.js',
          'assets/js/libs/pagination.js',
          'assets/js/libs/ic-ajax.js',
          'assets/js/libs/prism.js',
          'assets/js/*.js'
          
        ],
        dest: 'assets/js/build/scripts.js'
      }
    },

    uglify: {
      build: {
        src: 'assets/js/build/scripts.js',
        dest: 'assets/js/build/scripts.min.js'
      }
    },

    imagemin: {
      dynamic: {
        files: [{
          expand: true,
          cwd: 'assets/images/',
          src: ['*.{png,jpg,gif}'],
          dest: 'assets/images/'
        }]
      }
    },

    watch: {
      options: {
        livereload: true,
      },
      html: {
        files: ['index.html'],
      },
      php: {
        files: ['*.php', '**/*.php']
      },
      scripts: {
        files: ['assets/js/*.js'],
        tasks: ['jshint', 'concat', 'uglify'],
        options: {
          spawn: false
        }
      },
      sass: {
        files: ['assets/sass/**/*.scss'],
        tasks: ['sass', 'autoprefixer', 'cssmin'],
      },
      css: {
        files: ['assets/css/build/min/style.min.css'],
        options: {
          spawn: false
        }
      },
      images: {
        files: ['assets/images/**/*.{png,jpg,gif}', 'assets/images/*.{png,jpg,gif}'],
        tasks: ['imagemin'],
        options: {
          spawn: false,
        }
      }
    },

    connect: {
      server: {
        options: {
          port: 8000,
          base: './',
          livereload: true
        }
      }
    }

  });

  require('load-grunt-tasks')(grunt);

  // Default Task is basically a rebuild
  grunt.registerTask('default', ['clean', 'concat', 'uglify', 'sass', 'autoprefixer', 'cssmin', 'imagemin']);

  grunt.registerTask('dev', ['connect', 'watch']);

};