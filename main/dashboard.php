<?php  
  session_start();
  include_once("../config/bd.php");

  $id = $_SESSION['id_user'];

  if (!$id) {
    header("Location: Authentification/connexion.php");
  }



  if ($_SESSION['role_user'] != "user") {
    // On va recuperer la liste des interventions de tous les utilisateurs
    $req1 = $db->query("SELECT * FROM intervention");
    $resIntervention = $req1->rowCount();

    // On recupere le nombre de materiels de tous les utilisateurs
    $req2 = $db->query("SELECT * FROM materiels");
    $resMateriels = $req2->rowCount();

    // On recupere le nombre de tickets de tous les utilisateurs
    $req3 = $db->query("SELECT * FROM ticket");
    $resTickets = $req3->rowCount();

  }else{

    // On va recuperer la liste des interventions de l'utilisateur
    $req1 = $db->prepare("SELECT * FROM intervention WHERE id_user=?");
    $req1->execute([$id]);
    $resIntervention = $req1->rowCount();

    // On recupere le nombre de materiels de l'utilisateur
    $req2 = $db->prepare("SELECT * FROM materiels WHERE id_user=?");
    $req2->execute([$id]);
    $resMateriels = $req2->rowCount();

    // On recupere le nombre de tickets de l'utilisateur
    $req3 = $db->prepare("SELECT * FROM ticket WHERE id_user=?");
    $req3->execute([$id]);
    $resTickets = $req3->rowCount();


  }


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

    <title>Dashboard  | Gestion de parc informatique</title>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@3.0.0/css/boxicons.min.css">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.20.0/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

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
            <li class="menu-item active">
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
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Bienvenue sur notre plateforme🎉</h5>
                          <p class="mb-4">
                            Nous sommes ravis de vous accueillir dans notre système de gestion de parc informatique, conçu pour simplifier et optimiser la gestion de vos ressources informatiques. Grâce à cette plateforme, vous aurez un contrôle total sur vos actifs informatiques, leur performance et leur maintenance.
                          </p>

                          <!-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> -->
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="../assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-lg-3 col-md-6 col-sm-6 mb-5">
                          <div class="card text-center">
                              <div class="card-body">
                                  <div >
                                      <i class="menu-icon tf-icons bx bx-credit-card bx-md" style="color: green;"></i>
                                  </div>
                                  <br>
                                  <span class="fw-semibold d-block mb-1">Tickets</span>
                                  <h3 class="card-title mb-2"><?=$resTickets ?> </h3>
                              </div>
                          </div>
                      </div>

                      <div class="col-lg-3 col-md-6 col-sm-6 mb-5">
                          <div class="card text-center">
                              <div class="card-body">
                                  <div >
                                      <i class="menu-icon tf-icons bx bx-desktop bx-md" style="color: green;"></i>
                                  </div>
                                  <br>
                                  <span class="fw-semibold d-block mb-1">Matériels</span>
                                  <h3 class="card-title mb-2">  <?=$resMateriels ?>  </h3>
                              </div>
                          </div>
                      </div>

                      <div class="col-lg-3 col-md-6 col-sm-6 mb-5">
                          <div class="card text-center">
                              <div class="card-body">
                                  <div >
                                    <!-- <svg class="menu-icon" style="color: green;size:20px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><g fill="currentColor"><path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z"/><path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5L11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361l-.596.893l.809-.27a.25.25 0 0 1 .287.377l-.596.893l.809-.27l.158.475l-1.5.5a.25.25 0 0 1-.287-.376l.596-.893l-.809.27a.25.25 0 0 1-.287-.377l.596-.893l-.809.27l-.158-.475l1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2a1 1 0 0 1 0 2Z"/></g></svg> -->
                                      <i class="menu-icon tf-icons bx bx-wrench bx-md" style="color: green;"></i>
                                  </div>
                                  <br>
                                  <span class="fw-semibold d-block mb-1">Interventions</span>
                                  <h3 class="card-title mb-2"> <?=$resIntervention?> </h3>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                
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
    <!-- / Layout wrapper -->

    <!-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        ></a
      >
    </div> -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
