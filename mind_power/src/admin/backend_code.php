<?php
include("../DB.php");
$DB = DB::Open();

$tester_id = $_POST['tester_id'];
$tester_token = $_GET['token'];

//==================  Get tester id by token ==================
if ($tester_id == '' && $tester_token != '') {
	$query="select id from testers where token = '$tester_token'";
	$testers = $DB->qry($query);
	
	$num_testers = $DB->qry_row_num($testers);
	
	while ($i < $num_testers) {
		$tester_id= mysql_result($testers,$i,"id");
		break;
	}
} 

if ($tester_id == '' && $tester_token == '')
	$tester_id = htmlspecialchars($_GET["tester_id"]);


// echo "Tester id: $tester_id <br>";

//================== Average score ===============
$query="select score from average_score";
$score = $DB->qry($query);

$rows_score_json = array();
while($r = mysql_fetch_assoc($score)) {
	$rows_score_json[] = $r;
}

//================== Bring all leadership ===============
$query="select c.name as strategic, s.name as leadership " .
		"from strategic_management c, leadership s, testers t, testers_answers a, questions_answers q " .
		"where " .
		"c.id = q.id_strategic_management " .
		"and q.id_leadership = s.id " .
		"and q.id = a.id_question " .
		"and a.id_tester = t.id " .
		"and c.active = 'A' " .
		"and s.active = 'A' " .
		"and t.id = $tester_id " .
		"group by c.name, s.name";

$result = $DB->qry($query);

$leadership_json = array();
while($r = mysql_fetch_assoc($result)) {
	$leadership_json[] = $r;
}

//================== Bring all strategic management ===============
$query="select name from strategic_management where active = 'A'";
$strategic_management = $DB->qry($query);

$rows_strategic_management_json = array();
while($r = mysql_fetch_assoc($strategic_management)) {
	$rows_strategic_management_json[] = $r;
}

//================== Bring tester data ===============
$query = "select t.id as tester_id, title, t.name, t.given_names, email, t.company_name company, date_format(created_date, '%M %D, %Y') created_date".
			" from testers t where t.id = $tester_id";
$tester = $DB->qry($query);

$tester_json = array();
while($r = mysql_fetch_assoc($tester)) {
	$tester_json[] = $r;
}

//================== Bring tester answers counts not grouped ===============
$query = "select l.name as leadership, t.leadership_count, t.leadership_percentage ".
		"from testers_answers_counts t, leadership l ". 
		"where id_tester = $tester_id ".
		"	and t.id_leadership = l.id ".
		"order by 3";

$tester_answers_counts = $DB->qry($query);

$answers_counts_json = array();
while($r = mysql_fetch_assoc($tester_answers_counts)) {
	$answers_counts_json[] = $r;
}

//================== Bring tester answers counts grouped by leadership ===============
$query = "select s.name strategic_management, l.name as leadership, t.leadership_count, t.leadership_percentage ".
		"from testers_answers_counts t, leadership l, strategic_management s ".
		" where id_tester = $tester_id ".
		"	and t.id_leadership = l.id ".
		"	and s.id = t.id_strategic_management ".
		"order by s.id, t.leadership_percentage";

$tester_answers_counts_grouped_by_leadership = $DB->qry($query);

$answers_counts_grouped_by_ledership_json = array();
while($r = mysql_fetch_assoc($tester_answers_counts_grouped_by_leadership)) {
	$answers_counts_grouped_by_ledership_json[] = $r;
}

//================== Being all statements that were submitted ===============
$query = "select l.name leadership, q.question ".
			"from testers_answers t, questions_answers q, leadership l ".
			"where t.id_tester = $tester_id ".
			"	and t.id_question = q.id ".
			"	and l.id = q.id_leadership ".
			"group by l.name, q.question ".
			"order by 1, 2;";

$tester_answers_submitted = $DB->qry($query);

$answers_answers_submitted_json = array();
while($r = mysql_fetch_assoc($tester_answers_submitted)) {
	$answers_answers_submitted_json[] = $r;
}

//================== Bring all statements that were NOT submitted ===============
$query = "select l.name as leadership, q.question, q.id ".
"from questions_answers q, leadership l, ".
" ( ".
"select l.id ".
"from testers_answers_counts t, leadership l ".
"where t.id_tester = $tester_id ".
"	and l.id = t.id_leadership ".
"order by leadership_percentage asc ".
"limit 0,4) as bottom_leadership ".
"where q.id_leadership = l.id ".
"and q.question not in ( ".
"select q.question ".
"from testers_answers t, questions_answers q ".
"where t.id_tester = $tester_id ".
"	and t.id_question = q.id) ".
"	and l.id in (bottom_leadership.id) ".
"group by name, question ".
"order by name, question";


$tester_answers_not_submitted = $DB->qry($query);

$answers_answers_not_submitted_json = array();
while($r = mysql_fetch_assoc($tester_answers_not_submitted)) {
	$answers_answers_not_submitted_json[] = $r;
}

//================== Bring all statements picked twice ===============
$query = "select leadership_id, leadership, question, leadership_percentage ".
"from ". 
" ( ".
" select q.id_leadership as leadership_id, question, count(question) as counter ".
" from questions_answers q, testers_answers t ".
" where t.id_tester = $tester_id ".
" 	and t.id_question = q.id ".
"	group by question ".
"	order by 3 desc, 1, 2 ".
") as results, ".
"(select l.id, l.name as leadership, t.leadership_percentage ".
"from testers_answers_counts t, leadership l ".
"where t.id_tester = $tester_id ".
"and l.id = t.id_leadership ".
"order by leadership_percentage desc ".
"limit 0,4) as top3 ".
"where counter >= 2 ".
"	and leadership_id in (top3.id) ".
"order by leadership, 4 desc";

$tester_answers_picked_twiced = $DB->qry($query);

$answers_answers_picked_twice_json = array();
while($r = mysql_fetch_assoc($tester_answers_picked_twiced)) {
	$answers_answers_picked_twice_json[] = $r;
}

print_r($answers_answers_picked_twice_json);

$new_array = array();
$last_leadership_id = 0;
$counter = 0;
$last_percentage = 0;
foreach ($answers_answers_picked_twice_json as $current_record) {
	
	$leadership_id = $current_record["leadership_id"];

	//First time or move to the next leadership
	if ($last_leadership_id == 0 || $last_leadership_id != $leadership_id) {
		$counter = 1;
		$last_leadership_id = $leadership_id;
	}
	else if ($last_leadership_id == $leadership_id) {
		//Is still the same leadership
		$counter = $counter + 1;
	}
	
	if ($counter <= 3) {
		//Just put record into the new array
		$new_array[] = $current_record;
	}
	else if ($counter == 4) {
		
		$temp_percentage = $current_record["leadership_percentage"];
		if (round($temp_percentage, 2) == round($last_percentage, 2)) {
			//Is tied so needs to go into the array too
			$new_array[] = $current_record;			
		}
	}

	$last_percentage = $current_record["leadership_percentage"];
}

print "<br>===============<br>";
print_r($new_array);

//================== Bring top 3/4 ===============
$query = "select l.name as leadership, t.leadership_percentage ".
		"from testers_answers_counts t, leadership l ".
		"where t.id_tester = $tester_id ".
		"	and l.id = t.id_leadership ".
		"order by leadership_percentage desc ".
		"limit 0,3";

$top_3 = $DB->qry($query);

$top_3_json = array();
while($r = mysql_fetch_assoc($top_3)) {
	$top_3_json[] = $r;
}

//================== Bring bottom 3/4 ===============
$query = "select l.name as leadership, t.leadership_percentage ".
		"from testers_answers_counts t, leadership l ".
		"where t.id_tester = $tester_id ".
		"	and l.id = t.id_leadership ".
		"order by leadership_percentage asc ".
		"limit 0,3";

$bottom_3 = $DB->qry($query);

$bottom_3_json = array();
while($r = mysql_fetch_assoc($bottom_3)) {
	$bottom_3_json[] = $r;
}

?>