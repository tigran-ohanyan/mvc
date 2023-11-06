<?php 

namespace app\core;

class Database{
    //TODO YOUR MYSQL SETTINGS
    protected $host = "localhost";
    protected $username = "Lint";
    protected $password = "123";
    protected $dbName = "mvc";
    protected $mysqli;

    public function __construct(){
        $this->connection();
        //$a = $this->Select("user","*","password='aa'");
        //$this->Insert("user", "username,password", "aa,bb");
    }

    protected function connection(){
        $this->mysqli = new \mysqli($this->host, $this->username, $this->password, $this->dbName);
        if ($this->mysqli -> connect_errno) {
            errorLogs("Failed to connect to MySQL: " . $this->mysqli -> connect_error);
            exit();
        }
    }

    public function Select($table, $row, $if = ""){
        $sql = "SELECT ".$row." FROM `".$table."`";
        if($if != ""){
            $sql = "SELECT ".$row." FROM `".$table."` WHERE ".$if;
        }
        $result = $this->mysqli->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            } else {
                $data = "0 results";
        }
        return $data;
    }

    public function Insert($table, $row, $value){
        $row = str_replace(",", "`,`", $row);
        $value = str_replace(",", "','", $value);
        
        $sql = "INSERT INTO ".$table." (`".$row."`) VALUES ('".$value."')";
        debug($sql);
        if ($this->mysqli->query($sql) === TRUE) {
            return true;
        } else {
            errorLogs("Error: " . $sql . "<br>" . $conn->error);
        }
    }

}