<?php
	require_once('allFunctions.php');	
	isLogedIn("Order Process", "processChannelOrders");
	getLinedUpCh(false); //Get list of channels that customer already have
?>
	
	<div id="form">		
	<form name="addOrder" method="post" action="<?php echo ($_SERVER['PHP_SELF']); ?>" >

		<p id="mainHeader">Shaw Channel Order Process</p>
		<p id="subHeader">Orders So Far for <?php echo $_COOKIE['cust_fname'] . " " . $_COOKIE['cust_lname']; ?></p>
			
		<p id="center">
			<?php 
				//global $isValidCard;
				processChOrder(); //Credit card verification
				if ($isValidCard) {
					
					buyChannel();
					
					echo "Current order summary:<br/><br/>";					
					echo $sqlError;
					echo $channelsPurchased;
					
					echo "<br />Thank You, Please Close Your Browser to exit<br/><br/>";
					echo "Or&nbsp;";
					echo "<button type=\"button\" value=\"Log Out\" name=\"exit\" onclick=\"window.location.href='exit.php'\">Log Out</button>";
				} else{
					//Empty or invalid card number
					echo $sqlError;
					echo "<span id=\"error\">PLEASE PRESS BROWSER BACK BUTTON AND RE-ENTER YOUR CREDIT CARD NUMBER</span>";
				}			
			?>
		</p>

<?php	
	include_once("footer.php");
?>