<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('../db_motifs/config.php');
	require_once('../db_motifs/db_class.php');
	$database = new MySQLDatabase;
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	/*/Connect to mysql server
	$link = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_NAME);
	if(!$db) {
		die("Unable to select database");
	}
	*/
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$login = $_POST['login'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
	
	//Input Validations
	if($fname == '') {
		$errmsg_arr[] = 'First name missing';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = 'Last name missing';
		$errflag = true;
	}
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	
	//Check for duplicate login ID
	if($login != '') {
		$sql = "SELECT * FROM users WHERE login = '$login'";
		$result = $database->query($sql);
		if(isset($result)) {
			if($num = $database->num_rows($result) > 0) {
				var_dump($num);
				$errmsg_arr[] = 'Login ID already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: register-form.php");
		exit();
	}

	//Create INSERT query
	$sql = "INSERT INTO users (firstname, lastname, login, passwd,hotelId) VALUES ('$fname','$lname','$login','$password','1')";
	//$result = @mysql_query($qry);
	$result = $database->query($sql);
	var_dump($sql);
	
	//Check whether the query was successful or not
	if($result) {
		header("location: register-success.php");
		exit();
	}else {
		die("Query failed");
	}
?>