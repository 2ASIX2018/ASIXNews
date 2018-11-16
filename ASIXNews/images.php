<?php
/* Si l'usuari no està registrat redirigim a index.php */
session_start();
if(!isset($_SESSION["username"])) header("Location: index.php");
?>

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

    

    if(isset($_SESSION["error_on_upload"])) {
      error_log($_SESSION["error_on_upload"]);
      ?>
      
      <div class="alert alert-danger" role="alert">
      Error: <?php echo($_SESSION["error_on_upload"]); ?>
      </div>

    <?php
    unset($_SESSION["error_on_upload"]);
    }
    ?>

    <!-- Page Content -->
    <div class="container">

      
      <!-- Content Row -->

      <!-- Formulari per pujar imatges -->
      
      <div class="row">
      <div class="col-md-8 col-md-offset-2" style="margin: 50px 0px 50px 0px">
      <form action="upload.php" method="post" enctype="multipart/form-data">
          <label for="fileUp"  style="float:left;font-weight:bold;">Trieu un fitxer per pujar</label>
          <input type="file" name="fileUp" id="fileUp" style="float:left;">
          <input type="submit" value="Puja la imatge nova" style="float:left">
      </form>
      </div>
      </div>

      <div class="row">

        <?php
          if ($handle = opendir('media')) {

            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") { ?>
                <div class="col-md-3 mb-3">
                  <div class="card h-100">
                    <div class="card-body" style="background-image:url(<?php echo("media/".$entry);?>);background-size:contain;background-repeat:no-repeat;min-height:200px"></div>
                    <div class="card-footer">
                    <p class="card-text" style="text-align:center;"><?php echo ("$entry\n"); ?></p>
                    </div>
                  </div>
                </div>

                    
                <?php 
                }
            }

            closedir($handle);
          }

        /*$titols=["Noticia 1", "Noticia 2", "Noticia 3"];
        $resums=["Resum de la noticia 1", "Resum de la noticia 2", "Resum de la noticia 3"];
        for($i=0; $i<count($titols);$i++)
        {
          ?>

        

        <?php }*/ ?>
        
      </div>
      <!-- /.row -->


    <!-- Pagination -->
    <!--ul class="pagination justify-content-center">
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
    </ul-->

    </div>
    <!-- /.container -->



    <?php require_once "footer.php"; ?>

    
  </body>

</html>
