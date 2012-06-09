<?
include("../DB.php");
$DB = DB::Open();

//$query="SELECT ID, NAME FROM companies where active = 'A' ORDER BY 2 ASC";
//$companies = $DB->qry($query);

//$num_companies = $DB->qry_row_num($companies);

$post_company_name = $_POST['company_name'];

if ($post_company_name != '') {
	
	$query="SELECT NAME, email, token, passcode, created_date FROM testers t, testers_add_more a where t.id = a.id_tester and company_name like '%" .$post_company_name. "%' ORDER BY 1, 2 ASC";
	$testers = $DB->qry($query);
	
	$num_testers = $DB->qry_row_num($testers);
}

echo "<b><center>Testers by company</center></b><br><br>";

?>
<body>

<form action="reports_company.php" method="post" name="reports_company_form">
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
	<td><font face="Arial, Helvetica, sans-serif">
	 	Company name: <input type="text" name="company_name" value="<?php echo "$post_company_name"; ?>" />
	 	<!--  
	 				<select name="company_id">
	 				<option value="0">(select one company)</option>
					<?
					//$i=0;
					//while ($i < $num_companies) {
//						$company_id = mysql_result($companies,$i,"id");
	//					$company_name = mysql_result($companies,$i,"name");
		//				
			//			$selected = "";
				//		if ($company_id == $post_company_id) {
					//		$selected_company_name = $company_name;
					//		$selected = "selected";
					//	}
					//	?>
							<option value="<? echo "$company_id"; ?>" <?php echo "$selected"; ?> ><? echo "$company_name"; ?> </option>	
					//	<?
					//	
					//	$selected = "";
					//	++$i;
					//}
					?>
			</select>
		 -->
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="submit" value="Show report"/></font>
		</td>
	</tr>
</table>
<p>

<?php if ($post_company_name != '' && $num_testers > 0) { ?>

<?php include("return_root_admin.php"); ?>
<hr>
<h3>Company: <?php echo "$post_company_name"; ?></h3>

<table border="1" cellspacing="2" cellpadding="2">
	<tr> 
		<td><font face="Arial, Helvetica, sans-serif"> 
		Name	
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif">
		Email
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
		Assessement date
		</font>
		<td><font face="Arial, Helvetica, sans-serif">
		Internal report
		</font>
		</td>		
		<td><font face="Arial, Helvetica, sans-serif">
		Tester report<br>(enter passcode)
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
		Passcode
		</font>
		</td>			
</tr>
<?
$i=0;
while ($i < $num_testers) {
	$tester_name= mysql_result($testers,$i,"name");
	$tester_email = mysql_result($testers,$i,"email");
	$created_date = mysql_result($testers,$i,"created_date");
	$tester_token = mysql_result($testers,$i,"token");
	$tester_passcode = mysql_result($testers,$i,"passcode");
	?>
	<tr> 
		<td><font face="Arial, Helvetica, sans-serif"> 
			<? echo "$tester_name"; ?>
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif">
			<? echo "$tester_email"; ?>
			</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<? echo "$created_date"; ?>
			</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<a href="show_tester_report.php?token=<? echo "$tester_token"; ?>">View report</a>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<a href="../report_check.php?token=<? echo "$tester_token"; ?>">View report</a>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<? echo "$tester_passcode"; ?>
		</font>
		</td>
		</tr>
	<?
	++$i;
}
?>
</table>
<p>
<?php }?>

</form>
</body>
<?php include("return_root_admin.php"); ?>