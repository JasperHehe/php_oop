<?php
/** 
	4.12 回调，匿名函数和闭包
**/

class Product{
	public $name;
	public $price;

	function __construct($name, $price){
		$this->name = $name;
		$this->price = $price;
	}
}

class ProcessSale{
	private $callbacks;

	function registerCallback($callback){
		if(!is_callable($callback)){
			throw new Exception("callback not callable");		
		}
		$this->callbacks[] = $callback;
	}

	function sale($product){
		print "{$product->name}: processing \n";
		foreach($this->callbacks as $callback){
			call_user_func($callback, $product);
		}
	}
}

/** 内联方式使用function关键字，没有函数名 **/

$logger = function($product){
	print "    logging ({$product->name}) \n";
}

$processor = new ProcessSale();
$processor->registerCallback($logger);
$processor->sale(new Product("shoes", 6));
print "\n";
$processor->sale(new Product("coffee", 6));



/***也可以使用函数名（甚至是对象引用和方法）作为回调***/

class Mailer{
	function doMail($product){
		print "    mailing ({$product->name})\n";
	}
}

$processor = new ProcessSale();
// is_callable 和 call_user_func都支持数组调用
$processor->registerCallback(array(new Mailer(), "doMail"));

$processor->sale(new Product("shoes", 6));
print "\n";
$processor->sale(new Product("coffee", 6));


/** 也可以让方法返回匿名函数 **/

class Totalizer{
	static function warnAmount(){
		return function($product){
			if($product->price > 5){
				print "   reached high price: {$product->price}\n";
			}
		}
	}
}

$processor = new ProcessSale();
$processor->registerCallback(Totalizer::warnAmount());



/** 利用闭包引用在其父作用域中声明的变量 **/

class Totalizer{
	static function warnAmount($amt){
		$count = 0;
		return function($product) use($amt, &$count){
			$count += $product->price;
			print "  count:$count \n";
			if($count > $amt){
				print "  high price reached:{$count}\n";
			}
		};
	}
}

$processor = new ProcessSale();
$processor->registerCallback(Totalizer::warnAmount(8));
$processor->sale(new Product("shoes", 6));
print "\n";
$processor->sale(new Product("coffee", 6));
