@extends('dashboard')
@section('styles')
    <link rel='stylesheet' type='text/css' href='/css/business/business.css'>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
@stop
@section('container')
    <div class="feat feat-business">
        <div class="container">
            <div class="text-center">
                <h1><span class="glyphicon glyphicon-stats"></span>FeatherQ Business Numbers</h1>
            </div>
        </div>
        <div class="arrow">
            <img src="/img/arrow.png">
        </div>
    </div>
    <div>
        <div class="container" id="date-container">
            <div class="col-md-3">
            </div>
            <div class="col-md-1">
                <input type="text" id="start-date" name="start-date"/>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-3">
                <b>-</b><input type="text" id="end-date" name="end-date"/>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" id="btn-submit-numbers">View Numbers</button>
            </div>
        </div>
        <div class="container">
            <div class="col-md-6 table-container">
                <table id="business-table" class="table-bordered table-responsive table">
                    <tr>
                        <th class="text-center" id="business-label" colspan="2">Business Numbers</td>
                    </tr>
                    <tr>
                        <td id="business-numbers-label" width="50%">New Businesses</td>
                        <td id="business-numbers"></td>
                    </tr>
                    <tr>
                        <td id="user-numbers-label">New Users</td>
                        <td id="user-numbers"></td>
                    </tr>
                    <tr>
                        <td id="issued-numbers-label">Issued Numbers</td>
                        <td id="issued-numbers"></td>
                    </tr>
                    <tr>
                        <td id="called-numbers-label">Called Numbers</td>
                        <td id="called-numbers"></td>
                    </tr>
                    <tr>
                        <td id="served-numbers-label">Served Numbers</td>
                        <td id="served-numbers"></td>
                    </tr>
                    <tr>
                        <td id="dropped-numbers-label">Dropped Numbers</td>
                        <td id="dropped-numbers"></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-5">
                <div id="filter-container" class="mb10">
                    <div id="filter-labels">
                        <b>Sort By Business:</b>
                    </div>
                    <div id="filter-dropdown">
                        <select id="business-dropdown" class="form-control"></select>
                    </div>
                    <div id="filter-buttons">
                        <button id="business-button" class="btn btn-primary">Show Graph</button>
                    </div>
                </div>
                <div id="filter-container"  class="mb10">
                    <div id="filter-labels">
                        <b>Sort By Industry:</b>
                    </div>
                    <div id="filter-dropdown">
                        <select id="industry-dropdown" class="form-control">
                            <option value="1">Accounting</option>
                            <option value="2">Advertising</option>
                            <option>Agriculture</option>
                            <option>Air Services</option>
                            <option>Airlines</option>
                            <option>Apparel</option>
                            <option>Appliances</option>
                            <option>Auto Dealership</option>
                            <option>Banking</option>
                            <option>Broadcasting</option>
                            <option>Business Services</option>
                            <option>Communications</option>
                            <option>Corporate</option>
                            <option>Customer Service</option>
                            <option>Delivery</option>
                            <option>Delivery Services</option>
                            <option>Education</option>
                            <option>Energy</option>
                            <option>Entertainment</option>
                            <option>Events</option>
                            <option>Food and Beverage</option>
                            <option>Government</option>
                            <option>Grocery</option>
                            <option>Healthcare</option>
                            <option>Hobbies and Collections</option>
                            <option>Hospitality</option>
                            <option>Insurance</option>
                            <option>Information Technology</option>
                            <option>Lifestyle</option>
                            <option>Mail Order Services</option>
                            <option>Manufacturing</option>
                            <option>Pharmaceutical</option>
                            <option>Media</option>
                            <option>Professional services</option>
                            <option>Publishing</option>
                            <option>Real Estate</option>
                            <option>Recreation</option>
                            <option>Rentals</option>
                            <option>Retail</option>
                            <option>Software Development</option>
                            <option>Technology</option>
                            <option>Travel and Tours</option>
                            <option>Utility services</option>
                            <option>Web Services</option>
                            <option>Wholesale</option>
                        </select>
                    </div>
                    <div id="filter-buttons">
                        <button id="industry-button" class="btn btn-primary">Show Graph</button>
                    </div>
                </div>
                <div id="filter-container">
                    <div id="filter-labels">
                        <b>Sort By Country:</b>
                    </div>
                    <div id="filter-dropdown">
                        <select id="country-dropdown" class="form-control">
                            <option>Afghanistan</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                            <option>Andorra</option>
                            <option>Angola</option>
                            <option>Antigua and Barbuda</option>
                            <option>Argentina</option>
                            <option>Armenia</option>
                            <option>Aruba</option>
                            <option>Australia</option>
                            <option>Austria</option>
                            <option>Azerbaijan</option>
                            <option>Bahamas</option>
                            <option>Bahrain</option>
                            <option>Bangladesh</option>
                            <option>Barbados</option>
                            <option>Belarus</option>
                            <option>Belgium</option>
                            <option>Belize</option>
                            <option>Benin</option>
                            <option>Bhutan</option>
                            <option>Bolivia</option>
                            <option>Bosnia and Herzegovina</option>
                            <option>Botswana</option>
                            <option>Brazil</option>
                            <option>Brunei</option>
                            <option>Bulgaria</option>
                            <option>Burkina Faso</option>
                            <option>Burma</option>
                            <option>Burundi</option>
                            <option>Cambodia</option>
                            <option>Cameroon</option>
                            <option>Canada</option>
                            <option>Cape Verde</option>
                            <option>Central African Republic</option>
                            <option>Chad</option>
                            <option>Chile</option>
                            <option>China</option>
                            <option>Colombia</option>
                            <option>Comoros</option>
                            <option>Congo</option>
                            <option>Costa Rica</option>
                            <option>Cote d'Ivoire</option>
                            <option>Croatia</option>
                            <option>Cuba</option>
                            <option>Curacao</option>
                            <option>Cyprus</option>
                            <option>Czech Republic</option>
                            <option>Denmark</option>
                            <option>Dominica</option>
                            <option>Dominican Republic</option>
                            <option>East Timor</option>
                            <option>Ecuador</option>
                            <option>Egypt</option>
                            <option>El Salvador</option>
                            <option>Equatorial Guinea</option>
                            <option>Eritrea</option>
                            <option>Estonia</option>
                            <option>Ethiopia</option>
                            <option>Fiji</option>
                            <option>Finland</option>
                            <option>France</option>
                            <option>Gabon</option>
                            <option>Gambia</option>
                            <option>Georgia</option>
                            <option>Germany</option>
                            <option>Ghana</option>
                            <option>Greece</option>
                            <option>Grenada</option>
                            <option>Guatemala</option>
                            <option>Guinea</option>
                            <option>Guinea-Bissau</option>
                            <option>Guyana</option>
                            <option>Haiti</option>
                            <option>Holy See</option>
                            <option>Honduras</option>
                            <option>Hong Kong</option>
                            <option>Hungary</option>
                            <option>Iceland</option>
                            <option>India</option>
                            <option>Indonesia</option>
                            <option>Iran</option>
                            <option>Iraq</option>
                            <option>Ireland</option>
                            <option>Israel</option>
                            <option>Italy</option>
                            <option>Jamaica</option>
                            <option>Japan</option>
                            <option>Jordan</option>
                            <option>Kazakhstan</option>
                            <option>Kenya</option>
                            <option>Kiribati</option>
                            <option>Kosovo</option>
                            <option>Kuwait</option>
                            <option>Kyrgyzstan</option>
                            <option>Laos</option>
                            <option>Latvia</option>
                            <option>Lebanon</option>
                            <option>Lesotho</option>
                            <option>Liberia</option>
                            <option>Libya</option>
                            <option>Liechtenstein</option>
                            <option>Lithuania</option>
                            <option>Luxembourg</option>
                            <option>Macau</option>
                            <option>Macedonia</option>
                            <option>Madagascar</option>
                            <option>Malawi</option>
                            <option>Malaysia</option>
                            <option>Maldives</option>
                            <option>Mali</option>
                            <option>Malta</option>
                            <option>Marshall Islands</option>
                            <option>Mauritania</option>
                            <option>Mauritius</option>
                            <option>Mexico</option>
                            <option>Micronesia</option>
                            <option>Moldova</option>
                            <option>Monaco</option>
                            <option>Mongolia</option>
                            <option>Montenegro</option>
                            <option>Morocco</option>
                            <option>Mozambique</option>
                            <option>Namibia</option>
                            <option>Nauru</option>
                            <option>Nepal</option>
                            <option>Netherlands</option>
                            <option>Netherlands Antilles</option>
                            <option>New Zealand</option>
                            <option>Nicaragua</option>
                            <option>Niger</option>
                            <option>Nigeria</option>
                            <option>North Korea</option>
                            <option>Norway</option>
                            <option>Oman</option>
                            <option>Pakistan</option>
                            <option>Palau</option>
                            <option>Panama</option>
                            <option>Papua New Guinea</option>
                            <option>Paraguay</option>
                            <option>Peru</option>
                            <option>Philippines</option>
                            <option>Poland</option>
                            <option>Portugal</option>
                            <option>Qatar</option>
                            <option>Romania</option>
                            <option>Russia</option>
                            <option>Rwanda</option>
                            <option>Saint Kitts and Nevis</option>
                            <option>Saint Lucia</option>
                            <option>Saint Vincent and the Grenadines</option>
                            <option>Samoa</option>
                            <option>San Marino</option>
                            <option>Sao Tome and Principe</option>
                            <option>Saudi Arabia</option>
                            <option>Senegal</option>
                            <option>Serbia</option>
                            <option>Seychelles</option>
                            <option>Sierra Leone</option>
                            <option>Singapore</option>
                            <option>Sint Maarten</option>
                            <option>Slovakia</option>
                            <option>Slovenia</option>
                            <option>Solomon Islands</option>
                            <option>Somalia</option>
                            <option>South Africa</option>
                            <option>South Korea</option>
                            <option>South Sudan</option>
                            <option>Spain</option>
                            <option>Sri Lanka</option>
                            <option>Sudan</option>
                            <option>Suriname</option>
                            <option>Swaziland</option>
                            <option>Sweden</option>
                            <option>Switzerland</option>
                            <option>Syria</option>
                            <option>Taiwan</option>
                            <option>Tajikistan</option>
                            <option>Tanzania</option>
                            <option>Thailand</option>
                            <option>Timor-Leste</option>
                            <option>Togo</option>
                            <option>Tonga</option>
                            <option>Trinidad and Tobago</option>
                            <option>Tunisia</option>
                            <option>Turkey</option>
                            <option>Turkmenistan</option>
                            <option>Tuvalu</option>
                            <option>Uganda</option>
                            <option>Ukraine</option>
                            <option>United Arab Emirates</option>
                            <option>United Kingdom</option>
                            <option>Uruguay</option>
                            <option>Uzbekistan</option>
                            <option>Vanuatu</option>
                            <option>Venezuela</option>
                            <option>Vietnam</option>
                            <option>Yemen</option>
                            <option>Zambia</option>
                            <option>Zimbabwe</option>
                        </select>
                    </div>
                    <div id="filter-buttons">
                        <button id="country-button" class="btn btn-primary">Show Graph</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="/js/admin/business_numbers.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
@stop