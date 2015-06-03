<!-- modal -->
<div class="modal fade" id="updateUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel">Update Your Profile</h3>
            </div>
            <div class="modal-body">
                <form id="update_user_form" class="clearfix" action="/user/update-user" method="post">
                    <input type="hidden" class="user_id" name="user_id" value="" />
                    <div class="form-group">
                        <div class="col-md-6 has-warning">
                            <label>First Name</label>
                            <input type="text" class=" form-control modal-input" id="edit_first_name" name="edit_first_name" required />
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" class=" form-control modal-input" id="edit_last_name" name="edit_last_name" required />
                        </div>
                        <div class="col-md-6 mb20">
                            <label>Mobile</label><br/>
                            <input style="padding-left: 45px;" type="" min="9" maxlength="15" class=" form-control modal-input" id="edit_mobile" name="edit_mobile" required/>
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <span class=" form-control modal-input" id="edit_email"></span>
                        </div>
                        <div class="col-md-12">
                            <label>Location</label>
                            <input type="text" class=" form-control modal-input" id="edit_user_location" name="edit_user_location" autocomplete="off" required=""/>
                        </div>
                    </div>
                </form>
                 <div class="alert alert-success modal-message" id="profile_update_message" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <button id="update_profile_button" type="submit" class="btn btn-orange btn-md">Update Profile</button>
            </div>
        </div>
    </div>
</div>