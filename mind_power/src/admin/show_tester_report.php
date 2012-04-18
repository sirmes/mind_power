<?php
include("../DB.php");
$DB = DB::Open();

$tester_id = $_POST['tester_id'];

echo "Tester id: $tester_id <br>";

$query="select c.name as category, s.name as sub_category, count(s.name) as qtd " .
		"from categories c, sub_categories s, testers t, answers a, questions q " .
		"where " .
		"c.id = q.id_category " .
		"and q.id_sub_category = s.id " .
		"and q.id = a.id_question " .
		"and a.id_tester = t.id " .
		"and c.active = 'A' " .
		"and s.active = 'A' " .
		"and t.id = $tester_id " .
		"group by c.name, s.name";

//echo "SQL ==> $query <br>";

$result = $DB->qry($query);

$rows = array();
while($r = mysql_fetch_assoc($result)) {
	$rows[] = $r;
}

$query="select name from categories where active = 'A'";
$categories = $DB->qry($query);

$rows_category = array();
while($r = mysql_fetch_assoc($categories)) {
	$rows_category[] = $r;
}

print "categories: " . json_encode($rows_category) . "<br>";
print "sub-categories: " . json_encode($rows);

?>