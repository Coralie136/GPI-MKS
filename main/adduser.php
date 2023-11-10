<?php 
    session_start();

    include_once("../config/bd.php");

    // On procede a l'ajout des utilisateurs dans la BD

    if (isset($_POST['add_user'])) {
    
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $password = $_POST['password'];
        $role = "user";
    

         var_dump([$email,  $nom, $prenom, $telephone, $adresse, sha1($password), $role]);

        if (!empty($email) && !empty($nom) && !empty($prenom) && !empty($telephone) && !empty($adresse) && !empty($password) && !empty($role) ){
    
        $req= $db->prepare("INSERT INTO utilisateur (email, nom, prenom, telephone, adresse, password, role) VALUES (?,?,?,?,?,?,?)");
        $req->execute([$email,  $nom, $prenom, $telephone, $adresse, sha1($password), $role]);

        $_SESSION['message'] = "Utilisateur enregistré avec succès";
        header("Location: utilisateur.php");

        }else{
            $_SESSION['message'] = "Désolé veuillez remplir tous les champs";
            header("Location: utilisateur.php");
        }
    }


    // On procede à la mise a jour des info du materiel
    if (isset($_POST['update_user'])) {
    
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        // $password = $_POST['password'];
        $id = $_GET['id'];

    
        if (!empty($email) && !empty($nom) && !empty($prenom) && !empty($telephone) && !empty($adresse) && !empty($id) ){

        $req= $db->prepare("UPDATE utilisateur SET email=?, nom=?, prenom=?, telephone=?, adresse=? WHERE id=?");

        $req->execute([$email, $nom,  $prenom, $telephone, $adresse, $id]);

        $_SESSION['message'] = "Utilisateur modifié avec succès";
        header("Location: utilisateur.php");

        }else{
            $_SESSION['message'] = "Désolé veuillez remplir tous les champs";
            header("Location: utilisateur.php");
        }
    }