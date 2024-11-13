<?php 
require_once "inc-files/dbconn.php";
 require_once ("inc-files/functions.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Osotech School Fee Management Software</title>
    
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
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
</head>

<body class="fix-menu bg-dark" style="background:url('files/assets/images/breadcrumb-bg.jpg'); background-repeat:no-repeat;">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center page-header">
                        <h1 class="text-center"> School Fee Management System</h1>
                    </div>
                    <!-- Authentication card start -->
                    <form class="md-float-material form-material">
                        <div class="text-center">
                            <img src="<?php echo fetchLogo();?>" width="150" alt="logo.png">
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                              
                                <h3 class="text-muted text-center p-b-5">Sign in to your account</h3>
                                <div class="text-center" id="response">
                                  
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" id="username" autocomplete="off" class="form-control"
                                        placeholder="Username">
                                   
                                </div>
                                <div class="form-group form-primary">
                                    <input type="password" id="password" autocomplete="off" class="form-control" 
                                        placeholder="Password">
                                    
                                </div>
                                 <div class="form-group form-primary">
                                       <label for="userType" style="color:red;">Login As</label>
                                       <select id="userType" class="form-control">
                                           <option value="">--Select User--</option>
                                           <option value="1">Cashier</option>
                                           <option value="2">Director</option>
                                       </select>
                                 
                                    
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox">
                                                <span class="cr"><i
                                                        class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="forgot-phone text-right f-right">
                                            <a href="javascript:void(0);" class="text-right f-w-600"> Forgot
                                                Password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="button"
                                            class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20 logBtn" id="loginBtn" value="submitBtnLog">LOGIN</button>

                                    </div>
                                </div>
                                <p class="text-inverse text-left">For your School Management Application <a
                                        href="https://businessapp.com.ng/contact"> <b class="f-w-600"> Contact Us </b></a> BusinessApp</p>
                            </div>
                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- Authentication card end -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
        </div>
        <footer></footer>
        <!-- end of container-fluid -->
    </section>
    
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
    <script type="text/javascript" src="files/assets/js/common-pages.js"></script>
    <script>
        $(document).ready(function(){
            $('.logBtn').on("click", function(){
              
                let username = $("#username").val();
                let userType = $("#userType").val();
                let password = $("#password").val();
                let submit = $(".logBtn").val();
                $.ajax({
                    url:"inc-files/login_user.php",
                    type:"POST",
                    data:{
                        userType:userType,
                        username:username,
                        password:password,
                        submit:submit
                    },
                    beforeSend:function(){
                     $("#loginBtn").html("Please wait...");
                    },
                    success:function(data){
                        setTimeout(() => {
                           $("#loginBtn").html("LOGIN");
                           $("#response").html(data); 
                        }, 1000);
                    }
                })
            })
        })
    </script>
</body>

</html>