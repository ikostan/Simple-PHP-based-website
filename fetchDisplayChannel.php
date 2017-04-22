<?php	
	require_once('allFunctions.php');
	isLogedIn("Title search results", "fetchDisplayChannel");
?>
	
		<div id="form">
		
		<form name="titleSearchResult" method="post" action="addOrderChannel.php" onsubmit="" >
		
			<p id="mainHeader">Shaw Channel</p>
			<p id="subHeader">Title Search Results</p>
			
			
			<div id="tTable">
			<table name="searchResult">
			
			<thead>
				<tr>
					<td id='title'>Title</td>
					<td>id</td>
					<td>Logo</td>
					<td>Genre</td>
					<td id='price'>Price</td>
					<td id='cart'>Add to Cart</td>
				</tr>		
			</thead>
			
			<tfoot>		
			</tfoot>
			
			<tbody>				
			
				<?php 
					if(isset($_POST['select'])){
						getChannels();
						echo $table; //Display channels table 
					} 
				?>
			
			</tbody>
				
			</table>
			</div>
					
			<div class="center">
				<input type="submit" value="Submit" name="submit" />&nbsp; 
				<input type="reset" value="Clear" name="reset" />&nbsp; 
				<!-- <input type="button" value="Back to search" 
									name="searchBack" 
									onclick="document.location.href='/Assign4Channel/titleSrch.php'" />	-->
			</div>
			
<?php	
	include_once("footer.php");
?>		