<?
class smsControler {
	var $sm;
	var $view;
	public function __construct(){
		$this->sm=$this->loadModel();
		$this->view=$this->loadView();
		$this->view->viewSms();
	}
	public function loadModel(){
		 return new smsModel(); 
	}
	public function loadView(){
		return new smsView();
	}
	public function sendsms(){
		//load send sms template from model
		$this->sm->compose();
	}
	public function contacts() {
		$this->sm->contactsMn();
		$this->view->viewHotels();
	}
	public function userid() {
		$this->sm->useridMn();
		$this->view->viewSenderID();
	}
	public function purchase() {
		//$this->returnView('purchase');
		$this->sm->Pform();
	}
	public function share(){
		$this->sm->shareForm();
	}
	public function incomingsms() {
		$this->view->viewSenderID();	
	}
	public function sendsmsreports(){
		$this->sm->smsreport($this->view);
	}
	public function purchasesReports(){
		$this->sm->pr();
	}
	public function purchases(){
		$this->sm->purchases();
	}
}
