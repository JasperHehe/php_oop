<?php
/**
	4.7 final类和方法
**/
final class Checkout{

}

class IllegalCheckout extends Checkout{
	// 无法继承final类，致命报错
}

class Check{
	final function totalize(){

	}
}

// 可以继承
class IllegalCheck extends Check{
	// 无法覆写final方法，致命报错
	function totalize(){
		
	}
}