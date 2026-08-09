<?php

// INICIAMOS SESION PARA MANEJO DE DATOS Y ERRORES PARA EL USUARIO //
session_start();

// LLAMAMOS LA CONEXION A LA BASE DE DATOS //
require __DIR__.'/../db/conn.php';


// CREAMOS VARIABLES PARA ALMACENAR LOS DATOS DEL REGISTRO ENVIADOS POR METODO POST //
$name = $_POST['userName'];
$lastName = $_POST['userLastName'];
$email = $_POST['userEmail'];
$pass = md5($_POST['userPass']);

// VALIDAMOS QUE LOS DATOS ESTEN DENTRO DE LAS VARIABLES, SI ES QUE NO HAY INFORMACION SE ENVIARA UNA ADVERTENCIA AL USUARIO POR MENSAJE DE SESSION Y SE REDIRIGIRA A LA PAGINA DE REGISTRO //
if(empty($_POST['Register']) or empty($_POST['userEmail'])){
    header('Location: ../pages/register.php');
    $_SESSION['MessageError'] = 'Debe registrar un email';
    exit();
}

// SE CREAN LAS VARIABLES PARA ALMACENAR LA CONSULTA DE VALUDACION DE USUARIO, ESTO PARA EVITAR DUPLICIDAD DE EMAIL //
$result = validateUser($conn, $email);

// CONVERTIMOS LOS DATOS RECIBIDOS EN ARREGLO ASOCIATIVO PARA SU MANEJO //
$fetch = mysqli_fetch_assoc($result);

// SE VALIDA QUE EXISTA EL EMAIL Y SI ES ASI ENTONCES DAMOS AVERTENCIA AL USUARIO DE QUE EL CORREO ESTA EN USO Y SE REDIRIGE AL LOGIN //
if(isset($fetch['Email'])){
    $_SESSION['MessageError'] = 'El email usado ya esta registrado';
    header('Location: ../pages/register.php');
    exit();
};

// VALIDAMOS SI ES QUE EL EMAIL NO EXISTE Y ENVIAMOS MENSAJE DE REGISTRO EXITOSO, REGISTRAMOS AL USUARIO CON LA FUNCION REGISTERUSER Y LO REDIRIGIMOS A LOGIN //
if(isset($fetch['Email']) !== $email){
    registerUser($conn, $name, $lastName, $email, $pass);
    $_SESSION['MessageSuccess'] = 'Cuenta registrada exitosamente';
    header('Location: ../pages/login.php');
    exit();
};

// ESTA FUNCION VALIA SI EXISTE O NO EL EMAIL A REGISTAR //
function validateUser($conn, $email){
    $query = 'SELECT * FROM users WHERE Email = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    return $stmt->get_result();
};

// ESTA FUNCION REGISTRA LOS DATOS DEL USUARIO EN EL SISTEMA //
function registerUser($conn, $name, $lastName, $email, $pass){
    $query = 'INSERT INTO users (Nombre, Apellido, Email, Contraseña) VALUES(?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $name, $lastName, $email, $pass);
    $stmt->execute();
};

?>