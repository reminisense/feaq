
<script>
    UPLOADCARE_LOCALE = "en";
    UPLOADCARE_TABS = "file";
    UPLOADCARE_PUBLIC_KEY = "844c2b9e554c2ee5cc0a";
</script>
<script charset="utf-8" src="//ucarecdn.com/widget/2.3.4/uploadcare/uploadcare.full.min.js"></script>

<div class="clearfix header">
    <h5>MESSAGES</h5>
</div>
<div class="messages">
    <div ng-if="messages.length > 0">
        <div class="col-md-12">
            <button class="btn btn-orange form-control hidden" id="mobile-back-button">Back to Messages</button>
        </div>
        <div class="col-md-5 message-collection">
            <div class="list-group">
                <a ng-repeat="message in messages" href="" class="list-group-item message-item" ng-click="setPreviewMessage(message.contactname, message.message_id, message.email)">
                    <p><strong>@{{ message.contactname }}</strong> <@{{ message.email }}></p>
                </a>
            </div>
        </div>
        <div class="col-md-7">
            <div class="preview-container">
                <div class="message-preview" style="display: none;">
                    <div style="height: 450px; overflow: scroll;">
                        <div class="thread-boundary"></div>
                    </div>
                    <div class="message-reply">
                            <div class="col-md-2 mt20"><label>Send via:</label></div>
                            <div class="col-md-2 mt20"><input id="sendbyphone" type="checkbox" ng-model="sendby.phone" ng-true-value="'phone'" ng-false-value="'0'" ng-init="sendby.phone='0'"><label class="optionlabel">Phone</label></div>
                            <div class="col-md-4" id="select-phone-div">
                                <select class="form-control phone-select" ng-model="business_reply_form.pick_number" ng-init="business_reply_form.pick_number">
                                    <option value="0">- Select A Number -</option>
                                    <option ng-repeat="number in number_list" value="@{{ number }}">@{{ number }}</option>
                                </select>
                            </div>
                            <div class="col-md-4"></div>

                            <div class="col-md-12">
                                 <div role="alert" class="alert alert-info" style="margin-top: 10px; padding: 0px 10px; font-size: 12px;">Your reply will be sent via email. Please select Phone if you wish to send including SMS.</div>
                            </div>

                            <div class="col-md-12">
                                <form ng-submit="sendBusinessReply()">
                                    <textarea id="sendreplytext" class="form-control" rows="5" placeholder="Write a reply..." ng-model="business_reply_form.message_reply" required></textarea>
                                    <input type="hidden" role="uploadcare-uploader" data-crop="disabled" id="business-attachment" />
                                    <em class="help-block">Upload is limited to documents and images up to 5MB.</em>
                                    <button id="sendreply" type="submit" class="btn btn-orange">Send Reply</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div ng-if="messages.length == 0">
        <p>You currently have no messages</p>
    </div>
</div>