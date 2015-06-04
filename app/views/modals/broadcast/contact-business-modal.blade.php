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
                                <label>Name <span class="req">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="contactname" @if(isset($user['first_name'])) {{ "value='" . $user['first_name'] . " " . $user['last_name'] . "' readonly" }} @endif required />
                            </div>
                            <div class="col-md-3">
                                <label>Email <span class="req">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" class="form-control" id="contactemail" @if(isset($user['email'])) {{ "value='" . $user['email'] . "' readonly" }} @endif required />
                            </div>
                            <div class="col-md-3">
                                <label>Mobile Number <span class="req">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <input type="mobile" class="form-control" id="contactmobile" @if(isset($user['phone'])) {{ "value='" . $user['phone'] . "' readonly" }} @endif required />
                            </div>
                            <div class="col-md-3">
                                <label>Message <span class="req">*</span></label>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="5" id="contactmessage" placeholder="Write your message here..." required ></textarea>
                            </div>
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