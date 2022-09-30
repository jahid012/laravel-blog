
// (function ($) {

// var direction =  getUrlParams('dir');
// if(direction != 'rtl')
// {direction = 'ltr'; }

//     new dezSettings({
//         typography: "roboto",
//         version: "light",
//         layout: "Vertical",
//         headerBg: "color_2",
//         navheaderBg: "color_10",
//         sidebarBg: "color_2",
//         sidebarStyle: "full",
//         sidebarPosition: "fixed",
//         headerPosition: "fixed",
//         containerLayout: "full",
//         direction: direction
//     });

// })(jQuery);

const url = $("[data-du='customizers']").attr('src').split('url=')[1];

(function ($) {
    ///
    var __validation = function (key, value) {

        var dataArray = {
            typography: ["roboto"],
            version: ["light", "dark"],
            layout: ['vertical', 'horizontal'],
            sidebarStyle: ['full', 'mini', 'compact', 'modern', 'overlay', 'icon-hover'],
            sidebarPosition: ['static', 'fixed'],
            headerPosition: ['static', 'fixed'],
            containerLayout: ['wide', 'boxed', 'wide-boxed'],
            headerBg: ["color_1", "color_2", "color_3", "color_4", "color_5", "color_6", "color_7", "color_8", "color_9", "color_10"],
            navheaderBg: ["color_1", "color_2", "color_3", "color_4", "color_5", "color_6", "color_7", "color_8", "color_9", "color_10"],
            sidebarBg: ["color_10", "color_1", "color_2", "color_3", "color_4", "color_5", "color_6", "color_7", "color_8", "color_9", "color_10"],
            direction: ["ltr", "rtl"]
        }
        var val = dataArray[key][0];
        dataArray[key].forEach((element) => {
            //console.log(element + " = " + value);
            if (element == value) {
                val = value;
            }
        });

        return val;
    }


    function customizerDataValidation(customizerData) {

        return {
            typography: __validation("typography", customizerData.typography),
            version: __validation("version", customizerData.version),
            layout: __validation("layout", customizerData.layout),
            headerBg: __validation("headerBg", customizerData.headerBg),
            navheaderBg: __validation("navheaderBg", customizerData.navheaderBg),
            sidebarBg: __validation("sidebarBg", customizerData.sidebarBg),
            sidebarStyle: __validation("sidebarStyle", customizerData.sidebarStyle),
            sidebarPosition: __validation("sidebarPosition", customizerData.sidebarPosition),
            headerPosition: __validation("headerPosition", customizerData.headerPosition),
            containerLayout: __validation("containerLayout", customizerData.containerLayout),
            direction: __validation("direction", customizerData.direction),
        }

    }

    if (typeof localStorage.getItem('ducor.customizer') === undefined || localStorage.getItem('ducor.customizer') === null || localStorage.getItem('ducor.customizer') == 'undefined') {

        $.get(url)
            .done(function (response) {

                var data = response.data;
                if(data == undefined){
                    data = response;
                }
                if(JSON.stringify(response).length > 5){
                    localStorage.setItem('ducor.customizer', "" + JSON.stringify(data));
                    location.reload();
                }
            })
            .fail(function () {
                localStorage.removeItem('ducor.customizer');
                // Immediately remove current toasts without using animation
                // toastr.remove()
                // Display an error toast, with a title
                // toastr.error('Fail customizer update.', 'Server Response!')
            });
    }

    $(document).ready(function () {
        if (typeof localStorage.getItem('ducor.customizer') !== undefined || localStorage.getItem('ducor.customizer') !== null ) {

            if(localStorage.getItem('ducor.customizer')+'' == 'undefined'){
                localStorage.removeItem('ducor.customizer');
                return ;
            }

            new dezSettings(
                customizerDataValidation(
                    JSON.parse(
                        localStorage.getItem('ducor.customizer')
                    )
                )
            );
        } else {
            new dezSettings(
                customizerDataValidation([])
            );
        }
    });

})(jQuery);


$(document).ready(function () {

    $("#home8").change(function (e) {
        //console.log(e.target.value + " == " + e.target.name);

        var data = {};
        data[e.target.name] = e.target.value;

        data['_token'] =  $('meta[name="csrf-token"]').attr('content');

        if (typeof localStorage.getItem('ducor.customizer') !== undefined || localStorage.getItem('ducor.customizer') !== null) {

            $.post(url, data)
                .done(function (response) {

                    localStorage.removeItem('ducor.customizer');
                    // Immediately remove current toasts without using animation
                    // toastr.remove();
                    // Display an error toast, with a title
                    // toastr.success('' + response.message, '' + response.title);
                    localStorage.setItem('ducor.customizer', "" + JSON.stringify(response.data));
                })
                .fail(function (response) {

                    // console.log('response', response);
                    localStorage.removeItem('ducor.customizer');
                    // Immediately remove current toasts without using animation
                    // toastr.remove();
                    // Display an error toast, with a title
                    // toastr.error('Fail customizer update.', 'Server Response!');

                });
        }

    });
});


