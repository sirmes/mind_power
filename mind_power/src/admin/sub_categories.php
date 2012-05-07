<?
include("../DB.php");
$DB = DB::Open();

$action = $_POST['action'];

// echo "action: $action <br>";

if (strcmp($action,"A") == 0) {
	//Add
	//echo "In add";
	
	$add_category_id = $_POST['add_category_id'];
	$add_sub_category_name = $_POST['add_sub_category_name'];
	$add_sub_category_status = $_POST['add_sub_category_status'];

// 	echo "Parameters: $add_sub_category_name, $add_sub_category_status";
	
	$query="INSERT INTO sub_categories VALUES ('', $add_category_id ,'$add_sub_category_name', '$add_sub_category_status')";
	$result = $DB->qry($query);
	
// 	echo "Sub category added: $result";
}
else {
	$sub_category_id = $_POST['sub_category_id'];
	
// 	echo "In change, sub_category id: $sub_category_id <br>";
	if (strcmp($action,"C") == 0 && $sub_category_id != '') {
		//Update
		$change_category_id = $_POST['change_category_id'.$sub_category_id.''];
		$change_sub_category_name = $_POST['change_sub_category_name'.$sub_category_id.''];
		$change_sub_category_status = $_POST['change_sub_category_status'.$sub_category_id.''];
		
		$query="UPDATE sub_categories SET ID_CATEGORY='$change_category_id', NAME='$change_sub_category_name', ACTIVE='$change_sub_category_status' WHERE ID = $sub_category_id";
		
// 		echo "SQL => $query <br>";
		
		$result = $DB->qry($query);
		
		if ($result == 1)
			echo "Leadership updated";
		else 
			echo "Leadership was not updated. Result code is: " + $result;
	}
} 
	
$query="SELECT C.ID C_ID, C.NAME C_NAME, C.ACTIVE C_ACTIVE, S.ID S_ID, S.NAME S_NAME, S.ACTIVE S_ACTIVE FROM categories C, sub_categories S ".
		"WHERE C.ID=S.ID_CATEGORY AND C.ACTIVE='A'";
$sub_categories = $DB->qry($query);

$num_sub_categories = $DB->qry_row_num($sub_categories);


$query="SELECT C.ID C_ID, C.NAME C_NAME, C.ACTIVE C_ACTIVE FROM categories C WHERE C.ACTIVE='A'";
$categories = $DB->qry($query);
$num_categories = $DB->qry_row_num($categories);

$categories_array = array();
while ($j < $num_categories) {
	$local_category_id = mysql_result($categories,$j,"c_id");
	$local_category_name = mysql_result($categories,$j,"c_name");
	$local_array = array($local_category_id, $local_category_name);

	$categories_array[] = $local_array;
	++$j;
}

echo "<b><center>Leadership</center></b><br><br>";

?>

<script type='text/javascript'>
function setAction(elem, action){
	elem.value = action;
	document.sub_category.submit();
}

function setSubCategory_id(sub_category_id){
	var elem = document.getElementById('sub_category_id');
	elem.value = sub_category_id;
}
</script>

<form action="sub_categories.php" name="sub_category" id="sub_category" method="post">
<input type="hidden" name="action" id="action" value="" />
<input type="hidden" name="sub_category_id" id="sub_category_id" value="" />
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Category name</font></th>
<th><font face="Arial, Helvetica, sans-serif">Sub category Name</font></th>
<th><font face="Arial, Helvetica, sans-serif">Status *</font></th>
<th><font face="Arial, Helvetica, sans-serif"></font></th>
</tr>
<?
$i=0;
while ($i < $num_sub_categories) {
	$category_id = mysql_result($sub_categories,$i,"c_id");
	$category_name = mysql_result($sub_categories,$i,"c_name");
	$sub_category_id = mysql_result($sub_categories,$i,"s_id");
	$sub_category_name = mysql_result($sub_categories,$i,"s_name");
	$sub_category_active = mysql_result($sub_categories,$i,"s_active");
	?>
	<tr> 
		<td><font face="Arial, Helvetica, sans-serif">			
			<select name="change_category_id<? echo "$sub_category_id"; ?>">
				<option selected='selected' value="<? echo "$category_id"; ?>"><? echo "$category_name"; ?></option>
				<?
				foreach ($categories_array as $element_category) {
					?>
						<option value="<? echo "$element_category[0]"; ?>"><? echo "$element_category[1]"; ?></option>
					<?
				}
				?>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="text" name="change_sub_category_name<? echo "$sub_category_id"; ?>" value="<? echo "$sub_category_name"; ?>" size="60"/></font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
		 	<select name="change_sub_category_status<? echo "$sub_category_id"; ?>">
		 		<?  
		 		$active_selected = "";
		 		$inactive_selected = "";
		 		if ($sub_category_active == 'A')
		 			$active_selected = "selected='selected'";
		 		else if ($sub_category_active == 'I')
		 			$inactive_selected = "selected='selected'";
		 		
		 		?>
		 		<option <? echo "$active_selected"; ?> value="A">Active</option>
		 		<option <? echo "$inactive_selected"; ?> value="I">Inactive</option>
			</select>
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="button" value="Change" onclick="setSubCategory_id('<? echo "$sub_category_id"; ?>'); setAction(document.getElementById('action'), 'C')" /></font>
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
		<th><font face="Arial, Helvetica, sans-serif">Sub category:</font></th>
		<th><font face="Arial, Helvetica, sans-serif"><select name="add_category_id">
													<option>(select one)</option>
													<?
													foreach ($categories_array as $element_category) {
														?>
															<option value="<? echo "$element_category[0]"; ?>"><? echo "$element_category[1]"; ?></option>
														<?
													}
													?>
													</select>
		</font></th>
		<th><font face="Arial, Helvetica, sans-serif"><input type="text" name="add_sub_category_name" value="New sub category" /></font></th>
		<th><font face="Arial, Helvetica, sans-serif"><select name="add_sub_category_status">
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