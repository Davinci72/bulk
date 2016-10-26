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
                            <div class="col-sm-12"><h3 class="m-t-none m-b">Add New Hotel</h3>
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
<div class="form-group"><label><?=$mHook->errorCheck($freeze,$pname,'Property Name')?></label> 
<input type="text" placeholder="Enter email" name="pname" value="<?=$mHook->freeze($freeze,$pname)?>" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$locale,'Hotel Country')?></label> 
                <input type="text" name="country" value="<?=$mHook->freeze($freeze,$locale)?>"placeholder="Hotel Country Location" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$locale,'Hotel Avg Price Per Night')?></label> 
                <input type="text" name="ppernite" value="<?=$mHook->freeze($freeze,$locale)?>"placeholder="Hotel Avarage Price per Night" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$locale,'Hotel Location')?></label> 
                <input type="text" name="locale" value="<?=$mHook->freeze($freeze,$locale)?>"placeholder="Hotel Location" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$mail,'Email')?></label> 
                <input type="text" name="email" value="<?=$mHook->freeze($freeze,$mail)?>" placeholder="Email" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$phone,'Phone')?></label> 
                <input type="text" name="phone" value="<?=$mHook->freeze($freeze,$phone)?>" placeholder="Phone" class="form-control"></div>
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
                        </div>
                    </div>
