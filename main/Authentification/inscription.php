<?php

    include_once("../../config/bd.php");
    $msg = "";

    if(isset($_POST['valider'])){
        
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
        $telephone = $_POST['telephone'];
        $password = $_POST['password'];
        $confirmation_password = $_POST['password_confirmation'];

        if (!empty($nom) && !empty($email) &&!empty($prenom) &&!empty($telephone) &&!empty($password) &&!empty($confirmation_password) ) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // je verifie si l'adresse email est dejà utilisé
                $req = $db->prepare("SELECT * FROM utilisateur WHERE email=?");
                $req->execute([$email]);
                $result = $req->fetch();

                if (!$result) {
                    $telephone = preg_replace('/\D/', '', $telephone); 
                    if (strlen($telephone) != 10) {
                        $msg ="Votre numero de téléphone  doit etre composé de 10 chiffres...";    
                    }else{
                        // On verifie si le telephone existe dejà deans la base de données
                        $request = $db->prepare("SELECT * FROM utilisateur WHERE telephone=?");
                        $request->execute([$telephone]);
                        $response = $request->fetch();

                        if (!$response) {
                            // On va verifier les mot de passe que l'utilisateur entre
                            if ($password == $confirmation_password) {
                                    // On va inserer les infos dans la BDD
                                    $query = $db->prepare("INSERT INTO utilisateur (nom,prenom, email,telephone, password,adresse,role) VALUES (?,?,?,?,?,?,?)");
                                    $query->execute([$nom, $prenom, $email, $telephone, sha1($password), $adresse, "user"]);

                                    $msg ="Bravo vous avez créé votre compte avec succès";
                            } else {
                            $msg = "Veuillez renseigner les mot de passe identiques!";
                            }
                        } else {
                            $msg = "Ce numero de téléphone est déjà utilisé";
                        }
                    }
                } else {
                    $msg= "Cette adresse email est dejà utilisé";
                }
            }else{
                $msg = "L'adresse email saisi n'est pas valide...";
            }
        }else{
            $msg = "Veuillez remplir tous les champs SVP !!!";
        }
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="shortcut icon" href="asset('images/360..png')">
    <link rel="stylesheet" href="../../public/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <script>
        document.addEventListener("DOMContentLoaded", function(){
            $("#btn-modal").modal("show");
        });
    </script> -->

</head>
<body class="gradient-form h-full bg-neutral-200 dark:bg-neutral-700">
    <section class="gradient-form h-full bg-neutral-200 dark:bg-neutral-700">
        <div class="container h-full p-10">
            
            <div class="g-6 flex h-full flex-wrap items-center justify-center text-neutral-800 dark:text-neutral-200">
                <div class="w-full">
                    <?php if($msg!="") { ?>
                        <div class="row justify-content-center mb-5">
                                <div  class="col-6 msg">
                                    <div style="text-align: center;" class="alert alert-info" role="alert">
                                        <?= $msg; ?>
                                    </div>
                                </div>
                            </div>
                    <?php } ?>
                    <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-800">
                        <div class="g-0 lg:flex lg:flex-wrap">
                            <!-- left column container with background and description-->
                            <div id="sidebar" class="flex items-center rounded-b-lg lg:w-6/12 lg:rounded-r-lg lg:rounded-bl-none">
                               
                                <div class="px-4 py-6 text-white md:mx-6 md:p-12">
                                    <h4 class="mb-6 text-xl font-semibold">
                                        Nous sommes plus qu'une simple entreprise
                                    </h4>
                                    <p class="text-sm">
                                        MKS SOFT TECHNOLOGIES est une agence interactive à service complet qui combine des stratégies pratiques avec des résultats concrets. Nous travaillons avec des dizaines d'entreprises de toutes tailles pour élargir leurs opportunités commerciales grâce à la technologie.
                                    </p>
                                </div>
                            </div>
                            <!-- Left column container-->
                            <div class="px-4 md:px-0 lg:w-6/12">
                                <div class="md:mx-6 md:p-12">
                                    <!--Logo-->
                                    <div class="text-center">
                                        <img class="mx-auto w-48" src="../../assets/logo.png" alt="logo" />
                                        <h4 class="mb-5 mt-1 pb-1 text-xl font-semibold">
                                            Nous sommes une entreprise de technologies
                                        </h4>
                                    </div>
                                  

                                    <form method='POST' action="<?= $_SERVER['PHP_SELF']; ?>">
                                       
                                        <p class="mb-4">Veuillez renseinger vos informations pour votre votre compte</p>
                                        <!--Username input-->
                                       
                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                            <label for="email" class="form-label">Email</label>
                                            <input name="email" type="email" class="form-control" id="email" placeholder="coralie@gmail.com">   
                                        </div>

                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                            <label for="nom" class="form-label">Nom</label>
                                            <input name="nom" type="text" class="form-control" id="nom" placeholder="Kouakou">   
                                        </div>

                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                            <label for="prenom" class="form-label">Prenom(s)</label>
                                            <input name="prenom" type="text" class="form-control" id="prenom" placeholder="Coralie">   
                                        </div>

                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                            <label for="telephone" class="form-label">Téléphone</label>
                                            <input name="telephone" type="tel" class="form-control" id="telephone" placeholder="0101010101">   
                                        </div>

                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                            <label for="adresse" class="form-label">Adresse</label>
                                            <input name="adresse" type="adresse" class="form-control" id="adresse" placeholder="Abidjan Cocody">   
                                        </div>

                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                            <label for="password" class="form-label">Mot de Passe</label>
                                            <input name="password" type="text" class="form-control" id="password" placeholder="*****">   
                                        </div>

                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                            <label for="confirm_password" class="form-label">Confirmation Mot de passe </label>
                                            <input name="password_confirmation" type="text" class="form-control" id="confirmation_password" placeholder="*******">   
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button name="valider" class="btn btn-primary" type="submit">S'inscrire</button>
                                        </div>

                                        <div class="d-grid gap-2 mt-5">
                                            <h5>Vous avez dejà un compte? <a style="text-decoration: none;" href="connexion.php">Se connecter</a></h5>
                                        </div>

                                        <!--Register button-->
                                        <!-- <div class="flex items-center justify-between pb-6">
                                            <button id="login_button" class="btn btn-primary" type="button">
                                                <a href="connexion.php"> Connexion </a>
                                            </button>
                                            
                                        </div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>


</html>




