"use strict";

module.exports = function (grunt) {

  grunt.initConfig({
    "pkg":   grunt.file.readJSON("package.json"),

    "project": {},

    "shell": {
      "copy_files": "docker cp -a /mnt/hgfs/D/localhost/bible/www/ apache-php:/var/www/html/"
    },
    
    "watch": {
      "tasks": [ "shell:copy_files" ],
      "files": [
        "Gruntfile.js",
        "www/**/*.php"
      ]
    }

  });

  grunt.loadNpmTasks("grunt-contrib-watch");
  grunt.loadNpmTasks('grunt-shell');

};
