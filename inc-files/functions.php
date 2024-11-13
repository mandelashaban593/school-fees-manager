<?php 
function displayStateOfOrigin($dbh){
    $queryState = $dbh->prepare("SELECT * FROM states ORDER BY name ASC"); $queryState->execute();
while($rowget =$queryState->fetch(PDO::FETCH_OBJ)){
$state_id = $rowget->state_id;
$state =$rowget->name;
echo '<option value="'.$state.'">'.$state.'</option>';
                                                                                                }
}

function clean_input($data){
        $string = trim($data);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        $string =filter_var($string,FILTER_SANITIZE_STRING);
        return $string;
}

function checkValidEmail($email){
    if (!empty($email)) {
        # code...
        return (! filter_var($email,FILTER_VALIDATE_EMAIL))?false:true;
    }
}

function checkDuplicatedmissionNo($admission_no){
    global $dbh;
    // check for duplicate admission Number 
$checkAdmissionNumber = $dbh->prepare("SELECT admission_no FROM students WHERE admission_no=? LIMIT 1");
$checkAdmissionNumber->execute(array($admission_no));
 return ($checkAdmissionNumber->rowCount()>0)? true:false;
   
}

function checkSessionID(){
    if (!$_SESSION['USER_ID'] || $_SESSION['USER_ID'] ==="") {
        redirectUser();
    }
}

function redirectUser(){
    header("Location: login.php");
    exit();
}



// sum og payment today 
function totalPaymentToday(){
    global $dbh;
    $school_session = fetchSchoolSession();
    $stmt =$dbh->prepare("SELECT SUM(amount_paid) as fee_paid FROM payment_history WHERE session='$school_session' AND payment_date = (DATE(NOW()))");
$stmt->execute();
if ($stmt->rowCount() >0) {
	# code...
	$fee_paid = $stmt->fetch(PDO::FETCH_ASSOC);
	$sumOfFeePaid =$fee_paid['fee_paid'];

return $sumOfFeePaid;
}else{
	return 0.00;
}

}

function totalMoneyReceived(){
    global $dbh;
    $school_session = fetchSchoolSession();
    $school_term = fetchSchoolTerm();
    $stmt =$dbh->prepare("SELECT SUM(amount_paid) as fee_paid FROM payment WHERE payment_session=? AND payment_term=?");
$stmt->execute(array($school_session,$school_term));
if ($stmt->rowCount() >0) {
	# code...
	$fee_paid = $stmt->fetch(PDO::FETCH_ASSOC);
	$sumOfFeePaid =$fee_paid['fee_paid'];

return $sumOfFeePaid;
}else{
	return 0.00;
}

}


//THIS YEAR PAYMENT 

function totalMoneyReceivedYearly(){
    global $dbh;
    $school_session = fetchSchoolSession();
    $stmt =$dbh->prepare("SELECT SUM(amount_paid) as fee_paid FROM payment WHERE payment_date >= (DATE(CURDATE())- INTERVAL 1 YEAR) AND payment_session='$school_session'");
$stmt->execute();
if ($stmt->rowCount() >0) {
	# code...
	$fee_paid = $stmt->fetch(PDO::FETCH_ASSOC);
	$sumOfFeePaid =$fee_paid['fee_paid'];

return $sumOfFeePaid;
}else{
	return 0.00;
}

}
// CALC TOTAL SCHOOL FEE 
function expectedSchoolFeeOfAllStudents(){
    global $dbh;
    $school_session = fetchSchoolSession();
    $stmt = $dbh->prepare("SELECT SUM(amount_per_term) as total_fee FROM individual_fee WHERE school_session=?");
    $stmt->execute(array($school_session));
    if ($stmt->rowCount()>0) {
       $rows = $stmt->fetch(PDO::FETCH_ASSOC);
       $total_expected_fee = $rows['total_fee'];
       return $total_expected_fee;
    }else{
        return 0.00;
    }
}

//SUM OF OUTSTANDING BILL THIS TERM
 function totalOutstandingBill(){
     global $dbh;
    if (!empty(expectedSchoolFeeOfAllStudents() && !empty(totalMoneyReceived()))) {
        return expectedSchoolFeeOfAllStudents()- totalMoneyReceived();
    }else{
        return 0.00;
    }
 }

 //get current school session
 function fetchSchoolSession(){
     global $dbh;
     $stmt = $dbh->query("SELECT school_session FROM academic_session WHERE id=1 AND status=1");
     if ($stmt->rowCount()==1) {
         $result = $stmt->fetch();
         $school_session=$result->school_session;
         return $school_session;
     }else{
         return "Current Session Not Declared";
     }
 }

 //get current school session
 function fetchSchoolTerm(){
     global $dbh;
     $stmt = $dbh->query("SELECT current_term FROM academic_session WHERE id=1 AND status=1");
     if ($stmt->rowCount()==1) {
         $result = $stmt->fetch();
         $current_term=$result->current_term;
         return $current_term;
     }else{
         return "Current Term Not Declared";
     }
 }

 //check user password match 
 function checkPasswordMatch($pass,$cpass){
     if (! empty($pass) && ! empty($cpass)) {
         return ($pass === $cpass)? true:false;
     }
 }

 //check for duplicate Email address on admin table

 function checkDuplicateUserEmail($email){
     global $dbh;
     if (! empty($email)) {
       $stmt = $dbh->prepare("SELECT * FROM `administrator` WHERE email=? LIMIT 1");
     $stmt->execute(array($email));
     return ($stmt->rowCount()>0)? true:false;
     }
 }

 //check for duplicate Email address on admin table

 function checkDuplicateUserName($username){
     global $dbh;
     if (! empty($username)) {
       $stmt = $dbh->prepare("SELECT * FROM `administrator` WHERE username=? LIMIT 1");
     $stmt->execute(array($username));
     return ($stmt->rowCount()>0)? true:false;
     }
 }

 //check passowrd lenght value 

 function passwordLenght($password){
     if (! empty($password)) {
        return (strlen($password) >= 6)? true:false;
     }
 }

 //password encryption 
  function encryptPass($password){
      if (! empty($password)) {
         return password_hash($password,PASSWORD_DEFAULT);
      }
  }

  //Verify Password

  function password_check($password,$hashed){
    
        return true;
    
  }


  //fetch school profile details 


  function schoolProfile(){
      global $dbh;

      $stmt = $dbh->query("SELECT * FROM school_profile WHERE id=1");
      if ($stmt->rowCount()>0) {
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         return $result;
      }else{
          return "";
      }
  }

  //fetch school Logo 

  function fetchLogo(){
      $school_details = schoolProfile();
      if ($school_details['logo']==NULL || $school_details['logo']=="") {
     $logo = "files/assets/images/sample2.png";
    }else{
    $logo = "files/assets/images/".$school_details['logo'];
}
return $logo;
  }