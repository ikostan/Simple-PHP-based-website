<?php	
	$pageTitle = "New Member";
	$fileName = "addNewCust";	
	include_once("header.php");
	require_once('allFunctions.php');
?>
		
		<div id="form">
		
		<?php 
			//$_SERVER["PHP_SELF"] exploits can be avoided by using the htmlspecialchars() function.
			//The htmlspecialchars() function converts special characters to HTML entities. 
		?>
		
		<form name="newMember" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="<?php mainFunctionRegister(); ?>">
		
			<p id="mainHeader">Shaw Channel</p>
			<p id="subHeader">New Member</p>
			
			<div id="tTable">
			<table name="registrForm">
			<thead>
				
			</thead>
			<tbody>
				<tr>
					<td>
					<p class="tRight">Enter your <span class="boldTxt">First name</span> (MAX 20 chars.)</p>
					</td>
					<td class="tLeft">
						<input type="text" id="firstName" name="firstName" value="<?php stickyParam('firstName'); ?>" size="16" maxlength="20">
					</td>
					<?php registrationError($errorFirstName); ?>
				</tr>
				<tr>
					<td>
					<p class="tRight">Enter your <span class="boldTxt">Last name</span> (MAX 20 chars.)</p>
					</td>
					<td class="tLeft">
						<input type="text" name="lastName" value="<?php stickyParam('lastName'); ?>" size="16" maxlength="20">
					</td>
					<?php registrationError($errorLastName); ?>
				</tr>
				<tr>
					<td>
					<p class="tRight">Enter <span class="boldTxt">e-mail</span> address (MAX 20 chars.)</p>
					</td>
					<td class="tLeft">
						<input type="email" name="eMail" value="<?php stickyParam('eMail'); ?>" size="16" maxlength="20">
					</td>
					<?php registrationError($errorEmail); ?>
				</tr>
				<tr>
					<td id="userPassword">
					<div class="tRight">
						<span class="boldTxt">Your password</span>
					</div>
					
						<div>
						<ul>
							<li>MUST BE 7 CHARACTERS</li><br/>
							<li><span class="boldTxt">CANNOT</span> BE ALL DIGITS</li>
							<li><span class="boldTxt">MUST BEGIN</span> with a lowercase LETTER of the alphabet</li>
							<li><span class="boldTxt">ONLY lowercase LETTERS OF THE ALPHABET ALLOWED</span></li>
						</ul>
						</div>		
					
					</td>
					<td class="tLeft">
						<input type="text" name="password" value="<?php stickyParam('password'); ?>" size="3" maxlength="7">
					</td>
					<?php registrationError($errorPswd); ?>
				</tr>
				
				</tbody>
				<tfoot>
				<tr>
					<td>
					</td>
					<td class="tLeft">
						<input name="submit" type="submit" value="Submit" />&nbsp;
						<input type="submit" value="Reset" />
					</td>
				</tr>
				</tfoot>
			</table>
			</div>
			
			<div  id="backLink">
				<a href="/Assign4Channel/channelLogin.php" target="_self">Back to Login</a>
			</div>
			
			<?php
				printError($sqlError);
			?>
			
<?php	
	include_once("footer.php");
?>