<?php
// on importe le contenu du fichier "db.php" SUR TOUTES LES PAGES
include('db.php');
// on exécute la méthode de connexion à notre BDD
$db = connexionBase();

// Vérifie si la méthode de la requête est POST avant l'exécution des instructions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // Instructions de traitement des données du formulaire
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>

   <div style="width: 45%; margin: 50px auto 20px auto; ">
      <?php
      //Si 'msg' (clé) existe dans la variable $_SESSION le code sera exécuter/isset vérifie que la variable est défini et n'est pas NULL
      session_start();
      if (isset($_SESSION['msg'])) {
         echo $_SESSION['msg'] . '<br/><br/>';
      }
      //Si "view" (paramètre) est présent dans l'URL et a pour valeur "profile" le code sera exécuter
      if (isset($_GET['view']) && $_GET['view'] == 'profile') {
         echo '<b>Welcome ' . $_SESSION['name'] . '</b><br/><br/>';
         ?>
         <div class="col-sm-4">

            <!-- Le formulaire sera envoyé à ////////index.php (voir si bon et la ligne 55)////////// lorsqu'il sera soumis       -->
            <form action="script_register.php" method="post" class="form-horizontal">
               <div class="form-group">

                  <!--Création d'un champ caché dans le formulaire/L'attribut name est défini comme "object" et la valeur du champ est définie comme "logout"////////////      -->
                  <input type="hidden" name="object" value="logout" />
                  <button class="btn btn-small btn-primary btn-block" type="submit">Logout</button>
               </div>
            </form>
         </div>
         <?php
      } else {
         ?>
         <div style="float: left; padding-right: 70px; border-right: 1px solid #ddd;">
            <div class="wrapper">

               <form action='register.php' method="post" class="form-horizontal">

                  <h1 class="form-signin-heading">Formulaire d'inscription</h1><br />
                  <div class="form-group">
                     <label class="control-label col-sm-4" for="textinput">Name</label>
                     <div class="col-sm-8">
                        <input id="textinput" name="name" placeholder="Entrer votre nom" class="form-control input-md"
                           required="" type="text">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-4" for="textinput">Username</label>
                     <div class="col-sm-8">
                        <input id="textinput" name="username" placeholder="Entrer votre prénom"
                           class="form-control input-md" required="" type="text">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-4" for="textinput">Password</label>
                     <div class="col-sm-8">
                        <input id="textinput" name="password" placeholder="Entrer votre mot de passe"
                           class="form-control input-md" required="" type="password">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-4" for="textinput">Confirm Password</label>
                     <div class="col-sm-8">
                        <input id="textinput" name="confirm_password" placeholder="Confirmer votre mot de passe"
                           class="form-control input-md" required="" type="password">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm-4" for="textinput"></label>
                     <div class="col-sm-8">
                        <button class="btn btn-small btn-primary btn-block" type="submit">Enregistrer</button>
                        <input type="hidden" name="object" value="register" />
                     </div>
                  </div>
               </form>
            </div>
         </div>
      <?php } ?>

   </div>

</body>

</html>