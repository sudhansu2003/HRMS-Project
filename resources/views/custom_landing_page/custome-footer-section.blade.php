<footer class="bg-gredient4" id="section">
    <div class="container top-part-main">
        <div class="row" id="footer_section">
            <div class="col-lg-3 top-part" id="logo">
                <div class="first-sec">
                    <a href="#">
                        <img src="" alt="logo" height="35px" width="auto" id="section_section-10_logo">
                    </a>

                </div>
            </div>
        </div>
    </div>
    <div class="container bottom-part" id="footer_bottom">
        <div class="row">
            <div class="col-lg-6 col-md-6 inner-text">
                <div class="copy-right" id="text">


                </div>
            </div>
            <div class="col-lg-6 col-md-6 inner-text">
                <ul id="data">

                </ul>
            </div>
        </div>
    </div>

</footer>
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
                        <div class="card-header"><h6>Logo</h6></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12" id="logo">

                                    <div class="form-group">

                                        <img src="" class="imagepreview mb-2" style="background:#b3d7ff;" id="section-10_logo">
                                        <input type="file" style="display:none" name="logo" class="section-10_logo"/>
                                        <a class="btn btn btn-info" href="javascript:void(0);" onclick="selectFile('section-10_logo')">Change Logo</a>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="text_value" id="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="footer_modal_footer_menu"></div>
                    <div id="contact_menu"></div>
                    <div id="footer_modal_footer_bottom"></div>
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
