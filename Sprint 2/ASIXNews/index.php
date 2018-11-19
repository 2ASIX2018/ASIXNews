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

      <!-- Notícia de capçalera -->
      <div class="row my-4">
    
        <div class="col-lg-12">
          <h1>Notícia de capçalera</h1>
          <p>Aci es mostrarà el ressum de la noticia de capçalera</p>
          <a class="btn btn-primary btn-lg" href="post.php">Llegeix Més</a>
        </div>
        <!-- /.col-md-4 -->
      </div>
      <!-- /.row -->

      
      <!-- Content Row -->



      <div class="row">

        <?php
        $titols=["Noticia 1", "Noticia 2", "Noticia 3"];
        $resums=["Resum de la noticia 1", "Resum de la noticia 2", "Resum de la noticia 3"];
        for($i=0; $i<count($titols);$i++)
        {
          ?>

        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <div class="card-body">
              <h2 class="card-title"> <?php echo($titols[$i]); ?></h2>
              <p class="card-text"><?php echo ($resums[$i]); ?></p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Llegeix més</a>
            </div>
          </div>
        </div>

        <?php } ?>
        
      </div>
      <!-- /.row -->


    <!-- Pagination -->
    <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
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
