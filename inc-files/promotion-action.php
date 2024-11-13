<?php
date_default_timezone_set("Africa/Lagos");
require_once ("dbconn.php");
require_once "functions.php";
$school_session = fetchSchoolSession();
$current_active_term = fetchSchoolTerm();
$udate = date("Y-m-d");
$response ="";
if (isset($_POST['submit_promotion']) && $_POST['submit_promotion'] ==="promote") {
	$student_hidden_id = clean_input($_POST['student_hidden_id']);
	$new_school_fee = clean_input($_POST['new_school_fee']);
	$promoted_to = clean_input($_POST['promoted_to']);
	$current_class = clean_input($_POST['current_class']);
	if (empty($new_school_fee) || empty($promoted_to)) {
	# code...
         $response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>INVALID FORM SUBMISSION!</strong> Please fill all the REQUIRED Fields. <b class="text-info"> <span> Then try to resubmit again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	}elseif (!is_numeric($new_school_fee)) {
	 $response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>INVALID FEE FORMAT!</strong> Fee Format is NOT SUPPORTED. <b class="text-info"> <span> Check Your input and try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	}elseif ($promoted_to === $current_class) {
		$response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>INVALID PROMOTION!</strong> Student cannot be Promoted to the Same Class. <b class="text-info"> <span> Please select another Class</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	}elseif ($current_active_term !=="Third Term") {
    # code...
    	$response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong> PROMOTION ERROR!</strong> Student Can Only be PROMOTED in THIRD TERM . <b class="text-info"> <span> Current Term is '.$current_active_term.'</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
  }
  else{
    //check if the session is the same as the last student payment sesion column of individual_fee
    $check_sec = $dbh->prepare("SELECT * FROM individual_fee WHERE school_session=? AND student_class=? AND student_id=? LIMIT 1");
    $check_sec->execute(array($school_session,$current_class,$student_hidden_id));
    if ($check_sec->rowCount()>0) {
      # code...
      	$response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong> SESSION ERROR!</strong> New Session is Required to Promote and Set Student School fee . <b class="text-info"> <span> Declare New Session and Try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }else{

      //let promote the student 
$query =$dbh->prepare("UPDATE students SET admitted_class=? WHERE student_id=?");
if($query->execute(array($promoted_to,$student_hidden_id))){
    //create new payment row for this student on individual fee table 
    $update = $dbh->prepare("INSERT INTO individual_fee(student_id,amount_per_term,student_class,school_session,created_at) VALUES (?,?,?,?,?);");
    if ($update->execute(array($student_hidden_id,$new_school_fee,$promoted_to,$school_session,$udate))) {
       
    $response ='<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong> Congratulations!</strong> Selected Student has been Promoted to <b class="text-info">'.$promoted_to.'</b> Successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<script>
 setTimeout(()=>{
    $("#large-Modal-promotion").modal("hide");
 },4000);
</script>';
    }else{
  $response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>INTERNAL SERVER ERROR!</strong> Something went wrong please try again later...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
}else{
$response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>INTERNAL SERVER ERROR!</strong> Promotion Failed <b class="text-info">Please try again later...</b> 
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