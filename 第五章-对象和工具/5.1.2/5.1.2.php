<?php
/**
	5.1.2 自动加载
**/

function __autoload($classname){
	if(preg_match('/\\\\/', $classname)){
		$path = str_replace('\\', DIRECTORY_SEPARATOR, $classname);
	}else{
		$path = str_replace('_', DIRECTORY_SEPARATOR, $classname);
	}	
	require_once("$path.php");
}

$y = new business_shopProduct();
$y->book();