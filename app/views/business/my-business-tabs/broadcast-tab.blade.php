
<div class="clearfix header">
    <div class="col-md-8 col-sm-6 col-xs-12">
        <h5>BROADCAST LAYOUT & ADVERTISEMENTS</h5>
        <small>Choose and customize the look of your broadcast screen.</small>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12 mt20">
        <div class="form-group">
            <button type="submit" class="btn btn-md btn-orange" id=""><span class="glyphicon glyphicon-check"></span> SAVE</button>
            <button id="loading-img-3" style="display:none;" class="btn btn-orange btn-disabled"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
        </div>
        {{--<div role="alert" class="alert alert-info" style="padding: 10px 10px; font-size: 12px; margin-top:12px;">Check this box if there is a need to show only the numbers called by the counters.</div>--}}
    </div>
</div>

<div class="col-md-12">
    <div class="broadcast-wrap" id="ad-well">
        <div class="clearfix">
            <div class="clearfix" id="ad-well-inner">
                <div class="mb30 ui-widget ui-widget-content" id="ad-width" style="float: left; min-height:400px; border-right: 3px dotted #337ab7;">
                    <h3 class="mb30">Choose an Advertisement Type:</h3>
                    <select id="select-ads-type" name="cd-dropdown" class="form-control">
                        <option value="1">Image Slider</option>
                        <option value="2">Internet TV</option>
                        <option value="3">Numbers Only</option>
                    </select>
                    <div class="ads-type a1">
                        <div class="">
                            <div class="clearfix">
                                <div class="">
                                    <form class="form-group" method="post" action="dump.php">
                                        <div id="html5_uploader" style="width: 100%; height: 330px;">Your browser doesn't support native upload.</div>
                                        <br style="clear: both" />
                                        <input type="submit" value="Send" style="display: none;"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ads-type a2">
                        <div class="clearfix">
                            <div class="form-group">
                            <small>Choose a channel:</small>
                                <select ng-model="tv_channel" ng-init="tv_channel" id="tv-channel" class="form-control ng-pristine ng-valid ng-touched">
                                    <option value="">- Select A Channel -</option>
                                    <option value="<embed flashvars=&quot;vid=12163886&amp;autoplay=true&quot; width=&quot;100%&quot; allowfullscreen=&quot;true&quot; allowscriptaccess=&quot;always&quot; src=&quot;http://www.ustream.tv/flash/viewer.swf&quot; type=&quot;application/x-shockwave-flash&quot;>">TechCrunch TV</option>
                                    <option value="<iframe width='100%' src='http://www.ustream.tv/embed/14067349?v=3&amp;wmode=direct&amp;autoplay=true' scrolling='no' frameborder='0' style='border: 0px none transparent;'></iframe>">Arirang TV</option>
                                    <option value="<iframe width='100%' src='http://www.ustream.tv/embed/8429259?v=3&amp;wmode=direct&amp;autoplay=true' scrolling='no' frameborder='0' style='border: 0px none transparent;'></iframe>">EnergyFM Manila</option>
                                    <option value="<iframe width='100%' src='http://www.ustream.tv/embed/12762028?v=3&amp;wmode=direct&amp;autoplay=true' scrolling='no' frameborder='0' style='border: 0px none transparent;'></iframe>">Animal Planet</option>
                                </select>
                                <div class="alert alert-success" id="tvchannel-success" style="display: none;">Success! <strong><a href="/broadcast/business/16" target="_blank">View Broadcast Page</a></strong></div>
                                <div class="alert alert-danger" id="tvchannel-danger" style="display: none;">Oops! Something went wrong.</div>
                            </div>
                        </div>
                    </div>
                    <div class="ads-type a3">Numbers only</div>
                    {{--<img src="/images/broadcast/carousel/car1.jpg" id="ad-width-preview" class="center-block" style="height: 300px;">--}}
                    <div class="drag abs">
                        <div class="">Drag to resize <span class="glyphicon glyphicon-transfer"></span></div>
                    </div>
                </div>
                <div class="mb30 ui-widget ui-widget-content" id="ad-num-width" style="float: left; min-height: 400px;">
                    <h2 class="mb30 text-center">NOW SERVING</h2>
                    <div class="q-wrap q-numbers">
                        <button type="button" id="" class="mb10 btn btn-primary btn-md q-minus">
                            <span class="glyphicon glyphicon-minus"></span> Numbers
                        </button>
                        <button type="button" id="" class="mb10 btn btn-primary btn-md q-add">
                            <span class="glyphicon glyphicon-plus"></span> Numbers
                        </button>
                        <div class="q-nums-wrap clearfix">
                            <div class="qbox"><div class="pull-left half">1</div></div>
                        </div>
                    </div>
                    <div class="clearfix">
                        <span class="blue mt20" style="display: block"><input style="font-size: 30px;" type="checkbox" ng-model="show_called_only" ng-click="activateTheme(theme_type, business_id, show_called_only)"> &nbsp; Show only called numbers in broadcast page</span>
                    </div>
                </div>
            </div>
            <div class="ticker-wrap">
                <div class="ticker-field-wrap">
                    <div><input class="form-control" placeholder="Your Ticker Message Here" type="text"/></div>
                </div>
                <button type="button" id="" class="btn btn-primary btn-lg add-ticker">
                    <span class="glyphicon glyphicon-plus"></span> Add New Ticker Message
                </button>
            </div>
            {{--<div class="col-md-3">
                <button class="btn btn-orange" ng-click="addNumBoxes('ad-num-preview')">+</button>
                <button class="btn btn-orange" ng-click="reduceNumBoxes('ad-num-preview')">-</button>
                <button class="btn btn-primary btn-lg">Activate</button>
                <div class="alert alert-info" style="float: left; font-size: 14px;">Only a maximum of 10 broadcast numbers are allowed.</div>
            </div>--}}
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


{{--<div class="col-md-12">
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
</div>--}}



