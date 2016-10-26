<?php
    if(file_exists(HOOKS_INCLUDE_PATH.'hotel.php'))
    { 
            require HOOKS_INCLUDE_PATH.'hotel.php'; 
            $mHook = new HotelModuleHook;
    }
            else 
    {
         echo 'file '.HOOKS_INCLUDE_PATH.'hotel.php does not exist'; 
 }
if($_POST['save']){
    $freeze =0;
    $error ='';
    $pname = $_POST['pname'];
    $country = $_POST['country'];
    $ppernite = $_POST['ppernite'];
    $locale = $_POST['locale'];
    $mail = $_POST['email'];
    $phone = $_POST['phone'];
    $stuff = $mHook->db->mysql_escape_mimic($_POST['stuff']);
    if(empty($pname)){
    $freeze=1;
    }
    if(empty($locale)){
    $freeze=1;
    }
    if(empty($mail)){
    $freeze=1;
    }
    if(empty($phone)){
    $freeze=1;
    }
   }
   ?>
    <div class="ibox-content">
                        <div class="row">
                        <div class="col-sm-2"></div>

                            <div class="col-sm-8">
                            <div class="well">
                            <h4 class="m-t-none m-b">Send SMS</h4>
                            <code>Send SMS messages directly from your contacts and lists</code>
                            </div>
                <p><? if(isset($_POST['save'])){if($freeze==0){
         $res = $mHook->addHotel($pname,$locale,$mail,$phone,$stuff,$country,$ppernite);
         if(isset($res)){
            echo $res;
         }
}
   }
   ?>
</p>
                <form action="" method="post" role="form">
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                <label><?=$mHook->errorCheck($freeze,$pname,'From')?></label>
                <div class="input-group">
                <select data-placeholder="Choose a Country..." class="chosen-select" style="width:350px;" tabindex="2">
                <option value="">Select</option>
                <option value="United States">United States</option>
                <option value="United Kingdom">United Kingdom</option>
                </select>
                </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$locale,'To')?></label> 
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
                <select data-placeholder="Choose a Contact..." class="chosen-select" multiple style="width:inherit;" tabindex="8">
                <option value="">Select</option>
                <option value="United States">United States</option>
    </select>
    
                </div>

                 <div class="row">
                <div class="col-sm-12">
                <div class="hr-line-dashed"></div>
    <code>Select and add contacts and lists from your Contacts or simply enter their mobile numbers directly.</code></div>
                                </div>
               
                                </div>


                                <div id="tab-5" class="tab-pane">
                                    <form id="my-awesome-dropzone" class="dropzone dz-clickable" action="http://laravel.dev/inspinia/css">
                            <div class="dropzone-previews"></div>
                            <button type="submit" class="btn btn-primary pull-right">Submit this form!</button>
                        <div class="dz-default dz-message"><span>Drop files here to upload</span></div></form>
                                </div>
                               
                            </div>

                        </div>

                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$locale,'Message')?></label> 
                <input type="text" name="ppernite" value="<?=$mHook->freeze($freeze,$locale)?>"placeholder="Hotel Avarage Price per Night" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$locale,'Schedule')?></label> 
                <input type="text" name="locale" value="<?=$mHook->freeze($freeze,$locale)?>"placeholder="Hotel Location" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                
                
                
               
                <label>Brief Hotel Description</label> 
                <div class="col-lg-12">
                <div class="ibox float-e-margins">

                        <div class="summ">
                        <textarea name="stuff" class="summernote">
                        
                            <h3>Lorem Ipsum is simply</h3>
                            dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                            typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                            <br/>
                            <br/>
                            <ul>
                                <li>Remaining essentially unchanged</li>
                                <li>Make a type specimen book</li>
                                <li>Unknown printer</li>
                            </ul>
                            </textarea>
                        </div>

                    </div>
                </div>
                <div>
                                        <input type='submit' name='save' class="btn-u btn btn-success col-sm-12" value="submit">
                                    </div>
                                </form>
                            </div>
                             <div class="col-sm-2"></div>
                        </div>
                    </div>
