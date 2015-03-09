@extends('master')


@section('scripts')
    {{ HTML::script('js/user/user.js') }}
    {{ HTML::script('js/search-business.js') }}
    {{ HTML::script('js/jquery.timepicker.min.js') }}
@stop

@section('body')
    {{ HTML::style('css/jquery.timepicker.min.css') }}
<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->
<!--
<fb:login-button scope="public_profile,email,user_friends" onlogin="FeatherQ.facebook.checkLoginState();" id="login">
</fb:login-button>
-->

    <div class="banner" ng-controller="searchBusinessCtrl" style="visibility: visible;">
      <div class="row filters">
        <div class="container">
          <div class="col-md-5 col-md-offset-1">
            <div class="filterwrap">
              <span>FILTER:</span>
              <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        @{{ location_filter }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1" id="location-filter">
                        <li ng-click="locationFilter('Afghanistan');"><a href="#">Afghanistan</a></li>
                        <li ng-click="locationFilter('Albania');"><a href="#">Albania</a></li>
                        <li ng-click="locationFilter('Algeria');"><a href="#">Algeria</a></li>
                        <li ng-click="locationFilter('Andorra');"><a href="#">Andorra</a></li>
                        <li ng-click="locationFilter('Angola');"><a href="#">Angola</a></li>
                        <li ng-click="locationFilter('Antigua and Barbuda');"><a href="#">Antigua and Barbuda</a></li>
                        <li ng-click="locationFilter('Argentina');"><a href="#">Argentina</a></li>
                        <li ng-click="locationFilter('Armenia');"><a href="#">Armenia</a></li>
                        <li ng-click="locationFilter('Aruba');"><a href="#">Aruba</a></li>
                        <li ng-click="locationFilter('Australia');"><a href="#">Australia</a></li>
                        <li ng-click="locationFilter('Austria');"><a href="#">Austria</a></li>
                        <li ng-click="locationFilter('Azerbaijan');"><a href="#">Azerbaijan</a></li>
                        <li ng-click="locationFilter('Bahamas');"><a href="#">Bahamas, The</a></li>
                        <li ng-click="locationFilter('Bahrain');"><a href="#">Bahrain</a></li>
                        <li ng-click="locationFilter('Bangladesh');"><a href="#">Bangladesh</a></li>
                        <li ng-click="locationFilter('Barbados');"><a href="#">Barbados</a></li>
                        <li ng-click="locationFilter('Belarus');"><a href="#">Belarus</a></li>
                        <li ng-click="locationFilter('Belgium');"><a href="#">Belgium</a></li>
                        <li ng-click="locationFilter('Belize');"><a href="#">Belize</a></li>
                        <li ng-click="locationFilter('Benin');"><a href="#">Benin</a></li>
                        <li ng-click="locationFilter('Bhutan');"><a href="#">Bhutan</a></li>
                        <li ng-click="locationFilter('Bolivia');"><a href="#">Bolivia</a></li>
                        <li ng-click="locationFilter('Bosnia and Herzegovina');"><a href="#">Bosnia and Herzegovina</a></li>
                        <li ng-click="locationFilter('Botswana');"><a href="#">Botswana</a></li>
                        <li ng-click="locationFilter('Brazil');"><a href="#">Brazil</a></li>
                        <li ng-click="locationFilter('Brunei');"><a href="#">Brunei</a></li>
                        <li ng-click="locationFilter('Bulgaria');"><a href="#">Bulgaria</a></li>
                        <li ng-click="locationFilter('Burkina Faso');"><a href="#">Burkina Faso</a></li>
                        <li ng-click="locationFilter('Burma');"><a href="#">Burma</a></li>
                        <li ng-click="locationFilter('Burundi');"><a href="#">Burundi</a></li>
                        <li ng-click="locationFilter('Cambodia');"><a href="#">Cambodia</a></li></a></li>
                        <li ng-click="locationFilter('Cameroon');"><a href="#">Cameroon</a></li>
                        <li ng-click="locationFilter('Canada');"><a href="#">Canada</a></li>
                        <li ng-click="locationFilter('Cape Verde');"><a href="#">Cape Verde</a></li>
                        <li ng-click="locationFilter('Central African Republic');"><a href="#">Central African Republic</a></li>
                        <li ng-click="locationFilter('Chad');"><a href="#">Chad</a></li>
                        <li ng-click="locationFilter('Chile');"><a href="#">Chile</a></li>
                        <li ng-click="locationFilter('China');"><a href="#">China</a></li>
                        <li ng-click="locationFilter('Colombia');"><a href="#">Colombia</a></li>
                        <li ng-click="locationFilter('Comoros');"><a href="#">Comoros</a></li>
                        <li ng-click="locationFilter('Congo');"><a href="#">Congo, Republic of the</a></li>
                        <li ng-click="locationFilter('Costa Rica');"><a href="#">Costa Rica</a></li>
                        <li ng-click="locationFilter('Cote dIvoire');"><a href="#">Cote d'Ivoire</a></li>
                        <li ng-click="locationFilter('Croatia');"><a href="#">Croatia</a></li>
                        <li ng-click="locationFilter('Cuba');"><a href="#">Cuba</a></li>
                        <li ng-click="locationFilter('Curacao');"><a href="#">Curacao</a></li>
                        <li ng-click="locationFilter('Cyprus');"><a href="#">Cyprus</a></li>
                        <li ng-click="locationFilter('Czech Republic');"><a href="#">Czech Republic</a></li>
                        <li ng-click="locationFilter('Denmark');"><a href="#">Denmark</a></li>
                        <li ng-click="locationFilter('Djibouti');"><a href="#">Djibouti</a></li>
                        <li ng-click="locationFilter('Dominica');"><a href="#">Dominica</a></li>
                        <li ng-click="locationFilter('Dominican Republic');"><a href="#">Dominican Republic</a></li>
                        <li ng-click="locationFilter('East Timor');"><a href="#">East Timor (see Timor-Leste)</a></li>
                        <li ng-click="locationFilter('Ecuador');"><a href="#">Ecuador</a></li>
                        <li ng-click="locationFilter('Egypt');"><a href="#">Egypt</a></li>
                        <li ng-click="locationFilter('El Salvador');"><a href="#">El Salvador</a></li>
                        <li ng-click="locationFilter('Equatorial Guinea');"><a href="#">Equatorial Guinea</a></li>
                        <li ng-click="locationFilter('Eritrea');"><a href="#">Eritrea</a></li>
                        <li ng-click="locationFilter('Estonia');"><a href="#">Estonia</a></li>
                        <li ng-click="locationFilter('Ethiopia');"><a href="#">Ethiopia</a></li>
                        <li ng-click="locationFilter('Fiji');"><a href="#">Fiji</a></li>
                        <li ng-click="locationFilter('Finland');"><a href="#">Finland</a></li>
                        <li ng-click="locationFilter('France');"><a href="#">France</a></li>
                        <li ng-click="locationFilter('Gabon');"><a href="#">Gabon</a></li>
                        <li ng-click="locationFilter('Gambia');"><a href="#">Gambia, The</a></li>
                        <li ng-click="locationFilter('Georgia');"><a href="#">Georgia</a></li>
                        <li ng-click="locationFilter('Germany');"><a href="#">Germany</a></li>
                        <li ng-click="locationFilter('Ghana');"><a href="#">Ghana</a></li>
                        <li ng-click="locationFilter('Greece');"><a href="#">Greece</a></li>
                        <li ng-click="locationFilter('Grenada');"><a href="#">Grenada</a></li>
                        <li ng-click="locationFilter('Guatemala');"><a href="#">Guatemala</a></li>
                        <li ng-click="locationFilter('Guinea');"><a href="#">Guinea</a></li>
                        <li ng-click="locationFilter('Guinea-Bissau');"><a href="#">Guinea-Bissau</a></li>
                        <li ng-click="locationFilter('Guyana');"><a href="#">Guyana</a></li>
                        <li ng-click="locationFilter('Haiti');"><a href="#">Haiti</a></li>
                        <li ng-click="locationFilter('Holy See');"><a href="#">Holy See</a></li>
                        <li ng-click="locationFilter('Honduras');"><a href="#">Honduras</a></li>
                        <li ng-click="locationFilter('Hong Kong');"><a href="#">Hong Kong</a></li>
                        <li ng-click="locationFilter('Hungary');"><a href="#">Hungary</a></li>
                        <li ng-click="locationFilter('Iceland');"><a href="#">Iceland</a></li>
                        <li ng-click="locationFilter('India');"><a href="#">India</a></li>
                        <li ng-click="locationFilter('Indonesia');"><a href="#">Indonesia</a></li>
                        <li ng-click="locationFilter('Iran');"><a href="#">Iran</a></li>
                        <li ng-click="locationFilter('Iraq');"><a href="#">Iraq</a></li>
                        <li ng-click="locationFilter('Ireland');"><a href="#">Ireland</a></li>
                        <li ng-click="locationFilter('Israel');"><a href="#">Israel</a></li>
                        <li ng-click="locationFilter('Italy');"><a href="#">Italy</a></li>
                        <li ng-click="locationFilter('Jamaica');"><a href="#">Jamaica</a></li>
                        <li ng-click="locationFilter('Japan');"><a href="#">Japan</a></li>
                        <li ng-click="locationFilter('Jordan');"><a href="#">Jordan</a></li>
                        <li ng-click="locationFilter('Kazakhstan');"><a href="#">Kazakhstan</a></li>
                        <li ng-click="locationFilter('Kenya');"><a href="#">Kenya</a></li>
                        <li ng-click="locationFilter('Kiribati');"><a href="#">Kiribati</a></li>
                        <li ng-click="locationFilter('Kosovo');"><a href="#">Kosovo</a></li>
                        <li ng-click="locationFilter('Kuwait');"><a href="#">Kuwait</a></li>
                        <li ng-click="locationFilter('Kyrgyzstan');"><a href="#">Kyrgyzstan</a></li>
                        <li ng-click="locationFilter('Laos');"><a href="#">Laos</a></li>
                        <li ng-click="locationFilter('Latvia');"><a href="#">Latvia</a></li>
                        <li ng-click="locationFilter('Lebanon');"><a href="#">Lebanon</a></li>
                        <li ng-click="locationFilter('Lesotho');"><a href="#">Lesotho</a></li>
                        <li ng-click="locationFilter('Liberia');"><a href="#">Liberia</a></li>
                        <li ng-click="locationFilter('Libya');"><a href="#">Libya</a></li>
                        <li ng-click="locationFilter('Liechtenstein');"><a href="#">Liechtenstein</a></li>
                        <li ng-click="locationFilter('Lithuania');"><a href="#">Lithuania</a></li>
                        <li ng-click="locationFilter('Luxembourg');"><a href="#">Luxembourg</a></li>
                        <li ng-click="locationFilter('Macau');"><a href="#">Macau</a></li>
                        <li ng-click="locationFilter('Macedonia');"><a href="#">Macedonia</a></li>
                        <li ng-click="locationFilter('Madagascar');"><a href="#">Madagascar</a></li>
                        <li ng-click="locationFilter('Malawi');"><a href="#">Malawi</a></li>
                        <li ng-click="locationFilter('Malaysia');"><a href="#">Malaysia</a></li>
                        <li ng-click="locationFilter('Maldives');"><a href="#">Maldives</a></li>
                        <li ng-click="locationFilter('Mali');"><a href="#">Mali</a></li>
                        <li ng-click="locationFilter('Malta');"><a href="#">Malta</a></li>
                        <li ng-click="locationFilter('Marshall Islands');"><a href="#">Marshall Islands</a></li>
                        <li ng-click="locationFilter('Mauritania');"><a href="#">Mauritania</a></li>
                        <li ng-click="locationFilter('Mauritius');"><a href="#">Mauritius</a></li>
                        <li ng-click="locationFilter('Mexico');"><a href="#">Mexico</a></li>
                        <li ng-click="locationFilter('Micronesia');"><a href="#">Micronesia</a></li>
                        <li ng-click="locationFilter('Moldova');"><a href="#">Moldova</a></li>
                        <li ng-click="locationFilter('Monaco');"><a href="#">Monaco</a></li>
                        <li ng-click="locationFilter('Mongolia');"><a href="#">Mongolia</a></li>
                        <li ng-click="locationFilter('Montenegro');"><a href="#">Montenegro</a></li>
                        <li ng-click="locationFilter('Morocco');"><a href="#">Morocco</a></li>
                        <li ng-click="locationFilter('Mozambique');"><a href="#">Mozambique</a></li>
                        <li ng-click="locationFilter('Namibia');"><a href="#">Namibia</a></li>
                        <li ng-click="locationFilter('Nauru');"><a href="#">Nauru</a></li>
                        <li ng-click="locationFilter('Nepal');"><a href="#">Nepal</a></li>
                        <li ng-click="locationFilter('Netherlands');"><a href="#">Netherlands</a></li>
                        <li ng-click="locationFilter('Netherlands Antilles');"><a href="#">Netherlands Antilles</a></li>
                        <li ng-click="locationFilter('New Zealand');"><a href="#">New Zealand</a></li>
                        <li ng-click="locationFilter('Nicaragua');"><a href="#">Nicaragua</a></li>
                        <li ng-click="locationFilter('Niger');"><a href="#">Niger</a></li>
                        <li ng-click="locationFilter('Nigeria');"><a href="#">Nigeria</a></li>
                        <li ng-click="locationFilter('North Korea');"><a href="#">North Korea</a></li>
                        <li ng-click="locationFilter('Norway');"><a href="#">Norway</a></li>
                        <li ng-click="locationFilter('Oman');"><a href="#">Oman</a></li>
                        <li ng-click="locationFilter('Pakistan');"><a href="#">Pakistan</a></li>
                        <li ng-click="locationFilter('Palau');"><a href="#">Palau</a></li>
                        <li ng-click="locationFilter('Panama');"><a href="#">Panama</a></li>
                        <li ng-click="locationFilter('Papua New Guinea');"><a href="#">Papua New Guinea</a></li>
                        <li ng-click="locationFilter('Paraguay');"><a href="#">Paraguay</a></li>
                        <li ng-click="locationFilter('Peru');"><a href="#">Peru</a></li>
                        <li ng-click="locationFilter('Philippines');"><a href="#">Philippines</a></li>
                        <li ng-click="locationFilter('Poland');"><a href="#">Poland</a></li>
                        <li ng-click="locationFilter('Portugal');"><a href="#">Portugal</a></li>
                        <li ng-click="locationFilter('Qatar');"><a href="#">Qatar</a></li>
                        <li ng-click="locationFilter('Romania');"><a href="#">Romania</a></li>
                        <li ng-click="locationFilter('Russia');"><a href="#">Russia</a></li>
                        <li ng-click="locationFilter('Rwanda');"><a href="#">Rwanda</a></li>
                        <li ng-click="locationFilter('Saint Kitts and Nevis');"><a href="#">Saint Kitts and Nevis</a></li>
                        <li ng-click="locationFilter('Saint Lucia');"><a href="#">Saint Lucia</a></li>
                        <li ng-click="locationFilter('Saint Vincent and the Grenadines');"><a href="#">Saint Vincent and the Grenadines</a></li>
                        <li ng-click="locationFilter('Samoa');"><a href="#">Samoa</a></li>
                        <li ng-click="locationFilter('San Marino');"><a href="#">San Marino</a></li>
                        <li ng-click="locationFilter('Sao Tome and Principe');"><a href="#">Sao Tome and Principe</a></li>
                        <li ng-click="locationFilter('Saudi Arabia');"><a href="#">Saudi Arabia</a></li>
                        <li ng-click="locationFilter('Senegal');"><a href="#">Senegal</a></li>
                        <li ng-click="locationFilter('Serbia');"><a href="#">Serbia</a></li>
                        <li ng-click="locationFilter('Seychelles');"><a href="#">Seychelles</a></li>
                        <li ng-click="locationFilter('Sierra Leone');"><a href="#">Sierra Leone</a></li>
                        <li ng-click="locationFilter('Singapore');"><a href="#">Singapore</a></li>
                        <li ng-click="locationFilter('Sint Maarten');"><a href="#">Sint Maarten</a></li>
                        <li ng-click="locationFilter('Slovakia');"><a href="#">Slovakia</a></li>
                        <li ng-click="locationFilter('Slovenia');"><a href="#">Slovenia</a></li>
                        <li ng-click="locationFilter('Solomon Islands');"><a href="#">Solomon Islands</a></li>
                        <li ng-click="locationFilter('Somalia');"><a href="#">Somalia</a></li>
                        <li ng-click="locationFilter('South Africa');"><a href="#">South Africa</a></li>
                        <li ng-click="locationFilter('South Korea');"><a href="#">South Korea</a></li>
                        <li ng-click="locationFilter('South Sudan');"><a href="#">South Sudan</a></li>
                        <li ng-click="locationFilter('Spain');"><a href="#">Spain</a></li>
                        <li ng-click="locationFilter('Sri Lanka');"><a href="#">Sri Lanka</a></li>
                        <li ng-click="locationFilter('Sudan');"><a href="#">Sudan</a></li>
                        <li ng-click="locationFilter('Suriname');"><a href="#">Suriname</a></li>
                        <li ng-click="locationFilter('Swaziland');"><a href="#">Swaziland</a></li>
                        <li ng-click="locationFilter('Sweden');"><a href="#">Sweden</a></li>
                        <li ng-click="locationFilter('Switzerland');"><a href="#">Switzerland</a></li>
                        <li ng-click="locationFilter('Syria');"><a href="#">Syria</a></li>
                        <li ng-click="locationFilter('Taiwan');"><a href="#">Taiwan</a></li>
                        <li ng-click="locationFilter('Tajikistan');"><a href="#">Tajikistan</a></li>
                        <li ng-click="locationFilter('Tanzania');"><a href="#">Tanzania</a></li>
                        <li ng-click="locationFilter('Thailand');"><a href="#">Thailand</a></li>
                        <li ng-click="locationFilter('Timor-Leste');"><a href="#">Timor-Leste</a></li>
                        <li ng-click="locationFilter('Togo');"><a href="#">Togo</a></li>
                        <li ng-click="locationFilter('Tonga');"><a href="#">Tonga</a></li>
                        <li ng-click="locationFilter('Tunisia and Tobago');"><a href="#">Trinidad and Tobago</a></li>
                        <li ng-click="locationFilter('Tunisia');"><a href="#">Tunisia</a></li>
                        <li ng-click="locationFilter('Turkey');"><a href="#">Turkey</a></li>
                        <li ng-click="locationFilter('Turkmenistan');"><a href="#">Turkmenistan</a></li>
                        <li ng-click="locationFilter('Tuvalu');"><a href="#">Tuvalu</a></li>
                        <li ng-click="locationFilter('Uganda');"><a href="#">Uganda</a></li>
                        <li ng-click="locationFilter('Ukraine');"><a href="#">Ukraine</a></li>
                        <li ng-click="locationFilter('United Arab Emirates');"><a href="#">United Arab Emirates</a></li>
                        <li ng-click="locationFilter('United Kingdom');"><a href="#">United Kingdom</a></li>
                        <li ng-click="locationFilter('Uruguay');"><a href="#">Uruguay</a></li>
                        <li ng-click="locationFilter('Uzbekistan');"><a href="#">Uzbekistan</a></li>
                        <li ng-click="locationFilter('Vanuatu');"><a href="#">Vanuatu</a></li>
                        <li ng-click="locationFilter('Venezuela');"><a href="#">Venezuela</a></li>
                        <li ng-click="locationFilter('Vietnam');"><a href="#">Vietnam</a></li>
                        <li ng-click="locationFilter('Yemen');"><a href="#">Yemen</a></li>
                        <li ng-click="locationFilter('Zambia');"><a href="#">Zambia</a></li>
                        <li ng-click="locationFilter('Zimbabwe');"><a href="#">Zimbabwe</a></li>
                    </ul>
                </div>
                  <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          @{{ industry_filter }}
                          <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupDrop1">
                          <li ng-click="industryFilter('Accounting');"><a href="#">Accounting</a></li>
                          <li ng-click="industryFilter('Advertising');"><a href="#">Advertising</a></li>
                          <li ng-click="industryFilter('Agriculture');"><a href="#">Agriculture</a></li>
                          <li ng-click="industryFilter('Air Services');"><a href="#">Air Services</a></li>
                          <li ng-click="industryFilter('Airlines');"><a href="#">Airlines</a></li>
                          <li ng-click="industryFilter('Apparel');"><a href="#">Apparel</a></li>
                          <li ng-click="industryFilter('Appliances');"><a href="#">Appliances</a></li>
                          <li ng-click="industryFilter('Auto Dealership');"><a href="#">Auto Dealership</a></li>
                          <li ng-click="industryFilter('Banking');"><a href="#">Banking</a></li>
                          <li ng-click="industryFilter('Broadcasting');"><a href="#">Broadcasting</a></li>
                          <li ng-click="industryFilter('Business Services');"><a href="#">Business Services</a></li>
                          <li ng-click="industryFilter('Communications');"><a href="#">Communications</a></li>
                          <li ng-click="industryFilter('Corporate');"><a href="#">Corporate</a></li>
                          <li ng-click="industryFilter('Customer Service');"><a href="#">Customer Service</a></li>
                          <li ng-click="industryFilter('Delivery');"><a href="#">Delivery</a></li>
                          <li ng-click="industryFilter('Delivery Services');"><a href="#">Delivery Services</a></li>
                          <li ng-click="industryFilter('Education');"><a href="#">Education</a></li>
                          <li ng-click="industryFilter('Energy');"><a href="#">Energy</a></li>
                          <li ng-click="industryFilter('Entertainment');"><a href="#">Entertainment</a></li>
                          <li ng-click="industryFilter('Events');"><a href="#">Events</a></li>
                          <li ng-click="industryFilter('Food and Beverage');"><a href="#">Food and Beverage</a></li>
                          <li ng-click="industryFilter('Government');"><a href="#">Government</a></li>
                          <li ng-click="industryFilter('Grocery');"><a href="#">Grocery</a></li>
                          <li ng-click="industryFilter('Healthcare');"><a href="#">Healthcare</a></li>
                          <li ng-click="industryFilter('Hobbies and Collections');"><a href="#">Hobbies and Collections</a></li>
                          <li ng-click="industryFilter('Hospitality');"><a href="#">Hospitality</a></li>
                          <li ng-click="industryFilter('Insurance');"><a href="#">Insurance</a></li>
                          <li ng-click="industryFilter('Information Technology');"><a href="#">Information Technology</a></li>
                          <li ng-click="industryFilter('Lifestyle');"><a href="#">Lifestyle</a></li>
                          <li ng-click="industryFilter('Mail Order Services');"><a href="#">Mail Order Services</a></li>
                          <li ng-click="industryFilter('Manufacturing');"><a href="#">Manufacturing</a></li>
                          <li ng-click="industryFilter('Pharmaceutical');"><a href="#">Pharmaceutical</a></li>
                          <li ng-click="industryFilter('Media');"><a href="#">Media</a></li>
                          <li ng-click="industryFilter('Professional services');"><a href="#">Professional services</a></li>
                          <li ng-click="industryFilter('Publishing');"><a href="#">Publishing</a></li>
                          <li ng-click="industryFilter('Real Estate');"><a href="#">Real Estate</a></li>
                          <li ng-click="industryFilter('Recreation');"><a href="#">Recreation</a></li>
                          <li ng-click="industryFilter('Rentals');"><a href="#">Rentals</a></li>
                          <li ng-click="industryFilter('Retail');"><a href="#">Retail</a></li>
                          <li ng-click="industryFilter('Software Development');"><a href="#">Software Development</a></li>
                          <li ng-click="industryFilter('Technology');"><a href="#">Technology</a></li>
                          <li ng-click="industryFilter('Travel and Tours');"><a href="#">Travel and Tours</a></li>
                          <li ng-click="industryFilter('Utility services');"><a href="#">Utility services</a></li>
                          <li ng-click="industryFilter('Web Services');"><a href="#">Web Services</a></li>
                          <li ng-click="industryFilter('Wholesale');"><a href="#">Wholesale</a></li>
                      </ul>
                  </div>
                  <div class="btn-group" role="group">
                      <button id="btnTimeOpen" type="button" class="btn btn-default dropdown-toggle ng-binding" data-toggle="dropdown" aria-expanded="false">
                          Time Open
                          <span class="caret"></span>
                      </button>
                      <input type="text" id="time_open-filter" name="time_open" placeholder="Time Open" class="timepicker form-control" style="width: 145px;"/>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="searchblock">
                <form>
                    <input type="text" placeholder="Search a Business" id="search-keyword">
                    <button type="button" class="btn btn-orange btn-md" ng-click="searchBusiness(location_filter, industry_filter);">SEARCH</button>
                </form>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="caption">
          <div class="pull-left">
            <h1>Change the wait</h1>
            <p>No need to wait inline. Focus on things that matter!</p>
          </div>
        </div>
      </div>

      <div class="search_business">
        <div class="container">
          <div class="row">
            <div class="col-md-6 new-businesses">
              <div class="row">
              @if(count($search_businesses) > 0)
                <div class="col-md-12">
                  <p class="heading">New Businesses</p>
                </div>
                @foreach($search_businesses as $business)
                <div class="col-md-6 col-xs-12">
                  <div class="boxed boxed-single clickable">
                    <a class="business_link" href="{{ URL::to( '/broadcast/business/' . $business['business_id'] ) }}" target="_blank">
                    <div class="wrap">
                      <h3>{{ $business['name'] }}</h3>
                      <small>{{ $business['local_address'] }}</small>
                    </div>
                    </a>
                  </div>
                </div>
                @endforeach
                <div class="col-md-6 col-xs-12">
                  <div class="boxed boxed-single clickable" ng-controller="fbController">
                    <a class="business_link" ng-click="login()" href="">
                    <div class="wrap">
                      <h3 class="orange">More New Businesses</h3>
                      <small>Login to View more New Businesses</small>
                    </div>
                    </a>
                  </div>
                </div>
              @endif
              </div>
            </div>
            <div id="business-search" style="display: none">
              <p id="search-label" class="heading">@{{ searchLabel }}</p>
                <div class="col-md-3" ng-repeat="business in businesses">
                    <div class="boxed boxed-single clickable">
                        <a class="business_link" href="/broadcast/business/@{{ business.business_id }}" target="_blank">
                            <div class="wrap">
                                <h3>@{{ business.business_name }}</h3>
                                <small>@{{ business.local_address }}</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 active-businesses">
              <div class="row">
                @if(count($active_businesses) > 0)
                  <div class="col-md-12">
                    <p class="heading">Active Businesses</p>
                  </div>
                  @foreach($active_businesses as $ac_business_id => $actives)
                  <div class="col-md-6 col-xs-12">
                    <div class="boxed boxed-single clickable">
                      <a class="business_link" href="{{ URL::to( '/broadcast/business/' . $ac_business_id ) }}" target="_blank">
                      <div class="wrap">
                        <h3>{{ $actives['name'] }}</h3>
                        <small>{{ $actives['local_address'] }}</small>
                      </div>
                      </a>
                    </div>
                  </div>
                  @endforeach
                  <div class="col-md-6 col-xs-12">
                    <div class="boxed boxed-single clickable" ng-controller="fbController">
                      <a class="business_link" ng-click="login()" href="">
                      <div class="wrap">
                        <h3 class="orange">More Active Businesses</h3>
                        <small>Login to View more Active Businesses</small>
                      </div>
                      </a>
                    </div>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="how" class="how">
      <div class="container">
        <div class="col-md-12">
          <h1>How does it work?</h1>
        </div>
        <div class="col-md-6">
          <h5>FOR BUSINESS</h5>
          <h3>1. Login via Facebook</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
          <h3>2. Setup your Business</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
          <h3>3. Process your Queue</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-6">
          <h5>FOR USERS</h5>
          <h3>1. Login via Facebook</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
          <h3>2. Queue to any Business</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
      </div>
    </div>

    <div id="feats" class="feats">
      <div class="container">
        <div class="col-md-12">
          <h1>FeatherQ Features</h1>
        </div>
        <div class="col-md-3">
          <h3>30-second Business Setup</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>Remote Queuing</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>Business Analytics</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>its FREE!</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>Customisable Broadcast Screens</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>Mobile Responsive</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>SMS and Email Notifications</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
        <div class="col-md-3">
          <h3>Featureful Process Queue</h3>
          <p>Choose from a variety of email providers. We currently support Mandrill, Sendgrid and SendWithUs, and the list is growing. </p>
        </div>
      </div>
    </div>

    <div class="signup">
      <div class="container">
        <div class="col-md-2 col-md-offset-5" style="margin-top:-20px;"><hr></div>
        <div class="content wow fadeInDown animated" style="visibility: visible;">
          <div class="col-lg-4  col-md-4 col-lg-offset-1 text-center">
            <img src="images/img-broadcast.png" alt="">
          </div>
          <div class="col-md-6">
            <div>
              <h1>Sign-up for FeatherQ Today!</h1>
              <p>If you have a business that needs a queuing system then FeatherQ is for you! For a limited time FeatherQ Premium will be open for 3 months free trial to a limited number of businesses! Be part of history as We change the way the world waits.</p>
              <br>
              <div class="button mb30" ng-controller="fbController">
                <a href="" ng-click="login()" class="btn btn-orange">Sign up for a Free Account</a>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>

    <div class="contact">
      <div class="container">
          <h1 class="col-md-12">Send us a message</h1>

        <div class="col-md-6 wow fadeInDown  animated" style="visibility: visible;">
          <a name="contact"></a>
          {{ Form::open(array('url' => '/', 'class' => 'row', 'role' => 'form')) }}
            @if(Session::has('message'))
            <div class="alert alert-success col-md-10">
                <p>{{ Session::get('message') }}</p>
            </div>
            @endif
            <div class="col-md-10">
              {{ Form::text('name', null, array('id' => 'name', 'name' => 'name', 'class' => 'form-control col-md-4', 'placeholder' => 'Name*', 'required' => 'required')) }}
            </div>
            <div class="col-md-10">
             {{ Form::email('email', null, array('type' => 'email', 'id' => 'inputEmail3', 'name' => 'email', 'class' => 'form-control col-md-4', 'placeholder' => 'Email*', 'required' => 'required')) }}
            </div>
            <div class="col-md-10">
              {{ Form::textarea('message', null, array('rows' => '6', 'class' => 'form-control', 'placeholder' => 'Message*', 'style' => 'background: none; color: #fff', 'required' => 'required')) }}
            </div>
            <div class="col-md-10 button">
                {{ Form::submit('Send', array('id' => 'contact', 'class' => 'btn btn-orange mb30', 'style' => 'padding: 10px 20px;')) }}
            </div>
          </form>
        </div>
        <div class="col-md-6 wow fadeInDown animated" style="visibility: visible;">
          <p class="mb30">If you have a business that needs a queuing system then FeatherQ is for you! For a limited time FeatherQ Premium will be open for 3 months free trial to a limited number of businesses! Be part of history as We change the way the world waits.</p>
          <table class="table mb30">
            <tbody><tr>
              <td>Address:</td>
              <td>Reminisense Corp. Office,<br>
                eNGy Bldg.<br>
                Hernan Cortes Street,<br>
                Mandaue City, Philippines
              </td>
            </tr>
            <tr>
              <td>Email:</td>
              <td>contact@featherq.net</td>
            </tr>
            <tr>
              <td>Telephone:</td>
              <td>(032) 345-4658</td>
            </tr>
          </tbody></table>
          <a href="https://www.facebook.com/theFeatherQ" target="_blank"><img src="images/social-fb.png" class="socials" /></a>
          <a href="https://plus.google.com/+Featherq/posts" target="_blank"><img src="images/social-gp.png" class="socials" /></a>
          <a href="https://twitter.com/thefeatherq" target="_blank"><img src="images/social-tw.png" class="socials"/></a>
        </div>
      </div>
    </div>

    <div class="footer">
      <div class="container">
        <div class="col-md-12">
          © 2014 : Reminisense Corp.
        </div>
      </div>
    </div>

<script type="text/javascript">
$('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
        || location.hostname == this.hostname) {

        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
           if (target.length) {
             $('html,body').animate({
                 scrollTop: target.offset().top
            }, 1000);
            return false;
        }
    }
});
</script>
@yield('scripts')
@stop
