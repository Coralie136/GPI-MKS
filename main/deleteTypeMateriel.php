<?php 
    session_start();
    include_once("../config/bd.php");

    if (isset($_GET['id'])) {

      $req = $db->prepare("DELETE FROM type_materiel WHERE id=?");
      $res = $req->execute([$_GET['id']]);
      $_SESSION['message'] = "Type de Materiel supprimé avec succès";
      header("Location: type_de_materiels.php");
    }