<?php 

session_start();
require_once "inc-files/dbconn.php";
require_once "inc-files/functions.php";
$school_details = schoolProfile();
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
<title>Osotech School Fee Management System</title>

<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="#">
<meta name="keywords"
content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
<meta name="author" content="#">
<!-- Favicon icon -->
<link rel="icon" href="<?php echo fetchLogo();?>" type="image/x-icon">
<!-- Google font-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
<!-- Required Fremwork -->
<link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/dist/css/bootstrap.min.css">
<!-- themify-icons line icon -->
<link rel="stylesheet" type="text/css" href="files/assets/icon/themify-icons/themify-icons.css">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">
<!-- feather Awesome -->
<link rel="stylesheet" type="text/css" href="files/assets/icon/feather/css/feather.css">
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="files/assets/css/style.css">




<link rel="stylesheet" type="text/css" href="files/assets/css/jquery.mCustomScrollbar.css">
</head>

<body>
<!-- Pre-loader start -->
<?php include ("inc-files/preloader.php"); ?>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
<div class="pcoded-overlay-box"></div>
<div class="pcoded-container navbar-wrapper">

<?php include ("inc-files/navbarTop.php"); ?>


<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<?php include ("inc-files/main-sidebar.php"); ?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<!-- Main-body start -->
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
<td><img src="<?php echo fetchLogo();?>" width="200px"
class="m-b-10" alt=""></td>
</tr>
<tr>
<td><h2><?php echo $school_details['name'];?></h2></td>
</tr>
<tr>
<td><b>Address:</b> <?php echo $school_details['address_one'];?>, <?php echo $school_details['state'];?>. <?php echo $school_details['country'];?></td>
</tr>
<tr>
<td><b>Email: </b> <a href="mailto:<?php echo $school_details['school_email'];?>"
target="_top"><?php echo $school_details['school_email'];?></a>
</td>
</tr>
<tr>
<td> <b>Tel: </b><?php echo $school_details['phone'];?>, <?php echo $school_details['mobile'];?> </td>
</tr>
<tr>
<td><b>Website :</b> <a href="#" target="_blank"><?php echo $school_details['website'];?></a>
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
<p class="m-0 m-t-10"><b>Current Class</b> <?php echo $admitted_class;?>
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
<?php echo ($rem_bal ==0)? "<span class='text-success'>Cleared</span>":"<span class='text-primary'>UGX".number_format($rem_bal,2)."</span>";

?>
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
<?php echo ($rem_bal ==0)? "<h5 class='text-success'>Cleared</h5>":"<h5 class='text-primary'>UGX".number_format($rem_bal,2)."</h5>";

?>

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
<div class="row text-center">
<div class="col-sm-12 invoice-btn-group text-center">
<a href="print_page.php?history_id=<?php echo base64_encode($history_id)?>&payee=<?php echo base64_encode($student_id);?>" target="_blank" style="text-decoration: none !important;color:white"><button class="btn btn-info btn-round btn-md">Print Receipt</button></a>


</div>
</div>
</div>
</div>
<!-- Container ends -->
</div>
<!-- Page body end -->
</div>
</div>
<!-- Warning Section Starts -->


</div>
</div>
</div>
</div>
</div>
</div>



<!-- Older IE warning message -->

<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="files/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="files/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="files/bower_components/popper.js/dist/umd/popper.min.js"></script>
<script type="text/javascript" src="files/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="files/bower_components/jquery-slimscroll/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="files/bower_components/modernizr/modernizr.js"></script>
<script type="text/javascript" src="files/bower_components/modernizr/feature-detects/css-scrollbars.js"></script>

<!-- i18next.min.js -->
<script type="text/javascript" src="files/bower_components/i18next/i18next.min.js"></script>
<script type="text/javascript"
src="files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
<script type="text/javascript"
src="files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="files/bower_components/jquery-i18next/jquery-i18next.min.js"></script>
<!-- Custom js -->

<script src="files/assets/js/pcoded.min.js"></script>
<script src="files/assets/js/vartical-layout.min.js"></script>
<script src="files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="files/assets/js/script.js"></script>
</body>

</html>