<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ASIXNews</title>

    <?php
    require_once("StylesLoader.php");
    // Carreguem parsedown
    require_once __DIR__ . '/vendor/autoload.php';
    ?>

    <!-- Custom styles for this template -->
    <link href="css/small-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <?php
    require_once("menu.php");
    ?>

    <!-- Page Content -->
    <div class="container">
    <?php
        require ("models/noticia.php");
        $gestorNoticies=new Noticia();
        $idNoticia="1";
        if (isset($_GET["idnoticia"])) $idNoticia=$_GET["idnoticia"];
        $noticia=$gestorNoticies->lligNoticia($idNoticia);
   ?>
    

        <!-- Title -->
        <h1 class="mt-4"><?php echo($noticia["titol"]);?></h1>

        <!-- Author -->
        <p class="lead">
        Escript per: <em><?php echo($noticia["autor"]);?></em><br/>
        Categoría: <em><?php echo($noticia["categoria"]);?></em>
        </p>

        <hr>
        <!-- Date/Time -->
        <p>Data:<?php echo($noticia["publicat"]);?></p>
        <hr>


        <!-- Post Content -->
        <p class="lead"><?php echo($noticia["ressum"]);?></p>
        

        <!--p class=""><!-- ?php echo($noticia["contingut"]);?></p-->
        <?php
        $Parsedown = new Parsedown();
        echo $Parsedown->text($noticia["contingut"]);
        ?>

        <hr>



    </div>
    <!-- /.container -->



    <?php require_once "footer.php"; ?>

    
  </body>

</html>
