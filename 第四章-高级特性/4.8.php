<?php
/**
	4.8 使用拦截器
	__get($property)    访问未定义的属性时被调用
	__set($property, $value)  给未定义的属性赋值时被调用
	__isset($property)    对未定义的属性调用isset()时被调用
	__unset($property)   对未定义的属性调用unset()时被调用
	__call($method, $arg_array)   调用未定义的方法时被调用
**/

/*** 拦截器 __get ***/
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


/*** 拦截器 __set ***/

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
	
	function getName(){
		return $this->_name;
	}
}

$p = new Person1();
// $name属性不存在，触发__set方法，设置$_name属性
$p->name = "Lily";
var_dump($p->getName());


/** 拦截器__call **/

class PersonWriter{
	function writeNmae(Person $p){
		print $p->getName(). "\n";
	}

	function writeAge(Person $p){
		print $p->getAge(). "\n";
	}
}

class Person{
	private $writer;

	function __construct(PersonWriter $writer){
		$this->writer = $writer;
	}

	function __call($methodname, $args){
		if(method_exists($this->writer, $methodname)){
			return $this->writer->$methodname($this);
		}
	}

	function getName(){
		return "Bob";
	}

	function getAge(){
		return 44;
	}
}

$person = new Person();
$person->writeNmae();

// __call()方法会被调用，然后会在PersonWriter对象中writeName()方法，并调用之
// 这样我们就可以不用手动在Person类中调用如下委托方法:
/*
	function writeName(){
		$tis->writer->writeName($this);
	}
*/
// 如果我们需要委托很多方法的处理，那么慢这样的自动委托可以节省很多时间，但代码也会有点不太清晰。
// 类与被委托类之间的交互比较模糊，用__call()来调用，而不是显示的继承关系或者参数类型提示。
// 拦截器方法使用时要慎重考虑，最好附上文档，清楚的说明代码的细节