
//toastr
(function () {

    let toastr = function (message, title = false, type = '') {

        if (message === undefined) {
            return false;
        }
        titleBg = '';

        if (type === 'primary') {
            titleBg = ' bg-primary';
        } else if (type === 'secondary') {
            titleBg = ' bg-secondary';
        } else if (type === 'success') {
            titleBg = ' bg-success';
        } else if (type === 'danger' || type === 'error') {
            titleBg = ' bg-danger';
        } else if (type === 'warning') {
            titleBg = ' bg-warning';
        } else if (type === 'light') {
            // titleBg = ' bg-light';
        } else if (type === 'dark') {
            titleBg = ' bg-dark';
        }

        var html = "";
        if (title) {
            html = '<div class="toast show' + titleBg + '">' +
                    '   <div class="toast-header d-flex justify-content-between">' +
                    '       <strong>' + title + '</strong>' +
                    '       <button type="button" class="btn-close" data-bs-dismiss="toast"></button>'+
                    '   </div>' +
                    '   <div class="toast-body">' + message + '</div>' +
                    '</div>';
        } else {
            html = '<div class="toast show align-items-center border-0' + titleBg + '">' +
                '   <div class="d-flex">' +
                '       <div class="toast-body">' +
                '           <strong class="me-auto">' + message + '</strong>' +
                '       </div>' +
                '   <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"></button>' +
                '   </div>' +
                '</div>';
        }

        $("#toast-container").append(html);
    }

    toastr.container = function () {
        var toastElList = [].slice.call(document.querySelectorAll("#toast-container .toast"))
        toastElList.map(function (toastEl) {
            //   return new bootstrap.Toast(toastEl, option)
            var myToast = bootstrap.Toast.getInstance(toastEl);
            toastEl.addEventListener('hide.bs.toast', function (e) {
                setTimeout(function () {
                    e.target.remove();
                }, 300);
            });
        });
    }

    // info primary
    toastr.primary = function (message, title = false) {
        toastr(message, title, type = "primary");

        toastr.container();
    }
    // secondary toast
    toastr.secondary = function (message, title = false) {
        toastr(message, title, type = "secondary");
        toastr.container();
    }
    // success toast
    toastr.success = function (message, title = false) {
        toastr(message, title, type = "success");
        toastr.container();
    }
    // danger toast
    toastr.danger = function (message, title = false) {
        toastr(message, title, type = "danger");
        toastr.container();
    }

    // danger error
    toastr.error = function (message, title = false) {
        toastr(message, title, type = "error");
        toastr.container();
    }

    // warning toast
    toastr.warning = function (message, title = false) {
        toastr(message, title, type = "warning");
        toastr.container();
    }
    // info toast
    toastr.info = function (message, title = false) {
        toastr(message, title, type = "primary");
        toastr.container();
    }
    // light toast
    toastr.light = function (message, title = false) {
        toastr(message, title, type = "light");
        toastr.container();
    }
    // dark toast
    toastr.dark = function (message, title = false) {
        toastr(message, title, type = "dark");
        toastr.container();
    }

    window.toastr = toastr;
}());

// toastr(' Hello, world! ', 'This is a toast message.');
// toastr.primary(' primary, world! ', 'This is a toast message.');
// toastr.secondary(' secondary, world! ', 'This is a toast message.');
// toastr.success(' success, world! ', 'This is a toast message.');
// toastr.danger(' danger, world! ', 'This is a toast message.');
// toastr.warning(' warning, world! ', 'This is a toast message.');
// toastr.info(' info, world! ', 'This is a toast message.');
// toastr.light(' light, world! ', 'This is a toast message.');
// toastr.dark(' dark, world! ', 'This is a toast message.');
// toastr.error(' error, world! ', 'This is a toast message.');

// toastr(' Hello, world! This is a toast message. ');
// toastr(' Hello, world! This is a toast message. ');


$(window).on("load", function() {

    /* ----------------------------------------------------------- */
    /*  PAGE PRELOADER
    /* ----------------------------------------------------------- */
    setTimeout(function() {
        $('#preloader').fadeOut();
        $('#main-wrapper').addClass('show');

    }, 3000);

});


(function ($) {
    "use strict";

    $("#menu").metisMenu();

    // $(function() {
    //     AOS.init({
    //         duration: 1500,
    //         easing: 'ease-in-out',
    //     });
    // });

    $("#checkAll").change(function () {
        $("td input:checkbox").prop('checked', $(this).prop("checked"));
    });

    /* $('.sidebar-right-inner').slimscroll({
        position: "left",
        size: "5px",
        height: "100%",
        color: "#c6c8c9"
    }); */

    $(".nav-control").on('click', function () {

        $('#main-wrapper').toggleClass("menu-toggle");

        $(".hamburger").toggleClass("is-active");
    });

    //to keep the current page active

    for (var nk = window.location,
        o = $("ul#menu a").filter(function () {
            return this.href == nk;
        })
            .addClass("mm-active")
            .parent()
            .addClass("mm-active"); ;) {
        // console.log(o)
        if (!o.is("li")) break;
        o = o.parent()
            .addClass("mm-show")
            .parent()
            .addClass("mm-active");
    }



    $("ul#menu>li").on('click', function () {
        const sidebarStyle = $('body').attr('data-sidebar-style');
        if (sidebarStyle === 'mini') {
            console.log($(this).find('ul'))
            $(this).find('ul').stop()
        }
    })

    // var win_w = window.outerWidth;
    var win_h = window.outerHeight;
    var win_h = window.outerHeight;
    if (win_h > 0 ? win_h : screen.height) {
        $(".content-body").css("min-height", (win_h + 150) + "px");
    };

    $('a[data-action="collapse"]').on("click", function (i) {
        i.preventDefault(),
            $(this).closest(".card").find('[data-action="collapse"] i').toggleClass("mdi-arrow-down mdi-arrow-up"),
            $(this).closest(".card").children(".card-body").collapse("toggle");
    });

    $('a[data-action="expand"]').on("click", function (i) {
        i.preventDefault(),
            $(this).closest(".card").find('[data-action="expand"] i').toggleClass("icon-size-actual icon-size-fullscreen"),
            $(this).closest(".card").toggleClass("card-fullscreen");
    });



    $('[data-action="close"]').on("click", function () {
        $(this).closest(".card").removeClass().slideUp("fast");
    });

    $('[data-action="reload"]').on("click", function () {
        var e = $(this);
        e.parents(".card").addClass("card-load"),
            e.parents(".card").append('<div class="card-loader"><i class=" ti-reload rotate-refresh"></div>'),
            setTimeout(function () {
                e.parents(".card").children(".card-loader").remove(),
                    e.parents(".card").removeClass("card-load")
            }, 2000)
    });

    const headerHight = $('.header').innerHeight();

    $(window).scroll(function () {
        if ($('body').attr('data-layout') === "horizontal" && $('body').attr('data-header-position') === "static" && $('body').attr('data-sidebar-position') === "fixed")
            $(this.window).scrollTop() >= headerHight ? $('.deznav').addClass('fixed') : $('.deznav').removeClass('fixed')
    });


    jQuery('.dz-scroll').each(function () {

        var scroolWidgetId = jQuery(this).attr('id');
        const ps = new PerfectScrollbar('#' + scroolWidgetId, {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20
        });
    })

    jQuery('.metismenu > .mm-active ').each(function () {
        if (!jQuery(this).children('ul').length > 0) {
            jQuery(this).addClass('active-no-child');
        }
    });

    const qs = new PerfectScrollbar('.deznav-scroll');
    // const sr = new PerfectScrollbar('.sidebar-right-inner');


    //plugin bootstrap minus and plus
    $('.btn-number').on('click', function (e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus')
                input.val(currentVal - 1);
            else if (type == 'plus')
                input.val(currentVal + 1);
        } else {
            input.val(0);
        }
    });

})(jQuery);


$(document).ready(function () {

    // delete modal
    $(function () {
        $('[data-method]').on('click', function (e) {
            e.preventDefault();

            //form action
            var $action = $(this).attr('href');

            // manage form method
            $methodContent = '';
            $method = $(this).attr('data-method');

            if ($method == 'delete' || $method == 'DELETE') {
                $methodContent = '<input type="hidden" name="_method" value="DELETE">';
            } else if ($method == 'put' || $method == 'PUT') {
                $methodContent = '<input type="hidden" name="_method" value="DELETE">';
            } else if ($method == 'patch' || $method == 'PATCH') {
                $methodContent = '<input type="hidden" name="_method" value="PATCH">';
            }

            if ($action === undefined) {
                return true;
            }

            // mode content
            var $html = '<input name="_token" type="hidden" value="' + document.querySelector("meta[name='csrf-token']").content + '" >' + $methodContent + '<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title"></h5> <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> </div><div class="modal-body"></div><div class="modal-footer"><button type="submit" class="btn btn-primary text-white"></button></div></div></div></div>';

            //create form
            var form_id = 'tempform_' + Math.random().toString(36).substr(2, 9);
            let form_element = document.createElement('form');
            form_element.method = 'post';
            form_element.id = form_id;
            // form action
            form_element.action = $action;

            //csrf tock element
            form_element.innerHTML = $html;
            document.body.appendChild(form_element);

            $modal = $('#' + form_id + ' .modal');
            // change modal content
            $modal.find('.modal-title').html($(this).attr('data-confirm-title'));
            $modal.find('.modal-body').html($(this).attr('data-confirm-text'));
            $modal.find('.modal-footer button').text($(this).attr('data-confirm-button'));

            //change footer button for  delete action
            if ($method == 'delete' || $method == 'DELETE') {
                $modal.find('.modal-footer button').removeClass('btn-primary').addClass('btn-danger');
            }
            $modal.modal('show');
            //remove modal
            $modal.on('hidden.bs.modal', function (e) {
                e.target.parentNode.parentNode.removeChild(e.target.parentNode);
            });
        });
    });

    // change setting mail driver
    $(function () {
        $("[setting-tab='mail-smtp']").hide();
        if ($("#setting_mail_driver").val() === 'smtp') {
            $("[setting-tab='mail-smtp']").show();
        }

        $("#setting_mail_driver").on('change', function () {
            $("[setting-tab]").fadeOut();
            if ($(this).val() == 'smtp') {
                $("[setting-tab='mail-smtp']").fadeIn();
            }
        });
    });

    $('.popover-dismiss').popover({
        trigger: 'focus'
    })

    /**
     *  setting.
     */
    $("#app_settings [type='submit']").prop('disabled', false);

    $("#app_settings").on('submit', function (event) {

        // mail setting
        if (mailSettingPage !== undefined) {
            event.preventDefault();

            $(function () {
                $("#app_settings [type='submit']").html('Wait 15 seconds <i class="fas fa-spinner fa-pulse"></i>');
                $("#app_settings [type='submit']").prop('disabled', true);
            });

            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                async: false,
                cache: false,
                timeout: 9000,
                data: $(this).serialize(),
                dataType: 'json',
                success: function () {
                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                    return;
                },
                error: function () {
                    setTimeout(function () {
                        location.reload();
                    }, 15000);
                    return;
                }
            });
        }
    });

    //gradient line chart registrationHistoryChart
    if (jQuery('#registrationHistoryChart').length > 0) {
        let draw = Chart.controllers.line.__super__.draw; //draw shadow

        const registrationHistoryChart = document.getElementById("registrationHistoryChart").getContext('2d');
        //generate gradient
        const registrationHistoryChartgradientStroke = registrationHistoryChart.createLinearGradient(500, 0, 100, 0);
        registrationHistoryChartgradientStroke.addColorStop(0, "rgba(26, 51, 213, 1)");
        registrationHistoryChartgradientStroke.addColorStop(1, "rgba(26, 51, 213, 0.5)");

        registrationHistoryChart.height = 100;

        new Chart(registrationHistoryChart, {
            type: 'line',
            data: {
                defaultFontFamily: 'Poppins',
                labels: chartjs.label,

                datasets: [
                    {
                        label: "New Users",
                        data: chartjs.value,
                        borderColor: registrationHistoryChartgradientStroke,
                        borderWidth: "2",
                        backgroundColor: 'transparent',
                        pointBackgroundColor: 'rgba(26, 51, 213, 0.5)'
                    }
                ]
            },
            options: {
                legend: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: 50,
                            min: 0,
                            stepSize: 5,
                            padding: 10
                        }
                    }]
                }
            }
        });
    }

    if (jQuery('#loginByOparationSys').length > 0) {
        //doughut chart
        const loginByOparationSys = document.getElementById("loginByOparationSys").getContext('2d');
        loginByOparationSys.height = 100;
        new Chart(loginByOparationSys, {
            type: 'doughnut',
            data: loginPieChart,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        })
    }

    /**
     * Menu Builder
     */
    if ($("#menu-form-modal").length > 0) {

        /**
         * Set Variables
         */
        var $m_modal = document.getElementById('menu-form-modal'),
            $m_url_type = $('#m_url_type'),
            $m_link_type = $('#m_link_type'),
            $m_route_type = $('#m_route_type');

        /**
         * Hangle modal and form
         * @return void
         */
        $m_modal.addEventListener('hide.bs.modal', function (event) {
            $(this).parent('form').attr('action', $('[data-bs-target="#menu-form-modal"]').attr('href'));
            $(this).find(".modal-title").html("Add Menu Item")
            $(this).find("input[name='title']").val("");
            $(this).find("input[name='url']").val("");
            $(this).find("input[name='icon']").val("");
            $(this).find("button[type='submit']").html("Save");
            $(this).find("select option[value='_self']").prop("selected", true);

        })


        /**
         * Edit Menu
         */
        $('.item_actions').on('click', '.edit', function (e) {

            $("#menu-form-modal").parent('form').attr('action', $(this).attr('href'));
            $("#menu-form-modal .modal-title").html("Update Menu Item")
            $("#menu-form-modal input[name='title']").val($(this).attr('data-title'));
            $("#menu-form-modal input[name='url']").val($(this).attr('data-url'));
            $("#menu-form-modal input[name='icon_class']").val($(this).attr('data-icon_class'));
            $("#menu-form-modal select option[value^='" + $(this).attr('data-target') + "']").prop("selected", true);
            $("#menu-form-modal").find("button[type=submit]").html('Update');
            var bsModal = new bootstrap.Modal($m_modal, {});
            bsModal.show();
        });

        /**
         * Toggle Form Menu Type
         */
        $m_link_type.on('change', function (e) {
            if ($m_link_type.val() == 'route') {
                $m_url_type.hide();
                $m_route_type.show();
            } else {
                $m_url_type.show();
                $m_route_type.hide();
            }
        });
    }

});

/**
 * show delete modal
 * @param {*} action
 */
function xDelete(action) {
    var form_id = '_' + Math.random().toString(36).substr(2, 9);

    var r = confirm("Do You Want to Conform Delete");
    if (r == true && action) {

        var form_id = '_' + Math.random().toString(36).substr(2, 9);

        //create form
        let form_element = document.createElement('form');
        form_element.method = 'post';
        form_element.id = form_id;
        // form action
        form_element.action = action;
        const csrftocken = document.querySelector("meta[name='csrf-token']").content;

        //csrf tock element
        form_element.innerHTML = '<input type="hidden" name="_token" value="' + csrftocken + '" />\n' +
            '<input type="hidden" name="_method" value="DELETE" />';
        document.body.appendChild(form_element);

        var frm = document.getElementById(form_id);
        frm.submit();
    }
}

