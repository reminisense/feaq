
    <div class="col-md-12">
        <h5>INTERNET TV</h5>
        <div role="alert" class="alert alert-info" style="padding: 0px 10px; font-size: 11px;">Internet TV can be viewed in the broadcast screen.</div>
    </div>
    <div class="col-md-6">
        <form ng-submit="selectTV(business_id)" id="tv-channel-select">
            <div class="form-group">
                <small>Choose channel:</small>
                <select ng-model="tv_channel" ng-init="tv_channel" id="tv-channel" class="form-control" style="width: 40%;">
                    <option value="">- Select A Channel -</option>
                    @include('business.my-business-tabs.channels')
                </select>
                <div class="alert alert-success" id="tvchannel-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                <div class="alert alert-danger" id="tvchannel-danger" style="display: none;">Oops! Something went wrong.</div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-orange"  id="tv-script-submit-btn" value="SELECT" style="color: #ffffff;"/>
                <button id="loading-img-3" style="display:none;" class="btn btn-orange btn-disabled"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <h5></h5><br>
    </div>
    <div class="col-md-12">
        <h5>ADVERTISEMENT IMAGE & VIDEO</h5>
    </div>
    <div class="col-md-12">
        <label><input type="radio" name="ad_type" value="image" ng-model="ad_type" ng-change="adType(ad_type, business_id)"> <strong>Image</strong></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" name="ad_type" value="video" ng-model="ad_type" ng-change="adType(ad_type, business_id)"> <strong>Video</strong></label>
        <div role="alert" class="alert alert-info" style="padding: 0px 10px; font-size: 11px;">Choose whether to put an image or video in your broadcast screen.</div>
    </div>
    <div class="col-md-12" style="float: left; width: 100%;">
        <div class="row">
            <div id="image-adtype">
                <div class="col-md-6">
                    <div class="col-md-12" style="text-align: center;">
                        <img src="/" id="ad-preview" style="width: 100%;">
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="/advertisement/upload-image" method="POST" enctype="multipart/form-data" id="ad-image-uploader">
                        <div class="form-group">
                            <label for="exampleInputFile"><strong>Choose Image to Upload:</strong></label>
                            <input name="ad_image" type="file" id="ad-image">
                            <em class="help-block">Upload images with .jpg, .png file format. Best resolution is 800 x 803 pixels.</em>
                            <div class="alert alert-success" id="adimage-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                            <div class="alert alert-danger" id="adimage-danger" style="display: none;">Oops! Something went wrong.</div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-orange"  id="image-submit-btn" value="UPLOAD" ng-click="adImageUpload(business_id)" style="color: #ffffff;"/>
                            <button id="loading-img" style="display:none;" class="btn btn-orange btn-disabled"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
                        </div>
                    </form>
                </div>
            </div>
            <div id="video-adtype">
                <div class="col-md-6">
                    <div class="col-md-12" style="text-align: center;">
                        <iframe width="100%" height="315" src="" id="advideo-preview"></iframe>
                    </div>
                </div>
                <div class="col-md-4">
                    <form ng-submit="adVideoEmbed(business_id)" id="ad-video-uploader">
                        <div class="form-group">
                            <label for="exampleInputFile"><strong>Paste YouTube URL:</strong></label>
                            <input ng-model="ad_video" type="text" id="ad-video" required>
                            <div class="alert alert-success" id="advideo-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                            <div class="alert alert-danger" id="advideo-danger" style="display: none;">Oops! Something went wrong.</div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-orange"  id="image-submit-btn" value="EMBED" style="color: #ffffff;"/>
                            <button id="loading-img-2" style="display:none;" class="btn btn-orange btn-disabled"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="float: left; width: 100%;">
        <h5></h5><br>
    </div>
