<div class="modal fade" id="setupBusiness" tabindex="-1">
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
                        <div class="col-md-12">
                            <input type="text" class=" form-control" placeholder="Business Name" id="business_name" name="business_name">
                        </div>
                        <div class="col-md-12">
                            <input type="text" class=" form-control" placeholder="Business Address" id="business_location" name="business_address">
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" id="time_open" name="time_open" placeholder="Time Open" class="timepicker form-control" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" id="time_close" name="time_close" placeholder="Time Close" class="timepicker form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group">
                                <select class="form-control" name="industry" id="industry">
                                    <option value="">Select Industry</option>
                                    <option value="Pharmaceutical">Pharmaceutical</option>
                                    <option value="Education">Education</option>
                                    <option value="Medical">Medical</option>
                                    <option value="Customer Service">Customer Service</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mt10">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class=" form-control" placeholder="Queue Number Limit" id="queue_limit" name="queue_limit">
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" name="num_terminals" id="num_terminals">
                                        <option value="">Select Number of Terminals</option>
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
                <a id="skip_step_link" class="orange" style="margin-right: 140px;" href="/">Setup Business Later</a>
                <button id="submit_business" type="button" class="btn btn-orange btn-lg">SUBMIT</button>
            </div>
        </div>
    </div>
</div>
<!--eo modal-->