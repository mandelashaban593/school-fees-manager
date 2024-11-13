 <div class="modal fade" id="large-Modal-adduser" tabindex="-1"
role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
     <form id="register-user-Form">
    <div class="modal-header">
        <h4 class="modal-title text-center">Add New User</h4>
        <button type="button" class="close"
            data-dismiss="modal"
            aria-label="Close">
            <span
                aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
              
              
        <div class="col-md-12">
            <div class="text-center" id="register-user-message">
            </div>
            <div class="row">
              
         <div class="col-md-6">
            <div class="form-group">
                <label>User Role</label>
                <select class="form-control" id="userType" name="userType">
                    <option value="">--select role--</option>
                    <option value="Secretary">Secretary</option>
        
                </select>
            </div>
            </div>


         <div class="col-md-6">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="user_fulname" id="user_fulname" class="form-control" placeholder="Enter Fulname">
            </div>
            </div>
              <div class="col-md-6">
            <div class="form-group">
                <label>Email address</label>
                <input type="text" name="user_email" id="user_email" class="form-control" placeholder="Enter Email Address">
               
            </div>
            </div>
         
           <div class="col-md-6">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="user_username" id="user_username" class="form-control" placeholder="Enter Username">
               
            </div>
            </div>

             <div class="col-md-6">
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter User Password">
               
            </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="user_confirm_password" id="user_confirm_password" class="form-control" placeholder="Enter Confirm Password">
               
            </div>
            </div>
             
               </div>
                </div>
    </div>
    <div class="modal-footer">
         <button type="reset"
            class="btn btn-danger waves-effect">Reset</button>
        <button type="button"
            class="btn btn-default waves-effect "
            data-dismiss="modal">Close</button>
        <button type="submit"
            class="btn btn-success btn-outline-success waves-effect waves-light btn-rounded" name="submit-new-user" id="submit-new-user" value="submit-new-user">Submit New User</button>
    </div>
     </form>
</div>
</div>
</div>