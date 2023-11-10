<?php 
    session_start();
    include_once("../config/bd.php");

    if (isset($_GET['id'])) {

      $req = $db->prepare("DELETE FROM fournisseur WHERE id=?");
      $res = $req->execute([$_GET['id']]);
      $_SESSION['message'] = "Fournisseur supprimé avec succès";
      header("Location: fournisseurs.php");
    }