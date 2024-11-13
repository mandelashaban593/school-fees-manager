<?php 

if (isset($_POST['comp_id'])) {
    # code...
    $id = $_POST['comp_id'];
    require_once ("inc-files/dbconn.php");
    $q = $dbh->prepare("SELECT * FROM fee_component WHERE id=?");
    $q->execute(array($id));
    $result =$q->fetch();
    echo json_encode($result);
}

?>