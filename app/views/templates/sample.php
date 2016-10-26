<?
if(isset($_GET['delete'])){ ?> 
        <div class="ibox-content">
            <div class="row  b-r">
                <div class="col-sm-8 b-r"><?
        $i = $this->modDelete('contacts',$_GET['delete']);
        if($i >=1 ){
    echo 'Contact Deleted';
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
                        <th>Phone Number</th>
                        <th>Full Names</th>
                        <th>Contact Group</th>
                        <th>Date Aded</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?  
                   if(isset($_GET['group'])) { $sql='SELECT * FROM contacts WHERE group_id='.$_GET['group'].' AND apikey='.$_SESSION['SESS_MEMBER_ID'];  } else { $sql='SELECT * FROM contacts WHERE apikey='.$_SESSION['SESS_MEMBER_ID']; }
$emp_det = $this->db->query($sql);
$num = $this->db->num_rows($emp_det);
if($num ===0){
$this->db->pushError('<span class="label label-danger">No Contacts Found!!</span>');	
}else {
	while($row = $this->db->fetch_array($emp_det)){
	$id = $row['member'];	
	$s = $row['aproved'];
	?>
                    <tr class="gradeX">
                        <td><input type="checkbox" /></td>
                        <td><?=$row['phone']?><div><a href="?page=sms&action=contacts&group=<?=$row['group_id']?>&edit=<?=$row['ID']?>">Edit</a> |<a href="?page=sms&action=contacts&group=<?=$row['group_id']?>&delete=<?=$row['ID'];?>"> Delete</a> </div></td>
                        <td> <?=$row['f_name'].' '.$row['l_name'].' '.$row['other_name']?></td>
                        <td><? $this->groupName($row['group_id']) ?></td>
                        <td class="center"><?=$row['date']?></td>
                        <?
	}
}
?>
                    </tr>
                    </tbody>
                    </table>
</form>


                    </div>
                    </div>
                    </div>
                    </div>
                     <div class="ibox-content">
                     <form>
                     <div class="col-sm-10"></div>
                     <div class="col-sm-1">
                     <select class="form-control m-b" name="account">
                                        <option>Edit</option>
                                        <option>Move To Trash</option>
                                    </select>
                                    </div>
                     <button type="button" class="btn btn-outline btn-primary">Apply</button>
                     </form>
                     </div>
