<?php 
    session_start();
    include_once("../config/bd.php");

    if (isset($_GET['id'])) {

      $req = $db->prepare("DELETE FROM utilisateur WHERE id=?");
      $res = $req->execute([$_GET['id']]);
      $_SESSION['message'] = "Utilisateur supprimé avec succès";
      header("Location: utilisateur.php");
    }