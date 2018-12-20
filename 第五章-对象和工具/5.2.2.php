<?php
/**
	5.2类函数和对象函数
**/

/* 5.2.2 了解对象或类 */
class AbstractClass{

}

class ShopProduct extends AbstractClass{
	public function getShop(){

	}
}

class CdProduct extends ShopProduct{
	public $coverUrl = 'www.ss.com';
	private $name;

	function __construct(){

	}

	public function getPlayLength(){
		return "length is 2000";
	}

	function getSummaryLine($sum, $line){
		return "sum is {$sum} and line is {$line}";
	}

	private function getProducerFirstName(){
		return "function is getProducerFirstName";
	}

	function getDiscount(){
		return "function us getDiscount";
	}

	protected function setDiscount(){
		return "function is setDiscount";
	}
}

$product = getProduct();
if(get_class($product) == 'CdProduct'){
	print "\$product is a CdProduct object\n";
}

function getProduct(){
	return new CdProduct();
}

// instanceof 判断监测对象是否属于某个类
if($product instanceof ShopProduct){
	print "\$product is a ShopProduct object\n";
}


/* 5.2.3 了解类中的方法 */
// 只有声明为public的方法才会列出来
print_r(get_class_methods('CdProduct'));

$method = 'setDiscount';
// 一个方法存在并不意味着它可以被调用，private,protected和public方法，method_exists()都返回true
if(method_exists($product, $method)){
	echo "yes";
}


/* 5.2.4 了解类属性 */
// 只显示public属性
print_r(get_class_vars('CdProduct'));


/* 5.2.5 了解继承 */
// 返回父类名字，如果没有父类，返回false
var_dump(get_parent_class('CdProduct'));

// 使用is_subclass_of()函数监测类是否是另一个类的派生类，接收一个子类对象和父类的类名,如果第二个参数是第一个参数的父类，返回true。同样适用多级的父类
var_dump(is_subclass_of($product, 'AbstractClass'));


/* 5.2.6 方法调用 */
// call_user_function 调用方法或函数
$returnVal = call_user_func("getProduct");
var_dump($returnVal);

// call_user_func 调用类方法，需要一个数组，第一个元素是对象，第二个元素是方法名
$myObj = new CdProduct();
$returnVal1 = call_user_func(array($myObj, "getPlayLength"));
var_dump($returnVal1);

// 也可以传递参数给call_user_func
$returnVal2 = call_user_func(array($myObj, "getSummaryLine"), 'bigSum', 'bigLine');
var_dump($returnVal2);

// 使用call_user_func_array将所有参数合并到一个数组中
$returnVal3 = call_user_func_array(array($myObj, "getSummaryLine"), array('smallSum', 'smallLine'));
var_dump($returnVal3);