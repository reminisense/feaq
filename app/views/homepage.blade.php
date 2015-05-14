<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>FeatherQ</title>
    <link rel="stylesheet" type="text/css" href="/css/ngCloak.css">
    <link rel="shortcut icon" id="favicon" href="favicon.png">
    <link rel="stylesheet" type='text/css' href="/css/bootstrap.min.css">
    <link rel='stylesheet' type='text/css' href='/css/homepage/style.css'>
    <link rel='stylesheet' type='text/css' href='/css/homepage/responsive.css'>
    <link rel='stylesheet' type='text/css' href="/css/homepage/animate.css" >
    <link rel="stylesheet" type="text/css" href="/css/jquery.timeentry.css">
    <link rel='stylesheet' type='text/css' href='/css/refresh-animate.css'>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css"/>

    <script type="text/javascript" src="/js/jquery-1.11.2.min.js"></script>
    <script src="/js/angular.min.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/custom.js"></script>
    <script src="/js/ngFeatherQ.js"></script>
    <script src="/js/ngFacebook.js"></script>
    <script src="/js/ngAutocomplete.js"></script>
    <script src="/js/google-analytics/googleAnalytics.js"></script>
    <script src="/js/jquery.plugin.js"></script>
    <script src="/js/jquery.timeentry.js"></script>
    <script src="/js/search-business.js"></script>
    <script src="/js/user/Usertracker.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js"></script>
</head>

<body ng-app="FeatherQ" ng-cloak>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/"><img class="logo" src="img/featherq-logo.svg"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" ng-controller="fbController">
            <ul class="nav navbar-nav navbar-right">
                <li><a class="feats" href="#features">FeatherQ Features</a></li>
                <li><a class="start" href="#getting-started">Getting Started</a></li>
                <li style="margin-left:10px;"><a href="" class="btn btn-blue btn-fb" ng-click="login()" role="button"><img src="img/icon-fb.png">Log In</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<section class="page1">
    <div class="intro">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1 class="wow fadeInUp">#ChangeTheWait</h1>
                </div>
                <div class="wow fadeInUp col-md-6 text-center">
                    <p><span>FeatherQ </span>creates an atmosphere that allows the customer's mobile device to wait in line for them; keeping customers happy and engaged while helping businesses maximize revenue and increase business opportunity.</p>
                </div>
                <div class="hmobile wow fadeInUp col-md-6 text-center">
                    <p><span>FeatherQ</span> is a cloud-based, line-management application that helps businesses successfully control their long lines and turns the wait of customers into a better experience. </p>
                </div>
            </div>

            <div class="row wow fadeIn" ng-controller="searchBusinessCtrl">
                <div class="filters clearfix">
                    <div class="col-md-10 col-md-offset-2 col-sm-12 col-xs-12">
                        <div class="filterwrap  wow fadeInUp">
                            <form ng-submit="searchBusiness(location_filter, industry_filter)">
                                <div class="btn-group" role="group" style="margin-bottom: 0px;">
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupLoc" type="button"
                                                class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-expanded="false">
                                            @{{ location_filter }}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu"
                                            aria-labelledby="btnGroupDrop1"
                                            id="location-filter">
                                            <li ng-click="locationFilter('Afghanistan');">
                                                <a href="">Afghanistan</a></li>
                                            <li ng-click="locationFilter('Albania');">
                                                <a href="">Albania</a></li>
                                            <li ng-click="locationFilter('Algeria');">
                                                <a href="">Algeria</a></li>
                                            <li ng-click="locationFilter('Andorra');">
                                                <a href="">Andorra</a></li>
                                            <li ng-click="locationFilter('Angola');">
                                                <a href="">Angola</a></li>
                                            <li ng-click="locationFilter('Antigua and Barbuda');">
                                                <a href="">Antigua and Barbuda</a>
                                            </li>
                                            <li ng-click="locationFilter('Argentina');">
                                                <a href="">Argentina</a></li>
                                            <li ng-click="locationFilter('Armenia');">
                                                <a href="">Armenia</a></li>
                                            <li ng-click="locationFilter('Aruba');">
                                                <a href="">Aruba</a></li>
                                            <li ng-click="locationFilter('Australia');">
                                                <a href="">Australia</a></li>
                                            <li ng-click="locationFilter('Austria');">
                                                <a href="">Austria</a></li>
                                            <li ng-click="locationFilter('Azerbaijan');">
                                                <a href="">Azerbaijan</a></li>
                                            <li ng-click="locationFilter('Bahamas');">
                                                <a href="">Bahamas, The</a></li>
                                            <li ng-click="locationFilter('Bahrain');">
                                                <a href="">Bahrain</a></li>
                                            <li ng-click="locationFilter('Bangladesh');">
                                                <a href="">Bangladesh</a></li>
                                            <li ng-click="locationFilter('Barbados');">
                                                <a href="">Barbados</a></li>
                                            <li ng-click="locationFilter('Belarus');">
                                                <a href="">Belarus</a></li>
                                            <li ng-click="locationFilter('Belgium');">
                                                <a href="">Belgium</a></li>
                                            <li ng-click="locationFilter('Belize');">
                                                <a href="">Belize</a></li>
                                            <li ng-click="locationFilter('Benin');">
                                                <a href="">Benin</a></li>
                                            <li ng-click="locationFilter('Bhutan');">
                                                <a href="">Bhutan</a></li>
                                            <li ng-click="locationFilter('Bolivia');">
                                                <a href="">Bolivia</a></li>
                                            <li ng-click="locationFilter('Bosnia and Herzegovina');">
                                                <a href="">Bosnia and
                                                    Herzegovina</a></li>
                                            <li ng-click="locationFilter('Botswana');">
                                                <a href="">Botswana</a></li>
                                            <li ng-click="locationFilter('Brazil');">
                                                <a href="">Brazil</a></li>
                                            <li ng-click="locationFilter('Brunei');">
                                                <a href="">Brunei</a></li>
                                            <li ng-click="locationFilter('Bulgaria');">
                                                <a href="">Bulgaria</a></li>
                                            <li ng-click="locationFilter('Burkina Faso');">
                                                <a href="">Burkina Faso</a></li>
                                            <li ng-click="locationFilter('Burma');">
                                                <a href="">Burma</a></li>
                                            <li ng-click="locationFilter('Burundi');">
                                                <a href="">Burundi</a></li>
                                            <li ng-click="locationFilter('Cambodia');">
                                                <a href="">Cambodia</a></li>
                                            </a></li>
                                            <li ng-click="locationFilter('Cameroon');">
                                                <a href="">Cameroon</a></li>
                                            <li ng-click="locationFilter('Canada');">
                                                <a href="">Canada</a></li>
                                            <li ng-click="locationFilter('Cape Verde');">
                                                <a href="">Cape Verde</a></li>
                                            <li ng-click="locationFilter('Central African Republic');">
                                                <a href="">Central African
                                                    Republic</a></li>
                                            <li ng-click="locationFilter('Chad');">
                                                <a href="">Chad</a></li>
                                            <li ng-click="locationFilter('Chile');">
                                                <a href="">Chile</a></li>
                                            <li ng-click="locationFilter('China');">
                                                <a href="">China</a></li>
                                            <li ng-click="locationFilter('Colombia');">
                                                <a href="">Colombia</a></li>
                                            <li ng-click="locationFilter('Comoros');">
                                                <a href="">Comoros</a></li>
                                            <li ng-click="locationFilter('Congo');">
                                                <a href="">Congo, Republic of
                                                    the</a></li>
                                            <li ng-click="locationFilter('Costa Rica');">
                                                <a href="">Costa Rica</a></li>
                                            <li ng-click="locationFilter('Cote dIvoire');">
                                                <a href="">Cote d'Ivoire</a></li>
                                            <li ng-click="locationFilter('Croatia');">
                                                <a href="">Croatia</a></li>
                                            <li ng-click="locationFilter('Cuba');">
                                                <a href="">Cuba</a></li>
                                            <li ng-click="locationFilter('Curacao');">
                                                <a href="">Curacao</a></li>
                                            <li ng-click="locationFilter('Cyprus');">
                                                <a href="">Cyprus</a></li>
                                            <li ng-click="locationFilter('Czech Republic');">
                                                <a href="">Czech Republic</a></li>
                                            <li ng-click="locationFilter('Denmark');">
                                                <a href="">Denmark</a></li>
                                            <li ng-click="locationFilter('Djibouti');">
                                                <a href="">Djibouti</a></li>
                                            <li ng-click="locationFilter('Dominica');">
                                                <a href="">Dominica</a></li>
                                            <li ng-click="locationFilter('Dominican Republic');">
                                                <a href="">Dominican Republic</a>
                                            </li>
                                            <li ng-click="locationFilter('East Timor');">
                                                <a href="">East Timor (see
                                                    Timor-Leste)</a></li>
                                            <li ng-click="locationFilter('Ecuador');">
                                                <a href="">Ecuador</a></li>
                                            <li ng-click="locationFilter('Egypt');">
                                                <a href="">Egypt</a></li>
                                            <li ng-click="locationFilter('El Salvador');">
                                                <a href="">El Salvador</a></li>
                                            <li ng-click="locationFilter('Equatorial Guinea');">
                                                <a href="">Equatorial Guinea</a>
                                            </li>
                                            <li ng-click="locationFilter('Eritrea');">
                                                <a href="">Eritrea</a></li>
                                            <li ng-click="locationFilter('Estonia');">
                                                <a href="">Estonia</a></li>
                                            <li ng-click="locationFilter('Ethiopia');">
                                                <a href="">Ethiopia</a></li>
                                            <li ng-click="locationFilter('Fiji');">
                                                <a href="">Fiji</a></li>
                                            <li ng-click="locationFilter('Finland');">
                                                <a href="">Finland</a></li>
                                            <li ng-click="locationFilter('France');">
                                                <a href="">France</a></li>
                                            <li ng-click="locationFilter('Gabon');">
                                                <a href="">Gabon</a></li>
                                            <li ng-click="locationFilter('Gambia');">
                                                <a href="">Gambia, The</a></li>
                                            <li ng-click="locationFilter('Georgia');">
                                                <a href="">Georgia</a></li>
                                            <li ng-click="locationFilter('Germany');">
                                                <a href="">Germany</a></li>
                                            <li ng-click="locationFilter('Ghana');">
                                                <a href="">Ghana</a></li>
                                            <li ng-click="locationFilter('Greece');">
                                                <a href="">Greece</a></li>
                                            <li ng-click="locationFilter('Grenada');">
                                                <a href="">Grenada</a></li>
                                            <li ng-click="locationFilter('Guatemala');">
                                                <a href="">Guatemala</a></li>
                                            <li ng-click="locationFilter('Guinea');">
                                                <a href="">Guinea</a></li>
                                            <li ng-click="locationFilter('Guinea-Bissau');">
                                                <a href="">Guinea-Bissau</a></li>
                                            <li ng-click="locationFilter('Guyana');">
                                                <a href="">Guyana</a></li>
                                            <li ng-click="locationFilter('Haiti');">
                                                <a href="">Haiti</a></li>
                                            <li ng-click="locationFilter('Holy See');">
                                                <a href="">Holy See</a></li>
                                            <li ng-click="locationFilter('Honduras');">
                                                <a href="">Honduras</a></li>
                                            <li ng-click="locationFilter('Hong Kong');">
                                                <a href="">Hong Kong</a></li>
                                            <li ng-click="locationFilter('Hungary');">
                                                <a href="">Hungary</a></li>
                                            <li ng-click="locationFilter('Iceland');">
                                                <a href="">Iceland</a></li>
                                            <li ng-click="locationFilter('India');">
                                                <a href="">India</a></li>
                                            <li ng-click="locationFilter('Indonesia');">
                                                <a href="">Indonesia</a></li>
                                            <li ng-click="locationFilter('Iran');">
                                                <a href="">Iran</a></li>
                                            <li ng-click="locationFilter('Iraq');">
                                                <a href="">Iraq</a></li>
                                            <li ng-click="locationFilter('Ireland');">
                                                <a href="">Ireland</a></li>
                                            <li ng-click="locationFilter('Israel');">
                                                <a href="">Israel</a></li>
                                            <li ng-click="locationFilter('Italy');">
                                                <a href="">Italy</a></li>
                                            <li ng-click="locationFilter('Jamaica');">
                                                <a href="">Jamaica</a></li>
                                            <li ng-click="locationFilter('Japan');">
                                                <a href="">Japan</a></li>
                                            <li ng-click="locationFilter('Jordan');">
                                                <a href="">Jordan</a></li>
                                            <li ng-click="locationFilter('Kazakhstan');">
                                                <a href="">Kazakhstan</a></li>
                                            <li ng-click="locationFilter('Kenya');">
                                                <a href="">Kenya</a></li>
                                            <li ng-click="locationFilter('Kiribati');">
                                                <a href="">Kiribati</a></li>
                                            <li ng-click="locationFilter('Kosovo');">
                                                <a href="">Kosovo</a></li>
                                            <li ng-click="locationFilter('Kuwait');">
                                                <a href="">Kuwait</a></li>
                                            <li ng-click="locationFilter('Kyrgyzstan');">
                                                <a href="">Kyrgyzstan</a></li>
                                            <li ng-click="locationFilter('Laos');">
                                                <a href="">Laos</a></li>
                                            <li ng-click="locationFilter('Latvia');">
                                                <a href="">Latvia</a></li>
                                            <li ng-click="locationFilter('Lebanon');">
                                                <a href="">Lebanon</a></li>
                                            <li ng-click="locationFilter('Lesotho');">
                                                <a href="">Lesotho</a></li>
                                            <li ng-click="locationFilter('Liberia');">
                                                <a href="">Liberia</a></li>
                                            <li ng-click="locationFilter('Libya');">
                                                <a href="">Libya</a></li>
                                            <li ng-click="locationFilter('Liechtenstein');">
                                                <a href="">Liechtenstein</a></li>
                                            <li ng-click="locationFilter('Lithuania');">
                                                <a href="">Lithuania</a></li>
                                            <li ng-click="locationFilter('Luxembourg');">
                                                <a href="">Luxembourg</a></li>
                                            <li ng-click="locationFilter('Macau');">
                                                <a href="">Macau</a></li>
                                            <li ng-click="locationFilter('Macedonia');">
                                                <a href="">Macedonia</a></li>
                                            <li ng-click="locationFilter('Madagascar');">
                                                <a href="">Madagascar</a></li>
                                            <li ng-click="locationFilter('Malawi');">
                                                <a href="">Malawi</a></li>
                                            <li ng-click="locationFilter('Malaysia');">
                                                <a href="">Malaysia</a></li>
                                            <li ng-click="locationFilter('Maldives');">
                                                <a href="">Maldives</a></li>
                                            <li ng-click="locationFilter('Mali');">
                                                <a href="">Mali</a></li>
                                            <li ng-click="locationFilter('Malta');">
                                                <a href="">Malta</a></li>
                                            <li ng-click="locationFilter('Marshall Islands');">
                                                <a href="">Marshall Islands</a>
                                            </li>
                                            <li ng-click="locationFilter('Mauritania');">
                                                <a href="">Mauritania</a></li>
                                            <li ng-click="locationFilter('Mauritius');">
                                                <a href="">Mauritius</a></li>
                                            <li ng-click="locationFilter('Mexico');">
                                                <a href="">Mexico</a></li>
                                            <li ng-click="locationFilter('Micronesia');">
                                                <a href="">Micronesia</a></li>
                                            <li ng-click="locationFilter('Moldova');">
                                                <a href="">Moldova</a></li>
                                            <li ng-click="locationFilter('Monaco');">
                                                <a href="">Monaco</a></li>
                                            <li ng-click="locationFilter('Mongolia');">
                                                <a href="">Mongolia</a></li>
                                            <li ng-click="locationFilter('Montenegro');">
                                                <a href="">Montenegro</a></li>
                                            <li ng-click="locationFilter('Morocco');">
                                                <a href="">Morocco</a></li>
                                            <li ng-click="locationFilter('Mozambique');">
                                                <a href="">Mozambique</a></li>
                                            <li ng-click="locationFilter('Namibia');">
                                                <a href="">Namibia</a></li>
                                            <li ng-click="locationFilter('Nauru');">
                                                <a href="">Nauru</a></li>
                                            <li ng-click="locationFilter('Nepal');">
                                                <a href="">Nepal</a></li>
                                            <li ng-click="locationFilter('Netherlands');">
                                                <a href="">Netherlands</a></li>
                                            <li ng-click="locationFilter('Netherlands Antilles');">
                                                <a href="">Netherlands Antilles</a>
                                            </li>
                                            <li ng-click="locationFilter('New Zealand');">
                                                <a href="">New Zealand</a></li>
                                            <li ng-click="locationFilter('Nicaragua');">
                                                <a href="">Nicaragua</a></li>
                                            <li ng-click="locationFilter('Niger');">
                                                <a href="">Niger</a></li>
                                            <li ng-click="locationFilter('Nigeria');">
                                                <a href="">Nigeria</a></li>
                                            <li ng-click="locationFilter('North Korea');">
                                                <a href="">North Korea</a></li>
                                            <li ng-click="locationFilter('Norway');">
                                                <a href="">Norway</a></li>
                                            <li ng-click="locationFilter('Oman');">
                                                <a href="">Oman</a></li>
                                            <li ng-click="locationFilter('Pakistan');">
                                                <a href="">Pakistan</a></li>
                                            <li ng-click="locationFilter('Palau');">
                                                <a href="">Palau</a></li>
                                            <li ng-click="locationFilter('Panama');">
                                                <a href="">Panama</a></li>
                                            <li ng-click="locationFilter('Papua New Guinea');">
                                                <a href="">Papua New Guinea</a>
                                            </li>
                                            <li ng-click="locationFilter('Paraguay');">
                                                <a href="">Paraguay</a></li>
                                            <li ng-click="locationFilter('Peru');">
                                                <a href="">Peru</a></li>
                                            <li ng-click="locationFilter('Philippines');">
                                                <a href="">Philippines</a></li>
                                            <li ng-click="locationFilter('Poland');">
                                                <a href="">Poland</a></li>
                                            <li ng-click="locationFilter('Portugal');">
                                                <a href="">Portugal</a></li>
                                            <li ng-click="locationFilter('Qatar');">
                                                <a href="">Qatar</a></li>
                                            <li ng-click="locationFilter('Romania');">
                                                <a href="">Romania</a></li>
                                            <li ng-click="locationFilter('Russia');">
                                                <a href="">Russia</a></li>
                                            <li ng-click="locationFilter('Rwanda');">
                                                <a href="">Rwanda</a></li>
                                            <li ng-click="locationFilter('Saint Kitts and Nevis');">
                                                <a href="">Saint Kitts and
                                                    Nevis</a></li>
                                            <li ng-click="locationFilter('Saint Lucia');">
                                                <a href="">Saint Lucia</a></li>
                                            <li ng-click="locationFilter('Saint Vincent and the Grenadines');">
                                                <a href="">Saint Vincent and the
                                                    Grenadines</a></li>
                                            <li ng-click="locationFilter('Samoa');">
                                                <a href="">Samoa</a></li>
                                            <li ng-click="locationFilter('San Marino');">
                                                <a href="">San Marino</a></li>
                                            <li ng-click="locationFilter('Sao Tome and Principe');">
                                                <a href="">Sao Tome and
                                                    Principe</a></li>
                                            <li ng-click="locationFilter('Saudi Arabia');">
                                                <a href="">Saudi Arabia</a></li>
                                            <li ng-click="locationFilter('Senegal');">
                                                <a href="">Senegal</a></li>
                                            <li ng-click="locationFilter('Serbia');">
                                                <a href="">Serbia</a></li>
                                            <li ng-click="locationFilter('Seychelles');">
                                                <a href="">Seychelles</a></li>
                                            <li ng-click="locationFilter('Sierra Leone');">
                                                <a href="">Sierra Leone</a></li>
                                            <li ng-click="locationFilter('Singapore');">
                                                <a href="">Singapore</a></li>
                                            <li ng-click="locationFilter('Sint Maarten');">
                                                <a href="">Sint Maarten</a></li>
                                            <li ng-click="locationFilter('Slovakia');">
                                                <a href="">Slovakia</a></li>
                                            <li ng-click="locationFilter('Slovenia');">
                                                <a href="">Slovenia</a></li>
                                            <li ng-click="locationFilter('Solomon Islands');">
                                                <a href="">Solomon Islands</a></li>
                                            <li ng-click="locationFilter('Somalia');">
                                                <a href="">Somalia</a></li>
                                            <li ng-click="locationFilter('South Africa');">
                                                <a href="">South Africa</a></li>
                                            <li ng-click="locationFilter('South Korea');">
                                                <a href="">South Korea</a></li>
                                            <li ng-click="locationFilter('South Sudan');">
                                                <a href="">South Sudan</a></li>
                                            <li ng-click="locationFilter('Spain');">
                                                <a href="">Spain</a></li>
                                            <li ng-click="locationFilter('Sri Lanka');">
                                                <a href="">Sri Lanka</a></li>
                                            <li ng-click="locationFilter('Sudan');">
                                                <a href="">Sudan</a></li>
                                            <li ng-click="locationFilter('Suriname');">
                                                <a href="">Suriname</a></li>
                                            <li ng-click="locationFilter('Swaziland');">
                                                <a href="">Swaziland</a></li>
                                            <li ng-click="locationFilter('Sweden');">
                                                <a href="">Sweden</a></li>
                                            <li ng-click="locationFilter('Switzerland');">
                                                <a href="">Switzerland</a></li>
                                            <li ng-click="locationFilter('Syria');">
                                                <a href="">Syria</a></li>
                                            <li ng-click="locationFilter('Taiwan');">
                                                <a href="">Taiwan</a></li>
                                            <li ng-click="locationFilter('Tajikistan');">
                                                <a href="">Tajikistan</a></li>
                                            <li ng-click="locationFilter('Tanzania');">
                                                <a href="">Tanzania</a></li>
                                            <li ng-click="locationFilter('Thailand');">
                                                <a href="">Thailand</a></li>
                                            <li ng-click="locationFilter('Timor-Leste');">
                                                <a href="">Timor-Leste</a></li>
                                            <li ng-click="locationFilter('Togo');">
                                                <a href="">Togo</a></li>
                                            <li ng-click="locationFilter('Tonga');">
                                                <a href="">Tonga</a></li>
                                            <li ng-click="locationFilter('Tunisia and Tobago');">
                                                <a href="">Trinidad and Tobago</a>
                                            </li>
                                            <li ng-click="locationFilter('Tunisia');">
                                                <a href="">Tunisia</a></li>
                                            <li ng-click="locationFilter('Turkey');">
                                                <a href="">Turkey</a></li>
                                            <li ng-click="locationFilter('Turkmenistan');">
                                                <a href="">Turkmenistan</a></li>
                                            <li ng-click="locationFilter('Tuvalu');">
                                                <a href="">Tuvalu</a></li>
                                            <li ng-click="locationFilter('Uganda');">
                                                <a href="">Uganda</a></li>
                                            <li ng-click="locationFilter('Ukraine');">
                                                <a href="">Ukraine</a></li>
                                            <li ng-click="locationFilter('United Arab Emirates');">
                                                <a href="">United Arab Emirates</a>
                                            </li>
                                            <li ng-click="locationFilter('United Kingdom');">
                                                <a href="">United Kingdom</a></li>
                                            <li ng-click="locationFilter('Uruguay');">
                                                <a href="">Uruguay</a></li>
                                            <li ng-click="locationFilter('Uzbekistan');">
                                                <a href="">Uzbekistan</a></li>
                                            <li ng-click="locationFilter('Vanuatu');">
                                                <a href="">Vanuatu</a></li>
                                            <li ng-click="locationFilter('Venezuela');">
                                                <a href="">Venezuela</a></li>
                                            <li ng-click="locationFilter('Vietnam');">
                                                <a href="">Vietnam</a></li>
                                            <li ng-click="locationFilter('Yemen');">
                                                <a href="">Yemen</a></li>
                                            <li ng-click="locationFilter('Zambia');">
                                                <a href="">Zambia</a></li>
                                            <li ng-click="locationFilter('Zimbabwe');">
                                                <a href="">Zimbabwe</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDropInd" type="button"
                                                class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown"
                                                aria-expanded="false">
                                            @{{ industry_filter }}
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu"
                                            aria-labelledby="btnGroupDrop1">
                                            <li ng-click="industryFilter('Accounting');">
                                                <a href="">Accounting</a></li>
                                            <li ng-click="industryFilter('Advertising');">
                                                <a href="">Advertising</a></li>
                                            <li ng-click="industryFilter('Agriculture');">
                                                <a href="">Agriculture</a></li>
                                            <li ng-click="industryFilter('Air Services');">
                                                <a href="">Air Services</a></li>
                                            <li ng-click="industryFilter('Airlines');">
                                                <a href="">Airlines</a></li>
                                            <li ng-click="industryFilter('Apparel');">
                                                <a href="">Apparel</a></li>
                                            <li ng-click="industryFilter('Appliances');">
                                                <a href="">Appliances</a></li>
                                            <li ng-click="industryFilter('Auto Dealership');">
                                                <a href="">Auto Dealership</a></li>
                                            <li ng-click="industryFilter('Banking');">
                                                <a href="">Banking</a></li>
                                            <li ng-click="industryFilter('Broadcasting');">
                                                <a href="">Broadcasting</a></li>
                                            <li ng-click="industryFilter('Business Services');">
                                                <a href="">Business Services</a>
                                            </li>
                                            <li ng-click="industryFilter('Communications');">
                                                <a href="">Communications</a></li>
                                            <li ng-click="industryFilter('Corporate');">
                                                <a href="">Corporate</a></li>
                                            <li ng-click="industryFilter('Customer Service');">
                                                <a href="">Customer Service</a>
                                            </li>
                                            <li ng-click="industryFilter('Delivery');">
                                                <a href="">Delivery</a></li>
                                            <li ng-click="industryFilter('Delivery Services');">
                                                <a href="">Delivery Services</a>
                                            </li>
                                            <li ng-click="industryFilter('Education');">
                                                <a href="">Education</a></li>
                                            <li ng-click="industryFilter('Energy');">
                                                <a href="">Energy</a></li>
                                            <li ng-click="industryFilter('Entertainment');">
                                                <a href="">Entertainment</a></li>
                                            <li ng-click="industryFilter('Events');">
                                                <a href="">Events</a></li>
                                            <li ng-click="industryFilter('Food and Beverage');">
                                                <a href="">Food and Beverage</a>
                                            </li>
                                            <li ng-click="industryFilter('Government');">
                                                <a href="">Government</a></li>
                                            <li ng-click="industryFilter('Grocery');">
                                                <a href="">Grocery</a></li>
                                            <li ng-click="industryFilter('Healthcare');">
                                                <a href="">Healthcare</a></li>
                                            <li ng-click="industryFilter('Hobbies and Collections');">
                                                <a href="">Hobbies and
                                                    Collections</a></li>
                                            <li ng-click="industryFilter('Hospitality');">
                                                <a href="">Hospitality</a></li>
                                            <li ng-click="industryFilter('Insurance');">
                                                <a href="">Insurance</a></li>
                                            <li ng-click="industryFilter('Information Technology');">
                                                <a href="">Information
                                                    Technology</a></li>
                                            <li ng-click="industryFilter('Lifestyle');">
                                                <a href="">Lifestyle</a></li>
                                            <li ng-click="industryFilter('Mail Order Services');">
                                                <a href="">Mail Order Services</a>
                                            </li>
                                            <li ng-click="industryFilter('Manufacturing');">
                                                <a href="">Manufacturing</a></li>
                                            <li ng-click="industryFilter('Pharmaceutical');">
                                                <a href="">Pharmaceutical</a></li>
                                            <li ng-click="industryFilter('Media');">
                                                <a href="">Media</a></li>
                                            <li ng-click="industryFilter('Professional services');">
                                                <a href="">Professional
                                                    services</a></li>
                                            <li ng-click="industryFilter('Publishing');">
                                                <a href="">Publishing</a></li>
                                            <li ng-click="industryFilter('Real Estate');">
                                                <a href="">Real Estate</a></li>
                                            <li ng-click="industryFilter('Recreation');">
                                                <a href="">Recreation</a></li>
                                            <li ng-click="industryFilter('Rentals');">
                                                <a href="">Rentals</a></li>
                                            <li ng-click="industryFilter('Retail');">
                                                <a href="">Retail</a></li>
                                            <li ng-click="industryFilter('Software Development');">
                                                <a href="">Software Development</a>
                                            </li>
                                            <li ng-click="industryFilter('Technology');">
                                                <a href="">Technology</a></li>
                                            <li ng-click="industryFilter('Travel and Tours');">
                                                <a href="">Travel and Tours</a>
                                            </li>
                                            <li ng-click="industryFilter('Utility services');">
                                                <a href="">Utility services</a>
                                            </li>
                                            <li ng-click="industryFilter('Web Services');">
                                                <a href="">Web Services</a></li>
                                            <li ng-click="industryFilter('Wholesale');">
                                                <a href="">Wholesale</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button id="btnTimeOpen" type="button"
                                                class="btn btn-default">
                                            Time Open
                                        </button>
                                        <input type="text" id="time_open-filter"
                                               name="time_open"
                                               ng-model="time_open"
                                               placeholder="8:00 AM"
                                               class="form-control"
                                               style="display: none;"/>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <span class="searchblock">
                                        <input type="text" placeholder="ie. Ng Khai Devt Corp" id="search-keyword" ng-model="search_keyword" ng-model-options="{debounce: 1000}" autocomplete="off">
                                        <ul class="dropdown-menu" role="menu" id="search-suggest" ng-hide="dropdown_businesses.length == 0" outside-click="dropdown_businesses = []">
                                            <li ng-repeat="business in dropdown_businesses">
                                                <a href="#" ng-click="searchBusiness(location_filter, industry_filter, business.name)">
                                                    <strong class="business-name">@{{ business.name }}</strong><br>
                                                    <small class="address">@{{ business.local_address }}</small>
                                                </a>
                                            </li>
                                        </ul>
                                        <button id="search-filter" type="submit" class="btn btn-cyan btn-md">SEARCH</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row" id="search-loader" style="display: none; text-align: center;">
                    <img src="/images/reload_home.gif" />
                </div>
                <div id="search-grid" style="display: none;">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <h5 class="mb30 searchresults">@{{ searchLabel }}</h5>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-6" ng-repeat="business in businesses">
                        <div class="boxed boxed-single clickable">
                            <a class="business_link" href="/broadcast/business/@{{ business.business_id }}" target="_blank">
                                <div class="wrap">
                                    <h3>@{{ business.business_name }}</h3>
                                    <small>@{{ business.local_address }}</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12 col-sm-6" ng-controller="fbController">
                        <div class="boxed boxed-single clickable" ng-click="login()">
                            <div class="wrap">
                                <h3 style="color: #ff925b;"><span class="gray glyphicon glyphicon-plus"></span> More Businesses</h3>
                                <small>Sign up now to view more businesses</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<a name="features"></a>
<section class="page2">
    <div class="container">
        <h2 class="orange wow fadeInUp">FeatherQ Features</h2>
        <div class="row wow fadeInUp">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="text-center">
                    <img src="img/30sec.png">
                </div>
                <div class="mt20">
                    <h4>30-second Business Setup</h4>
                    <p>In as short as 30-seconds, connect to FB and create your business account to begin managing your lines today.<em>Have full control over staff assignments to terminals and business details in a simple registration process.</em></p>
                </div>

            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="text-center">
                    <img src="img/line.png">
                </div>
                <div class="mt20">
                    <h4>Flexible line management</h4>
                    <p>FeatherQ offers functionality no matter your business. Enjoy a flexible line management solution that's able to suit your needs.Whether you have three terminals serving one line, or only one terminal, FeatherQ can be set for these.</p>
                </div>

            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="text-center">
                    <img src="img/customize.png">
                </div>
                <div class="mt20">
                    <h4>Customizable Features</h4>
                    <p>Choose a display layout that fits your business. FeatherQ lets you customize how your customers get informed about their status.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="text-center">
                    <img src="img/analytics.png">
                </div>
                <div class="mt20">
                    <h4>Business Analytics</h4>
                    <p>Know what's important to your business directly from customer behavior. FeatherQ offers insights such as: average waiting time per customer or how many customers dropped their priority number.</p>
                </div>
            </div>
        </div>
        <div class="row wow fadeInUp">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="text-center">
                    <img src="img/minimal.png">
                </div>
                <div class="mt20">
                    <h4>Minimal Setup</h4>
                    <p>Do away with expensive overhead costs and installation fees. FeatherQ's browser-based solution works on any smartphone, tablet or computer.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="text-center">
                    <img src="img/message.png">
                </div>
                <div class="mt20">
                    <h4>Easy Customer Notifications</h4>
                    <p>Easily reach your customers through SMS or Email. They can also scan a QR code unique to your business to receive live updates of the priority status. Let your customers wait worry-free that their place in line is secured. </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="text-center">
                    <img src="img/simple.png">
                </div>
                <div class="mt20">
                    <h4>Simple Interface</h4>
                    <p>Manage your lines without disrupting your business flow. FeatherQ comes without bulky training manuals, or complicated instructions. </p>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="text-center">
                    <img src="img/30sec.png">
                </div>
                <div class="mt20">
                    <h4>It's Free</h4>
                    <p>FeatherQ is a complete line management system that is free to use. It is supported by ads. </p>
                </div>
            </div>
        </div>
    </div>
</section>
<a name="diy"></a>
<section class="page3" name="diy">
    <div class="clearfix">
        <div class="">
            <h2 class="orange wow fadeInUp">FeatherQ Process</h2>
        </div>
    </div>

    <div class="clearfix">
        <div class="slider center slick-slider" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
            <div>
                <img src="img/diy/1.jpg" />
                <p>Sign up using Facebook login to begin creating an account!</p>
            </div>
            <div>
                <img src="img/diy/2.jpg" />
                <p>Add your Business details</p>
            </div>
            <div>
                <img src="img/diy/3.jpg" />
                <p>Customize your Broadcast Screen</p>
            </div>
            <div>
                <img src="img/diy/4.jpg" />
                <p>Start calling your customers!</p>
            </div>
        </div>
    </div>
</section>
<a name="getting-started"></a>
<section class="page4">
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <div class="wrap">
            <h3 class="wow fadeInUp text-center">Turn the wait of your customers into a better experience<br>
                and <span>increase your business opportunity</span>
            </h3>
            </div>
        </div>
        <div class="col-md-7 col-xs-12" style="margin-top:140px;">
                <h4 class="nomg wow fadeInUp">Start using FeatherQ for your business today</h4>
                <h4 class="nomg wow fadeInUp">It's Fast, Easy and Free</h4>
                <br>
                <h4 class="nomg wow fadeInUp">Call us at: <span class="cyan">(032) 345-4658</span></h4>
        </div>
        <div class="col-md-5 col-xs-12" style="margin-top:140px;">
            <div class="text-center" ng-controller="fbController">
                <a class="h1 btn btn-lg btn-blue" ng-click="login()">Continue with Facebook</a>
                <small style="display: block;"><a id="yfb" href="" data-toggle="modal" data-target="#modal-yfacebook" >Why we use Facebook?</a></small>
                <div class="modal fade" id="modal-yfacebook" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" style="z-index: 9999;">
                    <div class="modal-content">
                      <div class="modal-body">
                        <h2 class="cyan">Why Facebook?</h2>
                            <div id="icons">
                                <span class="glyphicon glyphicon-user"></span>
                                <span class="glyphicon glyphicon-thumbs-up"></span>
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>
                        <p>It makes sign in super duper fast, one less password to remember. And you can instantly share many wonderful things with your friends.</p>
                        <small>Your privacy is highly respected. nothing will be posted without your permission</small>
                      </div>
                      <div class="modal-footer text-center">
                        <button type="button" class="mb20 btn btn-lg btn-primary" data-dismiss="modal">OK</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="">
            <p class="text-center">&copy; 2015: Reminisense Corp.</p>
        </div>
    </div>
</footer>

<script src="js/wow.min.js"></script>
<script>
    $('.slick-slider').slick({
      centerMode: true,
      centerPadding: '60px',
      dots: true,
      infinite: true,
      pauseOnHover: false,
      slidesToShow: 3,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 7000,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
    });

    $('#time_open-filter').timeEntry({ampmPrefix: ' ', spinnerImage: ''});
    new WOW().init();
</script>
</body>
</html>