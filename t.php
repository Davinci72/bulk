<?
$c = array('Group , 2');
// handleContacts($c);
//print_r($result_explode);
function handledExplode($r){
	print_r($r);
foreach ($r as $key => $value) {
	# code...
	echo $key.'</br>';
	}
}
function handleContacts($contacts){
foreach ($contacts as $value) {
	# code...
	 $result_explode = explode(',', $value);
	 //handledExplode($result_explode);
	// print_r($result_explode);
	 $identifier = $result_explode[0];
	 $id = $result_explode[1];
	 $final = array($identifier=>$id);
	 handledExplode($final);
	 //print_r($final);
	}
}
//handledExplode($r);
phpinfo();