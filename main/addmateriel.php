<?php 
    session_start();

    include_once("../config/bd.php");

    // On procede a l'ajout des materiels dans la BD

    if (isset($_POST['submit_materiel'])) {
    
        $nomMateriel = $_POST['nomMateriel'];
        $dateArrive = $_POST['dateArrive'];
        $referenceMateriel = $_POST['referenceMateriel'];
        $numSerieMateriel = $_POST['numSerieMateriel'];
        $fournisseur = $_POST['fournisseur'];
        $employe = $_POST['employe'];
        $typeMateriel = $_POST['typeMateriel'];
    
    
    
        if (!empty($nomMateriel) && !empty($dateArrive) &&!empty($referenceMateriel) &&!empty($fournisseur) &&!empty($employe) &&!empty($typeMateriel) && !empty($numSerieMateriel) ){
    
        $req= $db->prepare("INSERT INTO materiels (nom_materiel, numero_serie, reference, date, id_fournisseur, id_user, id_type_materiel) VALUES (?,?,?,?,?,?,?)");
        $req->execute([$nomMateriel, $numSerieMateriel,  $referenceMateriel, $dateArrive, $fournisseur, $employe, $typeMateriel]);

        $_SESSION['message'] = "Materiel enregistré avec succès";
        header("Location: materiel.php");

        }else{
            $_SESSION['message'] = "Désolé veuillez remplir tous les champs";
            header("Location: materiel.php");
        }
    }


    // On procede à la mise a jour des info du materiel
    if (isset($_POST['update_materiel'])) {
    
        $nomMateriel = $_POST['nomMateriel'];
        $dateArrive = $_POST['dateArrive'];
        $referenceMateriel = $_POST['referenceMateriel'];
        $numSerieMateriel = $_POST['numSerieMateriel'];
        $fournisseur = $_POST['fournisseur'];
        $employe = $_POST['employe'];
        // $typeMateriel = $_POST['typeMateriel'];
        $id = $_GET['id'];
    
        var_dump([$nomMateriel, $numSerieMateriel,  $referenceMateriel, $dateArrive, $fournisseur, $employe, $id]);
    
        if (!empty($nomMateriel) && !empty($dateArrive) && !empty($referenceMateriel) && !empty($fournisseur) && !empty($employe) && !empty($numSerieMateriel) ){

        $req= $db->prepare("UPDATE materiels SET nom_materiel=?, numero_serie=?, reference=?, date=?, id_fournisseur=?, id_user=? WHERE id=?");

        $req->execute([$nomMateriel, $numSerieMateriel,  $referenceMateriel, $dateArrive, $fournisseur, $employe, $id]);

        $_SESSION['message'] = "Materiel modifié avec succès";
        header("Location: materiel.php");

        }else{
            $_SESSION['message'] = "Désolé veuillez remplir tous les champs";
            header("Location: materiel.php");
        }
    }