<h5>MESSAGES</h5>
<div class="messages">
    <div ng-if="messages.length > 0">
        <div class="col-md-5">
            <div class="list-group">
                <a ng-repeat="message in messages" href="" class="list-group-item" ng-click="setPreviewMessage(message.contactname, message.message_id)">
                    <p><strong>@{{ message.contactname }}</strong> <@{{ message.email }}></p>
                </a>
            </div>
        </div>
        <div class="col-md-7">
            <div class="preview-container" style="padding-left: 30px;">
                <div class="message-preview" style="display: none;">
                    <p id="contactmessage" ng-repeat="thread in message_content">
                        @{{ thread.content }}<br>
                        <span class="timestamp">@{{ thread.timestamp }}</span>
                    </p>
                    <div class="message-reply">
                        <textarea class="form-control" placeholder="Write a reply..." name="message-reply"></textarea>
                        <h4>Send to:</h4>
                        <label><input type="radio" value="email" ng-model="sendby" ng-init="sendby">Email</label>
                        <label><input type="radio" value="phone" ng-model="sendby">Phone</label>
                        <select ng-model="pick_number" ng-init="pick_number">
                            <option value="0">- Select A Number -</option>
                            <option ng-repeat="number in number_list" value="@{{ number }}">@{{ number }}</option>
                        </select><br>
                        <button class="btn btn-default btn-orange">Send Reply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div ng-if="messages.length == 0">
        <p>You currently have no messages</p>
    </div>
</div>