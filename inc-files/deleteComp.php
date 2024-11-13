<?php 
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    require_once ("dbconn.php");
    $delQuery = $dbh->prepare("DELETE FROM fee_component WHERE id=? LIMIT 1");
    if($delQuery->execute(array($id))){
header("Location: ../create_component.php?success");
exit(0);
    }

}