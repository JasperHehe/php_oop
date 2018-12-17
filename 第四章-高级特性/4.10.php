<?php
/**
	4.10 使用__clone()复制对象
**/
class Account{
	public $balance;

	function __construct($balance){
		$this->balance = $balance;
	}
}

class Person{
	private $name;
	private $age;
	private $id;
	public $account;

	function __construct($name, $age, Account $account){
		$this->name = $name;
		$this->age = $age;
		$this->account = $account;
	}

	function setId($id){
		$this->id = $id;
	}

	function __clone(){
		$this->id = 0;
	}
}

$person = new Person("bob", 44, new Account(200));
$person->setId(343);
$person2 = clone $person;

// 给$person充一些钱
$person->account->balance += 10;
// 结果$person2也得到了这笔钱，这不合理
print $person2->account->balance;

// 当创建新副本时，新对象中所保存的引用指向的是$person所引用的同一个Account对象
//如果不希望对象属性在被复制后被共享，可以显式在__clone()方法中复制指向的对象
function __clone(){
	$this->id = 0;
	$this->account = clone $this->account;
}

