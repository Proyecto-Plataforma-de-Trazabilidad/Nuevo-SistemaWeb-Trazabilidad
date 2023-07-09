<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TEP</title>
    <link rel="icon" type="image/png" href="/Logos/LogoTep.png"/>


    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!--SweetAlert en linea-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!--SweetAlert en local por mis webos-->
    <link rel="stylesheet" href="plugins\Sweetalert2\sweetalert2.min.css">
    <script src="plugins\Sweetalert2\sweetalert2.all.min.js"></script>


    <style>
        .btn-primary {
            background: #285430;
            border: #285430;
        }

        .btn-primary:hover {
            background: #5F8D4E;
            border: #5F8D4E;
            font-weight: bold;
        }

        body {
            background: #285430;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #285430, #5F8D4E);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #285430, #5F8D4E);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            margin-top: 5%;
        }

        .bg {
            background-image: url(Logos/pead.jpg);
            background-position: center right;
            margin: 5px;

            background-size: cover;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .forgotpsw a {
            color: #285430;
            font-weight: 600;
            font-weight: bold;
            font-style: italic;
            text-decoration: none;
        }

        .forgotpsw a:hover {
            color: #319944;
            font-weight: 600;

        }
    </style>




</head>

<body>
        
    <div class="container w-50 bg-white" id="contenido">
        <div class="row">
            <div class="col bg">

            </div>
            <div class="col">
                <div class="text-end">
                    <center>
                        <br>
                        <img src="Logos/APEAJAL2.jpg" width="80" alt="logo">
                        <img src="Logos/AMOCALI.jpg" width="80" alt="logo">
                        <img src="Logos/ASICA.jpg" width="80" alt="logo">
                    </center>
                    <br>

                    <div class="col-sm-12">
                        <center>
                            <p style="font-family:'Times New Roman', Times, serif; font-style:italic; font-size:15px; font-weight:bold;">"Combatiendo la piratería de agroquímicos"</p>
                        </center>
                    </div>
                </div>


                <h2 class="fw-bold text-center py-5">Bienvenido</h2>

                <!--Login-->
                <form id="frmlogin" method="POST" action="">
                    <div class="b-2">
                        <label for="user">Usuario</label>
                        <input type="text" class="form-control" id="user" placeholder="Ingrese el usuario" name="usuario">
                    </div>

                    <div class="b-2">
                        <label for="pass">Contraseña</label>
                        <input type="password" class="form-control" id="pass" placeholder="Password" name="contra">

                    </div>

                    <br>
                    <div class="forgotpsw">
                        <center>
                            <a href="restorepsw.php">Olvidé mi contraseña</a>
                        </center>
                    </div>

                    <?php
                    if (isset($_GET['message'])) {
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?php
                            switch ($_GET['message']) {
                                case 'ok':
                                    echo 'Por favor, revisa tu correo electrónico';
                                    break;

                                case 'success_psw':
                                    echo 'Inicia Sesión con tu nueva contraseña.';
                                    break;

                                case 'notfound':
                                    echo 'No existe ningún usuario asociado. Pide a tu administrador que te registre';
                                    break;

                                default:
                                    echo 'Error. Intenta de nuevo';
                                    break;
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>


                    <br>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" onclick="" name="Registrar">Iniciar Sesión</button>
                    </div>

                    <br><br>

                </form>


            </div>
        </div>
    </div>

    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="poper\popper.min.js"></script>
    <script type="text/javascript" src="loggin/codigologin.js"></script>





</body>

</html>