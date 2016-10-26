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

?>
<div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-3">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="file-manager">
                                <h5>Show:</h5>
                                <a href="?page=Hotels&action=ManageImageGallery&hotelid=<?=$_GET['hotelid']?>&folder=0" class="file-control active">All</a>
                                <div class="hr-line-dashed"></div>
                               <? 
							   if($_POST['save']){ 							   
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $k =  "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		$fname = basename( $_FILES["fileToUpload"]["name"]);
		 if(isset($_GET['roomId'])){
		echo $mHook->saveUploadPic($fname,$k,$_GET['folder'],$_GET['hotelid']);
		$lastId = $mHook->db->insert_id();
		$mHook->logRoomsImg($_GET['roomId'],$lastId,$_GET['hotelid']);	
		} else {
		echo $mHook->saveUploadPic($fname,$k,$_GET['folder'],$_GET['hotelid']);
		}
    } else {
        echo "Sorry, there was an error uploading your file.";
			}
		}
   }

if(isset($_GET['delete'])){
	echo $filename = $mHook-> returnFname($_GET['delete']);
	if(empty($filename)){ } else { 
	if(file_exists('../uploads/'.$filename)){
		//first return file name from id then unlink then delete from db
		$mHook->modDelete($_GET['delete'],'images');
		unlink('../uploads/'.$filename);
			} else {
		}
	}
	
?><div class="hr-line-dashed"></div><? } ?>
                                
                                <form action="" method="post" enctype="multipart/form-data">
                                <input type="file"  name="fileToUpload" id="fileToUpload"></br>
                                <input type="submit" value="Upload Image" name="save">
                                </form>
                                <div class="hr-line-dashed"></div>
                                <h5>Folders</h5>
                                <ul class="folder-list" style="padding: 0">
                                <?
								 $mHook->returnFolders()
								 
								 ?>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                         <? $mHook->ViewUploadImages($_GET['folder']) ?>  
                        </div>
                    </div>
                    </div>
                </div>
                </div>