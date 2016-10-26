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
	$ppernite = $_POST['pper'];
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
</div>
    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12"><h3 class="m-t-none m-b">Edit Hotel</h3>
                <p><? if(isset($_POST['save'])){if($freeze==0){
		 $res = $mHook->EditHotelInfo($pname,$locale,$mail,$phone,$stuff,$country,$ppernite,$_GET['hotelId']);
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
<? $mHook->EditH($_GET['hotelId']) ?>
                    </div>
                </div>
                <div>
                                        <input type='submit' name='save' class="btn-u btn btn-success col-sm-12" value="Edit Hotel">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
