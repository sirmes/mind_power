<?
include("../DB.php");
$DB = DB::Open();

$action = $_POST['action'];

// echo "action: $action <br>";

if (strcmp($action,"A") == 0) {
	//Add
	//echo "In add";
	$add_strategic_management_name = $_POST['add_strategic_management_name'];
	$add_strategic_management_status = $_POST['add_strategic_management_status'];

// 	echo "Parameters: $add_strategic_management_name, $add_strategic_management_status";
	
	$query="INSERT INTO strategic_management VALUES ('', '$add_strategic_management_name', '$add_strategic_management_status')";
	$result = $DB->qry($query);
	
// 	echo "strategic_management added: $result";
}
else {
	$strategic_management_id = $_POST['strategic_management_id'];
	
// 	echo "In change, strategic_management id: $strategic_management_id <br>";
	if (strcmp($action,"C") == 0 && $strategic_management_id != '') {
		//Update
		$change_strategic_management_name = $_POST['change_strategic_management_name'.$strategic_management_id.''];
		$change_strategic_management_status = $_POST['change_strategic_management_status'.$strategic_management_id.''];
		
		$query="UPDATE strategic_management SET NAME='$change_strategic_management_name', ACTIVE='$change_strategic_management_status' WHERE ID = $strategic_management_id";
		
// 		echo "SQL => $query <br>";
		
		$result = $DB->qry($query);
		
		if ($result == 1)
			echo "Strategic skillset updated";
		else 
			echo "Strategic skillset was not updated. Result code is: " + $result;
	}
} 
	
$query="SELECT ID, NAME, ACTIVE FROM strategic_management";
$strategic_management = $DB->qry($query);

$num_strategic_management = $DB->qry_row_num($strategic_management);

echo "<b><center>Strategic management</center></b><br><br>";

?>

<script type='text/javascript'>
function setAction(elem, action){
	elem.value = action;
	document.strategic_management.submit();
}

function setStrategic_management_id(strategic_management_id){
	var elem = document.getElementById('strategic_management_id');
	elem.value = strategic_management_id;
}
</script>

<form action="strategic_management.php" name="strategic_management" id="strategic_management" method="post">
<input type="hidden" name="action" id="action" value="" />
<input type="hidden" name="strategic_management_id" id="strategic_management_id" value="" />
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Strategic skillset</font></th>
<th><font face="Arial, Helvetica, sans-serif">Status *</font></th>
<th><font face="Arial, Helvetica, sans-serif"></font></th>
</tr>
<?
$i=0;
while ($i < $num_strategic_management) {
	$strategic_management_id = mysql_result($strategic_management,$i,"id");
	$strategic_management_name = mysql_result($strategic_management,$i,"name");
	$strategic_management_active = mysql_result($strategic_management,$i,"active");
	?>
	<tr> 
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="text" name="change_strategic_management_name<? echo "$strategic_management_id"; ?>" value="<? echo "$strategic_management_name"; ?>" size="60"/></font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
		 	<select name="change_strategic_management_status<? echo "$strategic_management_id"; ?>">
		 		<?  
		 		$active_selected = "";
		 		$inactive_selected = "";
		 		if ($strategic_management_active == 'A')
		 			$active_selected = "selected='selected'";
		 		else if ($strategic_management_active == 'I')
		 			$inactive_selected = "selected='selected'";
		 		
		 		?>
		 		<option <? echo "$active_selected"; ?> value="A">Active</option>
		 		<option <? echo "$inactive_selected"; ?> value="I">Inactive</option>
			</select>
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="button" value="Change" onclick="setStrategic_management_id('<? echo "$strategic_management_id"; ?>'); setAction(document.getElementById('action'), 'C')" /></font>
		</td>
	</tr>
	
	<?
	++$i;
}
?>
</table>
<hr>
<table border="1" cellspacing="2" cellpadding="2">
	<tr> 
		<th><font face="Arial, Helvetica, sans-serif">Strategic management:</font></th>
		<th><font face="Arial, Helvetica, sans-serif"><input type="text" name="add_strategic_management_name" value="New strategic management" /></font></th>
		<th><font face="Arial, Helvetica, sans-serif"><select name="add_strategic_management_status">
														<option value="A">Active</option>
														<option value="I">Inactive</option>
													 </select>
		</font></th>
		<th><font face="Arial, Helvetica, sans-serif"><input type="button" value="Add" onclick="setAction(document.getElementById('action'), 'A')" /></font></th>
	</tr>
</table>
<p>
* A means = Active / I means = Inactive
<p>
</form>