<div class="row">
    <div class="col-md-12">
        <h5>BROADCAST LAYOUT</h5>
        <div role="alert" class="alert alert-info" style="padding: 0px 10px; font-size: 11px;">Change the look of your broadcast screen here.</div>
    </div>
    <!-- -->
    <div class="col-md-12">
        <h6>Image Advertisement Options: </h6>
        <div class="well">
            <div class="row">
                <div class="col-md-4 col-xs-6 mb20">
                    <img src="/images/icon-b1.jpg" class="mb10 img-responsive broadcast-preview">
                                            <span class="inline-btns">
                                                <p class="orange h5 nomg 1-1 activated" style="display: none;">Active</p>
                                                <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 1-1 theme-btn" ng-click="activateTheme('1-1', business_id, show_called_only)">Activate</a>
                                            </span>
                </div>
                <div class="col-md-4 col-xs-6 mb20">
                    <img src="/images/icon-b2.jpg" class="mb10 img-responsive broadcast-preview">
                                            <span class="inline-btns">
                                                <p class="orange h5 nomg 1-4 activated" style="display: none;">Active</p>
                                                <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 1-4 theme-btn" ng-click="activateTheme('1-4', business_id, show_called_only)">Activate</a>
                                            </span>
                </div>
                <div class="col-md-4 col-xs-6 mb20">
                    <img src="/images/icon-b3.jpg" class="mb10 img-responsive broadcast-preview">
                                            <span class="inline-btns">
                                                <p class="orange h5 nomg 1-6 activated" style="display: none;">Active</p>
                                                <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 1-6 theme-btn" ng-click="activateTheme('1-6', business_id, show_called_only)">Activate</a>
                                            </span>
                </div>
            </div>
        </div>
    </div>

    <!-- -->
    <div class="col-md-12">
        <h6>Internet TV Options: </h6>
        <div class="well">
            <div class="row">
                <div class="col-md-4 col-xs-6 mb20">
                    <img src="/images/icon-b1.jpg" class="mb10 img-responsive broadcast-preview">
                                                <span class="inline-btns">
                                                    <p class="orange h5 nomg 2-1 activated" style="display: none;">Active</p>
                                                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 2-1 theme-btn" ng-click="activateTheme('2-1', business_id, show_called_only)">Activate</a>
                                                </span>
                </div>
                <div class="col-md-4 col-xs-6 mb20">
                    <img src="/images/icon-b2.jpg" class="mb10 img-responsive broadcast-preview">
                                                <span class="inline-btns">
                                                    <p class="orange h5 nomg 2-4 activated" style="display: none;">Active</p>
                                                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 2-4 theme-btn" ng-click="activateTheme('2-4', business_id, show_called_only)">Activate</a>
                                                </span>
                </div>
                <div class="col-md-4 col-xs-6 mb20">
                    <img src="/images/icon-b3.jpg" class="mb10 img-responsive broadcast-preview">
                                                <span class="inline-btns">
                                                    <p class="orange h5 nomg 2-6 activated" style="display: none;">Active</p>
                                                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 2-6 theme-btn" ng-click="activateTheme('2-6', business_id, show_called_only)">Activate</a>
                                                </span>
                </div>
            </div>
        </div>
    </div>

    <!-- -->
    <div class="col-md-12">
        <h6>Numbers Only Options: </h6>
        <div class="well">
            <div class="row">
                <div class="col-md-4 col-xs-6 mb20">
                    <img src="/images/icon-b4.jpg" class="mb10 img-responsive broadcast-preview">
                                                <span class="inline-btns">
                                                    <p class="orange h5 nomg 0-1 activated" style="display: none;">Active</p>
                                                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-1 theme-btn" ng-click="activateTheme('0-1', business_id, show_called_only)">Activate</a>
                                                </span>
                </div>
                <div class="col-md-4 col-xs-6 mb20">
                    <img src="/images/icon-b5.jpg" class="mb10 img-responsive broadcast-preview">
                                                <span class="inline-btns">
                                                    <p class="orange h5 nomg 0-4 activated" style="display: none;">Active</p>
                                                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-4 theme-btn" ng-click="activateTheme('0-4', business_id, show_called_only)">Activate</a>
                                                </span>
                </div>
                <div class="col-md-4 col-xs-6 mb20">
                    <img src="/images/icon-b6.jpg" class="mb10 img-responsive broadcast-preview">
                                                <span class="inline-btns">
                                                    <p class="orange h5 nomg 0-6 activated" style="display: none;">Active</p>
                                                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-6 theme-btn" ng-click="activateTheme('0-6', business_id, show_called_only)">Activate</a>
                                                </span>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <strong><input type="checkbox" ng-model="show_called_only" ng-click="activateTheme(theme_type, business_id, show_called_only)"> Show only called numbers in broadcast page</strong>
        <div role="alert" class="alert alert-info" style="padding: 0px 10px; font-size: 11px;">Check this box if there is a need to show only the numbers called by the counters.</div>
    </div>
</div>