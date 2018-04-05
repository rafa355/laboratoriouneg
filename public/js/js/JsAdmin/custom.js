/*------------------------------------------------------
    Author : www.webthemez.com
    License: Commons Attribution 3.0
    http://creativecommons.org/licenses/by/3.0/
---------------------------------------------------------  */

(function ($) {
    "use strict";
    var mainApp = {

        initFunction: function () {
            /*MENU 
            ------------------------------------*/
            $('#main-menu').metisMenu();
			
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });
        },

        initialization: function () {
            mainApp.initFunction();
        }
    }
    // Initializing ///

    $(document).ready(function () {
        mainApp.initFunction();
        $('[data-toggle="tooltip"]').tooltip();
    });

}(jQuery));

/*** LIMPIAR MENUS ***/
function limpiar_sidebar(select = 'null'){
    var menus = $('#main-menu li a'); 
    menus.removeClass('active-menu');
    if (select != 'null') {
        menus.eq(select).addClass('active-menu');
    }
}