<?php

namespace app\libs;

class CreateController{
    public function __construct($controller){
        if(file_exists("app/Controllers/".$controller.".php")){
            errorLogs("Controller invalid");
        }else{
            $this->create($controller);
        }
    }

    public function create($controller){
        
    }
}