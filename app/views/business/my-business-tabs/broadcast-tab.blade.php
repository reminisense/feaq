
<div class="clearfix header">
    <div class="col-md-8 col-sm-6 col-xs-12">
        <h5>BROADCAST LAYOUT & ADVERTISEMENTS</h5>
        <small>Choose and customize the look of your broadcast screen.</small>
    </div>
</div>

<div class="col-md-12">
    <div class="broadcast-wrap" id="ad-well">
        <div class="clearfix">
            <div class="col-md-4">
                <h3 class="mb20">Choose an Advertisement Type:</h3>
                <select id="select-ads-type" name="cd-dropdown" class="form-control" ng-model="settings.ad_type" ng-init="settings.ad_type">
                    <option value="carousel">Image Carousel</option>
                    <option value="movie">Movie List</option>
                    <option value="internet_tv">Internet TV</option>
                    <option value="numbers_only">Numbers Only</option>
                </select>
            </div>
            {{--<div class="col-md-8">
                <div role="alert" class="alert alert-warning">
                    <strong>* Video Embedding Feature</strong> will soon be enjoyed by business partners that have been in close contact with us.
                    To be one of these partners, you may contact us at <strong><a href="mailto:contact@featherq.com">contact@featherq.com</a></strong>.
                    You may also call us at <strong>(+63 32) 345-4658</strong> for further inquiries.
                </div>
            </div>--}}
        </div>
        <div class="clearfix">
        <div class="col-md-12" id="qrcode-widget">
            <a href="" id="toggle-qrcode" class="mb20 btn btn-md btn-primary" show_qr="no"><i class="glyphicon glyphicon-qrcode"></i> Show QR Code</a>
            <div class="clearfix qrcode-wrap">
                <div class="clearfix text-center abs" id="qrcode-size">
                    FeatherQ.com
                </div>
                <p>Monitor via phone</p>
                    <img src="/images/qrcode.jpg" />
                <p id="qrcode-link">featherq.com/<span>ABCD</span></p>
            </div>
        </div>
            <div class="clearfix" id="ad-well-inner">
                <div class="mb30 ui-widget ui-widget-content" id="ad-width" style="float: left; min-height:400px; border-right: 3px dotted #337ab7;">
                    <div class="ads-type acarousel">
                        <div class="clearfix">
                            <div class="col-md-12">
                                <div class="">
                                    <form class="form-group" method="post" action="dump.php">
                                        <div id="html5_uploader" style="width: 100%; height: 330px;">Your browser doesn't support native upload.</div>
                                        <br style="clear: both" />
                                        <input type="submit" value="Send" style="display: none;"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix" style="margin-top: 80px;">
                            <div class="col-md-12 reorder-note" >
                                <div class="alert alert-warning" style="font-size: 12px;">Reorder Images as they Appear in the Broadcast Screen. You might have to refresh the broadcast screen after re-ordering.</div>
                            </div>
                            <div class="col-md-12 table-responsive reorder-images">
                                <table class="table table-striped" id="ad-images-preview">
                                    <tbody>
                                    <tr ng-repeat="slider in slider_images" id="slide@{{ slider.count }}" img_id="@{{ slider.img_id }}" img_weight="@{{ slider.weight }}">
                                        <td>
                                            <span class="glyphicon glyphicon-move" style="font-size: 20px;"></span>
                                        </td>
                                        <td>
                                            <img ng-src="/@{{ slider.path }}" style="max-height: 100px; max-width: 300px;">
                                        </td>
                                        <td>
                                            <button class="btn btn-danger" ng-click="deleteImageSlide(business_id, slider.count, slider.path);">Remove</button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix" id="time-delay" style="margin-top: 20px;">
                            <div class="col-md-6 col-xs-12">
                                <small>Transition Time Delay: (seconds)</small>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <input type="number" min="0" step="1" ng-model="settings.carousel_delay" class="form-control ng-pristine ng-untouched ng-valid ng-valid-min" width="30px">
                            </div>
                        </div>
                    </div>
                    <div class="ads-type amovie">
                        <div class="clearfix">
                            <div class="col-md-6 col-xs-12">
                                <button class="btn btn-info" onclick="window.open('http://127.0.0.1/videos/script/generate.php', 'FeatherQ',
                                    'height=200, width=300');">Generate Movie File Names</button>
                            </div>
                        </div>
                        <div class="clearfix" style="margin-top: 20px;">
                            <div class="col-md-6 col-xs-12">
                                <small>Movie File Name Listing</small>
                            </div>
                        </div>
                        <div class="clearfix">
                            <div class="col-md-12">
                                <div class="">
                                    <textarea class="form-control" rows="10" cols="2" id="movie-list" ng-model="settings.movie_list"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ads-type ainternet_tv">
                        <div class="col-md-12">
                            <div class="form-group">
                            <small>Choose a channel:</small>
                                <select ng-model="settings.tv_channel" ng-init="settings.tv_channel" id="tv-channel" class="form-control ng-pristine ng-valid ng-touched">
                                    <option value="">- Select A Channel -</option>
                                    <option value="<embed flashvars=&quot;vid=12163886&amp;autoplay=true&quot; width=&quot;100%&quot; allowfullscreen=&quot;true&quot; allowscriptaccess=&quot;always&quot; src=&quot;http://www.ustream.tv/flash/viewer.swf&quot; type=&quot;application/x-shockwave-flash&quot;>">TechCrunch TV</option>
                                    <option value="<iframe width='100%' src='http://www.ustream.tv/embed/14067349?v=3&amp;wmode=direct&amp;autoplay=true' scrolling='no' frameborder='0' style='border: 0px none transparent;'></iframe>">Arirang TV</option>
                                    <option value="<iframe width='100%' src='http://www.ustream.tv/embed/8429259?v=3&amp;wmode=direct&amp;autoplay=true' scrolling='no' frameborder='0' style='border: 0px none transparent;'></iframe>">EnergyFM Manila</option>
                                    <option value="<iframe width='100%' src='http://www.ustream.tv/embed/12762028?v=3&amp;wmode=direct&amp;autoplay=true' scrolling='no' frameborder='0' style='border: 0px none transparent;'></iframe>">Animal Planet</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=14&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">BBC One</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=27&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">BBC News</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=1808&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">CBS Reality</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=1805&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">CBS Drama</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=1952&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">CBS Action</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=4247&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Golden Boy Channel</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=374&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Filmon Football</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=4292&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Filmon Wrestling</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=3806&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Filmon Reality</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=1072&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">The Ellen Show</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=2999&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">JBTV Music</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=716&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Popcorn TV</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=1286&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Sesame Street</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=316&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Kix!</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=4184&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">UFO Documentary</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=2954&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">War History</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=3554&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Crime Documentary</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=713&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">UFC</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=3827&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">POSE Fashion</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=349&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Pursuit Outdoor</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=767&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Celebrity with Andy Dick</option>
                                    <option value="<iframe width='100%' src='https://www.filmon.com/tv/channel/export?channel_id=2945&autoPlay=1' frameborder='0' style='border: 0px none transparent;'> </iframe>">Auto Tv</option>
                                </select>
                                <div>
                                    <img src="/images/samsung-tv.jpg" class="img-responsive" style="max-height: 315px;width: 745px;">
                                </div>
                                <div class="alert alert-success" id="tvchannel-success" style="display: none;">Success! <strong><a href="/broadcast/business/16" target="_blank">View Broadcast Page</a></strong></div>
                                <div class="alert alert-danger" id="tvchannel-danger" style="display: none;">Oops! Something went wrong.</div>
                            </div>
                        </div>
                    </div>
                    <div class="ads-type anumbers_only">Numbers only</div>
                    <div class="drag abs">
                        <div class="">Drag to resize <span class="glyphicon glyphicon-sort"></span></div>
                    </div>
                </div>
                <div class="mb30 ui-widget ui-widget-content" id="ad-num-width" style="float: left; min-height: 400px;">
                    <h2 style="background-color: #b9ccd5;margin-top: -10px;padding: 13px 10px;width: 96%;" class="mb30 text-center">NOW SERVING</h2>
                    <div class="q-wrap q-numbers">
                        <button type="button" id="" class="mb10 btn btn-primary btn-md q-minus">
                            <span class="glyphicon glyphicon-minus"></span> Numbers
                        </button>
                        <button type="button" id="" class="mb10 btn btn-primary btn-md q-add">
                            <span class="glyphicon glyphicon-plus"></span> Numbers
                        </button>
                        <div class="q-nums-wrap clearfix">

                        </div>
                    </div>
                    <div class="clearfix">
                        <span class="blue mt20" style="display: block"><input style="font-size: 30px;" type="checkbox" ng-model="settings.show_called"> &nbsp; Show only called numbers</span>
                        <span class="blue mt20" style="display: block"><input style="font-size: 30px;" type="checkbox" ng-model="settings.show_names"> &nbsp; Show customer names</span>
                    </div>
                </div>
            </div>
            <div class="ticker-wrap text-right">
                <div class="ticker-field-wrap">
                </div>
                <button type="button" id="" class="btn btn-primary btn-lg add-ticker">
                    <span class="glyphicon glyphicon-plus"></span> Add New Ticker Message
                </button>
            </div>
            <div class="col-md-12" style="margin-top: 20px;">
                <button ng-click="saveBroadcastSettings(business_id)" type="submit" class="center-block btn btn-lg btn-orange" id=""><span class="glyphicon glyphicon-check"></span> SAVE SETTINGS</button>
                <button id="loading-img-3" style="display:none;" class="center-block btn btn-orange btn-disabled"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Loading...</button>
            </div>
        </div>
    </div>
</div>
