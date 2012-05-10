<?php
include("DB.php");
$DB = DB::Open();
$query="select t.id, t.`title`, t.name, t.`email`, c.`name`, q.`question` from strategic_management c, testers_answers a, testers t, questions_answers q where c.`id` = q.`id_strategic_management` and a.`id_question` = q.id and q.`id_strategic_management` = c.`id` and a.`id_tester` = t.`id`";
$result = $DB->qry($query);

$rows = array();
while($r = mysql_fetch_assoc($result)) {
	$rows[] = $r;
}
print json_encode($rows);

?>