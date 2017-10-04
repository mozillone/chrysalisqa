var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.sourcemaps = false;
var css_path = '../../../public/css/';
var js_path = '../../../public/js/';

var fonts_path = '../../../public/font-awesome/css/';

var user_js_path = '../../../public/user/js/';
var user_css_path = '../../../public/user/css/';

var admin_js_path = '../../../public/admins/js/';
var admin_css_path = '../../../public/admins/css/';

var adminLte_path = '../../../public/assets/vendors/AdminLTE-master/';

// var user_styles = [
//             css_path+'bootstrap.min.css',
//             fonts_path+'font-awesome.min.css',
//             css_path+'sweetalert.css',
//             css_path+'custom.css',
//             user_css_path+'tum.css',
//          ];
// var user_scripts = [
//             js_path+'jquery-3.1.1.min.js',
//             js_path+'bootstrap.min.js',
//             js_path+'sweetalert.min.js',
//             js_path+'jquery.validate.min.js',
//             user_js_path+'validation.js',
//          ];

var admin_styles = [
            //adminLte_path+'bootstrap/css/bootstrap.min.css',
    		//admin_css_path+'font-awesome.min.css',
    	    adminLte_path+'dist/css/AdminLTE.min.css',
    	    adminLte_path+'dist/css/skins/_all-skins.min.css',
    	    adminLte_path+'plugins/datatables/dataTables.bootstrap.css',
    	    css_path+'sweetalert.css',
            css_path+'custom.css',
            admin_css_path+'custom.css',
        ];
var admin_scripts = [
            js_path+'sweetalert.min.js',
            adminLte_path+'plugins/jQuery/jquery-2.2.3.min.js',
            js_path+'jquery.validate.min.js',
            adminLte_path+'plugins/datatables/jquery.dataTables.min.js',
            adminLte_path+'plugins/datatables/dataTables.bootstrap.min.js',
            adminLte_path+'bootstrap/js/bootstrap.min.js',
            adminLte_path+'dist/js/app.min.js',
            admin_js_path+'validation.js',
         ];

elixir(function(mix) {
    // mix.styles(user_styles, 'public/user/css/final.css').version(["public/user/css/final.css"]);
    // mix.scripts(user_scripts, 'public/user/js/final.js').version(["public/user/js/final.js"]);

   mix.styles(admin_styles, 'public/admins/css/final.css');
    mix.scripts(admin_scripts, 'public/admins/js/final.js');
});
