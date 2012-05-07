<?
include("../DB.php");
$DB = DB::Open();

$action = $_POST['action'];

// echo "action: $action <br>";

$score_id = $_POST['score_id'];
	
//echo "In change, score id: $score_id <br>";
if (strcmp($action,"C") == 0 && $score_id != '') {
	//Update
	$change_score_value = $_POST['change_score_value'.$score_id.''];
	
	$query="UPDATE average_score SET score='$change_score_value' WHERE ID = $score_id";
	
	//echo "SQL => $query <br>";
	
	$result = $DB->qry($query);
	
	if ($result == 1)
		echo "Average score updated";
	else 
		echo "Average score was not updated. Result code is: " + $result;
}
	
$query="SELECT * FROM average_score";
$score = $DB->qry($query);

$num_score = $DB->qry_row_num($score);

echo "<b><center>Average score</center></b><br><br>";

?>

<script type='text/javascript'>
function setAction(elem, action){
	elem.value = action;
	document.score.submit();
}

function setScore_id(score_id){
	var elem = document.getElementById('score_id');
	elem.value = score_id;
}
</script>

<form action="average_score.php" name="score" id="score" method="post">
<input type="hidden" name="action" id="action" value="" />
<input type="hidden" name="score_id" id="score_id" value="" />
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
<th><font face="Arial, Helvetica, sans-serif">Status *</font></th>
</tr>
<?
$i=0;
while ($i < $num_score) {
	$score_id = mysql_result($score,$i,"id");
	$score_value = mysql_result($score,$i,"score");
	?>
	<tr> 
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="text" name="change_score_value<? echo "$score_id"; ?>" value="<? echo "$score_value"; ?>" /></font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="button" value="Change" onclick="setScore_id('<? echo "$score_id"; ?>'); setAction(document.getElementById('action'), 'C')" /></font>
		</td>
	</tr>
	
	<?
	++$i;
}
?>
</table>
<hr>
</form>