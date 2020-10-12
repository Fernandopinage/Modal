<?php 

class ConnectFactory{

    
    public static function getConection(){
        
        $host = "mysql:host=localhost;dbname=freelancer";
        $root = "root";
        $senha = "";
                
    try {
        $con = new PDO($host,$root, $senha);
        //echo "________________________conectou"."<br>";
    } catch (PDOException $exc) {
        echo $exc->getMessage();
    }

        return $con;
    }

    
}


?>