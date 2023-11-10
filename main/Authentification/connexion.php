<?php
    session_start();


// j'inclus le fichier de connexion à la base de données
include_once("../../config/bd.php");

$msg= "";
if(isset($_POST['Submit'])) {

    // Je recupere le contenu de chaque champs de mon formulaire
	$email = $_POST['email'];
	$password = $_POST["password"];

    // On fait une verification sur les champs à savoir si ces champs sont vides ou pas
	if( !empty($email) && !empty($password)) {
	
        // On verifie si l'utilisateur existe dans la base de données
        $query = $db->prepare("SELECT * FROM utilisateur WHERE email=? AND password = ?");
        $query->execute([$email, sha1($password)]);
        $user = $query->fetch();

        if ($user) {
            
            //var_dump($user);

            $_SESSION["id_user"] = $user["id"];
            $_SESSION["nom_user"] = $user["nom"];
            $_SESSION["prenom_user"] = $user["prenom"];
            $_SESSION["email_user"] = $user["email"];
            $_SESSION["role_user"] = $user["role"];

            header("Location: ../dashboard.php");

            echo "Bravo vous etes bien connecté";

        } else {
            $msg= "Desolé Verifiez vos identifiants de connexion!!!";
        }
        
	} else { 

        $msg="Opps desolé veuillez remplir tous les champs";
		
	}
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link rel="stylesheet" href="../../public/style.css " />
        <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/logo/logo1.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
<body class="gradient-form h-full bg-neutral-200 dark:bg-neutral-700">
    <section class="gradient-form h-full bg-neutral-200 dark:bg-neutral-700">
        <div class="container mx-auto h-full p-10">
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
                            <!-- Left column container-->
                            <div class="px-4 md:px-0 lg:w-6/12">
                                <div class="md:mx-6 md:p-12">
                                    <!--Logo-->
                                    <div class="text-center">
                                        <img class="mx-auto w-48" src="../../assets/logo.png" alt="logo" />
                                        <h4 class="mb-12 mt-1 pb-1 text-xl font-semibold">
                                        Nous sommes une entreprise de technologie
                                        </h4>
                                    </div>
                                    <form method='POST' action="<?= $_SERVER['PHP_SELF']; ?>">
                                        <p class="mb-4">Veuillez vous connecter à votre compte</p>
                                        <!--Username input-->
                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                        <label for="email" class="form-label">Email</label>
                                            <input name="email" type="email" class="form-control" id="email" placeholder="coralie@gmail.com"> 
                                        </div>
                                        <!--Password input-->
                                        <div class="relative mb-4" data-te-input-wrapper-init>
                                            <label for="password" class="form-label">Mot de Passe</label>
                                            <input name="password" type="password" class="form-control" id="password" placeholder="*****">   
                                        </div>

                                        <!--Submit button-->
                                        <div class=" mb-12 pb-1 pt-1 text-center">
                                        <div class="d-grid gap-2">
                                            <button name="Submit" class="btn btn-primary" type="submit">Se connecter</button>
                                        </div>
                                        <br>

                                            <!--Forgot password link-->
                                            <!-- <a style="text-decoration: none;" href="#!">Mot de passe oublié ?</a> -->
                                        </div>

                                        <!--Register button-->
                                        <div class="flex items-center justify-between pb-6">
                                            <a style="text-decoration: none;" href="inscription.php" class="mb-0 mr-2">Vous n'avez pas de compte ?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Right column container with background and description-->
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

