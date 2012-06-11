function validate(form){
	if(!validateQuestions()){
		alert('Please answer all questions!');
		return;
	}
	
	if (form.title.value.trim() == '') {
		alert('Please select the title!');
		form.title.focus();
		return;
	}

	if (form.name.value.trim() == '') {
		alert('Please enter your surname!');
		form.name.focus();
		return;
	}

	if (form.given_names.value.trim() == '') {
		alert('Please enter your given names!');
		form.given_names.focus();
		return;
	}

	if (form.gender[0].checked == false && form.gender[1].checked == false) {
		alert('Please select your gender!');
		return;
	}
	
	if (form.email.value.trim() == '') {
		alert('Please enter the email!');
		form.email.focus();
		return;
	}

	if (!validateEmail(form.email.value)){
		form.email.focus();
		return;
	}
	
	if (form.company_name.value == '') {
		alert('Please enter your company name!');
		form.company_name.focus();
		return;
	}

	if (form.mobile.value.trim() == '') {
		alert('Please enter your mobile number!');
		form.mobile.focus();
		return;
	}

	if (form.job_title.value.trim() == '') {
		alert('Please enter your job title!');
		form.job_title.focus();
		return;
	}

	if (form.company_type.value.trim() == '') {
		alert('Please enter your company type!');
		form.company_type.focus();
		return;
	}

	if (form.country.value.trim() == '') {
		alert('Please enter the country/city your are located!');
		form.country.focus();
		return;
	}

	if (form.industry.value.trim() == '') {
		alert('Please enter industry you are in!');
		form.industry.focus();
		return;
	}

	// if (form.challenges.value.trim() == '') {
	// 	alert('Please enter your the current challenges faced with in career/business!');
	// 	form.challenges.focus();
	// 	return;
	// }

	// if (form.goal.value.trim() == '') {
	// 	alert('Please enter your immediate breakthrough goal');
	// 	form.goal.focus();
	// 	return;
	// }

	if (form.passcode.value.trim() == '') {
		alert('Please enter passcode!');
		form.passcode.focus();
		return;
	}

	if (form.passcode.value.length < 4 || form.passcode.value.length > 8) {
		alert('Please enter passcode min 4 and max 8 alphanumeric char!');
		form.passcode.focus();
		return;
	}

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
	
function validateQuestions() {

	var inputs = document.getElementById('questions_statements').getElementsByTagName("input");
	var found = [];
	
	for(var i=0, len=inputs.length; i<len; i++){
        if(inputs[i].name.match(/^answer\d+$/) && inputs[i].type =='radio'){
        	found.push(inputs[i]);
        }
    }

	for(var i=0; i < found.length; i=i+2) {
		if (found[i].checked == false && found[i+1].checked == false){		
			return false;
		}
	}
	
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