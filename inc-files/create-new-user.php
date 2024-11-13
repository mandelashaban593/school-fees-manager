<?php 
date_default_timezone_set("Africa/Lagos");
$output ="";
if ($_SERVER["REQUEST_METHOD"] =="POST") {
   
    require_once ("dbconn.php");
    require_once ("functions.php");
    $userType = clean_input($_POST['userType']);
    $user_fulname = clean_input($_POST['user_fulname']);
    $user_email = clean_input($_POST['user_email']);
    $user_username = clean_input($_POST['user_username']);
    $user_password = clean_input($_POST['user_password']);
    $user_confirm_password = clean_input($_POST['user_confirm_password']);
    //check for empty fields

    if (empty($userType) || empty($user_fulname) || empty($user_email) || empty($user_username) || empty($user_password) || empty($user_confirm_password)) {
         $output =' <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong> INVALID FORM SUBMISSION !</strong> Please Check all Input fields. <b class="text-info"> <span> And try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }elseif (! checkValidEmail($user_email)) {
        # code...
         $output ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong> INVALID EMAIL ADDRESS !</strong> Your Emaill Address Format not Supported. <b class="text-info"> <span> Please check and try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }elseif (! passwordLenght($user_password)) {
        # code...
        $output ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong> INVALID PASSWORD LENGHT !</strong> Your Password should be at least six Character Long.<b class="text-info"> <span> Please check and try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    elseif (! checkPasswordMatch($user_password,$user_confirm_password)) {
        $output ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>PASSWORD ERROR !</strong> The two passwords you entered did not Match. <b class="text-info"> <span> Please check and try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
//check for already existing username
    }elseif (checkDuplicateUserName($user_username)) {
        # code...
        $output ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong> ERROR </strong> User with this  <b class="text-info">'.$user_username.'</b> already Exists. <b class="text-info"> <span> Try another One...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    //check for already existing email
    elseif (checkDuplicateUserEmail($user_email)) {
        //user with this email already created throw error
         $output ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong> ERROR </strong> This E-mail <b class="text-info">'.$user_email.'</b> already Exists. <b class="text-info"> <span> Try another One...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }else{
        //save the details to db
        $password = encryptPass($user_password);
        $status = 1;
        $thisDay = date("Y-m-d");
         $token = substr(md5(time()),0,20).mt_rand(100,999);
         $query = $dbh->prepare("INSERT INTO administrator (username,fulname,email,`password`,token,status,created_at,user_type) VALUES (?,?,?,?,?,?,?,?);");
       if ($query->execute(array($user_username,$user_fulname,$user_email,$password,$token,$status,$thisDay,$userType))) {
           # code...
           $output ='<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
  <strong>CONGRATULATIONS!</strong> <b class="text-info">'.$user_fulname.' '.$user_username.'</b> Successfully Registered. <b class="text-info"> <span> Refreshing Page...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> 
        <script>
        setTimeout(() => {
        $("#register-user-message").html("");
        $("#register-user-Form")[0].reset();
        $("#large-Modal-adduser").modal("hide");
        self.location.reload();
        }, 5000);
        </script>
';
       }else{
           $output ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>INTERNAL ERROR </strong> There was an error Creating New User Account. <b class="text-info"> <span> Please try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
       }
    }
    echo $output;
}

?>