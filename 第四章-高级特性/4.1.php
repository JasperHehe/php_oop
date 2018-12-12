<?php
/**
	4.1静态方法和属性
**/
class StaticExample{
	static public $aNum = 0;
	
	static public function sayHello(){
		self::$aNum++;
		print "hello (" . self::$aNum . ") \n";
	}
}

// 静态方法是以类为作用域的函数
StaticExample::sayHello();