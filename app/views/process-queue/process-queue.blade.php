@extends('user.dashboard_master')

@section('scripts')
    {{ HTML::script('js/process-queue/process-queue.js') }}
@stop

@section('content')
<div class="container main-wrap">
    <div class="row filters">
        <div class="col-md-5 col-md-offset-1">
            <div class="filterwrap">
                <span>FILTER:</span>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Location
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                            <li><a href="#">Dropdown link</a></li>
                            <li><a href="#">Dropdown link</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Industry Type
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 2</a></li>
                        </ul>
                    </div>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            Time Open
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="searchblock">
                <form>
                    <input type="text" placeholder="Search a Business">
                    <button type="button" class="btn btn-orange btn-md">SEARCH</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Process queue main -->
    <div class="row " ng-controller="processqueueController">
        <div class="col-md-12">
            <h2 class="heading">Kublai Khan Ayala</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="boxed mb20 processq">
                        <div class="head head-blue">
                            <h3>Terminal Name</h3>
                        </div>
                        <div class="body">
                            <form class="clearfix">
                                <div class="row mb30">
                                    <div class="col-md-8 col-xs-12">
                                        <button class="btn-select btn-md dropdown-toggle" type="button" data-toggle="dropdown">
                                            <span ng-model="called_number">Please replace me </span><span class="caret"></span> <!-- @todo replace this with selected number-->
                                        </button>
                                        <ul class="dropdown-menu dd-select">
                                            <li ng-repeat="number in uncalled_numbers" value="@{{ number.transaction_number }}">@{{ number.priority_number }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-2 col-xs-12">
                                        <div id="pmsg">
                                            <button id="" class="btn btn-cyan btn-lg">
                                                <span class="glyphicon glyphicon-comment"></span>
                                            </button>
                                            <div id="pmsg-window">
                                                <div class="wrap">
                                                    <form>
                                                        <input type="text" placeholder="Input Number">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="pmore">
                                            <button id="btn-pmore" class="btn btn-blue btn-lg" data-toggle="modal" data-target="#moreq">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-xs-12 text-right">
                                        <button class="btn btn-lg btn-orange" id="btn-call" ng-click="callNumber(called_number)">CALL NUMBER</button>
                                    </div>
                                </div>
                            </form>
                            <!-- called numbers -->
                            <table class="table">
                                <thead></thead>
                                <tbody>
                                <tr>
                                    <th scope="row">34</th>
                                    <td>
                                        Terminal One
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">35</th>
                                    <td>
                                        <a class="btn btn-gray" href=""><span class="glyphicon glyphicon-trash"></span></a>
                                        <a class="btn btn-cyan" href=""><span class="glyphicon glyphicon-arrow-right"></span> Next</a>
                                        <a class="btn btn-cyan" href=""><span class="glyphicon glyphicon-ok"></span> Serve</a>
                                    </td>
                                </tr>
                                <tr ng-repeat="number in called_numbers">
                                    <th scope="row">@{{ number.priority_number }}</th>
                                    <td>
                                        <button class="btn btn-gray" ng-click="dropNumber(number.transaction_number)"><span class="glyphicon glyphicon-trash"></span></button>
                                        <button class="btn btn-cyan" ><span class="glyphicon glyphicon-arrow-right"></span> Next</button>
                                        <button class="btn btn-cyan" ng-click="serveNumber(number.transaction_number)"><span class="glyphicon glyphicon-ok"></span> Serve</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- urls -->
<input type="hidden" id="service-id" value="{{ $service_id }}">
<input type="hidden" id="terminal-id" value="{{ $terminal_id }}">
<input type="hidden" id="all-numbers-url" value="{{ url('/processqueue/allnumbers/') }}">
<input type="hidden" id="call-number-url" value="{{ url('/processqueue/callnumber/') }}">
<input type="hidden" id="serve-number-url" value="{{ url('/processqueue/servenumber/') }}">
<input type="hidden" id="drop-number-url" value="{{ url('/processqueue/dropnumber/') }}">

<input type="hidden" id="issue-numbers-url" value="{{ url('/issuenumber/single/') }}">
<input type="hidden" id="issue-multiple-url" value="{{ url('/issuenumber/multiple/') }}">
<input type="hidden" id="issue-specific-url" value="{{ url('/issuenumber/insertspecific/') }}">

<input type="hidden" id="queue-settings-get-url" value="{{ url('/queuesettings/allvalues/') }}">
<input type="hidden" id="queue-settings-update-url" value="{{ url('/queuesettings/update/') }}">
<!-- end urls -->
<!-- end process queue main -->
@stop

@section('modals')
<!-- modal -->
<div class="modal fade" id="moreq" tabindex="-1" ng-controller="issuenumberController">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="myModalLabel">Insert Queue</h3>
            </div>
            <div class="modal-body">
                <ul id="pmore-tab" class="nav nav-tabs nav-justified">
                    <li class="active"><a data-submit="#issue-specific-submit" href="#insertq" data-toggle="tab">INSERT TO QUEUE</a></li>
                    <li><a data-submit="#issue-multiple-submit" href="#multipleq" data-toggle="tab" >ISSUE MULTIPLE</a></li>
                </ul>
                <div class="clearfix tab-content">
                    <div class="tab-pane fade active in" id="insertq">
                        <form class="navbar-form navbar-left">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label><strong>Specific #</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="priority_number">
                                </div>
                                <div class="col-md-4">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="name">
                                </div>
                                <div class="col-md-4">
                                    <label>Cellphone</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="phone">
                                </div>
                                <div class="col-md-4">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="email">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="multipleq" aria-labelledby="profile-tab">
                        <form class="navbar-form navbar-left">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label><strong>Amount</strong></label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" ng-model="range">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="issue-specific-submit" type="button" class="issue-submit-btn btn btn-orange btn-lg" ng-click="issueSpecific(priority_number, name, phone, email)">SUBMIT</button>
                <button id="issue-multiple-submit" type="button" class="issue-submit-btn btn btn-orange btn-lg" ng-click="issueMultiple(range)" style="display: none">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->
@stop