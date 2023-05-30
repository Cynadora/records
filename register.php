<?php

// on importe le contenu du fichier "db.php"
include('db.php');
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
</head>
<body>

<div style="width: 45%; margin: 50px auto 20px auto; ">
<?php 
 session_start();
 echo $_SESSION['msg'].'<br/><br/>';

 if($_GET['view'] == 'profile') {
 echo '<b>Welcome '.$_SESSION['name'].'</b><br/><br/>';
?>
<div  class="col-sm-4">
  <form action='handler.php' method="post" class="form-horizontal">
   <div class="form-group">
    <input type="hidden" name="object" value="logout"/>
    <button class="btn btn-small btn-primary btn-block" type="submit">Logout</button>  
   </div>
  </form>
</div>    
<?php
} else {
?>
<div style="float: left; padding-right: 70px; border-right: 1px solid #ddd;">
<div class="wrapper">
<form action='handler.php' method="post" class="form-horizontal">
   <h1 class="form-signin-heading">Formulaire d'inscription</h1><br/>
   <div class="form-group">
    <label class="control-label col-sm-4" for="textinput">Name</label>  
   <div  class="col-sm-8">
   <input id="textinput" name="name" placeholder="Entrer votre nom" class="form-control input-md" required="" type="text">
</div>
</div>
<div class="form-group">
   <label class="control-label col-sm-4" for="textinput">Username</label>  
   <div  class="col-sm-8">
    <input id="textinput" name="username" placeholder="Entrer votre prénom" class="form-control input-md" required="" type="text">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-sm-4" for="textinput">Password</label>  
   <div  class="col-sm-8">
    <input id="textinput" name="password" placeholder="Entrer votre mot de passe" class="form-control input-md" required="" type="password">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-sm-4" for="textinput">Confirm Password</label>  
    <div  class="col-sm-8">
     <input id="textinput" name="confirm_password" placeholder="Confirmer votre mot de passe" class="form-control input-md" required="" type="password">
    </div>
</div>
<div class="form-group">
 <label class="control-label col-sm-4" for="textinput"></label>  
  <div class="col-sm-8">
   <button class="btn btn-small btn-primary btn-block" type="submit">Register</button>  
   <input type="hidden" name="object" value="register"/>
  </div>
</div>    
</form>
</div>   
</div>

</div>
<?php } ?>