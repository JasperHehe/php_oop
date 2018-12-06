<?php
class ShopProduct{
	public $numberPages;
	public $playLength;
	public $title;
	public $producerMainName;
	public $producerFirstName;
	public $price;
	
	function __construct($title, $firstName, $mainName, $price, $numberPages = 0, $playLength = 0){
		$this->title = $title;
		$this->producerFirstName = $firstName;
		$this->producerMainName = $mainName;
		$this->price = $price;
		$this->numberPages = $numberPages;
		$this->playLength = $playLength;
	}
	
	function getNumberOfPages(){
		return $this->numberPages;
	}
	
	function getPlayLength(){
		return $this->playLength;
	}	
	
	function getProducer(){
		return "{$this->producerFirstName}". "{$this->producerMainName}";
	}
}