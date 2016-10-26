<?php
if(file_exists(HOOKS_INCLUDE_PATH.'sms.php'))
{ 
require HOOKS_INCLUDE_PATH.'sms.php'; 
$mHook = new SmsModuleHook;
}
else 
{
echo 'file '.HOOKS_INCLUDE_PATH.'sms.php does not exist'; 
}
if($_POST['save'] or $_POST['edit']){
$freeze =0;
$error ='';
$phone = $_POST['phone'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$oname = $_POST['oname'];
$group = $_POST['group'];
//exit();

if(empty($phone)){
$freeze=1;
}
if(empty($fname)){
$freeze=1;
}
if(empty($group)){
$freeze=0;
}
}
if($_POST['gname'] !=''){
$mHook->createGroup($_POST['gname']);
$mHook->ModeSuccess('Group Created');  
}
?>
<div class="ibox-content">
<div class="row">

<div class="col-sm-2">
<div class="hr-line-dsashed"></div>
<div class="panel panel-primary">
<div class="panel-heading">
<h5>
Contacts Groups
</h5>
</div>

<div class="panel-body">
    <div class="text-center">
        
<? if(isset($_GET['deleteGroup'])){ ?> <div class="row  b-r">
            <div class="col-sm-8 b-r"> <? $mHook->groupDelete($_GET['deleteGroup']); ?> </div>
        </div><? } ?>
            
    </div>
	<div class="text-center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Upload Contacts <i class="fa fa-cloud-upload"></i>
        </button>
    </div>
 <div class="hr-line-dashed"></div>
    <div class="text-center">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalc">
            Create Groups <i class="fa fa-plus"></i>
        </button>
    </div>
<div class="hr-line-dashed"></div>
<ul class="list-group" style="padding: 0">
<li class="list-group-item"><a href="?page=sms&action=contacts"><i class="fa fa-folder<? if(empty($_GET['group'])){ echo '-open-o'; } ?>"></i>  &nbsp;All Contacts</a></li>
<? $mHook->getGroups(); ?>
</ul>
</div>

</div>

<div class="hr-line-dashed"></div>
</div>

                   
                    <div class="col-sm-10">
                           
                <p><? if(isset($_POST['save'])){
                	if($freeze==0){
         $res = $mHook->addNewContact($phone,$fname,$lname,$oname,$group);
         
}
   }
   if($_POST['edit']){
   	if($freeze==0){
$res = $mHook->EditContact($phone,$fname,$lname,$oname,$group,$_GET['edit']);
}
}
 
?>
</p>
<div class="hr-line-dashed"></div>
<div class="col-sm-2"><? if($freeze >= 1){
	$mHook->Moderror('Ensure All Fields Have Values');
	}if(isset($res)){
            $mHook->ModeSuccess($res);
         }?>
             
         </div>
<div class="col-sm-10">
<div class="row" >
<form action="" role="form" class="form-inlin" method="post">
    <div class="form-group col-md-2">
        <input type="text" name="phone" placeholder="Phone(2547xxxxxx)" value="<? if(isset($_GET['edit'])){ 
       echo $mHook->returnPhone($_GET['edit']); 
        }
         ?>" class="form-control input-sm">
    </div>
    <div class="form-group col-md-2">
        <input type="text" name="fname" placeholder="First Name" value="<? if(isset($_GET['edit'])){ echo $mHook->returnFirstname($_GET['edit']); 
        } ?>" class="form-control input-sm">
    </div>
    <div class="form-group col-md-2">
        <input type="text" name="lname" placeholder="Last Name" value="<? if(isset($_GET['edit'])){ echo $mHook->returnlname($_GET['edit']);} ?>"  class="form-control input-sm">
    </div> 
    <div class="form-group col-md-2">
        <input type="text" name="oname" placeholder="Other Name" value="<? if(isset($_GET['edit'])){ echo $mHook->returnOname($_GET['edit']);} ?>"  class="form-control input-sm">
    </div>
    <select class="input-sm chosen-select col-md-2" name="group" style="width:20%;"  tabindex="2">
            <option value="">Select Group</option>
               <? $mHook->groupsList() ?>
                </select>
    <input type='submit' name='<? if(isset($_GET["edit"])){ echo "edit"; } else { echo "save"; } ?>' class="btn-u btn btn-success" value='<? if(isset($_GET["edit"])){ echo "Edit Contact"; } else { echo "Create Contact"; } ?>'>
</form>
</div>
<div class="hr-line-dashed"></div>

</div>

<!--Modal Stuff -->
<div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-users modal-icon"></i>
                                            <h4 class="modal-title">Upload Contacts To Group</h4>
                                        </div>
                                        <div class="modal-body">
<form id="my-awesome-dropzone" class="dropzone" action="?page=sms&action=contacts&group=1&request=upload" method="post">
    <div class="dropzone-previews"></div>
    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary pull-right">Upload Contacts</button>
</form>
                                        </div>
                                    </div>
                                </div>
                            </div>


<div class="modal inmodal" id="myModalc" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-users modal-icon"></i>
                                            <h4 class="modal-title">Create Group</h4>
                                        </div>
                                        <div class="modal-body">
<form class="form-horizontal" action="" method="post" role="form" method="post">
<div class="form-group">

                                    <div class="col-sm-12"><input type="text" name="gname" class="form-control" placeholder="Enter Group Name"></div>
                                </div>
    
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary col-sm-12">Create Group <i class="fa fa-plus"></i></button>
</form>
                                        </div>
                                    </div>
                                </div>
                            </div>


 