require('../scss/app.scss');
require('bootstrap/dist/js/bootstrap.js');
// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
require('jquery/dist/jquery.js');

$("#picture").fileinput({
    theme: 'fas',
    uploadUrl: '#', // you must set a valid URL here else you will get an error
    allowedFileExtensions: ['jpg', 'png', 'gif'],
    maxFileSize: 500000,
    maxFilesNum: 1,
    allowedFileTypes: ['image', 'video', 'flash'],
    slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
    }
});