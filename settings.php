<?php 

session_start();
require_once ("inc-files/dbconn.php");
require_once "inc-files/functions.php";

checkSessionID();

$school_details = schoolProfile();
?>

<?php 
$response = "";
if (isset($_POST['submit-school-profile-detail']) && isset( $_FILES['school_logo']['name'])) {

$id = clean_input($_POST['id']);
$director = clean_input($_POST['director']);
$school_name = clean_input($_POST['school_name']);
$motto = clean_input($_POST['motto']);
$first_address = clean_input($_POST['first_address']);
$second_address = clean_input($_POST['second_address']);
$mobile = clean_input($_POST['mobile']);
$phone = clean_input($_POST['phone']);
$email = clean_input($_POST['email']);
$state = clean_input($_POST['state']);
$country = clean_input($_POST['country']);
$website = clean_input($_POST['website']);
// file details
$fileName = $_FILES['school_logo']['name'];
$fileSize = $_FILES['school_logo']['size']/1024;
$fileTemp = $_FILES['school_logo']['tmp_name'];
$fileError = $_FILES['school_logo']['error'];
$ext = explode(".", $fileName);
$actualExt = strtolower(end($ext));
if ($fileSize> 500) {
$response ='<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
<strong>IMAGE SIZE ERROR!</strong> Your Image size should be less than 500KB. <b class="text-info"> <small> Detected file Size is '.number_format($size,2).' KB</small></b>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}elseif (empty($school_name) || empty($motto) || empty($director) || empty($first_address) || empty($phone) || empty($email)) {
$response =' <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
<strong> INVALID FORM SUBMISSION !</strong> Please Check your Input. <b class="text-info"> <span> And try again...</span></b>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}elseif ($fileError!=0) {
$response =' <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
<strong> UPLOAD ERROR!</strong> There was an error Uploading Your Image. <b class="text-info"> <span> And try again...</span></b>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
# code...
$response =' <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
<strong> INVALID EMAIL ADDRESS!</strong> Please enter a Valid Email address. <b class="text-info"> <span> And try again...</span></b>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}
else{
require_once ("inc-files/dbconn.php");
$fileName = "logo_".time().".".$actualExt;
$destinationFolder = "files/assets/images/".$fileName;
//query to update the school profile details
// 3. Prepare the SQL query
$query = $dbh->prepare("UPDATE school_profile SET name=?, motto=?, director=?, phone=?, mobile=?, school_email=?, address_one=?, address_two=?, state=?, country=?, logo=?, website=? WHERE id=?");

try {
    // 4. Execute the query with the bound parameters
    $params = array(
        $school_name, 
        $motto, 
        $director, 
        $phone, 
        $mobile, 
        $email, 
        $first_address, 
        $second_address, 
        $state, 
        $country, 
        $fileName, 
        $website, 
        $id
    );
    
    if ($query->execute($params)) {
        echo "Record updated successfully!";
    } else {
        echo "Failed to update record.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
if ($query) {
if (move_uploaded_file($fileTemp, $destinationFolder)) {
$response ='<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
<strong> SUCCESS </strong> School Details Updated Successfully
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div> ';
}else{
$response =' <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
<strong> UPLOAD ERROR!</strong> There was an error Moving Your Image to Folder. <b class="text-info"> <span> And try again...</span></b>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}

}else{
$response =' <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
<strong> INTERNAL SERVER ERROR !</strong> There was an error updating school Details. <b class="text-info"> <span> And try again...</span></b>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}
}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Medical School Fee Management </title>
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
<h4 class="text-center text-primary">SCHOOL SETTINGS</h4>

</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class="breadcrumb-title">
<li class="breadcrumb-item"  style="float: left;">
<a href="index.php"> <i class="feather icon-home"></i> </a>
</li>
<li class="breadcrumb-item"  style="float: left;"><a href="#!">School Info</a> </li>
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
<form class="form" method="POST" action="" enctype="multipart/form-data">
<div class="text-center">
<?php echo ($response!="")? $response:'';?>
</div>
<h3 class="text-center bg-dark text-white-50"> UPDATE YOUR SCHOOL PROFILE DATA</h3>
<fieldset>
<div class="form-group">
<div class="col-sm-12">
<label for="director"
    class="block">School Director
    *</label>
</div>
<input type="hidden" name="id" value="<?php echo $school_details['id']?>">
<div class="col-md-12">
<input id="director"
    name="director" type="text"
    class="form-control" value="<?php echo $school_details['director']?>">
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label for="school_name"
    class="block">School Name
    *</label>
</div>
<div class="col-md-12">
<input id="school_name"
    name="school_name" type="text"
    class="form-control" value="<?php echo $school_details['name']?>">
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label for="motto"
    class="block">Motto
    *</label>
</div>
<div class="col-md-12">
<input id="motto"
    name="motto" type="text"
    class="form-control"value="<?php echo $school_details['motto']?>">
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label for="first_address"
    class="block">School Address 
    *</label>
</div>
<div class="col-sm-12">
<input id="first_address"
    name="first_address"
    type="text"
    class="form-control" value="<?php echo $school_details['address_one']?>">
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label for="second_address"
    class="block">School Two Address (If Any)
    *</label>
</div>
<div class="col-sm-12">
<input id="second_address"
    name="second_address"
    type="text"
    class="form-control" value="<?php echo $school_details['address_two']?>">
</div>
</div>

<div class="form-group">
<div class="col-sm-12">
<label for="mobile"
    class="block">Mobile
    *</label>
</div>
<div class="col-sm-12">
<input id="mobile"
    name="mobile"
    type="text"
    class="form-control" value="<?php echo $school_details['mobile']?>">
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label for="phone"
    class="block">Phone
    *</label>
</div>
<div class="col-sm-12">
<input id="phone"
    name="phone"
    type="text"
    class="form-control" value="<?php echo $school_details['phone']?>">
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label 
    class="block">School Email Address
    *</label>
</div>
<div class="col-sm-12">
<input
    name="email"
    type="text"
    class="form-control" value="<?php echo $school_details['school_email']?>">
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label for="state"
    class="block">State 
    *</label>
</div>
<div class="col-sm-12">
<select id="state"
    name="state"
    class="form-control ">
    <option value=""selected><?php echo $school_details['state']?></option>
    <?php
displayStateOfOrigin($dbh);
        ?>
</select>
</div>
</div>
<div class="form-group">
<div class="col-sm-12">
<label for="country"
    class="block">Country
    *</label>
</div>
<div class="col-sm-12">
<input id="country"
    name="country"
    type="text"
    class="form-control" readonly value="<?php echo $school_details['country']?>">
</div>
</div>

</fieldset>

<h3>SECTION B: LOGO & FAVICON </h3>
<fieldset>
<div class="form-group">
<div class="col-sm-12">
<label for=""
    class="block">School Website
    *</label>
</div>
<div class="col-sm-12">
<input 
    name="website"
    type="text"
    class="form-control" value="<?php echo $school_details['website']?>">
</div>
</div>


<div class="form-group">
<div class="col-sm-12">
<label for="school_logo"
    class="block">Your Logo
    *</label>
</div>
<div class="col-md-12">
<input type="file" accept=".jpg,.png"
    class="form-control form-control-file" name="school_logo">
</div>
</div>
<center>
<div class="logo mb-3">

<img class="img-fluid" src="<?php echo fetchLogo(); ?>"
alt="logo" width="150" style="border:1px solid maroon;border-radius:10px;position:center">

</div>
</center>



</fieldset>


<div class="form-group row">
<div class="col-sm-12">
<label class="block"></label>
</div>
<div class="col-sm-12">
<button type="submit" name="submit-school-profile-detail" class="btn btn-dark btn-block">Update Profile</button>
</div>
</div>
</form>

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
<script src="schoolprofileupdate.js"></script>
</body>

</html>