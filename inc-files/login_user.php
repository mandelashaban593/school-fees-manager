<?php 
@session_start();
$response ="";
if (isset($_POST['submit']) && $_POST['submit'] ==="submitBtnLog") {
    require_once "functions.php";

    # code...
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);
    $userType = clean_input($_POST['userType']);
    $userType = ($userType ==1)? "Secretary":"Director";
    //  
    if (empty($username) || empty($password)) {
        # code...
        $response =' <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong> INVALID FORM SUBMISSION !</strong> Please Check your Input. <b class="text-info"> <span> And try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

    }elseif (empty($userType)) {
      # code...
       $response =' <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong class="text-warning"> INVALID LOGIN!</strong> Please Select User Account. <b class="text-info"> <span> And try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    else{
        require_once "dbconn.php";
        $check = $dbh->prepare("SELECT * FROM administrator WHERE username=? AND user_type=? LIMIT 1");
        $check->execute(array($username,$userType));
        if ($check->rowCount()>0) {
            $result = $check->fetch();
            $db_password = $result->password;
            if (password_check($password,$db_password)) {
                # code...
                $_SESSION['USER_ID'] = $result->user_id;
                $_SESSION['USERNAME'] = $result->username;
                $_SESSION['USER'] = $result->user_type;
                $response ='<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
  <strong> SUCCESS </strong> <b class="text-info"> <span> Redirecting...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> 
<script>
setTimeout(()=>{
    self.location.href="index.php";
},2000)</script>
';
            }else{
                 $response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong> INVALID ACCOUNT PASSWORD!</strong> Please Check Your Password. <b class="text-info"> <span> And try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
            }
        }else{
             $response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong> INVALID ACCOUNT!</strong> Please Check your Username/Password. <b class="text-info"> <span> And try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
        }
    }
    echo $response;
    unset($dbh);
}


?>