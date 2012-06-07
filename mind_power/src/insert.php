<?
include("DB.php");
$DB = DB::Open();

$print_message_on = false;

function print_message($message, $print_message_on) {
	if($print_message_on)
		echo "$message <br>";
}

$title = htmlspecialchars($_POST["title"]);
$name = htmlspecialchars($_POST["name"]);
$given_names = htmlspecialchars($_POST["given_names"]);
$gender = htmlspecialchars($_POST["gender"]);
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
// 	print_message("choice: $choice, questions: $value, st: $strategic_management_id, leadership: $leadership_id, count: $count - Answer: $answer_id<br>", $print_message_on);
	
	$leadership[$leadership_id]["leadership_count"] = $count; 
	
	array_push($answer_ids, $answer_id);
}

// print_message("Printing leadership values = >", $print_message_on); print_r($leadership);
// print_message("Printing leadership values with percentages = >", $print_message_on); print_r($leadership);

print_message("<hr>", $print_message_on);
print_message("Received: $title, $name, $given_names, $gender, $email, $id_company<br>", $print_message_on);
print_message("Answer ids came from previous page:", $print_message_on);
// print_r( $answer_ids);
print_message("<hr>", $print_message_on);

print_message("Going to store tester data into DB <br>", $print_message_on);
//Create tester record

$time = time();
$token = crypt($name.$email.rand(1,100).$time, '_J9..mind');
$query = "INSERT INTO testers VALUES ('', $id_company, '".
										str_replace('"','\'',$title)."','".
										str_replace('"','\'',$name)."','".
										str_replace('"','\'',$given_names)."','".
										str_replace('"','\'',$gender)."','".
										str_replace('"','\'',$email)."', SYSDATE(),'". 
										str_replace('"','\'',$token)."')";

$result = $DB->qry($query);
print_message("Tester info stored in DB: $result <br>", $print_message_on);
print_message("<hr>", $print_message_on);

if ($result) {
	print_message("Going to store answers into DB<br>", $print_message_on);
	
	$query = "SELECT MAX(ID) AS ID FROM testers WHERE EMAIL = '$email'";
	$max_tester_id = $DB->qry($query, 3);
	
	print_message("Current tester id is: $max_tester_id <== <br>", $print_message_on);
	print_message("<hr>", $print_message_on);
	
	$answers_created;
	foreach ($answer_ids as $current_answer_id) {
// 		print_message("current question id: $current_answer_id <br>", $print_message_on);
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
	
// 		print_message("current leadership id: $max_tester_id, $id_strategic_management, $id_leadership, $leadership_count, $leadership_percentage <br>", $print_message_on);
		$query = "INSERT INTO testers_answers_counts VALUES ('', $max_tester_id, $id_strategic_management, $id_leadership, $leadership_count, $leadership_percentage)";
// 		print_message("SQL: => $query", $print_message_on);
		$answers_counts_created = $DB->qry($query);
	}
	
	if ($answers_created) {
		//All good!
		print_message("All answers stored in DB<br>", $print_message_on);
	}
	else {
		print_message("Answers could not be stored in DB<br>", $print_message_on);
		DIE("ERROR SAVING ANSWERS INTO DB");
	}	
}
else {
	print_message("Tester info could not be stored in DB<br>", $print_message_on);
	DIE("ERROR SAVING TESTER INFO INTO DB");
}

print_message("<hr> Assessement process completed", $print_message_on);

ob_start();
header("location: index_ext.php?id_tester=$max_tester_id");
ob_end_flush();

?> 

