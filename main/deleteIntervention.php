<?php 
    session_start();
    include_once("../config/bd.php");

    if (isset($_GET['id'])) {

      $req = $db->prepare("DELETE FROM intervention WHERE id=?");
      $res = $req->execute([$_GET['id']]);
      $_SESSION['message'] = "Intervention supprimé avec succès";
      header("Location: intervention.php");
    }