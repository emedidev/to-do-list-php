<?php

session_start();

require __DIR__.'/../db/conn.php';

$name = $_POST['userName'];
$lastName = $_POST['userLastName'];
$email = $_POST['userEmail'];
$pass = md5($_POST['userPass']);

if(empty($_POST['Register']) or empty($_POST['userEmail'])){
    header('Location: ../pages/register.php');
    $_SESSION['MessageError'] = 'Debe registrar un email';
    exit();
}

$result = validateUser($conn, $email);
$fetch = mysqli_fetch_assoc($result);

if(isset($fetch['Email'])){
    $_SESSION['MessageError'] = 'El email usado ya esta registrado';
    header('Location: ../pages/register.php');
    exit();
};

if(isset($fetch['Email']) !== $email){
    registerUser($conn, $name, $lastName, $email, $pass);
    $_SESSION['MessageSuccess'] = 'Cuenta registrada exitosamente';
    header('Location: ../pages/login.php');
    exit();
};

function validateUser($conn, $email){
    $query = 'SELECT * FROM users WHERE Email = ?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    return $stmt->get_result();
};

function registerUser($conn, $name, $lastName, $email, $pass){
    $query = 'INSERT INTO users (Nombre, Apellido, Email, Contraseña) VALUES(?, ?, ?, ?)';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssss', $name, $lastName, $email, $pass);
    $stmt->execute();
};

?>