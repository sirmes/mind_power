<?
include("dbinfo.inc.php");
mysql_connect("127.0.0.1",$username,$password);
@mysql_select_db($database) or die( "Unable to select database"); 

//$query = "INSERT INTO contacts VALUES ('','$first','$last','$phone','$mobile','$fax','$email','$web')";
//mysql_query($query);

$title = $_POST["title"];
$name = $_POST["name"];
$email = $_POST["email"];

echo "Received: $title, $name, $email <br>";

//Create tester record
$query = "INSERT INTO TESTERS VALUES ('', '$title','$name','$email')";
$result = mysql_query($query);

if ($result) {
	echo "Tester info stored in DB<br>";
	
	$query = "SELECT MAX(ID) AS ID FROM TESTERS";
	$result = mysql_query($query);
	
	$id_tester=mysql_result($result,0,"id");
	
	echo "Current tester id is: $id_tester<br>";
	
	//TODO: Needs to find out a way to get the answers
	$query = "INSERT INTO ANSWERS VALUES ('', '$id_tester','$id_tester')";
	$answers_created = mysql_query($query);
	
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

