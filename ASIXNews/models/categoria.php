<?php

class Categoria{
    
    public function getCategories(){
        // Mètode que retorna una vector indexat de categoríes

        try{
            require_once "connexio.php";

            $cadenaConnexio="mysql:host=".$connexio["servidor"].";dbname=".$connexio['bd'].";charset=utf8";
            $db = new PDO($cadenaConnexio, $connexio["usuari"], $connexio["contrassenya"]); 

            $consulta = $db->prepare('SELECT * FROM Categoria');        
            $consulta->execute();
            
            
            while($fila=$consulta->fetch()){
                $categories[$fila[0]]=$fila[1];
            }

            return $categories;


        } catch (Exception $e){
            echo("Error:".$e->getMessage());
        }



    }

}


?>