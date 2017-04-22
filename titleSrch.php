<?php
	require_once('allFunctions.php');
	isLogedIn("Title search", "titleSearch");
?>
		
		<div id="form">
		
		<form name="titleSearch" method="post" 
								action="fetchDisplayChannel.php" 
								onsubmit="<?php formProccess(); ?>">
		
		<!-- <form name="titleSearch" method="post" 
								action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
								onsubmit="<?php formProccess(); ?>" > -->
		
			<p id="mainHeader">Shaw Channel</p>
			<p id="name">Welcome <?php echo $_COOKIE['cust_fname'] . " " . $_COOKIE['cust_lname']; ?></p>
			<p id="subHeader">Title search</p>
			
			<p><?php echo $sqlError; ?></p>
			
			<div id="tTable">
			<table name="searchTable">
			
			<thead>		
			</thead>
			
			<tbody>
				<tr>
					<td class="right">Title
					</td>
					<td colspan="3"> 
						<div class="center"><input id="searchField" 
													name="searchField" 
													type="text" size="40" 
													value="<?php stickyParam('searchField'); ?>" />
						</div>
					</td>
					<td> 
						<div class="center"><input type="submit" name="submit" value="Search" /></div>
					</td>
					<!-- <td>
					</td>
					<td>
					</td>-->
				</tr>
				<tr>
					<td rowspan="3">
					</td>
					<td class="right">Search By:
					</td>
					<td>
						<select name="select">
  							
  							<option value="withinTitle" 
  							<?php echo stickyCombo('select', 'withinTitle'); ?>>Within Title</option>
  							
  							<option value="startingWith" 
  							<?php echo stickyCombo('select', 'startingWith'); ?>>Starting With</option>
  							
  							<option value="exactTitle" 
  							<?php echo stickyCombo('select', 'exactTitle'); ?>>Exact Title</option>
						
						</select>
					</td>
					<td rowspan="3"><span class="bold">Genere:</span>
						<select name="genere">
  							<option value="all" <?php echo stickyCombo('genere', 'all'); ?>>All</option>
  							<option value="e" <?php echo stickyCombo('genere', 'e'); ?>>Entertaiment</option>
  							<option value="f" <?php echo stickyCombo('genere', 'f'); ?>>Family</option>
  							<option value="i" <?php echo stickyCombo('genere', 'i'); ?>>Information</option>
  							<option value="m" <?php echo stickyCombo('genere', 'm'); ?>>Movie</option>
  							<option value="n" <?php echo stickyCombo('genere', 'n'); ?>>News/Business</option>
  							<option value="o" <?php echo stickyCombo('genere', 'o'); ?>>Old TV Shows</option>
  							<option value="s" <?php echo stickyCombo('genere', 's'); ?>>Sci-Fi</option>
  							<option value="t" <?php echo stickyCombo('genere', 't'); ?>>Sports</option>		
  						</select>
  						
  							<br/><br/>
  							<span class="bold">Group by Genre</span>
  							<input type="checkbox" name="group_genre" 
  													value="ch_genere" <?php echo stickyRadio('group_genre', 'ch_genere'); ?> />

					</td>
					<td rowspan="3">
					</td>
				</tr>
				<tr>
					<!-- <td> -->
					</td>
					<td rowspan="2">
					</td>
					<td><input type="radio" name="orderBy" value="ch_title" checked="checked" /><span class="bold">Order By Title</span>
					</td>
					<!-- <td>
					</td>
					<td> -->
					</td>
				</tr>
				<tr>
					<!-- <td>
					</td>
					<td>
					</td> -->
					<td>
						<input type="radio" name="orderBy" 
											value="ch_price" <?php echo stickyRadio('orderBy', 'ch_price'); ?> />
						<span class="bold">Order By Price (Highest)</span>
					</td>
					<!-- <td>
					</td>
					<td> 
					</td> -->

				</tr>			
			</tbody>
			
			<tfoot>	
								
				<?php
					printError($sqlError); //SQL error message
					
					//echo $table . "<br />";
					
				?>
				
			</tfoot>
			
			</table>
			</div>
						
			<div class="center"><input type="reset" value="Reset" name="reset"></div>
			
<?php	
	include_once("footer.php");
?>