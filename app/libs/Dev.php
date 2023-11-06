<?php 

ini_set('display_errors', 1);
error_reporting(E_ALL);

function debug($str){
	echo "<pre>";
	var_dump($str);
	echo "</pre>";
	exit;
}

function errorLogs($text){
	$myfile = fopen("error_logs.txt", "a");
		fwrite($myfile, $text.' - '.date("Y-M-D-H:i:s")."\n");
	fclose($myfile);
}
function redirect($url){
	header("location: ".$url);
	exit;
}