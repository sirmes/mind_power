<?
include("../DB.php");
$DB = DB::Open();

$action = $_POST['action'];

// echo "action: $action <br>";

if (strcmp($action,"A") == 0) {
	//Add
	//echo "In add";
	$add_category_name = $_POST['add_category_name'];
	$add_category_status = $_POST['add_category_status'];

// 	echo "Parameters: $add_category_name, $add_category_status";
	
	$query="INSERT INTO CATEGORIES VALUES ('', '$add_category_name', '$add_category_status')";
	$result = $DB->qry($query);
	
// 	echo "Category added: $result";
}
else {
	$category_id = $_POST['category_id'];
	
// 	echo "In change, category id: $category_id <br>";
	if (strcmp($action,"C") == 0 && $category_id != '') {
		//Update
		$change_category_name = $_POST['change_category_name'.$category_id.''];
		$change_category_status = $_POST['change_category_status'.$category_id.''];
		
		$query="UPDATE CATEGORIES SET NAME='$change_category_name', ACTIVE='$change_category_status' WHERE ID = $category_id";
		
// 		echo "SQL => $query <br>";
		
		$result = $DB->qry($query);
		
// 		echo "category updated: $result";
	}
} 
	
$query="SELECT ID, NAME, ACTIVE FROM CATEGORIES";
$categories = $DB->qry($query);

$num_categories = $DB->qry_row_num($categories);

echo "<b><center>Categories</center></b><br><br>";

?>

<script type='text/javascript'>
function setAction(elem, action){
	elem.value = action;
	document.category.submit();
}

function setCategory_id(category_id){
	var elem = document.getElementById('category_id');
	elem.value = category_id;
}
</script>

<form action="categories.php" name="category" id="category" method="post">
<input type="hidden" name="action" id="action" value="" />
<input type="hidden" name="category_id" id="category_id" value="" />
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
<th><font face="Arial, Helvetica, sans-serif">Status *</font></th>
<th><font face="Arial, Helvetica, sans-serif"></font></th>
</tr>
<?
$i=0;
while ($i < $num_categories) {
	$category_id = mysql_result($categories,$i,"id");
	$category_name = mysql_result($categories,$i,"name");
	$category_active = mysql_result($categories,$i,"active");
	?>
	<tr> 
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="text" name="change_category_name<? echo "$category_id"; ?>" value="<? echo "$category_name"; ?>" size="60"/></font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
		 	<select name="change_category_status<? echo "$category_id"; ?>">
		 		<?  
		 		$active_selected = "";
		 		$inactive_selected = "";
		 		if ($category_active == 'A')
		 			$active_selected = "selected='selected'";
		 		else if ($category_active == 'I')
		 			$inactive_selected = "selected='selected'";
		 		
		 		?>
		 		<option <? echo "$active_selected"; ?> value="A">Active</option>
		 		<option <? echo "$inactive_selected"; ?> value="I">Inactive</option>
			</select>
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="button" value="Change" onclick="setCategory_id('<? echo "$category_id"; ?>'); setAction(document.getElementById('action'), 'C')" /></font>
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
		<th><font face="Arial, Helvetica, sans-serif">Category:</font></th>
		<th><font face="Arial, Helvetica, sans-serif"><input type="text" name="add_category_name" value="New category" /></font></th>
		<th><font face="Arial, Helvetica, sans-serif"><select name="add_category_status">
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