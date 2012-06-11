<?php include 'index_backend_code.php' ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>mindPower Leadership</title>
	</head>
		<script type="text/javascript" src="admin/js/jquery.js"></script>
		<style>
			#mP #container{ margin: auto; width: 750px; background-color: #EEE9E9; font-family: Verdana, Arial, Calibri;  font-size:14px;}
			#mP #container #header{}
			
			#mP #container #welcome{font-weight:bold; font-size: 15px; background-color:#363636; padding-bottom: 5px; padding-left: 5px; padding-top: 5px;}
			#mP #container #welcome .welcome-gray{color:#ABAAA8;}
			#mP #container #welcome .welcome-orange{color:#F79900;}
			
			#mP #container #mid-container #form1{padding:10px;}
			#mP #container #mid-container #form1 span{padding-top:5px;}
			#mP #container #mid-container #form1 .form1-text{font-weight: bold;}
			#mP #container #mid-container #form1 .dark-orange{color:#A47000;}
			#mP #container #mid-container #form1 label{ display: block; float: left; margin-right: 0.5em; text-align: left; width: 6em; height:15px;}
			#mP #container #mid-container #form1 .form1-right{}
			#mP #container #mid-container #form1 ul{list-style-image:none;  list-style-position:outside;  list-style-type:none;  margin-left:0;  padding-left:1em;  text-indent:-1em;}  
			#mP #container #mid-container #form1 input{padding-left:0px;}

			#mP #container #mid-container #form2 .form2-even-row{}
			#mP #container #mid-container #form2 .form2-odd-row{background-color:#F79900;}
			#mP #container #mid-container #form2 .form2-index{text-align:right;}
			
			#mP #container #mid-container #form3 {padding-left:10px;}
			#mP #container #mid-container #form3 .dark-orange{color:#A47000; font-weight: bold; }
			#mP #container #mid-container #form3 .black{color:black;}

			#mP #container #footer p{padding:15px;}
			#mP #container #footer .form3-text{font-weight: bold; color:#A47000;}
			#mP #container #footer #copy-right{background-color: #363636;    height: 24px;}
			#mP #container #footer #copy-right img{float:right;}
		</style>
		<script type="text/javascript" src="admin/js/index_frontend_code.js"></script>
	<body>
		<div id="mP">
			<div id="container">
				<div id="header">
					<img src="images_new/logo.png" />
				</div>	
				<div id="welcome">
					<span class="welcome-gray">Welcome and thank you for taking the</span>
					<span class="welcome-orange">mindPower Leadership&trade; assessment</span>
				</div>
				<div id="mid-container">
					<form action="insert.php" method="post" name="send_questions" id="send_questions">
						<div id="form1">
							<p>
								<span class="form1-text dark-orange">Please provide your name</span>
							</p>
							<br />
							<p>
								<label for="form1-title">Title: </label>
								<select id="form1-title" name="title" onchange="setGender(document.send_questions);">
									<option value="">(select one)</option>
									<option value="Mr.">Mr.</option>
									<option value="Ms.">Ms.</option>
									<option value="Dr.">Dr.</option>
									<option value="Prof.">Prof.</option>
								</select>
							</p>
							<p>
								<label for="form1-sureame" class="form1-left">Surname: </label>
								<input id="form1-surname" type="text" name="name" maxlength="120">
							</p>
							<p>
								<label for="form1-givennames" class="form1-left">Given names: </label>
								<input id="form1-givennames" type="text" name="given_names" maxlength="120">
							</p>
							<p style="padding-top: 10px;">
								<span>Gender:
									<input type="radio" name="gender" value="Male" style="margin-left: 30px;" >Male <input type="radio" name="gender" value="Female">Female
								</span>
							</p>
							<ul class="form1-text dark-orange">
								<li>Instruction</li>
								<li>-	There are totally 72 questions and please answer all of them. (It takes about 20 minutes)</li>
								<li>-	For each question, please choose the statement that reflect and align with your “current” mindset and behaviors as a leader</li>
								<li>-	If neither statement accurately portrays you, please pick the one which you are more likely to fall on</li>
								<li>-	If both statements accurately portray you, please pick the one which happens most frequently</li>
							</p>
						</div>
						<div id="form2">
							<p>
								<p>
									<table cellspacing="0" border="0" id="questions_statements">
										<tr style="background-color: #666666;  color: white;"> 
											<th>
												<font>Q#</font>
											</th>
											<th>
												<font>Statements for you to choose</font>
											</th>
											<th>
											</th>
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
												} else {
													$choice = "b";
												}
												if ($answer_group%2 == 0)
													$row_color = "form2-odd-row";
												else
													$row_color = "form2-even-row";
										?>
										<tr class="<?php echo "$row_color"; ?>"> 
											<td>
												<span class="form2-index"> <? if ($temp_answer_group != $answer_group) echo "$answer_group"+"."; ?> </span>
											</td>
											<td>
												<span> <? echo "$question"; ?> </span>
											</td>
											<td>
												<span>
													<input type="hidden" name="choice<? echo "$id"; ?>" value="<? echo "$choice"; ?>" />
													<input type="hidden" name="strategic_management<? echo "$answer_group"; ?>_<? echo "$choice"; ?>" value="<? echo "$id_strategic_management"; ?>" />
													<input type="hidden" name="leadership<? echo "$answer_group"; ?>_<? echo "$choice"; ?>" value="<? echo "$id_leadership"; ?>" />
													<input type="radio" name="answer<? echo "$answer_group"; ?>" id="answer<? echo "$answer_group"; ?>" value="<? echo "$id"; ?>" <?php if ($test_on == "true" && ($i % 2 ==0)) { echo "checked='checked'"; } ?> >
												</span>
											</td>
										</tr>
										<? ++$i; $temp_answer_group = $answer_group; } ?>
									</table>
								</p>
							</p>
						</div>
						<div id="form3">
							<p class="dark-orange">
								Congratulation! You have completed all assessment questions. <br />
								For analysis and future correspondence purposes, please provide the following information.
							</p>
							<table >
								<tr>
						          	<td height="30">E-mail:</td>
						          	<td height="30"><input type="text" name="email" maxlength="120" style="width:200px"></td>
						        </tr>
						        <tr>
						          	<td height="30">Contact phone number:</td>
						          	<td height="30"><input type="text" name="mobile" id="mobile" maxlength="30" /></td>
						        </tr>
						        <tr>
						          	<td height="30">Job Title:</td>
						          	<td height="30"><input type="text" name="job_title" id="job_title" maxlength="120" /></td>
						        </tr>
						        <tr>
						        	<td>Company Name: </td>
						        	<td><input type="text" name="company_name" maxlength="120" style="width:200px"></td>
						        </tr>
						        <tr>
						          	<td height="30">Company Type:</td>
						          	<td height="30">
						          		<label>
								            <select name="company_type" id="company_type">
								              	<option value="">(Select one)</option>
								              	<option value="Listed company">Listed company</option>
								              	<option value="Non-listed commercial firm">Non-listed commercial firm</option>
								            	<option value="Public or Welfare organization">Public or Welfare organization</option>
								            </select>
						          		</label>
						          	</td>
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
						            	</label>
						            </td>
						       	</tr>
						        <tr>
						          	<td height="30">
						          		Industry:
						          	</td>
						          	<td height="30">
						          		<label>
						            		<select name="industry" id="industry">
						            			<option value="">(Select one)</option>
						              			<option value="Accommodation and food services">Accommodation and food services</option>
						              			<option value="Business services">Business services</option>
						              			<option value="Construction">Construction</option>
						              			<option value="Education">Education</option>
						              			<option value="Financing and insurance">Financing and insurance</option>
						              			<option value="Human health">Human health</option>
						              			<option value="Import/export">Import/export</option>
						              			<option value="Information and communications">Information and communications</option>
												<option value="Manufacturing">Manufacturing</option>
												<option value="Miscellaneous social and personal services">Miscellaneous social and personal services</option>
												<option value="Postal and courier services">Postal and courier services</option>
												<option value="Professional services">Professional services</option>
												<option value="Public administration">Public administration</option>
												<option value="Real estate">Real estate</option>
												<option value="Retail trades">Retail trades</option>
												<option value="Social work activities">Social work activities</option>
												<option value="Storage">Storage</option>
												<option value="Transportation">Transportation</option>
												<option value="Wholesale">Wholesale</option>
												<option value="Others">Others</option>
						           			</select>
						          		</label>
						          	</td>
						        </tr>
						        <tr style="display:none">
						          	<td colspan="2">What challenges are you currently faced with in  career/business?</td>
						      	</tr>
						        <tr style="display:none">
						        	<td height="30" colspan="2">
						        		<label>
						        			<textarea name="challenges" cols="50" rows="5" id="challenges"></textarea>
						          		</label>
						          	</td>
						        </tr>
						        <tr style="display:none">
						        	<td colspan="2">What is your immediate breakthrough goal?</td>
						        </tr>
						        <tr style="display:none">
						        	<td height="30" colspan="2"><textarea name="goal" cols="50" rows="5" id="goal"></textarea></td>
						        </tr>
						        <tr>
						        	<td height="30" colspan="2">A passcode to retrieve your  report (min 4 and max 8 alphanumeric char) </td>
						        	<td height="30" colspan="2">
							          	<label>
						          			<input type="text" name="passcode" id="passcode" maxlength="8"/>
						          		</label>
						          	</td>
						        </tr>
							</table>
						</div>
						<input type="button" onClick="validate(document.send_questions);" value="Submit" style="margin-left: 320px;" />
						<div id="footer">
							<p>
								<span class="form3-text black">Thank you for your participation.  The mindPower Leadership™ self-assessment report will be distributed to you in due course.</span>
							</p>
							<div id="copy-right">
								<img src="images_new/copyright.gif" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>