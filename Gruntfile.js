var Promise = require( "es6-promise" ).polyfill();

module.exports = function( grunt ) {
	grunt.initConfig( {
		pkg: grunt.file.readJSON( "package.json" ),

		stylelint: {
			src: [ "css/*.css" ]
		},

		concat: {
			options: {
				sourceMap: true
			},
			dist: {
				src: "css/*.css",
				dest: "tmp-style.css"
			}
		},

		postcss: {
			options: {
				map: true,
				diff: false,
				processors: [
					require( "autoprefixer" )( {
						browsers: [ "> 1%", "ie 8-11", "Firefox ESR" ]
					} )
				]
			},
			dist: {
				src: "tmp-style.css",
				dest: "style.css"
			}
		},

		clean: {
			options: {
				force: true
			},
			temp: [ "tmp-style.css", "tmp-style.css.map" ]
		},

		phpcs: {
			plugin: {
				src: "./"
			},
			options: {
				bin: "vendor/bin/phpcs --extensions=php --ignore=\"*/vendor/*,*/node_modules/*\"",
				standard: "phpcs.ruleset.xml"
			}
		},

		jscs: {
			scripts: {
				src: [ "Gruntfile.js", "js/*.js", "!js/animate-svg.min.js" ],
				options: {
					preset: "jquery",
					requireCamelCaseOrUpperCaseIdentifiers: false, // We rely on name_name too much to change them all.
					maximumLineLength: 250
				}
			}
		},

		jshint: {
			grunt_script: {
				src: [ "Gruntfile.js" ],
				options: {
					curly: true,
					eqeqeq: true,
					noarg: true,
					quotmark: "double",
					undef: true,
					unused: false,
					node: true     // Define globals available when running in Node.
				}
			},
			theme_scripts: {
				src: [ "js/*.js", "!js/animate-svg.min.js" ],
				options: {
					bitwise: true,
					curly: true,
					eqeqeq: true,
					forin: true,
					freeze: true,
					noarg: true,
					nonbsp: true,
					quotmark: "double",
					undef: true,
					unused: true,
					browser: true, // Define globals exposed by modern browsers.
					jquery: true   // Define globals exposed by jQuery.
				}
			}
		},

		uglify: {
			all_profiles: {
				src: "js/animate-svg.js",
				dest: "js/animate-svg.min.js"
			}
		}

	} );

	grunt.loadNpmTasks( "grunt-contrib-clean" );
	grunt.loadNpmTasks( "grunt-contrib-concat" );
	grunt.loadNpmTasks( "grunt-contrib-jshint" );
	grunt.loadNpmTasks( "grunt-contrib-uglify" );
	grunt.loadNpmTasks( "grunt-jscs" );
	grunt.loadNpmTasks( "grunt-phpcs" );
	grunt.loadNpmTasks( "grunt-postcss" );
	grunt.loadNpmTasks( "grunt-stylelint" );

	// Default task(s).
	grunt.registerTask( "default", [ "stylelint", "concat", "postcss", "clean", "phpcs", "jscs", "jshint", "uglify" ] );
};
