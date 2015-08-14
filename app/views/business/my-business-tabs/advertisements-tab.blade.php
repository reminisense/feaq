    <div class="clearfix header">
        <h5>ADVERTISEMENT</h5>
        <small>Display advertisements on your broadcast screen. Choose either Internet TV or Image/Video</small>
    </div>
    <div class="col-md-6 col-xs-12 col-sm-12">
        <div class="well" style="min-height:244px;">
            <h4>Internet TV
                {{--<small>Internet TV can be viewed in the broadcast screen.</small>--}}
            </h4>
            <form ng-submit="selectTV(business_id)" id="tv-channel-select">
                <div class="form-group">
                    <small>Choose channel:</small>
                    <select ng-model="tv_channel" ng-init="tv_channel" id="tv-channel" class="form-control">
                        <option value="">- Select A Channel -</option>
                        @include('business.my-business-tabs.channels')
                    </select>
                    <div class="alert alert-success" id="tvchannel-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                    <div class="alert alert-danger" id="tvchannel-danger" style="display: none;">Oops! Something went wrong.</div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-orange"  id="tv-script-submit-btn" disabled><span class="glyphicon glyphicon-check"></span> SELECT</button>
                    <button id="loading-img-3" style="display:none;" class="btn btn-orange btn-disabled"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
                </div>
            </form>
        </div>
        <div class="well">
            <h4>Announcement Ticker
                {{--<small>Internet TV can be viewed in the broadcast screen.</small>--}}
            </h4>

            <form ng-submit="setTicker(business_id)" id="set-ticker">
                <div class="form-group">
                    <small>Message:</small><br>
                    <span class="label label-info" id="lbl-ticker" style="visibility: hidden;"> @{{ remaining_character }} remaining characters left</span>
                    <input type="text" ng-model="ticker_message" id="ticker-message" ng-keyup="setRemainingCharacter()"  class="form-control"/>
                    <span class="label label-info"  id="lbl-ticker2" style="visibility: hidden;"> @{{ remaining_character2 }} remaining characters left</span>
                    <input type="text" ng-model="ticker_message2" id="ticker-message2" ng-keyup="setRemainingCharacter()"  class="form-control"/>
                    <span class="label label-info"  id="lbl-ticker3" style="visibility: hidden;"> @{{ remaining_character3 }} remaining characters left</span>
                    <input type="text" ng-model="ticker_message3" id="ticker-message3" ng-keyup="setRemainingCharacter()"  class="form-control"/>
                    <span class="label label-info"  id="lbl-ticker4" style="visibility: hidden;"> @{{ remaining_character4 }} remaining characters left</span>
                    <input type="text" ng-model="ticker_message4" id="ticker-message4" ng-keyup="setRemainingCharacter()"  class="form-control"/>
                    <span class="label label-info"  id="lbl-ticker5" style="visibility: hidden;"> @{{ remaining_character5 }} remaining characters left</span>
                    <input type="text" ng-model="ticker_message5" id="ticker-message5" ng-keyup="setRemainingCharacter()"  class="form-control"/>
                    <div class="alert alert-success" id="ticker-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                    <div class="alert alert-danger" id="ticker-danger" style="display: none;">Oops! Something went wrong.</div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-orange"  id="ticker-message-submit-btn"><span class="glyphicon glyphicon-check"></span> SAVE</button>
                    <button id="loading-img-3" style="display:none;" class="btn btn-orange btn-disabled"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-md-6 col-xs-12 col-sm-12">
        <div class="well">
        <h4>Image or Video
            {{--<small>Choose whether to put an image or video in your broadcast screen.</small>--}}
        </h4>
            <div class="clearfix">
                    <label><input type="radio" name="ad_type" value="image" ng-model="ad_type" ng-change="adType(ad_type, business_id)"> <strong>Image</strong></label>&nbsp;&nbsp;
                <div class="clearfix">
                    <div class="col-md-12">
                        <div role="alert" class="alert alert-info">
                            <strong>* Video Embedding Feature</strong> will soon be enjoyed by business partners that have been in close contact with us.
                            To be one of these partners, you may contact us at <strong><a href="mailto:contact@featherq.com">contact@featherq.com</a></strong>.
                            You may also call us at <strong>(+63 32) 345-4658</strong> for further inquiries.
                        </div>
                    </div>
                </div>
            </div>
            <br>
            {{--<div class="col-md-6 col-sm-12">
                 <div role="alert" class="alert alert-info" style="padding: 10px 10px; font-size: 12px;">Choose whether to put an image or video in your broadcast screen.</div>
            </div>--}}
            <div class="clearfix" id="image-adtype">
                <div class="col-md-12">
                    <form class="form-group" method="post" action="dump.php">
                        <div id="html5_uploader" style="width: 100%; height: 330px;">Your browser doesn't support native upload.</div>
                        <br style="clear: both" />
                        <input type="submit" value="Send" style="display: none;"/>
                    </form>
                    <div class="alert alert-success" id="adimage-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <form ng-submit="setCarouselDelay()">
                        <div class="col-md-4 col-xs-6">
                            <small>Transition Time Delay: (seconds)</small>
                        </div>
                        <div class="col-md-4 col-xs-6">
                            <input type="number" min="0" step="1" ng-model="carousel_delay" class="form-control" width="30px">
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <button type="submit" class="btn btn-orange" style="width: 100%;"><span class="glyphicon glyphicon-check"></span> SAVE</button>
                        </div>
                    </form>
                    <div class="col-md-12">
                        <div class="alert alert-success" id="carouseldelay-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                        <div class="alert alert-danger" id="carouseldelay-danger" style="display: none;">Oops! Something went wrong.</div>
                    </div>
                </div>
                <div class="col-md-12" style="text-align: center; max-height: 300px; overflow: scroll;">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td ng-repeat="slider in slider_images" id="slide@{{ slider.count }}">
                                    <div class="row"><img ng-src="/@{{ slider.path }}" height="240px" style="padding-left: 20px; margin-bottom: 5px;"></div>
                                    <div class="row" style="padding-left: 20px;"><button class="btn btn-danger" ng-click="deleteImageSlide(business_id, slider.count, slider.path);">Remove</button></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>






