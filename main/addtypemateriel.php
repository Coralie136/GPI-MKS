<?php 
    session_start();

    include_once("../config/bd.php");

    // On procede a l'ajout des types de materierls dans la BD

    if (isset($_POST['submit_type_materiel'])) {

        $nomTypeMateriel = $_POST['nom_type_materiel'];
        
        if (!empty($nomTypeMateriel) ){
        
            $req= $db->prepare("INSERT INTO type_materiel (nom) VALUES (?)");
            $req->execute([$nomTypeMateriel]);

            $_SESSION['message'] = "Type de materiel enregistré avec succès";
            header("Location: type_de_materiels.php");

        }else{
            $_SESSION['message'] = "Désolé veuillez remplir tous les champs";
            header("Location: type_de_materiels.php");
        }
    }

    // On procede à la mise à jour des type de materiel
    if (isset($_POST['update_type_materiel'])) {
        $nomTypeMateriel = $_POST['nom_type_materiel'];
        $id = $_GET['id'];

        if (!empty($nomTypeMateriel)) {
            $req = $db->prepare("UPDATE type_materiel SET nom=? WHERE id=?");
            $req->execute([$nomTypeMateriel, $id]);
            $_SESSION['message'] = "Type de materiel modifié avec succès";
            header("Location: type_de_materiels.php");
        }else{

            $_SESSION['message'] = "Veuillez renseigner tous les champs !!!";
            header("Location: type_de_materiels.php");
        }
    }