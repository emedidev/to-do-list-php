<?php 

require __DIR__.'/../db/conn.php';

session_start();

if(isset($_POST['User'])){
    
    if(empty($_POST['userName']) or empty($_POST['userPass'])){
        header('Location: ../index.php');
        $_SESSION['MessageWarning'] = 'No registro el usuario o contraseña.';
        exit();
    };

    $user = $_POST['userName'];
    $pass = md5($_POST['userPass']);
    
    $result =  validate($conn, $user, $pass);
    $fetch = mysqli_fetch_assoc($result);
    
    if(!isset($fetch) or $fetch['Email'] !== $user or $fetch['Contraseña'] !== $pass){
        header('Location: ../index.php');
        $_SESSION['MessageWarning'] = 'Usuario o contraseña incorrecto.';
        exit();
        
    };
    
    $Id = $fetch['Id'];
    $Name = $fetch['Nombre'];
    $LastName = $fetch['Apellido'];

    session_start();

    $_SESSION['UserOk'] = array(
        'Id'=> $Id,
        'Name' => $Name,
        'LastName' => $LastName
    );

    header('Location: ../index.php');
};

function validate($con, $user, $pass){
    $query = 'SELECT * FROM users WHERE Email = ? AND Contraseña = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param('ss', $user, $pass);
    $stmt->execute();
    return $stmt->get_result();
};

?>