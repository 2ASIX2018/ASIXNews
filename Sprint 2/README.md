# Projecte ASIXNews: Sprint 2. Formularis i control de sessions.

En aquest sprint s'han afegit les següents novetats al codi:

* Incorporació de l'autenticació i el control de sessions al nostre lloc (encara sense fer l'accés a la base de dades)
* Implementació dels formularis de registre i login
* Implementació del formulari de pujada d'imatges

A més, veureu que s'ha reorganitzat una miqueta el codi per introduir la programació orientada a objectes.

## Formulari de Login

El formulari de login s'ha renomenat a `loginForm.php`, i el contingut del formulari en sí és el següent:

```xml
    <form id="Login" action="login.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" required="required" name="inputUser" placeholder="Usuari">
        </div>

        <div class="form-group">
            <input type="password" class="form-control" required="required" name="inputPassword" placeholder="Contrasenya">
        </div>

        <div class="form-group">
          <div class="checkbox">
              <label><input type="checkbox" name="rememberMe" id="rememberMe" value="remember">
              Recorda'm en aquest ordinador
              </label>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>

    </form>
```

Fixeu-se en els següents detalls:

* El `action="login.php"`, per indicar la pàgina a la que ens enviarà el formulari
* Hem fet ús d'una petició HTTP `POST` (`method="post"`) per enviar la informació del formulari.
* Hem afegit l'atribut `name` als dos camps que ens interessa, *inputUser* i *inputPassword*.
* Hem afegit un nou checkbox amb l'opció *"Recorda'm en aquest ordinador".*

## Accés al sistema i control de sessions

El fitxer *login.php* s'encarrega de validar els usuaris. Com que encara no hem vist accés a base de dades, farem una comprovació amb usuaris introduits directament al codi. Concretament els usuaris "admin" i "user", un amb permís d'administració i l'altre un usuari comú.

Guardarem els logins vàlids en un vector:

```php
$usuaris=["admin", "user"];
```

I consultem les variables que se'ns envien des del formulari:

```php
$user=$_REQUEST["inputUser"];
$pass=$_REQUEST["inputPassword"];
$remember=$_REQUEST["rememberMe"];
```
Ara comprovem que la variable `$pass` siga "1234" (quan tingam la base de dades ja ho farem correctament), i que l'usuari introduit `$user` siga algun del vector d'usuaris. Açò ho aconseguim amb la funció `in_array`, passant-li com a arguments, en primer lloc l'element que volem buscar i en segon el vector d'elements. Si la contrassenya és correcta i l'usuari es troba al vector d'usuaris autenticats, establirem les diferents variables de sessió al valor corresponent:

```php
if ($pass=="1234" && in_array($user, $usuaris)) {
    // Usuari logat amb èxit.

    $_SESSION['username']=$user;
    // Establim el rol de la sessió
    if ($user=="admin")
        $_SESSION['role'] = "admin";
    else if ($user=="user")
        $_SESSION['role'] = "user";
```

I a més, si l'usuari ha indicat que volem que el recorde el navegador, afegirem un parell de cookies a aquest:

```php
    // Si l'usuari ho ha indicat, guardem les credencials
    if($remember=="remember") {
        setcookie('ASIXNewsUser', $_SESSION['username'], time() + 365 * 24 * 60 * 60); 
        setcookie('ASIXNewsRole', $_SESSION['role'], time() + 365 * 24 * 60 * 60); 
    }
```

I finalment, redirigim a la pàgina principal, amb la funció `header`, de la següent forma:

    header("Location: index.php");
    
## Construcció del menú

El següent pas és construir la barra de navegació en funció del tipus d'usuari de què es tracte. Recordem que, com que totes les pàgines tenen el menú comú, aquest es va introduir en un fitxer a banda. Ara, gràcies a això, només amb que modifiquem aquest fitxer, tindrem el menú modificat en totes les vistes.

L'inici del fitxer `menu.php` té el següent aspecte:

```php
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
```

L'estructura és la mateixa que als exemples que tenim als apunts per comprovar si estem en una sessió iniciada, si tenim la informació de l'usuari en cookies o si no tenim cap coneixement de l'usuari.

Les primeres línies, estableixen les variables `$user` i `$role` per defecte, si no hi ha sessió. Després, comprovem si hi ha un nom d'usuari registrat a la sessió (`if (isset($_SESSION['username']))`), si aquest és el cas, ens quedem amb el nom d'usuari, i comprovem quin tipus d'usuari és (amb `$_SESSION['role]`). En cas que no tingam un nom d'usuari registrat a la sessió, comprovarem si hi ha alguna cookie del nostre lloc guardada al navegador (`if (isset($_COOKIE['ASIXNewsUser']))`), si existeix, establim les variables de la sessió a les que teníem emmagatzemades i seguim. Finalment, si no es compleix cap d'aquestes condicions, l'usuari queda com a usuari anònim. Al final, hem definit la variable `$userLabel`, que tindrà el nom d'usuari i una etiqueta *"(administrador)"*, en cas de ser usuari d'aquest tipus.

Ara, el que farem al menú és mostar unes o altres opcions en funció del rol de l'usuari logat. Per exemple, si es tracta d'un usuari logat (tenim el seu nom d'usuari a la sessió), li apareixerà l'opció per poder redactar notícies:

```xml
<?php
if(isset($_SESSION['username'])){
?>
  <li class="nav-item">
     <a class="nav-link" href="redacta.php">Redacta</a>
   /li>
<?php
     }
     ...
```
Amb açò, aquesta opció només ens apareixerà si és un usuari logat. Fixeu-se en com estem combinant instruccions PHP i codi HTML que s'insereix o no a la pàgina en funció de certes condicions expressades en PHP. Adoneu-se també que podem començar un bloc de codi (obrir una clau `{` ) en un fragment de PHP, tancar aquest fragment PHP i després obrir-ne un altre i tancar el bloc de codi (o la clau `}`). Amb açò, emmarquem el codi HTML dins els blocs de codi PHP.


## Tancant la sessió

Si l'usuari és un usuari registrat, té l'opció de tancar la sessió des de la barra de navegació.

Per fer això, hem creat un fitxer `logout.php` amb el següent contingut. Com podreu veure és bastant explicatiu a través dels comentaris, i bàsicament el que fem és esborrar la informació de la sessió amb `$_SESSION = array();`, i després, per tal d'eliminar les cookies, el que gem és establir-les de nou, però donant-los un temps de validera que ja ha passat, pel que el navegador mateixa l'esborra:

```php
session_start();

// Esborrem tota la informació
$_SESSION = array();

// I les cookies pròpies de l'aplicació
if(isset($_COOKIE["ASIXNewsUser"])){ 
    // Per eliminar la cookie, li posem valor nul
     // I data de validesa el dia abans
    setcookie("ASIXNewsUser", null, time()-3600);
}
if(isset($_COOKIE["ASIXNewsRole"])){
     // Per eliminar la cookie, li posem valor nul
     // I data de validesa el dia abans
     setcookie("ASIXNewsRole", null, time()-3600);     
}

// Esborrem la cookie amb el nom de la sessió 
if(isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
} 
  

// I finalment destruïm la sessió
session_destroy();

// I tornem a la pàgina principal
header("Location: index.php");
exit();
```
