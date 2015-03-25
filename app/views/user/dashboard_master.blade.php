<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ url('images/favicon.png')}}">

    <title>@yield('subtitle') | FeatherQ</title>

    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('css/animate.css') }}
    {{ HTML::style('css/dashboard.css') }}
    {{ HTML::style('css/responsive.css') }}
    @yield('styles')

    {{ HTML::script('js/jquery1.11.0.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/wow.min.js') }}
    {{ HTML::script('js/custom.js') }}
    {{ HTML::script('js/angular.js') }}
    {{ HTML::script('js/ngFeatherQ.js') }}
    {{ HTML::script('js/ngFacebook.js') }}
    {{ HTML::script('js/ngAutocomplete.js') }}
    {{ HTML::script('js/dashboard/search-business.js') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- NAVBAR
  ================================================== -->
<body cz-shortcut-listen="true" ng-app="FeatherQ">
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{URL::to('/')}}"> {{--RDH Added link to homepage--}}
                <img src="{{ url('images/featherq-home-logo.png') }}">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Hello {{Auth::user()->first_name}}! <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{URL::to('/')}}">Dashboard</a></li>
                        <li><a href="#" id="edit_profile">Edit My Profile</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Connect with us!</li>
                        <li><a href="{{URL::to('https://www.facebook.com/theFeatherQ')}}">Facebook</a></li>
                        <li><a href="{{URL::to('https://www.twitter.com/thefeatherq')}}">Twitter</a></li>
                        <li><a href="{{URL::to('https://plus.google.com/101914769293976664743')}}">Google+</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="subnav">
    <div class="container">
        <ul class="nav nav-tabs" id="header-tabs">
            <li class="search active"><a href="{{ url('/') }}"><span class="glyphicon glyphicon-search"></span> Search</a></li>
            <li class="biz"><a href="{{ url('/') }}"><span class="glyphicon glyphicon-home"></span> My Business</a></li>
        </ul>
    </div>
</div>
<div class="container main-wrap" ng-controller="searchBusinessCtrl">
    <div class="row filters">
        <div class="col-md-5 col-md-offset-1 col-xs-12">
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

        <div class="col-md-4 col-xs-12">
            <div class="searchblock">
                <form>
                    <input type="text" placeholder="Search a Business" id="search-keyword">
                    <button type="button" class="btn btn-orange btn-md" ng-click="searchBusiness(location_filter, industry_filter);">SEARCH</button>
                </form>
            </div>
        </div>
    </div>
    @yield('content')
</div>

<div class="footer">
    <div class="container">
        <div class="col-md-12">
            © 2014 : Reminisense Corp.
        </div>
    </div>
</div>
<script>
    new WOW().init();
</script>
@yield('modals')
@yield('scripts') <!--ARA Best practice to add scripts at the bottom so that scripts could be loaded after the page has benn rendered -->
</body>
</html>