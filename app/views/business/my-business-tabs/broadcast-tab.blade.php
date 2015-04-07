<div role="tabpanel" class="row" id="bizbroadcast" aria-labelledby="profile-tab">
    <div class="col-md-12">
        <h5>BROADCAST LAYOUT</h5>
        <div role="alert" class="alert alert-info" style="padding: 0px 10px; font-size: 11px;">Change the look of your broadcast screen here.</div>
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
        <img src="images/icon-b1.jpg" class="mb10 img-responsive broadcast-preview">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 2-1 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 2-1 theme-btn" ng-click="activateTheme('2-1', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b2.jpg" class="mb10 img-responsive broadcast-preview">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 2-4 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 2-4 theme-btn" ng-click="activateTheme('2-4', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b3.jpg" class="mb10 img-responsive broadcast-preview">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 2-6 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 2-6 theme-btn" ng-click="activateTheme('2-6', business_id, show_called_only)">Activate</a>
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
    <div class="col-md-12">
        <strong><input type="checkbox" ng-model="show_called_only" ng-click="activateTheme(theme_type, business_id, show_called_only)"> Show only called numbers in broadcast page</strong>
        <div role="alert" class="alert alert-info" style="padding: 0px 10px; font-size: 11px;">Check this box if there is a need to show only the numbers called by the counters.</div>
    </div>
    <div class="col-md-12">
        <h5></h5><br>
    </div>
    <div class="col-md-12">
        <h5>INTERNET TV</h5>
        <div role="alert" class="alert alert-info" style="padding: 0px 10px; font-size: 11px;">Internet TV can be viewed in the broadcast screen.</div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <form ng-submit="selectTV(business_id)" id="tv-channel-select">
                    <div class="form-group">
                        <label for="exampleInputFile">Choose channel:</label>
                        <select ng-model="tv_channel" id="tv-channel">
                            <option value="<iframe SRC='http://www.newtvworld.com/livetv/india/AnimalPlanet.html' width='100%' height='400' id=www.Newtvworld.com marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling='no'></iframe>">Animal Planet</option>
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
        </div>
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
                            <em class="help-block">Upload images with .jpg, .png file format</em>
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
                            <input ng-model="ad_video" type="text" id="ad-video">
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
</div>