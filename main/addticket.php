<?php 
    session_start();

    include_once("../config/bd.php");

    // On procede a l'ajout des tickets dans la BD
    if (isset($_POST['submit_ticket'])) {

        $numTicket = (int)((rand() * rand())/rand());
        $dateReclamation = date('Y-m-d');
        $etatMateriel = $_POST['etatMateriel'];
        $descMateriel = $_POST['descMateriel'];
        
        if ($_SESSION['role_user']=="admin") {
            $employe = $_POST['employe'];
        }else{
            $employe = $_SESSION['id_user'];
        }
        $materiel = $_POST['materiel'];
    
    
    
        if (!empty($numTicket) && !empty($dateReclamation) &&!empty($etatMateriel) &&!empty($descMateriel) &&!empty($employe) &&!empty($materiel) ){
    
            $req= $db->prepare("INSERT INTO ticket (numero_ticket, date_reclamation, etat, description, id_user, id_materiel) VALUES (?,?,?,?,?,?)");
            $req->execute([$numTicket, $dateReclamation, $etatMateriel, $descMateriel, $employe, $materiel]);

            $_SESSION['message'] = "Ticket enregistré avec succès";
            header("Location: ticket.php");

        }else{
            $_SESSION['message'] = "Désolé veuillez remplir tous les champs";
            header("Location: ticket.php");
        }
    }


    // On procede à la mise à jour des tickets
    if (isset($_POST['update_ticket'])) {

        $numTicket = $_POST['numTicket'];
        $dateReclamation = $_POST['dateReclamation'];
        $etatMateriel = $_POST['etatMateriel'];
        $descMateriel = $_POST['descMateriel'];
        $employe = $_POST['employe'];
        $materiel = $_POST['materiel'];
        $id = $_GET['id']; //L'ID du ticket
    
    
        if (!empty($numTicket) && !empty($dateReclamation) &&!empty($etatMateriel) &&!empty($descMateriel) &&!empty($employe) &&!empty($materiel) ){
        
        $req= $db->prepare("UPDATE ticket SET numero_ticket=?, date_reclamation=?, etat=?, description=?, id_user=?, id_materiel=? WHERE id=?");
        
        $req->execute([$numTicket, $dateReclamation, $etatMateriel, $descMateriel, $employe, $materiel, $id]);

        $_SESSION['message'] = "Ticket Modifié avec succès";
        header("Location: ticket.php");

        }else{

            $_SESSION['message'] = "Désolé veuillez remplir tous les champs";
            header("Location: ticket.php");
        }
    }

