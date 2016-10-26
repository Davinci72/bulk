<?php

class page {
//var $database;
		var $page;
		var $action;
		var $variables;
		var $mode;
	public function __construct($page,$action,$vars){
	//both model views and controllers must have the same names and case followed by an underscore 
	//global $database;
		$this->variables=$vars;
		if(empty($page)){ 
		$this->page = 'hotels';
		} else {
		$this->setPage($page);
		//controlers
		$this->LoadControlers();
		//models
		$this->LoadModels();

		//views
		$this->LoadViews();
		//initiate the class
		
		$mode = $this->initiateClass();
		//check to see if there is any action requested
		if(empty($action)){
		//display controler menu or something
		}else{
		$mode->$action($vars);
		}
	//var_dump($action);
		}
	}
	public function setPage($page){
	$this->page=$page;	
	}
	public function setAction($action){
	$this->action=$action;	
	}
	public function LoadControlers(){
		return require(CONTDIR."".$this->page."Controler.php");
	}
	public function LoadModels(){
			return require (MODDIR."".$this->page.'Model.php');	
	}
	public function LoadViews(){
			return require (VDIR."".$this->page.'View.php');
	}
	public function initiateClass(){
	$class = $this->page.'Controler';
	return $this->mode = new $class();	
	}
	public function request($request){
	$this->mode->$request($this->variables);
	}
	
		public function FileError($filename){
		echo '<div style="padding:10px;"><span class="label label-danger error-h">The file '.$filename.' does not exist</span><br></div>';	
	}
	
	public function FileExists($filename){
		if (file_exists($filename)) {
		return include $filename;
			} else {
		$this->FileError($filename);
		}
	}

}