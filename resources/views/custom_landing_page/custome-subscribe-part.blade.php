<div class="subscribe-part" id="section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <span class="top-heading" id="text-1"></span>
                <h3 id="text-2"></h3>
                <span class="sub-heading" id="text-3"></span>
                <p id="text-4"></p>
                <form action="#">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Type your email address.." id="demo" name="email">
                        <button type="submit" class="btn btn-default" id="button"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="ul-section">
    <ul class="list-group list-group-horizontal tooltip1text" style="z-index: 1000;">
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
                                        <input type="text" class="form-control" placeholder="Text-3" id="text-4" name="text_value[]">
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