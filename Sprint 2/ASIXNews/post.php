<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <<title>ASIXNews</title>

    <?php
    require_once("StylesLoader.php");
    ?>

    <!-- Custom styles for this template -->
    <link href="css/blog-post.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
   <?php 
   require_once("menu.php");
   ?>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
          <h1 class="mt-4">Títol de la notícia</h1>

          <!-- Author -->
          <p class="lead">
            Publicat per XXX
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Publicat el 24 del 10 de 2018</p>

          <hr>

          <!-- Preview Image -->
          <!--img class="img-fluid rounded" src="http://placehold.it/900x300" alt=""-->

          <hr>

          <!-- Post Content -->
          <p class="lead">Contingut de la notícia en markdown.</p>

        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">Categoria 1</a>
                    </li>
                    <li>
                      <a href="#">Categoria 2</a>
                    </li>
                    <li>
                      <a href="#">Categoria 3</a>
                    </li>
                  </ul>
                </div>

              </div>
            </div>
          </div>


        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php require_once "footer.php"; ?>

  </body>

</html>
