<?php
class smsModel{
	public function FileExists($filename,$options){
		if (file_exists($filename)) {
			return include $filename;
			} else {
				$this->FileError($filename);
		}
	}
	public function FileError($filename){
		echo '<div style="padding:10px; "><span class="label label-danger" style="font-size:18px;">The file '.$filename.' does not exist</span><br></div>';	
	}
	public function compose(){
			$this->FileExists(TEMPLATES_INCLUDE_PATH.'sms/composesms.php','');
	}
	public function contactsMn(){
		$this->FileExists(TEMPLATES_INCLUDE_PATH.'sms/contacts.php','');
	}
	public function useridMn(){
		$this->FileExists(TEMPLATES_INCLUDE_PATH.'sms/user_id.php','');
	}
	public function Pform(){
		$this->FileExists(TEMPLATES_INCLUDE_PATH.'sms/purchases.php','');
	}
	public function shareForm(){
		$this->FileExists(TEMPLATES_INCLUDE_PATH.'sms/shareUnits.php','');
	}
	public function smsreport($view){
		$this->FileExists(TEMPLATES_INCLUDE_PATH.'sms/smsreports.php',$view);
	}
	public function pr(){
		$this->FileExists(TEMPLATES_INCLUDE_PATH.'sms/purchasesRe.php','');
	}
	public function purchases(){
		$this->FileExists(TEMPLATES_INCLUDE_PATH.'sms/allpurchases.php','');
	}
}