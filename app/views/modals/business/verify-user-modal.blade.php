<!-- modal -->
<div class="modal fade" id="verifyUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Please confirm your data</h3>
            </div>
            <div class="modal-body">
                <form id="verification_form" class="clearfix" action="/user/verify-user" method="post">
                    <input type="hidden" class="user_id" name="user_id" value="" />
                    <div class="form-group">
                        <div class="col-md-6 has-warning">
                            <label>First Name</label>
                            <input type="text" class=" form-control" id="first_name" name="first_name" required />
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" class=" form-control" id="last_name" name="last_name" required />
                        </div>
                        <div class="col-md-12">
                            <label>Email <small>(We will only make use of your Facebook email)</small></label>
                            <input type="email" class=" form-control" id="email" name="email" readonly style="color: #bbb;" />
                        </div>
                        <div class="col-md-12">
                            <label>Mobile</label>
                            <input type="" min="9" maxlength="15" class=" form-control" id="mobile" name="mobile" required/>
                        </div>
                        <div class="col-md-12" style="margin-top: 20px;">
                            <label>Location</label>
                            <input type="text" class=" form-control" id="user_location" name="location" autocomplete="off" required=""/>
                        </div>
                    </div>
                </form>
                <div class="alert alert-danger modal-message" id="verifyError" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <button id="start_queuing" type="submit" class="btn btn-orange btn-lg">START QUEUING</button>
            </div>
        </div>
    </div>
</div>