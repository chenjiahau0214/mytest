var objCommonFn = {
    getRootUrl: function() {
        var path = window.location.pathname,
            aryPath = path.split('/');

        return aryPath[1];
    }
};

var requirejs = window.requirejs.config({
    baseUrl: './js/',
    context: 'main',
    paths: {
        "jquery": "base/jquery"
      , "lodash": "base/lodash"
      , "Handlebars": "/base/handlebars"
　　}
});
