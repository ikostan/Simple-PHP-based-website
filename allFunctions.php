<?php
		
//Global variables
$isTrueLogin = false;
$isTrueRegister = false;
$errorLastName = "";
$errorFirstName = "";
$errorEmail = "";
$errorPswd = "";
$wrongNamePsw = "";
$maxLength = 20;
$minLength = 7;


//Redirect webpage fubction
function redirecTo($destination){
	//Redirect header
	header("Location: " . $destination);
	exit;
}

			
//Print error function		
function printError($testError){
				
	if(isset($_POST['submit'])){
		echo "<span id=\"error\">" . $testError . "</span >";
	}
}


//Registration error
function registrationError($testError){
	
	if($testError != ""){
		
		echo "<td class=\"tError\">";
		printError($testError);
		echo "</td>";
	}	
}


//Return test paramether name
function returnTestParam($param){
	
	switch($param){
		case 1:
			return 'firstName';
		case 2:
			return 'lastName';
		case 3:
			return 'eMail';
	}
}


//Test string
function testString($param){
	
	global $errorFirstName; //1
	global $errorLastName;	//2
	global $errorEmail;     //3
	global $maxLength;
	
	$testParam = trim($_POST[returnTestParam($param)]);
	$testLength = strlen(trim($_POST[returnTestParam($param)]));
				
	if($testLength != 0){
	
		if(strlen($testParam) > $maxLength){
			
			if($param == 1){
				$errorFirstName = "***Your first name has TOO many characters?***";
			}
			else if($param == 2){
				$errorLastName = "***Your lastname has TOO many characters?***";
			}
			else{
				$errorEmail = "***Your e-mail has TOO many characters?***";
			}
			
		} 
		else{
						
			if($param == 1){
				$errorFirstName = "";
			}
			else if($param == 2){
				$errorLastName = "";
			}
			else{
				
				//Email structure validation
				if(!(stripos($testParam, "@") === false) && !(stripos($testParam, ".") === false)){
					
					$errorEmail = "";
				}
				else{
					
					$errorEmail = "***Invalid eMail structure***";
				}				
			}
		}	
	} 
	else{
		
		if($param == 1){
				$errorFirstName = "***Your first name?***";
			}
		else if($param == 2){
				$errorLastName = "***Your lastname?***";
			}
		else{
				$errorEmail = "***Your e-mail?***";
			}
	}	
}

		
//Test password field
function testPswd($isReg = false){
				
	global $errorPswd;
	global $minLength;
	
	$pswdLength = strlen(trim($_POST['password']));
	//settype($pswdLength, 'integer');
	$testStr = trim($_POST['password']);
	
	if($pswdLength != 0 && !empty($testStr)){ //Password is not empty
		
		if($pswdLength == $minLength){ //Test if password length == $minLength chars
						
			if($isReg == true){ //Test password - registration web page
				
				if(ctype_lower(substr($testStr,0,1))){
									
					$i = 0;
					$num = 0; 
				
					while($i < $pswdLength){
					
						if(is_numeric(substr($testStr,$i,1))){
							//If char is a number >>> increment by one
							$num++;
						}
						else{
							
							//Test if char is uppercase
							if(ctype_upper(substr($testStr,$i,1))){
							
								$errorPswd = "***Invalid character***<br/>";
								break;
							}
						}
											
						$i++;
					}
										
					//Test that password has not only numeric values
					if($num == $minLength){
						//Error - password has only numeric values
						$errorPswd = "***Your password cannot be numeric***";
					} 
				} 
				else{
					//Error
					$errorPswd = "***Your password MUST BEGIN with a lowercase LETTER of the alphabet***";
				}					
		
			} else{
			
				$errorPswd = "";
			}
									
		} else{
			
			//Error - password is less than $minLength chars
			$errorPswd = "***Your password MUST HAVE {$minLength} characters ?***";
		}

	} else{

		//Error - empty password
		$errorPswd = "***Your password ?***";	
	}		
}

			
//Sticky parameter
function stickyParam($arrParam){
	
	if(isset($_POST['submit'])){
		
		echo htmlspecialchars(trim($_POST[$arrParam]));
	} else{
		
		echo "";
	}				
}


//Sticky combo box
function stickyCombo($paramOne, $paramTwo){
	
	if(isset($_POST[$paramOne])){
		
		if($_POST[$paramOne] == $paramTwo){
			
			return "selected";
		} else{
			
			return "";
		}		
		
	} else{
		
		return "";
	}		
}


//Sticky radio/checkbox
function stickyRadio($paramOne, $paramTwo){
	
	if(isset($_POST[$paramOne])){
		if($_POST[$paramOne] == $paramTwo){
			//Checked
			return "checked";
		} else{
			
			//Unchecked
			return "";
		}
		
	} else{
		//Unchecked
		return "";
	}		
}

			
//Test Login form data
function testLoginData(){
				
	global $isTrueLogin;
	global $errorLastName;
	global $errorPswd;
					
	if(strlen($errorLastName) == 0 && strlen($errorPswd) == 0){
		
		$isTrueLogin = true;
	} else{
		
		$isTrueLogin = false;
	}				
}

			
//Main Login function
function mainFunctionLogin(){
	
	global $isTrueLogin;
			
	if(isset($_POST['submit'])){
		
		testPswd();    //Password
		testString(2); //Last name
		testLoginData();
		
		if($isTrueLogin == true){
			
			$user = trim($_POST['lastName']);
			$pswd = trim($_POST['password']);
			getUser($user, $pswd);
		}
	}
}


//Test Register form data
function testRegisterData(){
				
	global $isTrueRegister;
	global $errorLastName;
	global $errorPswd;
	global $errorFirstName;
	global $errorEmail;
					
	if(strlen($errorLastName) == 0 && strlen($errorPswd) == 0 && strlen($errorFirstName) == 0 && strlen($errorEmail) == 0 ){
		$isTrueRegister = true;
	}
	else{
		
		$isTrueRegister = false;
	}					
}


//Main Register function
function mainFunctionRegister(){
	
	global $isTrueRegister;
	
	if(isset($_POST['submit'])){
		
		testPswd(true);//Password
		testString(2); //Last name
		testString(1); //First name
		testString(3); //Email
		testRegisterData();
		
		if($isTrueRegister == true){
			
			//Create a new user + add cookies
			$fname = trim($_POST['firstName']);
			$lname = trim($_POST['lastName']);
			$email = trim($_POST['eMail']);
			$pswd = trim($_POST['password']);
			addUser($fname, $lname, $email, $pswd);
		}		
	}
}


// Connect to local MySQL server
$username = 'root';			  //DB user name
$password = '';		  //DB user pswd
$server = 'localhost'; 		  //DB server name
$database = 'channelwatchdb'; //DB name

//Tables
$channelTbl = 'channeltbl';
$customerTbl = 'customertbl';
$orderTbl = 'ordertbl';
$table;

//Search params
$searchTitle = "";
$searchBy = "";
$orderBy = "";
$gener = "";
$groupByGener = "";
$sqlError = "";


// Connect to MySQL
function connectMySQL(){
	
	global $username;
	global $password;
	global $server;
	global $database;
	//global $table;
	global $sql;
	
	$connection = mysqli_connect($server, $username, $password, $database);

	if (mysqli_connect_errno()) {
		
		die(
		"<br/>Something went wrong while connecting to MySQL: <br/>" .
    	"&nbsp&nbsp Error #: " . 
    	mysqli_connect_errno() . "<br/>" .
    	"&nbsp&nbsp Error message: " . 
    	mysqli_connect_error()  . "<br/>");		
	} else{
		
		return $connection;
	}
}


//Add new user
function addUser($fname, $lname, $email, $pswd){
	
	global $customerTbl;
	global $sqlError;
	global $errorPswd;
	
	$connection = connectMySQL(); //Connect to DB
	
	//Check is user exist
	$get_user = "SELECT cust_id, cust_lname, cust_passw FROM customertbl WHERE cust_lname ='"
	 . $lname . "' AND " 
	 . "cust_passw ='"
	 . $pswd ."'";
		
	//Insert a new user
	$sql = "INSERT INTO {$customerTbl} (cust_fname, cust_lname, cust_email, cust_passw) 
			VALUES 
			('" . $fname . "', " .
			"'" . $lname . "', " .
			"'" . $email . "', " .
			"'" . $pswd . "')";
	
	$result = mysqli_query($connection, $get_user);
	
	if($result){
		
		$row = mysqli_fetch_assoc($result);
			
		if($row['cust_id'] != ""){
			
			//Error
			$errorPswd = "***Password is prohibited, please Re-enter***";
		}
		else{
			
			$new_user = mysqli_query($connection, $sql);
			
			if($new_user){
				
				getUser($lname, $pswd); //Login and set cookies
			}
			else{
				
				//Error
				$sqlError = mysqli_error($connection);
			}
			
		}
					
	} else{
		//Error message - sql query has failed
		$sqlError = mysqli_error($connection);
	}
}


//Get/verify username/password from DB
function getUser($user, $pswd){
	
	global $customerTbl;
	global $wrongNamePsw;
	
	$sqlConn = connectMySQL(); //Connect to DB
	$sql = "SELECT cust_id, cust_fname, cust_lname FROM customertbl WHERE cust_lname ='" . $user . "' AND cust_passw ='" . $pswd . "'";
	
	$result = mysqli_query($sqlConn, $sql);
		
	if($result){
		
		$record = mysqli_fetch_assoc($result);
						
		if($record['cust_id'] != ""){
			//Login is OK
			$wrongNamePsw = "";

			setCookie("cust_id", $record['cust_id'],(time()+(60*60*2))); 	   //Set cookie - USER ID
			setCookie("cust_fname", $record['cust_fname'],(time()+(60*60*2))); //Set cookie - USER FIRST NAME
			setCookie("cust_lname", $record['cust_lname'],(time()+(60*60*2))); //Set cookie - USER LAST NAME
			
			mysqli_free_result($result); //Free computer memory
			mysqli_close($sqlConn);      //Close connection to DB

			redirecTo('titleSrch.php'); //Redirect
		}
		else{
			//Wrong UNP
			$wrongNamePsw = "***Your password DO NOT MATCH, Please Re-enter***<br /><br />";
			mysqli_close($sqlConn); //close connection to DB	
		}
		
	} else{
		//Quaery error
		$wrongNamePsw = mysqli_error($sqlConn) . "<br /><br />";
		mysqli_close($sqlConn); //close connection to DB	
	}
}


//Test if user logein:
function isLogedIn($pageTitleVar, $fileNameVar){
			
	global $server;
	global $username; 
	global $password;
	global $database;
	global $sqlError;
	
	if(isset($_COOKIE['cust_id']) && 
		isset($_COOKIE['cust_fname']) && 
		isset($_COOKIE['cust_lname'])){
		
		//Check if user exist in DB
		$connection = mysqli_connect($server, $username, $password, $database);
		$sql = "SELECT cust_id FROM customertbl 
				WHERE cust_fname = '" . $_COOKIE['cust_fname'] . "' 
				AND cust_lname = '" . $_COOKIE['cust_lname'] . "'";
				
		if(mysqli_connect_errno()){
			
			//SQL connection problem
			//$sqlError = "Can not connect to SQL database server";	
			$sqlError = mysqli_connect_error();
			
		} else{
			
			$result = mysqli_query($connection, $sql);
			
			if($result){
				
				$row = mysqli_fetch_assoc($result);			
				
				if($row['cust_id'] == $_COOKIE['cust_id']){
					
					//True user, load the web page
					$sqlError = "";	
					$pageTitle = $pageTitleVar;
					$fileName = $fileNameVar;	
					include_once("header.php");
					mysqli_free_result($result); //Free computer memory	
					mysqli_close($connection); //close connection to DB
						
				} else{
					
					$sqlError = "No such user";	
					mysqli_free_result($result); //Free computer memory	
					mysqli_close($connection); //close connection to DB
					//No such user in DB, redirect to login
					redirecTo('channelLogin.php'); //Redirect
				}
				
			} else{
				
				$pageTitle = $pageTitleVar;
				$fileName = $fileNameVar;	
				include_once("header.php");
				//Query error
				//$sqlError = "SQL Query error";
				$sqlError = mysqli_error($connection);		
				mysqli_close($connection); //close connection to DB
				redirecTo('channelLogin.php'); //Redirect
			}
			
		}
		
	} else{
		
		redirecTo('channelLogin.php'); //Redirect
	}
}


// Input fields (Search/credit card fields) validation
function isFieldEmpty($paramName){
		
	$testString = trim($_POST[$paramName]);
	
	if($testString != "" && empty($testString) == false){
		
		if( $paramName == 'searchField'){

			//Title value
			global $searchTitle;
			$searchTitle = $testString;
		}
		return false;
	}
	else {		
		//Empty string
		return true;
	}
}


//Proccess search form
function formProccess(){
	
	if(isset($_POST['submit'])){
		
		isFieldEmpty('searchField');
		getChannels();
	}
}


//Return channel genere
function getChGenere($name){
	
	//'e', 'f', 'i', 'm', 'n', 'o', 's', 't'
	
	switch($name){
		
		case ('e'):
			return "Entertainment";
		case ('f'):
			return "Family";
		case ('i'):
			return "Information";
		case ('m'):
			return "Movie";
		case ('n'):
			return "News/Business";
		case ('o'):
			return "Old TV Shows";
		case ('s'):
			return "Sci-Fi";
		case ('t'):
			return "Sports";
	}
}


//Get all channels
function getChannels(){
	
	global $channelTbl;
	global $sqlError;
	global $searchTitle;
	//global $searchBy;
	//global $orderBy;
	global $gener;
	global $groupByGener;
	global $table;
	
	$sqlConn = connectMySQL(); //Connect to DB
	
	if(mysqli_connect_errno()){
		
		//Quaery has failed
		$sqlError = "SQL quaery has failed";
		exit();
		
	}
	else{
		
		$table = "";
		
		$sql = "SELECT ch_title, ch_id, cha_logo, ch_genere, ch_price FROM {$channelTbl}";
				
		//GENERE
		if($_POST['genere'] != "all"){
			
			$sql = $sql . " WHERE ch_genere = '" . $_POST['genere'] . "'";
			
			//TITLE
			if(!isFieldEmpty('searchField')){
			
				if($_POST['select'] == 'withinTitle'){
				
					$sql = $sql . " AND ch_title LIKE '%" . $searchTitle . "%'";
				} else if($_POST['select'] = 'startingWith'){
				
					$sql = $sql . " AND ch_title LIKE '" . $searchTitle . "%'";
				} else{
					//exactTitle
					$sql = $sql . " AND ch_title = '" . $searchTitle . "'";
				}				
			}
		} else{
			
			//TITLE
			if(!isFieldEmpty('searchField')){
			
				if($_POST['select'] == 'withinTitle'){
					//withinTitle
					$sql = $sql . " WHERE ch_title LIKE '%" . $searchTitle . "%'";
				} else if($_POST['select'] = 'startingWith'){
					//tartingWith
					$sql = $sql . " WHERE ch_title LIKE '" . $searchTitle . "%'";
				} else{
					//exactTitle
					$sql = $sql . " WHERE ch_title = '" . $searchTitle . "'";
				}				
			}
		}
			
		//ORDER BY
		if(isset($_POST['group_genre'])){
			
			//if "Group by Genre" is checked
			$sql = $sql . " ORDER BY {$_POST['orderBy']} DESC";	
			$sql = $sql . ", {$_POST['group_genre']}";	

		} else{
			
			//if "Group by Genre" is unchecked
			$sql = $sql . " ORDER BY {$_POST['orderBy']} DESC";
		}
		 	
    	$responce = mysqli_query($sqlConn, $sql);
    	   	
    	if(!mysqli_errno($sqlConn)){
    		
    		while($row = mysqli_fetch_assoc($responce)){
				
				//ch_title, ch_id, cha_logo, ch_genere, ch_price
				
				$table = $table . "<tr>" . "<td>" .
					$row['ch_title'] .
					"</td>" .
					"<td>" .
					$row['ch_id'] .
					"</td>" .
					"<td>" .
					"<img src=\"logos/" . $row['cha_logo'] . "\" alt=\"" . $row['ch_title'] . "\">" . 
					"</td>" .
					"<td>" .
					(getChGenere($row['ch_genere'])) .
					"</td>" .
					"<td>" .
					$row['ch_price'] .
					"</td>" .
					"<td>" .
					"<input type=\"checkbox\" name=\"" . $row['ch_id'] . "\" value=\"{$row['ch_id']}\"/>" .
					"</td>" . "</tr>";
			}
    		mysqli_free_result($responce);	//Free computer memory			
		} 
		else{
			
			$sqlError =  $sql . "<br />" . sqlmysqli_error($sqlConn) ;
		}
    	
    	mysqli_close($sqlConn); // Explicitly closes the connection
	}
}


$list = array(); //List of previously lined-up/paid channels

//Get Lined Up channels
function getLinedUpCh($generateTable = true){
	
	global $channelTbl;
	global $sqlError;
	global $searchTitle;
	global $orderTbl;
	global $table;
	global $list;
	
	$sqlConn = connectMySQL(); //Connect to DB
	
	$table = "";
		
		//Step 1: add Channel lineup list (in WHITE)
		$userID = $_COOKIE['cust_id'];
		$sql = "SELECT C.ch_title, O.ord_ch_id, C.cha_logo, O.ord_price 
				FROM {$orderTbl} AS O 
				INNER JOIN {$channelTbl} AS C 
				ON C.ch_id = O.ord_ch_id 
				WHERE O.ord_cust_id = " . $userID . " AND O.ord_in_cart_ordered = 'y'";
		
		$responce = mysqli_query($sqlConn, $sql);
		
		if(!mysqli_errno($sqlConn)){
			
			//$row = mysqli_fetch_assoc($responce);			
			while($row = mysqli_fetch_assoc($responce)){
				
				$list[] = $row['ord_ch_id'];
				
				if($generateTable == true){
					
					//ch_title, ch_id, cha_logo, ch_genere, ch_price
					//Generate table
					$table = $table . "<tr>" . "<td>" .
						$row['ch_title'] .
						"</td>" .
						"<td>" .
						$row['ord_ch_id'] .
						"</td>" .
						"<td>" .
						"<img src=\"logos/" . $row['cha_logo'] . "\" alt=\"" . $row['ch_title'] . "\">" . 
						"</td>" .
						"<td>" .
						$row['ord_price'] .
						"</td>" .
						"</tr>";
					}					
				}
			
			mysqli_free_result($responce);	//Free computer memory	
		}
		else{
			
			$sqlError =  $sql . "<br />" . mysqli_error($sqlConn);
		}
				
	mysqli_close($sqlConn); // Explicitly closes the connection
}


//Get selected channel ID
function getSelectedID(){
	
	global $channelTbl;
	global $sqlError;
	global $orderTbl;		
	global $list;
	$string = "";
	
	//Step #1: Get last ID
	$sqlConn = connectMySQL(); //Connect to DB
	$sql = "SELECT MAX(ch_id) FROM {$channelTbl}";
	$responce = mysqli_query($sqlConn, $sql);

	if(mysqli_errno($sqlConn)){
		//Error
		$sqlError = mysqli_error($sqlConn);
		
	} else{
		//OK > get max ID from the DB
		//$sqlError = "";
		$row = mysqli_fetch_row($responce);
		mysqli_free_result($responce); //Free computer memory		
		
		$id = 1; //First ID
		$first = 0;		
		$list_id = "";
			
		while($id <= $row[0]){
		
			if(isset($_POST[$id])){
			
			
				if($first > 0){
				
					$string = $string . ", " . $id;
					$list_id = $list_id . "_" . $id;
				} else{
				
					$string = $string . $id;
					$list_id = $list_id . $id;
				}
				
				$first++;							
			}
		
			$id++;
		}
		
		if(!empty($list_id) && $list_id != ""){
			
			setCookie('ch_id', $list_id,(time()+(60*60*2))); //Set cookie with the list of selected/yellow channels
		}			
		
		mysqli_close($sqlConn); // Explicitly closes the connection						
	}
	
	return $string;
}


//Read id from coolies
function readCookieID(){
	
	$string = $_COOKIE['ch_id'];
	$array = array();
	$array = explode('_', $string);
	return $array;
}

$isCheckout = false;

//Generate table
function generateTable($ids){
	
	global $channelTbl;
	global $sqlError;
	global $searchTitle;
	global $orderTbl;
	global $table;
	global $list;
	global $selected;
	global $isCheckout;
	
	$sqlConn = connectMySQL(); //Connect to DB
	
	$row = "";
	//$sqlError = "";
			
	$sql = "SELECT ch_title, ch_id, cha_logo, ch_price FROM {$channelTbl} WHERE ch_id IN (";
	$sql = $sql . $ids;
	$sql = $sql  . ")";
		  	
    $responce = mysqli_query($sqlConn, $sql);
    	   	
    if(!mysqli_errno($sqlConn)){
    			
    	while($row = mysqli_fetch_assoc($responce)){
				
			if(!in_array($row['ch_id'], $list)){
										
				$selected[] = $row['ch_id']; 
					
				//ch_title, ch_id, cha_logo, ch_genere, ch_price
				//Generate table
				$table = $table . "<tr>" . "<td class=\"yellow\">" .
					$row['ch_title'] .
					"</td>" .
					"<td>" .
					$row['ch_id'] .
					"<input type='hidden' name='" . $row['ch_id'] . "' value='". $row['ch_id']. "'>" .
					"</td>" .
					"<td>" .
					"<img src=\"logos/" . $row['cha_logo'] . "\" alt=\"" . $row['ch_title'] . "\">" . 
					"</td>" .
					"<td class=\"yellow\">" .
					$row['ch_price'] . "<br />" .
					"</td>" .
				"</tr>";
				
				$isCheckout = true;			
				}
			}
    		mysqli_free_result($responce);	//Free computer memory			
		} 
		else{
			//Error
			$sqlError =  $sql . "<br />" . mysqli_error($sqlConn) ;
			$isCheckout = false;
		}
    	
    mysqli_close($sqlConn); // Explicitly closes the connection	
}

$selected = array(); //Unique selected ID's/Channels (not includes linedup already)

//Get all channels
function getSelectedChannels(){
	
	global $channelTbl;
	global $sqlError;
	global $searchTitle;
	global $orderTbl;
	global $table;
	global $list;
	global $selected;
	$ids = "";
	
	$sqlConn = connectMySQL(); //Connect to DB
	
	if(mysqli_connect_errno()){
		
		//Quaery has failed
		$sqlError = "SQL quaery has failed";
		exit();		
	}
	else{
		
		//Step 1: add Channel lineup list (in WHITE)
		getLinedUpCh();
			
		//Step 2: add CART list (in YELLOW):
		$ids = getSelectedID();		
		if($ids != "" && $ids != NULL){
			
			generateTable($ids);
		}
		else{
			
			$sqlError = "You did not select any channel! <br/>
						BUT below is your current Channel lineup (in WHITE) AND in your CART (in YELLOW) from before<br /><br />";
			
			$array = array();
			
			//Get ids from cookies:
			if(isset($_COOKIE['ch_id'])){
			
				$array = readCookieID();
				$ids = implode(',', $array);
				generateTable($ids);	
			}		
		}	 						
	} 	
}


//Calculate total Cart amount
function calcCart(){
	
	global $channelTbl;
	global $sqlError;
	global $selected; 
	
	if(!empty($selected)){
		
		$ids = implode(', ', $selected);
		
		$sqlConn = connectMySQL(); //Connect to DB
		//$sqlError = "";
			
		$sql = "SELECT SUM(ch_price) FROM {$channelTbl} WHERE ch_id IN (";
		$sql = $sql . $ids;
		$sql = $sql  . ")";
		
		$result = mysqli_query($sqlConn, $sql);
			
		if(!mysqli_errno($sqlConn)){
			
			$row = mysqli_fetch_row($result);			
			mysqli_free_result($result);
		}
		
		mysqli_close($sqlConn); // Explicitly closes the connection
		return $row[0];
	}
	else{
		
		return 0;
	}
}


//Calculate current LineUp
function calcLineUp(){
	
	global $orderTbl;
	global $sqlError;
	
	$row = "";
	$userID = $_COOKIE['cust_id'];
	
	$sqlConn = connectMySQL(); //Connect to DB	
	$sql = "SELECT SUM(ord_price) FROM {$orderTbl} WHERE ord_cust_id = " . $userID;	
	$result = mysqli_query($sqlConn, $sql);
	
	if(!mysqli_errno($sqlConn)){
		//OK
		$sqlError = "";
		$row = mysqli_fetch_row($result);
		mysqli_free_result($result); //Free computer memory
	} else{
		//ERROR
		$sqlError = mysqli_error($result);
	}
	
	mysqli_close($sqlConn); // Explicitly closes the connection
	
	if($row[0] != ""){
		
		return $row[0];
	} 
	else{
		
		return 0;
	}
}


$isValidCard = false; 

//Process channel order
function processChOrder(){
	
	global $isValidCard;
	global $sqlError;
	
	if(!empty($_POST['creditCard'])){
		
		//Test if credit card fiels empty + has 13-16 digits
			$testParam = trim($_POST['creditCard']);
			if(strlen($testParam) > 12 && strlen($testParam) < 17){ //Test length
			
				//Test for illigal chars
				for($char = 0; $char < strlen($testParam); $char++){
				
					if(!is_numeric(substr($testParam, $char))){
						//Not a number
						$isValidCard = false;
						$sqlError = "Invalid credit card number.<br/> Please check that your credit card number has min 13 or max 16 digits.<br/>";
						break;
					} else{
						//OK
						$isValidCard = true;
					}
				}			
			} else{	
				//Too long or too short	
				$sqlError = "Invalid credit card number.<br/> Please check that your credit card number has min 13 or max 16 digits.<br/>";
				$isValidCard = false;
			}
		}
		else{
			//Empty		
			$sqlError = "Invalid credit card number.<br/> Please check that your credit card number has min 13 or max 16 digits.<br/>";
			$isValidCard = false;
	}
}

$channelsPurchased;

//Purchase channel
function buyChannel(){
	
	global $channelTbl;
	global $sqlError;
	global $orderTbl;
	global $table;
	global $list;
	global $selected;
	global $channelsPurchased;
		
	$userID = $_COOKIE['cust_id'];
	$sqlConn = connectMySQL(); //Connect to DB
	
	//#1
	$ids = getSelectedID(); //Get list of channels customers wants to buy		
	$array = array();
	$array = explode(',', $ids); //List of channels to buy
	
	//#2
	getLinedUpCh(false); //Get list of channels that customer already have
	
	for($i = 0; $i < count($list); $i++){
		//Set all array values as int
		settype($list[$i], 'int');
	}
	
	for($i = 0; $i < count($array); $i++){
		//Set all array values as int
		settype($array[$i], 'int');
	}
	
	$arrayNew = array_diff($array, $list); //Filter channels that still were not ordered by the user
	$arrayNew = array_values($arrayNew);   //Reset array keys
	
	//$sqlError = "";
	
	if(!empty($arrayNew)){
		
			for($id = 0; $id < count($arrayNew); $id++){
		
			//Get channel price:
			$price_result = "SELECT ch_price FROM {$channelTbl} WHERE ch_id = {$arrayNew[$id]}";	
			$getPrice = mysqli_query($sqlConn, $price_result);		
		
			if(!mysqli_errno($sqlConn)){
			
				$price = mysqli_fetch_row($getPrice); //Price
			
				//Buy channel >>> add coresponding values
				$sql = "INSERT INTO {$orderTbl} 
					(ord_in_cart_ordered, ord_price, ord_cust_id, ord_ch_id) 
					VALUES ('y', {$price[0]}, {$userID}, {$arrayNew[$id]})";
				
				$row = mysqli_query($sqlConn, $sql);
					
				if(mysqli_errno($sqlConn)){
					//Error - can not incert a new order
					$sqlError = $sqlError  . "<br/>" . mysqli_error($sqlConn);
				} else{
					$sqlError = "";
					$channelsPurchased = $channelsPurchased . 
									"Order #: " . 
									($id + 1). 
									" Channel ID: " . 
									$arrayNew[$id] . 
									" Price: " . 
									$price[0] . "<br />";
				}		
			}
			else{
				//Error - can not get a price
				$sqlError = $sqlError . "<br/>" . mysqli_error($sqlConn);
			}		
		}
	} else{
		
		$channelsPurchased = "Order has ALREADY been processed!";
	}	
}


//Logout
function logOut($forceLogOut = false){
	//exit, logout
	if($forceLogOut == true){
		
		//Remove cookies
		setCookie("cust_id", NULL,(time()-(60*60*2))); 	  //Delete cookie - USER ID
		setCookie("cust_fname", NULL,(time()-(60*60*2))); //Delete cookie - USER FIRST NAME
		setCookie("cust_lname", NULL,(time()-(60*60*2))); //Delete cookie - USER LAST NAME
		setCookie('ch_id', NULL,(time()-(60*60*2)));      //Delete cookie with the list of selected/yellow channels
		
		//Redirect back to logon webpage
		redirecTo('channelLogin.php');	
	} 
}

// END OF PHP FILE			
?>
			