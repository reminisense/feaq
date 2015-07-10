<div class="modal fade" id="preview-form-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="previewFormModal">PREVIEW</h3>
            </div>
            <form>
                <div class="modal-body">
                    <div class="clearfix">
                        <div id="message-notif" class="alert alert-success" style="display: none; text-align: center;" role="alert"></div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>Name <span class="req">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="contactname" required />
                            </div>
                            <div class="col-md-3">
                                <label>Email <span class="req">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="contactemail" required />
                            </div>
                            <div class="col-md-3">
                                <label>Mobile Number <span class="req">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="mobile" class="form-control" id="contactmobile" required />
                            </div>
                            <div class="col-md-3">
                                <label>Message <span class="req">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" id="contactmessage" placeholder="Write your message here..." required ></textarea>
                            </div>
                            <div id="custom-fields-display">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" aria-label="Close">
                        <span class="glyphicon glyphicon-remove"> CLOSE PREVIEW</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>