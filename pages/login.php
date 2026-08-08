<fieldset id="formContainer">
    <form action="auth/auth-login.php" method="post" id="formLogin">
        <header>
            <h2>Login</h2>
        </header>
        <section class="inputsLogin">
            <div>
                <div>
                    <label for="user">Usuario:</label>
                    <input require type="email" id="user" name="userName" placeholder="Ingrese su usuario.">
                </div>
                <div>
                    <label for="pass">Contraseña:</label>
                    <input require type="password"  id="pass" name="userPass" placeholder="Clave de acceso.">
                </div>
            </div>
            <input type="submit" value="Acceder" class="btn btnSuccess" name="User">
        </section>
        <footer>
            <a href="../pages/register.php">Recuperar contraseña.</a>
        </footer>
    </form>
</fieldset>