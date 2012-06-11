<?
	include("DB.php");
	$DB = DB::Open();

	$query="SELECT * FROM questions_answers ORDER BY answer_group";
	$questions = $DB->qry($query); 
	$num = $DB->qry_row_num($questions);


	$test_on = htmlspecialchars($_GET["test_on"]);
	if ($test_on == "true") {
		echo "test is on: ".$test_on."<br><br>";
	}
?>