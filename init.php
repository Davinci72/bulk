<?php
$p = $_GET['page'];
$action = $_GET['action'];
$vars = $_GET['hotelId'];
if(empty($p)){ } else {
	
$page = new page($p,$action,$vars);

}
