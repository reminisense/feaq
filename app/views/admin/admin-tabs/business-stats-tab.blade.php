<div class="container" id="date-container">
    <div class="col-md-4"></div>
    <div class="col-md-6">
        <input type="text" id="start-date" name="start-date" class="datepicker"/><b>-</b>
        <input type="text" id="end-date" name="end-date" class="datepicker"/>
    </div>
    <div class="col-md-2"></div>
</div>
<div class="container">
<div class="col-md-4 table-container">
    <table id="business-table" class="table-bordered table-responsive table">
        <tr>
            <th class="text-center" id="business-label" colspan="2">Business Numbers</th>
        </tr>
        <tr>
            <td id="business-numbers-label" width="50%">New Businesses</td>
            <td id="business-numbers"><b>@{{ new_business }}</b></td>
        </tr>
        <tr>
            <td id="user-numbers-label">New Users</td>
            <td id="user-numbers"><b>@{{ new_users }}</b></td>
        </tr>
        <tr>
            <td id="issued-numbers-label">Issued Numbers</td>
            <td id="issued-numbers"><b>@{{ issued_numbers }}</b></td>
        </tr>
        <tr>
            <td id="called-numbers-label">Called Numbers</td>
            <td id="called-numbers"><b>@{{ called_numbers }}</b></td>
        </tr>
        <tr>
            <td id="served-numbers-label">Served Numbers</td>
            <td id="served-numbers"><b>@{{ served_numbers }}</b></td>
        </tr>
        <tr>
            <td id="dropped-numbers-label">Dropped Numbers</td>
            <td id="dropped-numbers"><b>@{{ dropped_numbers }}</b></td>
        </tr>
    </table>
    <div id="btn-container">
        <button class="btn btn-primary" id="btn-submit-numbers" ng-click="loadBusinessNumbers()">View Numbers</button>
    </div>
</div>
<div class="col-md-8 container">
<div class="cold-md-12">
    <div>
        <div id="graphs-container">
            <ul id="graph-nav" class="nav nav-tabs">
                <li class="active"><a href="#issued-container" data-toggle="tab">Issued</a></li>
                <li><a href="#called-container" data-toggle="tab">Called</a></li>
                <li><a href="#served-container" data-toggle="tab">Served</a></li>
                <li><a href="#dropped-container" data-toggle="tab">Dropped</a></li>
            </ul>
            <div class="clearfix tab-content">
                <div id="issued-container" class="tab-pane fade active in table-bordered">
                    <div id="lineIssuedChart"></div>
                    <div id="advanced-container">
                        <div id="label-container"><b>Advanced Searches:</b></div>
                        <label><input id="issued-checkbox" type="checkbox" ng-model="checked" ng-change="issuedData()"> Issued Numbers with Data</label>
                    </div>
                </div>
                <div id="called-container" class="tab-pane fade in table-bordered">
                    <div id="lineCalledChart"></div>
                </div>
                <div id="served-container" class="tab-pane fade in table-bordered">
                    <div id="lineServedChart"></div>
                </div>
                <div id="dropped-container" class="tab-pane fade in table-bordered">
                    <div id="lineDroppedChart"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="filter-container" class="col-md-4">
    <div id="filter-labels">
        <b>Sort By Business:</b>
    </div>
    <div id="filter-dropdown">
        <select id="business-dropdown" class="form-control"></select>
    </div>
    <div id="filter-buttons">
        <button id="business-button" class="btn btn-primary" ng-click="loadGraph('business')">Show Graph</button>
    </div>
</div>
<div id="industry-filter-container"  class="col-md-4">
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
        <button id="industry-button" class="btn btn-primary" ng-click="loadGraph('industry')">Show Graph</button>
    </div>
</div>
<div id="filter-container" class="col-md-4">
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
    <button id="country-button" class="btn btn-primary" ng-click="loadGraph('country')">Show Graph</button>
</div>
</div>
</div>
</div>