<?
include("DB.php");
$DB = DB::Open();

$title = $_POST["title"];
$name = $_POST["name"];
$email = $_POST["email"];
$id_company = $_POST["company_id"];
$answer_ids = array();

$query = "SELECT DISTINCT ANSWER_GROUP FROM questions_answers ORDER BY 1";
$result = $DB->qry($query);
while ($row = mysql_fetch_assoc($result)) {
	$value = $row['ANSWER_GROUP'];
	$answer_id = $_POST['answer'.$value.''];
	
	array_push($answer_ids, $answer_id);
}

echo "<hr>";
echo "Received: $title, $name, $email, $id_company<br>";
echo "Answer ids came from previous page:";
print_r( $answer_ids);
echo "<hr>";

echo "Going to store tester data into DB <br>";
//Create tester record
$query = "INSERT INTO testers VALUES ('', $id_company, '$title','$name','$email')";
$result = $DB->qry($query);
echo "Tester info stored in DB: $result <br>";
echo "<hr>";

if ($result) {
	echo "Going to store answers into DB<br>";
	
	$query = "SELECT MAX(ID) AS ID FROM testers WHERE EMAIL = '$email'";
	$max_tester_id = $DB->qry($query, 3);
	
	echo "Current tester id is: $max_tester_id <== <br>";
	echo "<hr>";
	
	$answers_created;
	foreach ($answer_ids as $current_answer_id) {
		echo "current question id: $current_answer_id <br>";
		$query = "INSERT INTO testers_answers VALUES ('', $current_answer_id, $max_tester_id)";
		$answers_created = $DB->qry($query);
	}
	
	if ($answers_created) {
		//All good!
		echo "All answers stored in DB<br>";
	}
	else {
		echo "Answers could not be stored in DB<br>";
	}	
}
else {
	echo "Tester info could not be stored in DB<br>";
}

echo "<hr>";
echo "Assessement process completed"
?> 

