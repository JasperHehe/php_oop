<?php
/**
	4.8 使用拦截器
	__get($property)    访问未定义的属性时被调用
	__set($property, $value)  给未定义的属性赋值时被调用
	__isset($property)    对未定义的属性调用isset()时被调用
	__unset($property)   对未定义的属性调用unset()时被调用
	__call($method, $arg_array)   调用未定义的方法时被调用
**/

// 拦截器 __get
class Person{
	function __get($property){
		$method = "get{$property}";
		if(method_exists($this, $method)){
			return $this->$method();
		}			
	}

	function getName(){
		return "Bob";
	}

	function getAge(){
		return 44;
	}
}

$p = new Person();
// 访问未定义的属性，__get被调用，找到getName，返回
print $p->name;
// 访问未定义的属性，__get被调用，没有找到getGender,没有返回
print $p->gender;

// 拦截器 __set
class Person1{
	private $_name;
	private $_age;

	function __set($property, $value){
		$method = "set{$property}";
		if(method_exists($this, $method)){
			return $this->$method($value);
		}
	}

	function setName($name){
		$this->_name = $name;

		if(!is_null($name)){
			$this->_name = strtoupper($this->_name);
		}
	}

	function setAge($age){
		$this->_age = strtoupper($age);
	}
}

$p = new Person1();
$p->name = "bob";
