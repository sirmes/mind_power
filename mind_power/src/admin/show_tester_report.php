<?php
include("../DB.php");
$DB = DB::Open();

$tester_id = $_POST['tester_id'];

echo "Tester id: $tester_id <br>";

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
$query = "select t.id as tester_id, title, t.name, email, c.name company from testers t, companies c where c.id = t.id_company and t.id = $tester_id";
$tester = $DB->qry($query);

$tester_json = array();
while($r = mysql_fetch_assoc($tester)) {
	$tester_json[] = $r;
}

//================== Bring tester answers counts not grouped ===============
$query = "select * from testers_answers_counts where id_tester = $tester_id";
$tester_answers_counts = $DB->qry($query);

$answers_counts_json = array();
while($r = mysql_fetch_assoc($tester_answers_counts)) {
	$answers_counts_json[] = $r;
}

//================== Bring tester answers counts grouped by leadership ===============
$query = "select * from testers_answers_counts where id_tester = $tester_id ". 
		 "group by id_leadership order by leadership_percentage";

$tester_answers_counts_grouped_by_leadership = $DB->qry($query);

$answers_counts_grouped_by_ledership_json = array();
while($r = mysql_fetch_assoc($tester_answers_counts_grouped_by_leadership)) {
	$answers_counts_grouped_by_ledership_json[] = $r;
}

//================== Bring all answers that were submitted ===============
$query = "select t.*, q.* from testers_answers t, questions_answers q ".
		 "where t.id_tester = $tester_id".
		 "	and t.id_question = q.id";

$tester_answers_submitted = $DB->qry($query);

$answers_answers_submitted_json = array();
while($r = mysql_fetch_assoc($tester_answers_submitted)) {
	$answers_answers_submitted_json[] = $r;
}

//================== Bring all answers that were NOT submitted ===============
$query = "select t.*, q.* from testers_answers t, questions_answers q ".
		 "where t.id_question = q.id ".
		 "	and q.id not in (".
		 "					select q.id ".
		 "					from testers_answers t, questions_answers q".
		 "					where t.id_tester = $tester_id".
		 "					and t.id_question = q.id)";

$tester_answers_not_submitted = $DB->qry($query);

$answers_answers_not_submitted_json = array();
while($r = mysql_fetch_assoc($tester_answers_not_submitted)) {
	$answers_answers_not_submitted_json[] = $r;
}

//================== Bring all answers picked twice ===============
$query = "select s.name, question, count(*) as counter ".
		 "from questions_answers q, testers_answers t, leadership s ".
		 "where t.id_tester = $tester_id ".
		 "	and t.id_question = q.id ".
		 "	and s.id = q.id_leadership ".
		 "group by question ".
		 "order by 3 desc, 1, 2";

$tester_answers_picked_twiced = $DB->qry($query);

$answers_answers_picked_twice_json = array();
while($r = mysql_fetch_assoc($tester_answers_picked_twiced)) {
	$answers_answers_picked_twice_json[] = $r;
}



print "<hr>";
print "average score: " . json_encode($rows_score_json) . "<br>";
print "<hr>";
print "tester: " . json_encode($tester_json) . "<br>";
print "<hr>";
print "Strategic management: " . json_encode($rows_strategic_management_json) . "<br>";
print "<hr>";
print "Leadership: " . json_encode($leadership_json);
print "<hr>";
print "testers answers counts: " . json_encode($answers_counts_json);
print "<hr>";
print "testers answers counts grouped by leadership: " . json_encode($answers_counts_grouped_by_ledership_json);
print "<hr>";
print "All answers submitted: " . json_encode($answers_answers_submitted_json);
print "<hr>";
print "All answers NOT submitted: " . json_encode($answers_answers_not_submitted_json);
print "<hr>";
print "All answers picked twice: " . json_encode($answers_answers_picked_twice_json);


?>
<script type="text/javascript">
<!--
var title = '<?php echo json_encode($tester_json); ?>';

//-->
</script>
