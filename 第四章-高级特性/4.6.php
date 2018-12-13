<?php
/**
	4.6错误处理-异常
**/

// 定义Exception的子类处理不同类型报错
class XmlException extends Exception{
	private $error;

	function __construct(LibXmlError $error){
		$shortfile = basename($error->file);
		$msg = "[{shortfile}, line {$error->line}, col {$error->column} {$error->message}]";
		$this->error = $error;
		parent::__construct($msg, $error->code);
	}

	function getLibXmlError(){
		return $this->error;
	}
}

class FileException extends Exception{}

class ConfException extends Exception{}

class Conf{
	function __construct($file){
		$this->file = $file;
		if(!file_exists($file)){
			throw new Exception("file 'file' does not exist");
		}
		$this->xml = simplexml_load_file($file, null, LIBXML_NOERROR);
		if(!is_object($this->xml)){
			throw new XmlException(libxml_get_last_error());
		}
		print gettype($this->xml);
		$matches = $this->xml->xpath("/conf");
		if(!count($matches)){
			throw new ConfException("Could not find root element:conf");
		}
	}

	function write(){
		if(!is_writable($this->file)){
			throw new FileException("file '{$this->file}' is not writable");
		}
		file_put_contents($this->file, $this->xml->asXML());
	}
}

// 实例化conf类分别catch不同的报错子类处理
class Runner{
	static functrion init(){
		try{
			$conf = new Conf(dirname(__FILE__)."conf01.xml");
			print "user:".$conf->get('user'). "\n";
			print "host:".$conf->get('host')."\n";
			$conf->set("pass", "newpass");
			$conf->write();
		}catch(FileException $e){
			// 文件权限问题或者文件不存在
		}catch(XmlException $e){
			// XML文件损坏
		}catch(ConfException $e){
			// 错误的XML文件格式
		}catch(Exception $e){
			// 后备捕捉器，正常情况下不应该被调用
		}
	}
}

