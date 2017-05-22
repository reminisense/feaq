@extends('dashboard')

@section('styles')
    <link media="all" type="text/css" rel="stylesheet" href="/css/kiosk/kiosk.css">
@stop

@section('scripts')
    <script src="/js/angular-sanitize.min.js"></script>
    <script src="/js/reconnecting-websocket.min.js"></script>
    <script src="/js/websocket-variables.js"></script>
    <script src="/js/kiosk/kiosk.js"></script>

    <script src="/js/google-analytics/googleAnalytics.js"></script>
    <script src="https://ucarecdn.com/widget/2.3.5/uploadcare/uploadcare.min.js" charset="utf-8"></script>
    <script>
        UPLOADCARE_LOCALE = "en";
        UPLOADCARE_TABS = "file";
        UPLOADCARE_PUBLIC_KEY = "844c2b9e554c2ee5cc0a";
    </script>
    <script type="text/javascript" src="/js/jstz.min.js"></script>
@stop

@section('container')
    <div class="feat feat-kiosk">
        <div class="container">
            <div class="text-center">
                <h1><span class="glyphicon glyphicon-modal-window"></span> Kiosk</h1>
            </div>
        </div>
        <div class="arrow">
            <img src="/img/arrow.png">
        </div>
    </div>
    <div class="container" id="kiosk-wrapper" ng-controller="kioskController">
        <br/>
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li ng-repeat="service in services" ng-class="$index==0?'active':''"
                ng-click="switchActiveService(service.service_id);" data-toggle="modal" data-target="#kioskModal">
                <a href="#@{{service.name}}" id="#@{{service.name}}-tab" data-toggle="tab"> @{{service.name}} <br/>
                    [@{{service.first_terminal}}] </a>
            </li>
        </ul>
        <div class="modal fade" tabindex="-1" role="dialog" id="kioskModal" aria-labelledby="kioskModal">
            <div class="modal-dialog modal-lg" role="document" style="width: 85%">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="tab-content" id="kioskTabContent">
                            <div class="col-md-12" id="time-slot-title">
                                <h1>Choose a Time Slot</h1>
                            </div>
                            <div class="clearfix">
                                <ul class="nav nav-tabs nav-justified" id="pacing-schedule">
                                    <li ng-click="switchPacingSchedule(1)" ng-class="selected_pacing_id == 1 ? 'active' : ''">
                                        <a href>8:00 AM to 9:00 AM</a>
                                    </li>
                                    <li ng-click="switchPacingSchedule(2)" ng-class="selected_pacing_id == 2 ? 'active' : ''">
                                        <a href>9:00 AM to 10:00 AM</a>
                                    </li>
                                    <li ng-click="switchPacingSchedule(3)" ng-class="selected_pacing_id == 3 ? 'active' : ''">
                                        <a href>10:00 AM to 12:00 NN</a>
                                    </li>
                                    <li ng-click="switchPacingSchedule(4)" ng-class="selected_pacing_id == 4 ? 'active' : ''">
                                        <a href>1:00 PM to 3:00 PM</a>
                                    </li>
                                    <li ng-click="switchPacingSchedule(5)" ng-class="selected_pacing_id == 5 ? 'active' : ''">
                                        <a href>3:00 PM to 5:00 PM</a>
                                    </li>
                                </ul>
                            </ul>
                            <div class="clearfix">
                                <div class="col-md-12 emphasis" data-dismiss="modal">
                                    <div class="col-md-6 issue-number">
                                        <span class="number-to-issue">@{{ next_number }}</span><br/>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="well well-sm">
                                            <div id="fqCarousel" class="carousel slide" data-ride="carousel">
                                                <!-- Wrapper for slides -->
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="item active">
                                                        <img src="/images/broadcast/carousel/bs images 13.jpg"
                                                             alt="ad1">
                                                    </div>
                                                    <div class="item">
                                                        <img src="/images/broadcast/carousel/bs images 14.jpg"
                                                             alt="ad2">
                                                    </div>
                                                    <div class="item">
                                                        <img src="/images/broadcast/carousel/car1.jpg" alt="ad3">
                                                    </div>
                                                    <div class="item">
                                                        <img src="/images/broadcast/carousel/car2.jpg" alt="ad4">
                                                    </div>
                                                    <div class="item">
                                                        <img src="/images/broadcast/carousel/car3.jpg" alt="ad5">
                                                    </div>
                                                    <div class="item">
                                                        <img src="/images/broadcast/carousel/car4.jpg" alt="ad6">
                                                    </div>
                                                    <div class="item">
                                                        <img src="/images/broadcast/carousel/poster.jpg" alt="ad7">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <center>
                                    <button class="btn btn-lg btn-success" id="get-number"
                                            ng-click="getIssueNumber()"><span
                                          class="glyphicon glyphicon-download"></span> GET NUMBER
                                    </button>
                                </center>
                            </div>
                            @include('modals.kiosk.confirmation-code')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--constants-->
        <input type="hidden" id="business_id" value="{{ $business_id }}">
        <!-- urls -->
        <input type="hidden" id="issue-specific-url" value="{{ url('/issuenumber/insertspecific/') }}">
        <!-- end urls -->
        <!-- end process queue main -->
    {{--    @include('modals.websockets.websocket-loader')--}}
@stop