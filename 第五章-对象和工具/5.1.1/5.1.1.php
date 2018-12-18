<?php
/**
	5.1.1 PHP包和命名空间
**/

/** 行命名空间 **/

namespace com\getinstance\util;
require_once 'global.php';
class Lister{
	public static function helloWorld(){
		print "hello from ".__NAMESPACE__."\n";
	}
}

Lister::helloWorld();  // 访问本地
\Lister::helloWorld();  // 访问全局空间


/** 使用命名空间关键字加大括号，在同一个文件中声明多个命名空间 **/
// 不能在同一个文件中同时使用大括号命名空间和行命名空间，必须选择其中一种，并且在整个文件中坚持使用

namespace com\getinstance\util{
	class Debug{
		static function helloWorld(){
			print "hello from Debug\n";
		}
	}
}

namespace main{
	\com\getinstance\util\Debug::helloWorld();
}