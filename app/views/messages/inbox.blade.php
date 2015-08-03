@extends('dashboard')

@section('subtitle')
    My Messages
@stop

@section('styles')
    <link rel='stylesheet' type='text/css' href='/css/business/business.css'>
    <link rel='stylesheet' type='text/css' href='/css/business/responsive.css'>
@stop

@section('scripts')
    <script src="/js/dashboard/messages.js"></script>
    <script>
        UPLOADCARE_LOCALE = "en";
        UPLOADCARE_TABS = "file";
        UPLOADCARE_PUBLIC_KEY = "844c2b9e554c2ee5cc0a";
    </script>
    <script charset="utf-8" src="//ucarecdn.com/widget/2.3.4/uploadcare/uploadcare.full.min.js"></script>
@stop

@section('container')
    <div class="feat feat-business">
        <div class="container">
            <div class="text-center">
                <h1><span class="glyphicon glyphicon-envelope"></span>My Messages</h1>
            </div>
        </div>
        <div class="arrow">
            <img src="/img/arrow.png">
        </div>
    </div>
    <div class="container" ng-controller="messagingController" id="messageInbox">
        <div class="row"><p></p></div>
        <div class="row">
            <div class="biz-navs">
                <div id="messages-wrap" class="form-group row">
                    <ul role="tablist" class="nav nav-tabs" id="bizTab">
                        <li class="active"><a data-toggle="tab" ng-click="displayBusinessInbox()"><span class="glyphicon glyphicon-inbox"></span> My Inbox</a></li>
                        <li class=""><a data-toggle="tab" ng-click="displayOtherInbox()"><span class="glyphicon glyphicon-share-alt"></span> Sent Messages</a></li>
                    </ul>
                    <div id="bizTabContent" class="tab-content" style="">
                        <div class="messages">
                            <div class="col-md-12 business-inbox" style="margin-bottom:20px;">
                                <div aria-label="Large button group" role="group" class="btn-group btn-group-lg" id="assigned-businesses">
                                    <button class="btn btn-biz business-tab" type="button" ng-repeat="assigned_business in assigned_businesses" ng-click="filterMessages(assigned_business.business_id);">@{{ assigned_business.business_name }}</button>
                                </div>
                            </div>
                            <div class="col-md-12 hidden">
                                <button class="btn btn-orange form-control" id="mobile-back-button">Back to Messages</button>
                            </div>
                            <div class="clearfix">
                                <div ng-if="messages.length > 0">
                                    <div class="col-md-5 message-collection">
                                        <div class="list-group">
                                            <a ng-repeat="message in messages" href="" class="list-group-item message-item"
                                               ng-click="setPreviewMessage(business_reply_form.preview_type, message.contactname, message.message_id, message.email)"
                                               business_id="@{{ message.business_id }}">
                                                Between You and <strong>@{{ message.contactname }}</strong>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="preview-container">
                                            <div class="message-preview" style="display: none;">
                                                <div style="max-height: 450px; overflow: scroll;">
                                                    <div class="thread-boundary"></div>
                                                </div>
                                                <div class="message-reply clearfix">
                                                    <form ng-submit="sendBusinessReply(business_reply_form.preview_type)">
                                                    <div class="col-md-12">
                                                        <textarea id="sendreplytext" class="form-control" rows="5" placeholder="Write a reply..." ng-model="business_reply_form.message_reply" required></textarea>
                                                    </div>
                                                    <div class="clearfix">
                                                        <div class="col-md-9 col-xs-12">
                                                            <input type="hidden" role="uploadcare-uploader" data-crop="disabled" id="business-attachment" />
                                                            <em class="help-block">Upload is limited to documents and images up to 5MB.</em>
                                                        </div>
                                                        <div class="col-md-3 col-xs-12">
                                                            <button id="sendreply" type="submit" class="btn btn-orange">Send Reply</button>
                                                        </div>
                                                    </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div ng-if="messages.length == 0">
                                <p style="margin-left: 10px;">You currently have no messages</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop