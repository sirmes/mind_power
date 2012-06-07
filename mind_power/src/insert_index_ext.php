<?php
include("DB.php");
$DB = DB::Open();

$print_message_on = false;

function print_message($message, $print_message_on) {
	if($print_message_on)
		echo "$message <br>";
}

$id_tester = htmlspecialchars($_POST["id_tester"]);
$mobile = htmlspecialchars($_POST["mobile"]);
$job_title = htmlspecialchars($_POST["job_title"]);
$company_type = htmlspecialchars($_POST["company_type"]);
$country = htmlspecialchars($_POST["country"]);
$industry = htmlspecialchars($_POST["industry"]);
$challenges = htmlspecialchars($_POST["challenges"]);
$goal = htmlspecialchars($_POST["goal"]);
$passcode = htmlspecialchars($_POST["passcode"]);

print_message("$mobile, $job_title, $company_type, $country, $industry, $challenges, $goal, $passcode", $print_message_on);

$query = "INSERT INTO testers_add_more VALUES ('', $id_tester, '".
		str_replace('"','\'',$mobile)."','".
		str_replace('"','\'',$job_title)."','".
		str_replace('"','\'',$company_type)."','".
		str_replace('"','\'',$country)."','".
		str_replace('"','\'',$industry)."','".
		str_replace('"','\'',$challenges)."','".
		str_replace('"','\'',$goal)."','".
		str_replace('"','\'',$passcode)."')";

$result = $DB->qry($query);
print_message("Tester add more info stored in DB: $result <br>", $print_message_on);
print_message("<hr>", $print_message_on);

if ($result) {
	ob_start();
	header("location: thankyou.php");
	ob_end_flush();
}
else {
	DIE("ERROR SAVING TESTER ADD MORE INFO INTO DB");
}


?>