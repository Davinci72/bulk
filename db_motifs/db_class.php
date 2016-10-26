<?php
class MySQLDatabase {
	private $connection;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	public $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	
  function __construct() {
   		$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists( "mssql_real_escape_string" );
  }

	public function open_connection() {
		$this->connection = mssql_connect(DB_SERVER, DB_USER, DB_PASS);
		if (!$this->connection) {
			die("Database connection failed: " . mssql_get_last_message);
		} else {
			$db_select = mssql_select_db(DB_NAME, $this->connection);
			if (!$db_select) {
				die("Database selection failed: " . mssql_error());
			}
		}
	}

	public function close_connection() {
		if(isset($this->connection)) {
			mssql_close($this->connection);
			unset($this->connection);
		}
	}
	public function mssql_escape_mimic($inp) { 
    if(is_array($inp)) 
        return array_map(__METHOD__, $inp); 

    if(!empty($inp) && is_string($inp)) { 
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
    } 

    return $inp; 
}
	public function query($sql) {
	//	var_dump($sql);
		$this->last_query = $sql;
		$result = mssql_query($sql, $this->connection);
		$this->confirm_query($result);
		return $result;
	}
	
	public function escape_value( $value ) {
		if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mssql_real_escape_string can do the work
			if( $this->magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mssql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}
	
	// "database-neutral" methods
  public function fetch_array($result_set) {
    return mssql_fetch_array($result_set);
  }
  
  public function num_rows($result_set) {
   return mssql_num_rows($result_set);
  }
  
  public function insert_id() {
    // get the last id inserted over the current db connection
    return mssql_insert_id($this->connection);
  }
  
  public function affected_rows() {
    return mssql_rows_affected($this->connection);
  }

	private function confirm_query($result) {
		if (!$result) {
	    $output = "Database query failed: " . mssql_get_last_message() . "<br /><br />";
	    //$output .= "Last SQL query: " . $this->last_query;
	    die( $output );
		}
	}
public function pushError($error){
   echo $error;
   }
  public  function pushSuccess($success){
	echo' <div class="alert alert-success fade in col-lg-6">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<i class="fa fa-check-circle fa-fw fa-lg"></i>
<strong>'.$success.'</strong>
</div>';   
   }
  public function encryptIt( $q ) {
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $this->cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $this->cryptKey ) ) ) );
    return( $qEncoded );
}
public function decryptIt( $q ) {
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $this->cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $this->cryptKey ) ) ), "\0");
    return( $qDecoded );
}
public function getArrayToJsonEncrypt($array){
	$jsonData = json_encode($array);
	return $encData = $this->encryptIt($jsonData);
}
}
