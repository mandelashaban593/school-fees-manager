<?php 

session_start();
require_once "inc-files/dbconn.php";
require_once "inc-files/functions.php";
checkSessionID();
?>
<?php 
if (isset($_GET['key']) && $_GET['key'] !=="") {
# code...
$student_id = base64_decode($_GET['key']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>School Fee Management System</title>

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
<?php include ("inc-files/preloader.php");?>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
<div class="pcoded-overlay-box"></div>
<div class="pcoded-container navbar-wrapper">

<?php include ("inc-files/navbarTop.php"); ?>

<!-- Sidebar inner chat end-->
<div class="pcoded-main-container">
<div class="pcoded-wrapper">
<?php include ("inc-files/main-sidebar.php"); ?>
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
            <?php
            $query = $dbh->query("SELECT * FROM students WHERE student_id='$student_id' LIMIT 1");
            if ($query->rowCount()>0) {
                $resultget =$query->fetch();
                $studentFulName = $resultget->sname." ".$resultget->fname." ".$resultget->lname;
            }
                ?>
            <h4>Payment History for <b class="text-info text-bold"><?php echo strtoupper($studentFulName); ?></b></h4>
            <span>The list Below show all Payment Done by <?php echo ucfirst( $studentFulName) ?></span>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="page-header-breadcrumb">
        <ul class="breadcrumb-title">
            <li class="breadcrumb-item"  style="float: left;">
                <a href="index.php"> <i class="feather icon-home"></i> </a>
            </li>
            <li class="breadcrumb-item"  style="float: left;"><a href="dt-advance.php">Students</a> </li>
        </ul>
    </div>
</div>
</div>
</div>
<!-- Page-header end -->

<!-- Page body start -->
<div class="page-body invoice-list-page">
    <!-- Navigation end  -->
    <div class="row">
        <!-- Invoice list card start -->
        <?php 
        // fecth all the payments so far from payment history 
        $fetchPayment = $dbh->query("SELECT * FROM payment_history WHERE payment_id='$student_id'");
        if ($fetchPayment->rowCount()>0) {
            while ($rows = $fetchPayment->fetch(PDO::FETCH_ASSOC)) {?>

                    <div class="col-md-6">
            <div class="card card-border-primary">
                <div class="card-header">
                    <h5><?php echo ucfirst( $studentFulName);?> </h5>
                    
                    <div class="dropdown-secondary dropdown f-right">
                <button class="btn btn-info btn-mini" type="button" disabled >School fee</button>
                        
                        <!-- end of dropdown menu -->
                        <span class="f-left m-r-5 text-inverse">Fee Type :
                        </span>
                    </div>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <ul class="list list-unstyled">
                                <li>Paid To : <b>Principal</b></li>
                                <li>Payment Date:<b> <span
                                        class="text-semibold"><?php echo date("d-m-Y",strtotime($rows['payment_date']));?></span></b>
                                </li>
                                 <li>Term: <b><span
                                        class="text-bold"><?php echo $rows['term'];?></span></b>
                                </li>
                                <li>Session:<b> <span
                                        class="text-bold"><?php echo $rows['session'];?></span></b>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list list-unstyled text-right">
                                <li>Amount Paid : <b><span
                                        class="text-semibold"> UGX; <?php echo number_format($rows['amount_paid'],2)?></span></b> </li>
                                <li>Payment Method:<b> <span
                                        class="text-semibold"><?php echo strtoupper($rows['payment_method'])?> </span></b>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="task-list-table">
                        <h3 class="task-due text-danger"><strong> Due Balance : </strong>
                        <?php if ($rows['rem_bal'] ==0) {?>
                            <strong
                                class="label label-success">Cleared </strong>
                       <?php }else{?>
                         <strong
                                class="label label-warning"> UGX; <?php echo number_format($rows['rem_bal'],2)?></strong>
                           
                        <?php }
                        ?>
                       </h3>
                    </div>
                    <div class="task-board m-0">
                        
                            <button
                                class="btn btn-dark btn-md"
                                type="button"> <a href="invoice.php?history_id=<?php echo base64_encode($rows['history_id'])?>&payee=<?php echo base64_encode($student_id);?>" style="text-decoration: none !important;color:white">Print Receipt</a> </button>
                    </div>
                    <!-- end of pull-right class -->
                </div>
                <!-- end of card-footer -->
            </div>
        </div>
        <!-- Invoice list card end -->
    <?php
                
            }
        }else{
            echo '<div class="col-md-6">
            
            <div class="card card-border-primary">
            
            <h4 class="text-warning text-center"> Sorry to inform you! <br />
             But there are no Payments History for <br/> <b class="text-info">'.ucfirst( $studentFulName).'</b></h4>
            </div>
            
            
            
            </div>';
        }
        
        ?>
        
    </div>
</div>
<!-- Page body end -->
</div>
</div>
<!-- Main-body end -->

</div>
</div>
</div>
</div>
</div>
</div>



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

<!-- task board js -->
<script type="text/javascript" src="files/assets/pages/task-board/task-board.js"></script>
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
<script>
$(document).ready(function(){
$(".printBtn").on("click", function(){
setTimeout(function(){
self.location.href='invoice.php?id='+1;
},2000)
})
})
</script>
</body>

</html>