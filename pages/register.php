<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="../css/app.style.css?v=1.0.4">
</head>
<body>
    <header>
        <h1>App To Do List PHP</h1>
        <h3>Lista para compras</h3>
    </header>

    <!-- CREAMOS EL FORMULARIO DE REGISTRO Y MOSTRAMOS POR SESSION LOS DATOS DEL USUARIO Y MENSAJES DE ERROR -->
    <fieldset class="formContainer" id="ContainerRegister">
        <?php 
            session_start();
            if(isset($_SESSION['MessageError'])){
                ?> <section class="messageError">
                        <p>
                            <?php echo $_SESSION['MessageError'];;?>
                        </p>
                    </section>
                <?php
                session_destroy();
            };
        ?>
        <form action="../auth/auth-register.php" method="post" id="formRegister">
            <header>
                <h2>Register</h2>
            </header>
            <section class="formRegister">
                <div class="inputsRegister">
                    <div>
                        <label for="user">Usuario:</label>
                        <input required type="email" id="user" name="userEmail" placeholder="Ingrese su usuario." autocomplete="current">
                    </div>
                    <div>
                        <label for="pass">Contraseña:</label>
                        <input required type="password"  id="pass" name="userPass" placeholder="Clave de acceso." autocomplete="current-password">
                    </div>
                    <div>
                        <label for="pass">Nombre:</label>
                        <input required type="text"  id="name" name="userName" placeholder="Escriba su nombre.">
                    </div>
                    <div>
                        <label for="pass">Apellido:</label>
                        <input required type="text"  id="lastName" name="userLastName" placeholder="Escriba su apellido.">
                    </div>
                </div>
                <input type="submit" value="Registrarte" class="btn btnSuccess" name="Register">
            </section>
            <footer class="footerForm">
                <a href="../index.php" type="button">Cancelar</a>
            </footer>
        </form>
    </fieldset>

<?php require('../includes/footer.php'); ?>