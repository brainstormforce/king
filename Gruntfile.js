module.exports = function(grunt) {
	grunt.initConfig({
		copy: {
			main: {
				options: {
					mode: true
				},
				src: [
				'**',
				'!node_modules/**',
				'!.git/**',
				'!*.sh',
				'!Gruntfile.js',
				'!package.json',
				'!.gitignore',
				'!king.zip'
				],
				dest: 'king/'
			}
		},
		compress: {
			main: {
				options: {
					archive: 'king.zip',
					mode: 'zip'
				},
				files: [
				{
					src: [
					'./king/**'
					]

				}
				]
			}
		},
		clean: {
			main: ["king"],
			zip: ["king.zip"],
		}
	});

	grunt.loadNpmTasks( 'grunt-contrib-copy' );
	grunt.loadNpmTasks( 'grunt-contrib-compress' );
	grunt.loadNpmTasks('grunt-contrib-clean');

	grunt.registerTask('release', ['clean:zip', 'copy','compress','clean:main']);
};
