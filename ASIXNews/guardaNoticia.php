<?php
session_start();
require_once("models/noticia.php");

$titol=$_REQUEST["postName"];
$cat=$_REQUEST["postType"];
$ressum=$_REQUEST["postAbstract"];
$contingut=$_REQUEST["postContent"];

$noticia=new Noticia();
$noticia->afigNoticia($titol, $cat, $ressum, $contingut);

header("Location: index.php");



?>