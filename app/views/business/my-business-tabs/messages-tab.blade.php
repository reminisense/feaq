<div class="messages">
    <div class="col-md-5">
        <h5>Messages</h5>
        <div class="list-group">
            <a ng-repeat="message in messages" href="" class="list-group-item" ng-click="setPreviewMessage(message.message_id)">
                <p><strong>@{{ message.contactname }}</strong> <@{{ message.contactemail }}></p>
                <p class="messagedates">@{{ message.date_created }}</p>
            </a>
        </div>
    </div>
    <div class="col-md-7">
        <div class="preview-container" style="padding-left: 30px;">
            <h5>Preview</h5>
            <div class="message-preview" style="display: none;">
                <p><label class="preview-label">From:</label> <span id="contactfrom"></span></p>
                <p><label class="preview-label">Email:</label> <span id="contactemail"></span></p>
                <p><label class="preview-label">Mobile:</label> <span id="contactmobile"></span></p>
                <p><label class="preview-label">Message:</label> </p>
                <p id="contactmessage"></p>
            </div>
        </div>
    </div>
</div>