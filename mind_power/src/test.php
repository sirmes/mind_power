<?php
include("DB.php");
$DB = DB::Open();

$test_on = htmlspecialchars($_GET["test_on"]);
echo "test is on: ".$test_on."<br>";

$fruits = array (
		"fruits"  => array("a" => "Orange", "b" => "Banana", "c" => "Apple"),
		"numbers" => array(1, 2, 3, 4, 5, 6),
		"holes"   => array("first", 5 => "second", "third")
);

// echo $fruits["fruits"]["b"];

$keys = array_keys($fruits);
// echo $keys;

echo"<hr>";
$leadership = array(
		"1" => array("id_tester" => 0, "id_strategic_management" => 0, "id_leadership" => 0, "leadership_count" => 0, "leadership_percentage" => 0),
		"2" => array("id_tester" => 0, "id_strategic_management" => 0, "id_leadership" => 0, "leadership_count" => 0, "leadership_percentage" => 0),
		"3" => array("id_tester" => 0, "id_strategic_management" => 0, "id_leadership" => 0, "leadership_count" => 0, "leadership_percentage" => 0),
		"4" => array("id_tester" => 0, "id_strategic_management" => 0, "id_leadership" => 0, "leadership_count" => 0, "leadership_percentage" => 0),
		"5" => array("id_tester" => 0, "id_strategic_management" => 0, "id_leadership" => 0, "leadership_count" => 0, "leadership_percentage" => 0),
		"6" => array("id_tester" => 0, "id_strategic_management" => 0, "id_leadership" => 0, "leadership_count" => 0, "leadership_percentage" => 0),
		"7" => array("id_tester" => 0, "id_strategic_management" => 0, "id_leadership" => 0, "leadership_count" => 0, "leadership_percentage" => 0),
		"8" => array("id_tester" => 0, "id_strategic_management" => 0, "id_leadership" => 0, "leadership_count" => 0, "leadership_percentage" => 0),
		"9" => array("id_tester" => 0, "id_strategic_management" => 0, "id_leadership" => 0, "leadership_count" => 0, "leadership_percentage" => 0)
		);

$new_leadership = array();
foreach ($leadership as $current_leadership) {
	$current_leadership["leadership_count"] = ++$$current_leadership["leadership_count"];
	//echo "id tester: ".$$current_leadership["id_tester"]."<br>";
// 	echo "leadership_count: ".$current_leadership["leadership_count"]."<br>";

// 	$current_leadership["leadership_percentage"] = $current_leadership["leadership_percentage"] * 2 + rand(2,10);
// 	$current_leadership["leadership_percentage"] = round(($current_leadership["leadership_percentage"] / 72) * 100, 2);
// 	echo "leadership_percentage: ".$current_leadership["leadership_percentage"]."<br>";

	$new_leadership[] = $current_leadership;
}
$leadership = null;
$leadership = $new_leadership;


foreach ($leadership as $i => $value) {
	$leadership[$i]["leadership_count"] = ++$leadership[$i]["leadership_count"];
// 	echo "id tester: ".$leadership[$i]["id_tester"]."<br>";
// 	echo "leadership_count: ".$leadership[$i]["leadership_count"]."<br>";

	$leadership[$i]["leadership_percentage"] = $leadership[$i]["leadership_percentage"] * 2 + rand(2,10);
	$leadership[$i]["leadership_percentage"] = $leadership[$i]["leadership_percentage"] / 2;
	//echo "leadership_percentage: ".$leadership[$i]["leadership_percentage"]."<br>";
}
print_r($leadership);
echo "<hr>";

$answers_counts_created;
foreach ($leadership as $current_leadership) {
	$id_tester 		= $current_leadership["id_tester"];
	$id_strategic_management	= $current_leadership["id_strategic_management"];
	$id_leadership= $current_leadership["id_leadership"];
	$leadership_count 	= $current_leadership["leadership_count"];
	$leadership_percentage= round(($current_leadership["leadership_count"] / 72) * 100, 2);
	
	echo "current leadership id: $id_tester, $id_strategic_management, $id_leadership, $leadership_count, $leadership_percentage <br>";
	$query = "INSERT INTO testers_answers_counts VALUES ('', $id_tester, $id_strategic_management, $id_leadership, $leadership_count, $leadership_percentage)";
	echo "SQL: => $query";
	$answers_counts_created = $DB->qry($query);
}


echo "<hr>";
print_r($leadership);
?>