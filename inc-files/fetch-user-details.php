<?php 

require_once ("dbconn.php");
require_once "functions.php";
if (isset($_POST['action']) && $_POST['action'] ==="fetch-users") {
   $question_id = $_POST['getId'];
		$query = $dbh->prepare("SELECT * FROM administrator WHERE user_id=? LIMIT 1");
		$query->execute(array($question_id));
		if ($query->rowCount()>0) {
			# code...
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$data = $result;
			echo json_encode($data);
		}
}
?>