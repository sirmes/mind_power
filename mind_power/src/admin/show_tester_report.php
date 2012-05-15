<?php
include("../DB.php");
$DB = DB::Open();

$tester_id = $_POST['tester_id'];

if ($tester_id == '')
	$tester_id = htmlspecialchars($_GET["tester_id"]);


//echo "Tester id: $tester_id <br>";

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
		"group by s.name, l.name, t.leadership_count, t.leadership_percentage ".
		"order by s.id, l.name, t.leadership_percentage";

$tester_answers_counts_grouped_by_leadership = $DB->qry($query);

$answers_counts_grouped_by_ledership_json = array();
while($r = mysql_fetch_assoc($tester_answers_counts_grouped_by_leadership)) {
	$answers_counts_grouped_by_ledership_json[] = $r;
}

//================== Being all questions(statements) that were submitted ===============
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

//================== Bring all answers that were NOT submitted ===============
$query = "select l.name as leadership, q.question ".
"from testers_answers t, questions_answers q, leadership l ".
"where t.id_tester = $tester_id ".
"	and t.id_question = q.id ".
"	and q.id_leadership = l.id ".
"	and l.active = 'A' ".
"	and q.id not in ( ".
"			select q.id ".
"			from testers_answers t, questions_answers q ".
"			where t.id_tester = $tester_id ".
" 			and t.id_question = q.id) ".
"group by name, question ".
"order by name, question";

$tester_answers_not_submitted = $DB->qry($query);

$answers_answers_not_submitted_json = array();
while($r = mysql_fetch_assoc($tester_answers_not_submitted)) {
	$answers_answers_not_submitted_json[] = $r;
}

//================== Bring all answers picked twice ===============
$query = "select * from ".
		"( ".
		" select s.name, question, count(question) as counter ".
		" from questions_answers q, testers_answers t, leadership s ".
		" where t.id_tester = $tester_id ".
		" 	and t.id_question = q.id ".
		"	and s.id = q.id_leadership ".
		"group by s.name ".
		"order by 3 desc, 1, 2 ".
		") as results ".
		" where counter >= 2";

$tester_answers_picked_twiced = $DB->qry($query);

$answers_answers_picked_twice_json = array();
while($r = mysql_fetch_assoc($tester_answers_picked_twiced)) {
	$answers_answers_picked_twice_json[] = $r;
}



// print "<hr>";
// print "average score: " . json_encode($rows_score_json) . "<br>";
// print "<hr>";
// print "tester: " . json_encode($tester_json) . "<br>";
// print "<hr>";
// print "Strategic management: " . json_encode($rows_strategic_management_json) . "<br>";
// print "<hr>";
// print "Leadership: " . json_encode($leadership_json);
// print "<hr>";
// print "testers answers counts: " . json_encode($answers_counts_json);
// print "<hr>";
// print "testers answers counts grouped by leadership: " . json_encode($answers_counts_grouped_by_ledership_json);
// print "<hr>";
// print "All answers submitted: " . json_encode($answers_answers_submitted_json);
// print "<hr>";
// print "All answers NOT submitted: " . json_encode($answers_answers_not_submitted_json);
// print "<hr>";
// print "All answers picked twice: " . json_encode($answers_answers_picked_twice_json);


?>
<script type="text/javascript">
<!--
var json1 = <?php echo json_encode($rows_score_json); ?>;
var json2 = <?php echo json_encode($tester_json); ?>;
var json3 = <?php echo json_encode($rows_strategic_management_json); ?>;
var json4 = <?php echo json_encode($leadership_json); ?>;
var json5 = <?php echo json_encode($answers_counts_json); ?>;
var json6 = <?php echo json_encode($answers_counts_grouped_by_ledership_json); ?>;
var json7 = <?php echo json_encode($answers_answers_submitted_json); ?>;
var json8 = <?php echo json_encode($answers_answers_not_submitted_json); ?>;
var json9 = <?php echo json_encode($answers_answers_picked_twice_json); ?>;

//-->
</script>



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		<style>
			#main-container{margin: 30px auto 30px;padding-left: 5px;text-align: left;width: 960px;height:1200px; position:relative}
			#main-screen{ background: none repeat scroll 0 0 black	;    height: 376px;    margin-left: 35px;    margin-top: 136px;    width: 321px;}
			#left-container{}
			#top-container{background: url(img/mp-logo.png); background-size: 300px 50px; background-repeat:no-repeat;height: 55px; width: 300px; position:relative;}
			#mid-container{height: 700px; position: relative; width: 100%;}
			#bot-container{background-attachment: scroll;    background-clip: border-box;    background-color:transparent;    background-image: url("img/mp-copyright.png");    background-origin:padding-box;    background-position: 0 0;    background-repeat: no-repeat;   background-size: 347px 16px;    height: 18px;    position: relative; width: 100%;}
			#page8-2 ul li{padding:18px;}
			#nav-control a {padding-right:5px}
			#pie-logo{background: url("img/pielogo-1.png") repeat scroll -26px -19px transparent;}
			#chart{width:600px; height:600px;}
			#mp-strategic{background: url(img/mp-strategic.png) no-repeat scroll 0 0 transparent; height: 133px;  left: -137px;  position: absolute;  top: 2px;  width: 265px;}
			#mp-business{background: url(img/mp-business.png) no-repeat scroll 0 0 transparent;  bottom: 10px; height: 133px; position: absolute; right: 468px; width: 265px;}
			#mp-people{ background: url("img/mp-people.png") no-repeat scroll 0 0 transparent; height: 133px;    position: absolute;    right: 100px;    top: 33px;    width: 265px;}
		</style>
	<body>
			<div id="main-container">
				<div id="top-container">
				</div>
				<div id="mid-container">
				</div>
				<div id="bot-container">
				</div>
			</div> 
			<div id="nav-control" style="top: 1px; position: fixed;">
				<a href="javascript:mP.page1.controller();" > Page 1 </a>
				<a href="javascript:mP.page2.controller();" > Page 2 </a>
				<a href="javascript:mP.page3.controller();" > Page 3 </a>
				<a href="javascript:mP.page4.controller();" > Page 4 </a>
				<a href="javascript:mP.page5.controller();" > Page 5 </a>
				<a href="javascript:mP.page6.controller();" > Page 6 </a>
				<a href="javascript:mP.page7.controller();" > Page 7 </a>
				<a href="javascript:mP.page8.controller();" > Page 8 </a>
			</div>
		</body>
		<script type="text/javascript" >
				var _jsonOBJ = {
					"categories": [{"name":"Strategic People Management"},{"name":"Strategic Inovation Management"},{"name":"Strategic Execution Management"}],
					"sub-categories": [{"category":"Strategic Execution Management","sub_category":"mP Truth","qtd":"1"},{"category":"Strategic Inovation Management","sub_category":"mP Abundance","qtd":"1"},{"category":"Strategic People Management","sub_category":"mP Empathy","qtd":"2"},{"category":"Strategic People Management","sub_category":"mP Excellence","qtd":"1"}]
				};
				
				var mP = {
					$mid_container: jQuery('#mid-container'),
					$top_container: jQuery('#top-container'),
					$bot_container: jQuery('#bot-container'),
					page1: {
						view: '',
						controller: function (){
							var _string =[];
							_string.push('<div id="page1-1" style="left:95px; top:100px; position:relative;"><img src="img/page1-1.png" /></div>');
							_string.push('<div id="page1-2" style="position:relative; position: relative; text-align: center; top: 100px; font-size: 50px;" >'+
								'<span>' + $(json2).first().prop('title') + '.' + $(json2).first().prop('name') + '</span><br /><span>March 17th, 2012</span></div>');
							_string = _string.join('');
							mP.$mid_container.html(_string);
							_string =[];
							_string.push('<div id="page1-3" style="float: right; margin-top: -139px;"><img src="img/page1-3.png" /> </div>');
							_string = _string.join();
							mP.$bot_container.html(_string);
						}
					},
					page2: {
						view: '',
						controller: function (){
							var _string =[];
							_string.push('<div id="page2-1" style="top:60px; position:relative;"><img src="img/page2-1.png" style="width:939px;"/></div>');
							_string = _string.join('');
							mP.$mid_container.html(_string);
							mP.$bot_container.html('');
						}
					},
					page3: {
						view: '',
						controller: function (){
							var _string =[];
							_string.push('<div id="page3-1" style="top:40px; position:relative;"><img src="img/page3-1.png" style="width:939px;"/></div>');
							_string = _string.join('');
							mP.$mid_container.html(_string);
							mP.$bot_container.html('');
						}
					},
					page4: {
						view: '',
						controller: function (){
							var _string =[];
							_string.push('<div id="page4-1" style="top:40px; position:relative;"><img src="img/page4-1.png" style="width:939px;"/></div>');
							_string = _string.join('');
							mP.$mid_container.html(_string);
							mP.$bot_container.html('');
						}
					},
					page5: {
						view: '',
						controller: function (){
							mP.$mid_container.html('<div id="addText" style="position:absolute; left:0px; top:0px; z-index:1;"></div><div id="chart"></div><div id="mp-people"></div><div id="mp-strategic"></div><div id="mp-business"></div>');
							mP.$bot_container.html('');
							
							var chart;
							var colors = Highcharts.getOptions().colors,
								categories = [
									'mP Empathy <br>' + $(json5).get(0)['leadership_percentage'] + '%', 
									'mP Excellence <br>' + $(json5).get(1)['leadership_percentage']+ '%', 
									'mP Touch <br>' + $(json5).get(2)['leadership_percentage']+ '%',
									'', 
									'mP Truth <br>' + $(json5).get(3)['leadership_percentage']+ '%', 
									'mP Assessment <br>' + $(json5).get(4)['leadership_percentage']+ '%', 
									'mP Abundance <br>' + $(json5).get(5)['leadership_percentage']+ '%', 
									'', 
									'mP Belief<br>' + $(json5).get(6)['leadership_percentage']+ '%',
									'mP Unity <br>'+ $(json5).get(7)['leadership_percentage']+ '%', 
									'mP Valor <br>'+$(json5).get(8)['leadership_percentage']+ '%'
								],
								name = ' ',
								data = [
								{ y: parseInt($(json5).get(0)['leadership_percentage']), color: '#99182C', drilldown: { name: 'Detail Score', categories: ['Empathy'], 	data: [], color: '#99182C' } }, 
								{ y: parseInt($(json5).get(1)['leadership_percentage']),  color: '#99182C', drilldown: { name: 'Detail Score', categories: ['Excellence'], 	data: [], color: '#99182C'} }, 
								{ y: parseInt($(json5).get(2)['leadership_percentage']),  color: '#99182C', drilldown: { name: 'Detail Score', categories: ['Touch'], 	data: [], color: '#99182C'} }, 
								{ y: 0,  color: '#99182C', drilldown: { name: 'Detail Score', categories: ['Total'], 	data: [parseInt($(json5).get(0)['leadership_percentage'])+parseInt($(json5).get(1)['leadership_percentage'])+parseInt($(json5).get(2)['leadership_percentage'])], color: '#99182C'} },
								{ y: parseInt($(json5).get(3)['leadership_percentage']), color: '#3D5229', drilldown: { name: 'Detail Score', categories: ['Truth'], data: [], color: '#3D5229' }}, 
								{ y: parseInt($(json5).get(4)['leadership_percentage']), color: '#3D5229', drilldown: { name: 'Detail Score', categories: ['Assessment'], data: [], color: '#3D5229' }}, 
								{ y: parseInt($(json5).get(5)['leadership_percentage']), color: '#3D5229', drilldown: { name: 'Detail Score', categories: ['Abundance'], data: [], color: '#3D5229' }}, 
								{ y: 0, color: '#3D5229', drilldown: { name: 'Detail Score', categories: ['Total'], data: [parseInt($(json5).get(3)['leadership_percentage'])+parseInt($(json5).get(4)['leadership_percentage'])+parseInt($(json5).get(5)['leadership_percentage'])], color: '#3D5229' }}, 
								{ y: parseInt($(json5).get(6)['leadership_percentage']), color: colors[3], drilldown: { name: 'Detail Score', categories: ['Belief'], data: [], color: colors[3] }},
								{ y: parseInt($(json5).get(7)['leadership_percentage']), color: colors[3], drilldown: { name: 'Detail Score', categories: ['Unity'], data: [], color: colors[3] }},
								{ y: parseInt($(json5).get(8)['leadership_percentage']), color: colors[3], drilldown: { name: 'Detail Score', categories: ['Valor'], data: [], color: colors[3] }},
								{ y: 0, color: colors[3], drilldown: { name: 'Detail Score', categories: ['Total'], data: [parseInt($(json5).get(6)['leadership_percentage'])+parseInt($(json5).get(7)['leadership_percentage'])+parseInt($(json5).get(8)['leadership_percentage'])], color: colors[3] }}
								];
							
								var browserData = [];
								var versionsData = [];
								for (var i = 0; i < data.length; i++) {
									// add browser data
									browserData.push({ name: categories[i], y: data[i].y, color: data[i].color });
							
									// add version data
									for (var j = 0; j < data[i].drilldown.data.length; j++) {
										var brightness = 0.2 - (j / data[i].drilldown.data.length) / 5 ;
										versionsData.push(
											{ 
												name: data[i].drilldown.categories[j], y: data[i].drilldown.data[j], 	color: Highcharts.Color(data[i].color).brighten(brightness).get() 
											}
										);
									}
								}
							
							chart = new Highcharts.Chart({
								chart: { renderTo: 'chart', type: 'pie' },
								title: { text: '' },
								yAxis: { title: { text: 'Total percent market share' }},
								plotOptions: { pie: { shadow: false } },
								tooltip: {
									enabled:false
								},
								series: [{ name: 'Browsers', data: browserData, size: '60%',
									dataLabels: { 
										enabled: true,
										formatter: function() { return this.y > 5 ? this.point.name : null;},
										color: 'white',
										font:'bold 21px Arial',
										distance: -35
									}
								}, 
								{name: 'Versions', data: versionsData, innerSize: '60%',
								dataLabels: {
									formatter: function() {
										// display only if larger than 1
										return this.y > 1 ? '<b>'+ this.point.name +'</b> '+ this.y +'%'  : null;
									}
								}
								
								}]
							}, function(chart){
									 var textX = chart.plotLeft + (chart.plotWidth  * 0.5);
								        var textY = chart.plotTop  + (chart.plotHeight * 0.5);

								        var span = '<div id="pieChartInfoText" style="position:absolute; text-align:center;">';
								        span += '<div id="pie-logo" style="height: 139px;    margin-left: 10px;    margin-top: 15px;    width: 148px;"></div><br>';
								        span += '</div>';

								        $("#addText").append(span);
								        span = $('#pieChartInfoText');
								        span.css('left', textX + (span.width() * -0.5));
								        span.css('top', textY + (span.height() * -0.5));
								});
						
						}
					},
					page6: {
						view: '',
						controller: function (){
							mP.$mid_container.html('');
							mP.$bot_container.html('');
							
							var chart;
							var colors = Highcharts.getOptions().colors,
								categories = ['Excellence', 'Touch', 'Belief', 'Valor', 'Enpathy', 'Assessment', 'Unity','Truth', 'Abundance'],
								name = ' ',
								data = [
									{ y: parseInt($(json5).get(5)['leadership_percentage']), color: '#FFCC66'}, 
									{ y: parseInt($(json5).get(1)['leadership_percentage']), color: '#FFCC66'},
									{ y: parseInt($(json5).get(2)['leadership_percentage']), color: '#FFCC66'},
									{ y: parseInt($(json5).get(3)['leadership_percentage']), color: '#FFCC66'},
									{ y: parseInt($(json5).get(0)['leadership_percentage']), color: '#FFCC66'},
									{ y: parseInt($(json5).get(5)['leadership_percentage']), color: '#FFCC66'},
									{ y: parseInt($(json5).get(6)['leadership_percentage']), color: '#FFCC66'},
									{ y: parseInt($(json5).get(7)['leadership_percentage']), color: '#FFCC66'},
									{ y: parseInt($(json5).get(8)['leadership_percentage']), color: '#FFCC66'}
								];
							
							function setChart(name, categories, data, color) {
								chart.xAxis[0].setCategories(categories);
								chart.series[0].remove();
								chart.addSeries({ name: name, data: data, color: color || 'white' });
							}
							
							chart = new Highcharts.Chart({
								chart: { renderTo: 'mid-container', type: 'column' },
								title: { text: 'Your mindPower LeadershipTM Score Distribution' },
								xAxis: { title: {text: ' ',}, categories: categories },
								yAxis: { title: { text: ' ' }},
								plotOptions: {
									column: {
										cursor: 'pointer',
										point: {
											events: {
												click: function() {
													var drilldown = this.drilldown;
													if (drilldown) { // drill down
														setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
													} else { // restore
														setChart(name, categories, data);
													}
												}
											}
										},
										dataLabels: { 
											enabled: true, color: colors[0], style: { fontWeight: 'bold' },
											formatter: function() { return this.y +'%'; }
										}
									}
								},
								series: [{name: name, data: data, color: 'white'}, { legend:{enabled: false}, type: 'spline', name: '11% ', coor: '#DC143C', data: [11, 11, 11, 11, 11, 11, 11, 11, 11],	marker:{enabled:false} }],
								exporting: { enabled: false}
							});
						
						}
					},
					page7: {
						view: '',
						controller: function (){
														mP.$mid_container.html('');
							mP.$bot_container.html('');
							
							var chart;
							var colors = Highcharts.getOptions().colors,
								categories = ['mP Touch', 'mP Excellence', 'mP Empathy', 'mP Abundance', 'mP Truth', 'mP Assessment', 'mP Valor','mP Belief', 'mP Unity'],
								name = ' ',
								data = [
									{ y: parseInt($(json5).get(2)['leadership_percentage']), color: '#99182C'}, 
									{ y: parseInt($(json5).get(1)['leadership_percentage']), color: '#99182C'},
									{ y: parseInt($(json5).get(0)['leadership_percentage']), color: '#99182C'},
									{ y: parseInt($(json5).get(3)['leadership_percentage']), color: '#3D5229'},
									{ y: parseInt($(json5).get(4)['leadership_percentage']), color: '#3D5229'},
									{ y: parseInt($(json5).get(5)['leadership_percentage']), color: '#3D5229'},
									{ y: parseInt($(json5).get(6)['leadership_percentage']), color: colors[3]},
									{ y: parseInt($(json5).get(7)['leadership_percentage']), color: colors[3]},
									{ y: parseInt($(json5).get(8)['leadership_percentage']), color: colors[3]}
								];
							
							function setChart(name, categories, data, color) {
								chart.xAxis[0].setCategories(categories);
								chart.series[0].remove();
								chart.addSeries({ name: name, data: data, color: color || 'white' });
							}
							
							chart = new Highcharts.Chart({
								chart: { renderTo: 'mid-container', type: 'column' },
								title: { text: 'Your mindPower LeadershipTM Score Distribution' },
								xAxis: { title: {text: ' ',}, categories: categories },
								yAxis: { title: { text: ' ' }},
								plotOptions: {
									events: {
								         hide: function(a) {
								            this.yAxis.axisTitle.hide();
								         },
								        show: function() {
								            this.yAxis.axisTitle.show();
								          }
							      	},
									column: {
										cursor: 'pointer',
										point: {
											events: {
												click: function() {
													var drilldown = this.drilldown;
													if (drilldown) { // drill down
														setChart(drilldown.name, drilldown.categories, drilldown.data, drilldown.color);
													} else { // restore
														setChart(name, categories, data);
													}
												}
											}
										},
										dataLabels: { 
											enabled: true, color: colors[0], style: { fontWeight: 'bold' },
											formatter: function() { return this.y +'%'; }
										}
									}
								},
								series: [{name: name, data: data, color: 'white'},{ type: 'spline', name: '11% ', coor: '#DC143C', data: [11, 11, 11, 11, 11, 11, 11, 11, 11], marker:{enabled:false} }],
								exporting: { enabled: false}
							});
						
						}
					},
					page8: {
						view: '',
						controller: function (){
							var _string =[];
							_string.push('<div id="page8-1" style=" overflow: auto;height: 650px;position: relative;width: 100%;"><div style="top:5px; position:relative;"><img src="img/page8-1.png" style="width:939px;"/></div>');
							_string.push('<div id="page8-2" style="position: absolute; top: 138px;"><ul style="list-style: none outside none;">');
							_string.push('<li><span>mindPower of Unity (18%)</span></li>');
							_string.push('<li><span>mindPower of Assessment (18%)</span></li>');
							_string.push('<li><span>mindPower of Belief (17%)</span></li>');
							_string.push('<li><span>mindPower of Truth (14%)</span></li>');
							_string.push('<li><span>mindPower of Empathy (11%)</span></li>');
							_string.push('</div></ul>');
							_string.push('<div id="page8-3" style="color:red; position: absolute; top: 490px; left:15px"><ul style="list-style: none outside none;">');
							_string.push('<li><span>mindPower of Touch (3%)</span></li>');
							_string.push('<li><span>mindPower of Abundance (6%)</span></li>');
							_string.push('<li><span>mindPower of Excellence (7%)</span></li>');
							_string.push('<li><span>mindPower of Valor (7%)</span></li>');
							_string.push('<li><span>mindPower of Empathy (11%)</span></li>');
							_string.push('</div></ul></div>');
							_string = _string.join('');
							mP.$mid_container.html(_string);
							mP.$bot_container.html('');
						}
					}
				};
				$(document).ready(function() {
  					mP.page1.controller();
				});
		</script>
</html>