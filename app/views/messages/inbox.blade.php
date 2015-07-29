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
                <div class="form-group row">
                    <ul role="tablist" class="nav nav-tabs" id="bizTab">
                        <li class="active"><a data-toggle="tab" ng-click="displayBusinessInbox()"><span class="glyphicon glyphicon-list-alt"></span> Business Inbox</a></li>
                        <li class=""><a data-toggle="tab" ng-click="displayOtherInbox()"><span class="glyphicon glyphicon-tasks"></span> Other Inbox</a></li>
                    </ul>
                    <div id="bizTabContent" class="tab-content" style="">
                        <div class="messages">
                            <div class="col-md-12">
                                <div aria-label="Large button group" role="group" class="btn-group btn-group-lg" id="assigned-businesses">
                                    <button class="btn btn-default" type="button" ng-repeat="assigned_business in assigned_businesses">@{{ assigned_business.business_name }}</button>
                                </div>
                            </div>
                            <div class="clearfix">
                                <div ng-if="messages.length > 0">
                                    <div class="col-md-12">
                                        <button class="btn btn-orange form-control hidden" id="mobile-back-button">Back to Messages</button>
                                    </div>
                                    <div class="col-md-5 message-collection">
                                        <div class="list-group">
                                            <a ng-repeat="message in messages" href="" class="list-group-item message-item" ng-click="setPreviewMessage(business_reply_form.preview_type, message.contactname, message.message_id, message.email)">
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
                                                <div class="message-reply">
                                                    <div class="col-md-12">
                                                        <form ng-submit="sendBusinessReply(business_reply_form.preview_type)">
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
                            </div>
                            <div ng-if="messages.length == 0">
                                <p>You currently have no messages</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop