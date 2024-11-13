<?php 

session_start();
require_once "inc-files/dbconn.php";

require_once "inc-files/functions.php";
checkSessionID();
?>

<?php 
if (isset($_GET['student_id'])) {
# code...
$student_id = base64_decode($_GET['student_id']);
require_once ("inc-files/dbconn.php");
$query = $dbh->prepare("SELECT * FROM students WHERE student_id=? LIMIT 1");
$query->execute(array($student_id));
if ($query->rowCount()>0) {
$result = $query->fetch();
$fulname = $result->sname." ".$result->fname." ".$result->lname;
$previousClass = $result->preClass;
$id = $result->student_id;
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>School Fee Manager </title>
<!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="#">
<meta name="keywords"
content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
<meta name="author" content="#">
<!-- Favicon icon -->
<link rel="icon" href="files/assets/images/sample2.png" type="image/x-icon">
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
<!-- Chartlist chart css -->
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
<h4>STUDENT ADMISSION FORM</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item"  style="float: left;">
<a href="index.html"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"  style="float: left;"><a href="#!">Widget</a> </li>
</ul>
</div>
</div>
</div>
</div>
<!-- Page-header end -->
<!-- Page body start -->
<div class="page-body">
<div class="row">
<div class="col-md-8 offset-2">
<!-- Sales and expense card start -->
<div class="card">
<div class="card-header">



<section>
<form method="POST" id="upladImage-form">
<h3>SECTION E: OFFICIAL USE  </h3>
<fieldset>
    <div class="form-group">
        <input type="hidden" name="student_id" id="student_id" value="<?php echo $id;?>">
        <div class="col-sm-12">
            <label for="fulname"
                class="block">Student Full Name
                *</label>
        </div>
        <div class="col-md-12">
            <input id="fulname"
                name="fulname" type="text" value="<?php echo strtoupper($fulname) ?>"
                class="form-control" disabled>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-12">
            <label for="proposed_class"
                class="block">Proposed Class
                *</label>
        </div>
        <div class="col-md-12">
            <input id="proposed_class"
                name="proposed_class" type="text" value="<?php echo $previousClass?>"
                class="form-control" disabled>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <label for="passport"
                class="block">Student Passport
                * <small class="text-danger"> (MAX SIZE 50KB)</small> </label>
        </div>
        <div class="col-md-12">
            <input id="file"
                name="file" type="file" required
                class="form-control form-control-file">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <label for="admission_no"
                class="block">Admission No
                *</label>
        </div>
        <div class="col-md-12">
            <input id="admission_no"
                name="admission_no" type="text"
                class="form-control">
        </div>
    </div>
        <div class="form-group">
        <div class="col-sm-12">
            <label for="admitted_class"
                class="block">Admission Class
                *</label>
        </div>
        <div class="col-md-12">
                <select id="admitted_class" class="form-control" name="admitted_class">
                    <option value="">--select--</option>
                <optgroup label="ELEMENTARY CLASSES">
            <option value="Crech">Crech</option>
            <option value="KG1">KG One</option>
            <option value="KG2">KG Two</option>
                <option value="Nursery One">Nursery One</option>
            <option value="Nursery Two">Nursery Two</option>
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
                </select>
            
        </div>
    </div>
        <div class="form-group">
        <div class="col-sm-12">
            <label for="admitted_date"
                class="block">Admission Date
                *</label>
        </div>
        <div class="col-md-12">
            <input id="admitted_date"
                name="admitted_date" type="date"
                class="form-control date-control">
        </div>
    </div>
    
<button type="submit" id="uploadImage" name="uploadImage" value="submit" class="btn btn-warning btn-round btn-block">Upload Image</button>
</form>
<p id="response" class="text-center"></p>
</section>
</div>

<!-- Sales and expense card end -->
</div>
</div>
</div>
<!-- Page body end -->
</div>
</div>
<!-- Main-body end -->
<div id="styleSelector">
</div>
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

<!-- Custom js -->
<script src="files/assets/js/pcoded.min.js"></script>
<script src="files/assets/js/vartical-layout.min.js"></script>
<script src="files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="files/assets/js/script.js"></script>
<script src="uploadpassport.js"></script>
</body>

</html>