<?php
session_start();
if(!isset($_SESSION["username"])) header("Location: index.php");

// Definim el directori on volem pujar els fitxers (target_dir)
$target_dir = "media/";
$msgerr="";
$errors=false;  // la variable errors ens indicarà si hem trobat algun error

// I en target_file tindrem el path final de la imatge
// Fixeu-se que accedim a la variable superglobal $_FILES, 
// i dins d'ella busquem el camp ["fileUp"] i en ell ["name]
$target_file = $target_dir . basename($_FILES["fileUp"]["name"]);

// La imatge es puja en principi a un fitxer temporal de PHP
// Aquesta ubicació temporal ve definida pel component tmp_name 
// del component fileUp de la variable superglobal $_FILES
$tmp_file=$_FILES["fileUp"]["tmp_name"];



// Comprovem que es tracta d'una imatge amb la funció getimagesize
// Aquesta funció ens torna les dimensions de la imatge o bé
// false si no és una imatge:

echo("<script>alert('".$_FILES["fileUp"]["tmp_name"]."');</script>");

$dimensions = getimagesize($_FILES["fileUp"]["tmp_name"]);

if($dimensions==false) {
    $msgerr="No és un fitxer de tipus imatge";
    $errors=true;
}

// A més, podem restringir els tipus d'imatges:

// Agafem el tipus de la imatge, amb la funció pathinfo, de la següent forma
// La funció strtolower converteix el resultat (extensió) en minúscules
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// I ara comprovem l'extensió amb diferents tipus:
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif") {
    $msgerr="La imatge no és del tipus correcte.";
    $errors = true;
}

// Modificació del nom si el fitxer existeix

if (file_exists($target_file)) {
       $i=0;

        //echo ("<p>El fitxer existeix, renomenant-lo</p>");
       $imageName=pathinfo($target_file,PATHINFO_FILENAME);

       do{
            $target_file = $target_dir.$imageName.$i.".".$imageFileType;
            //echo("<p>$target_file</p>");
            $i++;
        } while (file_exists($target_file));

}


// Comprovació de la grandària dle fitxer (en bytes)
if ($_FILES["fileUp"]["size"] > 500000 && !$errors) {
    $msgerr="La imatge és massa gran";
    $errors = true;
}

// Si tot és correcte, movem el fitxer de la seua ubicació
// temporal a la ubicació definitiva amb move_upload_file:

if ($errors){
  error_log($msgerr);
  $_SESSION["error_on_upload"]=$msgerr;
} else {
    //echo($tmp_file." ".$target_file);
    if (!move_uploaded_file($tmp_file, $target_file)){
        $_SESSION["error_on_upload"]="El fitxer no s'ha pogut pujar";
    }
}

header("Location: images.php");


?>
