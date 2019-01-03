<?php
/**
	5.3.3 检查类
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
	static function getClassSource(ReflectionClass $class){
		// 类文件的绝对路径
		$path = $class->getFileName();
		// 函数把整个文件读入一个数组中,数组中的每个单元都是文件中相应的一行，包括换行符在内。
		$lines = @file($path);
		// 类的起始行
		$from = $class->getStartLine();
		// 类的终止行
		$to = $class->getEndLine();
		$len = $to - $from + 1;
		// 截取数组中的一段值
		return implode(array_slice($lines, $from - 1, $len));
	}
}


print ReflectionUtil::getClassSource(
	new ReflectionClass('CdProduct')
);
