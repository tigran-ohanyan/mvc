<?php 

	namespace app\controllers;

	class main{		

		function __construct(){

		}

		public function indexAction($view,$db){




			
			$view->render("Main page");

			
		}
	}