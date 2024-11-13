<?php 

session_start();
require_once ("inc-files/dbconn.php");
require_once "inc-files/functions.php";
checkSessionID();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>School Fee Manager</title>

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
<link rel="stylesheet" type="text/css" href="files/assets/css/sweetalert.css">
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
            <h4>Student Promotion Module</h4>
            <span>Fee Structure Update</span>
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
            <li class="breadcrumb-item"  style="float: left;"><a href="dt-advance.php">Students</a>
            </li>
            <li class="breadcrumb-item"  style="float: left;"><a href="#!">Promotion</a>
            </li>
        </ul>
    </div>
</div>
</div>
</div>
<!-- Page-header end -->

<!-- Page-body start -->

<div class="page-body">
<!-- DOM/Jquery table start -->
<div class="card">
<div class="card-header">
    <h5>Total Students</h5>
    
</div>
<div class="card-block">
    <div class="table-responsive dt-responsive">
        <table id="dom-jqry"
            class="table table-striped table-bordered nowrap text-center"
            style="width:100%">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Photo</th>
                    <th> Surname</th>
                    <th> Last Name</th>
                        <th>Current Class</th>
                    <th> School Fee</th>
                    <th>Promotion Status</th>
                    <td> Actions</td>
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
                        $qq = $dbh->query("SELECT * FROM individual_fee WHERE student_id='$student_id' LIMIT 1");
                        if ($qq->rowCount()>0) {
                            $rset = $qq->fetch();
                            $termly_payment ="<span class='badge badge-info badge-lg badge-pill'>UGX". number_format($rset->amount_per_term, 2)."</span>";
                        } else {
                            $termly_payment ="<span class='badge badge-info badge-lg badge-pill'>No Yet Declared</span>";
                        }
                        $pQuery =$dbh->query("SELECT * FROM payment WHERE payee_id='$student_id' LIMIT 1");
                        if ($pQuery->rowCount()>0) {
                            # code...
                            $paymentBalance = $pQuery->fetch();
                            $promotion_status = $paymentBalance->payment_status;
                            $studentBalance ="UGX". number_format($paymentBalance->balance, 2);
                        } else {
                            $promotion_status = 0;
                            $studentBalance= "<span class='badge badge-danger badge-lg badge-pill'>No Payment</span>";
                        } ?>
                        <tr>
                        <td><img src="student-image/<?php echo $resultSet->passport; ?>" alt="" width="60"></td>
                        <td><?php echo $resultSet->sname;?></td>
                    <td><?php echo $resultSet->fname." ".$resultSet->lname; ?></td>
                        <td><?php echo $resultSet->admitted_class; ?></td>
                    <td><?php echo $termly_payment;?></td>
                    <td> <?php if ($promotion_status==0) {
                        # code...
                        echo "<span class='badge badge-warning badge-lg badge-pill'>Not Yet Declared</span>";
                    }elseif ($promotion_status==1) {
                        # code...
                        echo "<span class='badge badge-danger badge-lg badge-pill'>Not Qualified</span>";
                    }else{
                        echo "<span class='badge badge-success badge-lg badge-pill'>Qualified</span>";

                    }
                    ?>
            
                    </td>
                    <td> <button type="button" class="btn btn-info promotionModalBtn"
                            data-id="<?php echo $resultSet->student_id;?>">Promote</button>
                        <a class="waves-light waves-effect"
                        href="invoice-list.php?key=<?php echo base64_encode($resultSet->student_id)?>"> <button class="btn btn-warning"> Payment History</button></a></td>

                    <?php
                    }
                }
                    ?>
            </tbody>
            <tfoot class="bg-dark">
                <tr> 
                    <th>Photo</th>
                    <th>Surname</th>
                    <th>Last Name</th>
                    <th>Current Class</th>
                    <th>School Fee</th>
                    <th>Promotion Status</th>
                    <td>Actions</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>
<!-- DOM/Jquery table end -->
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

<div class="modal fade" id="large-Modal-promotion" tabindex="-1"
role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="text-center" id="serverText">
</div>
<form>
<div class="modal-header">
<h4 class="modal-title text-center">PROMOTE STUDENT</h4>

<button type="button" class="close"
data-dismiss="modal"
aria-label="Close">
<span
aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">
<div class="col-md-12">
<div class="row">
<input type="hidden" id="student_hidden_id">

<div class="col-md-6">
<div class="form-group">
<label>Full Name</label>
<input type="text" id="student_name" class="form-control" disabled>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Current Class</label>
<input type="text" class="form-control" id="current_class" disabled>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Promoted to</label>
<select class="form-control" id="promoted_to">
<option value="">--select--</option>
<optgroup label="ELEMENTARY CLASSES">
<option value="Crech">Crech</option>
<option value="KG1">KG One</option>
<option value="KG2">KG Two</option>
<option value="Nursery1">Nursery One</option>
<option value="Nursery2">Nursery Two</option>
</optgroup>
<optgroup label="BASIC CLASSES">
<option value="Basic One">Basic One</option>
<option value="Basic Two">Basic Two</option>
<option value="Basic Three">Basic Three</option>
<option value="Basic Four">Basic Four</option>
<option value="Basic Five">Basic Five</option>
</optgroup>
<optgroup label="SECONDARY CLASSES">
<option value="S1">Senior I</option>
<option value="S2">Senior II</option>
<option value="S3">Senior III</option>
<option value="S4">Senior IV</option>

</optgroup>
<optgroup label="GRADUATE STUDENT">
<option value="graduate">Graduate</option>

</optgroup>
</select>
</div>
</div>


<div class="col-md-6">
<div class="form-group">
<label>New School Fee</label>
<input type="text" id="new_school_fee" class="form-control form-control-success" placeholder="UGX 50,000.00">
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button"
class="btn btn-default waves-effect "
data-dismiss="modal">Close</button>
<button type="button"
class="btn btn-primary waves-effect waves-light promoteNowBtn" id="submit-promotion" value="promote">Promote Student Now
</button>
</div>
</form>
</div>
</div>
</div>

<?php
include("payment-entry.php");
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
<script type="text/javascript" src="files/assets/js/sweetalert.js"></script>
<script type="text/javascript" src="files/assets/js/modal.js"></script> 
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
<script>
$(document).ready(function(){
//when promote btn is clicked 
$(".promotionModalBtn").on("click", function() {
let getId = $(this).data("id");
let action = "fetch";
$.ajax({
url:"inc-files/fetch-student-details.php",
type:"POST",
data:{
getId:getId,
action:action
},
dataType:"JSON",
success:function(data){
$("#student_hidden_id").val(data.student_id);
$("#student_name").val(data.sname+" "+data.fname+" "+data.lname);
$("#current_class").val(data.admitted_class);
$("#large-Modal-promotion").modal("show");
}
})

});

// promote student Now btn 
$(".promoteNowBtn").on('click', function(){

let student_hidden_id = $("#student_hidden_id").val();
let new_school_fee = $("#new_school_fee").val();
let promoted_to = $("#promoted_to").val(); 
let current_class = $("#current_class").val();
let submit_promotion = $("#submit-promotion").val();
//send to server 
$.ajax({
url:"inc-files/promotion-action.php",
type:"POST",
data:{
student_hidden_id:student_hidden_id, 
new_school_fee:new_school_fee,
promoted_to:promoted_to,
current_class:current_class,
submit_promotion:submit_promotion
},
success:function(dataRes){
$("#serverText").html(dataRes);
setTimeout(() => {
self.location.reload();
}, 6000);
}
})

})
})
</script>
</body>

</html>