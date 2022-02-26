<div class="features-inner-part" id="section">
    <div class="features-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="see-more">
                        <span id="text-1">See more features</span>
                    </div>
                </div>
                <div class="col-lg-12 inner-main-text">
                    <h3 id="text-2">All Features <span id="text-3">in one place</span></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 features-card">
                    <div class="inner-text">
                        <h5 id="text-4">
                        </h5>
                        <p id="text-5">

                        </p>
                    </div>
                </div>
                <div class="col-lg-3 features-card">
                    <div class="inner-text">
                        <p id="text-6">
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 features-card">
                    <div class="inner-text">
                        <p id="text-7">
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 features-card">
                    <div class="inner-text">
                        <p id="text-8">
                        </p>
                    </div>
                </div>
                <div class="features-button col-lg-12"><a href="#" id="button"></a></div>
            </div>
        </div>
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
<div class="modal right component_modal fade" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="myModalLabel2">Section Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <form enctype="multipart/form-data">
                    <div class="card mb-2">
                        <div class="card-header"><h6>Text</h6></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Text-1" id="text-1" name="text_value[]">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Text-2" id="text-2" name="text_value[]">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Text-3" id="text-3" name="text_value[]">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5" id="text-4" name="text_value[]"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="text-5" name="text_value[]"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5" id="text-6" name="text_value[]"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="text-7" name="text_value[]"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="text-8" name="text_value[]"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header"><h6>Button</h6></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12" id="button">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter button text" name="button[text]">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter button link" name="button[href]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header"><h6>Custom class name</h6></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="class name" id="custom_class_name" name="custom_class_name">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="save">Save</button>
            </div>
        </div>
    </div>
</div>
