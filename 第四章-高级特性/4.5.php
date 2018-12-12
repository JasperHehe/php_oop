<?php
/**
	4.5延迟静态绑定-static关键字
**/

abstract class DomainObject{
	private $group;
	private $name;

	public function __construct(){
		// 延迟静态绑定新关键字static指代被调用类
		$this->group = static::getGroup();
		// self依然指代当前类 Domain
		$this->name = self::getName();
	}

	public static function create(){
		// 延迟静态绑定
		return new static();
	}

	static function getGroup(){
		return "domain_group";
	}

	static function getName(){
		return "domain_name";
	}
}

class User extends DomainObject{

}

class Document extends DomainObject{
	static function getGroup(){
		return "document_name";
	}
}

class SpreadSheet extends Document{
	static function getName(){
		return "spread_name";
	}
}

print_r(User::create());
print_r(Document::create());
print_r(SpreadSheet::create());
