<?php 
$response ="";
date_default_timezone_set("Africa/Lagos");
require_once "functions.php";
require_once "dbconn.php";
if (isset($_POST['myaction']) && $_POST['myaction'] ==="saveFee") {
    $student_id = clean_input($_POST['stuID']);
    $classroom = clean_input($_POST['classroom']);
    $payment_sessionx = fetchSchoolSession();
    $termlyFee = clean_input($_POST['termlyFee']);
    $created_at = date("Y-m-d");

    if (empty($termlyFee)) {
        # code...
        $response ='<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
  <strong>ERROR EMPTY!</strong> Please Enter the School fee amount.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }elseif (!is_numeric($termlyFee)) {
        $response ='<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
  <strong>INVALID CHARACTER!</strong> Only Numeric character is allowed. Try Again...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    else{
//check for duplicate entry
$check = $dbh->prepare("SELECT * FROM `individual_fee` WHERE student_id=? AND student_class=? AND school_session=? LIMIT 1");
$check->execute(array($student_id,$classroom,$payment_sessionx));
if ($check->rowCount()>0) {
    # code...
     $response ='<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
  <strong> DUPLICATED ENTRY ERROR!</strong> The School Fee For this term is already Created for the selected Student.<b><span class="text-info"> Try Another Term</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}else{
    // save to database 
    $query =$dbh->prepare("INSERT INTO individual_fee (student_id,amount_per_term,student_class,school_session,created_at) VALUES(?,?,?,?,?);");
   if ( $query->execute(array($student_id,$termlyFee,$classroom,$payment_sessionx,$created_at))) {
       # code...
       $response ='<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congratulations! </strong>School Fee Set Up for the Selected Student Successufully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<script>
 setTimeout(() => {
 $("#large-Modal-offer-admission").modal("hide");
    }, 5000);
    self.location.reload();
</script>
';
   }else{
       $response ='<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
  <strong>INTERNAL ERROR!</strong> Something Went Wrong! Please try again...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
   }
}
    }
echo $response;
unset($dbh);
} 