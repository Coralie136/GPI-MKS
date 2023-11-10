<?php 
    session_start();

    include_once("../config/bd.php");

    // On procede a l'ajout des interventions dans la BD

    if (isset($_POST['submit_intervention'])) {

        $dateintervention = date('Y-m-d');
        $detailintervention = $_POST['detailintervention'];
        $typedeprobleme = $_POST['typedeprobleme'];
        $telintervenant = $_POST['telintervenant'];
        $ticket = $_POST['ticket'];
        $nomintervenant = $_POST['nomintervenant'];
        $idUser =  $_POST['id_user'];
    
    
        if (!empty($dateintervention) && !empty($idUser) && !empty($detailintervention) &&!empty($typedeprobleme) &&!empty($telintervenant) &&!empty($ticket) &&!empty($nomintervenant) ){
    
        $req= $db->prepare("INSERT INTO intervention (date, detail, type_probleme, id_ticket,id_user, tel_intervenant, nom_intervenant) VALUES (?,?,?,?,?,?,?)");
        $req->execute([$dateintervention, $detailintervention, $typedeprobleme,  $ticket, $idUser,$telintervenant, $nomintervenant]);

        $_SESSION['message'] = "Intervention enregistré avec succès";
        header("Location: intervention.php");

        }else{
            $_SESSION['message'] = "Désolé veuillez remplir tous les champs";
            header("Location: intervention.php");
        }
    }

    if (isset($_POST['update_intervention'])) {
        
        $dateintervention = $_POST['dateintervention'];
        $detailintervention = $_POST['detailintervention'];
        $typedeprobleme = $_POST['typedeprobleme'];
        $telintervenant = $_POST['telintervenant'];
        $ticket = $_POST['ticket'];
        $nomintervenant = $_POST['nomintervenant'];
        $idUser =  $_POST['id_user'];
        $id = $_GET['id'];


        var_dump([$dateintervention, $detailintervention, $typedeprobleme, $ticket, $idUser, $telintervenant,$nomintervenant , $id]);

        if (!empty($dateintervention) && !empty($idUser) && !empty($detailintervention) &&!empty($typedeprobleme) &&!empty($telintervenant) &&!empty($ticket) &&!empty($nomintervenant) ){

            $req= $db->prepare("UPDATE intervention SET date=?, detail=?, type_probleme=?, id_ticket=?, id_user=?, tel_intervenant=?,nom_intervenant=?  WHERE id=?");
        
            $req->execute([$dateintervention, $detailintervention, $typedeprobleme, $ticket, $idUser, $telintervenant, $nomintervenant ,$id]);
    
            $_SESSION['message'] = "Intervention Modifié avec succès";
            header("Location: intervention.php");
        }else {
            
            $_SESSION['message'] = "Veuillez remplir tous les champs svp!";
            header("Location: intervention.php");
        }

    }