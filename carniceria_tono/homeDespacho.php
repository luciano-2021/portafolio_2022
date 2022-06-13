<?php
session_start();
    if (isset($_SESSION["tpo"]) && $_SESSION["tpo"] == 2) {
        $id     =  $_SESSION["idu"];
        $nombre = $_SESSION["usr"];
        $rut    = $_SESSION["rut"];
        $tipo   = $_SESSION["tpo"];
    }else{
        session_destroy();
        header("Location: login.php");
        #header('Location: http://sistema.carnestono.cl');
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Home - Carnes Toño</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Carnes Toño</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <!--div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div-->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Mi Cuenta</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <input type="hidden" id="txtIdUsr" value="<?php echo $id; ?>">

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menú</div>
                             <a class="nav-link collapsed" href="#" id="menDespachosPen">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-times"></i></div>
                                Despachos Pendientes
                                <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                            </a>  

                            <a class="nav-link collapsed" href="#" id="menDespachosRea">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                                Despachos Realizados
                                <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                            </a>                                
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Sesión Iniciada</div>
                         <span id="spanUserActivo"><?php echo $nombre; ?></span>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                
                <div id="dvReporteDespachosPen" class="container col-md-8 mt-5">
                    <div class="row text-left">
                        <h4>Despachos Pendientes</h4>
        
                        <div id="dvTblDespachosPen"></div>
                                               
                    </div>
                </div>

                <div id="dvReporteDespachosRea" class="container col-md-8 mt-5">
                    <div class="row text-left">
                        <h4>Despachos Realizados</h4>
        
                        <div id="dvTblDespachosRea"></div>
                                               
                    </div>
                </div>


                            
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Derechos &copy; Carnicerias Toño 2022</div>
                            <div>
                                <a href="#">Politica de Privacidad</a>
                                &middot;
                                <a href="#">Terminos &amp; Condiciones</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="js/homeDespacho.js"></script>
        <link rel="stylesheet" href="js/css/alertify.min.css" />
        <script src="js/alertify.min.js" ></script>
        <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <!--script src="js/datatables-simple-demo.js"></script-->

        
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

        <style type="text/css"> 
            input{ 
                text-transform: uppercase; 
            } 
            #dvTableRepVtas table{
              font-size: 12px !important;
            }
        </style>
        
    </body>
</html>
