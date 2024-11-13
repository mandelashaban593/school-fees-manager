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
    <!-- testing login code -->


    <?php 
    /*
    use PHPMailer\PHPMailer\PHPMailer;
require_once ("PHPMailer/Exception.php");
require_once ("PHPMailer/PHPMailer.php");
require_once ("PHPMailer/SMTP.php");
require_once ("mail_config.php");
$mail = new PHPMailer(true);
 $response ="";
if (isset($_POST['submit_btn'])) {
    # code...
    require_once ("dbconn.php");
    require_once ("functions.php");

    $username = clean_user_input($_POST['username']);
    $password = clean_user_input($_POST['passwrd']);
    $IpAddress = userIpAddress();
    if (empty($username) || empty($password)) {
        # code...
         $response = "Empty form detected";
    }else{
        //check for user details in db 
        $check = $dbh->prepare("SELECT * FROM marketer_account WHERE (email=? OR username=?) LIMIT 1");
        $check->execute(array($username,$username));
        if ($check->rowCount()>0) {
            # code...
            $result = $check->fetch(PDO::FETCH_OBJ);
            $status = $result->id;
            $cEmail = $result->email;
            $cUsername = $result->username;
            $queryCheck = $dbh->prepare("SELECT * FROM check_marketer_token WHERE username=? AND email=? AND token<>? LIMIT 1");
            $zero ='';
            $queryCheck->execute(array($cUsername,$cEmail,$zero));
            if ($queryCheck->rowCount()==1) {
                # code...
                 //check if already logged in in another device

            $sessionToken = generateSessionToken();
            $updateUser = $dbh->prepare("UPDATE marketer_account SET login_log=NOW(),online=1 WHERE id='$status'");
            if ($updateUser->execute()) {
               $_SESSION['marketer_id'] = $status;
               $_SESSION['marketer_token'] = $sessionToken;
               $response = "<p class='alert alert-success text-center'>Login Successful <span class='text-primary'> Please wait...</span></p> 
               <script>
               setTimeout(()=>{
                   window.location.href='marketer-dashboard.php';
               },3000);
               </script>
               
               ";
            }else{
                $response= "<p class='alert alert-danger text-center'>Error Occure Please try again</p>";
            }
            }else{
            $stmt = $dbh->prepare("INSERT INTO check_marketer_token (username,email,token,token_time) VALUES ();");
            }
            
        }else{
             $response= "<p class='alert alert-danger text-center'>This account does not Exists</p>";
        }
    }
    echo $response;
    unset($dbh);
}

    */

