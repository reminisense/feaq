
<div class="clearfix header">
    <div class="col-md-8 col-sm-6 col-xs-12">
        <h5>BROADCAST LAYOUT</h5>
        <small>Choose and customize the look of your broadcast screen.</small>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12 mt20">
        <strong class="blue"><input style="font-size: 30px;" type="checkbox" ng-model="show_called_only" ng-click="activateTheme(theme_type, business_id, show_called_only)"> &nbsp; Show only called numbers in broadcast page</strong>
        {{--<div role="alert" class="alert alert-info" style="padding: 10px 10px; font-size: 12px; margin-top:12px;">Check this box if there is a need to show only the numbers called by the counters.</div>--}}
    </div>
</div>

<div class="col-md-12">
    <div class="well" id="ad-well">
        <div class="row">
            <div class="col-md-3 col-xs-12 mb20">
                <h4>Image Advertisement Options:</h4>
                <small>Put a sliding images on your broadcast screen</small>
            </div>
            <div class="col-md-6">
                <div class="ui-widget ui-widget-content" id="ad-width" style="float: left; height: 300px; border-right: 3px solid;">
                    <img src="/images/broadcast/carousel/car1.jpg" id="ad-width-preview" class="center-block" style="height: 300px;">
                </div>
                <div class="ui-widget ui-widget-content" id="ad-num-width" style="float: left; height: 300px;">
                    <table id="ad-num-preview">

                    </table>
                </div>
                <div class="alert alert-info" style="float: left; font-size: 14px;">Drag line to resize broadcast screen.</div>
            </div>
            <div class="col-md-3">
                <button class="btn btn-orange" ng-click="addNumBoxes('ad-num-preview')">+</button>
                <button class="btn btn-orange" ng-click="reduceNumBoxes('ad-num-preview')">-</button>
                <button class="btn btn-primary btn-lg">Activate</button>
                <div class="alert alert-info" style="float: left; font-size: 14px;">Only a maximum of 10 broadcast numbers are allowed.</div>
            </div>
            <!--
            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b1.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 1-1 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="mb20 btn-boxy btn-xs btn-adduser btn-primary 1-1 theme-btn" ng-click="activateTheme('1-1', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b2.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 1-4 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="mb20 btn-boxy btn-xs btn-adduser btn-primary 1-4 theme-btn" ng-click="activateTheme('1-4', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b3.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 1-6 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="mb20 btn-boxy btn-xs btn-adduser btn-primary 1-6 theme-btn" ng-click="activateTheme('1-6', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>
            -->
        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="well">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <h4>Internet TV Options: </h4>
                <small>Choose a pre-defined TV channel on your broadcast screen</small>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b1.2.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 2-1 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 2-1 theme-btn" ng-click="activateTheme('2-1', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b4.2.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 2-4 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 2-4 theme-btn" ng-click="activateTheme('2-4', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b6.2.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 2-6 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 2-6 theme-btn" ng-click="activateTheme('2-6', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>
        </div>
        <div class="row mt10">
            <div class="col-md-3 col-sm-6 col-xs-12"></div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b2.2.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 3-4 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 3-4 theme-btn" ng-click="activateTheme('3-4', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>

            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b3.2.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 3-6 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 3-6 theme-btn" ng-click="activateTheme('3-6', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- -->
<div class="col-md-12">
    <div class="well">

        <div class="row">
            <div class="col-md-3 col-xs-12">
                <h4>Numbers Only Options: </h4>
                <small>Just show only what matters, queue numbers!</small>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b4.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 0-1 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-1 theme-btn" ng-click="activateTheme('0-1', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b5.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 0-4 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-4 theme-btn" ng-click="activateTheme('0-4', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <img src="/images/icon-b6.jpg" class="mb10 img-responsive broadcast-preview">
                <span class="inline-btns">
                    <p class="orange h5 nomg 0-6 activated" style="display: none;"><span class="glyphicon glyphicon-ok"></span> Active</p>
                    <a href="#" class="btn-boxy btn-xs btn-adduser btn-primary 0-6 theme-btn" ng-click="activateTheme('0-6', business_id, show_called_only)"><span class="glyphicon glyphicon-pushpin"></span> Activate</a>
                </span>
            </div>
        </div>
    </div>
</div>



