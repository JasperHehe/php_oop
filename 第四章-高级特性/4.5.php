<?php
/**
	静态延时绑定
**/

abstract class DomainObject{
	public static function create(){
		return new self();
	}
}

class User extends DomainObject{

}

class Document extends DomainObject{

}

Document::create();