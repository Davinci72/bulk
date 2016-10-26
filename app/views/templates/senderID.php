
<div class="col-sm-12">
<div class="hr-line-dashed"></div>
<div class="ibox-content">
    <form>
        <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
                <tr>
                    <th>Select</th>
                    <th>Sender ID</th>
                    <th>Purpose</th>
                    <th>Status</th>
                    <th>Balance</th>
                    <th>Date Aded</th>
                </tr>
            </thead>
            <tbody>
            <? 
            $sql = 'SELECT * FROM sender_id';
            $res = $this->db->query($sql);
            $num = $this->db->num_rows($res);
            if($num ===0){
            $this->db->pushError('<span class="label label-danger">No Sender ID</span>');    
            }else {
                while($row = $this->db->fetch_array($res)){

             ?>
                <tr class="gradeX">
                    <td><input type="checkbox" /></td>
                    <td><?=$row['sender_id']?></td>
                    <td> <?=$row['purpose']?></td>
                    <td><? if($row['active'] == 1) { ?><p><span class="label label-success">Active</span></p>
                    <?
                } else { ?><p><span class="label label-danger">In Active</span></p>
                    <? } ?></td>
                    <td><?=$row['balance']?></td>
                    <td class="center"><?=$row['date']?></td>
                </tr>
                <?
            }
        }
            ?>
            </tbody>
        </table>
    </form>
</div>
</div>
<div class="ibox-content">
    <form>
        <div class="col-sm-9"></div>
        <div class="col-sm-2">
            <select class="form-control m-b" name="account">
                <option>Edit</option>
                <option>Move To Trash</option>
            </select>
</div>
            <button type="button" class="btn btn-outline btn-primary">Apply</button>
    </form>
</div>
</div>
