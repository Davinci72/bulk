<?php
class CustomersControler {
	var $cm;
	var $view;
	public function __construct(){
		$this->cm=$this->loadModel();
		$this->view=$this->loadView();
		$this->view->viewCustomers();
	}
	public function loadModel(){
		 return new CustomersModel(); 
	}
	public function loadView(){
		return new CustomersView();
	}
}