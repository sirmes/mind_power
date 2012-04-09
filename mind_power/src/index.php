<?
include("DB.php");
$DB = DB::Open();

$query="SELECT * FROM questions";
$questions = $DB->qry($query); 
$num = $DB->qry_row_num($questions);

$query="SELECT ID, NAME FROM COMPANIES WHERE ACTIVE = 'A'";
$companies = $DB->qry($query);
$num_companies = $DB->qry_row_num($companies);

echo "<b><center>Database Output</center></b><br><br>";

?>

<form action="insert.php" method="post">
Title: <input type="text" name="title"><br>
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
Company: <select name="company_id">
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
<?//TODO:Add radios or checkbox, need to figure out how ?>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Categories</font></th>
<th><font face="Arial, Helvetica, sans-serif">Groups</font></th>
<th colspan="2" ><font face="Arial, Helvetica, sans-serif">Questions</font></th>
</tr>

<?
$i=0;
while ($i < $num) {
	$id=mysql_result($questions,$i,"id");
	$id_category=mysql_result($questions,$i,"id_category");
	$group_break=mysql_result($questions,$i,"group_break");
	$question=mysql_result($questions,$i,"question");
?>
<tr> 
<td><font face="Arial, Helvetica, sans-serif"><? echo "$id_category"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><? echo "$group_break"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif"><? echo "$question"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif">
	<input type="radio" name="answer<? echo "$group_break"; ?>" value="<? echo "$id"; ?>">
</font></td>
</tr>
<?
++$i;
} 
?>
</table>
<p>
<input type="Submit" value="Send your anwsers">
</form>