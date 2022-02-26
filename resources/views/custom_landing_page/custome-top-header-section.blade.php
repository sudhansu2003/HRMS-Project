<div class="top-header-part bg-gredient" id="section">
    <input type="hidden" name="section_id" id="section_id">
    <div class="container">
        <div class="row top-bar">
            <div class="col-lg-6 col-md-6 left-part">
                <ul>
                    <li>
                        <a href="#">
                            <img src="" alt="logo" height="35px" width="auto" id="logo">
                        </a>
                    </li>
                    <ul id="menu">

                    </ul>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 right-part">
                <ul>
                    <li>
                        <a href="{{ route('login') }}" class="button" id="button"></a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 inner-text">
                <h2 id="text-1"></h2>
                <span class="sub-heading" id="text-2"></span>
                <div class="body-text">
                    <p id="text-3"></p>
                </div>
                <a href="#" class="button" id="text-4"></a>
                <span id="text-5"></span>
            </div>
            <div class="col-lg-12 top-banner-img">
                <img src="" alt="dashboard" class="imagepreview" id="image">
            </div>
        </div>
    </div>
</div>
<div id="ul-section">
    <ul class="list-group list-group-horizontal tooltip1text">
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
                        <div class="card-header"><h6>Logo</h6></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-group" id="logo">

                                        <img src="" class="imagepreview mb-2" style="background:#b3d7ff;">
                                        <input type="file" style="display:none" name="logo"/>
                                        <a class="btn btn btn-info" href="javascript:void(0);">Change Logo</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="card-header"><h6>Menu</h6></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="menu"></div>
                                    <button id="addRow" type="button" class="btn btn-info"><i class="fa fa-plus"></i></button>
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
                        <div class="card-header"><h6>Image</h6></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-group" id="image">

                                        <img src="" class="imagepreview">
                                        <input type="file" style="display:none" name="image"/>
                                        <a class="btn btn btn-info" href="javascript:void(0);">Change Image</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                        <textarea class="form-control" rows="5" id="text-3" name="text_value[]"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="text-4" name="text_value[]"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" id="text-5" name="text_value[]"></textarea>
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

