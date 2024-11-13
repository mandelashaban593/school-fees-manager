<div class="modal fade" id="large-Modal-payment" tabindex="-1"
role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
     <form>
    <div class="modal-header">
        <h4 class="modal-title"> New Payment Entry</h4>
        <button type="button" class="close"
            data-dismiss="modal"
            aria-label="Close">
            <span
                aria-hidden="true">&times;</span>
        </button> 
    </div>
    <div class="modal-body">
        <div id="myserverResponse" class="text-center mb-3"></div>
            <div class="col-md-12">
             <div class="row">
         <div class="col-md-6">
             <input type="hidden" id="student_id_p">
            <div class="form-group">
                <label>Admission No</label>
                <input type="text" id="admission_no_p" class="form-control" disabled>
            </div>
            </div>
         <div class="col-md-6">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="fulname_p" class="form-control" disabled>
            </div>
            </div>

         <div class="col-md-6">
            <div class="form-group">
                <label> Payee Current Class</label>
                <input type="text" id="admitted_class_p" class="form-control" disabled>
            </div>
            </div>

             <div class="col-md-6">
            <div class="form-group">
                <label> Termly Payment Amount</label>
                <input type="text" id="termly_payment_amount_p" class="form-control" disabled>
            </div>
            </div>

             <div class="col-md-6">
            <div class="form-group">
                <label>Payment Session</label>
                <input class="form-control" type="text" id="payment_sessionp" value="<?php echo fetchSchoolSession();?>" disabled>
            </div>
            </div>
             <div class="col-md-6">
            <div class="form-group">
                <label>Payment Term</label>
                <select class="form-control" id="payment_termp">
                    <option value="">--select--</option>
                    <option value="First Term">First Term</option>
                    <option value="Second Term">Second Term</option>
                    <option value="Third Term">Third Term</option>
                </select>
            </div>
            </div>

              <div class="col-md-6">
            <div class="form-group">
                <label>Amount to Pay</label>
                <input type="text" id="payment_amountp" class="form-control form-control-success" placeholder="Amount to Pay">
            </div>
            </div>
              <div class="col-md-6">
            <div class="form-group">
                <label>Payment Method</label>
                <select class="form-control" id="payment_methodp">
                    <option value="">--select--</option>
                    <option value="Cash">Cash Payment</option>
                    <option value="Bank">Bank Transfer</option>
                    
                </select>
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
            class="btn btn-primary waves-effect waves-light" id="savePaymentBtn" value="submit">Save
            changes</button>
    </div>
     </form>
</div>
</div>
</div>