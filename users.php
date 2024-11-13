<?php 
@session_start();
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
                                                        <h4>Users</h4>
                                                        <span>Total Active User</span>
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
                                                        <li class="breadcrumb-item"  style="float: left;"><a href="#!">Users</a>
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
                                         <button type="button" data-toggle="modal"
                                                                    data-target="#large-Modal-adduser" class="btn btn-success btn-md btn-round mb-4"> Add New User</button>
                                        <div class="card">
                                            
                                            <div class="card-header">
                                                <h5>Total Users</h5>
                                                
                                            </div>
                                            <div class="card-block">
                                                <div class="table-responsive dt-responsive">
                                                    <table id="dom-jqry"
                                                        class="table table-striped table-bordered nowrap text-center"
                                                        style="width:100%">
                                                        <thead class="bg-dark text-white">
                                                            <tr>
                                                              
                                                                <th>Ful Name</th>
                                                                <th> Username</th>
                                                                <th> Email</th>
                                                                <th> Role</th>
                                                                <th>Status</th>
                                                                <td> Actions</td>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                             <?php 
                                                            $query = $dbh->query("SELECT * FROM administrator ORDER BY fulname ASC");
                                                            if ($query->rowCount() >0) {
                                                                $cnt =0;
                                                                while ($resultSet = $query->fetch()) {
                                                                    $cnt++;
                                                                    $user_id = $resultSet->user_id;
                                                                    ?>
                                                                    <tr>
                                                                    
                                                                <td><?php echo $resultSet->fulname; ?></td>
                                                                    <td><?php echo $resultSet->username;?></td>
                                                                <td><?php echo $resultSet->email;?></td>
                                                                <td><?php echo $resultSet->user_type;?></td>
                                                                <td> 
                                                                    <?php echo ($resultSet->status==1)? "<span class='badge badge-success badge-lg badge-pill'>Active</span>":"<span class='badge badge-danger badge-lg badge-pill'>Pending</span>" ?>
                                                                </td>
                                                               
                                                                <td> <button type="button" class="btn btn-info EditUserBtn" data-id="<?php echo $user_id; ?>">Edit User</button>
                                                                     <button class="btn btn-outline-warning"><a class="dropdown-item waves-light waves-effect"
                                                                    href="deleUser.php?key=<?php echo base64_encode($resultSet->user_id)?>" >Remove Account</a></button></td>

                                                                <?php
                                                                }
                                                            }
                                                                ?>
                                                           
                                                           
                                                        </tbody>
                                                        <tfoot class="bg-dark">
                                                            <tr> 
                                                               
                                                                <th>Ful Name</th>
                                                                <th> Username</th>
                                                                <th> Email</th>
                                                                <th> Role</th>
                                                                <th>Status</th>
                                                                <td> Actions</td>
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
    <!-- add user modal -->
     <?php include("adduser.php");?>
    <!-- add user modal ends -->

 <!-- Modal -->
 <?php include ("edit-user-modal.php");?>
 <!-- Modal ends -->

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
    <script src="update-users.js"></script>
     <script src="<?php echo ("submit-new-user.js")?>"></script>
    
</body>

</html>