<?php
include("dbinfo.inc.php");
mysql_connect("127.0.0.1",$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="select t.id, t.`title`, t.name, t.`email`, c.`name`, q.`question` from categories c, answers a, testers t, questions q where c.`id` = q.`id_category` and a.`id_question` = q.id and q.`id_category` = c.`id` and a.`id_tester` = t.`id`";
$result=mysql_query($query);

$rows = array();
while($r = mysql_fetch_assoc($result)) {
	$rows[] = $r;
}
print json_encode($rows);

//echo json_encode($result);

?>