<div role="tabpanel" class="tab-pane fade" id="bizbroadcast" aria-labelledby="profile-tab">
    <div class="col-md-12">
        <h5>BROADCAST LAYOUT</h5><br>
        <input type="checkbox" ng-model="show_called_only" ng-click="activateTheme(theme_type, business_id, show_called_only)"> Show only called numbers in broadcast page
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b1.jpg" class="mb10 img-responsive">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 1-1 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 1-1 theme-btn" ng-click="activateTheme('1-1', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b2.jpg" class="mb10 img-responsive">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 1-4 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 1-4 theme-btn" ng-click="activateTheme('1-4', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b3.jpg" class="mb10 img-responsive">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 1-6 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 1-6 theme-btn" ng-click="activateTheme('1-6', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b4.jpg" class="mb10 img-responsive">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 0-1 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-1 theme-btn" ng-click="activateTheme('0-1', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b5.jpg" class="mb10 img-responsive">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 0-4 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-4 theme-btn" ng-click="activateTheme('0-4', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-4 col-xs-6 mb20">
        <img src="images/icon-b6.jpg" class="mb10 img-responsive">
                                    <span class="inline-btns">
                                        <p class="orange h5 nomg 0-6 activated" style="display: none;">Active</p>
                                        <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-6 theme-btn" ng-click="activateTheme('0-6', business_id, show_called_only)">Activate</a>
                                    </span>
    </div>
    <div class="col-md-12">
        <h5></h5><br>
    </div>
    <div class="col-md-12">
        <h5>ADVERTISEMENT IMAGE</h5><br>
    </div>
    <div class="ad-image-preview">

    </div>
    <div style="width: 100%; float: left;">
        <form action="/advertisement/upload" method="POST" enctype="multipart/form-data" id="ad-image-uploader">
            <input name="ad_image" id="ad-image" type="file" />
            <input type="submit"  id="submit-btn" value="Upload" ng-click="adImageUpload(business_id)"/>
            <img src="/images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
        </form>
        <div style="text-align: center;">
            <img src="/" id="ad-preview" width="555px">
        </div>
    </div>
</div>