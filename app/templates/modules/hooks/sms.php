<?php
class SmsModuleHook {
	var $db;
	var $senderId;
	var $message;
	var $sendTime;
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
	public function groupsList(){
		$sql='SELECT * FROM contacts_group WHERE apikey='.$_SESSION['SESS_MEMBER_ID'];
$emp_det = $this->db->query($sql);
$num = $this->db->num_rows($emp_det);
if($num ===0){
?><option value="">No Groups</option><? 
}else {
    while($row = $this->db->fetch_array($emp_det)){
        ?>
    <option value="<?=$row['ID']?>"><?=$row['group_name']?></option>
    <?
        }  
    }
	}
	public function OtherErrorCheck($freeze,$value){
		if($freeze > 0 ){ if(empty($value)) { echo 'This Field Is empty'; } }
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
 	public function errorCheckStatus($freeze,$var){
		if($freeze > 0 ){
			if(empty($var)){
				return 'error';
					} else {
						return 'success';	
					}

				}
				else {
						return 'success';
					}
 	}
	public function Moderror($error){
		$this->db->pushError($error);	
}
	public function modDelete($id,$table){
	
	$sql="DELETE FROM ".$table." WHERE ID =".$id;
	$result = $this->db->query($sql);
	return $this->Moderror('<div style="padding:10px;"><span class="label label-danger error-h" data-dismiss="alert">Deleted !!</span></div>');
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
public function handledExplode($r){
	//print_r($r);
foreach ($r as $key => $value) {
	# code...
	$this->Contactsparser($key,$value);
	}
}
public function returnPhone($id){
$sql='SELECT * FROM contacts WHERE ID ='.$id.'';
							$emp_det = $this->db->query($sql);
							$num = $this->db->num_rows($emp_det);
							if($num===0){
							//$this->db->pushError('');	
							}else {
								while($row = $this->db->fetch_array($emp_det)){
								return $id = $row['phone'];
								}
							}
}
public function returnFirstname($id){
$sql='SELECT * FROM contacts WHERE ID ='.$id;
							$emp_det = $this->db->query($sql);
							$num = $this->db->num_rows($emp_det);
							if($num===0){
							//$this->db->pushError('');	
							}else {
								while($row = $this->db->fetch_array($emp_det)){
								return $id = $row['f_name'];
								}
							}
}
public function returnlname($id){
$sql='SELECT * FROM contacts WHERE ID ='.$id.'';
							$emp_det = $this->db->query($sql);
							$num = $this->db->num_rows($emp_det);
							if($num===0){
							//$this->db->pushError('');	
							}else {
								while($row = $this->db->fetch_array($emp_det)){
								return $id = $row['l_name'];
								}
							}
}
public function returnOname($id){
$sql='SELECT * FROM contacts WHERE ID ='.$id.'';
$emp_det = $this->db->query($sql);
$num = $this->db->num_rows($emp_det);
if($num===0){
//$this->db->pushError('');	
	} else {
	while($row = $this->db->fetch_array($emp_det)){
	return $id = $row['other_name'];
			}
		}
}
public function EditContact($phone,$fname,$lname,$oname,$group,$where){
$sql='UPDATE contacts SET phone = "'.$phone.'", f_name ="'.$fname.'", l_name ="'.$lname.'", other_name = "'.$oname.'", group_id = "'.$group.'" WHERE ID ='.$where.'';
//svar_dump($sql);
		$emp_det = $this->db->query($sql);
		//if(isset($em_det)){
			return 'Contact Updated';
		//}
}
public function handleContacts($contacts){
foreach ($contacts as $value) {
	# code...
	 $result_explode = explode(',', $value);
	 //handledExplode($result_explode);
	// print_r($result_explode);
	 $identifier = $result_explode[0];
	 $id = $result_explode[1];
	 $final = array($identifier=>$id);
	 $this->handledExplode($final);
	 //print_r($final);
	}
}
public function loadCsvFile($file,$senderid,$message,$ft){
	$csv = array_map('str_getcsv', file($file));
    array_walk($csv, function(&$a) use ($csv) {
      $a = array_combine($csv[0], $a);
    });
    array_shift($csv); # remove column header
    foreach($csv as $res){
      $fname = $res['fname'];
      $lname = $res['lname'];
      $phone = $res['contact'];
      $email = $res['email'];
      //load the contacts in a nice table
      //$this->smslogger($phone,$message,$ft,$senderid);
      //$sql="INSERT INTO temp_csv (fname,lname,phone,email) VALUES ('$fname','$lname','$phone','$email')";
      $sql = "INSERT INTO contacts (phone,f_name,l_name,other_name,group_id,apikey) VALUES('$phone','$fname','$lname','na','1','1')";
	  $result = $this->db->query($sql);
    }
    //echo 'Contacts Loaded';
    unlink($file);
}
public function registerSenderId($sender,$purpose){
$sql="INSERT INTO sender_id (sender_id,purpose,date) VALUES ('$sender','$purpose',now())";
$result = $this->db->query($sql);
return 'Sender ID Aded';	
}
public function Contactsparser($g,$id){
	switch ($g) {
		case 'Group':
			# code...
		$this->groupsContacts($id);
		break;
		case 'Single':
			# code...
		$this->SingleContacts($id);
		break;
		
	default:
			# code...
		break;
	}
}
	public function returnSenderID(){
		$sql='SELECT * FROM alphanumerics';
		$emp_det = $this->db->query($sql);
		$num = $this->db->num_rows($emp_det);
		//var_dump($num);
		if($num===0){
					
		?><option value="">No Sender ID</option><?	
		} else {
		while($row = $this->db->fetch_array($emp_det)){
			$id = $row['ID'];
			$sender = $row['sender_id'];
			?><option value="<?=$sender?>"><?=$sender?></option><?
			}
		}
	}
	public function groupsContacts($id){
		$sql = 'SELECT * FROM contacts 	WHERE group_ID ='.$id;
		$q = $this->db->query($sql);
		$num = $this->db->num_rows($q);
		$group = $this->ReturnGroupName($id);
		if($num==0){
			$this->Moderror('The group '.$group.' Does Not Contain Any Contacts');
		} else {
			while($row = $this->db->fetch_array($q)){
//log smses for sending
				$phone = $row['phone'];
				$this->smslogger($phone,$this->message,$this->sendTime,$this->senderId);
			}
			//$this->ModeSuccess('SMS Logged For Sending');
		}
	}

	public function SingleContacts($id){
		$sql = 'SELECT * FROM contacts 	WHERE ID ="'.$id.'"';
		$q = $this->db->query($sql);
		$num = $this->db->num_rows($q);
		if($num==0){
			$this->Moderror('The group '.$id.' Does Not Contain Any Contacts');
		} else {
			while($row = $this->db->fetch_array($q)){
				//log smses for sending
				$phone = $row['phone'];
				$this->message;
				$this->smslogger($phone,$this->message,$this->sendTime,$this->senderId);
			}
			//$this->ModeSuccess('SMS Logged For Sending');
		}
	}
	public function smslogger($phone,$message,$time,$senderId){
		// $sql = 'INSERT INTO sms_out (id,client_id,msisdn,sender_id,out_date,callback_uri,delivery_status,flag)
		// 	 VALUES ("","'.$this->apikey.'","'.$phone.'","'.$senderId.'","'.$time.'","'.$this->callback.'","","0")';
		// 	 $q = $this->db->query($sql);

			$sql="insert into GENERATIONS.dbo.ozekimessageout (sender,receiver,msg,msgtype,status,flag,scheduledtime) 
					                        values ('".$senderId."','".$phone."','".$message."','SMS:TEXT','Send','1','".$time."')";
			$q = $this->db->query($sql);
	}
	public function ContactsGroups(){
		$sql='SELECT * FROM contacts_group WHERE apikey='.$_SESSION['SESS_MEMBER_ID'];
		$emp_det = $this->db->query($sql);
		$num = $this->db->num_rows($emp_det);
		if($num===0){
					
		?><option value="">No Existing Groups</option><?	
		} else {
		while($row = $this->db->fetch_array($emp_det)){
			$id = $row['ID'];
			$groupname = $row['group_name'];
			?><option value="<?='Group,'.$id; ?>"><?=$groupname?></option><?
			}
		}
	}
	public function ReturnGroupName($id){
		$sql='SELECT * FROM contacts_group WHERE ID ='.$id;
		$emp_det = $this->db->query($sql);
		$num = $this->db->num_rows($emp_det);
		if($num===0){
				
		} else {
		while($row = $this->db->fetch_array($emp_det)){
			return $groupname = $row['group'];
			}
		}
	}
	public function ContactsSingle(){
		$sql='SELECT * FROM contacts WHERE apikey='.$_SESSION['SESS_MEMBER_ID'];
		$emp_det = $this->db->query($sql);
		$num = $this->db->num_rows($emp_det);
		if($num===0){
					
		?><option value="">No Existing Contacts</option><?	
		} else {
		while($row = $this->db->fetch_array($emp_det)){
			$id = $row['ID'];
			$groupname = $row['phone'];
			?><option value="<?='Single,'.$id; ?>"><?=$groupname?></option><?
			}
		}
	}
	public function addNewContact($phone,$fname,$lname,$oname,$group){
	$sql="INSERT INTO contacts (phone,f_name,l_name,other_name,group_id,apikey) 
						VALUES ('$phone','$fname','$lname','$oname','$group','1')";
	$result = $this->db->query($sql);
	return 'Contact Created!!';
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
	public function getGroups(){
	$sql='SELECT * FROM contacts_group WHERE apikey='.$_SESSION['SESS_MEMBER_ID'];
	$emp_det = $this->db->query($sql);
	$num = $this->db->num_rows($emp_det);
	if($num===0){
	$this->db->pushError('<div style="padding:10px;"><span class="label label-danger">NO GROUPS!!</span></br></div>');	
	}else {
		while($row = $this->db->fetch_array($emp_det)){ ?>
		<li class="list-group-item"><a  href="?page=sms&action=contacts&group=<?=$row['ID']?>"> <i class="fa fa-folder<?=$this->returnFolderStatus($row['ID'],$_GET['group'])?>"></i>  <?=$row['group_name']?></a>  &nbsp;<a data-toggle="modal" data-target="#myModalc" href='#'><i class="fa fa-edit"></i></a> |&nbsp;<a href='?page=sms&action=contacts&deleteGroup=<?=$row['ID']?>'> <i class="fa fa-trash"></i> </a></li>

		<?
	}

}
	}
	public function groupDelete($id){

		//check to see if group has contacts if it does then update their group to null
		$this->groupChecker($id);
		//return success message
	}
	public function groupChecker($id){
	$sql='SELECT * FROM contacts WHERE group_id='.$id.' AND apikey='.$_SESSION['SESS_MEMBER_ID'];
	$emp_det = $this->db->query($sql);
	$num = $this->db->num_rows($emp_det);
	if($num===0){
	//$this->db->pushError('<div style="padding:10px;"><span class="label label-danger">No Hotels!!</span></br></div>');	
	} else {
		while($row = $this->db->fetch_array($emp_det)){
		$sql = 'UPDATE contacts SET group_id=0 WHERE group_id='.$id.' AND apikey='.$_SESSION['SESS_MEMBER_ID'];
		$emp_det = $this->db->query($sql);
				}
			
			}
		$this->modDelete($id,'contacts_group');
	}
	public function EditH($hotelId){
	$sql='SELECT * FROM hotels WHERE id='.$hotelId;
	$emp_det = $this->db->query($sql);
	$num = $this->db->num_rows($emp_det);
	if($num===0){
	$this->db->pushError('<div style="padding:10px;"><span class="label label-danger">No Hotels!!</span></br></div>');	
	}else {
		while($row = $this->db->fetch_array($emp_det)){
		
			}
		}
	}
	
	public function LogSms($senderid,$message,$time){
		$this->senderId=$senderid;
		$this->message=$message;
		$this->sendTime=$time;
	}
	public function EditHotelInfo($pname,$locale,$mail,$phone,$stuff,$country,$ppernite,$hotelId){
	$sql = 'UPDATE hotels SET hname ="'.$pname.'", locale="'.$locale.'", mail="'.$mail.'", phone="'.$phone.'", description="'.$stuff.'", country="'.$country.'", ppernite="'.$ppernite.'", date_aded=now() WHERE id='.$hotelId.'' ;	
	$emp_det = $this->db->query($sql);
	$this->Moderror('<div style="padding:10px;"><span class="label label-success" style="font-size:14px;">Hotel Updated</span></br></div>');
	}
	public function ModeSuccess($msg){
		echo '<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                               <span class="label label-success" style="font-size:14px;">'.$msg.'</span>
                            </div>';
		//echo '<div style="padding:10px;"><span class="label label-success" style="font-size:14px;">'.$msg.'</span></br></div>';
	}
	public function newRoom($rname,$ppernite,$norooms,$maxg,$stuff){
		$sql="INSERT INTO rooms (id,hotel_id,roomname,ppernite,norooms,maxguests,roomdesc,img)
		 VALUES ('','".HOTEL_USER_ID."','$rname','$ppernite','$norooms','$maxg','$stuff','')";
	$result = $this->db->query($sql);
	return $this->Moderror('<div style="padding:10px;"><span class="label label-success error-h" data-dismiss="alert">Hotel Created!!</span></div>');
	}
	public function createGroup($group){
	$sql="INSERT INTO contacts_group (group_name,apikey)
		 VALUES ('$group','".HOTEL_USER_ID."')";
	$result = $this->db->query($sql);	
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








