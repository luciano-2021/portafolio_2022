<?php
session_start();
    if (isset($_SESSION["tpo"]) && $_SESSION["tpo"] == 3) {
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
        <link rel="icon" href="img/favicon.png">
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="home.php">Carnes Toño</a>
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
                             <a class="nav-link collapsed" href="#" id="menCatalogo">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-times"></i></div>
                                Catalogo de productos
                                <div class="sb-sidenav-collapse-arrow"><i class=""></i></div>
                            </a>  

                            <a class="nav-link collapsed" href="#" id="menCarro">
                                <div class="sb-nav-link-icon"><i class="fas fa-calendar-check"></i></div>
                                Carro de Compras
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
                
                <div id="dvCatalogoMenu" class="container col-md-11 mt-5">
                    <div class="row text-left">
                        <h4>Catálogo Productos</h4>
        
                        <div id="dvCatalago">

                            <main class="containerCat" id="containerCat">
                              
                            </main>

                        </div>
                                               
                    </div>
                </div>
                <input type="hidden" id="qtyProdVenta">
                <div>                
                    <!-- The Modal -->
                    <div class="modal txtajusteizquierda" id="modalQTYCarro">
                        <div class="modal-dialog">
                            <div class="modal-content">
                    
                            <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title colorformulario" id="lblModalCarro"></h4>
                                    <button type="button" class="btn-close" id="btnCierreModal" data-bs-dismiss="modal"></button>
                                </div>
                    
                                <!-- Modal body -->
                                <div class="modal-body">
                                
                                    <div class="row text-left">
                                        <div class="form-group col-md-6 mb-2 mt-2">
                                            <input type = "hidden" id="txtIdProductoCArro" value="0">
                                            <input type = "hidden" id="txtNomProductoModal" value="">
                                            <input type = "hidden" id="txtpreProductoModal" value="">
                                            <h6 class="float-left colortitulo">Cantidad a Comprar</h6>
                                            <input type="text" class="form-control" id="txtQTYProducto">
                                            <h6 class="float-left stocklbl">Stock Disponible: <span id="spnStock"> </span> KG.</h6>
                                        </div>

                                    </div>
                                </div>
                    
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="btnAgragaCarro">Agregar</button>
                                </div>
                    
                            </div>
                        </div>
                    </div>
                </div>

                <div id="dvCarroMenu" class="container col-md-7 mt-5">
                    <div class="row text-left">
                        <h3>Carro de Compra</h3>
                    </div>
                    <button class="btn btn-secondary" id="btnTerminarCompra" onclick="terminaCompra()">Finalizar Compra</button>
                    <div class="row text-left">
                        <h4> Total Compra: $ <span id="totalCompra">0 </span></h4>
                    </div>
                    
                    <table id="tblCarroResumen">
                        <thead>
                            <tr>
                                <th>Eliminar</th>
                                <th>Descripción</th>
                                <th>Compra</th>
                                <th>Valor</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="tblCarroResumenBody">
                            

                        </tbody>
                    </table>

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
        <script src="js/carroCompra.js"></script>
        <link rel="stylesheet" href="js/css/alertify.min.css" />
        <script src="js/alertify.min.js" ></script>
        <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

        <style type="text/css"> 
                .containerCat {
                    font-family: Vegur, 'PT Sans', Verdana, sans-serif;
                  display: grid;
                  padding: 1rem;
                  grid-gap: 1rem;
                  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                  grid-template-rows: repeat(2, 350px);
                }

                .containerCatd {
                  background-color: #E9FAF4;
                  border: 1px solid #C1D3CD;
                  color: black;
                  padding: 1rem;
                  box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
                }

                .nomProd{
                    font-size: 14px;
                    font-weight: bold;
                }
                .imgCatalogo{
                    max-width: 220px;
                    max-height: 200px;
                    box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
                }
                .spnDescirpt{

                    max-height: 45px;
                    margin-bottom: 10px;
                    margin-top: 10px;
                    font-size: 12px;
                }
                .myButton {
                    box-shadow: 0px 10px 14px -7px #3e7327;
                    background:linear-gradient(to bottom, #77b55a 5%, #72b352 100%);
                    background-color:#77b55a;
                    border-radius:4px;
                    border:1px solid #4b8f29;
                    display:inline-block;
                    cursor:pointer;
                    color:#ffffff;
                    font-family:Arial;
                    font-size:13px;
                    font-weight:bold;
                    padding:6px 12px;
                    text-decoration:none;
                    text-shadow:0px 1px 0px #5b8a3c;
                }
                .myButton:hover {
                    background:linear-gradient(to bottom, #72b352 5%, #77b55a 100%);
                    background-color:#72b352;
                }
                .myButton:active {
                    position:relative;
                    top:1px;
                }
        </style>
        
    </body>
</html>
