<?php 

session_start();
require_once ("inc-files/dbconn.php");
require_once "inc-files/functions.php";

checkSessionID();
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
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"  style="float: left;"><a href="#!">Registration From</a> </li>
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
<form class="form" id="student-signup-form">
        <h3>SECTION A: CANDIDATE'S DATA </h3>
        <fieldset>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="surname"
                        class="block">Surname
                        *</label>
                </div>
                <div class="col-md-12">
                    <input id="surname"
                        name="surname" type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="firstname"
                        class="block">First Name
                        *</label>
                </div>
                <div class="col-md-12">
                    <input id="firstname"
                        name="firstname" type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="lastname"
                        class="block">Other Names
                        *</label>
                </div>
                <div class="col-sm-12">
                    <input id="lastname"
                        name="lastname"
                        type="text"
                        class="form-control ">
                </div>
            </div>
                <div class="form-group">
                <div class="col-sm-12">
                    <label for="gender"
                        class="block">Gender
                        *</label>
                </div>
                <div class="col-sm-12">
                    <select name="gender" id="gender" class="form-control">
                        <option value="">--select--</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
                <div class="form-group">
                <div class="col-sm-12">
                    <label for="dob"
                        class="block">Date of Birth
                        *</label>
                </div>
                <div class="col-sm-12">
                    <input id="dob"
                        name="dob"
                        type="date"
                        class="form-control date-control">
                </div>
            </div>
                <div class="form-group">
                <div class="col-sm-12">
                    <label for="place_of_birth"
                        class="block">Place of Birth
                        *</label>
                </div>
                <div class="col-sm-12">
                    <input id="place_of_birth"
                        name="place_of_birth"
                        type="text"
                        class="form-control">
                </div>
            </div>
                <div class="form-group">
                <div class="col-sm-12">
                    <label for="nationality"
                        class="block">Nationality
                        *</label>
                </div>
                <div class="col-sm-12">
                    <input id="nationality"
                        name="nationality"
                        type="text"
                        class="form-control ">
                </div>
            </div>
                <div class="form-group">
                <div class="col-sm-12">
                    <label for="state_of_origin"
                        class="block">Dsitrict of Origin
                        *</label>
                </div>
                <div class="col-sm-12">
                    <select id="state_of_origin"
                        name="state_of_origin"
                        class="form-control ">
                        <option value="">--select--</option>
                        <?php
                displayStateOfOrigin($dbh);
                            ?>
                    </select>
                </div>
            </div>
               
                <div class="form-group">
                <div class="col-sm-12">
                    <label for="proposed_class"
                        class="block">Class to which admission is Sought
                        *</label>
                </div>
                <div class="col-sm-12">
                    <select id="proposed_class"
                        name="proposed_class"
                        type="text"
                        class="form-control">
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
                </select>
                </div>
            </div>
        </fieldset>

            <h3>SECTION B: PREVIOUS SCHOOL DATA </h3>
        <fieldset>
            
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="school_name"
                        class="block">School Name
                        *</label>
                </div>
                <div class="col-md-12">
                    <input id="school_name"
                        name="school_name" type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="school_address"
                        class="block">School Address
                        *</label>
                </div>
                <div class="col-md-12">
                    <input id="school_address"
                        name="school_address" type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="last_class"
                        class="block">Last Class Attended
                        *</label>
                </div>
                <div class="col-sm-12">
                    <input id="last_class"
                        name="last_class"
                        type="text"
                        class="form-control ">
                </div>
            </div>
                <div class="form-group">
                <div class="col-sm-12">
                    <label for="reason"
                        class="block">Reason For Change of School
                        *</label>
                </div>
                <div class="col-sm-12">
                    <input id="reason"
                        name="reason"
                        type="text"
                        class="form-control">
                </div>
            </div>
                
        </fieldset>
        <h3> SECTION C: MEDICAL HISTORY </h3>
        <fieldset>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="genotype"
                        class="block"> Genotype
                        *</label>
                </div>
                <div class="col-sm-12">
                    <select name="genotype" id="genotype" class="form-control">
                        <option value="">--select--</option>
                        <option value="AA"> AA</option>
                        <option value="AS"> AS</option>
                        <option value="SS"> SS</option>
                        <option value="others"> I Don't Know</option>
                        
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="blood_group"
                        class="block">Blood Group
                        *</label>
                </div>
                <div class="col-sm-12">
                    <select name="blood_group" id="blood_group" class="form-control">
                        <option value="">--select--</option>
                        <option value="A">A</option>
                        <option value="AB">AB</option>
                        <option value="B">B</option>
                        <option value="O-positive">O+</option>
                        <option value="O-negative">O-</option>
                        <option value="others">I Don't Know</option>
                        
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="sickness"
                        class="block">Usual Sickness (if Any)
                        #</label>
                </div>
                <div class="col-sm-12">
                    <input id="sickness"
                        name="sickness" type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="clinic"
                        class="block">Do you have any familiy Clinic?</label>
                </div>
                <div class="col-sm-6">
                    <select name="clinic" id="clinic" class="form-control">
                        <option value="">--select--</option>
                        <option value="Yes">Yes</option>
                        <option value="No">No</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="clinic_phone"
                        class="block">Clinic Phone Number</label>
                </div>
                <div class="col-sm-6">
                    <input id="clinic_phone"
                        name="clinic_phone"
                        type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">IF Yes (Give Address)</div>
                <div class="col-sm-12">
                    <textarea class="form-control" name="clinic_address" id="clinic_address"></textarea>
                </div>
            </div>
        </fieldset>
        <h3>SECTION D:PARENTS/GURDIAN</h3>
        <fieldset>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="parent_name"
                        class="block">Full Name</label>
                </div>
                <div class="col-sm-12">
                    <input id="parent_name"
                        name="parent_name"
                        type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="parent_phone"
                        class="block">Phone Number</label>
                </div>
                <div class="col-sm-12">
                    <input id="parent_phone"
                        name="parent_phone" type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="parent_address"
                        class="block"> Contact Address
                        *</label>
                </div>
                <div class="col-sm-12">
                    <input id="parent_address"
                        name="parent_address"
                        type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="parent_occupation"
                        class="block">Occupation</label>
                </div>
                <div class="col-sm-6">
                    <input id="parent_occupation"
                        name="parent_occupation"
                        type="text"
                        class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                    <label for="position_at_work"
                        class="block"> Position at Work</label>
                </div>
                <div class="col-sm-6">
                    <input id="position_at_work"
                        name="position_at_work"
                        type="text"
                        class="form-control date-control">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <label for="parent_wrk_address"
                        class="block"> Office Address</label>
                </div>
                <div class="col-sm-12">
                    <input id="parent_wrk_address"
                        name="parent_wrk_address"
                        type="text"
                        class="form-control">
                </div>
            </div>
        </fieldset>
        
        <div class="form-group row">
            <div class="col-sm-12">
                <label for="submit-student" class="block"></label>
            </div>
            <div class="col-sm-12">
                <button type="submit" id="submit-student" name="submit" value="submit" class="btn btn-success btn-block btn-round regBtn">Register Student</button>
            </div>
        </div>
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
<script src="signupstudent.js"></script>
</body>

</html>