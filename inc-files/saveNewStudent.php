<?php 
date_default_timezone_set("Africa/Lagos");
error_reporting(1);
$response ="";
if (isset($_POST['submit'])) {
    //student data 
     require_once ("functions.php");
    $sname = clean_input($_POST['surname']);
    $fname = clean_input($_POST['firstname']);
    $lname = clean_input($_POST['lastname']);
    $sex = clean_input($_POST['gender']);
    $dob = clean_input($_POST['dob']);
    $birthPlace =  clean_input($_POST['place_of_birth']);
    $nationality = clean_input($_POST['nationality']);
    $state = clean_input($_POST['state_of_origin']);
    $local_gvt = clean_input($_POST['local_gvt']);
    $proposed_class = clean_input($_POST['proposed_class']);
    //PREVIOUS SCHOOL DATA 
    $schoolName = clean_input($_POST['school_name']);
    $schoolAddress = clean_input($_POST['school_address']);
    $last_class = clean_input($_POST['last_class']);
    $reason = clean_input($_POST['reason']);
    // MEDICAL HISTORY DATA 
    $genotype = clean_input($_POST['genotype']);
    $bloodGroup = clean_input($_POST['blood_group']);
    $sickness = clean_input($_POST['sickness']);
    $clinic = clean_input($_POST['clinic']);
    $clinic_phone = clean_input($_POST['clinic_phone']);
    $clinic_address = clean_input($_POST['clinic_address']);
    //PARENTS AND GUARDIAN DAta
    $parent_name = clean_input($_POST['parent_name']);
    $parent_phone = clean_input($_POST['parent_phone']);
    $parent_address = clean_input($_POST['parent_address']);
    $parent_work = clean_input($_POST['parent_occupation']);
    $postion_at_wrk = clean_input($_POST['postion_at_work']);
    $parent_wrk_address = clean_input($_POST['parent_wrk_address']);
   
    if (empty($sname)||empty($fname)||empty($lname)||empty($sex)||empty($dob)||empty($birthPlace)||empty($nationality)||empty($state)||empty($proposed_class)||empty($schoolName)||empty($schoolAddress)||empty($last_class)||empty($reason)||empty($genotype)||empty($bloodGroup)||empty($sickness)||empty($clinic)||empty($parent_name)||empty($parent_phone)||empty($parent_address)) {
        # code...
      $response = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Invalid Submission!</strong> All input fields are Required!.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }else{
        // check for duplicate in student name 
        require_once ("dbconn.php");
        $check = $dbh->prepare("SELECT * FROM students WHERE sname=? AND fname=? AND lname=? AND dob=?");
        $check->execute(array($sname,$fname,$lname,$dob));
        if ($check->rowCount()>0) {
        # code...
$response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Error!</strong> This Student data already saved.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
        }else{
            
    try {
     $dbh->beginTransaction();
            // lets save the student details
    $stmtQuery =$dbh->prepare("INSERT INTO students (sname,fname,lname,gender,dob,state,local_gvt,preClass,created_at) VALUES (?,?,?,?,?,?,?,?,?);");
    $dateReg = date("Y-m-d");
if ($stmtQuery->execute(array($sname,$fname,$lname,$sex,$dob,$state,$local_gvt,$last_class,$dateReg))) {
$lastId = $dbh->lastInsertId();
    //create student info table
     $inforData = $dbh->prepare("INSERT INTO student_info (pre_school_name,pre_schl_address,place_of_birth,nationality,reason,genotype,blood_group,usual_sickness,hospital,hospital_phone,hospital_address,parent_name,parent_number,parent_address,parent_occupation,position_at_work,student_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
    if($inforData->execute(array($schoolName,$schoolAddress,$birthPlace,$nationality,$reason,$genotype,$bloodGroup,$sickness,$clinic,$clinic_phone,$clinic_address,$parent_name,$parent_phone,$parent_address,$parent_work,$postion_at_wrk, $lastId))){
        $dbh->commit();
$response ='<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congratulations! </strong> '.$sname.' '.$fname.' has been Registered Successufully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<script>
 setTimeout(()=>{
     $("#student-signup-form")[0].reset();
 },2000)
</script>
';
  }else{
$response = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>SERVER ERROR !</strong>'.$sname.' '.$fname.' Could not be Registered Please try again...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
 } 
 }else{
$response ='<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Something Went Wrong !</strong>'.$sname.' '.$fname.' Could not be Registered due to Internal Error... Try Resubmit
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
            }
    } catch (PDOException $e) {
       if ($dbh->inTransaction()) {
           $dbh->rollBack();
       }
    }
           
        }
       
    }
echo $response;
    unset($dbh);
}
