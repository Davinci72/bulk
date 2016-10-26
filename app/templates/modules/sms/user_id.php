<?php
    if(file_exists(HOOKS_INCLUDE_PATH.'sms.php'))
    { 
            require HOOKS_INCLUDE_PATH.'sms.php'; 
            $mHook = new smsModuleHook;
    }
            else 
    {
         echo 'file '.HOOKS_INCLUDE_PATH.'sms.php does not exist'; 
 }
if($_POST['save']){
    $freeze =0;
    $error ='';
    $sender = $_POST['sender'];
    $purpose = $_POST['purpose'];
    if(empty($sender)){
    $freeze=1;
    }
    if(empty($purpose)){
    $freeze=1;
    }

   }
   ?>
    <div class="ibox-content">
        <div class="row">
         <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <p><?   if(isset($_POST['save'])){
                    if($freeze==0){
                       $res = $mHook->registerSenderId($sender,$purpose);
                         
            }
   }
   ?>
</p>
<div class="row">          
<div class="col-lg-2"></div>
<div class="col-lg-10">

<? if(isset($res)){
    ?>
    <div class="alert alert-success alert-dismissable text-center">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                              <?=$res?>
                            </div>
                            <? 
    } 
    ?>
</div>
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-content">
<form action="" method="post" class="form-horizontal">
    <div class="form-group has-<?=$mHook->errorCheckStatus($freeze,$sender)?>"><label class="col-sm-2 control-label">Sender ID :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="<? $mHook->OtherErrorCheck($freeze,$sender); ?>" value="<?=$mHook->freeze($freeze,$sender)?>" name="sender">
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group has-<?=$mHook->errorCheckStatus($freeze,$purpose)?>"><label class="col-sm-2 control-label">Purpose</label>
        <div class="col-sm-10">
            <input type="text" placeholder="<? $mHook->OtherErrorCheck($freeze,$purpose); ?>" name="purpose" value="<?=$mHook->freeze($freeze,$purpose)?>" class="form-control"> 
            <span class="help-block m-b-none">A Brief Description Of the sender ID and the purpose.</span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-sm-4 col-sm-offset-2">
            <button class="btn btn-white" type="submit">Clear</button>
            
            <input type='submit' name='save' class="btn btn-primary" value="Register Sender ID">
        </div>
    </div>
</form>
</div>
</div>
</div>
</div>