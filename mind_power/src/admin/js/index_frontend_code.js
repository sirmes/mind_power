_mP_Form = {
	msgs:{
		'title': 'Please select your title!',
		'name' : 'Please enter your surname!',
		'given_names': 'Please enter your given names!',
		'gender[0]': 'Please select your gender!',
		'gender[1]': 'Please select your gender!',
		'email': 'Please enter the email address!',
		'mobile': 'Please input your contact phone number!',
		'job_title': 'Please enter your job title!',
		'company_name':  'Please enter your company name!',
		'company_type': 'Please select your company type!',
		'country': 'Please select the country/city where you are stationed!',
		'industry': 'Please select the industry you are in!',
		'passcode': 'Please enter a 4-8 characters passcode!'
	},
	_alert_flag: false
};

function validate(form){

	_mP_Form._alert_flag = false;

	$('.to-validate').each(function(num1,it1){
		it1.className = it1.className.replace('error-input', '');
		if ($.trim(it1.value)==''){
			it1.className = it1.className + ' error-input';
			it1.focus();
			alert(_mP_Form.msgs[it1.name]);
			_mP_Form._alert_flag = true;
		}
		
		if(it1.name=='given_names' && _mP_Form._alert_flag == false){
			$('input.gender-validate').parent().removeClass('error-input');
			if ($('input.gender-validate:checked').length == 0){
				$('input.gender-validate').focus();
				$('input.gender-validate').parent().addClass('error-input');
				alert('Please select a gender!');
				_mP_Form._alert_flag = true;
			}
		}
		
		if (it1.name=='given_names' && _mP_Form._alert_flag == false){
			if(!validateQuestions()){
				alert('Please answer all questions!');
				_mP_Form._alert_flag = true;
			}
		}
		
		if (it1.name == 'email' && _mP_Form._alert_flag == false){
			if (!validateEmail(it1.value)){
				it1.focus();
				it1.className = it1.className + ' error-input';
				_mP_Form._alert_flag = true;
			}
		}
		
		if (_mP_Form._alert_flag) 
			return false;
	});

	if (_mP_Form._alert_flag == true)
		return; 

	if (form.gender[0].checked == false && form.gender[1].checked == false) {
		alert('Please select your gender!');
		return;
	}

	if ($('#country').prop('selectedIndex') == 5)
		$('#country').find('option').eq(5).attr('value','Other-' + $('#country_other').val());
	
	if ($('#industry').prop('selectedIndex') == 5)
		$('#industry').find('option').eq(5).attr('value','Other-' + $('#industry_other').val());

// Removed by Plato 2012-06-18 (Hidden passcode field for demo) ------------
/*	if (form.passcode.value.length < 4 || form.passcode.value.length > 8) {
		alert('Please enter passcode min 4 and max 8 alphanumeric char!');
		form.passcode.focus();
		return;
	}
*/
// Ended by Plato 2012-06-18 (Hidden passcode field for demo) ------------

	form.submit();
}

function validateEmail(value)
{
	var atpos=value.indexOf("@");
	var dotpos=value.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=value.length)  {
	  alert("Not a valid e-mail address!");
	  return false;
	}

	return true;
}

// Added by Plato 2012-06-18 (Comment by Isabella: Reset bg color when sected) --------
function resetQuestionBackgroundColor(answer) {
	if ($('#'+answer.id).parent().parent().parent().find('td').last().hasClass('error-question')) {
		$('#'+answer.id).parent().parent().parent().find('td').last().removeClass('error-question');
		$('#'+answer.id).parent().parent().parent().next().find('td').last().removeClass('error-question');
	}
}
// Ended by Plato 2012-06-18 (Comment by Isabella: Reset bg color when sected) --------
	
function validateQuestions() {

	var temp_break = false;
	var temp_first = "none";
	
	var inputs = document.getElementById('questions_statements').getElementsByTagName("input");
	var found = [];
	
	for(var i=0, len=inputs.length; i<len; i++){
        if(inputs[i].name.match(/^answer\d+$/) && inputs[i].type =='radio'){
        	found.push(inputs[i]);
        }
    }

	for(var i=0; i < found.length; i=i+2) {
		$(found[i]).parent().parent().parent().removeClass('error-question');
    	$(found[i]).parent().parent().parent().next().removeClass('error-question');
		if (found[i].checked == false && found[i+1].checked == false){		
//    		$(found[i]).parent().parent().parent().find('.form2-index').parent().addClass('error-question-num');			// Commented by Plato 2012-06-18 (Comment by Isabella: Q# don't get red)
//    		$(found[i]).parent().parent().parent().next().find('.form2-index').parent().addClass('error-question-num');		// Commented by Plato 2012-06-18 (Comment by Isabella: Q# don't get red)
			
			$(found[i]).parent().parent().parent().find('td').last().addClass('error-question');
			$(found[i]).parent().parent().parent().next().find('td').last().addClass('error-question');
			
			temp_break = true;
			if (temp_first == "none")
				temp_first = "first";
		}
		if (temp_first == "first"){
			temp_first = "done";
			found[i].focus();
		}
	}
	
	if (temp_break)
		return false;
	return true;
}

function setGender(form) {
	var title = form.title.value;
	if (title != '') {
		if (title == 'Mr.')
			form.gender[0].checked = true;
		else if (title == 'Ms.')
			form.gender[1].checked = true;
		else {
			form.gender[0].checked = false;
			form.gender[1].checked = false;
		}
		
	}
	
}

function isNumberKey(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;

 return true;
}

function isNotNumberKey(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
    return true;
 return false;
}

function otherCountry(_this){

	if (_this.selectedIndex == 5)
		$('#country_other').css('display','block');
	else
		$('#country_other').css('display','none');
}

function otherIndustry(_this){

	if (_this.selectedIndex == 20)
		$('#industry_other').css('display','block');
	else
		$('#industry_other').css('display','none');
}