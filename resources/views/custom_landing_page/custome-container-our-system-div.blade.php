<div class="bg-gredient2 our-system" id="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>See our system <span> on images</span></h3>
                <ul class="nav nav-tabs" id="tabs">

                </ul>
            </div>
            <div class="tab-content" id="tab-content">

            </div>
        </div>
    </div>
</div>
<div id="ul-section">
    <ul class="list-group list-group-horizontal tooltip1text" style="z-index:200;padding-top: 100px;">
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
                <div id="accordion">

                </div>
                <div class="card mb-2">
                    <div class="card-header"><h6>Custom class name</h6></div>
                    <div class="card-body">
                        <form enctype="multipart/form-data" id="testnomial_add_class_form">
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
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

