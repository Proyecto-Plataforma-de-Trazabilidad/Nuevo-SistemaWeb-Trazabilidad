<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar Contraseña</title>


    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <!--SweetAlert en linea-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!--SweetAlert en local por mis webos-->
    <link rel="stylesheet" href="../plugins\Sweetalert2\sweetalert2.min.css">
    <script src="../plugins\Sweetalert2\sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="css/index.css">







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

        
    </style>




</head>

<body>

    <br>

    <section>
        <div class="box">

            <div class="container">
                <div class="form" >
                    <h2>Recuperar contraseña</h2>
                    <form action="loggin/recovery.php" method="POST">
                        <div class="inputBox">
                            <input type="text" placeholder="Correo electronico" name="email" id="email" />
                        </div>
                        <div class="inputBox">
                            <input type="submit" value="Enviar" />
                        </div>
                        <p class="forget">
                            Ya tienes una cuenta? <a href="index.php">Iniciar sesión</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="../poper/popper.min.js"></script>





</body>

</html>