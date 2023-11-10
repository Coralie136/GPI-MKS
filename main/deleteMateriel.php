<?php 
    session_start();
    include_once("../config/bd.php");

    if (isset($_GET['id'])) {

      $req = $db->prepare("DELETE FROM materiels WHERE id=?");
      $res = $req->execute([$_GET['id']]);
      $_SESSION['message'] = "Materiel supprimé avec succès";
      header("Location: materiel.php");
    }