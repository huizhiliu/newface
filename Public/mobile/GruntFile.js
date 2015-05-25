module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        imagemin: {
            /* 压缩图片大小 */
            dist: {
                options : {
                     optimizationLevel: 10
                },
                file: [{
                    expand: true,
                    cwd: "./images/",
                    src: ["**/*.{jpg,png,gif}"],
                    dest: "./dest/"
                }]
            }
        }
    });
    grunt.loadNpmTasks('grunt-contrib-imagemin'); //图像压缩

    // 注册任务
    grunt.registerTask('default', ['imagemin']);
};