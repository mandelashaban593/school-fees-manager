<?php 

session_start();
require_once "inc-files/dbconn.php";
require_once "inc-files/functions.php";
checkSessionID();
?>

<?php 
if (isset($_GET['payee']) && $_GET['payee'] !=="" && isset($_GET['history_id'])) {
$history_id = base64_decode($_GET['history_id']);
# code...
$student_id = base64_decode($_GET['payee']);

$query = $dbh->prepare("SELECT * FROM payment_history WHERE history_id=? LIMIT 1");
$query->execute(array($history_id));
if ($query->rowCount()>0) {
$fetchData = $query->fetch();
$payee = $fetchData->payment_id;
$amount_paid = $fetchData->amount_paid;
$rem_bal = $fetchData->rem_bal;
$payment_date = $fetchData->payment_date;
$invoice_number = $fetchData->invoice_number;

// get student details 
$checkStudent =$dbh->query("SELECT * FROM students INNER JOIN individual_fee ON students.student_id=individual_fee.student_id WHERE students.student_id='$student_id'");
if ($checkStudent->rowCount()>0) {
# code...
$allDetail = $checkStudent->fetch();
$amount_per_term = $allDetail->amount_per_term;
$studentFulName = $allDetail->sname." ".$allDetail->fname." ".$allDetail->lname;
$admitted_class = $allDetail->admitted_class;
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Osotech School Fee Management System</title>
<link rel="icon" href="<?php echo fetchLogo();?>" type="image/x-icon">
<!-- Google font-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
<!-- Required Fremwork -->
<link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- themify-icons line icon -->
<link rel="stylesheet" type="text/css" href="files/assets/icon/themify-icons/themify-icons.css">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
</head>
<body>
<div class="main-body">
<div class="page-wrapper">

<!-- Page body start -->
<div class="page-body">
<!-- Container-fluid starts -->
<div class="container">
<!-- Main content starts -->
<div>
<!-- Invoice card start -->
<div class="card">
<div class="row invoice-contact">
<div class="col-md-8">
<div class="invoice-box row">
<div class="col-sm-12">
<table
class="table table-responsive invoice-table table-borderless">
<tbody>
<tr>
    <td><img src="files/assets/images/sample.png"
            class="m-b-10" alt=""></td>
</tr>
<tr>
    <td><h2>MEDICAL SCHOOL</h2></td>
</tr>
<tr>
    <td><b>Address:</b> 37, Taiwo Ogundimu Str., Iloye, Cele Ifihan, Sango, Ogun State.</td>
</tr>
<tr>
    <td><b>Email: </b> <a href="mailto:gloriousvisionhighschool@gmail.com"
            target="_top">gloriousvisionhighschool@gmail.com</a>
    </td>
</tr>
<tr>
    <td> <b>Tel: </b>+234(81)-8448-8340, +234(70)-6714-6351 </td>
</tr>
<tr>
<td><b>Website :</b> <a href="#" target="_blank">www.gvms.com.ng</a>
        </td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
<div class="col-md-4">
</div>
</div>
<div class="card-block">
<div class="row invoive-info">
<div class="col-md-4   invoice-client-info">
<h6>Student Information :</h6>
<h6 class="m-0"><?php echo ucfirst( $studentFulName)?></h6>
<p class="m-0 m-t-10"><?php echo $admitted_class;?>
</p>

</div>
<div class="col-md-4 col-sm-6">
<h6>Payment Information :</h6>
<table
class="table table-responsive invoice-table invoice-order table-borderless">
<tbody>
<tr>
<th>Date :</th>
<td><?php echo date("d-m-Y",strtotime($payment_date));?></td>
</tr>

</tbody>
</table>
</div>
<div class="col-md-4 col-sm-6">
<h6 class="m-b-20">Invoice Number
<span>#<?php echo $invoice_number;?></span></h6>
<h6 class="text-uppercase text-primary">Total Due :
<span>UGX <?php echo number_format($rem_bal,2) ?></span>
</h6>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="table-responsive">
<table class="table  invoice-detail-table table-bordered table-hover">
<thead>
<tr class="thead-default">
    <th>Description</th>
    <th>Termly Payment</th>
    <th>Amount Paid</th>
    <th>Balance</th>
</tr>
</thead>
<tbody>
<tr>
    <td>
        <h6>School fee</h6>
    
    </td>
    <td>UGX<?php echo number_format($amount_per_term,2)?></td>
    <td>UGX<?php echo number_format($amount_paid,2)?></td>
    <td>UGX<?php echo number_format($rem_bal,2)?></td>
</tr>


</tbody>
</table>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<table
class="table table-responsive invoice-table invoice-total">
<tbody>
<tr>
<th>Total School Fee :</th>
<td>UGX<?php echo number_format($amount_per_term,2)?></td>
</tr>
<tr>
<th>Paid (<?php echo number_format(($amount_paid/$amount_per_term)*(100/1),2);?>%) Of UGX<?php echo number_format($amount_per_term,2) ?>:</th>
<td>UGX<?php echo number_format($amount_paid,2)?></td>

<tr class="text-info">
<td>
    <hr />
    <h5 class="text-danger">Total Due Balance :</h5>
</td>
<td>
    <hr />
    <h5 class="text-primary">UGX<?php echo number_format($rem_bal,2)?></h5>
</td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<h6>Terms And Condition :</h6>
<p>Your terms and Conditions will be here</p>
</div>
</div>
</div>
</div>
<!-- Invoice card end -->
<!-- Invoice card end -->

</div>
</div>
<!-- Container ends -->
</div>
<!-- Page body end -->
</div>
</div>

<!-- Required Jquery -->

<script>
window.addEventListener("load", window.print());
</script>

</body>
</html>