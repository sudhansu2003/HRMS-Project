/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

$(document).ready(function () {
    if ($(".dataTable").length > 0) {
        $(".dataTable").dataTable({
            language: dataTabelLang,
        });
    }

    if ($(".datepicker").length > 0) {
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            format: 'yyyy-mm-dd',
            locale: date_picker_locale,
        });
    }

    if ($(".timepicker_format").length > 0) {
        $('.timepicker_format').timepicker({
            showMeridian: false,
            minuteStep: 5,

        });
    }

    if ($(".select2").length > 0) {
        $(".select2").select2({
            disableOnMobile: false,
            nativeOnMobile: false
        });
    }

    if ($(".summernote-simple").length) {
        $('.summernote-simple').summernote();
    }

    // for Choose file
    $(document).on('change', 'input[type=file]', function () {
        var fileclass = $(this).attr('data-filename');
        var finalname = $(this).val().split('\\').pop();
        $('.' + fileclass).html(finalname);
    });
})

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function show_toastr(title, message, type) {
    var o, i;
    var icon = '';
    var cls = '';

    if (type == 'success') {
        icon = 'fas fa-check-circle';
        cls = 'success';
    } else {
        icon = 'fas fa-times-circle';
        cls = 'danger';
    }

    $.notify({icon: icon, title: " " + title, message: message, url: ""}, {
        element: "body",
        type: cls,
        allow_dismiss: !0,
        placement: {
            from: 'top',
            align: toster_pos
        },
        offset: {x: 15, y: 15},
        spacing: 10,
        z_index: 1080,
        delay: 2500,
        timer: 2000,
        url_target: "_blank",
        mouse_over: !1,
        animate: {enter: o, exit: i},
        template: '<div class="alert alert-{0} alert-icon alert-group alert-notify" data-notify="container" role="alert"><div class="alert-group-prepend alert-content"><span class="alert-group-icon"><i data-notify="icon"></i></span></div><div class="alert-content"><strong data-notify="title">{1}</strong><div data-notify="message">{2}</div></div><button type="button" class="close" data-notify="dismiss" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
    });
}

$(document).on('click', 'a[data-ajax-popup="true"], button[data-ajax-popup="true"], div[data-ajax-popup="true"]', function () {

    // alert('asd');
    var title = $(this).data('title');
    var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');
    var url = $(this).data('url');


    $("#commonModal .modal-title").html(title);
    $("#commonModal .modal-dialog").addClass('modal-' + size);
    $.ajax({
        url: url,
        success: function (data) {


            // alert(data);
            // return false;
            if (data.length) {
                $('#commonModal .modal-body').html(data);
                $("#commonModal").modal('show');
                common_bind();
                ddatetime_range();

                // common_bind_select();
            } else {
                show_toastr('Error', 'Permission denied', 'error');
                $("#commonModal").modal('hide');
            }
        },
        error: function (data) {

            data = data.responseJSON;
            show_toastr('Error', data.error, 'error');
        }
    });
});

$(document).on('click', '.fc-day-grid-event', function(e) {
    // if (!$(this).hasClass('project')) {
    e.preventDefault();
    var event = $(this);
    var title = $(this).find('.fc-content .fc-title').html();
    var size = 'md';
    var url = $(this).attr('href');
    $("#commonModal .modal-title").html(title);
    $("#commonModal .modal-dialog").addClass('modal-' + size);
    $.ajax({
        url: url,
        success: function(data) {
            $('#commonModal .modal-body').html(data);
            $("#commonModal").modal('show');
            common_bind();
        },
        error: function(data) {
            data = data.responseJSON;
            toastrs('Error', data.error, 'error')
        }
    });
    // }
});


(function ($, window, i) {
    // Bootstrap 4 Modal
    $.fn.fireModal = function (options) {
        var options = $.extend({
            size: 'modal-md',
            center: false,
            animation: true,
            title: 'Modal Title',
            closeButton: false,
            header: true,
            bodyClass: '',
            footerClass: '',
            body: '',
            buttons: [],
            autoFocus: true,
            created: function () {
            },
            appended: function () {
            },
            onFormSubmit: function () {
            },
            modal: {}
        }, options);
        this.each(function () {
            i++;
            var id = 'fire-modal-' + i,
                trigger_class = 'trigger--' + id,
                trigger_button = $('.' + trigger_class);
            $(this).addClass(trigger_class);
            // Get modal body
            let body = options.body;
            if (typeof body == 'object') {
                if (body.length) {
                    let part = body;
                    body = body.removeAttr('id').clone().removeClass('modal-part');
                    part.remove();
                } else {
                    body = '<div class="text-danger">Modal part element not found!</div>';
                }
            }
            // Modal base template
            var modal_template = '   <div class="modal' + (options.animation == true ? ' fade' : '') + '" tabindex="-1" role="dialog" id="' + id + '">  ' +
                '     <div class="modal-dialog ' + options.size + (options.center ? ' modal-dialog-centered' : '') + '" role="document">  ' +
                '       <div class="modal-content">  ' +
                ((options.header == true) ?
                    '         <div class="modal-header">  ' +
                    '           <h5 class="modal-title mx-auto">' + options.title + '</h5>  ' +
                    ((options.closeButton == true) ?
                        '           <button type="button" class="close" data-dismiss="modal" aria-label="Close">  ' +
                        '             <span aria-hidden="true">&times;</span>  ' +
                        '           </button>  '
                        : '') +
                    '         </div>  '
                    : '') +
                '         <div class="modal-body text-center text-dark">  ' +
                '         </div>  ' +
                (options.buttons.length > 0 ?
                    '         <div class="modal-footer mx-auto">  ' +
                    '         </div>  '
                    : '') +
                '       </div>  ' +
                '     </div>  ' +
                '  </div>  ';
            // Convert modal to object
            var modal_template = $(modal_template);
            // Start creating buttons from 'buttons' option
            var this_button;
            options.buttons.forEach(function (item) {
                // get option 'id'
                let id = "id" in item ? item.id : '';
                // Button template
                this_button = '<button type="' + ("submit" in item && item.submit == true ? 'submit' : 'button') + '" class="' + item.class + '" id="' + id + '">' + item.text + '</button>';
                // add click event to the button
                this_button = $(this_button).off('click').on("click", function () {
                    // execute function from 'handler' option
                    item.handler.call(this, modal_template);
                });
                // append generated buttons to the modal footer
                $(modal_template).find('.modal-footer').append(this_button);
            });
            // append a given body to the modal
            $(modal_template).find('.modal-body').append(body);
            // add additional body class
            if (options.bodyClass) $(modal_template).find('.modal-body').addClass(options.bodyClass);
            // add footer body class
            if (options.footerClass) $(modal_template).find('.modal-footer').addClass(options.footerClass);
            // execute 'created' callback
            options.created.call(this, modal_template, options);
            // modal form and submit form button
            let modal_form = $(modal_template).find('.modal-body form'),
                form_submit_btn = modal_template.find('button[type=submit]');
            // append generated modal to the body
            $("body").append(modal_template);
            // execute 'appended' callback
            options.appended.call(this, $('#' + id), modal_form, options);
            // if modal contains form elements
            if (modal_form.length) {
                // if `autoFocus` option is true
                if (options.autoFocus) {
                    // when modal is shown
                    $(modal_template).on('shown.bs.modal', function () {
                        // if type of `autoFocus` option is `boolean`
                        if (typeof options.autoFocus == 'boolean')
                            modal_form.find('input:eq(0)').focus(); // the first input element will be focused
                        // if type of `autoFocus` option is `string` and `autoFocus` option is an HTML element
                        else if (typeof options.autoFocus == 'string' && modal_form.find(options.autoFocus).length)
                            modal_form.find(options.autoFocus).focus(); // find elements and focus on that
                    });
                }
                // form object
                let form_object = {
                    startProgress: function () {
                        modal_template.addClass('modal-progress');
                    },
                    stopProgress: function () {
                        modal_template.removeClass('modal-progress');
                    }
                };
                // if form is not contains button element
                if (!modal_form.find('button').length) $(modal_form).append('<button class="d-none" id="' + id + '-submit"></button>');
                // add click event
                form_submit_btn.click(function () {
                    modal_form.submit();
                });
                // add submit event
                modal_form.submit(function (e) {
                    // start form progress
                    form_object.startProgress();
                    // execute `onFormSubmit` callback
                    options.onFormSubmit.call(this, modal_template, e, form_object);
                });
            }
            $(document).on("click", '.' + trigger_class, function () {
                $('#' + id).modal(options.modal);
                return false;
            });
        });
    }
    // Bootstrap Modal Destroyer
    $.destroyModal = function (modal) {
        modal.modal('hide');
        modal.on('hidden.bs.modal', function () {
        });
    }
})(jQuery, this, 0);

$('[data-confirm]').each(function () {

    var me = $(this),
        me_data = me.data('confirm');

    me_data = me_data.split("|");
    me.fireModal({
        title: me_data[0],
        body: me_data[1],
        buttons: [
            {
                text: me.data('confirm-text-yes') || 'Yes',
                class: 'btn btn-sm btn-danger rounded-pill',
                handler: function () {
                    eval(me.data('confirm-yes'));
                }
            },
            {
                text: me.data('confirm-text-cancel') || 'Cancel',
                class: 'btn btn-sm btn-secondary rounded-pill',
                handler: function (modal) {
                    $.destroyModal(modal);
                    eval(me.data('confirm-no'));
                }
            }
        ]
    })
});

function common_bind() {


    if ($(".datepicker").length) {
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            format: 'yyyy-mm-dd',
            locale: date_picker_locale,
        });
    }


    if (jQuery().select2) {
        $(".select2").select2({
            disableOnMobile: false,
            nativeOnMobile: false
        });
    }

    $('.timepicker').timepicker({
        showMeridian: false,
        minuteStep: 5,
    });


    if ($(".select2").length > 0) {
        $(".select2").select2({
            disableOnMobile: false,
            nativeOnMobile: false
        });
    }

    if ($(".custom-datepicker").length) {
        $('.custom-datepicker').daterangepicker({
            singleDatePicker: true,
            format: 'Y-MM',
            locale: {
                format: 'Y-MM'
            }
        });

    }
  

}
