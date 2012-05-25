<?
include("DB.php");
$DB = DB::Open();

$title = htmlspecialchars($_POST["title"]);
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$id_company = $_POST["company_id"];
$answer_ids = array();
$total_questions_to_calculate_percentage = 72;

$leadership = array(
		"1" => array("id_strategic_management" => 3, "id_leadership" => 1, "leadership_count" => 0, "leadership_percentage" => 0),
		"2" => array("id_strategic_management" => 1, "id_leadership" => 2, "leadership_count" => 0, "leadership_percentage" => 0),
		"3" => array("id_strategic_management" => 1, "id_leadership" => 3, "leadership_count" => 0, "leadership_percentage" => 0),
		"4" => array("id_strategic_management" => 1, "id_leadership" => 4, "leadership_count" => 0, "leadership_percentage" => 0),
		"5" => array("id_strategic_management" => 2, "id_leadership" => 5, "leadership_count" => 0, "leadership_percentage" => 0),
		"6" => array("id_strategic_management" => 2, "id_leadership" => 6, "leadership_count" => 0, "leadership_percentage" => 0),
		"7" => array("id_strategic_management" => 2, "id_leadership" => 7, "leadership_count" => 0, "leadership_percentage" => 0),
		"8" => array("id_strategic_management" => 3, "id_leadership" => 8, "leadership_count" => 0, "leadership_percentage" => 0),
		"9" => array("id_strategic_management" => 3, "id_leadership" => 9, "leadership_count" => 0, "leadership_percentage" => 0)
		);

$query = "SELECT DISTINCT ANSWER_GROUP FROM questions_answers ORDER BY 1";
$result = $DB->qry($query);
while ($row = mysql_fetch_assoc($result)) {
	$value = $row['ANSWER_GROUP'];
	$answer_id = $_POST['answer'.$value.''];

	$choice = $_POST['choice'.$answer_id.''];
	$leadership_id = $_POST['leadership'.$value.'_'.$choice.''];
	
	$count = $leadership[$leadership_id]["leadership_count"] + 1;
// 	echo "choice: $choice, questions: $value, st: $strategic_management_id, leadership: $leadership_id, count: $count - Answer: $answer_id<br>";
	
	$leadership[$leadership_id]["leadership_count"] = $count; 
	
	array_push($answer_ids, $answer_id);
}

echo "Printing leadership values = >"; print_r($leadership);
echo "Printing leadership values with percentages = >"; print_r($leadership);

echo "<hr>";
echo "Received: $title, $name, $email, $id_company<br>";
echo "Answer ids came from previous page:";
print_r( $answer_ids);
echo "<hr>";

echo "Going to store tester data into DB <br>";
//Create tester record
$token = crypt($name.$email. rand(1,100), 'mind');
$query = "INSERT INTO testers VALUES ('', $id_company, '".
										str_replace('"','\'',$title)."','".
										str_replace('"','\'',$name)."','".
										str_replace('"','\'',$email)."', SYSDATE(),'". 
										str_replace('"','\'',$token)."')";

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
// 		echo "current question id: $current_answer_id <br>";
		$query = "INSERT INTO testers_answers VALUES ('', $current_answer_id, $max_tester_id)";
		$answers_created = $DB->qry($query);
	}

	$answers_counts_created;
	foreach ($leadership as $current_leadership) {
		$id_tester 		= $current_leadership["id_tester"];
		$id_strategic_management	= $current_leadership["id_strategic_management"];
		$id_leadership= $current_leadership["id_leadership"];
		$leadership_count 	= $current_leadership["leadership_count"];
		$leadership_percentage= round(($current_leadership["leadership_count"] / 72) * 100, 2);
	
// 		echo "current leadership id: $max_tester_id, $id_strategic_management, $id_leadership, $leadership_count, $leadership_percentage <br>";
		$query = "INSERT INTO testers_answers_counts VALUES ('', $max_tester_id, $id_strategic_management, $id_leadership, $leadership_count, $leadership_percentage)";
// 		echo "SQL: => $query";
		$answers_counts_created = $DB->qry($query);
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

