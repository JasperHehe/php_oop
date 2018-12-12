<?php
/**
	4.3抽象类
**/
class ShopProduct{
	
	function __construct()
	{

	}
}

// 抽象类，不能单独实例化，只可以被继承
abstract class ShopProductWriter{
	protected $products = array();
	
	public function addProduct(ShopProduct $shopProduct){
		$this->products[] = $shopProduct;
	}

	// 抽象类必须包含至少一个抽象方法，抽象方法不能有具体内容
	abstract public function write();
}

class test extends ShopProductWriter{
	// 抽象类的每个子类必须实现抽象类中的所有抽象方法
	public function write(){
		echo 222;
	}
}


$a = new test();
var_dump($a);