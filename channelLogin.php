<?php	
	$pageTitle = "Login";
	$fileName = "channelLogin";	
	require_once("header.php");
	require_once('allFunctions.php');
?>
				
		<div id="form">
		
		<?php 
			//Exploits can be avoided by using the htmlspecialchars() function.
			//The htmlspecialchars() function converts special characters to HTML entities. 
		?>

		
		<form name="login" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onsubmit="<?php mainFunctionLogin(); ?>" >
		
			<p id="mainHeader">Shaw Channel</p>
			<p id="subHeader">Member Login</p>
			
			<p id="userName">Enter Your Lastname (MAX: 20 characters)
				<input type="text" id="lName" name="lastName" size="16" maxlength="20" value="<?php stickyParam("lastName"); ?>" />
				<?php printError($errorLastName); ?>
			</p>
			
			<p id="userPassword">Enter Your Password (7 characters)
				<input type="password" id="pswd" name="password" size="3" maxlength="7" value="<?php stickyParam("password"); ?>" />
				<?php printError($errorPswd); ?>
			</p>
			
			<p id="buttons">
				<button type="submit" name="submit" value="Login" >Login</button>
				<input type="submit" value="Reset" />
			</p>
			
			<p id="newMember">
				<?php printError($wrongNamePsw); ?>
			For New Members, Please login here
				<button type="button" name="newMember" onclick="document.location.href='/Assign4Channel/addNewCust.php'" >New Member</button>
			</p>

<?php	
	
	include_once("footer.php");
?>
