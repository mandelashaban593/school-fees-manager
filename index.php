<?php 

session_start();
require_once "inc-files/dbconn.php";

require_once "inc-files/functions.php";
$school_session = fetchSchoolSession();
checkSessionID();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Osotech School Fee Management System</title>
   <?php include ("inc-files/main-index-header-script.php"); ?>
</head>

<body>
    <!-- Pre-loader start -->
    <?php include ("inc-files/preloader.php"); ?>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
          <!-- navbar top will be here -->
          <?php include ("inc-files/navbarTop.php"); ?>
          
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">

                   <!-- main sdiebar will be here -->
                   <?php include ("inc-files/main-sidebar.php"); ?>

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                        <div>
                                            <button type="button" class="btn btn-default btn-round mb-2 ml-2 mr-1">Academic Session : <span class="text-success"><b><?php echo fetchSchoolSession();?></b></span></button>
                                            <button type="button" class="btn btn-default btn-round mb-2 ml-2 mr-1">Current Term : <span class="text-danger"><b><?php echo fetchSchoolTerm();?></b></span></button>
                                            <button type="button" class="btn btn-default btn-round mb-2 ml-2 mr-1">Exptected Fee this Term : <span class="text-info"><b>&#8358;<?php echo number_format(expectedSchoolFeeOfAllStudents(),2);?></b></span></button>
                                        </div>
                                         <button type="button" data-toggle="modal"
                                                                    data-target="#large-Modal-adduser" class="btn btn-success btn-md btn-rounded mb-4"> Add New User</button>
                                        <div class="row">
                                           
                                            <!-- task, page, download counter  start -->
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-yellow update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">&#8358;<?php echo number_format(totalPaymentToday(),2);?></h4>
                                                                <h6 class="text-white m-b-0">TODAY PAYMENT</h6>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">&#8358;<?php echo number_format(totalMoneyReceived(),2);?></h4>
                                                                <h6 class="text-white m-b-0">THIS TERM</h6>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-pink update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">&#8358;<?php echo number_format(totalOutstandingBill(),2); ?></h4>
                                                                <h6 class="text-white m-b-0"> OUTSTANDING</h6>
                                                            </div>
                                                          
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">&#8358;<?php echo number_format(totalMoneyReceivedYearly(),2);?></h4>
                                                                <h6 class="text-white m-b-0">THIS SESSION</h6>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- task, page, download counter  end -->
                                           
                                            <div class="col-xl-8 col-md-8">
                                                 
                                                <div class="card table-card">
                                                    <div class="card-header">
                                                        <h5>Recent Payment</h5>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                                <li><i class="feather icon-minus minimize-card"></i>
                                                                </li>
                                                        
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered">
                                                                <thead class="bg-dark">
                                                                    <tr>
                                                                        <th>
                                                                        Student Name
                                                                        </th>
                                                                        <th>Component</th>
                                                                        <th>Date</th>
                                                                        <th>Paid</th>
                                                                        <th>Balance</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                    $sql = $dbh->query("SELECT * FROM payment_history JOIN students ON payment_history.payment_id=students.student_id WHERE payment_history.session='$school_session' ORDER BY history_id DESC LIMIT 10");
                                                                    if ($sql->rowCount()>0) {
                                                                        # code...
                                                                       while ( $dataRow =$sql->fetch()) {?>
                                                                        <tr>
                                                                        <td>
                                                                           <?php echo $dataRow->sname." ".$dataRow->fname;?>
                                                                        </td>
                                                                        <td>School Fee</td>
                                                                        <td><span class="badge badge-info badge-pill"><?php echo $dataRow->payment_date;?></span></td>
                                                                        <td class="text-success">&#8358; <?php echo number_format($dataRow->amount_paid,2);?></td>
                                                                        <td class="text-danger">&#8358; <?php echo number_format($dataRow->rem_bal,2);?></td>
                                                                    </tr>
                                                                       <?php 
                                                                           
                                                                       }
                                                                    }
                                                                    
                                                                    ?>
                                                                   
                                                
                                                                </tbody>
                                                                <tfoot class="bg-dark">
                                                                    <tr>
                                                                        <th>
                                                                        Student Name
                                                                        </th>
                                                                        <th>Component</th>
                                                                        <th>Date</th>
                                                                        <th>Paid</th>
                                                                        <th>Balance</th>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                            <div class="text-center">
                                                                <a href="dt-advance.php" class=" b-b-primary text-primary">View all
                                                                    Payments</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-4">
                                                <div class="card user-activity-card">
                                                    <div class="card-header">
                                                        <h5>Newly Registered Students</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        
                                                        
                                                       <?php
                                                       $stmt = $dbh->query("SELECT * FROM students ORDER BY student_id DESC LIMIT 5");
                                                       if ($stmt->rowCount()>0) {
                                                           # code...
                                                           while ($row = $stmt->fetch()) {?>
                                                           <div class="row m-b-5">
                                                            <div class="col-auto p-r-0">
                                                                <div class="u-img">
                                                                    <img src="student-image/<?php echo $row->passport;?>"
                                                                        alt="user image" class="img-radius cover-img">
                                                                    <img src="student-image/<?php echo $row->passport;?>"
                                                                        alt="user image" class="img-radius profile-img">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <h6 class="m-b-5"><?php echo ucfirst($row->sname." ".$row->fname." ".$row->lname)?></h6>
                                                                <p class="text-muted m-b-0"><b>Admitted To</b> <?php echo $row->admitted_class;?></p>
                                                                <p class="text-muted m-b-0"><i
                                                                        class="feather icon-calendar m-r-10"></i><?php echo date("d-m-Y",strtotime($row->created_at));?>
                                                                </p>
                                                            </div>
                                                        </div> 

                                                           <?php    
                                                           }
                                                       }else{
                                                        echo "No Newly Registered Students";
                                                       }
                                                       
                                                       ?>
                                                        

                                                    </div>
                                                </div>
                                            </div>

                                          

                                            <!-- social download  start -->
                                           
                                            <!-- social download  end -->

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php include("adduser.php");?>

   <?php include ("inc-files/main-index-footer-script.php"); ?>
   
</body>

</html>