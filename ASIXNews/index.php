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
    require_once("models/noticia.php");
    $gestorNoticies=new Noticia();
    $num_noticies=$gestorNoticies->NumNoticies();
    $pagina_actual=0; // Per defecte mostrarem la pàgina 1 de resultats
    // Comprovem si ens demanen una pàgina de resultats concreta
    if(isset($_REQUEST["pg"])) $pagina_actual=$_REQUEST["pg"];
    $noticies_per_pagina=4;

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
      // Llegim la llista de notícies
      
      // $noticies=$gestorNoticies->llistaNoticies();

      $noticies=$gestorNoticies->llistaRangNoticies($pagina_actual*$noticies_per_pagina, $noticies_per_pagina);
      
      if (count($noticies)>0){
        ?>

          <!-- Notícia de capçalera -->
          <div class="row my-4">
        
            <div class="col-lg-12">
              <h1><?php echo($noticies[0]["titol"]); ?></h1>
              <p><?php echo($noticies[0]["ressum"]); ?></p>
              <a class="btn btn-primary btn-lg" href="article.php?idnoticia=<?php echo($noticies[0]['id']);?>">Llegeix Més</a>
            </div>
            <!-- /.col-md-4 -->
          </div>
          <!-- /.row -->
      <?php } ?>

      
      <!-- Content Row -->
      <div class="row">

        <?php
        
        for($i=1; $i<count($noticies);$i++)
        {
          ?>

        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title"> <?php echo($noticies[$i]["titol"]); ?></h2>
              <p class="card-text"><?php echo ($noticies[$i]["ressum"]); ?></p>
            </div>
            <div class="card-footer">
              <a href="article.php?idnoticia=<?php echo($noticies[$i]['id']);?>" class="btn btn-primary">Llegeix més</a>
            </div>
          </div>
        </div>

        <?php } ?>
        
      </div>
      <!-- /.row -->


    <!-- Pagination -->
    <ul class="pagination justify-content-center">



        <li class="page-item">
          <?php 
          $prev_pg=$pagina_actual-1;
          if ($prev_pg<0) $prev_pg=0;
          ?>
          <a class="page-link" href="index.php?pg=<?php echo($prev_pg);?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>

        <?php
          for ($i=0; $i<($num_noticies)/$noticies_per_pagina; $i++){
        ?>

        <li class="page-item">
          <a class="page-link" href="index.php?pg=<?php echo($i);?>"><?php echo($i+1);?></a>
        </li>
        
        <?php 
          }
          $next_pg=$pagina_actual+1;
          if ($next_pg>(($num_noticies)/$noticies_per_pagina)-1) $next_pg=(($num_noticies)/$noticies_per_pagina)-1;
          ?>
        <li class="page-item">
          <a class="page-link" href="index.php?pg=<?php echo($next_pg);?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>


    </ul>

    </div>
    <!-- /.container -->



    <?php require_once "footer.php"; ?>

    
  </body>

</html>
