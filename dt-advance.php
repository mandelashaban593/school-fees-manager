<?php 
session_start();
require_once ("inc-files/dbconn.php");
require_once "inc-files/functions.php";
$school_session = fetchSchoolSession();
checkSessionID();

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title> School Fee Manager</title>

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
<!-- sweet alert framework -->

<!-- ico font -->
<link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">
<!-- Notification.css -->
<link rel="stylesheet" type="text/css" href="files/assets/pages/notification/notification.css">
<!-- Animate.css -->
<link rel="stylesheet" type="text/css" href="files/bower_components/animate.css/animate.css">
<!-- feather Awesome -->
<link rel="stylesheet" type="text/css" href="files/assets/icon/feather/css/feather.css">
<!-- Data Table Css -->
<link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css"
href="files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="files/assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css"
href="files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
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


<!-- Sidebar inner chat end-->
<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<?php include ("inc-files/main-sidebar.php");?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<!-- Main-body start -->
<div class="main-body">
<div class="page-wrapper">
<!-- Page-header start -->
<div class="page-header">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<div class="d-inline">
<h4>List of Student Payments</h4>

</div>
</div>
<!-- modal starts -->


<!-- modal ends -->
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item"  style="float: left;">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"  style="float: left;"><a href="promotion.php">Promotion
</a>
</li>
<li class="breadcrumb-item"  style="float: left;"><a href="#!">Payment
</a>
</li>
</ul>
</div>
</div>
</div>
</div>

<div class="page-body">
<!-- DOM/Jquery table start -->
<div class="card">
<div class="card-header">
<h5>Students and Payment Details</h5>

</div>
<div class="card-block">
<div class="table-responsive dt-responsive">
<table id="dom-jqry"
class="table table-stripe table-bordered nowrap text-center"
style="width:100%">
<thead class="bg-warning">
<tr>
<th>Passport</th>
<th>Surname</th>
<th>Last Name</th>
<th>Current Class</th>
<th>School Fee</th>

<th>Balance</th>
<th>Status</th>
<td>Actions</td>

</tr>
</thead>
<tbody>
<?php 
$query = $dbh->query("SELECT * FROM students ORDER BY sname ASC");
if ($query->rowCount() >0) {
$cnt =0;
while ($resultSet = $query->fetch()) {
$cnt++;
$student_id = $resultSet->student_id;
//individual_fee 
$qq = $dbh->query("SELECT * FROM individual_fee WHERE student_id='$student_id' AND school_session='$school_session' LIMIT 1");
if ($qq->rowCount()>0) {
$rset = $qq->fetch();
$termly_payment ="UGX;". number_format($rset->amount_per_term,2); 
}else{
$termly_payment ="<span class='badge badge-info badge-lg badge-pill'>Not Yet Declared</span>";
}
$pQuery =$dbh->query("SELECT * FROM payment WHERE payee_id='$student_id' AND payment_session='$school_session' LIMIT 1");
if ($pQuery->rowCount()>0) {
# code...
$paymentBalance = $pQuery->fetch();
$p_status = $paymentBalance->payment_status;
$studentBalance ="UGX;". number_format($paymentBalance->balance,2);
}else{
$p_status =0;
$studentBalance= "<span class='badge badge-danger badge-lg badge-pill'>No Payment</span>";
}
?>
<tr>

<td><img src="student-image/<?php echo $resultSet->passport;?>" alt="" width="60"></td>
<td><?php echo $resultSet->sname; ?></td>
<td><?php echo $resultSet->fname." ".$resultSet->lname; ?></td>
<td><?php echo $resultSet->admitted_class;?></td>
<td><?php echo $termly_payment;?></td>
<td><?php echo $studentBalance;?></td>

<td><?php if ($p_status ==0) {
$printStatus = '<span class="badge badge-danger badge-lg badge-pill ">No Payment made</span>';
}elseif($p_status ==1){
$printStatus = '<span class="badge badge-warning text-white badge-lg badge-pill ">Not Cleared</span>';
}else{
$printStatus = '<span class="badge badge-success badge-lg badge-pill "> Cleared</span>';
}
echo $printStatus;
?></td>
<td>  <div class="dropdown-warning dropdown open">
<button
class="btn btn-info dropdown-toggle waves-effect waves-light "
type="button" data-toggle="dropdown"
aria-haspopup="true"
aria-expanded="true">Actions</button>
<div class="dropdown-menu" aria-labelledby="dropdown-5"
data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
<?php  if($resultSet->admitted_class =="" || $resultSet->admitted_class==NULL){
echo '<a class="dropdown-item waves-light waves-effect"
href="uploadpassport.php?student_id='.base64_encode($student_id).'">Upload Passport</a>';
}?>


<a class="dropdown-item waves-light waves-effect setFeeBtn"
href="javascript:void(0)" id="<?php echo $resultSet->student_id;?>">Set School Fee</a>

<a class="dropdown-item waves-light waves-effect"
href="invoice-list.php?key=<?php echo base64_encode($resultSet->student_id)?>" >Payment History</a>
<a class="dropdown-item waves-light waves-effect change-Fee-Amount-Btn"
href="javascript:void(0)" id="<?php echo $resultSet->student_id;?>"> Edit Fee Amount</a>
</div>
</div>
<button class="btn btn-outline-warning makePaymentBtnStudent" id="<?php echo $resultSet->student_id;?>">Make Payment</button></td>
</tr>
<?php


}
}


?>


</tbody>
<tfoot class="bg-warning">
<tr>
<th>Passport</th>
<th>Surname</th>
<th>Last Name</th>
<th>Current Class</th>
<th>School Fee</th>

<th>Balance</th>
<th>Status</th>
<td>Actions</td>
</tr>
</tfoot>
</table>
</div>
</div>
</div>
<!-- DOM/Jquery table end -->
<!-- Column Rendering table start -->


</div>
<!-- Page-body start -->
</div>
</div>
<!-- Main-body end -->
</div>
</div>
</div>
</div>
</div>
</div>
<?php include("oam.php");?>

<?php include("editpayment.php");?>

<?php include("adduser.php");?>

<?php
include("payment-entry.php");
?>

<?php
//include("viewstudent.php");
?>

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

<!-- data-table js -->
<script src="files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="files/assets/pages/data-table/js/jszip.min.js"></script>
<script src="files/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="files/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="files/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="files/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="files/assets/pages/data-table/js/dataTables.bootstrap4.min.js"></script>
<script src="files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- sweet alert js -->

<!-- sweet alert modal.js intialize js -->
<!-- modalEffects js nifty modal window effects -->
<script type="text/javascript" src="files/assets/js/modalEffects.js"></script>
<script type="text/javascript" src="files/assets/js/classie.js"></script>
<!-- notification js -->
<script type="text/javascript" src="files/assets/js/bootstrap-growl.min.js"></script>
<script type="text/javascript" src="files/assets/pages/notification/notification.js"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="files/bower_components/i18next/i18next.min.js"></script>
<script type="text/javascript"
src="files/bower_components/i18next-xhr-backend/i18nextXHRBackend.min.js"></script>
<script type="text/javascript"
src="files/bower_components/i18next-browser-languagedetector/i18nextBrowserLanguageDetector.min.js"></script>
<script type="text/javascript" src="files/bower_components/jquery-i18next/jquery-i18next.min.js"></script>
<!-- Custom js -->
<script src="files/assets/pages/data-table/js/data-table-custom.js"></script>
<script src="files/assets/js/pcoded.min.js"></script>
<script src="files/assets/js/vartical-layout.min.js"></script>
<script src="files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="files/assets/js/script.js"></script>
<script src="inc-files/myscript.js"></script>
<script src="viewStudentScript.js"></script>
<script src="makePayment.js"></script>
<script src="editPayment.js"></script>
</body>

</html>