<?
include("DB.php");
$DB = DB::Open();

$query="SELECT * FROM questions_answers ORDER BY answer_group";
$questions = $DB->qry($query); 
$num = $DB->qry_row_num($questions);


$test_on = htmlspecialchars($_GET["test_on"]);
if ($test_on == "true") {
	echo "test is on: ".$test_on."<br><br>";
}

echo "<b><center>Database Output</center></b><br><br>";

?>
<script type='text/javascript'>
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

	if (form.challenges.value.trim() == '') {
		alert('Please enter your the current challenges faced with in career/business!');
		form.challenges.focus();
		return;
	}

	if (form.goal.value.trim() == '') {
		alert('Please enter your immediate breakthrough goal');
		form.goal.focus();
		return;
	}

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
</script>

<form action="insert.php" method="post" name="send_questions" id="send_questions">
Title: 
<select name="title" onchange="setGender(document.send_questions);">
	<option value="">(select one)</option>
	<option value="Mr.">Mr.</option>
	<option value="Ms.">Ms.</option>
	<option value="Dr.">Dr.</option>
	<option value="Prof.">Prof.</option>
</select><br>
Surname: <input type="text" name="name" maxlength="120"><br>
Given names: <input type="text" name="given_names" maxlength="120"><br>
Gender: <input type="radio" name="gender" value="Male">Male <input type="radio" name="gender" value="Female"> Female<br> 
E-mail: <input type="text" name="email" maxlength="120"><br>
Company: <input type="text" name="company_name" maxlength="120"><br>
<hr>
<p>
<input type="button" onClick="validate(document.send_questions);" value="Send your anwsers">
<p>

<table border="1" cellspacing="2" cellpadding="2" id="questions_statements">
<tr bgcolor="orange"> 
<th><font face="Arial, Helvetica, sans-serif">Question</font></th>
<th colspan="2" ><font face="Arial, Helvetica, sans-serif">Answer</font></th>
</tr>

<?
$i=0;
$temp_answer_group;
while ($i < $num) {
	$id=mysql_result($questions,$i,"id");
	$id_strategic_management=mysql_result($questions,$i,"id_strategic_management");
	$id_leadership=mysql_result($questions,$i,"id_leadership");
	$answer_group=mysql_result($questions,$i,"answer_group");
	$question=mysql_result($questions,$i,"question");
	
	if ($i%2 ==0) {
		$choice = "a";
		$row_color = "";
	} else {
		$choice = "b";
		$row_color = "gray";
	}
?>
<tr bgcolor="<?php echo "$row_color"; ?>"> 
<td><font face="Arial, Helvetica, sans-serif">
	<? if ($temp_answer_group != $answer_group)
			echo "$answer_group"; 
	?>
	</font></td>
 
<td><font face="Arial, Helvetica, sans-serif"><? echo "$question"; ?></font></td>
<td><font face="Arial, Helvetica, sans-serif">
	<input type="hidden" name="choice<? echo "$id"; ?>" value="<? echo "$choice"; ?>" />
	<input type="hidden" name="strategic_management<? echo "$answer_group"; ?>_<? echo "$choice"; ?>" value="<? echo "$id_strategic_management"; ?>" />
	<input type="hidden" name="leadership<? echo "$answer_group"; ?>_<? echo "$choice"; ?>" value="<? echo "$id_leadership"; ?>" />
	<input type="radio" name="answer<? echo "$answer_group"; ?>" id="answer<? echo "$answer_group"; ?>" value="<? echo "$id"; ?>" <?php if ($test_on == "true" && ($i % 2 ==0)) { echo "checked='checked'"; } ?> >
</font></td>
</tr>
<?
++$i;
$temp_answer_group = $answer_group;
} 
?>
</table>

<p>

<table>
        <tr>
          <td height="30">Mobile:</td>
          <td height="30"><input type="text" name="mobile" id="mobile" maxlength="30" /></td>
        </tr>
        <tr>
          <td height="30">Job Title:</td>
          <td height="30"><input type="text" name="job_title" id="job_title" maxlength="120" /></td>
        </tr>
        <tr>
          <td height="30">Company:</td>
          <td height="30"><label>
            <select name="company_type" id="company_type">
              <option value="">(Select one)</option>
              <option value="Listed company">Listed company</option>
              <option value="Non-listed commercial firm">Non-listed commercial firm</option>
              <option value="Public or Welfare organization">Public or Welfare organization</option>
            </select>
          </label></td>
        </tr>
        <tr>
          <td height="30" colspan="2">Country/City where you station:
            <label>
              <select name="country" id="country">
              <option value="">(Select one)</option>
                <option value="China">China</option>
              	<option value="Hong Kong">Hong Kong</option>
                <option value="Singapore">Singapore</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Others ">Others </option>
              </select>
            </label></td>
          </tr>
        <tr>
          <td height="30">Industry:</td>
          <td height="30"><label>
            <select name="industry" id="industry">
            <option value="">(Select one)</option>
              <option value="Accommodation and food services">Accommodation and food services</option>
              <option value="Business services">Business services</option>
              <option value="Construction">Construction</option>
              <option value="Education">Education</option>
              <option value="Financing and insurance">Financing and insurance</option>
              <option value="Human health">Human health</option>
              <option value="Information and communications">Information and communications</option>
              <option value="Import/export">Import/export</option>
              <option value="Manufacturing">Manufacturing</option>
              <option value="Miscellaneous social and personal services">Miscellaneous social and personal services</option>
              <option value="Postal and courier services">Postal and courier services</option>
              <option value="Professional services">Professional services</option>
              <option value="Public administration">Public administration</option>
              <option value="Wholesale">Wholesale</option>
              <option value="Retail trades">Retail trades</option>
              <option value="Real estate">Real estate</option>
              <option value="Storage">Storage</option>
              <option value="Social work activities">Social work activities</option>
              <option value="Transportation">Transportation</option>
              <option value="Others">Others</option>
            </select>
          </label></td>
        </tr>
        <tr>
          <td colspan="2">What challenges are you currently faced with in  career/business?</td>
          </tr>
        <tr>
          <td height="30" colspan="2"><label>
            <textarea name="challenges" cols="50" rows="5" id="challenges"></textarea>
          </label></td>
        </tr>
        <tr>
          <td colspan="2">What is your  immediate breakthrough goal?</td>
        </tr>
        <tr>
          <td height="30" colspan="2"><textarea name="goal" cols="50" rows="5" id="goal"></textarea></td>
        </tr>
        <tr>
          <td height="30" colspan="2">A passcode to retrieve your  report (min 4 and max 8 alphanumeric char) </td>
        </tr>
        <tr>
          <td height="30" colspan="2"><label>
            <input type="text" name="passcode" id="passcode" maxlength="8"/>
          </label></td>
        </tr>
</table>
<input type="button" onClick="validate(document.send_questions);" value="Send your anwsers">
</form>