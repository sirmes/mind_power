<?
include("../DB.php");
$DB = DB::Open();

$action = $_POST['action'];

// echo "action: $action <br>";

if (strcmp($action,"A") == 0) {
	//Add
	//echo "In add";
	$add_category_id = $_POST['add_category_id'];
	$add_sub_category_id = $_POST['add_sub_category_id'];
	$add_group_break = $_POST['add_group_break'];
	$add_question_name = $_POST['add_question_name'];
	$add_question_status = $_POST['add_question_status'];

// 	echo "Parameters: $add_category_id, $add_sub_category_id, $add_group_break, $add_question_name, $add_question_status";
	
	$query="INSERT INTO QUESTIONS VALUES ('', $add_category_id, $add_sub_category_id, $add_group_break, '$add_question_name')";
	$result = $DB->qry($query);
	
// 	echo "Question added: $result";
}
else {
	$question_id = $_POST['question_id'];
	
// 	echo "In change, question id: $question_id <br>";
	if (strcmp($action,"C") == 0 && $question_id != '') {
		//Update
		$change_category_id = $_POST['change_category_id'.$question_id.''];
		$change_sub_category_id = $_POST['change_sub_category_id'.$question_id.''];
		$change_group_break = $_POST['change_group_break'.$question_id.''];
		$change_question_name = $_POST['change_question_name'.$question_id.''];
		
		$query="UPDATE QUESTIONS SET ID_CATEGORY=$change_category_id, ID_SUB_CATEGORY=$change_sub_category_id, ".
				 "GROUP_BREAK=$change_group_break, QUESTION='$change_question_name' ".
				 "WHERE ID = $question_id";
		
// 		echo "SQL => $query <br>";
		
		$result = $DB->qry($query);
		
// 		echo "Question updated: $result";
	}
} 
	
$query="SELECT Q.ID, Q.ID_CATEGORY, C.NAME C_NAME, Q.ID_SUB_CATEGORY, S.NAME S_NAME, Q.GROUP_BREAK, Q.QUESTION ".
		"FROM QUESTIONS Q, CATEGORIES C, SUB_CATEGORIES S ".
		"WHERE ".
		"Q.ID_CATEGORY = C.ID ".
		"AND Q.ID_SUB_CATEGORY = S.ID ".
		"AND C.ACTIVE = 'A' ".
		"AND S.ACTIVE = 'A'";
$questions = $DB->qry($query);

$num_questions = $DB->qry_row_num($questions);

$query="SELECT ID C_ID, NAME C_NAME, ACTIVE FROM CATEGORIES C WHERE C.ACTIVE='A' ORDER BY 2";
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

$query="SELECT S.ID S_ID, S.NAME S_NAME, S.ACTIVE C_ACTIVE FROM SUB_CATEGORIES S WHERE S.ACTIVE='A' ORDER BY 1";
$sub_categories = $DB->qry($query);
$num_sub_categories = $DB->qry_row_num($sub_categories);

$sub_categories_array = array();
$j=0;
while ($j < $num_sub_categories) {
	$local_sub_category_id = mysql_result($sub_categories,$j,"s_id");
	$local_sub_category_name = mysql_result($sub_categories,$j,"s_name");
	$local_sub_array = array($local_sub_category_id, $local_sub_category_name);

	$sub_categories_array[] = $local_sub_array;
	++$j;
}

echo "<b><center>Questions</center></b><br><br>";

?>

<script type='text/javascript'>
function setAction(elem, action){
	elem.value = action;
	document.question.submit();
}

function setQuestion_id(question_id){
	var elem = document.getElementById('question_id');
	elem.value = question_id;
}
</script>

<form action="questions.php" name="question" id="question" method="post">
<input type="hidden" name="action" id="action" value="" />
<input type="hidden" name="question_id" id="question_id" value="" />
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Category</font></th>
<th><font face="Arial, Helvetica, sans-serif">Sub category</font></th>
<th><font face="Arial, Helvetica, sans-serif">Group break *</font></th>
<th><font face="Arial, Helvetica, sans-serif">Name</font></th>
<th><font face="Arial, Helvetica, sans-serif"></font></th>
</tr>
<?
$i=0;
while ($i < $num_questions) {
	$question_id = mysql_result($questions,$i,"id");
	$category_id = mysql_result($questions,$i,"id_category");
	$category_name = mysql_result($questions,$i,"c_name");
	$sub_category_id = mysql_result($questions,$i,"id_sub_category");
	$sub_category_name = mysql_result($questions,$i,"s_name");
	$group_break = mysql_result($questions,$i,"group_break");
	$question_name = mysql_result($questions,$i,"question");
	?>
	<tr> 
		<td><font face="Arial, Helvetica, sans-serif">			
			<select name="change_category_id<? echo "$question_id"; ?>">
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
			<select name="change_sub_category_id<? echo "$question_id"; ?>">
				<option selected='selected' value="<? echo "$sub_category_id"; ?>"><? echo "$sub_category_name"; ?></option>
				<?
				foreach ($sub_categories_array as $element_category) {
					?>
						<option value="<? echo "$element_category[0]"; ?>"><? echo "$element_category[1]"; ?></option>
					<?
				}
				?>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
		 	<select name="change_group_break<? echo "$question_id"; ?>">
		 		<?  
		 		$active_selected = "";
		 		$inactive_selected = "";
		 		if ($group_break == 1)
		 			$group_break_one_selected = "selected='selected'";
		 		else if ($group_break == 2)
		 			$group_break_two_selected = "selected='selected'";
		 		
		 		?>
		 		<option <? echo "$group_break_one_selected"; ?> value="1">Group one</option>
		 		<option <? echo "$group_break_two_selected"; ?> value="2">Group two</option>
			</select>
			</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<textarea rows="5" cols="60" name="change_question_name<? echo "$question_id"; ?>"><? echo "$question_name"; ?></textarea>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="button" value="Change" onclick="setQuestion_id('<? echo "$question_id"; ?>'); setAction(document.getElementById('action'), 'C')" /></font>
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
		<th><font face="Arial, Helvetica, sans-serif">Question:</font></th>
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
		<th><font face="Arial, Helvetica, sans-serif"><select name="add_sub_category_id">
													<option>(select one)</option>
													<?
													foreach ($sub_categories_array as $element_category) {
														?>
															<option value="<? echo "$element_category[0]"; ?>"><? echo "$element_category[1]"; ?></option>
														<?
													}
													?>
													</select>
		</font></th>
		<th><font face="Arial, Helvetica, sans-serif">
		 	<select name="add_group_break">
				<option>(select one)</option>
			 	<option value="1">Group one</option>
		 		<option value="2">Group two</option>
			</select>
			</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">
			<textarea rows="5" cols="60" name="add_question_name">New question</textarea>
		</font></th>
		<th><font face="Arial, Helvetica, sans-serif"><input type="button" value="Add" onclick="setAction(document.getElementById('action'), 'A')" /></font></th>
	</tr>
</table>
<p>
* This is used to group together two questions form the same category/sub category
<p>
</form>