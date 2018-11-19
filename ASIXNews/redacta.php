<?php
/* Si l'usuari no està registrat, redirigim a index.php */
session_start();
if(!isset($_SESSION["username"])) header("Location: index.php");

require ("models/categoria.php");

$cat=new Categoria();
$categories=$cat->getCategories();

?><html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ASIXNews</title>

    <?php require_once("StylesLoader.php"); ?>
	<link href="css/blog-post.css" rel="stylesheet">
</head>

<body>
<?php require_once("menu.php");  ?>

<div class="container">
<h1 class="form-heading">Redactar notícia</h1>

<div class="main-div">
    
    <form id="newPost" method="post" action="guardaNoticia.php">

        <div class="form-group">
			<label for="postName">Títol de la notícia</label>
            <input type="text" class="form-control" id="postName" placeholder="Títol de la notícia" name="postName">
        </div>

		<div class="form-group">
			<label for="postType">Categoria de la notícia</label>
			<select  id="postType" name="postType">
                <?php
                    foreach($categories as $id=>$cat){
                        echo ('<option class="form-control" value="'.$id.'">'.$cat.'</option>');
                    }
                    
                ?>
            
			</select>
        </div>

		<div class="form-group">
			<label for="postAbstract">Ressum de la notícia</label>
            <textarea class="form-control" id="postAbstract" name="postAbstract" placeholder="Ressum de la notícia"></textarea>
        </div>

		<div class="form-group">
			<label for="postContent">Text de la notícia</label>
            <textarea class="form-control" rows="20" id="postContent" name="postContent" placeholder="Text de la notícia"></textarea>
        </div>


        <button type="submit" class="btn btn-primary">Publica</button>

    </form>
    </div>
</div>
</div>

<?php require_once "footer.php"; ?>

</body>
</html>