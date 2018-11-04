<?php
session_start();
$user="Anònim";
$role="";

if (isset($_SESSION['username'])) {
  $user=$_SESSION['username'];
  if (isset($_SESSION['role']) && $_SESSION['role']=="admin") $role="(administrador)";
  else $role="";
} else if (isset($_COOKIE['ASIXNewsUser'])){
      $_SESSION['username'] = $_COOKIE['ASIXNewsUser'];
      if (isset($_COOKIE['ASIXNewsRole'])) $_SESSION['role'] = $_COOKIE['ASIXNewsRole'];
      if ($_SESSION['role']=="admin") $role="(administrador)"; else $role="";
      $user=$_SESSION['username'];
}

$userLabel=$user.$role;
  
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">ASIXNews</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

            <li class="nav-item active">
              <a class="nav-link" href="index.php">Portada
                <!--span class="sr-only">(current)</span-->
              </a>
            </li>

            <?php
              if(isset($_SESSION['username'])){
            ?>
              <li class="nav-item">
                <a class="nav-link" href="redacta.php">Redacta</a>
              </li>
            <?php
              }
              if (isset($_SESSION['role']) && $_SESSION['role']=="admin") {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="#">Administra</a>
            </li>
            <?php } ?>

          </ul>
        </div>
      </div>
       <div id="userInfo">
       <?php echo ($userLabel);

       if($user!="Anònim") { ?>
       <a href="logout.php"> Tanca la sessió</a>
       <?php } else { ?>
       <a href="loginForm.php"> Inicia la sessió</a>
       <?php }?>


       </div>
            
    </nav>

 