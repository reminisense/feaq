<div class="clearfix header">
    <h5>ADVERTISEMENT</h5>
    <small>Display advertisements on your broadcast screen. Choose either Internet TV or Image/Video</small>
</div>

    <div class="col-md-6 col-xs-12 col-sm-12">
        <div class="well">
            <h5>INTERNET TV
                {{--<small>Internet TV can be viewed in the broadcast screen.</small>--}}
            </h5>

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
                            <button type="submit" class="btn btn-orange"  id="tv-script-submit-btn"><span class="glyphicon glyphicon-check"></span> SELECT</button>
                            <button id="loading-img-3" style="display:none;" class="btn btn-orange btn-disabled"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
                        </div>
            </form>
        </div>
    </div>
    <div class="col-md-6 col-xs-12 col-sm-12">
        <div class="well">
        <h5>IMAGE OR VIDEO
            {{--<small>Choose whether to put an image or video in your broadcast screen.</small>--}}
        </h5>
            <div class="clearfix">
                    <label><input type="radio" name="ad_type" value="image" ng-model="ad_type" ng-change="adType(ad_type, business_id)"> <strong>Image</strong></label><label><input style="margin-left: 10px;" type="radio" name="ad_type" value="video" ng-model="ad_type" ng-change="adType(ad_type, business_id)"> <strong>Video</strong></label>
            </div>
            <br>
            {{--<div class="col-md-6 col-sm-12">
                 <div role="alert" class="alert alert-info" style="padding: 10px 10px; font-size: 12px;">Choose whether to put an image or video in your broadcast screen.</div>
            </div>--}}
            <div class="clearfix" id="image-adtype">
                <div class="col-md-12">
                    <form action="/advertisement/upload-image" method="POST" enctype="multipart/form-data" id="ad-image-uploader">
                        <div class="form-group">
                            <label for="exampleInputFile"><strong>Choose Image to Upload:</strong></label>
                            <input name="ad_image" type="file" id="ad-image" required>
                            <em class="help-block">Upload images with .jpg, .png file format. Best resolution is 800 x 803 pixels.</em>
                            <div class="alert alert-success" id="adimage-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                            <div class="alert alert-danger" id="adimage-danger" style="display: none;">Oops! Something went wrong.</div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-orange" id="image-submit-btn" ng-click="adImageUpload(business_id)" style="color: #ffffff;"><span class="glyphicon glyphicon-check"></span> UPLOAD</button>
                            <button id="loading-img" style="display:none;" class="btn btn-orange btn-disabled"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12" style="text-align: center;">
                    <img src="/" id="ad-preview" style="width: 100%;">
                </div>
            </div>
            <div class="clearfix" id="video-adtype">
                <div class="col-md-12">
                    <form ng-submit="adVideoEmbed(business_id)" id="ad-video-uploader">
                        <div class="form-group">
                            <label for="exampleInputFile"><strong>YouTube URL:</strong></label>
                            <input ng-model="ad_video" type="text" id="ad-video" required>
                            <div class="alert alert-success" id="advideo-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                            <div class="alert alert-danger" id="advideo-danger" style="display: none;">Oops! Something went wrong.</div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-orange" id="image-submit-btn" style="color: #ffffff;"><span class="glyphicon glyphicon-check"></span> EMBED</button>
                            <button id="loading-img-2" style="display:none;" class="btn btn-orange btn-disabled"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12" style="text-align: center;">
                    <iframe width="100%" height="315" src="" id="advideo-preview"></iframe>
                </div>
            </div>
        </div>
    </div>




