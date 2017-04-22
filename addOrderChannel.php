<?php
	require_once('allFunctions.php');
	isLogedIn("Add Order", "addOrderChannel");
?>

	<div id="form">
		
	<form name="addOrder" method="post" 
						action="processChannelOrders.php" 
						onsubmit="" >

	<p id="mainHeader">Shaw Channel</p>
	<p id="subHeader">Your Cart/Channel Lineup</p>
	<p id="name">Order So Far for <?php echo $_COOKIE['cust_fname'] . " " . $_COOKIE['cust_lname']; ?></p>
			
	<div id="tTable">
	<table name="searchResult">
			
		<thead>
			<tr>
				<td id='title'>Title</td>
				<td>ID</td>
				<td>Logo</td>
				<td id='price'>Price</td>
				</tr>		
		</thead>		
			
		<tbody>						
			<?php 
				getSelectedChannels(); //Generate tabl structure
				echo $table; //Display channels table 
				printError($sqlError); //Print error message
			?>			
		</tbody>
				
		<tfoot>			
			<tr>			
				<td class="right" colspan="3">Total:</td>
				<td class="bold">
					Current: $<?php echo calcLineUp(); ?><br />
					Cart:&nbsp;<span id="underline" >**$<?php echo calcCart(); ?>**</span><br />
					Total: $<?php echo (calcLineUp() + calcCart()); ?>
				</td>			
			</tr>			
		</tfoot>
				
				
		</table>
					
	<div class="center">
	
	<p><br/>
		<?php		
			if($isCheckout == true){
				
				echo "Enter your Credit Card Number:&nbsp;<input type=\"number\" name=\"creditCard\" maxlength=\"16\" size=\"16\" />";
			} else{
				
				echo "PLEASE CLICK BROWSER BACK BUTTON TO RETRY<br/>";
			}			
		?>
	</p>
	<p>	
	<?php 
		if($isCheckout == true){
			
			echo "<input type=\"submit\" value=\"Submit\" name=\"CheckOut\" />";
		}	
	?>
		&nbsp;Or&nbsp; 
		<button type="button" value="Log Out" name="exit" onclick="window.location.href='exit.php'">Log Out</button>
	</p>		
	</div>
	
<?php	
	include_once("footer.php");
?>