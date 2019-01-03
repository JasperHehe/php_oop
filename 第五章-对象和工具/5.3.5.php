<?php
/**
	5.3.5 检查方法参数
**/

class Shop{

}

class CdProduct{
	const SUM_NUM = 100;
	
	public static $a = 'lily';
	protected $b = 'sam';
	private $c = 'lulu';

	public function __construct(Shop $name, &$sex, $height = 1){

	}
	
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

$class = new ReflectionClass('CdProduct');
$method = $class->getMethod('__construct');
$params = $method->getParameters();

foreach($params as $param){
	print argData($param). "\n";
}

function argData(ReflectionParameter $arg){
	$details = "";
	$declaringclass = $arg->getDeclaringClass();
	$name = $arg->getName();
	$class = $arg->getClass();
	$position = $arg->getPosition();
	$details .= "\$$name has position $position\n";
	
	// 参数是否有对象类型提示
	if(!empty($class)){
		$classname = $class->getName();
		$details .= "\$$name must be a $classname object\n";
	}
	
	// 参数是否引用
	if($arg->isPassedByReference()){
		$details .= "\$$name is passed by reference\n";
	}

	// 参数默认值可用性
	if($arg->isDefaultValueAvailable()){
		$def = $arg->getDefaultValue();
		$details .= "\$$name has default: $def\n";
	}

	return $details;
}