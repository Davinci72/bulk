<?php
class HotelsControler {
	var $sm;
	var $view;
	var $page = 'Hotels';
	public function __construct(){
		$this->sm=$this->loadModel();
		$this->view=$this->loadView();
	}
	public function loadModel(){
		 return new HotelsModel(); 
	}
	public function loadView(){
		return new HotelsView();
	}	

	public function NewHotels() {
		$this->sm->anh();
	}
	public function RoomSetup(){
	$globalMenu = array('item1'=>array('itemName'=>'Room Types','page'=>$this->page,'action'=>'roomTypes','icon'=>'reply'),
					'item3'=>array('itemName'=>'Manage Rooms','page'=>$this->page,'action'=>'roomSetup','icon'=>'cogs'),
					'item4'=>array('itemName'=>'Available Rooms','page'=>$this->page,'action'=>'roomAvailability','icon'=>'toggle-on'),
					'item5'=>array('itemName'=>'Booked Rooms','page'=>$this->page,'action'=>'Bookedrooms','icon'=>'toggle-off'),
					'item6'=>array('itemName'=>'Checkout Guest','page'=>$this->page,'action'=>'checkout','icon'=>'suitcase'),
					'item7'=>array('itemName'=>'Amenities','page'=>$this->page,'action'=>'amenities','icon'=>'wifi')
					);
	$this->sm->createMenuItems($globalMenu);
	}
	
	public function amenities(){
		
	}
	public function NewProperty(){
		
	}
	public function ManageProperties(){
		$this->view->viewHotels();
	}
	public function ManageImageGallery(){
			$this->sm->ManageGalery();
	}
	
	public function newRoom(){
	$this->RoomSetup();	
	}
	public function roomTypes(){
	$this->RoomSetup();
	$this->sm->newRoomType();
	$this->view->roomTypes();	
	}
	public function edithotel($hotelID){
	$this->sm->editHotelForm($hotelID);	
	}
	public function editRoom(){
	$this->roomSetup();	
	$this->sm->editroomForm();
	$this->view->roomTypes();	
	}
}