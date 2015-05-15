<div class="messages">
    <div class="col-md-5">
        <h5>Messages</h5>
        <div class="list-group">
            <a ng-repeat="message in messages" href="" class="list-group-item" ng-click="setPreviewMessage(message.contactname, message.message_id)">
                <p><strong>@{{ message.email }} </strong> <@{{ message.contactname }}></p>
            </a>
        </div>
    </div>
    <div class="col-md-7">
        <div class="preview-container" style="padding-left: 30px;">
            <h5>Preview</h5>
            <div class="message-preview" style="display: none;">
                <p><label class="preview-label">From:</label> <span id="contactfrom"></span></p>
                <p id="contactmessage" ng-repeat="thread in message_content">
                    @{{ thread.content }}<br>
                    @{{ thread.timestamp }}
                </p>
            </div>
        </div>
    </div>
</div>