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
		 $res = $mHook->EditRoom($rname,$ppernite,$norooms,$maxg,$stuff,$_GET['roomId']);
		 if(isset($res)){
			echo $res;
		 }
}
   }
   ?>
</p>
                <form action="" method="post" role="form">
                <div class="hr-line-dashed"></div>
		<? $mHook->editR($_GET['roomId']) ?>
                <div>
                                        <input type='submit' name='save' class="btn-u btn btn-success col-sm-12" value="submit">
                                    </div>
                                </form>
                            </div>
