<?php
$id_tester = htmlspecialchars($_GET["id_tester"]);

echo "Congratulation! You have completed all assessment questions. For analysis and future correspondence purposes, <br />please provide the following information."
?>
<html>
<script type="text/javascript">
function validate(form) {

	if (form.id_tester.value.trim() == '') {
		alert('Tester id is not defined or this page was incorrect called.');
		return;
	}

	if (form.mobile.value.trim() == '') {
		alert('Please enter mobile number!');
		form.mobile.focus();
		return;
	}

	if (form.job_title.value.trim() == '') {
		alert('Please enter job title!');
		form.job_title.focus();
		return;
	}

	if (form.company_type.value.trim() == '') {
		alert('Please enter company type!');
		form.company_type.focus();
		return;
	}

	if (form.country.value.trim() == '') {
		alert('Please enter country/city!');
		form.country.focus();
		return;
	}

	if (form.industry.value.trim() == '') {
		alert('Please enter industry!');
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
</script>
<body>
<br>
<form method="post" action="insert_index_ext.php" name="send_survey" id="send_survey">
<input type="hidden" name="id_tester" value="<?php echo "$id_tester";?>"/>
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
                <option value="Hong Kong">Hong Kong</option>
                <option value="China">China</option>
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
              <option value="Manufacturing">Manufacturing</option>
              <option value="Construction">Construction</option>
              <option value="Import/export">Import/export</option>
              <option value="Wholesale">Wholesale</option>
              <option value="Retail trades">Retail trades</option>
              <option value="Transportation">Transportation</option>
              <option value="Storage">Storage</option>
              <option value="Postal and courier services">Postal and courier services</option>
              <option value="Accommodation and food services">Accommodation and food services</option>
              <option value="Information and communications">Information and communications</option>
              <option value="Financing and insurance">Financing and insurance</option>
              <option value="Real estate">Real estate</option>
              <option value="Professional services">Professional services</option>
              <option value="Business services">Business services</option>
              <option value="Public administration">Public administration</option>
              <option value="Education">Education</option>
              <option value="Human health">Human health</option>
              <option value="Social work activities">Social work activities</option>
              <option value="Miscellaneous social and personal services">Miscellaneous social and personal services</option>
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
        <tr>
          <td height="30" colspan="2" align="center"><input type="button" name="survey" id="survey" value="Submit" onclick="validate(document.send_survey);" /></td>
        </tr>
</table>
</form>
</body>
</html>