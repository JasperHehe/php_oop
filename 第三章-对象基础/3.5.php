<?php
/**
	3.5继承
**/
// 商品基类
class ShopProduct{
	private $title;
	private $producerMainName;
	private $producerFirstName;
	private $price;
	private $discount = 0;
	
	function __construct($title, $firstName, $mainName, $price){
		$this->title = $title;
		$this->producerFirstName = $firstName;
		$this->producerMainName = $mainName;
		$this->price = $price;
	}
	
	public function getProducerFirstName(){
		return $this->producerFirstName;
	}
	
	public function getProducerMainName(){
		return $this->producerMainName;
	}
	
	public function setDiscount($num){
		$this->discount = $num;
	}
	
	public function getDiscount(){
		return $this->discount;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function getPrice(){
		return ($this->price - $this->discount);
	}
	
	function getProducer(){
		return "{$this->producerFirstName}". "{$this->producerMainName}";
	}
	
	function getSummaryLine(){
		$base = "$this->title ({$this->producerMainName},";
		$base .= "{$this->producerFirstName})";
		return $base;
	}
}

// cd子类
class CdProduct extends ShopProduct{	
	private $playLength = 0;
	
	function __construct($title, $firstName, $mainName, $price, $playLength){
		// 引用父类的构造方法
		parent::__construct($title, $firstName, $mainName, $price);
		// 定义子类的属性
		$this->platLength = $playLength;		
	}
	
	function getPlayLength(){
		return $this->playLength;
	}
	
	function getSummaryLine(){
		// 引用父类的方法
		$base = parent::getSummaryLine();
		// 完成子类方法
		$base .= ":playing time - {$this->playLength}";
		return $base;
	}
}

// 书籍子类
class BookProduct extends ShopProduct{
	private $numberPages = 0;
	
	function __constrcut($title, $firstName, $mainName, $price, $numberPages){
		// 引用父类的构造方法
		parent::__construct($title, $firstName, $mainName, $price);
		// 定义子类的属性
		$this->numberPages = $numberPages;
	}
	
	function getNumberOfPages(){
		return $this->numberPages;
	}
	
	function getSummaryLine(){
		// 引用父类方法
		$base = parent::getSummaryLine();
		// 完成子类方法
		$base .= ":page count - {$this->numberPages}";
		return $base;
	}
}

class ShopProductWriter{
	private $products = array();
	
	public function addProduct(ShopProduct $shopProduct){
		$this->products[] = $shopProduct;
	}
	
	public function Write(){
		$str = "";
		foreach($this->products as $product){
			$str .= "{$product->title}: ";
			$str .= $product->getProducer();
			$str .= " ({$product->getPrice()}) \n";
		}
		print $str;
	}

}