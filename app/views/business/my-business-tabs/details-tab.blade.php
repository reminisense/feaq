    <div class="clearfix header">
        <h5 class="col-md-12">BUSINESS DETAILS</h5>
    </div>
    <div class="col-md-6">
        <p class="title">Business Name</p>
        <input type="text" class=" form-control" value="@{{ business_name }}" ng-model="business_name">
    </div>
    <div class="col-md-6">
        <p class="title">Business Address</p>
        <input type="text" class="form-control" value="@{{ business_address }}" ng-model="business_address" ng-autocomplete options="options" details="details">
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-12">
                    <p class="title">Industry</p>
                    <div class="btn-group">
                        <select class="form-control" ng-model="industry" name="industry" id="industry">
                            <option value="@{{ industry }}">@{{ industry }}</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Advertising">Advertising</option>
                            <option value="Agriculture">Agriculture</option>
                            <option value="Air Services">Air Services</option>
                            <option value="Airlines">Airlines</option>
                            <option value="Apparel">Apparel</option>
                            <option value="Appliances">Appliances</option>
                            <option value="Auto Dealership">Auto Dealership</option>
                            <option value="Banking">Banking</option>
                            <option value="Broadcasting">Broadcasting</option>
                            <option value="Business Services">Business Services</option>
                            <option value="Communications">Communications</option>
                            <option value="Corporate">Corporate</option>
                            <option value="Customer Service">Customer Service</option>
                            <option value="Delivery">Delivery</option>
                            <option value="Delivery Services">Delivery Services</option>
                            <option value="Education">Education</option>
                            <option value="Energy">Energy</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Events">Events</option>
                            <option value="Food and Beverage">Food and Beverage</option>
                            <option value="Government">Government</option>
                            <option value="Grocery">Grocery</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Hobbies and Collections">Hobbies and Collections</option>
                            <option value="Hospitality">Hospitality</option>
                            <option value="Insurance">Insurance</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Lifestyle">Lifestyle</option>
                            <option value="Mail Order Services">Mail Order Services</option>
                            <option value="Manufacturing">Manufacturing</option>
                            <option value="Pharmaceutical">Pharmaceutical</option>
                            <option value="Media">Media</option>
                            <option value="Professional Services">Professional Services</option>
                            <option value="Publishing">Publishing</option>
                            <option value="Real Estate">Real Estate</option>
                            <option value="Recreation">Recreation</option>
                            <option value="Rentals">Rentals</option>
                            <option value="Retail">Retail</option>
                            <option value="Software Development">Software Development</option>
                            <option value="Technology">Technology</option>
                            <option value="Travel and Tours">Travel and Tours</option>
                            <option value="Utility Services">Utility Services</option>
                            <option value="Web Services">Web Services</option>
                            <option value="Wholesale">Wholesale</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-12">
                    <p class="title">Timezone</p>
                    <select class="form-control" name="timezone" id="timezone" ng-model="timezone"> <!-- ARA Added timezone picker -->
                        @foreach(Helper::getTimezoneList() as $index => $timezone)
                            <option value="{{ $index }}">{{ $timezone }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <p class="title">Time Open</p>
                    <input type="text" class="form-control" value="@{{ time_open }}" ng-model="time_open"> <!-- RDH  Added timepicker -->
                </div>
                <div class="col-md-6">
                    <p class="title">Time Close</p>
                    <input type="text" class="form-control" value="@{{ time_closed }}" ng-model="time_closed"> <!-- RDH  Added timepicker -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 hidden">
        <p class="title">Facebook URL</p>
        <input type="text" class=" form-control" value="@{{ facebook_url }}" placeholder="Add Your Facebook Page!" ng-model="facebook_url">
    </div>
    <div class="col-md-12  mt20">
        <div class="pull-right">
            <button type="button" id="delete_business" class="btn btn-primary btn-lg" ng-click="deleteBusiness(business_id)"><span class="glyphicon glyphicon-trash"></span> Delete Business</button>
            <button type="button" id="edit_business" class="btn btn-orange btn-lg" ng-click="saveBusinessDetails()"><span class="glyphicon glyphicon-check"></span> SAVE </button>
        </div>
    </div>


