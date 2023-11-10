<?php  
  session_start();
  include_once("../config/bd.php");

  $id = $_SESSION['id_user'];

  if (!$id) {
    header("Location: Authentification/connexion.php");
  }

  // On recupere tous les types de materiels
  $req = $db->query("SELECT * FROM type_materiel");


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

    <title>Type de matériels  | Gestion de parc informatique</title>

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

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
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
            <li class="menu-item">
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
          </li>


          <?php if ($_SESSION['role_user']=="admin") { ?>

              <!-- Cards -->
            <li class="menu-item active">
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
            </li>


            <!-- Cards -->
            <li class="menu-item">
              <a href="utilisateur.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-check"></i>
                <div data-i18n="Basic">UTILISATEUR</div>
              </a>
            </li>

          <?php }  ?>

          

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

              <p></p>
              <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Type de materiel</span> </h4>
              <div class="container">

                

                <?php if ($_SESSION['role_user']=="admin") { ?>

                  <div class="row justify-content-end">
                    <button style="width: 200px;margin-bottom: 5px" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      + Nouveau type de materiel
                    </button>
                  </div>

                <?php }  ?>
                <!-- Button trigger modal -->
                

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un type de matériel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" action="addtypemateriel.php">
                          <div class="row">
                            <div class="col">
                              <input name="nom_type_materiel" type="text" class="form-control" placeholder="TYPE DE MATERIEL" aria-label="NOM">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button name="submit_type_materiel" type="submit" class="btn btn-primary">Ajouter</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
              <div class="justify-content-center mb-3">
              

                            <!-- Le message de confirmation  -->
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
                <h5 class="card-header">TABLE TYPE MATERIEL</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr class="text-nowrap">
                        <th style="text-align: center" >#</th>
                        <th style="text-align: center" >TYPE MATERIEL</th>
                        <th style="text-align: center" >Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php while ($res = $req->fetch()) { ?>
                      <tr>
                        <td style="text-align: center"> <?=$res['id']?> </td>
                        <td style="text-align: center"><?=$res['nom']?> </td>
                        <td style="text-align: center" class="d-flex justify-content-center">
                        
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-warning mx-2" data-bs-toggle="modal" data-bs-target="#update_<?=$res['id'] ?>">
                            Modifier
                          </button>
        
                          <!-- Modal for update type de materiel-->
                          <div class="modal fade" id="update_<?=$res['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modifier un type de matériel</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form method="POST" action="addtypemateriel.php?id=<?=$res['id']?>">
                                    <div class="row">
                                      <div class="col">
                                        <input value="<?=$res['nom']?>" name="nom_type_materiel" type="text" class="form-control" placeholder="TYPE DE MATERIEL" aria-label="NOM">
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                      <button name="update_type_materiel" type="submit" class="btn btn-primary">Valider</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalSup_<?=$res['id'] ?>">
                            Supprimer
                          </button>
        
                          <!-- Modal -->
                          <div class="modal fade" id="modalSup_<?=$res['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Supprimer</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  Voulez vous supprimer ce type de materiel ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                                  <button type="button" class="btn btn-primary">
                                    <a style="text-decoration: none; color:white" href="deleteTypeMateriel.php?id=<?=$res['id']?>">
                                      Confirmer
                                    </a>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>

                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Responsive Table -->
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
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
