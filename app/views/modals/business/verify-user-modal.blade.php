<!-- modal -->
<div class="modal fade" id="verifyUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Please confirm your data</h3>
            </div>
            <div class="modal-body">
                <form id="verification_form" action="/user/verify-user" method="post">
                    <input type="hidden" class="user_id" name="user_id" value="" />
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 has-warning">
                                    <small>First Name</small>
                                    <input type="text" class=" form-control" id="first_name" name="first_name" required />
                                </div>
                                <div class="col-md-6">
                                    <small>Last Name</small>
                                    <input type="text" class=" form-control" id="last_name" name="last_name" required />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <small>Email</small>
                            <input type="email" class=" form-control" id="email" name="email" required />
                        </div>
                        <div class="col-md-12">
                            <small>Mobile</small>
                            <input type="tel" class=" form-control" id="mobile" name="mobile" required/>
                        </div>
                        <div class="col-md-12" style="margin-top: 20px;">
                            <small>Location</small>
                            <input type="text" class=" form-control" id="user_location" name="location" autocomplete="off" required=""/>
                        </div>
                    </div>
                </form>
                <div class="alert alert-danger" id="verifyError" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <button id="start_queuing" type="submit" class="btn btn-orange btn-lg">Start Queuing</button>
            </div>
        </div>
    </div>
</div>