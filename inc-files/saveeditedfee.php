<?php 
$response ="";
if (isset($_POST['myaction']) && $_POST['myaction'] =="editStudentPay") {

    require_once ("dbconn.php");

   $payee_id = $_POST['editor_id'];
		$query = $dbh->prepare("SELECT * FROM students JOIN payment ON students.student_id=payment.payee_id JOIN individual_fee ON students.student_id=individual_fee.student_id WHERE students.student_id=? LIMIT 1");
		$query->execute(array($payee_id));
		if ($query->rowCount()>0) {
			# code...
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$data = $result;
			echo json_encode($data);
		}
}


if (isset($_POST['myaction']) && $_POST['myaction'] ==="saveUpdatedChange") {
  
    require_once ("dbconn.php");
    require_once "functions.php";

    $update_student_id = clean_input($_POST['update_student_id']);
    $new_fee = clean_input($_POST['new_fee']);
    $old_fee = clean_input($_POST['old_fee']);
    $payment_term = clean_input($_POST['payment_term']);
    $payment_session = clean_input($_POST['payment_session']);
    $new_due_bal = ($new_fee - $old_fee);
    $f = $dbh->query("SELECT * FROM payment WHERE payee_id='$update_student_id' AND payment_term='$payment_term' AND payment_session='$payment_session'");
    $rd = $f->fetch();
    $newBal = ($new_due_bal + $rd->balance);

    $u = $dbh->prepare("UPDATE payment SET balance='$newBal' WHERE payee_id='$update_student_id' AND payment_term='$payment_term' AND payment_session='$payment_session'");
    if ($u->execute()) {
        //update individual fee table 
    $query = $dbh->prepare("UPDATE individual_fee SET amount_per_term=? WHERE student_id=? LIMIT 1");
    if ($query->execute(array($new_fee,$update_student_id))) {
      $response ='<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congratulations! </strong> School Fee for the Selected Student Successufully Updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<script>
 setTimeout(() => {
$("#large-Modal-Update-Fee-form").modal("hide");
 self.location.reload();
    }, 5000);
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
    }else{
        $response ='<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
  <strong>INTERNAL ERROR!</strong> Server Failed to Update student Fee! Please try again...
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
    }
    echo $response;
    unset($dbh);
}