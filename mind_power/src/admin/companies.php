<?
include("../DB.php");
$DB = DB::Open();

$query="SELECT ID, NAME, ACTIVE FROM COMPANIES";
$companies = $DB->qry($query);

$num_companies = $DB->qry_row_num($companies);

echo "<b><center>Companies</center></b><br><br>";

?>

<form action="update_company.php" method="post">
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
<th><font face="Arial, Helvetica, sans-serif">Active *</font></th>
<th colspan="2"><font face="Arial, Helvetica, sans-serif"></font></th>
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
			<input type="text" value="<? echo "$company_name"; ?>" /></font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
		 	<select name="company_id">
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
			<input type="button" value="Change" /></font>
		</td>
				<td><font face="Arial, Helvetica, sans-serif">
			<input type="button" value="Remove" /></font>
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
		<th><font face="Arial, Helvetica, sans-serif"><input type="text" value="New company" /></font></th>
		<th><font face="Arial, Helvetica, sans-serif"><input type="button" value="Add" /></font></th>
	</tr>
</table>
<p>
* A means = Active / I means = Inactive
<p>
</form>