<!-- modal -->
<div class="modal fade" id="priority-number-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id=""></h3>
            </div>
            <div class="modal-body">
                <ul id="pmore-tab" class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#details" data-toggle="tab">DETAILS</a></li>
                    <li><a href="#messages" data-toggle="tab" >MESSAGES</a></li>
                </ul>
                <div class="clearfix tab-content">
                    <div class="tab-pane fade active in" id="details">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5"><h5>Priority Number: </h5></div>
                            <div class="col-md-6"><h5 id="priority-number-number"></h5></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5"><h5>Name: </h5></div>
                            <div class="col-md-6"><h5 id="priority-number-name"></h5></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5"><h5>Phone: </h5></div>
                            <div class="col-md-6"><h5 id="priority-number-phone"></h5></div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5"><h5>Email: </h5></div>
                            <div class="col-md-6"><h5 id="priority-number-email"></h5></div>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="messages">
                        <div class="row">
                            <div class="col-md-12 text-center"><h5>Messages from <span>Name</span></h5></div>
                            <div class="col-md-12"></div>
                            <div class="col-md-12">
                                <h5>Send A Message to <span>Phone number</span></h5>
                                <textarea class="form-control" rows="5" placeholder="Write a message..." style="resize: none;"></textarea>
                                <button>Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-orange btn-lg" data-dismiss="modal" aria-label="Close">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->