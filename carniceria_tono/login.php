<?php 
session_start();
session_destroy();

$titulo = "Inicio Colaboradores";
$btn = "btn_login";

if (isset($_GET["uidx"]) && $_GET["uidx"] == 2) {
    $titulo = "Inicio Clientes";
    $btn = "btn_login_cliente";
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
        <link rel="icon" href="img/favicon.png">


        <title>Inicio de Sesión - Carnes Toño</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-secondary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4"><?php echo $titulo; ?></h3></div>
                                    <div class="card-body">
                                        <form>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="txtRutLogin" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Rut</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="txtPswLogin" type="password" placeholder="Password" />
                                                <label for="inputPassword">Contraseña</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="#">Olvidaste tu contraseña?</a>
                                                <a class="btn btn-secondary" id="<?php echo $btn; ?>">Login</a>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <?php 

                                            if (isset($_GET["uidx"]) && $_GET["uidx"] == 2) {
                                                echo "<div class='small'><a href='register.php'>Necesitas una cuenta? Registrate!</a></div>";
                                            }
                                            
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/login.js" ></script>
        <script src="js/alertify.min.js" ></script>
        <link rel="stylesheet" href="js/css/alertify.min.css" />
    </body>
</html>
