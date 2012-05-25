<?
include("DB.php");
$DB = DB::Open();

$query="SELECT * FROM questions_answers ORDER BY answer_group";
$questions = $DB->qry($query); 
$num = $DB->qry_row_num($questions);

$query="SELECT ID, NAME FROM companies WHERE ACTIVE = 'A'";
$companies = $DB->qry($query);
$num_companies = $DB->qry_row_num($companies);

echo "<b><center>Database Output</center></b><br><br>";

$test_on = htmlspecialchars($_GET["test_on"]);
if ($test_on == "true") {
	echo "test is on: ".$test_on."<br><br>";
}

?>
<script type='text/javascript'>
function validate(form){
	if (form.title.value.trim() == '') {
		alert('Please enter the title!');
		form.title.focus();
		return;
	}

	if (form.name.value.trim() == '') {
		alert('Please enter the tester name!');
		form.name.focus();
		return;
	}

	if (form.email.value.trim() == '') {
		alert('Please enter the email!');
		form.email.focus();
		return;
	}

	if (!validateEmail(form.email.value)){
		form.email.focus();
		return;
	}
	
	if (form.company_id.value == 0) {
		alert('Please select the company!');
		form.company_id.focus();
		return;
	}

	if(validateQuestions()){
		alert('Please answer all questions!');
		return;
	}

	form.submit();
}

function validateEmail(value)
{
	var atpos=value.indexOf("@");
	var dotpos=value.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=value.length)  {
	  alert("Not a valid e-mail address!");
	  return false;
	}

	return true;
}
	
function validateQuestions() {

	//answer3
	
	return false;
}
</script>

<form action="insert.php" method="post" name="send_questions" id="send_questions">
Title: <input type="text" name="title"><br>
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
Company: <select name="company_id">
<option value="0">(select your company)</option>
<?
$i=0;
while ($i < $num_companies) {
	$company_id=mysql_result($companies,$i,"id");
	$company_name=mysql_result($companies,$i,"name");
	?>
	<option value="<? echo "$company_id"; ?>"><? echo "$company_name"; ?></option>
	<?
	++$i;
}
?>

</select>

<hr>
<p>
<input type="button" onClick="validate(document.send_questions);" value="Send your anwsers">
<p>

<table border="1" cellspacing="2" cellpadding="2">
<tr bgcolor="orange"> 
<th><font face="Arial, Helvetica, sans-serif">Question</font></th>
<th colspan="2" ><font face="Arial, Helvetica, sans-serif">Answer</font></th>
</tr>

<?
$i=0;
$temp_answer_group;
while ($i < $num) {
	$id=mysql_result($questions,$i,"id");
	$id_strategic_management=mysql_result($questions,$i,"id_strategic_management");
	$id_leadership=mysql_result($questions,$i,"id_leadership");
	$answer_group=mysql_result($questions,$i,"answer_group");
	$question=mysql_result($questions,$i,"question");
	
	if ($i%2 ==0) {
		$choice = "a";
		$row_color = "";
	} else {
		$choice = "b";
		$row_color = "gray";
	}
?>
<tr bgcolor="<?php echo "$row_color"; ?>"> 
<td><font face="Arial, Helvetica, sans-serif">
	<? if ($temp_answer_group != $answer_group)
			echo "$answer_group"; 
	?>
	</font></td>

<!-- 	
<td><font face="Arial, Helvetica, sans-serif"><? echo "$id_strategic_management"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><? echo "$id_leadership"; ?></font></td>
 -->
 
<td><font face="Arial, Helvetica, sans-serif"><? echo "$question"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif">
	<input type="hidden" name="choice<? echo "$id"; ?>" value="<? echo "$choice"; ?>" />
	<input type="hidden" name="strategic_management<? echo "$answer_group"; ?>_<? echo "$choice"; ?>" value="<? echo "$id_strategic_management"; ?>" />
	<input type="hidden" name="leadership<? echo "$answer_group"; ?>_<? echo "$choice"; ?>" value="<? echo "$id_leadership"; ?>" />
	<input type="radio" name="answer<? echo "$answer_group"; ?>" value="<? echo "$id"; ?>" 
	<?php
		if ($test_on == "true" && ($i % 2 ==0)) {
			echo "checked='checked'";
		} 
	?>
	 >
</font></td>
</tr>
<?
++$i;
$temp_answer_group = $answer_group;
} 
?>
</table>
<p>
<input type="button" onClick="validate(document.send_questions);" value="Send your anwsers">
</form>