$(document).ready(function() {
	mP.init();
	// mP.page1.controller();
	mP.pagination();
	mP.viewAll();
	BrowserDetect.init();
	mP.findBrowser();
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
	page1: {
		view: '',
		controller: function (_id){
			var _string =[];
			_string.push('<div id="page1-1"><img src="img/page1-1.png" /></div>');
			_string.push('<div id="page1-2" >'+
				'<span>' + $(json2).first().prop('title') + '.' + $(json2).first().prop('name') + '</span><br /><span>'+$(json2).first().prop('created_date')+'</span></div>');
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
			_string.push('<div id="page2-1" style="position:relative;"><img src="img/page2-1.png" style="width:939px;"/></div>');
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
			_string.push('<div id="page3-1" style="position:relative;"><img src="img/page3-1.png" style="width:939px;"/></div>');
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
			_string.push('<div id="page4-1" style="position:relative;"><img src="img/page4-1.png" style="width:939px;"/></div>');
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
			if (_id)
				$('#'+_id, mP.$mid_container).html('<div id="addText" style="position:relative; left:0px; top:0px; z-index:1;"></div><div id="chart5"></div><div id="mp-people"><img src="img/mp-people.png" /></div><div id="mp-strategic"><img src="img/mp-strategic.png" /></div><div id="mp-business"><img src="img/mp-business.png" /></div>');
			else
				mP.$mid_container.html('<div id="addText" style="position:relative; left:0px; top:0px; z-index:1;"></div><div id="chart"></div><div id="mp-people"></div><div id="mp-strategic"></div><div id="mp-business"></div>');
			mP.$bot_container.html('');
			var chart;
			var colors = Highcharts.getOptions().colors,
				categories = [
					(parseFloat($(json7).get(0)['leadership_percentage']) + parseFloat($(json7).get(1)['leadership_percentage']) + parseFloat($(json7).get(2)['leadership_percentage'])).toFixed(2) + '%', 
					(parseFloat($(json7).get(3)['leadership_percentage']) + parseFloat($(json7).get(4)['leadership_percentage']) + parseFloat($(json7).get(5)['leadership_percentage'])).toFixed(2) + '%', 
					(parseFloat($(json7).get(6)['leadership_percentage']) + parseFloat($(json7).get(7)['leadership_percentage']) + parseFloat($(json7).get(8)['leadership_percentage'])).toFixed(2) + '%',
				],
				name = ' ',
				data = [
				{ y: (parseInt($(json7).get(0)['leadership_percentage'])+parseInt($(json7).get(1)['leadership_percentage'])+parseInt($(json7).get(2)['leadership_percentage'])),  color: '#99182C', drilldown: { name: 'AAA', categories: ['Empathy','Excellence','Touch'], 	data: [ parseInt($(json7).get(0)['leadership_percentage']), parseInt($(json7).get(1)['leadership_percentage']), parseInt($(json7).get(2)['leadership_percentage']) ], color: '#99182C'} },
				{ y: (parseInt($(json7).get(3)['leadership_percentage'])+parseInt($(json7).get(4)['leadership_percentage'])+parseInt($(json7).get(5)['leadership_percentage'])), color: '#3D5229', drilldown: { name: 'BBB', categories: ['Truth', 'Assessment', 'Abundance'], data: [ parseInt($(json7).get(3)['leadership_percentage']), parseInt($(json7).get(4)['leadership_percentage']), parseInt($(json7).get(5)['leadership_percentage']) ], color: '#3D5229' }}, 
				{ y: (parseInt($(json7).get(6)['leadership_percentage'])+parseInt($(json7).get(7)['leadership_percentage'])+parseInt($(json7).get(8)['leadership_percentage'])), color: colors[3], drilldown: { name: 'CCC', categories: ['Belief', 'Unity', 'Valor'], data: [parseInt($(json7).get(6)['leadership_percentage']), parseInt($(json7).get(7)['leadership_percentage']), parseInt($(json7).get(8)['leadership_percentage'])], color: colors[3] }}
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
				        span += '<div id="pie-logo" style="height: 139px;    margin-left: -5px;    margin-top: 15px;    width: 148px;"><img src="img/pielogo-1.png" /></div><br>';
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
			if (_id)
				$('#'+_id, mP.$mid_container).html('<div id="chart6"></div>');
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
				data = 	[	{ y: parseInt($(json5).get(0)['leadership_percentage']), color: '#FFCC66'}, { y: parseInt($(json5).get(1)['leadership_percentage']), color: '#FFCC66'},
							{ y: parseInt($(json5).get(2)['leadership_percentage']), color: '#FFCC66'}, { y: parseInt($(json5).get(3)['leadership_percentage']), color: '#FFCC66'},
							{ y: parseInt($(json5).get(4)['leadership_percentage']), color: '#FFCC66'}, { y: parseInt($(json5).get(5)['leadership_percentage']), color: '#FFCC66'},
							{ y: parseInt($(json5).get(6)['leadership_percentage']), color: '#FFCC66'}, { y: parseInt($(json5).get(7)['leadership_percentage']), color: '#FFCC66'},
							{ y: parseInt($(json5).get(8)['leadership_percentage']), color: '#FFCC66'}
						];
			
			function setChart(name, categories, data, color) {
				chart.xAxis[0].setCategories(categories);
				chart.series[0].remove();
				chart.addSeries({ name: name, data: data, color: color || 'white' });
			}
			
			chart = new Highcharts.Chart({
				chart: { renderTo: 'chart6', type: 'column' },
				title: { text: 'Your mindPower LeadershipTM Score Distribution' },
				xAxis: { title: {text: ' '}, categories: categories },
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
		controller: function (_id){
			if (_id)
				$('#'+_id, mP.$mid_container).html('<div id="chart7"></div>');
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
				data = 	[	{ y: parseInt($(json7).get(0)['leadership_percentage']), color: '#99182C'},  { y: parseInt($(json7).get(1)['leadership_percentage']), color: '#99182C'},
							{ y: parseInt($(json7).get(2)['leadership_percentage']), color: '#99182C'},  { y: parseInt($(json7).get(3)['leadership_percentage']), color: '#3D5229'},
							{ y: parseInt($(json7).get(4)['leadership_percentage']), color: '#3D5229'},  { y: parseInt($(json7).get(5)['leadership_percentage']), color: '#3D5229'},
							{ y: parseInt($(json7).get(6)['leadership_percentage']), color: colors[3]},  { y: parseInt($(json7).get(7)['leadership_percentage']), color: colors[3]},
							{ y: parseInt($(json7).get(8)['leadership_percentage']), color: colors[3]}
						];
			
			function setChart(name, categories, data, color) {
				chart.xAxis[0].setCategories(categories);
				chart.series[0].remove();
				chart.addSeries({ name: name, data: data, color: color || 'white' });
			}
			
			chart = new Highcharts.Chart({
				chart: { renderTo: 'chart7', type: 'column' },
				title: { text: 'Your mindPower LeadershipTM Score Distribution' },
				xAxis: { title: {text: ' '}, categories: categories },
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
				_string.push('<li class="top3"><span>' + it1.leadership + ' (' + it1.leadership_percentage + '%) </span></li>');
			});
			_string.push('</div></ul>');
			_string.push('<div id="page8-2" style="position: relative;"><div style="top:5px; position:relative;"><img src="img/page8-2.png" style="width:750px;"/></div><ul style="list-style: none outside none; margin:0px; padding:0px;">');
			
			$(bottom3).each(function (num1, it1){
				_string.push('<li class="bottom3"><span>' + it1.leadership + ' (' + it1.leadership_percentage + '%) </span></li>');
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
					_string.push('<ul style="list-style: none outside none; padding:0px; margin: 15px 0 0 30px;"><img src="img/page9-2.png" /><span style="font-size: 20px; font-weight: bold;">'+_currentGroup+'</span>');
				else if (_newGroup)
					_string.push('</ul><ul style="list-style: none outside none; padding:0px; margin: 15px 0 0 30px;"><img src="img/page9-2.png" /><span style="font-size: 20px; font-weight: bold;">'+_currentGroup+'</span>');
				_string.push('<li class=""><span>' + it1.question + ' </span></li>');
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
					_string.push('<ul ><img src="img/page10-2.png" /><span style="color:red; font-size: 20px; font-weight: bold;">'+_currentGroup+'</span>');
				else if (_newGroup)
					_string.push('</ul><ul ><img src="img/page10-2.png" /><span style="color: red; font-size: 20px; font-weight: bold;">'+_currentGroup+'</span>');
				_string.push('<li class=""><span>' + it1.question + ' </span></li>');
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
								'<div id="p6" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container6"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p7" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container7"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p8" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container8"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p9" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container9"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p10" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container10"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>'+
								'<div id="p11" class="report-template"><div id="top-container"><img src="img/mp-logo.png"/></div><div id="mid-container11"></div><div id="bot-container"><div class="copyR"><img src="img/mp-copyright.png" /></div></div></div>';
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
			};
			initAll();
		};
		return showAll();
		//$('#nav-control-all', mP.$pagination).click(showAll);
	},
	findBrowser: function(){
		var _currentB = BrowserDetect.browser;
		if (_currentB.toLowerCase().indexOf('chrome') > -1){
			this.$mid_container.addClass('chrome');
		}
		else if (_currentB.toLowerCase().indexOf('fire') > -1){
			this.$mid_container.addClass('firefox');
			if ($('#page11-1 li').index() > 25)
				$('#page11-1 ul').css('font-size', $('#page11-1 li').index() - 22+'px')
		}
		else{
			this.$mid_container.addClass('firefox');
			if ($('#page11-1 li').index() > 25)
				$('#page11-1 ul').css('font-size', $('#page11-1 li').index() - 22+'px')
		}


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