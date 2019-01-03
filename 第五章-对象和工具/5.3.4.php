<?php
/**
	5.3.4 检查方法
**/

class CdProduct{
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

class ReflectionUtil{
	static function getMethodSource(ReflectionMethod $method){
		// 方法文件的绝对路径
		$path = $method->getFileName();
		// 函数把整个文件读入一个数组中,数组中的每个单元都是文件中相应的一行，包括换行符在内。
		$lines = @file($path);
		// 方法的起始行
		$from = $method->getStartLine();
		// 方法的终止行
		$to = $method->getEndLine();
		$len = $to - $from + 1;
		// 截取数组中的一段值
		return implode(array_slice($lines, $from - 1, $len));
	}
}

$class = new ReflectionClass('CdProduct');
$method = $class->getMethod('create');
print ReflectionUtil::getMethodSource($method);
