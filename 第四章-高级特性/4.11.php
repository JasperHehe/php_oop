<?php
/** 
	4.11 定义对象的字符串值
 **/

/**
	当把对象传递给print或echo时，会自动调用这个方法，并用方法的返回值来替代默认的输出内容，__toString()方法应当返回一个字符串值。
	对于日志和错误报告,__toString()方法非常有用。__toString()也可以设计专门用来传递信息的类，比如Exception类可以把关于异常数据的总结信息写到__toString()方法中。
**/
class Person{
	function getName(){
		return "bob";
	}

	function getAge(){
		return 44;
	}

	function __toString(){
		$desc = $this->getName();
		$desc .= " (age ".$this->getAge().")";
		return $desc;
	}
}

$person = new Person();
print $person;