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
	$rname = $_POST['rname'];
	$ppernite = $_POST['ppernite'];
	$norooms = $_POST['norooms'];
	$maxg = $_POST['mxag'];
	$stuff = $mHook->db->mysql_escape_mimic($_POST['stuff']);
	if(empty($rname)){
	$freeze=1;
	}
	if(empty($ppernite)){
	$freeze=1;
	}
	if(empty($maxg)){
	$freeze=1;
	}
   }
   ?>
    <div class="ibox-content ">
                        <div class="row">
                            <div class="col-sm-4"><h3 class="m-t-none m-b">Add New Room Type</h3>
                <p><? if(isset($_POST['save'])){if($freeze==0){
		 $res = $mHook->newRoom($rname,$ppernite,$norooms,$maxg,$stuff);
		 if(isset($res)){
			echo $res;
		 }
}
   }
   ?>
</p>
                <form action="" method="post" role="form">
                <div class="hr-line-dashed"></div>
<div class="form-group"><label><?=$mHook->errorCheck($freeze,$rname,'Room Name')?></label> 
<input type="text" placeholder="Enter Room Name" name="rname" value="<?=$mHook->freeze($freeze,$rname)?>" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$ppernite,'Price Per Night')?></label> 
                <input type="text" name="ppernite" value="<?=$mHook->freeze($freeze,$ppernite)?>" placeholder="Price Per Night" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$norooms,'No Of Rooms')?></label> 
                <input type="text" name="norooms" value="<?=$mHook->freeze($freeze,$norooms)?>" placeholder="No Of Rooms" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$mHook->errorCheck($freeze,$maxg,'Maximum guests')?></label> 
                <input type="text" name="mxag" value="<?=$mHook->freeze($freeze,$maxg)?>" placeholder="Maximum guests" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <label>Brief Room Description</label> 
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
