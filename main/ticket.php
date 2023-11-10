<?php  
  session_start();
  include_once("../config/bd.php");

  $id = $_SESSION['id_user'];
  $idArray = array();

  if (!$id) {
    header("Location: Authentification/connexion.php");
  }



  if ($_SESSION['role_user']=="admin") {
    $req = $db->query("SELECT ticket.id AS id, ticket.numero_ticket AS numTicket, ticket.date_reclamation AS dateReclamation, ticket.etat AS etat, ticket.description AS descriptionTicket, utilisateur.nom AS nomUtilisateur, utilisateur.prenom AS prenomUtilisateur,ticket.id_materiel AS idMateriel,  materiels.nom_materiel AS nom_materiel, ticket.id_user AS id_user FROM ticket JOIN utilisateur ON ticket.id_user = utilisateur.id JOIN materiels ON ticket.id_materiel = materiels.id");
  }else{
    $req = $db->prepare("SELECT ticket.id AS id, ticket.numero_ticket AS numTicket, ticket.date_reclamation AS dateReclamation, ticket.etat AS etat, ticket.description AS descriptionTicket, utilisateur.nom AS nomUtilisateur, utilisateur.prenom AS prenomUtilisateur,ticket.id_materiel AS idMateriel,  materiels.nom_materiel AS nom_materiel, ticket.id_user AS id_user FROM ticket JOIN utilisateur ON ticket.id_user = utilisateur.id JOIN materiels ON ticket.id_materiel = materiels.id WHERE ticket.id_user=? ");
    $req->execute([ $id]);
  }


  // On recupere la liste de tous les utilisateurs
  $reqUser = $db->query("SELECT id, nom, prenom FROM utilisateur WHERE role = 'user'");
  $resUser = $reqUser->fetchAll();

  // var_dump($resUser)s

  // On recupere la liste des tous les materiels
  $reqMateriel = $db->query("SELECT materiels.id AS id, materiels.nom_materiel AS nom_materiel, utilisateur.nom AS nomUtilisateur , utilisateur.prenom AS prenomUtilisateur FROM materiels JOIN utilisateur ON materiels.id_user = utilisateur.id WHERE role = 'user' ");
  $resMateriel = $reqMateriel->fetchAll();




?>

<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Ticket  | Gestion de parc informatique </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/logo/logo1.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <script src="../assets/js/config.js"></script>


  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <!-- Menu -->

        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="dashboard.php" class="app-brand-link">
              <span class="app-brand-logo demo"><img src="../assets/img/logo/logo1.png" alt="" style="width: 40px;">
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">GPI</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="dashboard.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">TABLEAU DE BORD</div>
              </a>
            </li>
            <!-- Cards -->
            <li class="menu-item active">
              <a href="ticket.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Basic">TICKET</div>
              </a>
            </li>

            <!-- Cards -->
            <li class="menu-item">
              <a href="materiel.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-desktop"></i>
                <div data-i18n="Basic">MATERIEL</div>
              </a>
            </li>

            <!-- Cards -->
            <li class="menu-item">
              <a href="intervention.php" class="menu-link">
              <i class="menu-icon tf-icons bx bx-wrench"></i>
                <div data-i18n="Basic">INTERVENTION</div>
              </a>
            </li>



          <?php if ($_SESSION['role_user']=="admin") { ?>
          <!-- Cards -->
            <li class="menu-item">
              <a href="type_de_materiels.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Basic">TYPE DE MATERIEL</div>
              </a>
            </li>

          <!-- Cards -->
            <li class="menu-item">
              <a href="fournisseurs.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Basic">FOURNISSEUR</div>
              </a>
            </li>

            <!-- Cards -->
            <li class="menu-item">
              <a href="utilisateur.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-check"></i>
                <div data-i18n="Basic">UTILISATEUR</div>
              </a>
            </li>
          <?php } ?>
          </ul>
        </aside>
        <!-- / Menu -->
        
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php include("navbar.php"); ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Les Tickets /</span> </h4>
              <div class="d-flex justify-content-between mb-3">
                <p></p>
                <div>
                    <!-- Button trigger modal -->
                  
                

                    <button  type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      + Nouveau ticket
                    </button>

                 

                    <!-- Modal For Add Ticket-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un ticket</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <form method="POST" action="addticket.php">
                              <!-- <div class="mb-3"> -->
                              <!-- <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Numero du ticket</label>
                                <input name="numTicket" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                              </div> -->
                              <!-- <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Date Reclamation</label>
                                <input name="dateReclamation" type="date" min="2010-12-01" class="form-control" id="exampleFormControlInput1" placeholder="">
                              </div> -->
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Etat du materiel</label>
                                <input name="etatMateriel" type="text" class="form-control" id="exampleFormControlInput1" placeholder="EN COURS">
                              </div>
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Description de la panne</label>
                                <textarea class="form-control" name="descMateriel" id="" cols="10" rows="3"></textarea>
                                <!-- <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=""> -->
                              </div>
                              <?php if ($_SESSION['role_user']=="admin") { ?>
                                <div class="mb-3">
                                  <label for="exampleFormControlInput1" class="form-label">Employé</label>
                                  <select class="form-select" name="employe" id="">
                                    <?php foreach ($resUser as $user) {  ?>
                                      <option value="<?=$user['id'] ?>"><?=$user['nom'].' '.$user['prenom'] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              <?php } ?>
                              <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Materiel</label>
                                <select class="form-select" name="materiel" id="">

                                <?php foreach($resMateriel as $materiel) { ?>
                                    <option value="<?=$materiel['id'] ?>"><?=$materiel['nom_materiel'].'-'.$materiel['nomUtilisateur'].' '.$materiel['prenomUtilisateur'] ?></option>
                                <?php  } ?>
                                  
                                  
                                </select>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                <button id="valider" name="submit_ticket" type="submit" class="btn btn-primary">Valider
                                </button>
                              </div>
                            </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                </div>
              </div>


              <?php if (isset($_SESSION['message']) && $_SESSION['message'] != " ") { ?>
                  <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <p> <?=$_SESSION['message'] ?> </p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              <?php 
                unset($_SESSION['message']);
                }
              ?>

              <!-- Responsive Table -->
              <div class="card">
                <h5 class="card-header">TABLE TICKET</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th>#</th>
                        <th>numero_ticket</th>
                        <th>date_reclamation</th>
                        <th>etat</th>
                        <th>description</th>
                        <th>utilisateur</th>
                        <th>materiel</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                                            <!-- On affiche de maniere dynamique les infos -->
                    <?php while ($res = $req->fetch()) { ?>
                      <tr>
                        <td> <?=$res["id"]?></td>
                        <td> <?=$res["numTicket"]?></td>
                        <td> <?=$res["dateReclamation"]?></td>
                        <td> <?=$res["etat"]?></td>
                        <td> <?=$res["descriptionTicket"]?></td>
                        <td> <?=$res["nomUtilisateur"]." ".$res["prenomUtilisateur"]?></td>
                        <td> <?=$res["nom_materiel"]?></td>
                        <td class="d-flex">
                          <div>

                          </div>
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#edit_<?=$res['id'] ?>">
                            Modifier
                          </button>

                          <!-- Modal For Update Ticket -->
                            <div class="modal fade" id="edit_<?=$res['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modifier un ticket</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST" action="addTicket.php?id=<?=$res['id']; ?>">
                                      <!-- <div class="mb-3"> -->
                                      <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Numero du ticket</label>
                                        <input name="numTicket" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="<?=$res['numTicket'] ?>">
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Date Reclamation</label>
                                        <input value="<?=$res['dateReclamation'] ?>" name="dateReclamation" type="date" min="2010-12-01" class="form-control" id="exampleFormControlInput1" placeholder="">
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Etat du materiel</label>
                                        <input name="etatMateriel" value="<?=$res['etat'] ?>"  type="text" class="form-control" id="exampleFormControlInput1" placeholder="EN COURS">
                                      </div>
                                      <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Description de la panne</label>
                                        <textarea class="form-control" name="descMateriel" id="" cols="10" rows="3"><?=$res['descriptionTicket'] ?></textarea>
                                      </div>

                                      <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Employé</label>
                                        <select class="form-select" name="employe" id="">
                                            <option value="<?=$res['id_user'] ?>"> <?=$res['nomUtilisateur'].' '.$res['prenomUtilisateur'] ?> </option>
                                          <?php foreach ($resUser as $user) { ?>

                                            

                                            <option value="<?=$user['id']?>">
                                              <?=$user['nom'].' '.$user['prenom'] ?>
                                            </option>

                                          <?php } ?>
                                        </select>
                                      </div>

                                      <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Materiel</label>
                                        <select class="form-select" name="materiel" id="">
                                          <option value="<?=$res['idMateriel'] ?>"> <?=$res['nom_materiel'].'-'.$res['nomUtilisateur'].' '.$res['prenomUtilisateur'] ?> </option>
                                        <?php foreach($resMateriel as $materiel) { ?>
                                          
                                            <option value="<?=$materiel['id'] ?>"><?=$materiel['nom_materiel'].'-'.$materiel['nomUtilisateur'].' '.$materiel['prenomUtilisateur'] ?></option>
                                        <?php  } ?>
                                          
                                          
                                        </select>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                        <button id="valider" name="update_ticket" type="submit" class="btn btn-primary">Valider
                                        </button>
                                      </div>
                                    </form>
                                  </div>
                                  
                                </div>
                              </div>
                            </div> 
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalSup_<?=$res['id']?>">
                            Supprimer
                          </button>

                          <!-- Modal  for Delete Ticket-->
                          <div class="modal fade" id="modalSup_<?=$res['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>Voulez vous supprimer le ticket <strong>N°<?=$res['numTicket']?> de <?=$res['nomUtilisateur'].' '.$res['prenomUtilisateur'] ?></strong>   </p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                  <button type="button" class="btn btn-primary">
                                    <a style="text-decoration: none; color:white" href="deleteTicket.php?id=<?=$res['id']?>">
                                      Confirmer
                                    </a>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <?php }  ?>
                    </tbody>
                  </table>
                </div>
              </div>

              
             
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder"></a>
                </div>
                <div>
                  <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank"></a>
                  <a href="https://themeselection.com/" target="_blank" class="footer-link me-4"></a>

                  <a
                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                    target="_blank"
                    class="footer-link me-4"
                    ></a
                  >

                  <a
                    href="#/issues"
                    target="_blank"
                    class="footer-link me-4"
                    ></a
                  >
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle">

      </div>
    </div>
   

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>

    <!-- <script type="text/javascript">
      var bouton = document.getElementById("valider");

      bouton.addEventListener('click', function(){
        alert("Je suis Parfait")
      })
    </script> -->
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
