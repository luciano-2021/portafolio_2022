<?php
session_start();
    if (isset($_SESSION["tpo"]) && $_SESSION["tpo"] == 1) {
        $id     =  $_SESSION["idu"];
        $nombre = $_SESSION["usr"];
        $rut    = $_SESSION["rut"];
        $tipo   = $_SESSION["tpo"];
    }else{

        if (isset($_SESSION["tpo"]) && $_SESSION["tpo"] == 2) {
            
            header("Location: homeDespacho.php");

        }else{

            session_destroy();
            header("Location: login.php");
            #header('Location: http://sistema.carnestono.cl');

        }

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
                             <a class="nav-link collapsed" href="#" id="menInicio">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Inicio
                                <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Administración
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#" id="menUsuarios">Usuarios</a>
                                    <a class="nav-link" href="#" id="menProducto">Productos</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Opciones
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Reportes
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="#" id="menReporteMin">Stock Minimo</a>
                                            <a class="nav-link" href="#" id="menReporteMax">Stock General</a>
                                            <a class="nav-link" href="#" id="menReporteVta">Ventas según perido</a>
                                        </nav>
                                    </div>
   
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Sesión Iniciada</div>
                         <span id="spanUserActivo"><?php echo $nombre; ?></span>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                

                <main id="dvInicioEstadisticas">
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Estadisticas</h1>
                        <!--graficos-->
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Ventas Últimos Días
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Ventas por perido
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                         <!--graficos-->
                </main>


                <div class="container-fluid col-md-8 mt-5" id="dvFormUsuarios">
                    <div class="row mb-5">
                        <h4>Administración de Usuarios</h4>
                        <div>
                            <button type="button" class="btn btn-secondary mt-5" data-bs-toggle="modal" data-bs-target="#btnnuevousuario" onclick="nuevoUsuario()">Nuevo Usuario</button>
                        </div>
                    </div>

                    <div class="row text-left">
                        <h5 class="lead text-left">Consulta Usuarios</h5>
                        <div class="form-group col-md-6 mb-5 mt-2">

                            <h6 class="float-left">Rut</h6>
                            <input type="text" class="form-control" id="txtFilRutUsr">
                        </div>
                        <div class="form-group col-md-6">
                            <h6 class="lead">Tipo</h6>
                            <select class="form-control form-select" id="filSelTipoUsr" >
                            <option value="0">- SELECCIONE -</option> 
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <button type="button" class="btn btn-secondary" id="bt-listaUsuarios">Buscar</button>
                        </div>
                    </div>

                    <div id="dvTableUsuarios" class="mt-4 dvTableUsuarios"></div>
                </div>

                <div>                
                    <!-- The Modal -->
                    <div class="modal txtajusteizquierda" id="btnnuevousuario">
                        <div class="modal-dialog">
                            <div class="modal-content">
                    
                            <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title colorformulario" id="lblUsuarios"></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                    
                                <!-- Modal body -->
                                <div class="modal-body">
                                
                                    <div class="row text-left">
                                        <div class="form-group col-md-6 mb-2 mt-2">
                                            <input type = "hidden" id="txtIdUsuario" value="0">
                                            <h6 class="float-left colortitulo">Rut</h6>
                                            <input type="text" class="form-control" id="txtFilRutUsrCrea">
                                        </div>

                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Nombres</h6>
                                            <input type="text" class="form-control" id="txtFilNomUsr">
                                        </div>
                                        
                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Apellido Paterno</h6>
                                            <input type="text" class="form-control" id="txtFilPatUsr">
                                        </div>
                                        
                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Apellido Materno</h6>
                                            <input type="text" class="form-control" id="txtFilMayUsr">
                                        </div>

                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Carniceria</h6>
                                            <select class="form-control" id="txtFilCartUsr">
                                                <option value="0">- SELECCIONE -</option>
                                            </select>
                                        </div>
                        
                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Tipo Usuario</h6>
                                            <select class="form-control" id="txtFiTipUsr">
                                                <option value="0">- SELECCIONE -</option>
                                            </select>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                    
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="btnGrabaUsuario">Guardar</button>
                                </div>
                    
                            </div>
                        </div>
                    </div>
                </div>
            <!-- fin modal usuario -->

            <!-- Reportes -->

            <div id="dvReporteVenta" class="container col-md-8 mt-5">
                <div class="row text-left">
                    <h4>Reporte de Ventas</h4>
                    <div class="form-group col-md-6 mb-2 mt-2">
        
                        <h6 class="float-left colortitulofecha">Fecha Desde</h6>
                        <input type="date" class="form-control" id="txtFilRepDesde">

                        <h6 class="float-left colortitulofecha mt-2">Fecha Hasta</h6>
                        <input type="date" class="form-control" id="txtFilRepHasta">

                        <div class="float-left col-md-6 mt-2">
                            <button type="button" class="btn btn-secondary" id="btn-busca-reportes">Buscar</button>
                        </div>
                    </div>

                    <div id="dvTableRepVtas"></div>
                                           
                </div>
            </div>

            <div id="dvReporteMinimo" class="container col-md-8 mt-5">
                <div class="row text-left">
                    <h4>Reporte Stock Mínimo</h4>                                         
                </div>
                <div id="dvTableRepMinimo" class="mt-4"></div>
            </div>

            <div id="dvReporteMaximo" class="container col-md-8 mt-5">
                <div class="row text-left">
                    <h4>Reporte Stock General</h4>                                         
                </div>
                <div id="dvTableRepMaximo" class="mt-4"></div>
            </div>

            <div class="container-fluid col-md-8 mt-5" id="dvFormProductos">
                <div class="row mb-5">
                    <h4>Administración de Productos</h4>
                    <div>
                        <button type="button" class="btn btn-secondary mt-5" data-bs-toggle="modal" data-bs-target="#btnNuevoProducto" onclick="nuevoProducto()">Nuevo Producto</button>
                    </div>
                </div>

                <div class="col text-left">
                    <h5 class="lead text-left">Consulta Productos</h5>
                    <div class="form-group col-md-6 mb-5 mt-2">
                        <h6 class="">Nombre</h6>
                        <input type="text" class="form-control" id="txtFilNomProducto">
                    </div>

                    <div class="form-group col-md-6">
                        <button type="button" class="btn btn-secondary" id="btnListaProductos">Buscar</button>
                    </div>
                </div>

                <div id="dvTableProductos" class="mt-4"></div>
            </div>

                 <div>                
                    <!-- The Modal producto-->
                    <div class="modal txtajusteizquierda" id="btnNuevoProducto">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <form enctype="multipart/form-data" id="formCreaProducto" onsubmit="return false"> 
                            <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title colorformulario" id="lblProducto"></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                    
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <input type="hidden" id="txtIdProducto" name="txtIdProducto" value="0">
                                    <div class="row text-left">
                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Descripción</h6>
                                            <input type="text" class="form-control" id="txtDescProd" name="txtDescProd">
                                        </div>

                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Stock Mínimo</h6>
                                            <input type="text" class="form-control" id="txtStockMin" name="txtStockMin">
                                        </div>
                                        
                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Stock Máximo</h6>
                                            <input type="text" class="form-control" id="txtStockMax" name="txtStockMax">
                                        </div>
                                        
                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Stock Inicial</h6>
                                            <input type="text" class="form-control" id="txtStockIni" name="txtStockIni">
                                        </div>

                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Carniceria</h6>
                                            <select class="form-control" id="txtProdCarn" name="txtProdCarn">
                                                <option value="0">- SELECCIONE -</option>
                                            </select>
                                        </div>
                        
                                        <div class="form-group col-md-6 mb-2 mt-2 divImgProd">
                                            <h6 class="float-left colortitulo">Imagen Producto</h6>
                                            <input type="file" class="form-control" id="filImgProd" name="filImgProd"> 
                                        </div>

                                        <div class="form-group col-md-6 mb-2 mt-2">
                    
                                            <h6 class="float-left colortitulo">Precio Producto $</h6>
                                            <input type="text" class="form-control" id="txtPreProd" name="txtPreProd">
                                        </div>
                                        <br>
                                    </div>
                                </div>
                    
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="btnCreaProducto">Guardar</button>
                                </div>
                            </form>    
                    
                            </div>
                        </div>
                    </div>
                </div>
            <!-- fin modal producto -->


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
        <script src="js/home.js"></script>
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
