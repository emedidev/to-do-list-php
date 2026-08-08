<fieldset id="formContainer">
    <form action="auth/auth-register.php" method="post" id="formRegister">
        <header>
            <h2>Register</h2>
        </header>
        <section class="inputsRegister">
            <div>
                <label for="user">Usuario:</label>
                <input require type="email" id="user" name="userEmail" placeholder="Ingrese su usuario.">
            </div>
            <div>
                <label for="pass">Contraseña:</label>
                <input require type="password"  id="pass" name="userPass" placeholder="Clave de acceso.">
            </div>
            <div>
                <label for="pass">Nombre:</label>
                <input require type="text"  id="name" name="userName" placeholder="Escriba su nombre.">
            </div>
            <div>
                <label for="pass">Apellido:</label>
                <input require type="text"  id="lastName" name="userLastName" placeholder="Escriba su apellido.">
            </div>
            <input type="submit" value="Registrarte" class="btn btnSuccess" name="Register">
        </section>
        <foote>
            <a href="index.php">Cancelar.</a>
        </footer>
    </form>
</fieldset>