<div class="bg-gredient2" id="section">
    <div class="container">
        <!-- TESTIMONIALS -->
        <section class="testimonials">
            <div class="container">
                <h3>Testimonials</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <div id="customers-testimonials" class="owl-carousel" dir="{{env('SITE_RTL') == 'on'?'ltr':''}}">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END OF TESTIMONIALS -->
    </div>
</div>
<div id="ul-section">
    <ul class="list-group list-group-horizontal tooltip1text" style="z-index: 200;" >
        <li class="list-group-item"><button class="btn btn-default" id="delete"><i class="fa fa-trash"></i></button></li>
        <li class="list-group-item"><button class="btn btn-default" data-toggle="modal" id="setting_btn"><i class="fa fa-cogs"></i></button></li>
        <li class="list-group-item"><button class="btn btn-default" onclick="copySection(this)" id="copy_btn"><i class="fa fa-copy"></i></button></li>
        <li class="list-group-item"><a class="btn btn-default handle"><i class="fa fa-arrows"></i></a></li>
    </ul>
</div>
<div class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="myModalLabel2">Section Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="accordion_testimonials">
                    <div id="accordion_testimonials_dynamic_section"></div>
                    <div>
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="mb-0">
                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapse_testinomial_add_new" aria-expanded="true" aria-controls="collapseOne">Add new content</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div id="collapse_testinomial_add_new" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_testimonials">
                                <div class="card-body">
                                    <div class="row">
                                        <form enctype="multipart/form-data" id="form_testinomials_add_new">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <input type="hidden" name="content_type" value="new_section">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <textarea name="text_value['text_1']" rows="5" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">

                                                        <div class="form-group">
                                                            <img alt="data-1" src="" id="testinomials_img_new_content_add_new" style="height: 120px;object-fit: contain;">

                                                            <input type="file" style="display:none" name="image" class="testinomials_img_new_content_add_new"/>
                                                            <a class="btn btn btn-info" href="javascript:void(0);" onclick="selectFile('testinomials_img_new_content_add_new')">Add Image</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group"><input class="form-control" name="text_value['text_2']">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group"><input class="form-control" name="text_value['text_3']">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <button class="btn btn-primary" type="button" id="add_new_test">ADD</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header"><h6>Custom class name</h6></div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" id="form_testinomials_add_class">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="class name" id="custom_class_name" name="custom_class_name">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="button" id="add_class_btn">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
