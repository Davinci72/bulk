<?php 
class CustomersView{
		var $db;
	public function __construct(){
	$this->db=$this->returnDb();
	}
	public function returnDb(){
	return new MySQLDatabase;
	}

	public function viewCustomers(){
		?>
        
        <?php 
if(isset($_GET['delete'])){
	?><div class="ibox-content">
        <div class="row  b-r">
        <div class="col-sm-12 b-r"><?
	echo 'Item Deleted';
	?>
    </div>
        </div>
        </div><?
	}
?>
        
                    <div class="ibox-content">
<form>
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Select</th>
                        <th>Customer ID</th>
                        <th>Customer Names</th>
                        <th>Contact Email</th>
                        <th>Contact Phone</th>
                        <th>Card Info</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?  $sql='SELECT * FROM bookings';
$emp_det = $this->db->query($sql);
$num = $this->db->num_rows($emp_det);
if($num ===0){
$this->db->pushError('<div style="padding:10px;"><span class="label label-danger">No Existing Customers Info!!</span></br></div>');	
}else {
	while($row = $this->db->fetch_array($emp_det)){
	$id = $row['member'];	
	$s = $row['aproved'];
	?>
                    <tr class="gradeX">
                        <td><input type="checkbox" /></td>
                        <td><?=$row['id']?></td>
                        <td> <?=$row['fname']?> <?=$row['lname']?>
<div><a href="?page=Hotels&action=ManageProperties&delete=<?=$row['id'];?>"> Delete</a> </div>
                        </td>
                        <td class="center"><?=$row['email']?></td>
                        <td class="center"><?=$row['phone']?></td>
                        <td class="center"><?=$row['cardNumber']?></td>
                        <?
	}
}
?>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Select</th>
                        <th>Customer ID</th>
                        <th>Customer Names</th>
                        <th>Contact Email</th>
                        <th>Contact Phone</th>
                        <th>Card Info</th>
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
	

}