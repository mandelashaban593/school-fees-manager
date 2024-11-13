<?php 
// echo json_encode(['sname'=>"samson","fname"=>"omooluwa"]);
// die();

require_once ("dbconn.php");
require_once "functions.php";
if (isset($_POST['sid'])) {
   $question_id = $_POST['sid'];
		$query = $dbh->prepare("SELECT * FROM students WHERE student_id=? LIMIT 1");
		$query->execute(array($question_id));
		if ($query->rowCount()>0) {
			# code...
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$data = $result;
			echo json_encode($data);
		}
}

if (isset($_POST['action']) && $_POST['action'] ==="fetch") {
   $qid = $_POST['getId'];
		$query = $dbh->prepare("SELECT * FROM students WHERE student_id=? LIMIT 1");
		$query->execute(array($qid));
		if ($query->rowCount()>0) {
			# code...
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$data = $result;
			echo json_encode($data);
		}
}

if (isset($_POST['fetch_payee']) && $_POST['fetch_payee'] ==="fetchNow") {
   $payee_id = $_POST['payee_id'];
		$query = $dbh->prepare("SELECT * FROM students INNER JOIN individual_fee ON students.student_id=individual_fee.student_id WHERE students.student_id=? LIMIT 1");
		$query->execute(array($payee_id));
		if ($query->rowCount()>0) {
			# code...
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$data = $result;
			echo json_encode($data);
		}
}