
$(document).ready(function () {

    function open_media(media_target) {

        const d = new Date();
        var uploadPath = d.getFullYear() + "/" + d.getMonth() + 1,
            uploadPathLabel = d.getFullYear() + " " + d.toLocaleString('default', { month: 'long' });

        // mode content
        var $html = '' +
            '<div class="modal fade" tabindex="-1">' +
            '   <div class="modal-dialog modal-xl">' +
            '       <div class="modal-content">' +
            '           <div class="modal-body  p-0">' +
            '               <ul class="nav nav-tabs mx-3 mt-3">' +
            '                   <li class="nav-item">' +
            '                       <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#du-media-file-tab" type="button">Media files</button>' +
            '                   </li>' +
            '                   <li class="nav-item" role="presentation">' +
            '                       <button class="nav-link" data-bs-toggle="tab" data-bs-target="#du-media-upload-tab" type="button">Upload files</button>' +
            '                   </li>' +
            '               </ul>' +
            '               <div class="tab-content  mx-3">' +
            '                   <div class="tab-pane fade show active" id="du-media-file-tab">' +
            '                       <div class="row">' +
            '                           <div class="col">' +
            '                               <div class="row">' +
            '                                   <div class="col-sm-12">' +
            '                                     <div class="col-sm-12 d-inline-flex m-2">' +
            '                                         <button type="button" id="du-media-filter-refresh" class="btn btn-outline-primary mr-2">Refresh</button>&nbsp;&nbsp;' +
            '                                         <select class="form-control" id="du-media-filter-select">' +
            '                                             <option selected value="' + uploadPath + '">' + uploadPathLabel + '</option>' +
            '                                         </select>' +
            '                                     </div>' +
            '                                   </div>' +
            '                                   <div id="du-media-files-contents" class="col-sm-12"></div>' +
            '                               </div>' +
            '                           </div>' +
            '                           <div id="du-media-files-sidebar" class="col-md-3 col-sm-12 d-none d-sm-none d-md-block">' +
            '                               ' +
            '                           </div>' +
            '                       </div>' +
            '                   </div>' +
            '                   <div class="tab-pane fade text-center" id="du-media-upload-tab">' +
            '                       <div class="m-3">' +
            '                           <form class="dropzone">' +
            '                           </form>' +
            '                       </div>' +
            '                   </div>' +
            '               </div>' +
            '           </div>' +
            '           <div id="du-media-footer" class="modal-footer">' +
            '               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' +
            '               <button id="du-media-insert-btn" type="button" class="btn btn-primary float-end" disabled>Insert</button>' +
            '           </div>' +
            '       </div>' +
            '   </div>' +
            '</div>';

        //create form
        var form_id = 'tempform_' + Math.random().toString(36).substr(2, 9);
        let form_element = document.createElement('div');
        form_element.id = form_id;
        // form action

        //csrf tock element
        form_element.innerHTML = $html;
        document.body.appendChild(form_element);

        $media = $('#' + form_id + ' .modal');
        // change modal content
        $media.find('.modal-body').html($(this).attr('data-confirm-text'));

        // du-media-files-contents
        $media.fileNotFound = function () {
            $media.find("#du-media-files-contents").html('<div class="text-center text-danger m-5 p-5"><i class="fas fa-10x fa-adjust fa-10x"></i><p class="pt-3">Media files empty</p></div>');
        }
        // Error du-media-files-contents
        $media.error = function () {
            $media.find("#du-media-files-contents").html('<div class="text-center m-5 p-5"><i class="fas fa-10x fa-exclamation-triangle"></i></div>');
        }
        // loadign du-media-files
        $media.loading = function () {
            $media.find("#du-media-files-contents").html('<div class="text-center m-5 p-5"><i class="fas fa-sync fa-10x fa-spin"></i></div>');
        }
        //fixedFileUrl
        $media.fixedFileUrl = function (file) {
            var extension = new Array('png', 'jpg', 'jpeg', 'gif', 'ico');
            if (extension.indexOf(file.extension) != -1) {
                return '<img src="' + file.url + '" class="img-thumbnail" alt="">';
            }
            return '<div class="img-thumbnail"><i class="fas fa-file"></i></div>';
        }

        /**
         *  Get files form server
         * @param {Date} year
         * @param {Date} month
         */
        $media.getFiles = function (year = null, month = null) {

            $media.removeSidebar();
            $media.loading();
            $media.find("#du-media-insert-btn").prop("disabled", true);

            const d = new Date();
            if (year == null) {
                year = d.getFullYear();
            }
            if (month == null) {
                month = d.getMonth() + 1;
            }
            var url = $('head base').attr('href') + "/admin/media/?year=" + year + '&month=' + month;

            $.get(url).done(function (data) {
                var files = data.files;
                if (data.files !== undefined && files.length > 0) {
                    var content = "";
                    for (let index = 0; index < files.length; index++) {
                        var fileIconOrImage = $media.fixedFileUrl(files[index].attributes);
                        content += '<div media-path="' + files[index].attributes.path + '">' +
                            fileIconOrImage +
                            '</div>';
                    }
                    $media.find("#du-media-files-contents").html(content);

                } else {
                    $media.fileNotFound();
                }

                // Get the array of keys
                var directories = data.directories;
                if (directories !== undefined) {
                    var content = "";
                    $.each(directories, function (key, value) {
                        content += '<option value="' + key + '">' + value + '</option>';
                    });
                    $media.find("#du-media-filter-select").html(content);
                    // ensure select options
                    $media.find("#du-media-filter-select").find("option[value='" + year + '/' + month + "']").prop({ defaultSelected: true });
                }
            }).fail(function () {
                $media.error();
            })

        }

        // refresh
        $media.find("#du-media-filter-refresh").on('click', function (e) {
            e.preventDefault();
            $media.getFiles();
        });

        //du-media-filter-select
        $media.find("#du-media-filter-select").on('change', function () {
            var date = $(this).val().split('/');
            $media.getFiles(date[0], date[1]);
        });

        // tabs
        $media.find(".nav-tabs").on('shown.bs.tab', function (event) {
            $media.find(".modal-footer").show();
            if (event.target.getAttribute('data-bs-target') === '#du-media-upload-tab') {
                $media.find(".modal-footer").hide();
            }
        });

        // make sidevar
        $media.sidebarContent = function (image_url) {
            return '' +
                ' <div class="text-center my-3">' +
                '<img src="' + image_url + '" class="img-thumbnail" alt="">' +
                '</div>' +
                '<hr/>' +
                '<div class="mb-3">' +
                '   <label>Full url</lavel>' +
                '   <input class="form-control" value="' + image_url + '" readonly />' +
                '</div>';
        }

        // remove sidevar
        $media.removeSidebar = function () {
            $media.find("#du-media-files-sidebar").html("");
        }

        // insert image
        $media.find("#du-media-insert-btn").on('click', function () {

            // e.preventDefault();
            // if(typeof $(this).attr("disabled") === 'undefined'){
            //     // return true;
            // }

            if ($("#du-media-files-contents").find("[media-path]").length > 0) {
                var insert = "/uploads/" + $("#du-media-files-contents").find(".chosen[media-path]").attr('media-path');
                $(media_target).find("input").val(insert);
                $(media_target).find("img").remove();

                $(media_target).addClass("media-picker-repaid").removeClass("media-picker");
                $(media_target).append('<img src="' + insert + '" />');
                $media.find('#du-media-footer [data-bs-dismiss]').click();
            }
        });

        $media.modal('show');
        $media.getFiles();

        // sidebar oparation
        $("#du-media-files-contents").delegate("[media-path]", "click", function () {
            $(this).parent().find('.chosen').removeClass('chosen');
            $(this).toggleClass("chosen");
            var image_url = $('head base').attr('href') + "/uploads/" + $(this).attr('media-path');

            $media.find("#du-media-files-sidebar").html($media.sidebarContent(image_url));

            // insert oparation
            $media.find("#du-media-insert-btn").prop("disabled", false);
        });

        // jQuery
        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(".modal-body #du-media-upload-tab form", {
            maxFilesize: 10,  // 3 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
            url: $('head base').attr('href') + '/admin/media/',
            // addRemoveLinks: true,
            success: function (file, response) {
                file.previewElement.classList.add("dz-success");

                if(response['alert-type'] == 'error'){
                    toastr.error(response['message']);
                    this.removeFile(file);
                }else{
                    $media.getFiles();
                }
            },
            error: function (file, response) {
                file.previewElement.classList.add("dz-error", response);
                alert("upload Fails");
            },
        });
        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
        });

        //remove modal
        $media.on('hidden.bs.modal', function (e) {
            e.target.parentNode.parentNode.removeChild(e.target.parentNode);
        });
    }

    // render
    if ($(".du-media-image").find("input").length > 0) {
        $(".du-media-image").append(getUploaderContent);
    }

    // image image
    $(".media-picker-repaid").on('click', function () {
        $(this).find('img').remove();
        $(this).find('input').val('');
        $(this).removeClass('media-picker-repaid').addClass('media-picker');
    });

    // open media picker
    $(".media-picker, .media-picker-repaid").on('click', function () {
        if ($(this).hasClass('media-picker-repaid')) {
            $(this).find('img').remove();
            $(this).find('input').val('');
            $(this).removeClass('media-picker-repaid').addClass('media-picker');
        } else {
            open_media($(this));
        }
    });

});


/**
 * Seo card
 */
$(document).ready(function () {
    if ($("#seo-card").length > 0 && $("#post-type").length > 0) {

        $("#seo-card #GetPrimaryMetaTagsBtn").on('click', function () {
            // title
            var title = $("#post-type [name='title']").val();
            var description = $("#post-type [name='summary']").val();

            // change seo value
            $("#seo-card [name='seo[title]']").val(title)
            $("#seo-card [name='seo[description]']").val(description)

        });

        $("#seo-card #GetOgMetaTagsBtn").on('click', function () {
            // title
            var title = $("#seo-card [name='seo[title]']").val()
            var description = $("#seo-card [name='seo[description]']").val()

            // remove image data
            if ($('#seo-card #seoTwo .media-picker-repaid img')) {
                $('#seo-card #seoTwo .media-picker-repaid img').remove();
                $('#seo-card #seoTwo .media-picker-repaid input').val('');
                $('#seo-card #seoTwo .media-picker-repaid').removeClass('media-picker-repaid').addClass("media-picker");
            }

            // append image
            if ($("#post-thumbnail img[src]").length > 0) {
                var image = $("#post-thumbnail img[src]").attr('src');
                $('#seo-card #seoTwo .media-picker input').val(image);
                $('#seo-card #seoTwo .media-picker').append('<img src="' + image + '" />');
                $('#seo-card #seoTwo .media-picker').addClass('media-picker-repaid').removeClass("media-picker");
            }

            // change seo value
            $("#seo-card [name='seo[og_title]']").val(title)
            $("#seo-card [name='seo[og_description]']").val(description)
        });

        $("#seo-card #GetTwitterMetaTagsBtn").on('click', function () {
            // title
            var title = $("#seo-card [name='seo[og_title]']").val()
            var description = $("#seo-card [name='seo[og_description]']").val()


            // remove image data
            if ($('#seo-card #seoThree .media-picker-repaid img')) {
                $('#seo-card #seoThree .media-picker-repaid img').remove();
                $('#seo-card #seoThree .media-picker-repaid input').val('');
                $('#seo-card #seoThree .media-picker-repaid').removeClass('media-picker-repaid').addClass("media-picker");
            }

            // append image
            if ($("#post-thumbnail img[src]").length > 0) {
                var image = $("#post-thumbnail img[src]").attr('src');
                $('#seo-card #seoThree .media-picker input').val(image);
                $('#seo-card #seoThree .media-picker').append('<img src="' + image + '" />');
                $('#seo-card #seoThree .media-picker').addClass('media-picker-repaid').removeClass("media-picker");
            }

            // change seo value
            $("#seo-card [name='seo[twitter_title]']").val(title)
            $("#seo-card [name='seo[twitter_description]']").val(description)
        });

    }


    // slug
    $(function () {
        if ($("input[name='slug']").length > 0 && typeof $("input[name='slug']").attr('target-id') !== 'undefined') {
            var id = $("input[name='slug']").attr('target-id');
            $("input[name='slug']").slugify('#' + id + "");
        }

        $("#seo-card-body-toggle").on('click', function () {
            $(".seo-card-body").toggle("d-none");
        });
    });
});
