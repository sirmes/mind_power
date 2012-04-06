<?
include("dbinfo.inc.php");
mysql_connect("127.0.0.1",$username,$password);
@mysql_select_db($database) or die( "Unable to select database"); 

$title = $_POST["title"];
$name = $_POST["name"];
$email = $_POST["email"];
$id_company = $_POST["company_id"];
$answer_ids = array();

echo "<hr>";
$query = "SELECT DISTINCT GROUP_BREAK FROM QUESTIONS ORDER BY 1";
$groups = mysql_query($query);
while ($row = mysql_fetch_assoc($groups)) {
	
	$group=$row['group_break'];
	echo ">> group_break id: $group <br>";

	$answer_id = $_POST['answer1'];
	echo "Answer id: $answer_id";
			
	array_push($answer_ids, $answer_id);
}
mysql_free_result($groups);

echo "<hr>";
echo "Received: $title, $name, $email, $id_company<br>";
print_r($answer_ids);
echo "<br>";

//Create tester record
$query = "INSERT INTO TESTERS VALUES ('', $id_company, '$title','$name','$email')";
$result = mysql_query($query);

if ($result) {
	echo "Tester info stored in DB<br>";
	
	$query = "SELECT MAX(ID) AS ID FROM TESTERS WHERE EMAIL = '" + $email + "'";
	$max_tester_id = mysql_query($query);
	
	echo "Current tester id before is: $max_tester_id <== <br>";
	
	$tester_id=mysql_result($max_tester_id, 0,"ID");
	mysql_free_result($$max_tester_id);
	
	echo "Current tester id is: $tester_id <== <br>";

	$answers_created;
	foreach ($answer_ids as $current_id) {
		echo "current question id: " + $current_id;
		$query = "INSERT INTO ANSWERS VALUES ('', $current_id, $tester_id)";
		$answers_created = mysql_query($query);
		
	}
	
	if ($answers_created) {
		//All good!
		echo "Answers stored in DB<br>";
	}
	else {
		echo "Answers could not be stored in DB<br>";
	}	
}
else {
	echo "Tester info could not be stored in DB<br>";
}


mysql_close();

echo "Assessement process completed"
?> 

