<?php 
    session_start();

    include_once("../config/bd.php");

    // On procede a l'ajout des fournisseurs dans la BD

    if (isset($_POST['submit_fournisseur'])) {

        $nomfournisseur = $_POST['nomfournisseur'];
        $telfournisseur = $_POST['telfournisseur'];
        $adressefournisseur = $_POST['adressefournisseur'];
        $emailfournisseur = $_POST['emailfournisseur'];
    
        if (!empty($nomfournisseur) && !empty($telfournisseur) &&!empty($adressefournisseur) &&!empty($emailfournisseur) ){
    
        $req= $db->prepare("INSERT INTO fournisseur (societe, tel, adresse, email ) VALUES (?,?,?,?) ");
        $req->execute([$nomfournisseur, $telfournisseur, $adressefournisseur, $emailfournisseur]);

        $_SESSION['message'] = "Fournisseur enregistré avec succès";
        header("Location: fournisseurs.php");

        }else{
            $_SESSION['message'] = "Désolé veuillez remplir tous les champs";
            header("Location: fournisseurs.php");
        }
    }

    // On procede à la mise a jour des fournisseurs

    if (isset($_POST['update_fournisseur'])) {

        $nomfournisseur = $_POST['nomfournisseur'];
        $telfournisseur = $_POST['telfournisseur'];
        $adressefournisseur = $_POST['adressefournisseur'];
        $emailfournisseur = $_POST['emailfournisseur'];
        $id = $_GET['id'];

        if (!empty($nomfournisseur) && !empty($telfournisseur) &&!empty($adressefournisseur) &&!empty($emailfournisseur) ){
    
            $req= $db->prepare("UPDATE fournisseur  SET societe=?, tel=?, adresse=?, email=? WHERE id=?");
            $req->execute([$nomfournisseur, $telfournisseur, $adressefournisseur, $emailfournisseur, $id]);

            $_SESSION['message'] = "Fournisseur modifié avec succès";
            header("Location: fournisseurs.php");

        }else{
            $_SESSION['message'] = "Désolé veuillez remplir tous les champs";
            header("Location: fournisseurs.php");
        }

    }