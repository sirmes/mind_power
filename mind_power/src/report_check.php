<?php

include("DB.php");
$DB = DB::Open();

$error = '';
$print_message_on = false;

function print_message($message, $print_message_on) {
	if($print_message_on)
		echo "$message <br>";
}

$token = htmlspecialchars($_GET["token"]);

print_message("$token", $print_message_on);

if ($token == '') {
	$token = htmlspecialchars($_POST["token"]);
	
	if ($token != '') {
		$passcode = htmlspecialchars($_POST["passcode"]);
	
		print_message("$token, $passcode", $print_message_on);
	
		if ($passcode != '') {
	
			$query = "select t.id from testers t, testers_add_more a ".
					"where t.id = a.id_tester ".
					"	and t.token = '$token'".
					"	and a.passcode = '$passcode'";
	
			$tester_id = $DB->qry($query, 3);
	
			print_message("$tester_id", $print_message_on);
	
			if ($tester_id != '') {
				ob_start();
				header("location: admin/show_tester_report.php?token=$token");
				ob_end_flush();
		}
		else {
			$error = "INVALID TOKEN OR PASSCODE";
		}
	}
		else
		{
			DIE("ERROR PASSCODE WAS NOT INFORMED");
		}
	}
	
}

?>
<html>
<script type="text/javascript">
function validate(form) {
	if (form.token.value.trim() == '') {
		alert('Please close the browser and call again the correct link. If this doesn\'t work, copy and paste the link in the browser.');
		form.passcode.focus();
		return;
	}
	
	if (form.passcode.value.trim() == '') {
		alert('Please enter the passcode you informed when you submitted the report.');
		form.passcode.focus();
		return;
	}

	form.submit();
}
</script>
<body>
<form method="post" name="report_check" action="report_check.php">

<?php
if ($error != '')
	echo "<strong><font color='red'>Passcode informed is invalid.</font></strong><br>";

if ($token == '')
	echo "<strong><font color='red'>URL is invalid. Make sure you have the correct token in link.</font></strong><br>";
?>
<p>
<input type="hidden" name="token" value="<?php echo "$token"; ?>"/>
<input type="text" name="passcode" />
<input type="button" value="Check passcode" onclick="validate(document.report_check);"/>
</form>
</body>
</html>