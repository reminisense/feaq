<div class="modal fade" id="contact-business-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="contactBusinessModal">Contact Business</h3>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                    <div id="message-notif" class="alert alert-success" style="display: none; text-align: center;" role="alert"></div>
                    <form action="{{ url('/broadcast/business-message') }}" class="navbar-form navbar-left" name="contact_business_form">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>Message <span class="req">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" id="contactmessage" placeholder="Write your message here..." required ></textarea>
                            </div>
                            <div class="col-md-3">
                                <label>File Attachment </label>
                            </div>
                            <div class="col-md-9">
                                <div class="col-md-12">
                                    <input type="hidden" role="uploadcare-uploader" data-crop="disabled" id="contactfile" />
                                    <em class="help-block">Upload is limited to documents and images up to 5MB.</em>
                                </div>
                            </div>
                            {{ $custom_fields }}
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-orange btn-lg" data-dismiss="modal" aria-label="Close">CLOSE</button>--}}
                <button id="send-business-message" type="button" class="btn btn-orange btn-lg">Send Message</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->