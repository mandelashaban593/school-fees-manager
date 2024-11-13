<?php 
$response ="";
if (isset($_POST['osotech_action'])) {
    # code...
  require_once "functions.php";
    $student_class  = clean_input($_POST['student_class']);
    $my_payee_id = clean_input($_POST['my_payee_id']);
    $payment_session = clean_input($_POST['payment_session']);
    $payment_term = clean_input($_POST['payment_term']);
    $termly_payment = clean_input($_POST['termly_payment_amount_p']);
    $payment_amount = clean_input($_POST['payment_amount']);
    $payment_method = clean_input($_POST['payment_method']);
    $char = "abcdefghijklmnopqrstuvwxyz";
    $invoice_number = date("Ymdhis").str_shuffle(strtoupper(substr($char,0,5))).mt_rand(1000,9999);

    // check for empty values 
    if (empty($payment_session) || empty($payment_term) || empty($payment_amount) || empty($payment_method)) {
        # code...
         $response ='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>INVALID FORM SUBMISSION!</strong> Please fill all the REQUIRED Fields. Then resubmit
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }elseif (! is_numeric($payment_amount)) {
        $response ='<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
  <strong>INVALID CHARACTER!</strong> Only Numeric character is allowed. Try Again...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }else{
        // set pay date 
        $payment_date = date("Y-m-d");
        // math 
        // check if baclance is null or 0 or less than termly payment
        require_once "dbconn.php";
        $check1 = $dbh->prepare("SELECT * FROM `payment` WHERE payee_id=? AND payment_term=? AND payment_session=? AND student_class=? LIMIT 1");
        $check1->execute(array($my_payee_id,$payment_term,$payment_session,$student_class));
        if ($check1->rowCount()>0) {
            # code... that means the student has paid for the current term session and class
            // let find out if part payment 
           $details = $check1->fetch();
           $db_stu_balance = $details->balance;
           $db_paid = $details->amount_paid;
            $due_balance2 = ($db_stu_balance - $payment_amount);
             $total_paid  = ($db_paid + $payment_amount);
            //$due_balance = ($termly_payment - $payment_amount);
            //check if the student already balanced for the current term and session 
            if ($total_paid>$termly_payment ) {
              # code...
        $response ='<div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
  <strong> OVER-CHARGING ERROR!</strong> This Student already Cleared for this Term. <b class="text-info"> You can chnage the selected Term and resubmit the payment..</b
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
            }else{
               
                $updateBal = $dbh->prepare("UPDATE payment SET amount_paid=?,balance=?,payment_date=?,payment_method=?,payment_term=?, payment_session=?, created_at=? WHERE payee_id=? AND student_class=? LIMIT 1");
                if ($updateBal->execute(array($total_paid,$due_balance2,$payment_date,$payment_method,$payment_term,$payment_session,$payment_date,$my_payee_id,$student_class))) {
                    // create payment history
                    $insert = $dbh->prepare("INSERT INTO payment_history(payment_id,student_class,amount_paid,rem_bal,payment_date,payment_method,term,session,invoice_number) VALUES (?,?,?,?,?,?,?,?,?);");
                    if ($insert->execute(array($my_payee_id,$student_class,$payment_amount,$due_balance2,$payment_date,$payment_method,$payment_term,$payment_session,$invoice_number))) {
                        // update payment status
                        if (($total_paid ===$termly_payment) || ($termly_payment - $total_paid)=== 0 ||($total_paid >=$termly_payment)) {
                            # code...
                            $payment_status = 2;
                        } else {
                            $payment_status = 1;
                        }
                        $activateStatus = $dbh->prepare("UPDATE payment SET payment_status=? WHERE payee_id=? AND student_class=? AND payment_term=? AND payment_session=? LIMIT 1");
                        if ($activateStatus->execute(array($payment_status,$my_payee_id,$student_class,$payment_term,$payment_session))) {
                            $response ='<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      <strong>CONGRATULATIONS! </strong> Payment Saved and Updated Successfully. <b class="text-info"> <span> Please Refresh the page or navigate away...</span></b>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>';
                        }
                    } else {
                        $response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>INTERNAL SERVER ERROR! </strong> There was an error Updating Payment. <b class="text-info"> <span> Please try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
                    }
                } else {
                    $response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>INTERNAL SERVER ERROR! </strong> There was an error Updating Payment. <b class="text-info"> <span> Please try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
                }
            }
        }else{
          $remainder = ($termly_payment - $payment_amount);
            // the student has not paid this term and session 
            $query = $dbh->prepare("INSERT INTO payment (payee_id,student_class,amount_paid,balance,payment_date,payment_method,payment_term,payment_session,created_at) VALUES (?,?,?,?,?,?,?,?,?);");
            if ($query->execute(array($my_payee_id,$student_class,$payment_amount,$remainder,$payment_date,$payment_method,$payment_term,$payment_session,$payment_date))) {
               $insert = $dbh->prepare("INSERT INTO payment_history(payment_id,student_class,amount_paid,rem_bal,payment_date,payment_method,term,session,invoice_number) VALUES (?,?,?,?,?,?,?,?,?);"); 
                if ($insert->execute(array($my_payee_id,$student_class,$payment_amount,$remainder,$payment_date,$payment_method,$payment_term,$payment_session,$invoice_number))) {
                  // update payment status
                   if (($payment_amount ===$termly_payment) || ($termly_payment - $payment_amount)=== 0 ||($payment_amount >=$termly_payment)) {
                    # code...
                    $payment_status = 2;
                  }else{
                     $payment_status = 1;
                  }

                  $activateStatus = $dbh->prepare("UPDATE payment SET payment_status=? WHERE payee_id=? AND student_class=? AND payment_term=? AND payment_session=? LIMIT 1");
             if ($activateStatus->execute(array($payment_status,$my_payee_id,$student_class,$payment_term,$payment_session))) {
               $response ='<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      <strong>CONGRATULATIONS! </strong> Payment Saved Successfully. <b class="text-info"> <span> Please Refresh the page or navigate away...</span></b>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <script>
  setTimeout(()=>{
    self.location.reload();
  },3000);
  </script>
  
  ';
             }else{
               $response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>INTERNAL SERVER ERROR! </strong> There was an error Updating Payment. <b class="text-info"> <span> Please try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
             }
                }else{
 $response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>INTERNAL SERVER ERROR! </strong> There was an error Updating Payment. <b class="text-info"> <span> Please try again...</span></b>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
                }
                  
            }else{
 $response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
  <strong>INTERNAL SERVER ERROR! </strong> There was an error Updating Payment. <b class="text-info"> <span> Please try again...</span></b>
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
?>