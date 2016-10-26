<?php
class BookingsControler {
	var $bm;
	var $view;
	public function __construct(){
		$this->cm=$this->loadModel();
		$this->view=$this->loadView();
		$this->view->viewBookings();
	}
	public function loadModel(){
		 return new BookingsModel(); 
	}
	public function loadView(){
		return new BookingsView();
	}
}