<?
include("../DB.php");
$DB = DB::Open();

$query="SELECT NAME, EMAIL FROM TESTERS";
$testers = $DB->qry($query);

$num_testers = $DB->qry_row_num($testers);

echo "<b><center>testers</center></b><br><br>";

?>

<form action="show_tester_report.php" method="post" name="tester_form">
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
	<td><font face="Arial, Helvetica, sans-serif">
	 	Tester name: <select name="testers_id">
					<?
					$i=0;
					while ($i < $num_testers) {
						$testers_id = mysql_result($testers,$i,"id");
						$testers_name = mysql_result($testers,$i,"name");
						$testers_email = mysql_result($testers,$i,"email");
						?>
							<option value="<? echo "$testers_id"; ?>"><? echo "$testers_name"; ?> - <? echo "$testers_email"; ?> </option>	
						<?
						++$i;
					}
					?>
			</select>
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="button" value="Show report" onclick="tester_form.submit();"/></font>
		</td>
	</tr>
</table>
<p>
</form>