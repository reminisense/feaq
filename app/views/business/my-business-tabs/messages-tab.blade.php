<h5>MESSAGES</h5>
<div class="messages">
    <div ng-if="messages.length > 0">
        <div class="col-md-5">
            <div class="list-group">
                <a ng-repeat="message in messages" href="" class="list-group-item" ng-click="setPreviewMessage(message.contactname, message.message_id, message.email)">
                    <p><strong>@{{ message.contactname }}</strong> <@{{ message.email }}></p>
                </a>
            </div>
        </div>
        <div class="col-md-7">
            <div class="preview-container" style="padding-left: 30px;">
                <div class="message-preview" style="display: none;">
                    <div class="message-reply">
                        <div class="col-md-2 mt20"><label>Send to:</label></div>
                        <div class="col-md-2 mt20"><input type="checkbox" ng-model="sendby.email" ng-true-value="'email'" ng-false-value="'0'" ng-init="sendby.email='email'" required><label class="optionlabel">Email</label></div>
                        <div class="col-md-2 mt20"><input type="checkbox" ng-model="sendby.phone" ng-true-value="'phone'" ng-false-value="'0'" ng-init="sendby.phone='0'"><label class="optionlabel">Phone</label></div>
                        <div class="col-md-4">
                            <select class="form-control" ng-model="business_reply_form.pick_number" ng-init="business_reply_form.pick_number">
                                <option value="0">- Select A Number -</option>
                                <option ng-repeat="number in number_list" value="@{{ number }}">@{{ number }}</option>
                            </select><br>
                        </div>
                        <div class="col-md-2"></div>
                        <form ng-submit="sendBusinessReply()">
                            <textarea class="form-control" rows="5" placeholder="Write a reply..." ng-model="business_reply_form.message_reply" required></textarea>
                            <button type="submit" class="btn btn-default btn-orange">Send Reply</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div ng-if="messages.length == 0">
        <p>You currently have no messages</p>
    </div>
</div>