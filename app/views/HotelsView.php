<?php
class HotelsView {
	var $db;
	public function __construct(){
	$this->db=$this->returnDb();
	}
	public function returnDb(){
	return new MySQLDatabase;
	}
	public function modDelete($table,$where){
	$sql='DELETE FROM '.$table.' WHERE id='.$where;
	$this->db->query($sql);	
	return $affected = $this->db->affected_rows();
	//var_dump($affected);
	}
	public function viewHotels(){
	if(isset($_GET['delete'])){
	?><div class="ibox-content">
        <div class="row  b-r">
        <div class="col-sm-12 b-r"><?
		$i = $this->modDelete('hotels',$_GET['delete']);
		if($i >=1 ){
	echo 'Item Deleted';
		} else {
			
		}
	?>
        </div>
        </div>
    </div>
		<?
	}
?>
                    <div class="ibox-content">
                    <form>
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Select</th>
                        <th>Hotel Name</th>
                        <th>Hotel Location</th>
                        <th>Contact Email</th>
                        <th>Contact Phone</th>
                        <th>Date Aded</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?  $sql='SELECT * FROM hotels';
$emp_det = $this->db->query($sql);
$num = $this->db->num_rows($emp_det);
if($num ===0){
$this->db->pushError('<div style="padding:10px;"><span class="label label-danger">No Loan Applications Data!!</span></br></div>');	
}else {
	while($row = $this->db->fetch_array($emp_det)){
	$id = $row['member'];	
	$s = $row['aproved'];
	?>
                    <tr class="gradeX">
                        <td><input type="checkbox" /></td>
                        <td><?=$row['hname']?><div><a href="?page=hotels&action=edithotel&hotelId=<?=$row['id']?>">Edit</a> |<a href="?page=Hotels&action=ManageProperties&delete=<?=$row['id'];?>"> Delete</a>|<a href="?page=Hotels&action=ManageImageGallery&hotelid=<?=$row['id']?>&folder=0"> Image Gallery</a> </div></td>
                        <td> <?=$row['locale']?></td>
                        <td><?=$row['mail']?></td>
                        <td class="center"><?=$row['phone']?></td>
                        <td class="center"><?=$row['date_aded']?></td>
                        <?
	}
}
?>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Select</th>
                        <th>Hotel Name</th>
                        <th>Hotel Location</th>
                        <th>Contact Email</th>
                        <th>Contact Phone</th>
                        <th>Date Aded</th>
                    </tr>
                    </tfoot>
                    </table>
</form>


                    </div>
                     <div class="ibox-content">
                     <form>
                     <div class="col-sm-1">
                     <select class="form-control m-b" name="account">
                                        <option>Edit</option>
                                        <option>Move To Trash</option>
                                    </select>
                                    </div>
                     <button type="button" class="btn btn-outline btn-primary">Apply</button>
                     </form>
                     </div>
        <?
	}
	public function roomTypes(){
		if(isset($_GET['delete'])){
	?>
        
        <div class="col-sm-6 b-r"><div class="row  b-r"><?
		$i = $this->modDelete('rooms',$_GET['delete']);
if($i >=1 ){
	echo 'Item Deleted';
		} else {
			
		}	?>
        </div>
        </div>
    
		<?
	}
?>
<div class="col-sm-8">
                    <form>
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Select</th>
                        <th>Room Name</th>
                        <th>Price Per Night</th>
                        <th>No Of Rooms</th>
                        <th>Maximum guests</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?  $sql='SELECT * FROM rooms';
$emp_det = $this->db->query($sql);
$num = $this->db->num_rows($emp_det);
if($num ===0){
$this->db->pushError('<div style="padding:10px;"><span class="label label-danger">No Loan Applications Data!!</span></br></div>');	
}else {
	while($row = $this->db->fetch_array($emp_det)){
				$id = $row['id'];	
			?>
                    <tr class="gradeX">
                        <td><input type="checkbox" /></td>
                        <td><?=$row['roomname']?><div>
                        <a href="?page=Hotels&action=editRoom&roomId=<?=$row['id']?>">Edit</a>
                        |<a href="?page=Hotels&action=roomTypes&delete=<?=$row['id'];?>"> Delete</a>|
                        <a href="?page=Hotels&action=ManageImageGallery&hotelid=<?=$row['hotel_id']?>&folder=3&roomId=<?=$row['id']?>"> Image Gallery</a> |
                        <a href="?page=Hotels&action=ManageImageGallery&room=<?=$row['id']?>&folder=0"> View</a> 
                        </div></td>
                        <td> <?=$row['ppernite']?></td>
                        <td><?=$row['norooms']?></td>
                        <td class="center"><?=$row['maxguests']?></td>
                        <?
	}
}
?>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Select</th>
                        <th>Room Name</th>
                        <th>Price Per Night</th>
                        <th>No Of Rooms</th>
                        <th>Maximum guests</th>
                    </tr>
                    </tfoot>
                    </table>
</form>

                    </div>
                     <form>
                     <div class="col-sm-1">
                     <select class="form-control m-b" name="account">
                                        <option>Edit</option>
                                        <option>Move To Trash</option>
                                    </select>
                                    </div>
                     <button type="button" class="btn btn-outline btn-primary">Apply</button>
                     </form>
                     </div>
                     </div>
                    </div>


        <?
	
	}
	
	
}