<?php
class HotelsModel {
	public function FileExists($filename){
		if (file_exists($filename)) {
			return include $filename;
			} else {
				$this->FileError($filename);
		}
	}
	public function FileError($filename){
		echo '<div style="padding:10px; "><span class="label label-danger" style="font-size:18px;">The file '.$filename.' does not exist</span><br></div>';	
	}
	public function anh(){
			$this->FileExists(TEMPLATES_INCLUDE_PATH.'hotels/addHotel.php');
	}
	public function ManageGalery(){
			$this->FileExists(TEMPLATES_INCLUDE_PATH.'hotels/galery.php');
	}
	
	public function createMenuItems($arr){
	?>
	<div class="mail-body text-left tooltip-demo">
	<?
	foreach($arr as $menu){
		?>
<a class="btn btn-sm btn-white" href="?page=<?=$menu['page']?>&action=<?=$menu['action']?>"><i class="fa fa-<?=$menu['icon']?>"></i> <?=$menu['itemName']?></a>
		<?
		
			}
//print_r($arr);
		?>
</div>
<div class="clearfix"></div>

		<?	
	}
	public function editHotelForm($hotelID){
	$this->FileExists(TEMPLATES_INCLUDE_PATH.'hotels/EditHotel.php');	
	}
	public function newRoomType(){
	$this->FileExists(TEMPLATES_INCLUDE_PATH.'hotels/addroomtype.php');	
	}
	public function editroomForm(){
	$this->FileExists(TEMPLATES_INCLUDE_PATH.'hotels/editRoom.php');	
	}
}