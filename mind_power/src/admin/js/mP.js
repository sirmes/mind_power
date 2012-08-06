$(document).ready(function() {
	mP.init();
	// mP.page1.controller();
	mP.pagination();
	mP.viewAll();
	BrowserDetect.init();
	mP.findBrowser();
	mP.addTickAndCross();
});

var mP = {
	$mid_container: {},
	$top_container: {},
	$bot_container: {},
	$pagination: {},
	init: function(){
		this.$mid_container = jQuery('#mid-container');
		this.$top_container = jQuery('#top-container');
		this.$bot_container = jQuery('#bot-container');
		this.$pagination = jQuery('#nav-control');
	},
	page12_newpage: false,
	allbalance: true,
	adjResObj:{
		name: '',
		val:0
	},
	adjResObj2:{
		name: '',
		val:0
	},
	page1: {
		view: '',
		controller: function (_id){
			var _string =[];
			_string.push('<div id="page1-1"><img src="img/page1-1.png" /></div>');
			_string.push('<div id="page1-2" >'+
				'<span>' + $(json2).first().prop('title') + ' ' + $(json2).first().prop('given_names') + ' ' + $(json2).first().prop('name') + '</span><br /><span style="font-size:30px">'+$(json2).first().prop('created_date')+'</span><br/><span style="font-size:30px">- private & confidential -</span></div>');
			_string = _string.join('');
			if (_id)
				$('#'+_id, mP.$mid_container).html(_string);
			else
				mP.$mid_container.html(_string);
			_string =[];
			_string.push('<div id="page1-3" style="bottom: 1px; position: absolute; right: 0;"><img src="img/page1-3.png" /> </div>');
			_string = _string.join();
			if (_id)
				$('#bot-container', $('#'+_id).parent()).append(_string);
		}
	},
	page2: {
		view: '',
		controller: function (_id){
			var _string =[];
			_string.push('<div id="page2-1" style="position:relative;"><img src="img/page2-1.png" style="width:900px;"/></div>');
			_string = _string.join('');
			if (_id)
				$('#'+_id, mP.$mid_container).html(_string);
			else
				mP.$mid_container.html(_string);
				mP.$bot_container.html('');
		}
	},
	page3: {
		view: '',
		controller: function (_id){
			var _string =[];
			_string.push('<div id="page3-1" style="position:relative;"><img src="img/page3-1.png" style="width:885px;"/></div>');
			_string = _string.join('');
			if (_id)
				$('#'+_id, mP.$mid_container).html(_string);
			else
				mP.$mid_container.html(_string);
			mP.$bot_container.html('');
		}
	},
	page4: {
		view: '',
		controller: function (_id){
			var _string =[];
			_string.push('<div id="page4-1" style="position:relative;"><img src="img/page4-1.png" style="width:939px; height: 665px;"/></div>');
			_string = _string.join('');
			if (_id)
				$('#'+_id, mP.$mid_container).html(_string);
			else
				mP.$mid_container.html(_string);
			mP.$bot_container.html('');
		}
	},
	page5: {
		view: '',
		controller: function (_id){
			mP.adjRes(json7);
			if (_id)
				$('#'+_id, mP.$mid_container).html('<div id="addText" style="position:relative; left:0px; top:0px; z-index:1;"></div><div id="chart5" style="height:500px; width:700px;"></div><div id="mp-people"><img src="img/mp-people.png" /></div><div id="mp-strategic"><img src="img/mp-strategic.png" /></div><div id="mp-business"><img src="img/mp-business.png" /></div><div class="all-balance">Remark: in the best scenario when all mindPowers are well balance, each mP will be 11%</div>');
			else
				mP.$mid_container.html('<div id="addText" style="position:relative; left:0px; top:0px; z-index:1;"></div><div id="chart"></div><div id="mp-people"></div><div id="mp-strategic"></div><div id="mp-business"></div>');
			mP.$bot_container.html('');
			var chart;
			var colors = Highcharts.getOptions().colors,
				categories = [
					(parseInt(Math.round(parseFloat($(json7).get(2)['leadership_percentage']))) + parseInt(Math.round(parseFloat($(json7).get(0)['leadership_percentage']))) + parseInt(Math.round(parseFloat($(json7).get(1)['leadership_percentage'])))) + '% <span style="font-size:14px;">仁</span>', 
					(parseInt(Math.round(parseFloat($(json7).get(3)['leadership_percentage']))) + parseInt(Math.round(parseFloat($(json7).get(5)['leadership_percentage']))) + parseInt(Math.round(parseFloat($(json7).get(4)['leadership_percentage'])))) + '% <span style="font-size:14px;">智</span>', 
					(parseInt(Math.round(parseFloat($(json7).get(6)['leadership_percentage']))) + parseInt(Math.round(parseFloat($(json7).get(7)['leadership_percentage']))) + parseInt(Math.round(parseFloat($(json7).get(8)['leadership_percentage'])))) + '% <span style="font-size:14px;">勇</span>',
				],
				name = ' ',
				data = [
				{ y: (parseInt(Math.round(parseFloat($(json7).get(2)['leadership_percentage'])))+parseInt(Math.round(parseFloat($(json7).get(0)['leadership_percentage'])))+parseInt(Math.round(parseFloat($(json7).get(1)['leadership_percentage'])))),  color: '#99182C', drilldown: { name: 'AAA', categories: [$(json7).get(2)['leadership'],$(json7).get(0)['leadership'],$(json7).get(1)['leadership']], 	data: [ parseInt(Math.round(parseFloat($(json7).get(2)['leadership_percentage']))), parseInt(Math.round(parseFloat($(json7).get(0)['leadership_percentage']))), parseInt(Math.round(parseFloat($(json7).get(1)['leadership_percentage']))) ], color: '#99182C'} },
				{ y: (parseInt(Math.round(parseFloat($(json7).get(3)['leadership_percentage'])))+parseInt(Math.round(parseFloat($(json7).get(5)['leadership_percentage'])))+parseInt(Math.round(parseFloat($(json7).get(4)['leadership_percentage'])))), color: '#3D5229', drilldown: { name: 'BBB', categories: [$(json7).get(3)['leadership'],$(json7).get(5)['leadership'],$(json7).get(4)['leadership']], data: [ parseInt(Math.round(parseFloat($(json7).get(3)['leadership_percentage']))), parseInt(Math.round(parseFloat($(json7).get(5)['leadership_percentage']))), parseInt(Math.round(parseFloat($(json7).get(4)['leadership_percentage']))) ], color: '#3D5229' }}, 
				{ y: (parseInt(Math.round(parseFloat($(json7).get(6)['leadership_percentage'])))+parseInt(Math.round(parseFloat($(json7).get(8)['leadership_percentage'])))+parseInt(Math.round(parseFloat($(json7).get(7)['leadership_percentage'])))), color: colors[3], drilldown: { name: 'CCC', categories: [$(json7).get(6)['leadership'],$(json7).get(8)['leadership'],$(json7).get(7)['leadership']], data: [parseInt(Math.round(parseFloat($(json7).get(6)['leadership_percentage']))), parseInt(Math.round(parseFloat($(json7).get(8)['leadership_percentage']))), parseInt(Math.round(parseFloat($(json7).get(7)['leadership_percentage'])))], color: colors[3] }}
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
				chart: { renderTo: 'chart5', type: 'pie' },
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
				{name: 'Versions', data: versionsData, innerSize: '55%',
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
				        span += '<div id="pie-logo" style="height: 139px;   margin-top: 15px;    width: 148px;"><img src="img/pielogo-1.png" /></div><br>';
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
		controller: function (_id){
			mP.adjRes(json5);
			var _legendString = '';
			_legendString = '<div id="chart6-legend" style="font-size: 12px;">';
			$(json5).each(function (num1, it1){
				var lastPage = false;
				if (num1 == 0)
					_legendString +='<ul>';
				else if( num1 ==3 || num1==6){
					_legendString += '</ul><ul>'
				}
				else if (num1 == 8)
					lastPage = true;
				_legendString += '<li>' + it1.leadership + ' : ' + mP.legendMap[it1.leadership] + '</li>';
				if (lastPage)
					_legendString += '</ul></div>';
			});
			if (_id)
				$('#'+_id, mP.$mid_container).html('<div id="chart6-header" style="text-align: center;"><h1>Your mindPower Leadership<sup>TM</sup> Score Distribution</h1></div><div id="chart6" style="height:400px"></div>' + _legendString + '<div class="all-balance">Remark: in the best scenario when all mindPowers are well balance, each mP will be 11%</div>');
			else
				mP.$mid_container.html('<div id="chart6"></div>');

			mP.$bot_container.html('');
			
			var chart;
			var colors = Highcharts.getOptions().colors,
				categories = 	[ 	$(json5).get(0)['leadership'], $(json5).get(1)['leadership'], $(json5).get(2)['leadership'], $(json5).get(3)['leadership'], 
									$(json5).get(4)['leadership'], $(json5).get(5)['leadership'], $(json5).get(6)['leadership'], $(json5).get(7)['leadership'], 
									$(json5).get(8)['leadership'] 
								],
				name = ' ',
				data = 	[	{ y: parseInt(Math.round(parseFloat($(json5).get(0)['leadership_percentage']))), color: '#FFCC66'}, { y: parseInt(Math.round(parseFloat($(json5).get(1)['leadership_percentage']))), color: '#FFCC66'},
							{ y: parseInt(Math.round(parseFloat($(json5).get(2)['leadership_percentage']))), color: '#FFCC66'}, { y: parseInt(Math.round(parseFloat($(json5).get(3)['leadership_percentage']))), color: '#FFCC66'},
							{ y: parseInt(Math.round(parseFloat($(json5).get(4)['leadership_percentage']))), color: '#FFCC66'}, { y: parseInt(Math.round(parseFloat($(json5).get(5)['leadership_percentage']))), color: '#FFCC66'},
							{ y: parseInt(Math.round(parseFloat($(json5).get(6)['leadership_percentage']))), color: '#FFCC66'}, { y: parseInt(Math.round(parseFloat($(json5).get(7)['leadership_percentage']))), color: '#FFCC66'},
							{ y: parseInt(Math.round(parseFloat($(json5).get(8)['leadership_percentage']))), color: '#FFCC66'}
						];
			
			function setChart(name, categories, data, color) {
				chart.xAxis[0].setCategories(categories);
				chart.series[0].remove();
				chart.addSeries({ name: name, data: data, color: color || 'white' });
			}
			
			chart = new Highcharts.Chart({
				chart: { renderTo: 'chart6', type: 'column' },
				title: { text: '' },
				xAxis: { title: {text: ' '}, categories: categories, labels:{formatter:function (){if (this.value <0 || this.value >8) return ''; else return this.value;}}  },
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
				series: [{name:name,data: data, color: 'white'}, { legend:{enabled: false}, type: 'spline', name: '11% ', coor: '#DC143C', data: [{x:-1,y:11}, 11,11, 11, 11, 11, 11, 11, 11, 11, {x:9,y:11}],	marker:{enabled:false} }],
				exporting: { enabled: false}
			});
		
		}
	},
	page7: {
		view: '',
		controller: function (_id){
			if (_id)
				$('#'+_id, mP.$mid_container).html('<div id="chart7-header" style="text-align: center;"><h1>Your mindPower Leadership<sup>TM</sup> Score Distribution</h1></div><div id="chart7" style="height:400px;"></div><div id="chart7-legend" style="font-size: 12px;"><ul class="mini-logo"><li style="margin-top: 56px; margin-left: -100px;"><img src="img/mini-red-logo.png" style="width:40px;"/></li><li style="margin-left: 59px; margin-top: 56px;"><img src="img/mini-green-logo.png" style="width:40px;"/></li><li style="margin-left: 75px; margin-top: 56px;"><img src="img/mini-purple-logo.png" style="width:40px;"/></li></ul><ul style="background-color:#99182C"><li>mP Excellence : Business Acumen</li><li>mP Touch : Inspiration</li><li>mP Empathy : Building Relationship</li></ul><ul style="background-color:#3D5229"><li>mP Truth : Decision Making</li><li>mP Abundance : Innovation</li><li>mP Assessment : Strategic Planning</li></ul><ul style="background-color:purple"><li>mP Valor : Driving Change</li><li>mP Belief : Benchmarking</li><li>mP Unity : Teamwork</li></ul></div>' + '<div class="all-balance">Remark: in the best scenario when all mindPowers are well balance, each mP will be 11%</div>');
			else
				mP.$mid_container.html('<div id="chart7"></div>');
			mP.$bot_container.html('');
			
			var chart;
			var colors = Highcharts.getOptions().colors,
				categories = 	[ 	$(json7).get(0)['leadership'], $(json7).get(1)['leadership'], $(json7).get(2)['leadership'], $(json7).get(3)['leadership'],
									$(json7).get(4)['leadership'], $(json7).get(5)['leadership'], $(json7).get(6)['leadership'], $(json7).get(7)['leadership'],
									$(json7).get(8)['leadership']
								],
				name = ' ',
				data = 	[	{ y: parseInt(Math.round(parseFloat($(json7).get(0)['leadership_percentage']))), color: '#99182C'},  { y: parseInt(Math.round(parseFloat($(json7).get(1)['leadership_percentage']))), color: '#99182C'},
							{ y: parseInt(Math.round(parseFloat($(json7).get(2)['leadership_percentage']))), color: '#99182C'},  { y: parseInt(Math.round(parseFloat($(json7).get(3)['leadership_percentage']))), color: '#3D5229'},
							{ y: parseInt(Math.round(parseFloat($(json7).get(4)['leadership_percentage']))), color: '#3D5229'},  { y: parseInt(Math.round(parseFloat($(json7).get(5)['leadership_percentage']))), color: '#3D5229'},
							{ y: parseInt(Math.round(parseFloat($(json7).get(6)['leadership_percentage']))), color: colors[3]},  { y: parseInt(Math.round(parseFloat($(json7).get(7)['leadership_percentage']))), color: colors[3]},
							{ y: parseInt(Math.round(parseFloat($(json7).get(8)['leadership_percentage']))), color: colors[3]}
						];
			
			function setChart(name, categories, data, color) {
				chart.xAxis[0].setCategories(categories);
				chart.series[0].remove();
				chart.addSeries({ name: name, data: data, color: color || 'white' });
			}
			
			chart = new Highcharts.Chart({
				chart: { renderTo: 'chart7', type: 'column' },
				title: { text: '' },
				xAxis: { title: {text: ' '}, categories: categories, labels:{formatter:function (){if (this.value <0 || this.value >8) return ''; else return this.value;}} },
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
				series: [{name: name, data: data, color: 'white'},{ type: 'spline', name: '11% ', coor: '#DC143C', data: [{x:-1,y:11}, 11,11, 11, 11, 11, 11, 11, 11, 11, {x:9,y:11}], marker:{enabled:false} }],
				exporting: { enabled: false}
			});
		
		}
	},
	page8: {
		view: '',
		controller: function (_id){
			var _string =[];
			_string.push('<div id="page8-1" style="position:relative;"><img src="img/8-new.png" style="width:700px;"/></div>');
			_string = _string.join('');
			if (_id)
				$('#'+_id, mP.$mid_container).html(_string);
			else
				mP.$mid_container.html(_string);
			mP.$bot_container.html('');
		}
	},
	page9: {
		view: '',
		controller: function (_id){
			var _string =[];
			_string.push('<div style=""><div id="page9-1" style=" position: relative;width: 100%;"><div style="top:5px; position:relative;"><img src="img/page8-1.png" style="width:939px;"/></div>');
			_string.push('<ul style="list-style: none outside none; padding:0px; margin:0px;">');
			$(top3).each(function (num1, it1){
				if (it1.leadership_percentage < 11.49)
					return;
				if (it1.leadership == mP.adjResObj.name)
					_string.push('<li class="top3"><span>' + mP.adjResObj.name + ' (' + mP.adjResObj.val + '%) </span></li>');
				else
					_string.push('<li class="top3"><span>' + it1.leadership + ' (' + Math.round(parseFloat(it1.leadership_percentage)) + '%) </span></li>');
			});
			_string.push('</div></ul>');
			_string.push('<div id="page8-2" style="position: relative;"><div style="top:5px; position:relative;"><img src="img/page8-2.png" style="width:750px;"/></div><ul style="list-style: none outside none; margin:0px; padding:0px;">');
			
			$(bottom3).each(function (num1, it1){
				if (it1.leadership_percentage > 11.50)
					return;
				if (it1.leadership == mP.adjResObj2.name)
					_string.push('<li class="top3"><span>' + mP.adjResObj2.name + ' (' + mP.adjResObj2.val + '%) </span></li>');
				else
					_string.push('<li class="bottom3"><span>' + it1.leadership + ' (' + Math.round(parseFloat(it1.leadership_percentage)) + '%) </span></li>');
			});

			_string.push('</ul></div><div style="top:5px; position:relative;"><img src="img/page8-3.png" style="width:750px;"/></div></div>');
			_string = _string.join('');
			if (_id)
				$('#'+_id, mP.$mid_container).html(_string);
			else
				mP.$mid_container.html(_string);
			mP.$bot_container.html('');
		}
	},
	page10: {
		view: '',
		controller: function (_id){
			var _string =[];
			var _currentGroup = '';
			var _newGroup = false;
			var _firstTime = false;
			_string.push('<div style=""><div id="page10-1" style=" position: relative;width: 100%;">');
			_string.push('<div style="top:5px; position:relative;"><img src="img/page9-1.png" style="width:939px;"/></div>');
			$(json8).each(function (num1, it1){
				if(it1.leadership_percentage < 11.49)
					return;
				if (_currentGroup =='' ){
					_firstTime = true;
					_currentGroup = it1.leadership;
				}
				else if( _currentGroup != it1.leadership){
					_currentGroup = it1.leadership;
					_newGroup = true;
					_firstTime = false;
				}
				else{
					_newGroup = false;
					_firstTime = false;	
				}
				if (_firstTime)
					_string.push('<ul style="list-style: none outside none; padding:0px; margin: 15px 0 0 30px;"><span style="font-size: 20px; font-weight: bold;">'+_currentGroup+'</span>');
				else if (_newGroup)
					_string.push('</ul><ul style="list-style: none outside none; padding:0px; margin: 15px 0 0 30px;"><span style="font-size: 20px; font-weight: bold;">'+_currentGroup+'</span>');
				_string.push('<li class=""><img src="img/page9-2.png" /><span>' + it1.question + ' </span></li>');
			});
			_string.push('</div></ul>');
			_string = _string.join('');
			if (_id)
				$('#'+_id, mP.$mid_container).html(_string);
			else
				mP.$mid_container.html(_string);
			mP.$bot_container.html('');
		}
	},
	page11: {
		view: '',
		controller: function (_id){
			var _string =[];
			var _currentGroup = '';
			var _newGroup = false;
			var _firstTime = false;
			var cont_groupName = '';
			var cont_pos = 0;
			_string.push('<div style=""><div id="page11-1" style=" position: relative;width: 100%;">');
			_string.push('<div style="top:5px; position:relative;"><img src="img/page10-1.png" style="width:939px;"/></div>');
			$(json9).each(function (num1, it1){
				if (_currentGroup =='' ){
					_firstTime = true;
					_currentGroup = it1.leadership;
				}
				else if( _currentGroup != it1.leadership){
					_currentGroup = it1.leadership;
					_newGroup = true;
					_firstTime = false;
				}
				else{
					_newGroup = false;
					_firstTime = false;	
				}
				if (_firstTime)
					_string.push('<ul ><span style="color:red; font-size: 20px; font-weight: bold;">'+_currentGroup+'</span>');
				else if (_newGroup)
					_string.push('</ul><ul><span style="color: red; font-size: 20px; font-weight: bold;">'+_currentGroup+'</span>');
				_string.push('<li class=""><img src="img/page10-2.png" /><span>' + it1.question + ' </span></li>');
				if (num1 == 16){
					cont_groupName = _currentGroup;
					cont_pos = num1;
					mP.page12_newpage = true;
					return false;
				}
			});
			_string.push('</div></ul>');
			_string = _string.join('');
			if (_id)
				$('#'+_id, mP.$mid_container).html(_string);
			else
				mP.$mid_container.html(_string);
			mP.$bot_container.html('');

			function addpage12_newpage (name, pos){
				var _string =[];
				var _currentGroup = '';
				var _newGroup = false;
				var _firstTime = false;
				_string.push('<div style=""><div id="page11-1-new" style=" position: relative;width: 100%;">');
				_string.push('<div style="top:5px; position:relative;"><img src="img/page10-1.png" style="width:939px;"/></div>');
				$(json9).each(function (num1, it1){
					if (num1 < pos || num1 ==pos)
						return;
					if (_currentGroup =='' ){
						_firstTime = true;
						_currentGroup = it1.leadership;
					}
					else if( _currentGroup != it1.leadership){
						_currentGroup = it1.leadership;
						_newGroup = true;
						_firstTime = false;
					}
					else{
						_newGroup = false;
						_firstTime = false;	
					}
					if (_firstTime)
						_string.push('<ul ><span style="color:red; font-size: 20px; font-weight: bold;">'+_currentGroup+'</span>');
					else if (_newGroup)
						_string.push('</ul><ul><span style="color: red; font-size: 20px; font-weight: bold;">'+_currentGroup+'</span>');
					_string.push('<li class=""><img src="img/page10-2.png" /><span>' + it1.question + ' </span></li>');
				});
				_string.push('</div></ul>');
				_string = _string.join('');
				$('#mid-container11-new', mP.$mid_container).html(_string);
				$('#p11-new').css('display','block');
				mP.$bot_container.html('');
			}
			if (mP.page12_newpage){
				mP.page12_newpage = false;
				addpage12_newpage(cont_groupName, cont_pos);
			}

		}
	},
	page12: {
		view: '',
		controller: function (_id){
			var _string =[];
			_string.push('<div style=""><div id="page12-1" style=" position: relative;width: 100%;">');
			_string.push('<div style="top:75px; position:relative;"><img src="img/page12-1.png" style="width:939px;"/></div>');
			_string.push('</div>');
			_string = _string.join('');
			if (_id)
				$('#'+_id, mP.$mid_container).html(_string);
			else
				mP.$mid_container.html(_string);
			mP.$bot_container.html('');
		}
	},
	legendMap:{
		"mP Excellence" : "Business Acumen",
		"mP Touch" : "Inspiration",
		"mP Empathy" : "Building Relationship",
		"mP Truth" : "Decision Making",
		"mP Abundance" : "Innovation",
		"mP Assessment" : "Strategic Planning",
		"mP Valor" : "Driving Change",
		"mP Belief" : "Benchmarking",
		"mP Value" : "Benchmarking",
		"mP Unity" : "Teamwork"
	},
	adjRes:function (_currentJSON){
		var _tempTotal = 0;
		$(_currentJSON).each(function (num1,it1){
		    _tempTotal = Math.round(parseFloat(it1.leadership_percentage)) + _tempTotal;
		    if (mP.allbalance == true && Math.round(parseFloat(it1.leadership_percentage)) != 11)
		    	mP.allbalance = false;
		});
		var _resultArray = [];
		if (_tempTotal != 100){
			$(_currentJSON).each(function (num1,it1){
			    _result = parseFloat(it1.leadership_percentage) - Math.round(parseFloat(it1.leadership_percentage));
			    _result = 0.5 - Math.abs(_result);
			    _resultArray.push(_result);
			});
			var _currentSmallest = null;
			var _currentSPos  = 0;
			$(_resultArray).each(function (num1,it1){
				if (_currentSmallest == null){
					_currentSmallest = it1;
					_currentSPos = num1;
				}
				if (_currentSmallest >it1){
					_currentSPos = num1;
					_currentSmallest = it1;
				}
			});
			if (_tempTotal > 100){
				$(_currentJSON).get(_currentSPos)['leadership_percentage'] = parseInt($(_currentJSON).get(_currentSPos)['leadership_percentage'])+'';
				mP.adjResObj.name = $(_currentJSON).get(_currentSPos)['leadership'];
				mP.adjResObj.val = $(_currentJSON).get(_currentSPos)['leadership_percentage'];
			}
			else if (_tempTotal <100){
				$(_currentJSON).get(_currentSPos)['leadership_percentage'] = Math.round($(_currentJSON).get(_currentSPos)['leadership_percentage'])+'';
				mP.adjResObj2.name = $(_currentJSON).get(_currentSPos)['leadership'];
				mP.adjResObj2.val = $(_currentJSON).get(_currentSPos)['leadership_percentage'];
			}
			
		}
	},
	pagination: function (){
		var updatePage = function (_this, _cur, _next, _prev){
			$(_this).attr('data-current', _cur);
			$(_this).attr('data-next', _next);
			$(_this).attr('data-prev', _prev);
		};
		var goNext = function (_this){
			var _currentPage = $(this).attr('data-current');
			var _nextPage = $(this).attr('data-next');
			var _prevPage = $(this).attr('data-prev');
			if (_currentPage == '1')
				$('#nav-control-prev', mP.$pagination).show();
			else if (_currentPage == '9')
				$('#nav-control-next', mP.$pagination).hide();
			else{
				$('#nav-control-prev', mP.$pagination).show();
				$('#nav-control-next', mP.$pagination).show();
			}
			mP['page' + _nextPage].controller();
			updatePage($(this), _nextPage, parseInt(_nextPage) + 1, _currentPage);
			updatePage($('#nav-control-prev', mP.$pagination),  _nextPage, parseInt(_nextPage) + 1, _currentPage);
		};
		var goBack = function (_this){
			var _currentPage = $(this).attr('data-current');
			var _nextPage = $(this).attr('data-next');
			var _prevPage = $(this).attr('data-prev');
			if (_currentPage == '2')
				$('#nav-control-prev', mP.$pagination).hide();
			else if (_currentPage == '10')
				$('#nav-control-next', mP.$pagination).show();
			else{
				$('#nav-control-prev', mP.$pagination).show();
				$('#nav-control-next', mP.$pagination).show();
			}
			mP['page' + _prevPage].controller();
			updatePage($(this), _prevPage, _currentPage, parseInt(_prevPage - 1));
			updatePage($('#nav-control-next', mP.$pagination), _prevPage, _currentPage, parseInt(_prevPage - 1));
		};
		$('#nav-control-next', mP.$pagination).click(goNext);
		$('#nav-control-prev', mP.$pagination).click(goBack);
	},
	viewAll: function (){
		var showAll = function (_this){
			var _pageString = 	'<div id="p1" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container1"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p2" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container2"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p3" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container3"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p4" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container4"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p5" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container5"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p8" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container8"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p6" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container6"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p7" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container7"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p9" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container9"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p10" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container10"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p11" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container11"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p11-new" class="report-template" style="display:none;"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container11-new"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p12" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container12"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>';
			mP.$mid_container.html(_pageString);
			var initAll = function (){
				mP.page1.controller('mid-container1');
				mP.page2.controller('mid-container2');
				mP.page3.controller('mid-container3');
				mP.page4.controller('mid-container4');
				mP.page5.controller('mid-container5');
				mP.page6.controller('mid-container6');
				mP.page7.controller('mid-container7');
				mP.page8.controller('mid-container8');
				mP.page9.controller('mid-container9');
				mP.page10.controller('mid-container10');
				mP.page11.controller('mid-container11');
				mP.page12.controller('mid-container12');
			};
			initAll();
		};
		return showAll();
	},
	findBrowser: function(){
		var _currentB = BrowserDetect.browser;
		if (_currentB.toLowerCase().indexOf('chrome') > -1){
			this.$mid_container.addClass('chrome');
		}
		else if (_currentB.toLowerCase().indexOf('fire') > -1){
			this.$mid_container.addClass('firefox');
			if ($('#page11-1 li').index() > 25)
				$('#page11-1 ul').css('font-size', $('#page11-1 li').index() + 4.5 - 25+'px')
		}
		else{
			this.$mid_container.addClass('firefox');
			if ($('#page11-1 li').index() > 25)
				$('#page11-1 ul').css('font-size', $('#page11-1 li').index() + 4.5 - 25+'px')
		}
	},
	addTickAndCross: function (){
		var _currentB = BrowserDetect.browser;
		var _list = [];
		var _temp_top  = $('#p6').position().top;
		var _temp_bot_3 = 0;
		var _temp_top_3 = 0;
		var _temp_bot_last_pos = 0;
		var _temp_top_last_pos = 0;
		if (_currentB.toLowerCase().indexOf('chrome') > -1){
			$('#mid-container6 .highcharts-data-labels rect').each(function (num1, it1){
				_list.push({
					val: 	$(it1).next().find('tspan').text().replace('%',''),
					top: 	Math.abs($(it1).position().top),
					left: 	Math.abs($(it1).position().left)
				});
			});
			$(_list).each(function (num1, it1){
				if (it1.val < 11){
					$('#chart6 .highcharts-container').append('<img src="img/cross.png" style="position:absolute; z-index:1; top:'+ (it1.top -5) + 'px; left:' + (it1.left - 20) + 'px">');
				}
				else if (it1.val > 11){
					$('#chart6 .highcharts-container').append('<img src="img/check.png" style="position:absolute; z-index:1; top:'+ ( it1.top -5) + 'px; left:' + (it1.left -20) + 'px;">');
				}
			});

		}
		else{
			$('#mid-container6 .highcharts-data-labels tspan').each(function (num1, it1){
				_list.push({
					val: 	$(it1).text().replace('%',''),
					top: 	Math.abs($(it1).position().top),
					left: 	Math.abs($(it1).position().left)
				});
			});
			$(_list).each(function (num1, it1){
				if ( (parseFloat(it1.val) < 11 && _temp_bot_3 < 3) || ( _temp_bot_last_pos == (num1 - 1) && parseFloat(it1.val) < 11 && $(_list).eq(num1-1).prop('val') == it1.val)){
					$('#chart6 .highcharts-container').append('<img src="img/cross.png" style="position:absolute; z-index:1; top:'+ (it1.top - _temp_top - 215) + 'px; left:' + (it1.left - 220) + 'px">');
					_temp_bot_3 ++;
					_temp_bot_last_pos = num1;
				}
				else if ( (parseFloat(it1.val) > 11 && _temp_top_3 < 3) || ( _temp_bot_last_pos == (num1 - 1) && parseFloat(it1.val) < 11 && $(_list).eq(num1-1).prop('val') == it1.val)){
					$('#chart6 .highcharts-container').append('<img src="img/check.png" style="position:absolute; z-index:1; top:'+ ( it1.top - _temp_top - 215) + 'px; left:' + (it1.left - 220) + 'px;">');
					_temp_top_3 ++;
					_temp_top_last_pos = num1;
				}
			});
		}

		//$('#mid-container6 .highcharts-data-labels tspan').first().position().top-$('#mid-container6 .highcharts-data-labels').position().top

		if (mP.allbalance)
			$('.all-balance').css('display','block');
	}
};

var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera",
			versionSearch: "Version"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			   string: navigator.userAgent,
			   subString: "iPhone",
			   identity: "iPhone/iPod"
	    },
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};