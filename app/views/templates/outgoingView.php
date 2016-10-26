
                      <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
                <tr>
                    <th style="width:5%;">Select</th>
                    <th style="width:10%;">Date</th>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th>Message</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?
            $sql='SELECT * FROM GENERATIONS.dbo.ozekimessageout ORDER BY senttime DESC';
            $emp_det = $this->db->query($sql);
            $num = $this->db->num_rows($emp_det);
            if($num ===0){
                $this->db->pushError('<span class="label label-danger">No Messages Found!!</span>');    
            }else {
    while($row = $this->db->fetch_array($emp_det)){ ?>
               <tr class="gradeX">
                    <td><input type="checkbox" /></td>
                    <td><?=$row['senttime']?></td>
                    <td><?=$row['sender']?></td>
                    <td><?=$row['receiver']?></td>
                    <td><?=$row['msg']?></td>
                    <td class="center"><?=$row['status']?></td>
                </tr>
                <? } } ?>
            </tbody>
        </table>
