<?php 

session_start();
date_default_timezone_set("Africa/Lagos");
require_once "inc-files/dbconn.php";

require_once "inc-files/functions.php";
checkSessionID();
?>

<?php 

$responseText ="";
if (isset($_POST['submit-session-btn'])) {
    # code...
    require_once ("inc-files/dbconn.php");
    $POST = filter_var_array($_POST,FILTER_SANITIZE_STRING);
    $school_session = $POST['school_session'];

      if (empty($school_session)) {
          $responseText ="<p class='alert alert-danger text-center'>Invalid Session Entry <span class='text-warning'>Please Check your input...</span></p>";
      }else{
          $id =1;
          $cTerm = "First Term";
          $query = $dbh->prepare("UPDATE academic_session SET school_session=?,current_term=? WHERE id=?");
      
        if ($query->execute(array($school_session,$cTerm,$id))) {
            # code...
            $responseText ="<p class='alert alert-success text-center'>".$school_session." is now the Current Academic Session!</p>";
        }else{
             $responseText ="<p class='alert alert-danger text-center'>There was an Error Creating ".$school_session." Academic Session! <span class='text-info'>Please try again...</span></p>";
        }
      }
}


$response ="";
if (isset($_POST['submit-btn-term'])) {
    # code...
    require_once ("inc-files/dbconn.php");
    $term =  $_POST['current_term'];
    $_session = fetchSchoolSession();
    if (!empty($term)) {
        //check if the name already created
        $check = $dbh->prepare("SELECT * FROM `academic_session` WHERE current_term=? AND school_session=? LIMIT 1");
        $check->execute(array($term,$_session));
        if ($check->rowCount() > 0) {
            # code...
            $response ="<p class='alert alert-danger text-center'>This Term is already Active for <b class='text-info'>$_session</b> !</p>";
        }else{
            //insert the component
            $d_id = 1;
            $query = $dbh->prepare("UPDATE academic_session SET current_term=? WHERE id=?");
           if ( $query->execute(array($term,$d_id))) {
               # code...
               $response ="<p class='alert alert-success text-center'>".$term." is now set as Current Term for ".$_session." Academic Session!</p>";
           }else{
               $response ="<p class='alert alert-danger text-center'> Internal Server Error Occured! Try again..</p>";
           }
        }
    }else{
$response ="<p class='alert alert-danger text-center'> Please Select the Term you want to Navigate to</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Osotech School Fee Management Software </title>
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
    <link rel="stylesheet" type="text/css" href="files/bower_components/chartist/dist/chartist.css">
    <!-- C3 chart -->
    <link rel="stylesheet" href="files/bower_components/c3/css/c3.css" type="text/css" media="all">
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
                                                        <h4>Manage Term And Session</h4>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item"  style="float: left;">
                                                            <a href="index.php"> <i class="feather icon-home"></i> </a>
                                                        </li>
                                                        <li class="breadcrumb-item"  style="float: left;"><a href="#!">Session</a> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->
                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-xl-5">
                                                <!-- Sales and expense card start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="text-center text-info">Declare Academic Session</h5>
                                                        <form action="" method="post">
                                                            <div class="form-group">
                                                                <label for="school_session"></label>
                                                                <input type="text" name="school_session"  class="form-control">
                                                            </div>
                                                            
                                                            <button class="btn btn-primary btn-block" name="submit-session-btn">Submit Session</button>
                                                        </form>
                                                        <br />
                                                        <div class="text-center">
                                                            <?php if (isset($responseText) && !empty($responseText)) {
                                                                # code...
                                                                echo $responseText;
                                                            }?> </div>
                                                    </div>
                                                   
                                                </div>
                                                <!-- Sales and expense card end -->
                                            </div>
                                            <div class="col-xl-5">
                                                <!-- Sales and expense card start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="text-center text-info">Activate Current Term</h5>
                                                        <form action="" method="post">
                                                           
                                                            <div class="form-group">
                                                                <label for="_session">Academic Session</label>
                                                               <input class="form-control" type="text" value="<?php echo fetchSchoolSession();?>" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="current_term">Select Active Term</label>
                                                                <select id="current_term" class="form-control" name="current_term">
                                                                    <option value="">--select--</option>
                                                                    <option value="First Term">First Term</option>
                                                                    <option value="Second Term">Second Term</option>
                                                                    <option value="Third Term">Third Term</option>
                                                                </select>
                                                            </div>
                                                            <button class="btn btn-warning btn-block" name="submit-btn-term" type="submit" onclick="return confirm('Are you Sure? This action CANNOT be UNDO!');">Simulate Term</button>
                                                        </form>
                                                        <br />
                                                        <div class="text-center">
                                                            <?php if (isset($response) && !empty($response)) {
                                                                # code...
                                                                echo $response;
                                                            }?> </div>
                                                    </div>
                                                   
                                                </div>
                                                <!-- Sales and expense card end -->
                                            </div>
                                            <div class="col-xl-12 col-md-12">
                                                <!-- Sales, Receipt and Dues card start -->
                                               
                                                <div class="card">
                                                    
                                                    <div class="card-header">
                                                        <h5>School Academic Information</h5>

                                                    </div>
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table table-lg table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>School Session</th>
                                                                        <th>Current Term</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                    //fetch all the component of fee 
                                                                    require_once ("inc-files/dbconn.php");
                                                                    $stmt =$dbh->query("SELECT * FROM academic_session WHERE id=1");
                                                                    if ($stmt->rowCount()>0) {
                                                                        # code...
                                                                        while($rows = $stmt->fetch()){
                                                                            $comp_id=$rows->id;
                                                                            ?>
                                                                        <tr>
                                                                        <td><?php echo $rows->school_session;?></td>
                                                                        <td><?php echo $rows->current_term;?></td>
                                                                    </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Sales, Receipt and Dues card end -->
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

    <!-- edit component -->
     <div class="modal fade" id="large-Modal-edit-component" tabindex="-1"
role="dialog">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Edit Component</h4>
        <button type="button" class="close"
            data-dismiss="modal"
            aria-label="Close">
            <span
                aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
               <form>
                   <div class="form-group">
                       <input type="hidden" id="edited_id">
                       <input type="text" class="form-control" id="editmyComponent">
                   </div>
                    <button type="button" id="saveBtn"
            class="btn btn-primary waves-effect waves-light">Save
            changes</button>
       </form>
       
    
    </div>
    <div class="modal-footer">
        <button type="button"
            class="btn btn-default waves-effect "
            data-dismiss="modal">Close</button>
       
    </div>
</div>
</div>
</div>
    <!-- edit component ends here -->

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

    
    <!-- chart Custom js -->
   

    <!-- Custom js -->
    <script src="files/assets/js/pcoded.min.js"></script>
    <script src="files/assets/js/vartical-layout.min.js"></script>
    <script src="files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="files/assets/js/script.js"></script>
    <script>
        $(document).ready(function(){
            $(".editBtnNow").on("click", function(){
                let com_id = $(this).data("id");
                console.log(com_id);
                $.ajax({url:"fetchCom.php",
                type:"POST",
                dataType:"json",
                data:{comp_id:com_id},
                success:function(data){
                    $("#large-Modal-edit-component").modal('show');
                    $("#editmyComponent").val(data.desc_name);
                    $("#edited_id").val(data.id);
                }
                })
            })

            //saved the edited component 
            //if save btn is clicked 
            $("#saveBtn").on("click", function(event){
                event.preventDefault();
                let componentName = $("#editmyComponent").val();
                let id = $("#edited_id").val();
                //send to server 
                 $.ajax({url:"updateComponent.php",
                type:"POST",
                data:{id:id,
                    componentName:componentName},
                success:function(data){
                    $("#large-Modal-edit-component").modal('hide');
                   setTimeout(function(){
                       self.location.reload();
                   },2000);
                }
                })
            })
        })
    </script>
</body>

</html>