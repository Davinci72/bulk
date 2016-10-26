<?php
class HotelModuleHook {
	var $db;
	public function __construct(){
		$this->db=$this->returnDb();	
	}
	public function returnDb(){
		return new MySQLDatabase;	
	}
	public function freeze($freeze,$var){
		if($freeze > 0 ){ return $var;} else {
			return '';	
		}
	}
	public function errorCheck($freeze,$var,$label){
		if($freeze > 0 ){
			if(empty($var)){
				return '<div style="padding:10px;"><span class="label label-danger error-h" data-dismiss="alert">The field *'.$label.' must not be empty</span></div>';
					} else {
						return $label;	
					}
				} else {
				return $label;	
		}
 	}
	public function Moderror($error){
		$this->db->pushError($error);	
}
	public function modDelete($id,$table){
	
	$sql="DELETE FROM ".$table." WHERE id=".$id;
	$result = $this->db->query($sql);
	return $this->Moderror('<div style="padding:10px;"><span class="label label-danger error-h" data-dismiss="alert">Deleted This Action Can Not Be Undone!!</span></div>');
	}
	public function returnFname($id){
		$sql='SELECT * FROM images WHERE id='.$id.'';
							$emp_det = $this->db->query($sql);
							$num = $this->db->num_rows($emp_det);
							if($num===0){
							$this->db->pushError('');	
							}else {
								while($row = $this->db->fetch_array($emp_det)){
								return $id = $row['imgdir'];
								}
							}
	}
	public function addHotel($pname,$locale,$mail,$phone,$stuff,$country,$ppernite){
	$sql="INSERT INTO hotels (id,hname,locale,mail,phone,description,country,ppernite,date_aded) VALUES ('','$pname','$locale','$mail','$phone','$stuff','$country','$ppernite',now())";
	$result = $this->db->query($sql);
	return $this->Moderror('<div style="padding:10px;"><span class="label label-success error-h" data-dismiss="alert">Hotel Created!!</span></div>');
	}
	public function ViewUploadImages($folder){
		if(isset($_GET['main'])){
			$this->updateField('hotels','img',$_GET['main'],$_GET['hotelid']);
		}
							$sql = $this->DetermineFolder($folder);
							//var_dump($sql);
							$emp_det = $this->db->query($sql);
							$num = $this->db->num_rows($emp_det);
							if($num===0){
							$this->db->pushError('<div style="padding:10px;"><span class="label label-danger" style="font-size:14px;">No Images In  Current Folder!!</span></br></div>');	
							}else {
								while($row = $this->db->fetch_array($emp_det)){
								$id = $row['id'];
								$img = $row['imgdir'];	
								?>
	 <div class="file-box">
        <div class="file">
                <span class="corner"></span>
                <div class="image">
                    <img alt="image" class="img-responsive" src="../uploads/<?=$img?>">
                </div>
                <div class="file-name">
                    <?=$img?>
                    <br/>
                    <small>Added: <?=$row['tarehe']?></small>
                    <div><a href="?page=Hotels&action=ManageImageGallery&hotelid=<?=$row['hotelid']?>&folder=<?=$_GET['folder']?>&delete=<?=$id?>">Delete</a> | <a href="?page=Hotels&action=ManageImageGallery&hotelid=<?=$row['hotelid']?>&folder=<?=$_GET['folder']?>&main=<?=$id?>">Make Main  Image</a></div>
                </div>
        </div>
    </div>
		<?
            }
        }
            
	}
	public function updateField($table,$field,$value,$where){
		$sql='UPDATE '.$table.' SET '.$field.' = '.$value.' WHERE id ='.$where.'';
		$emp_det = $this->db->query($sql);
		$this->db->pushError('<div style="padding:10px;"><span class="label label-success" style="font-size:14px;">Image SET Main</span></br></div>');	

	}
	public function DetermineFolder($folder){
	if($folder==='0'){
		return 'SELECT * FROM images WHERE hotelid="'.$_GET['hotelid'].'"';	
		} else {
		return 'SELECT * FROM images WHERE folder='.$folder.' AND hotelid='.$_GET['hotelid'];
		}	
	}
	public function saveUploadPic($fname,$k,$folder,$hotelID){
		$sql="INSERT INTO images (id,imgdir,hotelid,uid,tarehe,folder) VALUES ('','$fname','$hotelID','1',now(),$folder)";
	$result = $this->db->query($sql);
	return $this->Moderror('<div style="padding:10px;"><span class="label label-success error-h" data-dismiss="alert">File Uploaded!! '.$k.'</span></div>');	
	} 
	public function returnFolders(){
	$sql='SELECT * FROM imgfolders';
	$emp_det = $this->db->query($sql);
	$num = $this->db->num_rows($emp_det);
	if($num===0){
	$this->db->pushError('<div style="padding:10px;"><span class="label label-danger">NO Folders!!</span></br></div>');	
	}else {
		while($row = $this->db->fetch_array($emp_det)){
?><li><a href="?page=Hotels&action=ManageImageGallery&hotelid=<?=$_GET['hotelid']?>&folder=<?=$row['id']?>"><i class="fa fa-folder<?=$this->returnFolderStatus($_GET['folder'],$row['id'])?>"></i> <?=$row['foldername']?></a></li><?
	
			}
		}
	}
	public function returnFolderStatus($d,$r){
	if($d==$r){
		return '-open-o';
			} else {
			
		}
	}
	public function EditH($hotelId){
	$sql='SELECT * FROM hotels WHERE id='.$hotelId;
	$emp_det = $this->db->query($sql);
	$num = $this->db->num_rows($emp_det);
	if($num===0){
	$this->db->pushError('<div style="padding:10px;"><span class="label label-danger">No Hotels!!</span></br></div>');	
	}else {
		while($row = $this->db->fetch_array($emp_det)){
		?>
                        <label><?=$this->errorCheck($freeze,$pname,'Property Name')?></label> 
                <input type="text" placeholder="Enter email" name="pname" value="<?=$row['hname']?>" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$this->errorCheck($freeze,$locale,'Hotel Country')?></label> 
                <input type="text" name="country" value="<?=$row['country']?>"placeholder="Hotel Country Location" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$this->errorCheck($freeze,$locale,'Hotel Avg Price Per Night')?></label> 
                <input type="text" name="pper" value="<?=$row['ppernite']?>"placeholder="Hotel Avarage Price per Night" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$this->errorCheck($freeze,$locale,'Hotel Location')?></label> 
                <input type="text" name="locale" value="<?=$row['locale']?>"placeholder="Hotel Location" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$this->errorCheck($freeze,$mail,'Email')?></label> 
                <input type="text" name="email" value="<?=$row['mail']?>" placeholder="Email" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$this->errorCheck($freeze,$phone,'Phone')?></label> 
                <input type="text" name="phone" value="<?=$row['phone']?>" placeholder="Phone" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <label>Brief Hotel Description</label> 
                <div class="col-lg-12">
                <div class="ibox float-e-margins">

                        <div class="summ">
                        <textarea name="stuff" class="summernote">
                        <?=$row['description']?>
                            </textarea>
                        </div>

        <?
			}
		}
	}
	public function editR($id){
		$sql='SELECT * FROM rooms WHERE id='.$id;
	$emp_det = $this->db->query($sql);
	$num = $this->db->num_rows($emp_det);
	if($num===0){
	$this->db->pushError('<div style="padding:10px;"><span class="label label-danger">NO Folders!!</span></br></div>');	
	}else {
		while($row = $this->db->fetch_array($emp_det)){
		?>
        <div class="form-group">
<label><?=$this->errorCheck($freeze,$rname,'Room Name')?></label> 
<input type="text" placeholder="Enter Room Name" name="rname" value="<?=$row['roomname']?>" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$this->errorCheck($freeze,$ppernite,'Price Per Night')?></label> 
                <input type="text" name="ppernite" value="<?=$row['ppernite']?>" placeholder="Price Per Night" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$this->errorCheck($freeze,$norooms,'No Of Rooms')?></label> 
                <input type="text" name="norooms" value="<?=$row['norooms']?>" placeholder="No Of Rooms" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label><?=$this->errorCheck($freeze,$maxg,'Maximum guests')?></label> 
                <input type="text" name="mxag" value="<?=$row['maxguests']?>" placeholder="Maximum guests" class="form-control"></div>
                <div class="hr-line-dashed"></div>
                <label>Brief Room Description</label> 
                <div class="col-lg-12">
                <div class="ibox float-e-margins">

                        <div class="summ">
                        <textarea name="stuff" class="summernote">
                        
                            <?=$row['roomdesc']?>
                            </textarea>
                        </div>

                    </div>
                </div>

        <?
			}
		}
	}
	public function EditHotelInfo($pname,$locale,$mail,$phone,$stuff,$country,$ppernite,$hotelId){
	$sql = 'UPDATE hotels SET hname ="'.$pname.'", locale="'.$locale.'", mail="'.$mail.'", phone="'.$phone.'", description="'.$stuff.'", country="'.$country.'", ppernite="'.$ppernite.'", date_aded=now() WHERE id='.$hotelId.'' ;	
	$emp_det = $this->db->query($sql);
	$this->Moderror('<div style="padding:10px;"><span class="label label-success" style="font-size:14px;">Hotel Updated</span></br></div>');
	}
	public function newRoom($rname,$ppernite,$norooms,$maxg,$stuff){
		$sql="INSERT INTO rooms (id,hotel_id,roomname,ppernite,norooms,maxguests,roomdesc,img)
		 VALUES ('','".HOTEL_USER_ID."','$rname','$ppernite','$norooms','$maxg','$stuff','')";
	$result = $this->db->query($sql);
	return $this->Moderror('<div style="padding:10px;"><span class="label label-success error-h" data-dismiss="alert">Hotel Created!!</span></div>');
	}
	public function EditRoom($rname,$ppernite,$norooms,$maxg,$stuff,$id){
	$sql = 'UPDATE rooms SET roomname ="'.$rname.'", ppernite="'.$ppernite.'", norooms="'.$norooms.'", maxguests="'.$maxg.'", roomdesc="'.$stuff.'" WHERE id='.$id.'' ;	
	$emp_det = $this->db->query($sql);
	$this->Moderror('<div style="padding:10px;"><span class="label label-success" style="font-size:14px;">Room Updated</span></br></div>');	
	}
	public function logRoomsImg($room,$img,$hotel){
	$sql="INSERT INTO roomsgalery (id,room,image,hotelid)
		 VALUES ('','$room','$img','$hotel')";
	$result = $this->db->query($sql);
	return $this->Moderror('<div style="padding:10px;"><span class="label label-success error-h" data-dismiss="alert">Rooms Image Created!!</span></div>');	
	}
}








