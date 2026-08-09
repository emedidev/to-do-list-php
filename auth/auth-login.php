<?php 

// SE REQUIERE LA CONECCION A LA BASE DE DATOS //
require __DIR__.'/../db/conn.php';

// SE INICIA UNA SESION PARA PARA CONTROLAR ERRORES Y MANTENER LOS DATOS DEL USUARIO QUE ACCEDA //
session_start();

// VALIDAMOS SI ES QUE EXISTE UNA SOLICITUD DEL USUARIO POR EL METODO POST //
if(isset($_POST['User'])){
    
    // VALIDAMOS QUE LOS DATOS NO ESTEN VACIOS, SI ESQUE LO ESTAN, SE ENVIARA UN MENSAJE DE ADVERTENCIA Y SE ENVIARA AL USUARIO AL LOGIN //
    if(empty($_POST['userName']) or empty($_POST['userPass'])){
        header('Location: ../index.php');
        $_SESSION['MessageWarning'] = 'No registro el usuario o contraseña.';
        exit();
    };

    // CREAMOS LAS VARIABLES PARA ALOJAR LOS DATOS DEL USUARIO QUE ACCEDE A LA APP //
    $user = $_POST['userName'];
    $pass = md5($_POST['userPass']);
    
    // ALMACENAMOS EN UNA VARIABLE EL RESULTADO DE LA CONSULTA PRA VALIDAR LA EXISTENCIA DEL USUARIO MEDIANTE LA FUNCION VAIDATE //
    $result =  validate($conn, $user, $pass);

    // CONVERTIMOS EL RESULTADO EN UN ARREGLO ASOCIATIVO //
    $fetch = mysqli_fetch_assoc($result);
    
    // EVALUAMOS SI ES QUE EL ARREGLO NO COINCIDE CON LA CONTRASELÑA Y USUARIO, SI ES QUE NO EXISTE SE REENVIARA AL USUARIO AL LOGIN Y SE ENVIARA UN MENSAJE DE ADVERTENCIA //
    if(!isset($fetch) or $fetch['Email'] !== $user or $fetch['Contraseña'] !== $pass){
        header('Location: ../index.php');
        $_SESSION['MessageWarning'] = 'Usuario o contraseña incorrecto.';
        exit();
        
    };
    
    // SI EXISTE ENTONCES CREAMOS VARIABLES PARA ALMACENAR LOS DATOS //
    $Id = $fetch['Id'];
    $Name = $fetch['Nombre'];
    $LastName = $fetch['Apellido'];

    // CREAMOS UNA SESION CON UN ARREGLO ASOCIATIVO PARA ALMACENAR LOS DATOS DEL USUARIO Y SE REDIRIGE EL USUARIO AL LA PAGINA PRINCIPAL //
    $_SESSION['UserOk'] = array(
        'Id'=> $Id,
        'Name' => $Name,
        'LastName' => $LastName
    );

    header('Location: ../index.php');
};

// SE CREA LA FUNCION VALIDATE PARA VALIDAR SI EL USUARIO EXISTE EN LA BASE DE DATOS //

function validate($con, $user, $pass){
    $query = 'SELECT * FROM users WHERE Email = ? AND Contraseña = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $user, $pass);
    $stmt->execute();
    return $stmt->get_result();
};

?>