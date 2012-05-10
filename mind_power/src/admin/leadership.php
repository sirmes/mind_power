<?
include("../DB.php");
$DB = DB::Open();

$action = $_POST['action'];

// echo "action: $action <br>";

if (strcmp($action,"A") == 0) {
	//Add
	//echo "In add";
	
	$add_strategic_management_id = $_POST['add_strategic_management_id'];
	$add_leadership_name = $_POST['add_leadership_name'];
	$add_leadership_status = $_POST['add_leadership_status'];

// 	echo "Parameters: $add_leadership_name, $add_leadership_status";
	
	$query="INSERT INTO leadership VALUES ('', $add_strategic_management_id ,'$add_leadership_name', '$add_leadership_status')";
	$result = $DB->qry($query);
	
// 	echo "Leadership item added: $result";
}
else {
	$leadership_id = $_POST['leadership_id'];
	
// 	echo "In change, leadership id: $leadership_id <br>";
	if (strcmp($action,"C") == 0 && $leadership_id != '') {
		//Update
		$change_strategic_management_id = $_POST['change_strategic_management_id'.$leadership_id.''];
		$change_leadership_name = $_POST['change_leadership_name'.$leadership_id.''];
		$change_leadership_status = $_POST['change_leadership_status'.$leadership_id.''];
		
		$query="UPDATE leadership SET ID_strategic_management='$change_strategic_management_id', NAME='$change_leadership_name', ACTIVE='$change_leadership_status' WHERE ID = $leadership_id";
		
// 		echo "SQL => $query <br>";
		
		$result = $DB->qry($query);
		
		if ($result == 1)
			echo "Leadership updated";
		else 
			echo "Leadership was not updated. Result code is: " + $result;
	}
} 
	
$query="SELECT C.ID C_ID, C.NAME C_NAME, C.ACTIVE C_ACTIVE, S.ID S_ID, S.NAME S_NAME, S.ACTIVE S_ACTIVE FROM strategic_management C, leadership S ".
		"WHERE C.ID=S.ID_strategic_management AND C.ACTIVE='A'";
$leadership = $DB->qry($query);

$num_leadership = $DB->qry_row_num($leadership);


$query="SELECT C.ID C_ID, C.NAME C_NAME, C.ACTIVE C_ACTIVE FROM strategic_management C WHERE C.ACTIVE='A'";
$strategic_management = $DB->qry($query);
$num_strategic_management = $DB->qry_row_num($strategic_management);

$strategic_management_array = array();
while ($j < $num_strategic_management) {
	$local_strategic_management_id = mysql_result($strategic_management,$j,"c_id");
	$local_strategic_management_name = mysql_result($strategic_management,$j,"c_name");
	$local_array = array($local_strategic_management_id, $local_strategic_management_name);

	$strategic_management_array[] = $local_array;
	++$j;
}

echo "<b><center>Leadership</center></b><br><br>";

?>

<script type='text/javascript'>
function setAction(elem, action){
	elem.value = action;
	document.leadership.submit();
}

function setLeadership_id(leadership_id){
	var elem = document.getElementById('leadership_id');
	elem.value = leadership_id;
}
</script>

<form action="leadership.php" name="leadership" id="leadership" method="post">
<input type="hidden" name="action" id="action" value="" />
<input type="hidden" name="leadership_id" id="leadership_id" value="" />
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Stratigic skillset</font></th>
<th><font face="Arial, Helvetica, sans-serif">Leadership</font></th>
<th><font face="Arial, Helvetica, sans-serif">Status *</font></th>
<th><font face="Arial, Helvetica, sans-serif"></font></th>
</tr>
<?
$i=0;
while ($i < $num_leadership) {
	$strategic_management_id = mysql_result($leadership,$i,"c_id");
	$strategic_management_name = mysql_result($leadership,$i,"c_name");
	$leadership_id = mysql_result($leadership,$i,"s_id");
	$leadership_name = mysql_result($leadership,$i,"s_name");
	$leadership_active = mysql_result($leadership,$i,"s_active");
	?>
	<tr> 
		<td><font face="Arial, Helvetica, sans-serif">			
			<select name="change_strategic_management_id<? echo "$leadership_id"; ?>">
				<option selected='selected' value="<? echo "$strategic_management_id"; ?>"><? echo "$strategic_management_name"; ?></option>
				<?
				foreach ($strategic_management_array as $element_strategic_management) {
					?>
						<option value="<? echo "$element_strategic_management[0]"; ?>"><? echo "$element_strategic_management[1]"; ?></option>
					<?
				}
				?>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="text" name="change_leadership_name<? echo "$leadership_id"; ?>" value="<? echo "$leadership_name"; ?>" size="60"/></font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
		 	<select name="change_leadership_status<? echo "$leadership_id"; ?>">
		 		<?  
		 		$active_selected = "";
		 		$inactive_selected = "";
		 		if ($leadership_active == 'A')
		 			$active_selected = "selected='selected'";
		 		else if ($leadership_active == 'I')
		 			$inactive_selected = "selected='selected'";
		 		
		 		?>
		 		<option <? echo "$active_selected"; ?> value="A">Active</option>
		 		<option <? echo "$inactive_selected"; ?> value="I">Inactive</option>
			</select>
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="button" value="Change" onclick="setLeadership_id('<? echo "$leadership_id"; ?>'); setAction(document.getElementById('action'), 'C')" /></font>
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
		<th><font face="Arial, Helvetica, sans-serif">Leadership:</font></th>
		<th><font face="Arial, Helvetica, sans-serif"><select name="add_strategic_management_id">
													<option>(select one)</option>
													<?
													foreach ($strategic_management_array as $element_strategic_management) {
														?>
															<option value="<? echo "$element_strategic_management[0]"; ?>"><? echo "$element_strategic_management[1]"; ?></option>
														<?
													}
													?>
													</select>
		</font></th>
		<th><font face="Arial, Helvetica, sans-serif"><input type="text" name="add_leadership_name" value="New leadership item" /></font></th>
		<th><font face="Arial, Helvetica, sans-serif"><select name="add_leadership_status">
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