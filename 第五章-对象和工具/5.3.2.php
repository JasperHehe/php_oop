<?php
/**
	5.3.2 开始行动
**/

class Test{
	const SUM_NUM = 100;
	
	public static $a = 'lily';
	protected $b = 'sam';
	private $c = 'lulu';
	
	public function create(){
		echo self::$a;
	}
	
	protected function set($name){
		$this->b = $name;
	}

	private function get(){
		echo $this->b;
	}
}

$m = new ReflectionClass('Test');
Reflection::export($m);