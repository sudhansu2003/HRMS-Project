@php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_favicon=Utility::getValByName('company_favicon');
    $image_path=asset(Storage::url('uploads/custom_landing_page_image/'));
@endphp
    <!DOCTYPE html>
<html lang="en" dir="{{env('SITE_RTL') == 'on'?'rtl':''}}">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'HRMGo')}}</title>
    <link rel="icon" href="{{$logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')}}" type="image" sizes="16x16">
    <!-- Landing External CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('landing/css/font-awesome.min.css') }}">
    <link href="{{ asset('landing/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('landing/css/style.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('landing/css/responsive.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('landing/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" media="all">
    <script src="{{ asset('landing/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('landing/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('landing/js/script.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    @if(env('SITE_RTL')=='on')
        <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.css') }}">
    @endif
    <style type="text/css">
        body {
            padding-right: unset !important;
        }
    </style>
</head>
<body>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });


    function show_content(id) {
        $.ajax({
            type: 'GET',
            url: `{{ url("/LandingPage/show") }}/${id}`,
            success: function (data) {
                if (data == "error") {

                } else {
                    var object = JSON.parse(data);
                    var section_id = object.id;
                    var section_type = `section-${section_id}`;
                    var section_name = object.section_name;
                    $(".tooltip1").hover(function (e) {
                        var x = $(this).position();
                        $(this).find(`#ul-${section_type}`).find('.tooltip1text').css({'top': x.top});
                        $(this).find(`#ul-${section_type}`).find('.tooltip1text').css("visibility", "visible");
                        $(this).find(`#ul-${section_type}`).find('.tooltip1text').css("opacity", 1);
                    });
                    $(".tooltip1").mouseleave(function (e) {
                        $(this).find(`#ul-${section_type}`).find('.tooltip1text').css({'top': 'unset'});
                        $(this).find(`#ul-${section_type}`).find('.tooltip1text').css("visibility", "hidden");
                        $(this).find(`#ul-${section_type}`).find('.tooltip1text').css("opacity", 0);
                    });
                    var section_id = object.id;
                    var section_type = `section-${section_id}`;
                    var section_name = object.section_name;
                    if (object.section_type != "section-plan") {
                        var content = JSON.parse(object.content);
                        var key = Object.keys(content);
                        $(`#${section_type}`).find(`#section_id`).val(section_id);
                        key.forEach(function (val) {
                            if (val == "custom_class_name") {
                                $(`#setting-modal-section-${section_id}`).find(`#${val}`).val(content[val]);
                                $(`#${section_type}`).addClass(content[val]);
                            }
                            if (val == "logo") {
                                $(`#${section_type}`).find(`#${val}`).attr('src', `{{$image_path.'/${content[val]}'}}`);
                                $(`#setting-modal-section-${section_id}`).find(`#${val}`).find('img').attr('src', `{{$image_path.'/${content[val]}'}}`);
                            }
                            if (val == "image") {
                                $(`#${section_type}`).find(`#${val}`).attr('src', `{{$image_path.'/${content[val]}'}}`);
                                $(`#setting-modal-section-${section_id}`).find(`#${val}`).find('img').attr('src', `{{$image_path.'/${content[val]}'}}`);
                            }
                            var img_change_btn = $(`#setting-modal-section-${section_id}`).find(`#${val}`).find('a');
                            var file_input = $(`#setting-modal-section-${section_id}`).find(`#${val}`).find('input');
                            img_change_btn.click(function () {
                                file_input.trigger('click');
                            });
                            file_input.change(function () {
                                var url = this.value;
                                var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                                if (this.files && this.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $(`#setting-modal-section-${section_id}`).find(`#${val}`).find('img').attr('src', e.target.result);
                                        $(`#${section_type}`).find(`#${val}`).attr('src', e.target.result);
                                    }

                                    reader.readAsDataURL(this.files[0]);
                                } else {
                                    $(`#setting-modal-section-${section_id}`).find(`#${val}`).find('img').attr('src', '/assets/no_preview.png');
                                    $(`#${section_type}`).find(`#${val}`).attr('src', '/assets/no_preview.png');
                                }
                            });
                            if (val == "button") {
                                $(`#${section_type}`).find(`#${val}`).html(content[val].text);

                                if (section_type == "section-1") {

                                    //$(`#${section_type}`).find(`#${val}`).attr('href', "{{ route('login') }}");
                                } else {
                                    $(`#${section_type}`).find(`#${val}`).attr('href', content[val].href);
                                }

                                $(`#setting-modal-section-${section_id}`).find(`#${val}`).find(`input[name="button[text]"]`).val(content[val].text);
                                $(`#setting-modal-section-${section_id}`).find(`#${val}`).find(`input[name="button[href]"]`).val(content[val].href);
                                $(`#setting-modal-section-${section_id}`).find(`#${val}`).find(`input[name="button[text]"]`).keyup(function () {
                                    var text_value = $(`#setting-modal-section-${section_id}`).find(`#${val}`).find(`input[name="button[text]"]`).val();
                                    $(`#${section_type}`).find(`#${val}`).html(text_value);
                                });
                                $(`#setting-modal-section-${section_id}`).find(`#${val}`).find('input[name="button_href"]').change(function () {
                                    var href_value = $(`#setting-modal-section-${section_id}`).find(`#${val}`).find(`input[name="button[href]"]`).val();
                                    $(`#${section_type}`).find(`#${val}`).attr('href', href_value);
                                });
                            }
                            if (val == "menu") {
                                var menu_html = '';
                                var menu = content[val];
                                var input_menu_html = '';
                                var no = 1;
                                menu.forEach(function (val) {
                                    if (object.section_type == "section-9") {
                                        menu_html += `<div class="col-lg-3 col-sm-6 inner-text">
                                                        <div class="links">
                                                            <a href="${val.href}" id="${val.menu}">${val.menu}</a>
                                                        </div>
                                                    </div>`;
                                    } else {
                                        menu_html += `<li>
                                            <a href="${val.href}" id="${val.menu}">${val.menu}</a>
                                        </li>`;
                                    }
                                    input_menu_html += `<div id="inputFormRow">
                                        <div class="input-group mb-3">
                                        <input type="text" name="menu_name[${no}][text]" class="form-control m-input" placeholder="menu name" autocomplete="off" value="${val.menu}" id="${val.menu}">
                                        <input type="text" name="menu_name[${no}][href]" class="form-control" placeholder="link" style="background-color:#b7d0ef;" value="${val.href}"/>
                                        <div class="input-group-append">
                                        <button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                        </div></div>`;
                                    no++;
                                });
                                $(`#${section_type}`).find(`#${val}`).html(menu_html);
                                $(`#setting-modal-section-${section_id}`).find(`#${val}`).html(input_menu_html);
                                menu.forEach(function (val) {
                                    $(`#setting-modal-section-${section_id}`).find(`#${val.menu}`).keyup(function () {
                                        var text_value = $(`#setting-modal-section-${section_id}`).find(`#${val.menu}`).val();
                                        $(`#${section_type}`).find(`#${val.menu}`).html(text_value);
                                    });
                                });
                                // remove row
                                $(document).on('click', '#removeRow', function () {
                                    $(this).closest('#inputFormRow').remove();
                                });
                                var add_row_no = no + 1;
                                $("#addRow").click(function () {
                                    var html = `<div id="inputFormRow">
                                        <div class="input-group mb-3">
                                        <input type="text" name="menu_name[${add_row_no}][text]" class="form-control m-input" placeholder="menu name" autocomplete="off">
                                        <input type="text" name="menu_name[${add_row_no}][href]" class="form-control" placeholder="link" style="background-color:#b7d0ef;"/>
                                        <div class="input-group-append">
                                        <button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                        </div>
                                    </div>`;
                                    $(`#setting-modal-section-${section_id}`).find(`#${val}`).append(html);
                                });

                            }
                            if (val == "text") {
                                var menu_key = Object.keys(content[val]);
                                menu_key.forEach(function (element) {


                                    $(`#${section_type}`).find(`#${element}`).html(content[val][element]);
                                    $(`#setting-modal-section-${section_id}`).find(`#${element}`).val(content[val][element]);
                                    $(`#setting-modal-section-${section_id}`).find(`#${element}`).keyup(function () {
                                        var text_value = $(`#setting-modal-section-${section_id}`).find(`#${element}`).val();
                                        $(`#${section_type}`).find(`#${element}`).html(text_value);
                                    });
                                });
                            }
                            if (val == "image_array") {
                                var image_array = content[val];
                                var html = ``;
                                var modal_html = ``;

                                image_array.forEach(function (element) {
                                    html += `<div class="col-auto">
                                                <img src="{{$image_path.'/${element.image}'}}" alt="" id="section_logo_part_${section_id}_${element.id}">
                                            </div>`;

                                    modal_html += `<div class="form-group">
                                                <img src="{{$image_path.'/${element.image}'}}" class="imagepreview mb-2" id="logo_part_${section_id}_${element.id}">
                                                <input type="file" style="display:none" name="image_array[${element.id}]" class="logo_part_${section_id}_${element.id}"/>
                                                <a class="btn btn btn-info" href="javascript:void(0);" onclick="selectFile('logo_part_${section_id}_${element.id}')">Change</a>
                                                </div>`;

                                });
                                $(`#${section_type}`).find(`#${val}`).html(html);
                                $(`#setting-modal-section-${section_id}`).find(`#${val}`).html(modal_html);
                            }
                            if (val == "system") {
                                var system = content[val];
                                var tab_html = '';
                                var tab_content = '';
                                var no = 1;
                                var collpse_html = ``;
                                $(`#setting-modal-section-${section_id}`).find('#add_class_btn').click(function () {
                                    system_add_conetent('testnomial_add_class_form', section_id)
                                });
                                system.forEach(function (element) {
                                    var tab_content_div = '';
                                    var li_id = element.name + '_' + element.id + '_' + section_id;
                                    var active_class = "";
                                    var tab_active = "tab-pane fade";
                                    if (no == 1) {
                                        active_class = "active";
                                        tab_active = "tab-pane in active";
                                    }

                                    tab_html += `<li><a data-toggle="tab" href="#${li_id}" class="${active_class}">${element.name}</a></li>`;
                                    tab_content += `<div id="${li_id}" class="${tab_active}">
                                                            <div class="row">`;
                                    collpse_html += `<div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <div class="row">
                                                                <div class="col-9">
                                                                    <h5 class="mb-0">
                                                                    <a class="btn btn-link" data-toggle="collapse" data-target="#collapse_${li_id}" aria-expanded="true" aria-controls="collapseOne">${element.name}</a>
                                                                    </h5>
                                                                </div>
                                                                <div class="col-3">
                                                                    <a class="btn btn-warning" href="javascript:void(0)"><i class="fa fa-trash" aria-hidden="true" onclick="remove_system_element(${element.id},'','remove_element',${section_id})"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="collapse_${li_id}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                            <div class="card-body" id="tab_image_${li_id}">
                                                                <div class="row">`;

                                    var tab_collaps_html = ``;

                                    element.data.forEach(function (data) {

                                        tab_content_div += `<div class="col-lg-4 col-sm-6 col-md-6">
                                            <div class="panal-1">
                                                <figure><img alt="data-1" src="{{$image_path.'/${data.image}'}}" id="section_system_img_${element.id}_${data.data_id}"><figcaption>
                                                        <div class="contant-tab">
                                                            <h5>${data.text.text_1}</h5>
                                                            <p>${data.text.text_2}</p>
                                                        </div>
                                                        <a href="${data.button.href}" class="button">${data.button.text}</a>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </div>`;

                                        tab_collaps_html += `<form enctype="multipart/form-data" id="form_system_${element.id}_${data.data_id}"><div class="col-lg-12">
                                                        <div class="tab-modal-img">
                                                            <img alt="data-1" src="{{$image_path.'/${data.image}'}}" id="system_img_${element.id}_${data.data_id}">
                                                            <a class="topright btn btn-primary" href="javascript:void(0)" data-toggle="collapse" data-target="#img_collapse_${data.data_id}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            <a class="topright btn btn-danger" href="javascript:void(0)" style="top: 30px;"><i class="fa fa-trash" aria-hidden="true" onclick="remove_system_element(${element.id},${data.data_id},'remove_element_data',${section_id})"></i></a>
                                                            <input type="hidden" name="content_type" value="update_tab_content">
                                                            <input type="hidden" name="system_page_id" value="${data.data_id}">
                                                            <input type="hidden" name="system_element_id" value="${element.id}">
                                                            <div class="row collapse" id="img_collapse_${data.data_id}" data-parent="#tab_image_${li_id}">
                                                                <div class="col-lg-12">
                                                                    <div class="form-group" id="image">
                                                                        <input type="file" style="display:none" name="image" class="system_img_${element.id}_${data.data_id}"/>
                                                                        <a class="btn btn btn-info" href="javascript:void(0);" onclick="selectFile('system_img_${element.id}_${data.data_id}')">Change Image</a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group"><label>Text</label></div>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" placeholder="Text-1" id="text-1" name="text_value['text_1']" value="${data.text.text_1}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" placeholder="Text-2" id="text-2" name="text_value['text_2']" value="${data.text.text_2}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group"><label>Button</label></div>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" placeholder="Enter button text" name="button[text]" value="${data.button.text}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control" placeholder="Enter button link" name="button[href]" value="${data.button.href}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="form-group">
                                                                        <button class="btn btn-primary" type="button" onclick=system_add_conetent('form_system_${element.id}_${data.data_id}','${section_id}')>Save</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div></form>`;
                                    });
                                    tab_collaps_html += `<form enctype="multipart/form-data" id="form_system_new_content_${li_id}">
                                                <div class="col-lg-12">
                                                    <div class="tab-modal-img">
                                                        <a class="topright btn btn-info" href="javascript:void(0)" data-toggle="collapse" data-target="#img_collapse_new_content_${li_id}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                        <img alt="data-1" src="" id="system_img_new_content_${li_id}">
                                                        <input type="hidden" name="content_type" value="new_tab_content">
                                                        <input type="hidden" name="system_page_id" value="new">
                                                        <input type="hidden" name="system_element_id" value="${element.id}">
                                                        <div class="row collapse" id="img_collapse_new_content_${li_id}" data-parent="#tab_image_${li_id}">
                                                            <div class="col-lg-12">
                                                                <div class="form-group" id="image">
                                                                    <input type="file" style="display:none" name="image" class="system_img_new_content_${li_id}"/>
                                                                    <a class="btn btn btn-info" href="javascript:void(0);" onclick="selectFile('system_img_new_content_${li_id}')">ADD Image</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group"><label>Text</label></div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" placeholder="Text-1" id="text-1" name="text_value['text_1']">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" placeholder="Text-2" id="text-2" name="text_value['text_2']">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group"><label>Button</label></div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" placeholder="Enter button text" name="button[text]">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" placeholder="Enter button link" name="button[href]">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="button" onclick="system_add_conetent('form_system_new_content_${li_id}','${section_id}')">ADD</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>`;
                                    tab_content += tab_content_div;
                                    tab_content += `</div></div>`;
                                    collpse_html += tab_collaps_html;
                                    collpse_html += `</div></div></div></div>`;
                                    no++;
                                });
                                var new_tab_form = `<div class="card">
                                                        <div class="card-header" id="headingOne">
                                                            <form enctype="multipart/form-data" id="form_system_new_tab_${section_id}">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="content_type" value="new_tab">
                                                                    <input type="text" class="form-control" placeholder="Add new tab" id="text-1" name="system_new_tab">
                                                                </div>
                                                            </div>
                                                            <div class="col-3" id="new_tab_btn">
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary" type="button" onclick="system_add_conetent('form_system_new_tab_${section_id}','${section_id}')">ADD</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form></div></div>`;
                                $(`#${section_type}`).find("#tabs").html(tab_html);
                                $(`#${section_type}`).find("#tab-content").html(tab_content);
                                $(`#setting-modal-section-${section_id}`).find("#accordion").html(new_tab_form);
                                $(`#setting-modal-section-${section_id}`).find("#accordion").append(collpse_html);
                            }
                            if (val == "testimonials") {

                                var testimonials = content[val];
                                var testimonials_html = '';
                                var testinomials_collpse_html = ``;

                                $(`#setting-modal-section-${section_id}`).find('#add_class_btn').click(function () {
                                    system_add_conetent('form_testinomials_add_class', section_id)
                                });
                                $(`#setting-modal-section-${section_id}`).find('#add_new_test').click(function () {
                                    system_add_conetent('form_testinomials_add_new', section_id)
                                });
                                testimonials.forEach(function (element) {

                                    testimonials_html += `<div class="item">
                                                            <div class="shadow-effect">
                                                                <p>${element.text.text_1}</p>
                                                                <div class="img-testimonial">
                                                                    <img class="img-circle" src="{{$image_path.'/${element.image}'}}" alt="">
                                                                    <div class="testimonial-name">
                                                                        <h4>${element.text.text_2}</h4>
                                                                        <h5>${element.text.text_3}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>`;

                                    testinomials_collpse_html += ` <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <div class="row">
                                                    <div class="col-9">
                                                        <h5 class="mb-0">
                                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapse_testinomial_${element.id}" aria-expanded="true" aria-controls="collapseOne">${element.text.text_2}</a>
                                                        </h5>
                                                    </div>
                                                    <div class="col-3">
                                                        <a class="btn btn-warning" href="javascript:void(0)"><i class="fa fa-trash" aria-hidden="true" onclick="remove_system_element(${element.id},'','remove_element',${section_id})"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapse_testinomial_${element.id}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_testimonials">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <form enctype="multipart/form-data" id="form_testinomials_${element.id}">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <input type="hidden" name="content_type" value="update_section">
                                                                    <input type="hidden" name="system_element_id" value="${element.id}">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <textarea name="text_value['text_1']" rows="5" class="form-control">${element.text.text_1}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <img alt="data-1" src="{{$image_path.'/${element.image}'}}" id="testinomials_img_new_content_${element.id}" style="height: 120px;object-fit: contain;">
                                                                        <div class="form-group">
                                                                            <input type="file" style="display:none" name="image" class="testinomials_img_new_content_${element.id}"/>
                                                                            <a class="btn btn btn-info" href="javascript:void(0);" onclick="selectFile('testinomials_img_new_content_${element.id}')">Change Image</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group"><input class="form-control" name="text_value['text_2']" value="${element.text.text_2}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group"><input class="form-control" name="text_value['text_3']" value="${element.text.text_3}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <button class="btn btn-primary" type="button" onclick="system_add_conetent('form_testinomials_${element.id}','${section_id}')">ADD</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                                });


                                $(`#${section_type}`).find('#customers-testimonials').html(testimonials_html);

                                var carousel = $(`#${section_type}`).find('#customers-testimonials');

                                carousel.owlCarousel({
                                    loop: true,
                                    items: 2,
                                    margin: 0,
                                    autoplay: true,
                                    dots: true,
                                    autoplayTimeout: 8500,
                                    smartSpeed: 450,
                                    responsive: {
                                        0: {
                                            items: 1
                                        },
                                        768: {
                                            items: 2
                                        },
                                        1170: {
                                            items: 2
                                        }
                                    }
                                });

                                checkClasses();
                                carousel.on('translated.owl.carousel', function (event) {

                                    checkClasses(this);
                                });

                                function checkClasses(arg) {
                                    var FindActive = $(arg).find('.owl-item.active');
                                    if (arg == "" || arg == null) {
                                        FindActive = jQuery('.owl-stage').find('.owl-item.active');
                                    }


                                    for (var i = 0; i < 2; i++) {

                                        if (i == 0) {
                                            $(FindActive[0]).find('.item').css('opacity', '1');
                                        } else {
                                            $(FindActive[i]).find('.item').css('opacity', '0.5');
                                        }
                                    }
                                }

                                carousel.trigger('refresh.owl.carousel');

                                $(`#setting-modal-section-${section_id}`).find('#accordion_testimonials_dynamic_section').html(testinomials_collpse_html);
                            }

                            if (val == "footer") {
                                var footer = Object.keys(content[val]);
                                footer.forEach(function (element) {
                                    if (element == "logo") {
                                        var logo_img = content[val][element].logo;
                                        $(`#${section_type}`).find("#logo").find('img').attr('src', `{{$image_path.'/${logo_img}'}}`);
                                        var text = '©' + new Date().getFullYear() + ' ' + content[val][element].text;
                                        var text1 = content[val][element].text;
                                        $(`#${section_type}`).find("#logo").find('#text').html(text);


                                        $(`#setting-modal-section-${section_id}`).find(`#logo`).find('img').attr('src', `{{$image_path.'/${logo_img}'}}`);
                                        $(`#setting-modal-section-${section_id}`).find(`#logo`).find('#text').val(text1);

                                        $(`#setting-modal-section-${section_id}`).find(`#logo`).find(`#text`).keyup(function () {
                                            var text_value = '©' + new Date().getFullYear() + ' ' + $(this).val();
                                            $(`#${section_type}`).find("#logo").find('#text').html(text_value);
                                        });

                                    } else if (element == "footer_menu") {
                                        var menu_html = "";
                                        var menu_modal_html = "";
                                        content[val][element].forEach(function (menu_list) {
                                            var menu = menu_list.menu;
                                            var data = menu_list.data;
                                            var footer_menu_id = menu_list.id;
                                            var menu_inner_html = "";
                                            menu_modal_html += `<div class="card mb-2">
                                                                    <div class="card-header"><h6>${menu}</h6></div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                            <div class="form-group">
                                                                            <input type="text" name="menu_name[footer_menu][${footer_menu_id}][menu]" class="form-control" placeholder="Menu" value="${menu}" id="footer_menu_${footer_menu_id}" onkeyup="keyup_change_text(this,${section_id})">
                                                                        </div>`;
                                            menu_html += `<div class="col-lg-3 top-part"><h3 id="footer_menu_${footer_menu_id}">${menu}</h3><ul>`;
                                            var no = 1;
                                            data.forEach(function (data_val) {
                                                menu_inner_html += `<li><a href="${data_val.menu_href}" id="footer_menu_${footer_menu_id}_${no}">${data_val.menu_name}</a></li>`;
                                                menu_modal_html += `<div class="form-group">
                                                                        <input type="text" name="menu_name[footer_menu][${footer_menu_id}][data][${no}][text]"  class="form-control" placeholder="Menu name" value="${data_val.menu_name}" id="footer_menu_${footer_menu_id}_${no}" onkeyup="keyup_change_text(this,${section_id})"/>
                                                                        <input type="text" name="menu_name[footer_menu][${footer_menu_id}][data][${no}][href]" id="text" class="form-control" placeholder="link" style="background-color:#b7d0ef;" value="${data_val.menu_href}"/>
                                                                    </div>`;
                                                no++;
                                            });
                                            menu_html += menu_inner_html;
                                            menu_html += `</ul></div>`;
                                            menu_modal_html += `</div></div></div></div>`;
                                        });

                                        $(`#${section_type}`).find("#footer_section").append(menu_html);
                                        $(`#setting-modal-section-${section_id}`).find("#footer_modal_footer_menu").html(menu_modal_html);
                                    } else if (element == "contact_app") {
                                        var menu_html = "";
                                        var menu_modal_html = "";
                                        content[val][element].forEach(function (menu_list) {
                                            var menu = menu_list.menu;
                                            var data = menu_list.data;
                                            var menu_inner_html = "";
                                            menu_html += `<div class="col-lg-3 top-part"><h3 id="contact_app_menu">${menu}</h3><ul>`;
                                            menu_modal_html += `<div class="card mb-2">
                                                                    <div class="card-header"><h6>${menu}</h6></div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <input type="text" name="menu_name[contact_app][menu]" class="form-control" placeholder="Menu" value="${menu}" id="contact_app_menu" onkeyup="keyup_change_text(this,${section_id})">
                                                                                </div>`;
                                            var no = 1;
                                            data.forEach(function (data_val) {
                                                menu_inner_html += `<li><a href="${data_val.image_href}"><img src="{{$image_path.'/${data_val.image}'}}" id="section_footer_contact_${section_id}_${no}" alt="logo"></a></li>`;
                                                menu_modal_html += `<div class="form-group">
                                                                        <img src="{{$image_path.'/${data_val.image}'}}" class="imagepreview mb-2" id="footer_contact_${section_id}_${no}">
                                                                        <input type="hidden" name="menu_name[contact_app][data][${no}][id]" value="${data_val.id}"/>
                                                                        <input type="file" style="display:none" name="menu_name[contact_app][data][${no}][image]" class="footer_contact_${section_id}_${no}"/>
                                                                        <a class="btn btn btn-info" href="javascript:void(0);" onclick="selectFile('footer_contact_${section_id}_${no}')">Change</a>
                                                                        </div>
                                                                    <div class="form-group">
                                                                        <input type="text" name="menu_name[contact_app][data][${no}][href]" id="text" class="form-control" placeholder="link" style="background-color:#b7d0ef;" value="${data_val.image_href}"/>
                                                                    </div>`;
                                                no++;
                                            });
                                            menu_html += menu_inner_html;
                                            menu_html += `</ul></div>`;
                                            menu_modal_html += `</div></div></div></div>`;
                                        });
                                        $(`#${section_type}`).find("#footer_section").append(menu_html);
                                        $(`#setting-modal-section-${section_id}`).find("#contact_menu").html(menu_modal_html);
                                    } else if (element == "bottom_menu") {

                                        var text = '©' + new Date().getFullYear() + ' ' + content[val][element].text;
                                        var text1 = content[val][element].text;
                                        var data = content[val][element].data;
                                        $(`#${section_type}`).find("#footer_bottom").find('#text').html(text);
                                        var menu_html = "";
                                        var menu_modal_html = `<div class="card mb-2">
                                                                    <div class="card-header"><h6>Bottom menu</h6></div>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                <input type="text" name="menu_name[bottom_menu][text]" id="text" class="form-control" placeholder="Menu name" value="${text1}"/>
                                                                            </div>`;
                                        var no = 1;
                                        data.forEach(function (data_val) {
                                            menu_html += `<li><a href="${data_val.menu_href}" id="bottom_menu_${no}">${data_val.menu_name}</a></li>`;
                                            menu_modal_html += `<div class="form-group">
                                                                        <input type="text" name="menu_name[bottom_menu][data][${no}][text]" class="form-control" placeholder="Menu name" value="${data_val.menu_name}" id="bottom_menu_${no}" onkeyup="keyup_change_text(this,${section_id})"/>
                                                                        <input type="text" name="menu_name[bottom_menu][data][${no}][href]" class="form-control" placeholder="link" style="background-color:#b7d0ef;" value="${data_val.menu_href}"/>
                                                                    </div>`;
                                            no++;
                                        });
                                        menu_modal_html += `</div></div></div></div>`;
                                        $(`#${section_type}`).find("#footer_bottom").find('#data').html(menu_html);
                                        $(`#setting-modal-section-${section_id}`).find("#footer_modal_footer_bottom").html(menu_modal_html);

                                        $(`#setting-modal-section-${section_id}`).find(`#footer_modal_footer_bottom`).find(`#text`).keyup(function () {
                                            var text_value = '©' + new Date().getFullYear() + ' ' + $(this).val();
                                            $(`#${section_type}`).find("#footer_bottom").find('#text').html(text_value);
                                        });
                                    }
                                });
                            }
                        });
                    }
                }
            }
        });
    }

    function add_content(id) {
        var form = $(`#setting-modal-section-${id}`).find('form')[0];
        var formData = new FormData(form);
        formData.append('id', id);
        $.ajax({
            type: 'POST',
            url: '{{ url("/LandingPage/setConetent") }}',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "error") {
                    show_toastr('{{__("Error")}}', '{{__("Something went wrong.")}}', 'error');
                } else {
                    var id = data.id;
                    var view_name = data.section_blade_file_name;

                    modalHide();
                    $(`.section_div_${id}`).load(`{{ url("/get_landing_page_section") }}/${view_name}`, function () {
                        $(`.section_div_${id}`).find('.modal').attr('id', `setting-modal-section-${id}`);
                        $(`.section_div_${id}`).find('#section').attr('id', `section-${id}`);
                        $(`.section_div_${id}`).find('#ul-section').attr('id', `ul-section-${id}`);
                        $(`.section_div_${id}`).find('#setting_btn').attr('data-target', `#setting-modal-section-${id}`);
                        $(`.section_div_${id}`).find('#copy_btn').attr('data-id', id);
                        show_content(id);
                        $(`#setting-modal-section-${id}`).find('#save').click(function () {
                            add_content(id)
                        });
                        $(`#${id}`).find('#delete').click(function () {
                            delete_content(id)
                        });
                    });
                }

            }
        });
    }

    function set_section_page(id) {
        var form = $(`#setting-modal-section-${id}`).find('form')[0];
        var formData = new FormData(form);
        formData.append('id', id);
        $.ajax({
            type: 'POST',
            url: '{{ url("/LandingPage/setConetent") }}',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "error") {
                    show_toastr('{{__("Error")}}', '{{__("Something went wrong.")}}', 'error');
                } else {
                    location.reload();
                }
            }
        });
    }

    function modalHide() {
        $('.modal').removeClass('in');
        $('.modal').attr("aria-hidden", "true");
        $('.modal').css("display", "none");
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
    }

    function system_add_conetent(form_id, id) {

        var form = $(`#setting-modal-section-${id}`).find(`#${form_id}`)[0];
        var formData = new FormData(form);
        formData.append('id', id);
        $.ajax({
            type: 'POST',
            url: '{{ url("/LandingPage/setConetent") }}',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "error") {
                    show_toastr('{{__("Error")}}', '{{__("Something went wrong.")}}', 'error');
                } else {
                    var id = data.id;
                    var view_name = data.section_blade_file_name;

                    modalHide();
                    $(`.section_div_${id}`).load(`{{ url("/get_landing_page_section") }}/${view_name}`, function () {
                        $(`.section_div_${id}`).find('.modal').attr('id', `setting-modal-section-${id}`);
                        $(`.section_div_${id}`).find('#section').attr('id', `section-${id}`);
                        $(`.section_div_${id}`).find('#ul-section').attr('id', `ul-section-${id}`);
                        $(`.section_div_${id}`).find('#setting_btn').attr('data-target', `#setting-modal-section-${id}`);
                        $(`.section_div_${id}`).find('#copy_btn').attr('data-id', id);
                        show_content(id);
                        $(`#setting-modal-section-${id}`).find('#save').click(function () {
                            add_content(id)
                        });
                        $(`#${id}`).find('#delete').click(function () {
                            delete_content(id)
                        });
                    });
                }
            }
        });
    }

    function delete_content(id) {

        $.ajax({
            type: 'POST',
            url: `{{ url("/LandingPage/removeSection") }}/${id}`,
            success: function (data) {
                if (data == "error") {
                    show_toastr('{{__("Error")}}', '{{__("Something went wrong.")}}', 'error');
                } else {
                    location.reload();
                }
            }
        });
    }

    function selectFile(elementid) {

        $(`.${elementid}`).trigger('click');
        $(`.${elementid}`).change(function () {
            var url = this.value;
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (this.files && this.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(`#${elementid}`).attr('src', e.target.result);
                    $(`#section_${elementid}`).attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            } else {

                $(`#${elementid}`).attr('src', '/assets/no_preview.png');
                $(`#section_${elementid}`).attr('src', '/assets/no_preview.png');
            }
        });
    }

    function remove_system_element(system_element_id, system_page_id, content_type, section_id) {
        $.ajax({
            type: 'POST',
            url: '{{ url("/LandingPage/setConetent") }}',
            data: {system_element_id: system_element_id, system_page_id: system_page_id, content_type: content_type, id: section_id},
            success: function (data) {
                if (data == "error") {
                    show_toastr('{{__("Error")}}', '{{__("Something went wrong.")}}', 'error');
                } else {

                    var id = data.id;
                    var view_name = data.section_blade_file_name;

                    modalHide();
                    $(`.section_div_${id}`).load(`{{ url("/get_landing_page_section") }}/${view_name}`, function () {
                        $(`.section_div_${id}`).find('.modal').attr('id', `setting-modal-section-${id}`);
                        $(`.section_div_${id}`).find('#section').attr('id', `section-${id}`);
                        $(`.section_div_${id}`).find('#ul-section').attr('id', `ul-section-${id}`);
                        $(`.section_div_${id}`).find('#setting_btn').attr('data-target', `#setting-modal-section-${id}`);
                        $(`.section_div_${id}`).find('#copy_btn').attr('data-id', id);
                        show_content(id);
                        $(`#setting-modal-section-${id}`).find('#save').click(function () {
                            add_content(id)
                        });
                        $(`#${id}`).find('#delete').click(function () {
                            delete_content(id)
                        });
                    });
                }
            }
        });
    }


    function add_new_input(section_id) {

        var html = `<div id="inputFormRow">
            <div class="input-group mb-3">
            <input type="text" name="menu_name[]" class="form-control m-input" placeholder="menu name" autocomplete="off">
            <div class="input-group-append">
            <button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
            </div>
            </div>
        </div>`;

        $(`#${section_id}`).find(`#menu`).append(html);
    }

    function keyup_change_text(arg, sectionid) {
        var id = arg.getAttribute('id');
        var text_value = $(`#setting-modal-section-${sectionid}`).find(`#${id}`).val();
        $(`#section-${sectionid}`).find(`#${id}`).html(text_value);

    }

    function copySection(arg) {
        var id = arg.getAttribute('data-id');
        $.ajax({
            type: 'POST',
            url: '{{ url("/LandingPage/copySection") }}',
            data: {id: id},
            success: function (data) {
                if (data == "error") {
                    show_toastr('{{__("Error")}}', '{{__("Something went wrong.")}}', 'error');
                } else {
                    location.reload();
                }
            }
        });
    }

</script>

<div class="card">
    <div class="card-body">


        <a class="btn btn-primary" href="{{url('/')}}">
            <i class="fa fa-arrow-left"></i>
        </a>
        <button class="btn btn-primary" data-toggle="modal" data-target="#component-modal" style="float:right;">
            <i class="fa fa-plus"></i>
        </button>
    </div>
</div>

<div class="content" id="sortablediv">
    @if (count($get_section) > 0)
        @foreach ($get_section as $key => $value)
            @if ($value->content != "" && $value->content != null)
                <div class="section_div_{{$value->id}} tooltip1 ui-widget-content" id="{{$value->id}}">
                    @if($value->section_type == "section-plan")
                        <script>
                            $('#{{$value->id}}').load(`{{ url("/get_landing_page_section") }}/{{$value->section_blade_file_name}}`, function () {
                                $('#{{$value->id}}').find('#ul-section').attr('id', 'ul-section-{{$value->id}}');
                                $(`#{{$value->id}}`).find('#delete').click(function () {
                                    delete_content("{{$value->id}}")
                                });
                                $('#{{$value->id}}').find('#copy_btn').attr('data-id', '{{$value->id}}');
                                show_content('{{$value->id}}');
                            });
                        </script>
                    @else
                        @include('custom_landing_page.' . $value->section_blade_file_name)

                        <script>
                            $('#{{$value->id}}').find('.modal').attr('id', 'setting-modal-section-{{$value->id}}');
                            $('#{{$value->id}}').find('#section').attr('id', 'section-{{$value->id}}');
                            $('#{{$value->id}}').find('#ul-section').attr('id', 'ul-section-{{$value->id}}');
                            $('#{{$value->id}}').find('#setting_btn').attr('data-target', '#setting-modal-section-{{$value->id}}');
                            $('#{{$value->id}}').find('#copy_btn').attr('data-id', '{{$value->id}}');
                            show_content('{{$value->id}}');
                            $(`#setting-modal-section-{{$value->id}}`).find('#save').click(function () {
                                add_content("{{$value->id}}")
                            });
                            $(`#{{$value->id}}`).find('#delete').click(function () {
                                delete_content("{{$value->id}}")
                            });
                        </script>
                    @endif
                </div>
            @endif
        @endforeach
    @endif
    @if (count($get_section) > 0)
        @foreach ($get_section as $key => $value)
            @if ($value->content == "" || $value->content == null)
                <div class="section_div_{{$value->id}} tooltip1 ui-widget-content" id="{{$value->id}}">

                </div>
            @endif
        @endforeach
    @endif
</div>
<div id="test_fdiv"></div>
<div class="modal right fade component_modal" id="component-modal" tabindex="-1" role="dialog" aria-labelledby="component-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel2">Add Section</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                @if (count($get_section) > 0)
                    @foreach ($get_section as $key => $value)
                        @if ($value->content == "" || $value->content == null)
                            <img src="{{asset('storage/uploads/Landing_page_component_image')}}/{{$value->section_demo_image}}" onclick="set_section_page('{{$value->id}}')" id="component_modal_{{$value->id}}">
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#sortablediv").sortable({
        /*cursor: 'move'*/
        handle: '.handle',
        stop: function (event, ui) {
            var idsInOrder = $("#sortablediv").sortable('toArray', {attribute: 'id'});
            $.ajax({
                type: 'POST',
                url: '{{ url("/LandingPage/setOrder") }}',
                data: {'element_array': idsInOrder},
                success: function (data) {

                }
            });
        }
    });
</script>


</body>
</html>
