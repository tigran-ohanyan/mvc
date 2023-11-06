<?php 

namespace app\core;
use app\core\View;
use app\core\Database;

class Router{

	protected $url = [];
	protected $routes = [];
	public $controller = 0;
	public $view;
	public $db;

	public function __construct(){
		$url = trim($_SERVER['REQUEST_URI'],'/');
		if($url == ""){
			$this->routes = ['controller' => "main", "action" => "index"];
		}else{
			$this->url = explode('/', $url);
			$this->routes['controller'] = $this->url[0];
			if(empty($this->url[1])){
				$this->routes['action'] = "index";
			}else{
				$this->routes['action'] = $this->url[1];

			}

			if($this->routes['controller'] == "admin"){
				$this->GetAdminController();
			}else{
				$this->match();
				$this->view = new View($this->routes);
				$this->db = new Database;
			}
		}
		
	}
	
	
	public function match(){
		if(file_exists("app/controllers/".$this->routes['controller'].'.php')){
			$this->controller = "app\controllers\\".$this->routes['controller'];
		}
		else{
			errorLogs("Container not found - ".$this->routes['controller']);
			View::error(404);
		}
	}


	public function run(){
		if($this->controller != 0){
			$controller = new $this->controller;	
			if(file_exists("app/views/".$this->routes['controller']."/".$this->routes['action'].".php")){
				$action = $this->routes['action'].'Action';
				$controller->$action($this->view, $this->db);
			}else{
				errorLogs("Action not found - ".$this->routes['action']."Action");
				View::error(404);
			}
		}	
	}

	public function GetAdminController(){
		header("location: app/admin/");
	}
}