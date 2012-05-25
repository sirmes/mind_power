<?
include("../DB.php");
$DB = DB::Open();

$action = $_POST['action'];

// echo "action: $action <br>";

if (strcmp($action,"A") == 0) {
	//Add
	//echo "In add";
	$add_strategic_management_id = $_POST['add_strategic_management_id'];
	$add_leadership_id = $_POST['add_leadership_id'];
	$add_answer_group = $_POST['add_answer_group'];
	$add_question_name = htmlspecialchars($_POST['add_question_name']);
	$add_question_status = $_POST['add_question_status'];

// 	echo "Parameters: $add_strategic_management_id, $add_leadership_id, $add_answer_group, $add_question_name, $add_question_status";
	
	$query="INSERT INTO questions_answers VALUES ('', $add_strategic_management_id, $add_leadership_id, $add_answer_group, '".
	str_replace('"','\'',$add_question_name). "')";
	$result = $DB->qry($query);
	
// 	echo "Question added: $result";
}
else {
	$question_id = $_POST['question_id'];
	
// 	echo "In change, question id: $question_id <br>";
	if (strcmp($action,"C") == 0 && $question_id != '') {
		//Update
		$change_strategic_management_id = $_POST['change_strategic_management_id'.$question_id.''];
		$change_leadership_id = $_POST['change_leadership_id'.$question_id.''];
		$change_answer_group = $_POST['change_answer_group'.$question_id.''];
		$change_question_name = htmlspecialchars($_POST['change_question_name'.$question_id.'']);
		
		$query="UPDATE questions_answers SET ID_strategic_management=$change_strategic_management_id, ID_leadership=$change_leadership_id, ".
				 "ANSWER_GROUP=$change_answer_group, QUESTION='". str_replace('"','\'',$change_question_name)."' ".
				 "WHERE ID = $question_id";
		
// 		echo "SQL => $query <br>";
		
		$result = $DB->qry($query);
		
		if ($result == 1)
			echo "Answers / questions updated";
		else 
			echo "Answers / questions was not updated. Result code is: " + $result;
	}
} 
	
$query="SELECT Q.ID, Q.ID_strategic_management, C.NAME C_NAME, Q.ID_leadership, S.NAME S_NAME, Q.ANSWER_GROUP, Q.QUESTION ".
		"FROM questions_answers Q, strategic_management C, leadership S ".
		"WHERE ".
		"Q.ID_strategic_management = C.ID ".
		"AND Q.ID_leadership = S.ID ".
		"AND C.ACTIVE = 'A' ".
		"AND S.ACTIVE = 'A'".
		"ORDER BY Q.ANSWER_GROUP";
$questions = $DB->qry($query);

$num_questions = $DB->qry_row_num($questions);

$query="SELECT ID C_ID, NAME C_NAME, ACTIVE FROM strategic_management C WHERE C.ACTIVE='A' ORDER BY 2";
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

$query="SELECT S.ID S_ID, S.NAME S_NAME, S.ACTIVE C_ACTIVE FROM leadership S WHERE S.ACTIVE='A' ORDER BY 1";
$leadership = $DB->qry($query);
$num_leadership = $DB->qry_row_num($leadership);

$leadership_array = array();
$j=0;
while ($j < $num_leadership) {
	$local_leadership_id = mysql_result($leadership,$j,"s_id");
	$local_leadership_name = mysql_result($leadership,$j,"s_name");
	$local_sub_array = array($local_leadership_id, $local_leadership_name);

	$leadership_array[] = $local_sub_array;
	++$j;
}

echo "<b><center>Questions</center></b><br><br>";


?>
<?php include("return_root_admin.php"); ?>

<script type='text/javascript'>
function setAction(textElem, elem, action){
	if (textElem.value.trim() == '') {
		alert('Please enter the answer!');
		textElem.focus();
		return;
	}

//	if (validateQuestionNumbers()) {
//	}

	elem.value = action;
	document.question.submit();
}

function validateQuestionNumbers() {

	var count=1;
	for(var i=0; i <= 144; i++) {
		alert('current change answer group: ' + 'change_answer_group'+i);
		var element = document.getElementById('change_answer_group'+i);

		last
		break;
	}

	return false;
}

function setQuestion_id(question_id){
	var elem = document.getElementById('question_id');
	elem.value = question_id;
}
</script>

<form action="questions.php" name="question" id="question" method="post">
<p>
* This is used to group two questions form the same strategic/leadership
<p>

<input type="hidden" name="action" id="action" value="" />
<input type="hidden" name="question_id" id="question_id" value="" />
<hr>
<table border="1" cellspacing="2" cellpadding="2">
<tr> 
<th><font face="Arial, Helvetica, sans-serif">Question *</font></th>
<th><font face="Arial, Helvetica, sans-serif">Strategic management</font></th>
<th><font face="Arial, Helvetica, sans-serif">Leadership</font></th>
<th><font face="Arial, Helvetica, sans-serif">Answers</font></th>
<th><font face="Arial, Helvetica, sans-serif"></font></th>
</tr>
<?
$i=0;
while ($i < $num_questions) {
	$question_id = mysql_result($questions,$i,"id");
	$strategic_management_id = mysql_result($questions,$i,"id_strategic_management");
	$strategic_management_name = mysql_result($questions,$i,"c_name");
	$leadership_id = mysql_result($questions,$i,"id_leadership");
	$leadership_name = mysql_result($questions,$i,"s_name");
	$answer_group = mysql_result($questions,$i,"answer_group");
	$question_name = mysql_result($questions,$i,"question");
	?>
	<tr> 
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="text" size="5" name="change_answer_group<? echo "$question_id"; ?>" id="change_answer_group<? echo "$question_id"; ?>" value="<? echo "$answer_group"; ?>"/>
			</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">			
			<select name="change_strategic_management_id<? echo "$question_id"; ?>">
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
			<select name="change_leadership_id<? echo "$question_id"; ?>">
				<option selected='selected' value="<? echo "$leadership_id"; ?>"><? echo "$leadership_name"; ?></option>
				<?
				foreach ($leadership_array as $element_leaderhip) {
					?>
						<option value="<? echo "$element_leaderhip[0]"; ?>"><? echo "$element_leaderhip[1]"; ?></option>
					<?
				}
				?>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<textarea rows="5" cols="60" name="change_question_name<? echo "$question_id"; ?>" id="change_question_name<? echo "$question_id"; ?>" ><? echo "$question_name"; ?></textarea>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif">
			<input type="button" value="Change" onclick="setQuestion_id('<? echo "$question_id"; ?>'); setAction(document.getElementById('change_question_name<? echo "$question_id"; ?>'), document.getElementById('action'), 'C')" /></font>
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
		<th><font face="Arial, Helvetica, sans-serif">
			<input type="text" size="5" name="add_answer_group" />
			</font>
		</th>
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
		<th><font face="Arial, Helvetica, sans-serif"><select name="add_leadership_id">
													<option>(select one)</option>
													<?
													foreach ($leadership_array as $element_leadership) {
														?>
															<option value="<? echo "$element_leadership[0]"; ?>"><? echo "$element_leadership[1]"; ?></option>
														<?
													}
													?>
													</select>
		</font></th>
		<th><font face="Arial, Helvetica, sans-serif">
			<textarea rows="5" cols="60" name="add_question_name">New question/answer</textarea>
		</font></th>
		<th><font face="Arial, Helvetica, sans-serif"><input type="button" value="Add" onclick="setAction(document.getElementById('add_question_name'), document.getElementById('action'), 'A')" /></font></th>
	</tr>
</table>
</form>
<?php include("return_root_admin.php"); ?>