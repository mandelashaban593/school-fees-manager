  <div class="modal fade" id="large-Modal-edit-Users" tabindex="-1"
role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
    
    <form>
    <div class="modal-header">
        <h4 class="modal-title text-center">EDIT USER DETAILS</h4>
    </div>
    
    <div class="modal-body">
            <div class="col-md-12">

            <div class="text-center" id="serverText">
        </div>
            <div class="row">
                <input type="hidden" id="user_hidden_id">
              
         <div class="col-md-6">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="user_fulname" class="form-control" disabled>
            </div>
            </div>

         <div class="col-md-6">
            <div class="form-group">
                <label>Role</label>
                <input type="text" class="form-control" id="user_role" disabled>
            </div>
            </div>
             <div class="col-md-6">
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="email_user" disabled>
            </div>
            </div>
             <div class="col-md-6">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" id="account_username" disabled>
            </div>
            </div>
            <hr>
           
             <div class="col-md-6">
            <div class="form-group">
                <label>Enter Old Password</label>
                <input type="text" id="old_password" class="form-control form-control-success" placeholder="Your Old Password" disabled>
            </div>
            </div>
              <div class="col-md-6">
            <div class="form-group">
                <label>Create New Password</label>
                <input type="text" id="c_new_password" class="form-control form-control-success" placeholder="Enter New Password" disabled>
            </div>
            </div>
               </div>
                </div>
    </div>
    <div class="modal-footer">
        <button type="button"
            class="btn btn-danger waves-effect "
            data-dismiss="modal">Close</button>
        <button type="button"
            class="btn btn-warning waves-effect waves-light updatemeBtn" id="submit-updateMe" value="updateMe"> Update Details
            </button>
    </div>
    </form>
</div>
</div>
</div>