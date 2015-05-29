<!-- modal -->
<div class="modal fade" id="priority-number-modal" tabindex="-1" ng-controller="messageController">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id=""></h3>
            </div>
            <div class="modal-body">
                <ul id="pmore-tab" class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">DETAILS</a></li>
                    <li><a href="#messages" data-toggle="tab" ng-click="getMessages()">MESSAGES</a></li>
                </ul>
                <div class="clearfix tab-content">
                    <div class="tab-pane fade active in" id="details">
                        <div class="">
                            <div class="col-md-6 col-xs-6"><h5>Priority Number: </h5></div>
                            <div class="col-md-6 col-xs-6"><h5 id="priority-number-number"></h5></div>
                        </div>
                        <div class="">

                            <div class="col-md-6 col-xs-6"><h5>Name: </h5></div>
                            <div class="col-md-6 col-xs-6"><h5 id="priority-number-name"></h5></div>
                        </div>
                        <div class="">

                            <div class="col-md-6 col-xs-6"><h5>Phone: </h5></div>
                            <div class="col-md-6 col-xs-6"><h5 id="priority-number-phone"></h5></div>
                        </div>
                        <div class="">
                            <div class="col-md-6 col-xs-6"><h5>Email: </h5></div>
                            <div class="col-md-6 col-xs-6"><h5 id="priority-number-email"></h5></div>
                        </div>
                    </div>
                    <div class="tab-pane fade in" id="messages">
                        <div class="">
                            <div class="col-md-12 text-center"><h5>Conversation History</h5></div>
                            <div class="col-md-12" style="max-height: 300px; overflow: auto;">
                                <div ng-repeat="message in messages">
                                    <div ng-if="message.sender == 'user'" class="alert alert-success">
                                        <p>
                                            <strong>User: </strong>
                                            @{{ message.content }}
                                            <span class="pull-right">Sent @{{ message.timestamp }}</span>
                                        </p>
                                    </div>
                                    <div ng-if="message.sender == 'business'" class="alert alert-info">
                                        <p>
                                            <strong>You: </strong>
                                            @{{ message.content }}
                                            <span class="pull-right">Sent @{{ message.timestamp }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h5>Send A Message</h5>
                                Send to Phone: <input type="checkbox" ng-model="send_to_phone">
                                <textarea class="form-control" rows="5" placeholder="Write a message..." style="resize: none;" ng-model="message_reply"></textarea>
                                <button class="btn btn-primary btn-md pull-right" ng-click="sendBusinessReply()">Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-orange btn-md" data-dismiss="modal" aria-label="Close">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->