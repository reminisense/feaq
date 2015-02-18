<div class="modal fade" id="setupBusiness" tabindex="-1" style="overflow: auto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="add_business_cloase" style="display: none;"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="add_business_header">Setup your Business</h3>
            </div>
            <div class="modal-body">
                <form id="add_business_form" class="" action="business/setup-business" method="post">
                    <input type="hidden" class="user_id" name="user_id" value="" />
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Business Name</label>
                            <input type="text" class=" form-control" placeholder="ex: ABC Company" id="business_name" name="business_name">
                        </div>
                        <div class="col-md-6">
                            <label>Business Address</label>
                            <input type="text" class=" form-control" placeholder="ex: Cebu City" id="business_location" name="business_address">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Time Open</label>
                                    <input type="text" id="time_open" name="time_open" placeholder="ex: 8:00am" class="timepicker form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label>Time Close</label>
                                    <input type="text" id="time_close" name="time_close" placeholder="ex: 10:00pm" class="timepicker form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Industry</label>
                            <div class="btn-group">
                                <select class="form-control" name="industry" id="industry">
                                    <option value="0">-Select Industry-</option>
                                    <option value="Accounting and Finance">Accounting and Finance</option>
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
                                    <option value="Communications Technology">Communications Technology</option>
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
                                    <option value="Photography, Videography, and Media">Photography, Videography, and Media</option>
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
                        <div class="col-md-12 mt10">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Queue Number Limit</label>
                                    <input type="text" class=" form-control" placeholder="ex: 300" id="queue_limit" name="queue_limit">
                                </div>
                                <div class="col-md-6">
                                    <label>No of Terminals</label>
                                    <select class="form-control" name="num_terminals" id="num_terminals">
                                        <option value="">-Select-</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="alert alert-danger" id="setupError" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <a id="skip_step_link" href="/" class="btn btn-cyan btn-lg">Setup Business Later</a>
                <button id="submit_business" style="width:175px;" type="button" class="btn btn-orange btn-lg">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->