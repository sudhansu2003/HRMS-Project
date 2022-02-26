<div class="social-links" id="section">
    <div class="container-fluid">
        <div class="row" id="menu">

        </div>
    </div>
</div>
<div id="ul-section">
    <ul class="list-group list-group-horizontal tooltip1text" style="z-index: 1000;" >
        <li class="list-group-item"><button class="btn btn-default" id="delete"><i class="fa fa-trash"></i></button></li>
        <li class="list-group-item"><button class="btn btn-default" data-toggle="modal" id="setting_btn"><i class="fa fa-cogs"></i></button></li>
        <li class="list-group-item"><button class="btn btn-default" onclick="copySection(this)" id="copy_btn"><i class="fa fa-copy"></i></button></li>
        <li class="list-group-item"><a class="btn btn-default handle"><i class="fa fa-arrows"></i></a></li>
    </ul>
</div>
<div class="modal right component_modal fade" tabindex="-1" role="dialog" aria-labelledby="setting-modal-label" id="setting-modal-section-9">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="myModalLabel2">Section Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data">
                    <div class="card mb-2">
                        <div class="card-header"><h6>Menu</h6></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="menu"></div>

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
