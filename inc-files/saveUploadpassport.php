<?php 
$response ="";
if (isset($_POST['submit'])) {
  require_once ("dbconn.php");
    require_once ("functions.php");
    $student_id = $_POST['hidden_id'];
    $admission_no = clean_input($_POST['admission_no']);
    $admitted_class =  clean_input($_POST['admitted_class']);
    $admitted_date =  clean_input($_POST['admitted_date']);
 $passport_name =  clean_input($_FILES['imageUpload']['name']);
    $size =$_FILES['imageUpload']['size']/1024;
    $tempLoc = $_FILES['imageUpload']['tmp_name'];
    $fileerror = $_FILES['imageUpload']['error'];
    $allowed = array("jpg","jpeg","png");
    $fileExt = explode(".",$passport_name);
    $actualExt = strtolower(end($fileExt));
    if (empty($admission_no) || empty($admitted_class) || empty($admitted_date)) {
        # code...
         $response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>INVALID FORM SUBMISSION!</strong> Please fill all the REQUIRED Fields. Then resubmit
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }else
    //check ext 
    if (! in_array($actualExt,$allowed)) {
        $response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>EXTENSION ERROR!</strong> Only JPG, JPEG and PNG Format is allowed.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }elseif ($size > 100) {
         $response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>IMAGE SIZE ERROR!</strong> Your Image size should be less than 100KB. <b class="text-info"> <small> Detected file Size is '.number_format($size,2).' KB</small></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }elseif ($fileerror !==0) {
        $response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>UPLOAD ERROR!</strong> There was an error Uploading this Passport. <b class="text-info"> <small>Please try again...</small></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }elseif (checkDuplicatedmissionNo($admission_no)) {
     $response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>ADMISSION NO ERROR!</strong> This admission Number already Exists. <b class="text-info"> <small>Please try another One</small></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    else{
//if no error 
    try {
        $dbh->beginTransaction();
        $newFileName = md5(date("Ymdhis").uniqid()).".".$actualExt;
        $destination = "../student-image/".$newFileName;
        $insertQuery = $dbh->prepare("UPDATE students SET admitted_class=?,admission_no=?,admission_date=?, passport=? WHERE student_id=? LIMIT 1");
        $insertQuery->execute(array($admitted_class,$admission_no,$admitted_date,$newFileName,$student_id));
        // move file to path
        if (move_uploaded_file($tempLoc, $destination)) {
            # code...
            $dbh->commit();
            $response ='<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congratulations!</strong> Image uploaded Successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<script>
 setTimeout(()=>{
     $("#upladImage-form")[0].reset();
 },2000);
</script>';
        } else {
            $response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>INTERNAL SERVER ERROR!</strong> Something went wrong please try again later...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
        }
    } catch (PDOException $e) {
        if ($dbh->inTransaction()) {
            $dbh->rollBack();
            $response= $e->getMessage();
        }
    }
}
    echo $response;
    unset($dbh);
}