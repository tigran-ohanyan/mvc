<?php 

namespace app\core;

class View{
	
	public $routes;
	public $layout = "default";
	public $path;

	public function __construct($routes){
		$this->routes = $routes;
		$this->path = $routes['controller']."/".$routes['action'];
	}

	public static function error($code){
		http_response_code($code);
		require "app/views/errors/".$code.".php";
		exit;
	}
	

	public function render($title = "", $data = []){
		require_once "app/views/layout/".$this->layout."Header.php";
		require_once "app/views/".$this->path.".php";
		require_once "app/views/layout/".$this->layout."Footer.php";
	}
}