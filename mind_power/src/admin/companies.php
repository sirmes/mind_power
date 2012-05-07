<?
include("../DB.php");
$DB = DB::Open();

$action = $_POST['action'];

//echo "action: $action <br>";

if (strcmp($action,"A") == 0) {
	//Add
	//echo "In add";
	$add_company_name = $_POST['add_company_name'];
	$add_company_status = $_POST['add_company_status'];

	//echo "Parameters: $add_company_name, $add_company_status";
	
	$query="INSERT INTO companies VALUES ('', '$add_company_name', '$add_company_status')";
	$result = $DB->qry($query);
	
	//echo "Company added: $result";
}
else {
	$company_id = $_POST['company_id'];
	
	//echo "In change, company id: $company_id <br>";
	if (strcmp($action,"C") == 0 && $company_id != '') {
		//Update
		$change_company_name = $_POST['change_company_name'.$company_id.''];
		$change_company_status = $_POST['change_company_status'.$company_id.''];
		
		$query="UPDATE companies SET NAME='$change_company_name', ACTIVE='$change_company_status' WHERE ID = $company_id";
		
		//echo "SQL => $query <br>";
		
		$result = $DB->qry($query);
		
		//echo "Company updated: $result";
	}
} 
	
$query="SELECT * FROM companies";
$companies = $DB->qry($query);

$num_companies = $DB->qry_row_num($companies);

echo "<b><center>Companies</center></b><br><br>";

?>

<script type='text/javascript'>
function setAction(elem, action){
	elem.value = action;
	document.company.submit();
}

function setCompany_id(company_id){
	var elem = document.getElementById('company_id');
	elem.value = company_id;
}
</script>

<form action="companies.php" name="company" id="company" method="post">
<input type="hidden" name="action" id="action" value="" />
<input type="hidden" name="company_id" id="company_id" value="" />
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
<th><font face="Arial, Helvetica, sans-serif">Status *</font></th>
<th><font face="Arial, Helvetica, sans-serif"></font></th>
</tr>
<?
$i=0;
while ($i < $num_companies) {
	$company_id = mysql_result($companies,$i,"id");
	$company_name = mysql_result($companies,$i,"name");
	$company_active = mysql_result($companies,$i,"active");
	?>
	<tr> 
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="text" name="change_company_name<? echo "$company_id"; ?>" value="<? echo "$company_name"; ?>" /></font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
		 	<select name="change_company_status<? echo "$company_id"; ?>">
		 		<?  
		 		$active_selected = "";
		 		$inactive_selected = "";
		 		if ($company_active == 'A')
		 			$active_selected = "selected='selected'";
		 		else if ($company_active == 'I')
		 			$inactive_selected = "selected='selected'";
		 		
		 		?>
		 		<option <? echo "$active_selected"; ?> value="A">Active</option>
		 		<option <? echo "$inactive_selected"; ?> value="I">Inactive</option>
			</select>
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="button" value="Change" onclick="setCompany_id('<? echo "$company_id"; ?>'); setAction(document.getElementById('action'), 'C')" /></font>
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
		<th><font face="Arial, Helvetica, sans-serif">Company:</font></th>
		<th><font face="Arial, Helvetica, sans-serif"><input type="text" name="add_company_name" value="New company" /></font></th>
		<th><font face="Arial, Helvetica, sans-serif"><select name="add_company_status">
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