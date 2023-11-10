<?php 
    session_start();
    include_once("../config/bd.php");

    if (isset($_GET['id'])) {

      $req = $db->prepare("DELETE FROM ticket WHERE id=?");
      $res = $req->execute([$_GET['id']]);
      $_SESSION['message'] = "Ticket supprimé avec succès";
      header("Location: ticket.php");
    }