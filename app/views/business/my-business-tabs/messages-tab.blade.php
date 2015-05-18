<h5>MESSAGES</h5>
<div class="messages">
    <div ng-if="messages.length > 0">
        <div class="col-md-5">
            <div class="list-group">
                <a ng-repeat="message in messages" href="" class="list-group-item" ng-click="setPreviewMessage(message.contactname, message.message_id, message.contactemail)">
                    <p><strong>@{{ message.contactname }}</strong> <@{{ message.email }}></p>
                </a>
            </div>
        </div>
        <div class="col-md-7">
            <div class="preview-container" style="padding-left: 30px;">
                <div class="message-preview" style="display: none;">
                    <div class="message-reply">
                        <div class="col-md-2 mt20"><label>Send to:</label></div>
                        <div class="col-md-2 mt20"><input type="checkbox" ng-model="sendbyemail" ng-checked="true"><label class="optionlabel">Email</label></div>
                        <div class="col-md-2 mt20"><input type="checkbox" ng-model="sendbyphone"><label class="optionlabel">Phone</label></div>
                        <div class="col-md-4">
                            <select class="form-control" ng-model="pick_number" ng-init="pick_number">
                                <option value="0">- Select A Number -</option>
                                <option ng-repeat="number in number_list" value="@{{ number }}">@{{ number }}</option>
                            </select><br>
                        </div>
                        <div class="col-md-2"></div>
                        <textarea class="form-control" rows="5" placeholder="Write a reply..." ng-model="message_reply"></textarea>
                        <button class="btn btn-default btn-orange" ng-click="sendBusinessReply()">Send Reply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div ng-if="messages.length == 0">
        <p>You currently have no messages</p>
    </div>
</div>