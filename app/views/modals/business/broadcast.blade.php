<div role="tabpanel" class="tab-pane fade" id="bizbroadcast" aria-labelledby="profile-tab">
    <div class="col-md-12">
        <h5>BROADCAST LAYOUT</h5><br>
        <input type="checkbox" ng-model="show_called_only" ng-click="activateTheme(theme_type, business_id, show_called_only)"> Show only called numbers in broadcast page
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b1.jpg" class="mb10 img-responsive broadcast-preview">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 1-1 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 1-1 theme-btn" ng-click="activateTheme('1-1', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b2.jpg" class="mb10 img-responsive broadcast-preview">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 1-4 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 1-4 theme-btn" ng-click="activateTheme('1-4', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b3.jpg" class="mb10 img-responsive broadcast-preview">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 1-6 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 1-6 theme-btn" ng-click="activateTheme('1-6', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b4.jpg" class="mb10 img-responsive broadcast-preview">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 0-1 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-1 theme-btn" ng-click="activateTheme('0-1', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b5.jpg" class="mb10 img-responsive broadcast-preview">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 0-4 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-4 theme-btn" ng-click="activateTheme('0-4', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b6.jpg" class="mb10 img-responsive broadcast-preview">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 0-6 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-6 theme-btn" ng-click="activateTheme('0-6', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-12" style="float: left; width: 100%;">
        <h5></h5><br>
    </div>
    <div class="col-md-12" style="margin-bottom: -20px; float: left; width: 100%;">
        <h5>ADVERTISEMENT IMAGE</h5><br>
    </div>
    <div class="col-md-12" style="float: left; width: 100%;">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12" style="text-align: center;">
                    <img src="/" id="ad-preview" style="width: 100%;">
                </div>
            </div>
            <div class="col-md-4">
                <form action="/advertisement/upload" method="POST" enctype="multipart/form-data" id="ad-image-uploader">
                    <div class="form-group">
                        <label for="exampleInputFile">Choose Image to upload:</label>
                        <input name="ad_image" type="file" id="ad-image">
                        <em class="help-block">Upload images with .jpg, .png file format</em>
                        <div class="alert alert-success" id="adimage-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                        <div class="alert alert-danger" id="adimage-danger" style="display: none;">Oops! Something went wrong.</div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-orange btn-disabled"  id="image-submit-btn" value="UPLOAD" ng-click="adImageUpload(business_id)" style="color: #ffffff;"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="float: left; width: 100%;">
        <h5></h5><br>
    </div>
    <div class="col-md-12" style="margin-bottom: -20px; float: left; width: 100%;">
        <h5>INTERNET TV</h5><br>
    </div>
    <div class="col-md-12" style="float: left; width: 100%;">
        <div class="row">
            <div class="col-md-4" style="width: 100%; float: left;">
                <form action="/advertisement/embed-video" method="POST" enctype="multipart/form-data" id="ad-video-uploader">
                    <div class="form-group">
                        <label for="exampleInputFile">Paste video URL:</label>
                        <input name="ad_video" type="text" id="ad-video">
                        <em class="help-block">Internet TV can be viewed in the broadcast screen.</em>
                        <div class="alert alert-success" id="embed-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                        <div class="alert alert-danger" id="embed-danger" style="display: none;">Oops! Something went wrong.</div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-orange btn-disabled"  id="vid-submit-btn" value="EMBED" ng-click="adVideoEmbed(business_id)" style="color: #ffffff;"/>
                        <img src="/images/ajax-loader.gif" id="loading-img-2" style="display:none;" alt="Please Wait"/>
                    </div>
                </form>
                <div>
                    <input type="checkbox" ng-model="tv_status" ng-click="turnOnTV(business_id)" id="tv-status"> <label><strong>Turn on TV and Disable Image Ads?</strong></label>
                    <div class="alert alert-success" id="turnon-success" style="display: none;">Success! <strong><a href="/broadcast/business/@{{ business_id }}" target="_blank">View Broadcast Page</a></strong></div>
                    <div class="alert alert-danger" id="turnon-danger" style="display: none;">Oops! Something went wrong.</div>
                </div>
            </div>
        </div>
    </div>
</div>