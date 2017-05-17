
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
                    <option value="local_video">Local Video</option>
                    <option value="internet_tv">Internet TV</option>
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
                    <div class="ads-type alocal_video">
                        <div class="col-md-12">
                            <div class="form-group">
                                <small>You can choose your own video to play on the Broadcast Screen:</small>
                            </div>
                            <div class="clearfix">
                                <div class="col-md-12">
                                    <div role="alert" class="alert alert-warning">
                                        <strong>Play Your Own Videos Locally</strong> <br/>
                                        You can choose your videos directly from the Broadcast Screen.<br/><br/>
                                        <button class="btn btn-lg btn-danger" onclick="window.open('{{ url('broadcast/business/' . $business_id) }}')">View Broadcast Screen</button>
                                    </div>
                                    <div>
                                        <img src="/images/samsung-tv.jpg" class="img-responsive" style="max-height: 315px;width: 745px;">
                                    </div>
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
                        <div class="q-nums-wrap clearfix">
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">1</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box1_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">2</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box2_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">3</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box3_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">4</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box4_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">5</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box5_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">6</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box6_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">7</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box7_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">8</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box8_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">9</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box9_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">10</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box10_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">11</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box11_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">12</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box12_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">13</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box13_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">14</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box14_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">15</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box15_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="qbox">
                                <div class="pull-left half">
                                    <div class="col-md-3">16</div>
                                    <div class="col-md-9">
                                        <select class="form-control select-service" ng-model="service_boxes.box16_service">
                                            <optgroup ng-repeat="service in services" label="*********************************************">
                                                <option ng-if="terminal.service_id == service.service_id" ng-repeat="terminal in terminals" value="@{{ service.service_id }}">@{{ service.name + ' - ' + terminal.name }}</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
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
