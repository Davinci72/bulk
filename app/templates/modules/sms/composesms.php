<?php
ini_set('max_execution_time', 300);
    if(file_exists(HOOKS_INCLUDE_PATH.'sms.php'))
    { 
            require HOOKS_INCLUDE_PATH.'sms.php'; 
            $mHook = new SmsModuleHook;
    }
            else 
    {
         echo 'file '.HOOKS_INCLUDE_PATH.'sms.php does not exist'; 
 }
 // $mHook->returnSenderID();
if($_POST['save']){
    $freeze =0;
    $error ='';
    $succes = '';
    $time = '';
    $senderid = $_POST['senderid'];
    $groups = $_POST['groups'];
    //echo $fileToUpload = $_POST['fileToUpload'];
    $target_dir = "/var/www/html/bulk/uploads/";
    $file = basename($_FILES["fileToUpload"]["name"]);


    $schedule = $_POST['sel'];
    if(isset($schedule)){
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $hour = $_POST['hour'];
    $min = $_POST['minute']; 
    $time .= $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
    $ft = date('Y-m-d H:i:s', strtotime($time));
    //echo $time;
    //exit();
    }

    $message = $mHook->db->mssql_escape_mimic($_POST['message']);
    if(empty($senderid)){
    $freeze=1;
    }
    if(empty($message)){
    $freeze=1;
    }
    if(empty($groups) && empty($file)){
        $freeze=1;
        $errorMsg =  'Select Atleast One Receipient';
    }
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
    $error .="Sorry, your file is too large.";
    $uploadOk = 0;
    $freeze = 1;
} else {
    $file = basename($_FILES["fileToUpload"]["name"]);
    $fileToUpload =$target_dir.basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($fileToUpload,PATHINFO_EXTENSION);
    } if(empty($file)){} else{
if($imageFileType != "csv"){
    $error .='Only Csv files Can Be uploaded';
    $freeze=1;
    $uploadOk = 0;   
} else {
     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileToUpload)) {
    $succes .='SMS Logged For Sending';
    //do some processing then unlink the file
    $mHook->loadCsvFile($fileToUpload,$senderid,$message,$ft);
     }
}
}
   }
   ?>
    <div class="ibox-content">
                        <div class="row">
                        <div class="col-sm-2"></div>

                            <div class="col-sm-8">
                           
                <p><?

                if(isset($error)){
                $mHook->Moderror($error);
            }
            if ( $succes !='') {
                # code...
             $mHook->ModeSuccess($succes);
            }
                 if(isset($_POST['save'])){if($freeze==0){
        $res = $mHook->LogSms($senderid,$message,$ft);
         if(isset($groups)){
         $mHook->handleContacts($groups);
         $mHook->ModeSuccess('SMS Logged For Sending');
     }
         if(isset($res)){
            echo $res;
         }
}
   }
   ?>
</p>
                <form action="" method="post" role="form" enctype="multipart/form-data">
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <label><?=$mHook->errorCheck($freeze,$senderid,'From :')?></label>
                <div class="input-group">
                <select data-placeholder="Choose Sender id ..." class="chosen-select" style="width:350px;" name="senderid" tabindex="2">
               <?  $mHook->returnSenderID() ?>
               <option value="NWABO TURI">NWABO TURI</option>
                </select>
                </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label>To :<? if(isset($errorMsg)){ $mHook->Moderror($errorMsg); } ?></label> 
                <div class="panel panel-default">

                       
                            
                            <div class="panel-heading panel-options">

                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-4" aria-expanded="false"><i class="fa fa-users"> Add From Contacts</i></a></li>
                                    <li class=""><a data-toggle="tab" href="#tab-5"><i class="fa fa-desktop"></i> Upload CSV</a></li>
                                </ul>
                            </div>
                        

                        <div class="panel-body">

                            <div class="tab-content">
                                <div id="tab-4" class="tab-pane active">
                                   
<div class="col-sm-12">
    <select data-placeholder="Choose a Contact..." class="chosen-select" name="groups[]" multiple style="width:inherit;" tabindex="8">
        <?  $mHook->ContactsGroups(); $mHook->ContactsSingle(); ?>         
    </select>
    
                </div>

                 <div class="row">
                <div class="col-sm-12">
                <div class="hr-line-dashed"></div>
    <code>Select and add contacts and lists from your Contacts or simply start typing their mobile numbers.</code></div>
                                </div>
               
                                </div>


                                <div id="tab-5" class="tab-pane">
                                   <input type="file"  name="fileToUpload" id="fileToUpload">
                                </div>
                               
                            </div>

                        </div>

                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$message,'Message :')?></label> 
                <div class="panel panel-primary">
                                        
                                        <div class="panel-body">
                                           <textarea name="message" class="col-md-12" id="myInput" style="border:0;" placeholder="Write your SMS here. "></textarea>
                                        </div>
                                        <div class="panel-heading" id="charCount">
                                            
                                        </div>  
                                    </div>
                                    </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label>Schedule :</label> 
              <input type="checkbox" class="js-switch_3" value="1" name="sel" onchange="valueChanged()"/>&nbsp;
              <span class="hid" style="">
              <select class="input-sm chosen-selec hid" name="day" style="width:80px;"  tabindex="2">
              <? 
                 $days = array('01', '02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17',
                    '18','19','20','21','22','23','24','25','26','27','28','29','30','31');
                 foreach ($days as $res) {
                     # code...?>
                    <option value="<?=$res?>"><?=$res?></option>
                    <?
                 }
                
                ?>
                </select>
                   - &nbsp;
                <select class="input-sm chosen-selec hid" name="month" style="width:100px;"  tabindex="2">
                 <? 
                 $Months = array('January'=>'01', 'February'=>'02','March'=>'03','April'=>'04','May'=>'05','June'=>'06','July'=>'07','August'=>'08','September'=>'09','October'=>'10','November'=>'11','December'=>'12');
                 foreach ($Months as $key => $res) {
                     # code...?>
                    <option value="<?=$res?>"><?=$key?></option>
                    <?
                 }
                
                ?>
                </select>
                   - &nbsp;
                <select class="input-sm chosen-selec hid" name="year" style="width:100px;"  tabindex="2">
                 <? 
                 $years = array('2016', '2017','2018','2019','2020','2021','2022','2023','2024','2025');
                 foreach ($years as $res) {
                     # code...?>
                    <option value="<?=$res?>"><?=$res?></option>
                    <?
                 }
                
                ?>
                </select>
                   - &nbsp;
                <select class="input-sm chosen-selec hid" name="hour" style="width:70px;"  tabindex="2">
               <? 
                 $hours = array('00','01', '02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17',
                    '18','19','20','21','22','23');
                 foreach ($hours as $res) {
                     # code...?>
                    <option value="<?=$res?>"><?=$res?></option>
                    <?
                 }
                
                ?>
                </select>
               : &nbsp;
                <select class="input-sm chosen-selec hid" name="minute" style="width:70px;"  tabindex="2">
                <? 
                 $minutes = array('00','05', '10','15','20','25','30','35','40','45','50','55');
                 foreach ($minutes as $res) {
                     # code...?>
                    <option value="<?=$res?>"><?=$res?></option>
                    <?
                 }
                
                ?>
                </select>
                </span>
               </div>
                
                <div class="hr-line-dashed"></div>

                
                
                
               
               
                <div>
                                        <input type='submit' name='save' class="btn-u btn btn-success col-sm-12" value="submit">
                                    </div>
                                </form>
                            </div>
                             <div class="col-sm-2"></div>
                        </div>
                    </div>
