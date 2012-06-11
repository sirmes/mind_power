<?php include 'backend_code.php' ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/mP.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		<style>
			#main-container{margin:auto;padding-left: 5px;text-align: left;width: 960px; position:relative}
			#main-screen{ background: none repeat scroll 0 0 black	;    height: 376px;    margin-left: 35px;    margin-top: 136px;    width: 321px;}

			#top-container{height: 55px; width: 300px; position:relative;}
			#top-container img{height: 50px;    width: 300px;}
			#mid-container{position: relative;}
			#bot-container{}
			
			#page8-2 ul li{}
			
			#nav-control a {padding-right:5px}
			#pie-logo{}
			#chart{width:800px; height:600px;}
			
			#mp-strategic{ left: -50px;    position: relative;    top: -540px;}
			#mp-strategic img{position: absolute;}
			#mp-business{ left: 375px;    position: relative;    top: -30px;}
			#mp-business img{position: absolute;}
			#mp-people{ position: relative;    right: -709px;    top: -595px;}
			#mp-people img{position: absolute;}

			.top3{ border: 2px solid orange;   border-radius: 25px 25px 25px 25px;   margin-bottom: 5px;    padding-left: 23px;    padding-top: 0;    width: 350px;}
			.bottom3{ border: 2px solid red;  border-radius: 25px 25px 25px 25px;   margin-bottom: 5px;    padding-left: 23px;    padding-top: 0;    width: 350px;}
			
			.firefox #p1{height: 815px;   width: 930px;}
			.firefox #page1-1{height: 200px;    left: 95px;    padding-top: 100px;    position: relative;}
			.firefox #page1-2{font-size: 50px; padding-bottom: 50px;    padding-top: 45px;    position: relative;    text-align: center;}
			.firefox #p1 #bot-container{bottom:0px;}
			
			.firefox #p2{height: 815px;   width: 930px;}
			.firefox #p2 #mid-container2{padding-top: 70px;}
			
			.firefox #p3{height: 815px;   width: 930px;}
			.firefox #p3 #mid-container3{padding-top:60px;}
			
			.firefox #p4{height: 815px;   width: 930px;}
			.firefox #p4 #mid-container4{padding-top: 50px;}
			.firefox #p4 #bot-container{bottom:0px;margin-top:0px;}

			.firefox #p5{height: 815px;   width: 930px;}
			.firefox #p5 #mid-container5{padding-top: 45px;}
			.firefox #chart5{height:550px;}

			.firefox #p6{height: 815px;   width: 930px;}
			.firefox #p6 #mid-container6{padding-top: 75px;}
			.firefox #chart6{height:550px;}
			
			.firefox #p7{height: 815px;   width: 930px;}
			.firefox #chart7{height:550px;}
			.firefox #p7 #mid-container7{padding-top: 75px;}

			.firefox #p8{height: 815px;   width: 930px;}
			.firefox #p8 #mid-container8{padding-top: 50px;}

			.firefox #p9{height: 815px;   width: 930px;}
			.firefox #p9 #mid-container9{padding-top: 60px;}

			.firefox #p10{height: 815px;   width: 930px;}
			.firefox #p10 #mid-container10{padding-top: 30px;}

			.firefox #p11{height: 815px;   width: 930px;}
			.firefox #p11 #mid-container11{}

			.firefox .copyR{bottom: 1px;    position: absolute;}
			.firefox .report-template{ position: relative;}
			.firefox #page11-1 ul{list-style: none outside none;    margin: 0;    padding: 20px 0 0 30px;}



			.chrome #p1{height: 1050px;   width: 930px;}
			.chrome #mid-container1{}
			.chrome #page1-1{height: 200px;    left: 95px;    padding-top: 100px;    position: relative;}
			.chrome #page1-2{font-size: 50px; padding-bottom: 50px;    padding-top: 45px;    position: relative;    text-align: center;}
			.chrome #p1 #bot-container{bottom:0px;}
			
			.chrome #p2{height: 1050px;   width: 930px;}
			.chrome #p2 #mid-container2{padding-top: 70px;}
			
			.chrome #p3{height: 1050px;   width: 930px;}
			.chrome #p3 #mid-container3{padding-top:60px;}
			
			.chrome #p4{height: 1050px;   width: 930px;}
			.chrome #p4 #mid-container4{padding-top: 20px;}
			.chrome #p4 #bot-container{bottom:0px;margin-top:0px;}

			.chrome #p5{height: 1050px;   width: 930px;}
			.chrome #p5 #mid-container5{padding-top: 45px;}
			.chrome #chart5{height:550px;}

			.chrome #p6{height: 1050px;   width: 930px;}
			.chrome #p6 #mid-container6{padding-top: 75px;}
			.chrome #chart6{height:550px;}
			
			.chrome #p7{height: 1050px;   width: 930px;}
			.chrome #chart7{height:550px;}
			.chrome #p7 #mid-container7{padding-top: 75px;}

			.chrome #p8{height: 1050px;   width: 930px;}
			.chrome #p8 #mid-container8{padding-top: 50px;}

			.chrome #p9{height: 1050px;   width: 930px;}
			.chrome #p9 #mid-container9{padding-top: 60px;}

			.chrome #p10{height: 1050px;   width: 930px;}
			.chrome #p10 #mid-container10{padding-top: 30px;}

			.chrome #p11{height: 1050px;   width: 930px;}
			.chrome #p11 #mid-container11{padding-top: 30px;}

			.chrome .copyR{bottom: 1px;    position: absolute;}
			.chrome .report-template{ position: relative;}
			.chrome #page11-1 ul{list-style: none outside none;    margin: 0;    padding: 20px 0 0 30px;}


		</style>
		<script>
			var json1 = <?php echo json_encode($rows_score_json); ?>;
			var json2 = <?php echo json_encode($tester_json); ?>;
			var json3 = <?php echo json_encode($rows_strategic_management_json); ?>;
			var json4 = <?php echo json_encode($leadership_json); ?>;
			var json5 = <?php echo json_encode($answers_counts_json); ?>;
			var json6 = <?php echo json_encode($answers_counts_json); ?>;
			var json7 = <?php echo json_encode($answers_counts_grouped_by_ledership_json); ?>;
			var json8 = <?php echo json_encode($answers_answers_picked_twice_json); ?>;
			var json9 = <?php echo json_encode($answers_answers_not_submitted_json); ?>;
			var temp123 = <?php echo json_encode($answers_answers_submitted_json); ?>;
			var top3 = <?php echo json_encode($top_3_json); ?>;
			var bottom3 = <?php echo json_encode($bottom_3_json); ?>;
		</script>
	<body>
		<div id="main-container">
			<div id="mid-container"></div>
		</div> 
		<div id="nav-control" style="top: 1px; position: fixed;">
			<!-- <a href="#" id="nav-control-all" data-current="all"> View All </a> -->
			<!-- <a href="#" id="nav-control-next" data-current="1" data-prev="0" data-next="2"> Next Page </a>
			<a href="#" id="nav-control-prev" data-current="2" data-prev="1" data-next="3" style="display:none;"> Previous Page </a> -->
		</div>
	</body>
</html>