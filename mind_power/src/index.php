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

<form action="insert.php" method="post">
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
<input type="Submit" value="Send your anwsers">
<p>

<table border="1" cellspacing="2" cellpadding="2">
<tr> 
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
	
	
?>
<tr> 
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
	<input type="hidden" name="strategic_management<? echo "$answer_group"; ?>" value="<? echo "$id_strategic_management"; ?>" />
	<input type="hidden" name="leadership<? echo "$answer_group"; ?>" value="<? echo "$id_leadership"; ?>" />
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
<input type="Submit" value="Send your anwsers">
</form>