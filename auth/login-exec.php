<?php
	//Start session
	session_start();

	
	//Include database connection details
	require_once('../db_motifs/config.php');
	require_once('../db_motifs/db_class.php');
	//Array to store validation errors
	$database = new MySQLDatabase;
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	/*Connect to mysql server
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
	$login = $_POST['login'];
	$password = $_POST['password'];
	//exit();
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: login-form.php?error=".$errmsg_arr);
		exit();
	}
	
	//Create query
	$sql="SELECT * FROM users WHERE login='$login' AND passwd='".md5($_POST['password'])."'";
	//$result=mysql_query($qry);
	$result = $database->query($sql);
	$num_rows = $database->num_rows($result);
	
	//Check whether the query was successful or not
	if($result) {
		if($num_rows == 1) {
			//Login Successful
			session_regenerate_id();
			$member = mssql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID'] = $member['user_id'];
			$_SESSION['SESS_HOTEL_ID'] = $member['hotelId'];
			$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
			session_write_close();
			//var_dump($_SESSION);
			//exit();
			$url = 'http://197.248.45.133/bulk';
			header("location: $url/index.php");
			exit();
		}else {
			//Login failed
			header("location: http://197.248.45.133/bulk/auth/login-failed.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>