
<div class="modal fade" id="large-Modal-offer-admission" tabindex="-1"
role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
     <form>
         <div class="text-center" id="serverRes"></div>
    <div class="modal-header">
        <h4 class="modal-title">Fee Structure Form</h4>
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
        <input type="hidden" id="student_idv">
         <div class="col-md-6">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" id="fulnamev" class="form-control" disabled>
            </div>
            </div>
             <div class="col-md-6">
            <div class="form-group">
                <label for="admission_nov">Admission No</label>
                <input type="text" id="admission_nov" class="form-control" disabled>
            </div>
            </div>
         <div class="col-md-6">
            <div class="form-group">
                <label>Admitted Into</label>
                 <input type="text" id="admitted_classv" disabled class="form-control">
            </div>
            </div>
           <div class="col-md-6">
            <div class="form-group">
                <label>Admission Date</label>
               <input type="text" class="form-control date-control" id="admission_datev" disabled>
            </div>
            </div>

              <div class="col-md-6">
            <div class="form-group">
                <label>School Session</label>
                <input class="form-control" type="text" id="payment_sessionx" value="<?php echo fetchSchoolSession();?>" disabled>
            </div>
            </div>
              <div class="col-md-6">
            <div class="form-group">
                <label>Enter Fee Amount</label>
                <input type="number" id="school_feev" class="form-control form-control-success" placeholder="UGX 50000.00">
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
            class="btn btn-success waves-effect waves-light" id="setPaymentBtnUpdate">Submit 
            Fee</button>
    </div>
    </form>
</div>
</div>
</div>