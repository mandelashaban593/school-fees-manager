<div class="modal fade" id="large-Modal-Update-Fee-form" tabindex="-1"
role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
    <div id="updateResponse" class="text-center">
        
    </div>
    <form>
    <div class="modal-header">
        <h4 class="modal-title">Change <span id="student_title" class="text-info"></span> School fee</h4>
        <button type="button" class="close"
            data-dismiss="modal"
            aria-label="Close">
            <span
                aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-md-12">
        <div class="row">
            <input type="hidden" id="stu_id">
         <div class="col-md-6">
            <div class="form-group">
                <label>Current School Fee</label>
                <input type="text" id="old_fee" class="form-control" disabled>
            </div>
            </div>
         <div class="col-md-6">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="fulname" class="form-control" disabled>
            </div>
            </div>
              <div class="col-md-6">
            <div class="form-group">
                <label>Fee Session</label>
                <input type="text" id="payment_session" class="form-control" disabled>
            </div>
            </div>
              <div class="col-md-6">
            <div class="form-group">
                <label>Fee Term</label>
                <input type="text" id="payment_term" class="form-control" disabled>
            </div>
            </div>
         <div class="col-md-6">
            <div class="form-group">
                <label>Current Class</label>
                <input type="text" class="form-control" disabled id="student_class">
            </div>
            </div>
              <div class="col-md-6">
            <div class="form-group">
                <label>Change Fee Structure</label>
                <input type="text" id="new_fee" class="form-control form-control-success" placeholder="Enter New Amount">
            </div>
            </div>
               </div>
                </div>
       
    </div>
    <div class="modal-footer">
        <button type="button"
            class="btn btn-default waves-effect "
            data-dismiss="modal">Close</button>
        <button type="button"
            class="btn btn-primary waves-effect waves-light update_fee_btn">Save
            changes</button>
    </div>
    </form>
</div>
</div>
</div>