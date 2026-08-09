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

    <fieldset class="formContainer" id="ContainerLogin">
        <?php 
            session_start();
            if(isset($_SESSION['MessageSuccess'])){
                ?> <section class="messageSuccess">
                        <p>
                            <?php echo $_SESSION['MessageSuccess'];;?>
                        </p>
                    </section>
                <?php
                session_destroy();
            };
        ?>
        <form action="../auth/auth-login.php" method="post" id="formLogin">
            <header>
                <h2>Login</h2>
            </header>
            <section class="formContent">
                <div class="inputsLogin">
                    <div>
                        <label for="user">Usuario:</label>
                        <input required type="email" id="user" name="userName" placeholder="Ingrese su usuario." autocomplete="current">
                    </div>
                    <div>
                        <label for="pass">Contraseña:</label>
                        <input required type="password"  id="pass" name="userPass" placeholder="Clave de acceso." autocomplete="current-password">
                    </div>
                </div>
                <input type="submit" value="Acceder" class="btn btnSuccess" name="User">
            </section>
            <footer class="footerForm">
                <a href="register.php" class="switchButton">Registrate</a>
            </footer>
        </form>
    </fieldset>

<?php require '../includes/footer.php'; ?>