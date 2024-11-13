<?php
if(isset($_POST['state'])){
  //echo '<option>'.$_POST['state'].'</option>';
  $stateName = $_POST['state'];
  if(!empty($stateName)){
    require_once ("dbconn.php");
    $query = $dbh->prepare("SELECT * FROM states WHERE name ='$stateName' LIMIT 1");
    $query->execute();
    $result = $query->fetch();
    $id = $result->state_id;
    // $data ='<option>--select--</option>';
    $selectloGvt = $dbh->prepare("SELECT * FROM locals WHERE state_id='$id' ORDER BY local_name ASC");
    $selectloGvt->execute();
    while($row = $selectloGvt->fetch()){
      $localname = $row->local_name;
     
      $data='
      <option value="'.$localname.'">'.$localname.'</option>';
        echo $data;
    }
  }

}

 ?>
